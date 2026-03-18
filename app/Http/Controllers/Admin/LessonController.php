<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::with('course');
        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }
        $lessons = $query->orderBy('order')->get();
        $courses = Course::all();
        return view('admin.lessons.index', compact('lessons', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'video_type' => 'required|in:youtube,driver,url',
        ]);

        Lesson::create([
            'course_id' => $request->input('course_id'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'video_url' => $request->input('video_url'),
            'video_type' => $request->input('video_type'),
            'content' => $request->input('content'),
            'order' => $request->input('order') ?? 0,
            'is_free' => $request->has('is_free'),
        ]);

        return redirect()->route('admin.lessons.index', ['course_id' => $request->course_id])->with('success', 'Bài học đã được thêm.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $lesson->update([
            'course_id' => $request->input('course_id'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'video_url' => $request->input('video_url'),
            'video_type' => $request->input('video_type'),
            'content' => $request->input('content'),
            'order' => $request->input('order') ?? 0,
            'is_free' => $request->has('is_free'),
        ]);

        return redirect()->route('admin.lessons.index', ['course_id' => $request->course_id])->with('success', 'Bài học đã được cập nhật.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('success', 'Bài học đã bị xóa.');
    }
}
