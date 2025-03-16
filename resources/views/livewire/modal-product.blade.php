
    <div x-data="{ showModal: false }"  x-cloak
    x-init="Livewire.on('closeModal', () => { showModal = false })">

     <!-- Button to Show Modal -->
     <button @click="showModal = true" class="px-4 py-2 bg-black text-white rounded">
        Add Product
    </button>

     <!-- Modal -->
     <div x-show="showModal"
     x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="opacity-0 scale-90"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200 transform"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     class="fixed inset-0 flex items-center justify-center  bg-opacity-50">



     <div class="bg-white p-6 rounded-lg shadow-lg w-[800px] h-auto">
    <!-- Livewire Form -->
    <form wire:submit.prevent="saveProduct">
        <input type="text" wire:model="name" placeholder="Product Name" class="border p-2 w-full mb-3 rounded">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

          <!-- Category Selection -->
          <label class=" text-gray-500 text-xs ml-2">Select Category</label>
          <select wire:model="category_id" class="border p-2 w-full mb-3 rounded">
              <option value="">Select a Category</option>
              @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
          </select>
  
          <!-- Create New Category -->
          <div class="flex space-x-2">
              <input type="text" wire:model="newCategory" placeholder="New Category" class="border p-2 w-full mb-3 rounded">
              <button type="button" wire:click="saveCategory" class="bg-blue-500 text-white px-4 py-2 h-10 rounded">Add</button>
          </div>
          @if (session()->has('categoryMessage'))
              <div class="text-green-600 text-sm">{{ session('categoryMessage') }}</div>
          @endif
          @error('newCategory') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

          
        <!-- Size Selection -->
            <label class="text-gray-500 text-xs ml-2">Select Size</label>
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach(['XS', 'S', 'M', 'L', 'XL', '2XL', 'None'] as $sizeOption)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="size" value="{{ $sizeOption }}" class="form-checkbox text-blue-600">
                        <span class="text-gray-700">{{ $sizeOption }}</span>
                    </label>
                @endforeach
            </div>
            @error('size') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        @error('size') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        @error('size.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror



        <input type="number" wire:model="price" placeholder="Price" class="border p-2 w-full mb-3 rounded">
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <input type="number" wire:model="stock" placeholder="Stock Quantity" class="border p-2 w-full mb-3 rounded">
        @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <textarea wire:model="description" placeholder="Description" class="border p-2 w-full mb-3 rounded"></textarea>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


       
        <input type="file" wire:model="image" class="border p-2 w-full mb-3 rounded" multiple>

        <div wire:loading wire:target="image">
            <span class="loading loading-spinner loading-md">Uploading...</span>
            </div>

        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <div class="flex justify-end space-x-3">
           
            <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-900 text-white rounded">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                Save
            </button>
        </div>
    </form>
     </div>

      <style>
    [x-cloak] { display: none !important; }
    </style>    
 </div>
</div>

               
  

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('productCreated', function () {
            Swal.fire({
                title: 'Success!',
                text: 'User created successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

