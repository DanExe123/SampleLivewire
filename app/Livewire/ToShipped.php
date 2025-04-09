<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\CustomerPurchase;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class ToShipped extends Component
{

    public $purchases;

    public function mount()
    {
        //$this->loadPurchases();
    }


    


    public function render()
    {
        $customerPurchases = CustomerPurchase::whereHas('cart', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('cart.product')->orderBy('created_at', 'desc')->get();

        return view('livewire.to-shipped', [
            'customerPurchases' => $customerPurchases,
        ]);
    }
}
