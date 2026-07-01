<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\TiengDongCategory;
use App\Models\TiengDongSound;

class ScrapeTiengDong extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:tiengdong 
                            {--limit-pages=0 : Limit the number of pages to scrape per category (0 for no limit)} 
                            {--download : Download MP3 files to local storage}
                            {--export-json=tiengdong_sounds.json : Filename for JSON export (saved in storage/app/)}
                            {--category= : Scrape only a specific category slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape sound effects data from tiengdong.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Tăng giới hạn bộ nhớ và vô hiệu hóa Query Log để tránh tràn bộ nhớ khi chạy lâu
        ini_set('memory_limit', '512M');
        \Illuminate\Support\Facades\DB::connection()->disableQueryLog();

        $limitPages = (int) $this->option('limit-pages');
        $downloadMp3 = $this->option('download');
        $exportJsonFile = $this->option('export-json');
        $targetCategorySlug = $this->option('category');

        $this->info("=== Khởi động cào dữ liệu từ tiengdong.com ===");
        $this->info("Lựa chọn: ");
        $this->info("- Giới hạn trang: " . ($limitPages > 0 ? $limitPages : "Không giới hạn"));
        $this->info("- Tải file MP3: " . ($downloadMp3 ? "Có" : "Không"));
        $this->info("- Xuất JSON: " . $exportJsonFile);
        if ($targetCategorySlug) {
            $this->info("- Chỉ cào category: " . $targetCategorySlug);
        }

        // Bước 1: Lấy danh sách danh mục từ trang chủ
        $this->info("\n[1/3] Đang lấy danh sách danh mục từ trang chủ...");
        $categories = $this->fetchCategories();

        if (empty($categories)) {
            $this->error("Không thể lấy danh mục từ trang chủ. Vui lòng kiểm tra kết nối mạng hoặc cấu trúc HTML.");
            return Command::FAILURE;
        }

        $this->info("Đã tìm thấy " . count($categories) . " danh mục.");

        // Lọc danh mục nếu người dùng truyền option --category
        if ($targetCategorySlug) {
            $categories = array_filter($categories, function ($cat) use ($targetCategorySlug) {
                return $cat['slug'] === $targetCategorySlug;
            });

            if (empty($categories)) {
                $this->error("Không tìm thấy danh mục có slug: " . $targetCategorySlug);
                return Command::FAILURE;
            }
        }

        // Bước 2: Duyệt qua từng danh mục để cào âm thanh
        $this->info("\n[2/3] Bắt đầu cào dữ liệu các âm thanh...");
        $totalSoundsScraped = 0;
        $totalSoundsDownloaded = 0;

        foreach ($categories as $catData) {
            $this->info("--------------------------------------------------");
            $this->info("Danh mục: {$catData['name']} ({$catData['url']})");

            // Lưu/Cập nhật danh mục vào DB
            $category = TiengDongCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                [
                    'name' => $catData['name'],
                    'url' => $catData['url']
                ]
            );

            $currentPageUrl = $catData['url'];
            $pageCount = 0;

            while ($currentPageUrl) {
                $pageCount++;
                if ($limitPages > 0 && $pageCount > $limitPages) {
                    $this->comment("  -> Đạt giới hạn {$limitPages} trang. Dừng cào danh mục này.");
                    break;
                }

                $this->info("  Đang cào trang {$pageCount}: {$currentPageUrl}");

                try {
                    $response = Http::withoutVerifying()->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    ])->timeout(30)->get($currentPageUrl);

                    if (!$response->successful()) {
                        $this->error("  -> Không thể tải trang (HTTP Status: " . $response->status() . ")");
                        break;
                    }

                    $html = $response->body();
                    $crawler = new Crawler($html);

                    // Lấy danh sách sound items
                    $soundItems = $crawler->filter('li.audio-play-item');
                    $itemsInPage = $soundItems->count();
                    $this->info("  -> Tìm thấy {$itemsInPage} âm thanh trên trang này.");

                    if ($itemsInPage === 0) {
                        break;
                    }

                    $soundItems->each(function (Crawler $node) use ($category, $downloadMp3, &$totalSoundsScraped, &$totalSoundsDownloaded) {
                        // 1. Tìm nút play
                        $button = $node->filter('button.button-play');
                        if ($button->count() === 0) {
                            return; // Bỏ qua nếu không có nút play
                        }

                        $postId = $button->attr('data-post-id');
                        if (!$postId) {
                            $postId = $button->attr('data-id'); // fallback
                        }

                        $onclick = $button->attr('onclick');
                        
                        // Parse MP3 URL từ onclick attribute
                        // Ví dụ: playPauseAudio('ams-xyz', 'https://tiengdong.com/wp-content/uploads/file.mp3')
                        $mp3Url = null;
                        if ($onclick && preg_match("/playPauseAudio\s*\(\s*['\"][^'\"]*['\"]\s*,\s*['\"]([^'\"]*)['\"]\s*\)/", $onclick, $matches)) {
                            $mp3Url = $matches[1];
                        }

                        // 2. Tìm title & detail url
                        $linkNode = $node->filter('.title-link-col a');
                        if ($linkNode->count() === 0) {
                            return;
                        }

                        $title = trim($linkNode->text());
                        $detailUrl = $linkNode->attr('href');

                        if (!$postId || !$title || !$mp3Url) {
                            return; // Thiếu thông tin cốt lõi
                        }

                        // Tạo slug
                        $slug = Str::slug($title);

                        // 3. Xử lý tải file MP3
                        $localPath = null;
                        
                        // Kiểm tra xem đã tồn tại bản ghi trong DB chưa
                        $existingSound = TiengDongSound::find($postId);
                        if ($existingSound && $existingSound->local_path) {
                            $localPath = $existingSound->local_path;
                        }

                        if ($downloadMp3 && (!$existingSound || !$existingSound->local_path)) {
                            $localPath = $this->downloadAudio($mp3Url, $category->slug, $postId);
                            if ($localPath) {
                                $totalSoundsDownloaded++;
                            }
                        }

                        // 4. Lưu vào Database
                        TiengDongSound::updateOrCreate(
                            ['id' => $postId],
                            [
                                'category_id' => $category->id,
                                'title' => $title,
                                'slug' => $slug,
                                'mp3_url' => $mp3Url,
                                'local_path' => $localPath,
                                'detail_url' => $detailUrl,
                            ]
                        );

                        $totalSoundsScraped++;
                    });

                    // Tìm trang tiếp theo từ pagination
                    $nextPageUrl = null;
                    $crawler->filter('li.pagination a')->each(function (Crawler $node) use (&$nextPageUrl) {
                        $text = trim($node->text());
                        if (strcasecmp($text, 'Next') === 0 || strcasecmp($text, 'Trang sau') === 0) {
                            $nextPageUrl = $node->attr('href');
                        }
                    });

                    $currentPageUrl = $nextPageUrl;

                    // Giải phóng bộ nhớ sau mỗi trang
                    gc_collect_cycles();

                } catch (\Exception $e) {
                    $this->error("  -> Lỗi xảy ra khi cào trang này: " . $e->getMessage());
                    break;
                }
            }
        }

        // Bước 3: Xuất dữ liệu ra file JSON
        $this->info("\n[3/3] Đang xuất dữ liệu ra file JSON...");
        $this->exportToJson($exportJsonFile);

        $this->info("\n=== Hoàn thành cào dữ liệu! ===");
        $this->info("Tổng số âm thanh đã lưu vào DB: " . TiengDongSound::count());
        $this->info("Số âm thanh cào mới/cập nhật trong phiên này: " . $totalSoundsScraped);
        $this->info("Số file MP3 tải mới thành công: " . $totalSoundsDownloaded);
        $this->info("Đường dẫn file JSON xuất ra: " . storage_path('app/' . $exportJsonFile));
        
        return Command::SUCCESS;
    }

    /**
     * Tải file âm thanh MP3 từ URL gốc về local storage công khai.
     */
    private function downloadAudio(string $url, string $categorySlug, string $postId): ?string
    {
        try {
            // Lấy tên file gốc từ URL
            $filename = basename(parse_url($url, PHP_URL_PATH));
            if (!$filename || !str_ends_with(strtolower($filename), '.mp3')) {
                $filename = "sound_{$postId}.mp3";
            } else {
                // Thêm ID để tránh trùng lặp
                $filename = "{$postId}_{$filename}";
            }

            $relativePath = "sounds/{$categorySlug}/{$filename}";

            // Tải file
            $response = Http::withoutVerifying()->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            ])->timeout(60)->get($url);

            if ($response->successful()) {
                Storage::disk('public')->put($relativePath, $response->body());
                return "storage/sounds/{$categorySlug}/{$filename}";
            }
        } catch (\Exception $e) {
            $this->error("    -> Lỗi khi tải file MP3 ({$url}): " . $e->getMessage());
        }

        return null;
    }

    /**
     * Lấy danh sách các danh mục và URL từ trang chủ.
     */
    private function fetchCategories(): array
    {
        $categories = [];

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            ])->timeout(30)->get('https://tiengdong.com/');

            if (!$response->successful()) {
                return [];
            }

            $html = $response->body();
            $crawler = new Crawler($html);

            // Bóc tách từ danh sách menu
            $crawler->filter('nav#main-menu-head ul.nav-list li.menu-item a')->each(function (Crawler $node) use (&$categories) {
                $url = $node->attr('href');
                $name = trim($node->text());

                // Bỏ qua các trang đặc biệt
                if (!$url || $url === '/' || $url === '#' || 
                    str_contains($url, 'favorites') || 
                    str_contains($url, 'text-to-speech') ||
                    str_contains($url, 'close-menu')) {
                    return;
                }

                // Chuẩn hóa URL (nếu là đường dẫn tương đối)
                if (str_starts_with($url, '/')) {
                    $url = 'https://tiengdong.com' . $url;
                }

                // Lấy slug từ URL
                $slug = basename(parse_url($url, PHP_URL_PATH));

                if ($slug && $name) {
                    $categories[] = [
                        'name' => $name,
                        'slug' => $slug,
                        'url' => $url
                    ];
                }
            });

        } catch (\Exception $e) {
            $this->error("Lỗi khi kết nối lấy danh mục: " . $e->getMessage());
        }

        return $categories;
    }

    /**
     * Xuất toàn bộ dữ liệu âm thanh và danh mục từ DB ra file JSON.
     */
    private function exportToJson(string $filename)
    {
        $data = TiengDongCategory::with(['sounds' => function ($query) {
            $query->select('id', 'category_id', 'title', 'slug', 'mp3_url', 'local_path', 'detail_url');
        }])->get(['id', 'name', 'slug', 'url'])->toArray();

        $jsonContent = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        Storage::put($filename, $jsonContent);
    }
}
