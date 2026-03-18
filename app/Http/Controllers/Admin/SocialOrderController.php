<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialOrder;
use Illuminate\Http\Request;

class SocialOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = SocialOrder::with(['server.service', 'user'])->latest()->paginate(20);
        return view('admin.social-orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialOrder $socialOrder)
    {
        return view('admin.social-orders.show', compact('socialOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialOrder $socialOrder)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|string|in:unpaid,paid',
        ]);

        $socialOrder->update($request->only('status', 'payment_status'));

        return back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialOrder $socialOrder)
    {
        $socialOrder->delete();
        return redirect()->route('admin.social-orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }
}
