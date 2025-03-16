<div>
    <div wire:offline>
        <div class="flex justify-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium justify-center flex">Danger alert!</span>
        </div>
    </div>

    <!-- Shop Information Section -->
    <div id="new-arrivals" class="bg-transparent relative" >
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://img.freepik.com/premium-photo/white-concrete-background_180224-46.jpg?semt=ais_hybrid');">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <!-- Content on top of overlay -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            
           

            <!-- Shop Title -->
            <h2 class="text-3xl font-bold text-center text-slate-900 mb-8 tracking-wider py-5">
              Chrome Hearts
            </h2>

            <!-- Livewire Component -->
            @livewire('add-to-cart')
        </div>
    </div>

    
</div>
