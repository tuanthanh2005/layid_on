<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $q = '';
    protected $queryString = ['q' => ['except' => '']];

    public function mount() {}

    public function render()
    {
        $aiProducts = \App\Models\Product::where('status', true)->orderBy('order_index')->take(24)->get();

        return view('livewire.home', compact(
            'aiProducts'
        ));
    }
}
