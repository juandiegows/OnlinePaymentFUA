<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ShoppingCart extends Component
{
    public function render()
    {
        return view('livewire.shopping-cart');
    }
    public $cart = [];

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
    }

    public function clearCart()
    {
        Session::forget('cart');
        $this->dispatch('cartUpdated');
        $this->loadCart();
    }


}
