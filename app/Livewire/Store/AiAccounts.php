<?php

namespace App\Livewire\Store;

use Livewire\Component;
use Livewire\WithPagination;

class AiAccounts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $products = \App\Models\Product::where('status', true)->orderBy('order_index')->paginate(40);
        return view('livewire.store.ai-accounts', compact('products'));
    }
}
