<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class SupportChatDashboard extends Component
{
    public $activeSessionId = null;
    public $replyMessage = '';

    public function mount()
    {
        // Require admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function selectSession($sessionId)
    {
        $this->activeSessionId = $sessionId;
        
        // Mark messages as read for admin
        SupportMessage::where('session_id', $sessionId)
            ->where('is_admin', false)
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        $this->dispatch('chatSessionSelected');
    }

    public function getActiveMessagesProperty()
    {
        if (!$this->activeSessionId) return [];
        return SupportMessage::with('user')
            ->where('session_id', $this->activeSessionId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendReply()
    {
        if (trim($this->replyMessage) === '' || !$this->activeSessionId) return;

        SupportMessage::create([
            'session_id' => $this->activeSessionId,
            'admin_id' => Auth::id(),
            'message' => $this->replyMessage,
            'is_admin' => true,
            'is_read' => false,
        ]);

        $this->replyMessage = '';
        
        // Notify the user client via Pusher/Reverb (stub for real-time)
        // broadcast(new SupportMessageSent(...));
        $this->dispatch('replySent');
    }
    
    // Auto-refresh the conversation list and active chat
    public function loadLatestData()
    {
        // Just triggers re-render
    }

    #[Layout('layouts.admin')]
    #[Title('Hỗ trợ Trực tuyến')]
    public function render()
    {
        // Get all unique sessions with their latest message
        $subquery = SupportMessage::select('session_id', DB::raw('MAX(created_at) as last_activity'))
            ->groupBy('session_id');

        $activeChats = SupportMessage::joinSub($subquery, 'latest_messages', function ($join) {
                $join->on('support_messages.session_id', '=', 'latest_messages.session_id')
                     ->on('support_messages.created_at', '=', 'latest_messages.last_activity');
            })
            ->with('user')
            ->orderBy('support_messages.created_at', 'desc')
            ->get()
            ->map(function ($chat) {
                $unread = SupportMessage::where('session_id', $chat->session_id)
                    ->where('is_admin', false)
                    ->where('is_read', false)
                    ->count();
                $chat->unread_count = $unread;
                return $chat;
            });

        return view('livewire.admin.support-chat-dashboard', [
            'chats' => $activeChats,
            'activeMessages' => $this->activeMessages
        ]);
    }
}
