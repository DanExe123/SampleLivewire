<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Spatie\Permission\Traits\HasRoles;

class Login extends Component
{
    public $email, $password, $remember;
    

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $user = Auth::user();
            
            // Debugging: Log the role of the authenticated user
            \Log::info('User Logged In: ', ['email' => $user->email, 'roles' => $user->getRoleNames()]);
    
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard'); 
            } elseif ($user->hasRole('customer')) {
                return redirect()->route('WelcomeChromehearts'); 
            } else {
                return redirect()->route('home'); 
            }
        } 
    
        session()->flash('error', 'Invalid email or password.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
