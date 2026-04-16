<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Livewire\Attributes\Title;

#[Title('Hỗ trợ Trực tuyến')]
class UserChat extends Component
{
    public $isOpen = true;
    public $message = '';
    public $sessionId;

    public function mount()
    {
        // Use a persistent session ID for the guest or user_id
        if (Auth::check()) {
            $this->sessionId = 'user_' . Auth::id();
        } else {
            $this->sessionId = Session::get('support_chat_session_id', function() {
                $sid = 'guest_' . uniqid();
                Session::put('support_chat_session_id', $sid);
                return $sid;
            });
        }
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->markAsRead();
        }
    }

    public function markAsRead()
    {
        SupportMessage::where('session_id', $this->sessionId)
            ->where('is_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function sendMessage()
    {
        if (trim($this->message) === '') return;

        $msg = SupportMessage::create([
            'session_id' => $this->sessionId,
            'user_id' => Auth::check() ? Auth::id() : null,
            'message' => $this->message,
            'is_admin' => false,
            'is_read' => false,
        ]);

        // Gửi thông báo Telegram cho admin
        try {
            \App\Services\TelegramService::sendSupportMessage($msg);
        } catch (\Exception $e) {
            \Log::error("Lỗi gửi Telegram Chat: " . $e->getMessage());
        }

        $this->message = '';
        $this->dispatch('messageSent');
    }

    public function getMessagesProperty()
    {
        return SupportMessage::where('session_id', $this->sessionId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getUnreadCountProperty()
    {
        return SupportMessage::where('session_id', $this->sessionId)
            ->where('is_admin', true)
            ->where('is_read', false)
            ->count();
    }

    public function render()
    {
        return view('livewire.chat.user-chat', [
            'messages' => $this->messages,
            'unreadCount' => $this->unreadCount
        ]);
    }
}
