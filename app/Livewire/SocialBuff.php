<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SocialService;
use App\Models\SocialServer;
use App\Models\SocialOrder;
use Illuminate\Support\Facades\Auth;

class SocialBuff extends Component
{
    public $service;
    public $servers;
    
    // Form fields
    public $serverId;
    public $link;
    public $quantity = 0;
    public $note;
    
    // UI States
    public $totalPrice = 0;
    public $showPaymentModal = false;
    public $currentOrder = null;
    public $countdown = 5;
    public $isPaid = false;

    public function mount($slug)
    {
        $this->service = SocialService::where('slug', $slug)->where('status', true)->firstOrFail();
        $this->servers = $this->service->servers()->where('status', true)->get();
        if ($this->servers->isNotEmpty()) {
            $this->serverId = $this->servers->first()->id;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['serverId', 'quantity'])) {
            $this->calculatePrice();
        }
    }

    public function calculatePrice()
    {
        if ($this->serverId && $this->quantity > 0) {
            $server = SocialServer::find($this->serverId);
            if ($server) {
                $this->totalPrice = $server->price_per_unit * $this->quantity;
            }
        } else {
            $this->totalPrice = 0;
        }
    }

    public function createOrder()
    {
        $this->validate([
            'serverId' => 'required|exists:social_servers,id',
            'link' => 'required|url',
            'quantity' => 'required|numeric|min:1',
        ]);

        $server = SocialServer::find($this->serverId);
        
        if ($this->quantity < $server->min_quantity) {
            $this->addError('quantity', "Số lượng tối thiểu là {$server->min_quantity}");
            return;
        }

        if ($this->quantity > $server->max_quantity) {
            $this->addError('quantity', "Số lượng tối đa là {$server->max_quantity}");
            return;
        }

        $this->currentOrder = SocialOrder::create([
            'user_id' => Auth::id(),
            'social_server_id' => $this->serverId,
            'link' => $this->link,
            'quantity' => $this->quantity,
            'total_price' => $this->totalPrice,
            'note' => $this->note,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        $this->showPaymentModal = true;
    }

    public function confirmPayment()
    {
        if ($this->currentOrder) {
            $this->currentOrder->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);
            
            $this->isPaid = true;
            $this->dispatch('start-countdown');
        }
    }

    public function render()
    {
        return view('livewire.social-buff');
    }
}
