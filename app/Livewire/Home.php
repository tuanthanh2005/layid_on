<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $q = '';
    protected $queryString = ['q' => ['except' => '']];

    public function mount() {}

    public function render()
    {
        $aiProducts = \App\Models\Product::where('status', true)
            ->where('name', 'like', '%' . $this->q . '%')
            ->orderBy('order_index')
            ->paginate(40);

        return view('livewire.home', compact(
            'aiProducts'
        ));
    }
}
