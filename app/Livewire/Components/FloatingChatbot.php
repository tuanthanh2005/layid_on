<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FloatingChatbot extends Component
{
    public bool $isOpen = false;

    public bool $isSending = false;

    public string $prompt = '';

    public array $messages = [];

    public function mount(): void
    {
        $this->messages = [];
        $this->appendMessage('assistant', 'Chào Bạn 👋! Mình là trợ lý ảo của website công nghệ này. Bạn có thể hỏi mình về các sản phẩm AI hiện có, hoặc bất cứ câu hỏi nào liên quan đến công nghệ nhé!');
    }

    public function toggle(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function clearChat(): void
    {
        $this->messages = [];
        $this->appendMessage('assistant', 'Đã xóa đoạn chat. ạn muốn hỏi gì tiếp không?');

        $this->prompt = '';
    }

    public function sendMessage(): void
    {
        $this->validate([
            'prompt' => 'required|string|min:1|max:1500',
        ]);

        $userMessage = trim($this->prompt);

        if ($userMessage === '') {
            return;
        }

        $this->appendMessage('user', $userMessage);

        $this->prompt = '';
        $this->isSending = true;

        try {
            $apiKey = (string) config('services.groq.key');
            $baseUrl = rtrim((string) config('services.groq.base_url', 'https://api.groq.com/openai/v1'), '/');
            $model = (string) config('services.groq.model', 'llama-3.3-70b-versatile');

            if ($apiKey === '') {
                $this->appendMessage('assistant', 'Chua cau hinh GROQ_API_KEY trong file .env.');

                return;
            }

            // Lấy danh sách sản phẩm AI hiện tại
            $products = \App\Models\Product::where('status', true)
                ->select('name', 'price', 'discount_price')
                ->orderBy('order_index')
                ->take(24)
                ->get()
                ->map(fn($p) => "{$p->name}: {$p->price}đ" . ($p->discount_price ? " (gốc {$p->discount_price}đ)" : ''))
                ->implode(', ');

            $systemPrompt = "Ban la tro ly AI than thien cho website cong nghe. Tra loi ngan gon, ro rang, uu tien tieng Viet.\n\n";
            $systemPrompt .= "Danh sach san pham AI hien co: {$products}";

            $payloadMessages = array_merge([
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
            ], $this->buildHistory());

            $response = Http::timeout(45)
                ->acceptJson()
                ->withToken($apiKey)
                ->post($baseUrl . '/chat/completions', [
                    'model' => $model,
                    'messages' => $payloadMessages,
                    'temperature' => 0.6,
                    'max_tokens' => 700,
                ]);

            if ($response->failed()) {
                $statusCode = $response->status();
                $this->appendMessage('assistant', "Khong goi duoc Groq API (HTTP {$statusCode}). Ban thu lai sau nhe.");

                return;
            }

            $content = trim((string) data_get($response->json(), 'choices.0.message.content', ''));

            $this->appendMessage(
                'assistant',
                $content !== ''
                    ? $content
                    : 'Minh vua nhan phan hoi rong tu AI, ban gui lai cau hoi giup minh nha.'
            );

            $this->trimConversation();
        } catch (\Throwable $e) {
            $this->appendMessage('assistant', 'Dang gap loi ket noi den AI. Ban doi 1 chut roi thu lai nha.');
        } finally {
            $this->isSending = false;
            $this->dispatch('floating-chat-updated');
        }
    }

    private function appendMessage(string $role, string $content): void
    {
        $this->messages[] = [
            'role' => $role,
            'content' => $content,
            'time' => now()->format('H:i'),
        ];
    }

    private function buildHistory(): array
    {
        $history = [];

        foreach (array_slice($this->messages, -12) as $message) {
            $role = $message['role'] ?? 'assistant';
            $content = trim((string) ($message['content'] ?? ''));

            if ($content === '') {
                continue;
            }

            if (!in_array($role, ['user', 'assistant', 'system'], true)) {
                $role = 'assistant';
            }

            $history[] = [
                'role' => $role,
                'content' => $content,
            ];
        }

        return $history;
    }

    private function trimConversation(): void
    {
        if (count($this->messages) <= 24) {
            return;
        }

        $this->messages = array_slice($this->messages, -24);
    }

    public function render()
    {
        return view('livewire.components.floating-chatbot');
    }
}