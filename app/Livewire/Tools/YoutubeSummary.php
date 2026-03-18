<?php

namespace App\Livewire\Tools;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class YoutubeSummary extends Component
{
    public $url = '';
    public $manualTranscript = '';
    public $summary = '';
    public $loading = false;
    public $showManualInput = false;
    public $error = '';

    public function summarize()
    {
        if ($this->showManualInput) {
            if (empty($this->manualTranscript)) {
                $this->error = "Vui lòng dán phụ đề.";
                return;
            }
            return $this->processWithGroq($this->manualTranscript);
        }

        $this->validate(['url' => 'required|url']);
        $this->loading = true;
        $this->error = '';
        $this->summary = '';

        try {
            $videoId = $this->getVideoId($this->url);
            $transcript = $this->getTranscript($videoId);
            
            if ($transcript) {
                return $this->processWithGroq($transcript);
            }

            $this->error = "Không thể lấy phụ đề tự động. Vui lòng dán văn bản thủ công bên dưới nhé!";
            $this->showManualInput = true;

        } catch (\Exception $e) {
            $this->error = "Lỗi: " . $e->getMessage();
        }

        $this->loading = false;
    }

    private function processWithGroq($text)
    {
        $this->loading = true;
        try {
            $apiKey = config('services.groq.key');
            $response = Http::timeout(60)->withToken($apiKey)->post("https://api.groq.com/openai/v1/chat/completions", [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => "Bạn là chuyên gia tóm tắt nội dung chuyên nghiệp. Hãy trình bày kết quả sạch đẹp, trình bày bằng tiếng Việt. Sử dụng danh sách gạch đầu dòng và phân đoạn rõ ràng."],
                    ['role' => 'user', 'content' => "Hãy tóm tắt chi tiết nội dung sau. Yêu cầu: Không dùng ký hiệu # ở đầu dòng, hãy dùng các icon hoặc gạch đầu dòng để phân chia đoạn cho đẹp: \n\n" . $text]
                ],
            ]);

            if ($response->successful()) {
                $this->summary = $response->json()['choices'][0]['message']['content'];
                $this->dispatch('resultUpdated');
                $this->error = '';
            } else {
                $this->error = "Lỗi AI.";
            }
        } catch (\Exception $e) {
            $this->error = "Lỗi kết nối AI.";
        }
        $this->loading = false;
    }

    private function getVideoId($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1] ?? null;
    }

    private function getTranscript($videoId) {
        $proxies = [
            "https://transcript-api.vercel.app/api/transcript?v=" . $videoId,
            "https://youtube-transcript.com/api/v1/transcript?v=" . $videoId
        ];
        foreach($proxies as $proxy) {
            try {
                $resp = Http::get($proxy);
                if ($resp->successful()) {
                    $json = $resp->json();
                    $list = $json['transcript'] ?? $json;
                    if (is_array($list)) {
                        $text = "";
                        foreach (array_slice($list, 0, 800) as $line) { $text .= ($line['text'] ?? "") . " "; }
                        if (strlen($text) > 100) return $text;
                    }
                }
            } catch (\Exception $e) {}
        }
        return null;
    }

    public function render()
    {
        return view('livewire.tools.youtube-summary');
    }
}
