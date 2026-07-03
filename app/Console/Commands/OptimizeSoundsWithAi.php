<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TiengDongSound;
use App\Models\TiengDongTag;
use App\Services\AiService;
use Illuminate\Support\Str;

class OptimizeSoundsWithAi extends Command
{
    /**
     * The name and signature of the console command.
     *  
     * @var string
     */
    protected $signature = 'sound:optimize-with-ai 
                            {--limit=10 : Số lượng bản ghi cần tối ưu bằng AI} 
                            {--sleep=13 : Số giây nghỉ giữa các request (mặc định 13s để phù hợp RPM=5 của gói Free)} 
                            {--force : Bỏ qua cờ is_optimized và tối ưu lại từ đầu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sử dụng AI viết lại mô tả và tự động sinh tags cho âm thanh';

    /**
     * Execute the console command.
     */
    public function handle(AiService $aiService)
    {
        $limit = (int) $this->option('limit');
        $sleep = (int) $this->option('sleep');
        $force = $this->option('force');

        $query = TiengDongSound::query();
        
        if (!$force) {
            $query->where('is_optimized', false);
        }

        // Ưu tiên các âm thanh đã có mô tả gốc để AI viết lại, 
        // nhưng nếu không có mô tả gốc thì AI vẫn tự viết mô tả dựa theo tiêu đề.
        $sounds = $query->limit($limit)->get();
        $total = $sounds->count();

        if ($total === 0) {
            $this->info("Không có âm thanh nào cần tối ưu bằng AI.");
            return Command::SUCCESS;
        }

        $this->info("Bắt đầu tối ưu hóa mô tả & tags bằng AI cho {$total} âm thanh...");
        $successCount = 0;

        foreach ($sounds as $index => $sound) {
            $this->info("\n[" . ($index + 1) . "/{$total}] Đang xử lý: \"{$sound->title}\" (ID: {$sound->id})");

            $result = $aiService->optimizeDescriptionAndTags($sound->title, $sound->description);

            if ($result) {
                // Cập nhật mô tả mới và đánh dấu đã tối ưu
                $sound->description = $result['description'] ?: $sound->description;
                $sound->is_optimized = true;
                $sound->save();

                // Đồng bộ tags mới sinh ra từ AI
                if (!empty($result['tags'])) {
                    $tagIds = [];
                    foreach ($result['tags'] as $tagName) {
                        $tagName = trim($tagName);
                        if (empty($tagName)) {
                            continue;
                        }

                        $slug = Str::slug($tagName);
                        
                        if ($slug) {
                            $tag = TiengDongTag::updateOrCreate(
                                ['slug' => $slug],
                                ['name' => $tagName]
                            );
                            $tagIds[] = $tag->id;
                        }
                    }

                    if (!empty($tagIds)) {
                        $sound->tags()->sync($tagIds);
                        $this->line(" - Đã đồng bộ " . count($tagIds) . " tags: " . implode(', ', $result['tags']));
                    }
                }

                $this->info(" -> Hoàn thành viết lại mô tả và cập nhật tags.");
                $successCount++;
            } else {
                $this->error(" -> Không thể tối ưu hóa bản ghi này (kiểm tra logs hoặc giới hạn API Key).");
                $this->warn("Dừng tiến trình để tránh spam lỗi API.");
                break;
            }

            // Sleep để tránh quá giới hạn Rate Limit (RPM = 5) của gói free
            if ($index < $total - 1 && $sleep > 0) {
                $this->line("Nghỉ {$sleep} giây để tránh vượt giới hạn RPM...");
                sleep($sleep);
            }
        }

        $this->info("\nĐã tối ưu hóa thành công {$successCount}/{$total} bản ghi!");

        return Command::SUCCESS;
    }
}
