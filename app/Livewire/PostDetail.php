<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostDetail extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
        
        // Increase views logic (simple implementation)
        $this->post->increment('views');
    }

    public function render()
    {
        return view('livewire.post-detail')->layout('layouts.app');
    }
}
