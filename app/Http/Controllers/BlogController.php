<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Hiển thị trang danh sách bài viết blog.
     */
    public function index(Request $request)
    {
        $query = Post::where('status', true)->latest();

        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }

        $posts = $query->paginate(9)->withQueryString();

        return view('blog.index', compact('posts'));
    }

    /**
     * Hiển thị chi tiết một bài viết.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', true)->firstOrFail();

        // Tăng lượt xem
        $post->increment('views');

        // Bài viết liên quan (lấy 4 bài mới nhất, trừ bài hiện tại)
        $related = Post::where('status', true)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
