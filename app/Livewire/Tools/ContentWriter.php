<?php

namespace App\Livewire\Tools;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ContentWriter extends Component
{
    public $topic;
    public $style = 'fb';
    public $result = '';
    public $loading = false;
    public $error = '';

    public function generate()
    {
        $this->validate(['topic' => 'required|min:5']);
        $this->loading = true;
        $this->error = '';
        $this->result = '';

        try {
            $apiKey = config('services.groq.key');
            
            $systemPrompts = [
                'fb' => "Bạn là chuyên gia viết bài Facebook. Hãy dùng nhiều emoji, xuống dòng hợp lý, KHÔNG dùng ký hiệu # làm tiêu đề. Hãy dùng các biểu tượng để phân tách ý.",
                'tiktok' => "Bạn là chuyên gia viết kịch bản TikTok. Hãy phân chia rõ ràng các phần: [Hook], [Nội dung], [CTA]. Trình bày sạch sẽ, dễ đọc.",
                'blog' => "Bạn là blogger chuyên nghiệp. Hãy trình bày nội dung có tiêu đề đậm, danh sách gạch đầu dòng và phân đoạn rõ ràng bằng Markdown."
            ];

            $prompts = [
                'fb' => "Viết bài đăng Facebook về: ",
                'blog' => "Viết bài blog chuyên sâu về: ",
                'tiktok' => "Viết kịch bản TikTok sáng tạo về: ",
            ];

            $systemPrompt = $systemPrompts[$this->style] ?? $systemPrompts['fb'];
            $prompt = ($prompts[$this->style] ?? $prompts['fb']) . $this->topic;

            $response = Http::withToken($apiKey)->post("https://api.groq.com/openai/v1/chat/completions", [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $prompt]
                ],
            ]);

            if ($response->successful()) {
                $this->result = $response->json()['choices'][0]['message']['content'];
                $this->dispatch('resultUpdated');
            } else {
                $this->error = "Lỗi kết nối AI.";
            }
        } catch (\Exception $e) {
            $this->error = "Lỗi hệ thống.";
        }
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.tools.content-writer');
    }
}
