<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('admin.menus.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string',
            'order' => 'integer',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu đã được tạo!');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get();
        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string',
            'order' => 'integer',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu đã được cập nhật!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu đã được xóa!');
    }

    public function reorder(Request $request)
    {
        $list = json_decode($request->input('list'), true);
        $this->updateMenuHierarchy($list);

        return response()->json(['status' => 'success']);
    }

    protected function updateMenuHierarchy($list, $parentId = null)
    {
        foreach ($list as $index => $item) {
            $menu = Menu::find($item['id']);
            if ($menu) {
                $menu->update([
                    'parent_id' => $parentId,
                    'order' => $index + 1
                ]);

                if (isset($item['children'])) {
                    $this->updateMenuHierarchy($item['children'], $menu->id);
                }
            }
        }
    }
}
