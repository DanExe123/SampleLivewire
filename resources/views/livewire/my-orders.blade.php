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
                <div class="py-2 flex">
                <a wire:navigate href="{{ route('WelcomeChromehearts') }}" class="flex items-center gap-4 text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                      </svg>                          
                <h2 class="text-2xl font-bold mb-3 text-gray-800 mt-3">My Purchases</h2>
                </a> 
                </div>
                <!-- search bar with transition alpine -->
                <div class="flex justify-end">
                @include('livewire.includes.searchbar-transition')
                <!--My purchases chat support -->
                @include('livewire.includes.mypurchases-chat-support')
                </div>
                <!-- header navbar Top Shipped , To Recieve , Complete , Cancelled -->
                <!--Breadcrumbs with icons-->
                <div class="flex justify-center">
                    @include('livewire.includes.Breadcrumbs')
                </div>

                

    </div> 
</div> 
    </div>       