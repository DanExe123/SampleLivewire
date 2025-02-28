<div>
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">MyApp</a>
    
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-500">Home</a>
                <a href="{{ url('') }}" class="text-gray-700 hover:text-blue-500">About</a>
                <a href="{{ route('create-item') }}" class="text-gray-700 hover:text-blue-500">create Item</a>
                <a href="{{ route('contact-us') }}" class="text-gray-700 hover:text-blue-500">Contact</a>

    
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700 focus:outline-none" onclick="toggleMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-2 space-y-2 bg-white shadow-md p-4">
            <a href="{{ url('/') }}" class="block text-gray-700 hover:text-blue-500">Home</a>
            <a href="{{ url('/about') }}" class="block text-gray-700 hover:text-blue-500">About</a>
            <a href="{{ url('/services') }}" class="block text-gray-700 hover:text-blue-500">Services</a>
            <a href="{{ url('/contact') }}" class="block text-gray-700 hover:text-blue-500">Contact</a>
        </div>
    
        <script>
            function toggleMenu() {
                document.getElementById("mobileMenu").classList.toggle("hidden");
            }
        </script>
    </nav>
    
</div>
