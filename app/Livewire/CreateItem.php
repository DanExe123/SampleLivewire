<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Item; // <-- Add this line

class CreateItem extends Component
{
    public $name, $description;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
    ];

    public function saveItem()
    {
        $this->validate();

        Item::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // Clear input fields
        $this->reset(['name', 'description']);

        // Send success message
        session()->flash('message', 'Item created successfully!');
    }

    public function render()
    {
        return view('livewire.create-item');
    }
}