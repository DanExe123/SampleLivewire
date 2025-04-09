<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\CustomerPurchase;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Orders extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $perPage = 5;

    public $dropdownOpen = null;
    public $statusMessage = ''; // For success toast
    public $orderedCount;
    public $deliveredCount;
    protected $listeners = ['refreshProducts' => '$refresh'];


    public function mount()
    {
        $this->updateStatusCounts();
    }

    public function updateStatus($purchaseId, $status)
    {
        // Get the customer purchase record
        $purchase = CustomerPurchase::find($purchaseId);
    
        if ($purchase) {
            // Update the status in the related cart table
            $purchase->cart->status = $status; // Assuming 'cart' is the relationship name
            $purchase->cart->save(); // Save the cart with the updated status
            
            session()->flash('message', 'Order status updated successfully!');
        }
    }

    // Method to count ordered and delivered products
    public function updateStatusCounts()
    {
        // Count the number of ordered products
        $this->orderedCount = CustomerPurchase::whereHas('cart', function ($query) {
            $query->where('status', 'Ordered');
        })->count();
    
        // Count the number of delivered products
        $this->deliveredCount = CustomerPurchase::whereHas('cart', function ($query) {
            $query->where('status', 'Delivered');
        })->count();
    }
    
    

    public function render()
    {
        // Get customer purchases, excluding the admin (user_id != 1)
        $customerPurchases = CustomerPurchase::whereHas('cart', function ($query) {
            $query->where('user_id', '!=', 1); // Exclude admin
        })->with('cart.product.category') // Load category too
          ->orderBy('created_at', 'desc')
          ->get();
    
        // Log for debugging
        Log::info('Customer Purchases: ', [$customerPurchases]);
    
        return view('livewire.orders', [
            'customerPurchases' => $customerPurchases,
        ]);
    }
    

}