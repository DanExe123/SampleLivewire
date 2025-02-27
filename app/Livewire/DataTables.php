<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{

    use WithPagination;

    public $search = '';   // update user.php
    public $perPage = 5;


    public function render()
    {
        return view('livewire.data-tables',
    [
        'users' => User::search($this->search)->paginate($this->perPage)
    ]);

    }
}
