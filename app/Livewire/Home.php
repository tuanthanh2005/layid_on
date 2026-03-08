<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $featuredPost = \App\Models\Post::where('status', true)->where('is_featured', true)->latest()->first();
        $gridPosts = \App\Models\Post::where('status', true)->where('is_grid', true)->latest()->take(4)->get();
        $recommendedPosts = \App\Models\Post::where('status', true)->where('is_recommended', true)->latest()->take(5)->get();
        $interestedPosts = \App\Models\Post::where('status', true)->where('is_interested', true)->latest()->take(5)->get();
        $videoPosts = \App\Models\Post::where('status', true)->where('is_video', true)->latest()->take(3)->get();
        $trendingPosts = \App\Models\Post::where('status', true)->where('is_trending', true)->latest()->take(10)->get();
        
        // Bài viết mới nhất (List Post) - Lấy tất cả bài viết mới nhất để khu vực này không bị trống
        $latestPosts = \App\Models\Post::where('status', true)->latest()->take(10)->get();

        $utilities = \App\Models\Utility::where('status', true)->orderBy('order_index')->get();

        $aiProducts = \App\Models\Product::where('status', true)->orderBy('order_index')->take(6)->get();

        return view('livewire.home', compact(
            'featuredPost', 'gridPosts', 'recommendedPosts', 'interestedPosts', 'videoPosts', 'latestPosts', 'utilities', 'trendingPosts', 'aiProducts'
        ));
    }
}
