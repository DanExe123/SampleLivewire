<div x-data="{ open: false }" class="flex items-center space-x-2">
    <!-- Search Icon -->
    <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-300 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-red-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>                
    </button>
  
    <!-- Search Bar (Expands beside the icon) -->
    <div x-show="open" x-transition 
         @click.away="open = false"
         class="relative">
      <input type="text" placeholder="Search..." 
             class="w-0 transition-all duration-300 ease-in-out p-2 border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
             :class="open ? 'w-94' : 'w-0'">
    </div>
  </div>
  