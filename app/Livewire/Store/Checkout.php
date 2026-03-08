<?php

namespace App\Livewire\Store;

use Livewire\Component;
use App\Models\Product;

class Checkout extends Component
{
    public $product;
    public $step = 1; // 1: Info, 2: Payment, 3: Success
    public $name, $email, $whatsapp;
    public $is_paid = false;
    public $order_code;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    public function nextStep()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        $this->order_code = 'LAY' . strtoupper(substr(uniqid(), -5));
        $this->step = 2;
    }

    public function confirmPayment()
    {
        if (!$this->is_paid) {
            $this->addError('is_paid', 'Vui lòng tích xác nhận đã chuyển khoản.');
            return;
        }

        // Save Order to Database
        $order = new \App\Models\Order();
        $order->user_id = auth()->id();
        $order->order_number = $this->order_code;
        $order->total_amount = $this->product->price;
        $order->status = 'pending';
        $order->payment_method = 'VietQR';
        $order->notes = "Sản phẩm: {$this->product->name} | Email nhận: {$this->email} | WhatsApp: {$this->whatsapp}";
        $order->save();

        $this->step = 3;
    }

    public function render()
    {
        return view('livewire.store.checkout')->layout('layouts.app');
    }
}
