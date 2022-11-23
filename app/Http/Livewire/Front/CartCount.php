<?php

namespace App\Http\Livewire\Front;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;

    public $listeners = [
        'cartCountUpdated',
    ];

    public function mount()
    {
        $this->cartCount = Cart::instance('shopping')->count();
    }

    public function cartCountUpdated()
    {
        $this->cartCount = Cart::instance('shopping')->count();
    }

    public function render()
    {
        return view('livewire.front.cart-count');
    }
}
