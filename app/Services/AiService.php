<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiService
{
    protected ?string $apiKey;
    protected string $provider;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->provider = config('services.gemini.provider', 'gemini');
        $this->model = config('services.gemini.model', 'gemini-2.5-flash');
    }

    /**
     * Rewrite description and generate tags for a sound.
     *
     * @param string $title
     * @param string|null $originalDescription
     * @return array|null Returns ['description' => '...', 'tags' => [...]] or null on failure.
     */
    public function optimizeDescriptionAndTags(string $title, ?string $originalDescription): ?array
    {
        if (empty($this->apiKey)) {
            Log::warning('AiService: API key is not configured.');
            return null;
        }

        $desc = $originalDescription ?: 'Chưa có mô tả chi tiết.';

        $categoriesList = \App\Models\TiengDongCategory::pluck('name')
            ->map(fn($name) => trim(mb_strtolower($name)))
            ->implode(', ');

        $prompt = "Bạn là một chuyên gia tối ưu hóa nội dung SEO website và là AI hỗ trợ cho trang web tải nhạc hiệu ứng âm thanh (sound effects).
Nhiệm vụ của bạn là:
1. Viết lại phần mô tả chi tiết cho âm thanh dưới đây bằng tiếng Việt ngắn gọn (chỉ khoảng 2-3 câu, tối đa 70 từ), độc bản và tự nhiên nhất.
   - TRÁNH RẬP KHUÔN: Tuyệt đối không dùng các câu giới thiệu rập khuôn như 'là hiệu ứng âm thanh chất lượng cao...', 'lựa chọn hoàn hảo...', 'dễ dàng tải về file MP3...'. Tuyệt đối KHÔNG gọi hiệu ứng âm thanh là 'công cụ' hay 'công cụ đắc lực' (vì nghe rất cứng và gượng gạo). Hãy dùng từ tự nhiên như 'lý tưởng để...', 'rất thích hợp...', 'hiệu ứng thú vị...'.
   - THÊM YẾU TỐ ĐỘC BẢN: Tập trung mô tả trực tiếp nguồn gốc của âm thanh (ví dụ: cắt từ stream của streamer PewPew, trào lưu mạng xã hội, phim hoạt hình cổ điển, phim điện ảnh...) và mục đích thực tế mà mọi người thường dùng (ví dụ: dựng video troll, ghép meme TikTok, chèn vào livestream...).
   - CHÚ Ý: Tuyệt đối KHÔNG sử dụng dấu ngoặc kép đôi (\") ở bên trong nội dung mô tả mới để tránh lỗi cú pháp JSON. Nếu muốn trích dẫn tên hoặc cụm từ, hãy dùng dấu ngoặc đơn (') thay thế.
2. Sinh ra từ 4 đến 6 tags (từ khóa) liên quan mật thiết đến âm thanh này.
   Lưu ý về quy tắc sinh tags chuẩn SEO:
    - Mỗi tag bắt buộc phải có độ dài từ 2 đến 4 từ (tối đa 5 từ) để đảm bảo hiển thị đẹp trên giao diện và có khả năng gom nhóm tốt (ví dụ: 'tiếng biến mất ma thuật', 'tải âm thanh làm phép', 'hiệu ứng âm thanh ma thuật').
    - Tuyệt đối KHÔNG sinh ra các tag quá dài như một câu (từ 6 từ trở lên) và KHÔNG sinh ra các tag đơn/kép quá ngắn, chung chung (như 'phép thuật', 'biến mất', 'ma thuật').
    - TUYỆT ĐỐI KHÔNG sinh ra tag trùng hoặc quá giống với các tên danh mục chính sau: {$categoriesList}.
    - Sử dụng tiếng Việt hoàn toàn, viết chữ thường, tự nhiên.

Tiêu đề âm thanh: \"{$title}\"
Mô tả gốc: \"{$desc}\"

Bắt buộc trả về kết quả dưới định dạng JSON với cấu trúc chính xác như sau:
{
  \"description\": \"Nội dung mô tả ngắn gọn đã được viết lại bằng tiếng Việt\",
  \"tags\": [\"tag 1\", \"tag 2\", \"tag 3\"]
}";

        try {
            $response = Http::withoutVerifying()
                ->timeout(20)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json'
                    ]
                ]);

            if (!$response->successful()) {
                Log::error('AiService API Error: ' . $response->body());
                return null;
            }

            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$text) {
                Log::error('AiService response has empty parts.', ['result' => $result]);
                return null;
            }

            $decoded = json_decode(trim($text), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('AiService failed to decode JSON response: ' . json_last_error_msg(), ['text' => $text]);
                return null;
            }

            return [
                'description' => $decoded['description'] ?? null,
                'tags' => $decoded['tags'] ?? []
            ];

        } catch (\Exception $e) {
            Log::error('AiService Exception: ' . $e->getMessage());
            return null;
        }
    }
}
