<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class EditProduct extends Component
{
    use WithFileUploads;

    public $productId, $name, $category, $price, $stock, $description, $image, $status, $newImage;

    public function mount($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->description = $product->description;
        $this->image = $product->image;
        $this->status = $product->status;
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,shipped',
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($this->productId);

        // Handle image upload if a new image is selected
        if ($this->newImage) {
            $imagePath = $this->newImage->store('product-images', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
            'status' => $this->status,
            'image' => $product->image, 
        ]);

       $this->dispatch('success');
        return redirect()->route('dashboard'); // Change this to your product list route
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
