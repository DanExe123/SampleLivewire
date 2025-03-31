<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdersManagement extends Component
{
    use WithPagination, WithFileUploads;

    #[Url(history: true)]
    public $search = '';
    #[Url(history: true)]
    public $perPage = 5;
    protected $listeners = ['refreshProducts' => '$refresh'];


    public function mount()
    {
        // Check if the user is not a customer
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(404); // Return a 404 Not Found response
        }
    }
    


    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.orders-management', [
            'products' => Product::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
        ])->layout('layouts.app');
    }                                                                                   
}
