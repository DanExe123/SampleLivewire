<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;    
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Log;

class Cartpage extends Component
{
    
    use WithPagination;

    #[Url(history: true)]
    public $perPage = 5;
    public $selectedSizes = [];
    protected $listeners = [
        'updateLocation' => 'updateLocation',
        'addToCart',
        'cartUpdated' => '$refresh'
    ]; 
    public $cartCount = 0;
    public $latitude;
    public $longitude;
    public $paymentMethod;
    public $deliveryMethod;




    public function updateLocation($lat, $lng)
{
    $this->latitude = $lat;
    $this->longitude = $lng;

    Log::info("Location updated: Latitude - $lat, Longitude - $lng");
}


    

   public function mount()
   {
       // Check if the user is not a customer
       if (!Auth::check() || !Auth::user()->hasRole('customer')) {
           abort(404); // Return a 404 Not Found response
       }

       $this->cartItems = Cart::with('product')->get();

        // Initialize selected sizes
        foreach ($this->cartItems as $cart) {
            $this->selectedSizes[$cart->id] = $cart->selectedSize ?? null;
   }
    }

   public function selectSize($cartId, $size)
   {
       $this->selectedSizes[$cartId] = $size;

       // Optional: Save to database
       $cart = Cart::find($cartId);
       if ($cart) {
           $cart->update(['selectedSize' => $size]);
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

    
    
        // submit order 
        public function submitOrder()
    {
        $cartItems = Cart::where('user_id', Auth::id())->where('status', 'pending')->get();

        if ($cartItems->isEmpty()) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Cart Empty!',
                'text' => 'Your cart is empty. Please add items before placing an order.',
            ]);
            return;
        }

        if (empty($this->latitude) || empty($this->longitude)) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Location Required!',
                'text' => 'Please select your location before placing an order.',
            ]);
            return;
        }

        foreach ($cartItems as $cart) {
            $cart->update([
                'status' => 'ordered',
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);
        }

        Log::info("Order placed with location: Latitude - {$this->latitude}, Longitude - {$this->longitude}");

        // Show success notification
        $this->dispatch('swal');

        $this->dispatch('cartUpdated'); // Refresh cart
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
