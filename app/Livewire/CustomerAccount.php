<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class CustomerAccount extends Component
{
    use WithPagination;
  

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 4;


    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when searching
    }



    public function deleteCustomer(User $customer)
    {
      
        $customer->delete();

        session()->flash('message', 'Customer deleted successfully.');
    }
    

   
    public function render()
    {
        $customers = User::whereHas('roles', function ($query) {
                $query->where('name', 'customer');
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.customer-account', [
            'customers' => $customers
        ]);
    }
}
