<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class CustomerAccount extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when searching
    }

    public function deleteCustomer($customerId)
    {
        $customer = User::findOrFail($customerId);
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
            ->paginate(10);

        return view('livewire.customer-account', [
            'customers' => $customers
        ]);
    }
}
