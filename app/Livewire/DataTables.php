<?php

namespace App\Livewire;
use Livewire\Attributes\Url;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{

    use WithPagination;
    #[Url(history:true)]
    public $search = '';   // update user.php
    #[Url(history:true)]
    public $perPage = 5;
    #[Url(history:true)]
    public $admin = '';
    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';



    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }



    public function delete(User $user)
    {   
      //  $this->authorize('delete', $user);
        $user->delete();
    }
    


    public function render()
    {

        return view('livewire.data-tables', [

            'users' => User::search($this->search) // Search users based on the search input
               
            ->when($this->admin !== '', function ($query) { 
                    // Filter users based on the selected admin status
                    $query->where('is_admin', (int) $this->admin);
                })
                ->orderBy($this->sortBy,$this->sortDir)// sortby 
                ->paginate($this->perPage) // Paginate the results
        ]);
    
    


    }

}