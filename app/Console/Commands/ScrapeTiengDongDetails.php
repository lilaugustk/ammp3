<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\TiengDongSound;
use App\Models\TiengDongTag;

class ScrapeTiengDongDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:tiengdong-details 
                            {--limit=0 : Limit the number of sounds to scrape} 
                            {--force : Force scraping even if sound has description already}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape detail descriptions and tags for sounds from tiengdong.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '512M');
        \Illuminate\Support\Facades\DB::connection()->disableQueryLog();

        $limit = (int) $this->option('limit');
        $force = $this->option('force');

        $query = TiengDongSound::query();
        if (!$force) {
            $query->whereNull('description');
        }

        if ($limit > 0) {
            $query->limit($limit);
        }

        $sounds = $query->get();
        $total = $sounds->count();

        if ($total === 0) {
            $this->info("Không có âm thanh nào cần cập nhật thông tin chi tiết.");
            return Command::SUCCESS;
        }

        $this->info("Bắt đầu cập nhật thông tin chi tiết (description & tags) cho {$total} âm thanh...");

        $successCount = 0;
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($sounds as $sound) {
            if (!$sound->detail_url) {
                $bar->advance();
                continue;
            }

            try {
                // Tải trang chi tiết
                $response = Http::withoutVerifying()->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                ])->timeout(15)->get($sound->detail_url);

                if (!$response->successful()) {
                    $bar->advance();
                    continue;
                }

                $html = $response->body();
                $crawler = new Crawler($html);

                // 1. Lấy mô tả (description)
                $description = null;
                $descNode = $crawler->filter('.description');
                if ($descNode->count() > 0) {
                    $description = trim($descNode->text());
                }

                // 2. Lấy tags
                $tags = [];
                // Thử lọc theo 'p.tags a' hoặc '.tags a' hoặc '.tag a'
                $tagLinks = $crawler->filter('p.tags a');
                if ($tagLinks->count() === 0) {
                    $tagLinks = $crawler->filter('.tags a');
                }
                if ($tagLinks->count() === 0) {
                    $tagLinks = $crawler->filter('.tag a');
                }

                $tagLinks->each(function (Crawler $node) use (&$tags) {
                    $name = trim($node->text());
                    $href = $node->attr('href');
                    if ($href) {
                        $slug = basename(parse_url($href, PHP_URL_PATH));
                        // Clean up tag name (replace comma-like characters if any)
                        $name = str_replace(['，', ','], ', ', $name);
                        if ($name && $slug && $slug !== 'tag') {
                            $tags[] = [
                                'name' => $name,
                                'slug' => $slug
                            ];
                        }
                    }
                });

                // 3. Lưu vào Database
                $sound->description = $description;
                $sound->save();

                if (!empty($tags)) {
                    $tagIds = [];
                    foreach ($tags as $tagData) {
                        $tag = TiengDongTag::updateOrCreate(
                            ['slug' => $tagData['slug']],
                            ['name' => $tagData['name']]
                        );
                        $tagIds[] = $tag->id;
                    }
                    $sound->tags()->sync($tagIds);
                }

                $successCount++;

            } catch (\Exception $e) {
                // Ghi log lỗi nhỏ
                $this->warn("\nLỗi khi cào sound ID {$sound->id}: " . $e->getMessage());
            }

            // Sleep để tránh request dồn dập
            usleep(250000); // 250ms
            $bar->advance();
        }

        $bar->finish();
        $this->info("\n\nCập nhật thành công {$successCount}/{$total} âm thanh!");

        return Command::SUCCESS;
    }
}
