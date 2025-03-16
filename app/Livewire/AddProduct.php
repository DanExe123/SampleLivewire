<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\Url;

class AddProduct extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 5;

    protected $listeners = ['refreshProducts' => '$refresh'];

  

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.add-product', [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
        ])->layout('layouts.app');
    }
    

    
    
    public function delete(Product $product)
    {   
      //  $this->authorize('delete', $user);
        $product->delete();
    }
    


}
