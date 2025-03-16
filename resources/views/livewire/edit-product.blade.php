<div>
    @livewire('product-count')
    <section class="mt-10">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        
          
            <form wire:submit.prevent="updateProduct">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                <div class="mb-3">
                    <label class="block font-medium">Product Name</label>
                    <input type="text" wire:model="name" class="w-full border rounded p-2" required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <div class="mb-3">
                    <label class="block font-medium">Category</label>
                    <input type="text" wire:model="category" class="w-full border rounded p-2" required>
                    @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <div class="mb-3">
                    <label class="block font-medium">Price</label>
                    <input type="number" wire:model="price" class="w-full border rounded p-2" required>
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <div class="mb-3">
                    <label class="block font-medium">Stock</label>
                    <input type="number" wire:model="stock" class="w-full border rounded p-2"required>
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <div class="mb-3">
                    <label class="block font-medium">Description</label>
                    <textarea wire:model="description" class="w-full border rounded p-2"required></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <!-- Status Dropdown -->
                <div class="mb-3">
                    <label class="block font-medium">Status</label>
                    <select wire:model="status" class="w-full border rounded p-2">
                        <option value="pending">Pending</option>
                        <option value="shipped">Shipped</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        
                <!-- Image Upload -->
                <div class="mb-3">
                    <label class="block font-medium">Product Image</label>
                    
                    @if(!empty($newImage) && is_array($newImage))
                    @foreach($newImage as $image)
                        <img src="{{ $image->temporaryUrl() }}" 
                             alt="Product Image" 
                             class="w-10 h-10 rounded cursor-pointer hover:scale-110 transition">
                    @endforeach
                @elseif($newImage) 
                    <img src="{{ $newImage->temporaryUrl() }}" 
                         alt="Product Image" 
                         class="w-10 h-10 rounded cursor-pointer hover:scale-110 transition"required>
                @endif
                
                
                    <input type="file" wire:model="newImage" class="w-full border rounded p-2" required>
                    @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                </div>

                <div wire:loading wire:target="newImage">
               Uploading...
                </div>

                <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded w-64">
                    Update Product
                </button>
            </div>
            </form>
        </div>
</div>



          

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    Livewire.on('swal:success', function (data) {
        Swal.fire({
            title: data.title,
            text: data.text,
            icon: data.icon,
            confirmButtonText: 'OK'
        });
    });
});
</script>