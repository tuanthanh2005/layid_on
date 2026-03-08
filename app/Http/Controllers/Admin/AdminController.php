<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = \App\Models\Order::count();
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
        $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total_amount');
        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        $totalUsers = \App\Models\User::count();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'totalRevenue', 
            'recentOrders',
            'totalUsers'
        ));
    }
}
