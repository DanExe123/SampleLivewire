<div x-data="{ showModal: false }" 
    x-init="Livewire.on('closeModal', () => { showModal = false })">

     <!-- Button to Show Modal -->
     <button @click="showModal = true" class="px-4 py-2 bg-green-500 text-white rounded">
        Create User
    </button>

     <!-- Modal -->
     <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     class="fixed inset-0 flex items-center justify-center  bg-opacity-50">

     <div class="bg-white p-6 rounded-lg shadow-lg w-[800px] h-auto">
         <h2 class="text-lg font-semibold mb-4 text-center">Create User</h2>

         <!-- Livewire Form -->
         <form wire:submit.prevent="saveUser">
             <input type="text" wire:model="name" placeholder="Name" class="border p-2 w-full mb-3 rounded">
             @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

             <input type="email" wire:model="email" placeholder="Email" class="border p-2 w-full mb-3 rounded">
             @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

             <input type="password" wire:model="password" placeholder="Password" class="border p-2 w-full mb-3 rounded">
             @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

             <div class="flex justify-end space-x-3">
                 <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-500 text-white rounded">
                     Cancel
                 </button>
                 <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">
                     Save
                 </button>
             </div>
         </form>
     </div>
 </div>
</div>


<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('userCreated', function () {
            Swal.fire({
                title: 'Success!',
                text: 'User created successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
