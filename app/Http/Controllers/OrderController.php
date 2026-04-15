<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProxyOrder;
use App\Models\SocialOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
