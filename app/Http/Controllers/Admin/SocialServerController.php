<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialServer;
use App\Models\SocialService;
use Illuminate\Http\Request;

class SocialServerController extends Controller
{
    public function index()
    {
        $servers = SocialServer::with('service')->get();
        return view('admin.social-servers.index', compact('servers'));
    }

    public function create()
    {
        $services = SocialService::all();
        return view('admin.social-servers.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'social_service_id' => 'required|exists:social_services,id',
            'name' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric|min:0',
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'required|integer|min:1',
        ]);

        SocialServer::create([
            'social_service_id' => $request->social_service_id,
            'name' => $request->name,
            'price_per_unit' => $request->price_per_unit,
            'min_quantity' => $request->min_quantity,
            'max_quantity' => $request->max_quantity,
            'description' => $request->description,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.social-servers.index')->with('success', 'Server đã được tạo thành công.');
    }

    public function edit(SocialServer $socialServer)
    {
        $services = SocialService::all();
        return view('admin.social-servers.edit', compact('socialServer', 'services'));
    }

    public function update(Request $request, SocialServer $socialServer)
    {
        $request->validate([
            'social_service_id' => 'required|exists:social_services,id',
            'name' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric|min:0',
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'required|integer|min:1',
        ]);

        $socialServer->update([
            'social_service_id' => $request->social_service_id,
            'name' => $request->name,
            'price_per_unit' => $request->price_per_unit,
            'min_quantity' => $request->min_quantity,
            'max_quantity' => $request->max_quantity,
            'description' => $request->description,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.social-servers.index')->with('success', 'Server đã được cập nhật.');
    }

    public function destroy(SocialServer $socialServer)
    {
        $socialServer->delete();
        return redirect()->route('admin.social-servers.index')->with('success', 'Server đã bị xóa.');
    }
}
