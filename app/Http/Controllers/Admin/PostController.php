<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title) . '-' . uniqid();
        $post->content = $request->input('content');
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/posts', $filename, 'public_uploads');
            $post->thumbnail = '/uploads/posts/' . $filename;
        } else {
            $post->thumbnail = $request->thumbnail;
        }
        $post->icon = $request->icon;
        $post->color = $request->color;
        
        $post->meta_title = $request->meta_title ?? $request->title;
        $post->meta_description = $request->meta_description;

        $post->status = $request->has('status');
        $post->is_featured = $request->has('is_featured');
        $post->is_grid = $request->has('is_grid');
        $post->is_trending = $request->has('is_trending');
        $post->is_recommended = $request->has('is_recommended');
        $post->is_interested = $request->has('is_interested');
        $post->is_video = $request->has('is_video');

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo thành công!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable',
        ]);

        if ($request->title !== $post->title) {
            $post->slug = Str::slug($request->title) . '-' . uniqid();
        }
        $post->title = $request->title;
        $post->content = $request->input('content');
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/posts', $filename, 'public_uploads');
            $post->thumbnail = '/uploads/posts/' . $filename;
        } elseif ($request->filled('thumbnail')) {
            $post->thumbnail = $request->thumbnail;
        }
        $post->icon = $request->icon;
        $post->color = $request->color;
        
        $post->meta_title = $request->meta_title ?? $request->title;
        $post->meta_description = $request->meta_description;

        $post->status = $request->has('status');
        $post->is_featured = $request->has('is_featured');
        $post->is_grid = $request->has('is_grid');
        $post->is_trending = $request->has('is_trending');
        $post->is_recommended = $request->has('is_recommended');
        $post->is_interested = $request->has('is_interested');
        $post->is_video = $request->has('is_video');

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã bị xóa!');
    }
}
