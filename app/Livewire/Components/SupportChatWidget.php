<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupportChatWidget extends Component
{
    public $isOpen = false;
    public $message = '';
    public $messages = [];
    public $sessionId;

    public function mount()
    {
        // Use User ID if logged in, otherwise fallback to their IP address for deterministic chat history retrieval
        if (Auth::check()) {
            $this->sessionId = 'user_' . Auth::id();
        } else {
            // Include user agent hash to slightly reduce collisions on the same public IP
            $agentHash = substr(md5(request()->userAgent()), 0, 8);
            $this->sessionId = 'ip_' . request()->ip() . '_' . $agentHash;
        }

        $this->loadMessages();
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->loadMessages();
            // Mark all admin messages as read for this user
            SupportMessage::where('session_id', $this->sessionId)
                ->where('is_admin', true)
                ->where('is_read', false)
                ->update(['is_read' => true]);
            $this->dispatch('chatOpened');
        }
    }

    public function loadMessages()
    {
        $query = SupportMessage::where('session_id', $this->sessionId);
        
        // If logged in, also match their user_id to sync across devices
        if (Auth::check()) {
            $query->orWhere('user_id', Auth::id());
        }

        $this->messages = $query->orderBy('created_at', 'asc')->get()->toArray();
    }

    public function sendMessage()
    {
        if (trim($this->message) === '') return;

        SupportMessage::create([
            'session_id' => $this->sessionId,
            'user_id' => Auth::id(),
            'message' => $this->message,
            'is_admin' => false,
            'is_read' => false,
        ]);

        $this->message = '';
        $this->loadMessages();
        $this->dispatch('messageSent');
    }

    #[On('echo:support-chat,MessageToUser')]
    public function listenForNewMessage()
    {
        // In a real app with Pusher/Reverb, this listens for incoming admin replies
        $this->loadMessages();
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
        return view('livewire.components.support-chat-widget', [
            'unreadCount' => $this->unreadCount
        ]);
    }
}
