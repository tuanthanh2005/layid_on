<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SupportMessage;

class ChatCounter extends Component
{
    public function render()
    {
        $unreadCount = SupportMessage::where('is_admin', false)
            ->where('is_read', false)
            ->count();
            
        $this->dispatch('chat-counter-updated', count: $unreadCount);

        return view('livewire.admin.chat-counter', [
            'unreadCount' => $unreadCount
        ]);
    }
}
