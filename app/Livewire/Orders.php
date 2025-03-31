<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\CustomerPurchase;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
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
        $purchase = CustomerPurchase::find($purchaseId);

        if ($purchase) {
            $purchase->status = $status;
            $purchase->save();
            session()->flash('message', 'Order status updated successfully!');
        }
    }
    
    public function updateStatusCounts()
    {
        $this->orderedCount = Product::where('status', 'Ordered')->count();
        $this->deliveredCount = Product::where('status', 'Delivered')->count();
    }
    

    public function render()
{
    $customerPurchases = CustomerPurchase::whereHas('cart', function ($query) {
        $query->where('user_id', Auth::id());
    })->with('cart.product')->orderBy('created_at', 'desc')->get();

    return view('livewire.orders', [
        'customerPurchases' => $customerPurchases,
    ]);
}

}