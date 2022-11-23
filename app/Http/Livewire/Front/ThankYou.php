<?php

namespace App\Http\Livewire\Front;

use App\Models\Order;
use Livewire\Component;

class ThankYou extends Component
{
    //  show order details on thank you page

    public $order;

    public function mount($order)
    {
        $this->order = Order::findOrFail($order);
    }

    public function render()
    {
        return view('livewire.front.thank-you');
    }
}
