<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $q = '';
    protected $queryString = ['q' => ['except' => '']];

    public function mount() {}

    public function render()
    {
        $featuredPost = \App\Models\Post::where('status', true)->where('is_featured', true)->latest()->first();
        $gridPosts = \App\Models\Post::where('status', true)->where('is_grid', true)->latest()->take(4)->get();
        $recommendedPosts = \App\Models\Post::where('status', true)->where('is_recommended', true)->latest()->take(5)->get();
        $interestServices = \App\Models\SocialService::where('status', true)->where('show_on_home', true)->orderBy('order')->take(5)->get();
        $videoPosts = \App\Models\Post::where('status', true)->where('is_video', true)->latest()->take(3)->get();
        $trendingPosts = \App\Models\Post::where('status', true)->where('is_trending', true)->latest()->take(10)->get();
        
        // Bài viết mới nhất (List Post) - Lấy tất cả bài viết mới nhất để khu vực này không bị trống
        $latestPostsQuery = \App\Models\Post::where('status', true);
        if ($this->q) {
            $latestPostsQuery->where('title', 'like', '%' . $this->q . '%');
        }
        $latestPosts = $latestPostsQuery->latest()->take(10)->get();

        $utilities = \App\Models\Utility::where('status', true)->orderBy('order_index')->get();

        $aiProducts = \App\Models\Product::where('status', true)->orderBy('order_index')->take(24)->get();

        $courses = \App\Models\Course::where('status', true)->orderBy('order')->take(3)->get();
        $movies = \App\Models\Movie::where('status', true)->latest()->take(3)->get();

        return view('livewire.home', compact(
            'featuredPost', 'gridPosts', 'recommendedPosts', 'interestServices', 'videoPosts', 'latestPosts', 'utilities', 'trendingPosts', 'aiProducts', 'courses', 'movies'
        ));
    }
}
