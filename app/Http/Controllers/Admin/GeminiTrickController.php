<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeminiTrick;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeminiTrickController extends Controller
{
    public function index()
    {
        $tricks = GeminiTrick::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.gemini-tricks.index', compact('tricks'));
    }

    public function create()
    {
        return view('admin.gemini-tricks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $trick = new GeminiTrick();
        $trick->title = $request->title;
        $trick->slug = Str::slug($request->title) . '-' . uniqid();
        $trick->content = $request->input('content');
        
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/gemini', $filename, 'public_uploads');
            $trick->image = '/uploads/gemini/' . $filename;
        }

        $trick->status = $request->has('status');
        $trick->order = $request->order ?? 0;

        $trick->save();

        return redirect()->route('admin.gemini-tricks.index')->with('success', 'Thủ thuật mới đã được tạo!');
    }

    public function edit(GeminiTrick $geminiTrick)
    {
        return view('admin.gemini-tricks.edit', compact('geminiTrick'));
    }

    public function update(Request $request, GeminiTrick $geminiTrick)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($request->title !== $geminiTrick->title) {
            $geminiTrick->slug = Str::slug($request->title) . '-' . uniqid();
        }
        $geminiTrick->title = $request->title;
        $geminiTrick->content = $request->input('content');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::slug($originalName) . '.' . $extension;
            $file->storeAs('uploads/gemini', $filename, 'public_uploads');
            $geminiTrick->image = '/uploads/gemini/' . $filename;
        }

        $geminiTrick->status = $request->has('status');
        $geminiTrick->order = $request->order ?? 0;

        $geminiTrick->save();

        return redirect()->route('admin.gemini-tricks.index')->with('success', 'Đã cập nhật thủ thuật!');
    }

    public function destroy(GeminiTrick $geminiTrick)
    {
        $geminiTrick->delete();
        return redirect()->route('admin.gemini-tricks.index')->with('success', 'Đã xóa thủ thuật!');
    }
}
