<?php

namespace App\Livewire;

use Livewire\Component;



class ContactUs extends Component
{

    public $name, $email, $subject, $message;   // shortcut 


    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Store in database (optional)
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);


        // Reset form
        $this->reset();

        // Success message
        session()->flash('success', 'Your message has been sent successfully!');
    }
    
    public function render()
    {
        return view('livewire.contact-us')->layout('layouts.app');
    }
}


