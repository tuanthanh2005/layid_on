<?php

namespace App\Livewire\Store;

use Livewire\Component;

class AiAccounts extends Component
{
    public function render()
    {
        $products = \App\Models\Product::where('status', true)->orderBy('order_index')->get();
        return view('livewire.store.ai-accounts', compact('products'));
    }
}
