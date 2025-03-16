<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCount extends Component
{
    public $orderCount;
    public $shippedCount;

    public function mount()
    {
        $this->orderCount = Product::count();
        $this->shippedCount = Product::where('status', 'shipped')->count();
    }

    public function render()
    {
        return view('livewire.product-count');
    }
}

