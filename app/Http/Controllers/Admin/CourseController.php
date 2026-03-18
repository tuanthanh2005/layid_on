<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('order')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $thumbnail = $request->thumbnail;

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/courses', $filename, 'public_uploads');
            $thumbnail = '/uploads/courses/' . $filename;
        }

        Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $thumbnail,
            'level' => $request->level,
            'duration' => $request->duration,
            'status' => $request->has('status'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được tạo.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $thumbnail = $request->thumbnail;

        if ($request->hasFile('thumbnail_file')) {
            $file = $request->file('thumbnail_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/courses', $filename, 'public_uploads');
            $thumbnail = '/uploads/courses/' . $filename;
        }

        $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $thumbnail,
            'level' => $request->level,
            'duration' => $request->duration,
            'status' => $request->has('status'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được cập nhật.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã bị xóa.');
    }
}
