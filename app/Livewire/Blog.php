<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $featuredPost = Post::where('status', true)->where('is_featured', true)->latest()->first();
        $posts = Post::where('status', true)->latest()->paginate(10);
        $sidebarPosts = Post::where('status', true)->where('is_blog_sidebar', true)->latest()->take(10)->get();

        return view('livewire.blog', compact('featuredPost', 'posts', 'sidebarPosts'));
    }
}
