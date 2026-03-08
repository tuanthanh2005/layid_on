<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utility;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function index()
    {
        $utilities = Utility::orderBy('order_index')->get();
        return view('admin.utilities.index', compact('utilities'));
    }

    public function create()
    {
        return view('admin.utilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'icon' => 'required|max:255',
        ]);

        $ut = new Utility();
        $ut->title = $request->title;
        $ut->description = $request->description;
        $ut->url = $request->url;
        $ut->icon = $request->icon;
        $ut->color = $request->color;
        $ut->status = $request->has('status');
        $ut->order_index = $request->order_index ?? 0;
        $ut->save();

        return redirect()->route('admin.utilities.index')->with('success', 'Thêm tiện ích thành công!');
    }

    public function edit(Utility $utility)
    {
        return view('admin.utilities.edit', compact('utility'));
    }

    public function update(Request $request, Utility $utility)
    {
        $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'icon' => 'required|max:255',
        ]);

        $utility->title = $request->title;
        $utility->description = $request->description;
        $utility->url = $request->url;
        $utility->icon = $request->icon;
        $utility->color = $request->color;
        $utility->status = $request->has('status');
        $utility->order_index = $request->order_index ?? 0;
        $utility->save();

        return redirect()->route('admin.utilities.index')->with('success', 'Cập nhật tiện ích thành công!');
    }

    public function destroy(Utility $utility)
    {
        $utility->delete();
        return redirect()->route('admin.utilities.index')->with('success', 'Đã xoá tiện ích!');
    }
}
