<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GeminiTrick;

class GeminiBusinessFree extends Component
{
    public $slug;

    public function mount($slug = null)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        // If a slug is provided, find that specific trick. Otherwise, find the latest/first by order.
        if ($this->slug) {
            $mainPost = GeminiTrick::where('slug', $this->slug)->where('status', true)->first();
            
            // Fallback if slug not found
            if (!$mainPost) {
                $mainPost = GeminiTrick::where('status', true)->orderBy('order')->orderBy('created_at', 'desc')->first();
            }
        } else {
            $mainPost = GeminiTrick::where('status', true)->orderBy('order')->orderBy('created_at', 'desc')->first();
        }

        // Fetch other Gemini tricks as "Other Guides"
        $otherPosts = collect();
        if ($mainPost) {
            $otherPosts = GeminiTrick::where('status', true)
                ->where('id', '!=', $mainPost->id)
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('livewire.gemini-business-free', [
            'mainPost' => $mainPost,
            'otherPosts' => $otherPosts
        ]);
    }
}
