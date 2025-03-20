<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Cart;

class CartSizeSelector extends Component
{
    public $cart;
    public $selectedSize;

    public function mount(Cart $cart)
    {
        $this->cart = $cart;
        $this->selectedSize = $cart->selected_size;
    }

    public function selectSize($size)
    {
        $this->cart->update(['selected_size' => $size]);
        $this->selectedSize = $size;
    }

    public function render()
    {
        return view('livewire.cart-size-selector', [
            'cart' => $this->cart,
        ]);
    }
}