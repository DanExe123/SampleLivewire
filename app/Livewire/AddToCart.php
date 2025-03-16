<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
class AddToCart extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 4;
    public $category_id = null;

    protected $listeners = ['cartUpdated' => '$refresh']; // Refresh when cart updates

    
    #[On('cartUpdated')] // This listens for the event in Livewire v3
    public function refreshCart()
    {
        $this->dispatch('cartUpdated');
    }


    public function updatingCategoryId()
    {
        $this->resetPage();
    }


    //public function mount()
    //{
        // Test event dispatching (This should trigger a toast on page load)
       // $this->dispatch('cartAdded', 'Livewire event test');
     //   $this->categories = Category::all(); // Fetch all categories
   // }


    public function addToCart($productId)
    {
        $product = Product::find($productId);
    
        if (!Auth::user()->can('add to cart')) {
            return session()->flash('error', 'You do not have permission to add items to the cart.');
        }
    
        // Check if the product already exists in the cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->where('status', 'pending')
            ->first();
    
        if ($cartItem) {
            // If exists, increment quantity by 1
            $cartItem->increment('quantity');
        } else {
            // If not, create a new cart entry with quantity = 1
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
                'status' => 'pending'
            ]);
        }
    
        // Dispatch event to update cart count
        $this->dispatch('cartUpdated');
    
         // Dispatch toast event
        $this->dispatch('cartAdded', 'Product added to cart successfully!');
 
    }


    
    
    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        $products = $query->paginate($this->perPage);

        return view('livewire.add-to-cart', [
            'products' => $products,
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
