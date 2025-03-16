<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount(); // Load initial cart count
    }

    public function updateCartCount()
    {
        $this->cartCount = Cart::where('user_id', Auth::id())->where('status', 'pending')->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
