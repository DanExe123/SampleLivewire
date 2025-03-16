<div class="w-64 min-h-screen bg-black text-white p-4 flex flex-col items-center">
    <!-- Logo -->
    <div class="mb-4">
        @include('livewire.includes.logo')
    </div>

    <!-- Admin Title -->
    <h2 class="text-sm font-light mb-6 text-center">Chrome Hearts Admin Panel</h2>

    <!-- Navigation Links -->
    <nav class="w-full">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 bg-white text-black rounded-lg transition hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M3 9.5L12 3l9 6.5v9.5H3V9.5z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('product') }}" class="flex items-center px-4 py-2 bg-white text-black rounded-lg transition hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    Product
                </a>
            </li>
            <li>
                <a href="{{ route('orders') }}" class="flex items-center px-4 py-2 bg-white text-black rounded-lg transition hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M6 9l6 6 6-6"></path>
                    </svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('discounts') }}" class="flex items-center px-4 py-2 bg-white text-black rounded-lg transition hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M5 12h14"></path>
                    </svg>
                    Discount Codes
                </a>
            </li>
            <li>
                <a href="{{ route('shipping') }}" class="flex items-center px-4 py-2 bg-white text-black rounded-lg transition hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M3 9h18"></path>
                    </svg>
                    Shipping Charges
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="mt-auto">
        <a href="{{ route('about') }}" class="flex items-center text-gray-400 hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 12v6m0-12v2m-8 8a9 9 0 1116 0"></path>
            </svg>
            About Us
        </a>
    </div>
</div>
