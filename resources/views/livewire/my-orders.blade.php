<div x-data="{ showModal: false }" x-cloak class="relative">

    @livewire('user-nav')
    @include('livewire.includes.user-nav-bar')

    <div wire:offline>
        <div class="flex justify-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium justify-center flex">Danger alert!</span>
        </div>
    </div>
    
    <!-- Shop Information Section -->
    <div id="new-arrivals" class="relative min-h-screen bg-gray-100">
        <!-- Content -->
        <div class="relative w-full px-4 sm:px-6 lg:px-8 z-10 ">
            <!-- Cart Container -->
            <div class="container mx-auto w-full max-w-none p-6 bg-white rounded-lg shadow-md flex flex-col">
                <!-- Header -->
                <h2 class="text-2xl font-bold mb-3 text-gray-800">My Orders</h2>
                <div class="py-2 flex">
                    <a wire:navigate href="{{ route('WelcomeChromehearts') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 text-gray-500">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                        </svg>     
                        <p class="font-bold text-gray-500">Products</p> 
                    </a>
                </div>
                

    </div> 
</div> 
        