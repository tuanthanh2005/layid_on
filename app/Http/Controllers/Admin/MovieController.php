<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(20);
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        $movie = new Movie();
        return view('admin.movies.create', compact('movie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $thumbnail = $request->thumbnail;
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/movies', $filename, 'public_uploads');
            $thumbnail = '/uploads/movies/' . $filename;
        }

        Movie::create([
            'title'           => $request->title,
            'slug'            => Str::slug($request->title) . '-' . uniqid(),
            'original_title'  => $request->original_title,
            'genre'           => $request->genre,
            'country'         => $request->country,
            'release_year'    => $request->release_year,
            'director'        => $request->director,
            'duration_text'   => $request->duration_text,
            'rating'          => $request->rating ?? 0,
            'rating_label'    => $request->rating_label,
            'thumbnail'       => $thumbnail,
            'icon'            => $request->icon,
            'color'           => $request->color,
            'summary'         => $request->summary,
            'content'         => $request->input('content'),
            'trailer_url'     => $request->trailer_url,
            'tags'            => $request->tags,
            'meta_title'      => $request->meta_title,
            'meta_description'=> $request->meta_description,
            'status'          => $request->has('status'),
            'is_featured'     => $request->has('is_featured'),
            'is_interested'   => $request->has('is_interested'),
            'is_trending'     => $request->has('is_trending'),
            'is_main_featured'=> $request->has('is_main_featured'),
            'order'           => $request->order ?? 0,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Review phim đã được tạo thành công!');
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $thumbnail = $request->thumbnail ?: $movie->thumbnail;
        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/movies', $filename, 'public_uploads');
            $thumbnail = '/uploads/movies/' . $filename;
        }

        $movie->update([
            'title'           => $request->title,
            'original_title'  => $request->original_title,
            'genre'           => $request->genre,
            'country'         => $request->country,
            'release_year'    => $request->release_year,
            'director'        => $request->director,
            'duration_text'   => $request->duration_text,
            'rating'          => $request->rating ?? 0,
            'rating_label'    => $request->rating_label,
            'thumbnail'       => $thumbnail,
            'icon'            => $request->icon,
            'color'           => $request->color,
            'summary'         => $request->summary,
            'content'         => $request->input('content'),
            'trailer_url'     => $request->trailer_url,
            'tags'            => $request->tags,
            'meta_title'      => $request->meta_title,
            'meta_description'=> $request->meta_description,
            'status'          => $request->has('status'),
            'is_featured'     => $request->has('is_featured'),
            'is_interested'   => $request->has('is_interested'),
            'is_trending'     => $request->has('is_trending'),
            'is_main_featured'=> $request->has('is_main_featured'),
            'order'           => $request->order ?? 0,
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Review phim đã được cập nhật!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Đã xóa review phim.');
    }
}
