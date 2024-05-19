<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NavigationMenuGuest extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];
    public function updateCartCount()
    {
        $cart = Session::get('cart', []);
        $this->count = array_sum(array_column($cart, 'quantity'));
    }
    public function render()
    {
        return view('livewire.navigation-menu-guest');
    }
}
