<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;    
use Livewire\Attributes\Url;

class Cartpage extends Component
{
    
    use WithPagination;

    #[Url(history: true)]
    public $perPage = 5;

    protected $listeners = ['addToCart', 'cartUpdated' => '$refresh']; // Ensure it refreshes on update

    public $cartCount = 0;




   public function mount()
   {
       // Check if the user is not a customer
       if (!Auth::check() || !Auth::user()->hasRole('customer')) {
           abort(404); // Return a 404 Not Found response
       }
   }
   

    

    public function increaseQuantity($cartId)
    {
    $cartItem = Cart::find($cartId);
    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();

      
        $this->cartItems = Cart::all(); 
    }


    }
    public function decreaseQuantity($cartId)
    {
        $cart = Cart::find($cartId);

        if ($cart && $cart->quantity > 1) {
            $cart->decrement('quantity');
        }

        $this->dispatch('cartUpdated'); // Dispatch event to refresh UI
    }





    public function addToCart($productId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'You need to log in first.');
            return;
        }

        $product = Product::find($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'status' => 'pending'
            ],
            ['quantity' => 1]
        );

        $cart->increment('quantity'); // Increase quantity if already exists

        session()->flash('success', 'Product added to cart!');
    }



    public function delete($cartId)
    {
        $cart = Cart::find($cartId);
    
        if ($cart) {
            $cart->delete(); 
        }
    }
    


    
    public function render()
    {
        return view('livewire.cartpage', [
            'cartItems' => Cart::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->paginate($this->perPage),
        ]);
    }
    }
