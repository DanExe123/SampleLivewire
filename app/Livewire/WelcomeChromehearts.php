<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WelcomeChromehearts extends Component
{

    public function mount()
    {
        // Check if the user is not a customer
        if (!Auth::check() || !Auth::user()->hasRole('customer')) {
            abort(404); // Return a 404 Not Found response
        }
    }
    
    public function render()
    {
        return view('livewire.welcome-chromehearts');
    }
}
