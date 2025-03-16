<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name, $email, $password;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function saveUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Reset fields & hide modal
        $this->reset(['name', 'email', 'password', 'showModal']);

        // Emit event for SweetAlert2
        $this->dispatch('userCreated');
        $this->dispatch('closeModal');
       // dd('closeModal dispatched'); // This should stop execution and show in Laravel Debug

    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
