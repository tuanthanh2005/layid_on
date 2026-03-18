<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialServiceController extends Controller
{
    public function index()
    {
        $services = SocialService::orderBy('order')->get();
        return view('admin.social-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.social-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        SocialService::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
            'status' => $request->has('status'),
            'show_on_home' => $request->has('show_on_home'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.social-services.index')->with('success', 'Dịch vụ đã được tạo thành công.');
    }

    public function edit(SocialService $socialService)
    {
        return view('admin.social-services.edit', compact('socialService'));
    }

    public function update(Request $request, SocialService $socialService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $socialService->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
            'status' => $request->has('status'),
            'show_on_home' => $request->has('show_on_home'),
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.social-services.index')->with('success', 'Dịch vụ đã được cập nhật.');
    }

    public function destroy(SocialService $socialService)
    {
        $socialService->delete();
        return redirect()->route('admin.social-services.index')->with('success', 'Dịch vụ đã bị xóa.');
    }
}
