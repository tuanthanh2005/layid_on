<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SocialOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Orders for AI Accounts
        $orders = $user->orders()->latest()->paginate(10, ['*'], 'orders_page');
        
        // Orders for Social Buff services
        $socialOrders = SocialOrder::with('server.service')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10, ['*'], 'social_page');
            
        return view('orders.index', compact('orders', 'socialOrders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
