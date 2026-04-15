<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::latest();
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $posts = $query->paginate(15)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'content'          => 'nullable',
            'thumbnail'        => 'nullable|max:500',
            'thumbnail_file'   => 'nullable|image|max:2048',
            'icon'             => 'nullable|max:100',
            'color'            => 'nullable|max:50',
            'meta_title'       => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'status'           => 'boolean',
            'is_featured'      => 'boolean',
            'is_grid'          => 'boolean',
            'is_trending'      => 'boolean',
            'is_recommended'   => 'boolean',
            'is_interested'    => 'boolean',
            'is_blog_sidebar'  => 'boolean',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/posts', $filename, 'public_uploads');
            $data['thumbnail'] = '/uploads/posts/' . $filename;
        }

        $data['slug'] = $this->uniqueSlug($request->title);
        $data['status']          = $request->boolean('status', true);
        $data['is_featured']     = $request->boolean('is_featured');
        $data['is_grid']         = $request->boolean('is_grid');
        $data['is_trending']     = $request->boolean('is_trending');
        $data['is_recommended']  = $request->boolean('is_recommended');
        $data['is_interested']   = $request->boolean('is_interested');
        $data['is_blog_sidebar'] = $request->boolean('is_blog_sidebar');

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Đã tạo bài viết thành công!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'content'          => 'nullable',
            'thumbnail'        => 'nullable|max:500',
            'thumbnail_file'   => 'nullable|image|max:2048',
            'icon'             => 'nullable|max:100',
            'color'            => 'nullable|max:50',
            'meta_title'       => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/posts', $filename, 'public_uploads');
            $data['thumbnail'] = '/uploads/posts/' . $filename;
        }

        // Nếu đổi title, tạo lại slug
        if ($request->title !== $post->title) {
            $data['slug'] = $this->uniqueSlug($request->title, $post->id);
        }

        $data['status']          = $request->boolean('status');
        $data['is_featured']     = $request->boolean('is_featured');
        $data['is_grid']         = $request->boolean('is_grid');
        $data['is_trending']     = $request->boolean('is_trending');
        $data['is_recommended']  = $request->boolean('is_recommended');
        $data['is_interested']   = $request->boolean('is_interested');
        $data['is_blog_sidebar'] = $request->boolean('is_blog_sidebar');

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Đã cập nhật bài viết thành công!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Đã xóa bài viết!');
    }

    // -------------------------------------------------------
    private function uniqueSlug(string $title, int $excludeId = 0): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $excludeId)->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }
}
