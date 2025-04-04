<div>
    <div x-data="{ open: false }" class="relative">
        <!-- Overlay when dropdown is open -->
        <div x-show="open" class="fixed inset-0  bg-opacity-50 z-40" @click="open = false"></div>

        <!-- Dropdown Toggle Button (Lower z-index so dropdown can cover it) -->
        <button @click="open = !open" class="px-3 py-1  text-gray-700 rounded relative z-40">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
              </svg>
              
        </button>

        <!-- Dropdown Menu (Covers the button) -->
        <div x-show="open" @click.away="open = false" x-transition  x-cloak
            class="absolute right-0 w-15 bg-white border border-gray-300 shadow-md rounded-md z-50">
            <ul class="py-1 text-sm text-gray-700">
                <li>
                    <a wire:navigate href="" 
                        class="block px-4 py-2 hover:bg-gray-100 ">
                        <div class="flex justify-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>                                                                                          
                        </div>
                    </a>
                </li>
                <li>
                    <button 
                        onclick="confirm('Are you sure you want to delete this product') ? '' : event.stopImmediatePropagation()" 
                        wire:click="deleteCustomer()"
                        class="w-full text-left block px-4 py-2 text-red-600 hover:bg-gray-100">
                        <div class="flex justify-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>
                              
                          </div>   </button>
</div>