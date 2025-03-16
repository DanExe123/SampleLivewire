<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use App\Models\Product; 
use Livewire\Component;
use App\Models\Category;

class ModalProduct extends Component
{

    use WithFileUploads;

    public $name, $price, $stock, $description, $imagePaths, $category_id, $size = [];
    public $image = [];
    public $categories = []; // Store categories list
    public $category = null; 
    public $newCategory = ''; // Declare newCategory

    protected $listeners = ['refreshTable' => '$refresh'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:1024', // Max 1MB
        'category_id' => 'required|exists:categories,id',
        'newCategory' => 'nullable|string|unique:categories,name|max:255',
        'size' => 'required|array|min:1',
        'size.*' => 'string|in:XS,S,M,L,XL,2XL,None',
    ];



    public function mount()
    {
        $this->categories = Category::all(); // Fetch all categories
    }

    public function saveCategory()
    {
        $this->validate([
            'newCategory' => 'required|string|unique:categories,name|max:255',
        ]);

        $category = Category::create(['name' => $this->newCategory]);

        $this->categories = Category::all(); // Reload categories
        $this->category_id = $category->id; // Auto-select new category
        $this->newCategory = ''; // Clear input

        session()->flash('categoryMessage', 'Category added successfully.');
    }




        public function saveProduct()
        {
    
            
            $this->validate([
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);

            $imagePaths = [];

            foreach ($this->image as $image) {
                $imagePaths[] = $image->store('product-images', 'public'); 
            }


            Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'stock' => $this->stock,
                'description' => $this->description,
                'image' => json_encode($imagePaths),
                'status' => 'pending',
                'category_id' => $this->category_id,
                'size' => json_encode($this->size),
            ]);

      

        // Reset form
        $this->reset(['name', 'category', 'price', 'stock', 'description', 'image','size',]);
        $this->dispatch('refreshTable');
        $this->dispatch('productCreated');
        $this->dispatch('closeModal');
    
    }


    



    public function render()
    {
        return view('livewire.modal-product');
    }
}
