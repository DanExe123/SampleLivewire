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
                <h2 class="text-2xl font-bold mb-3 text-gray-800">🛒 Shopping Cart</h2>
                <div class="py-2 flex">
                    <a wire:navigate href="{{ route('WelcomeChromehearts') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 text-gray-500">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                        </svg>     
                        <p class="font-bold text-gray-500">Products</p> 
                    </a>
                </div>
                

                @if ($cartItems->isEmpty())
                    <p class="text-gray-500 text-center flex-grow flex items-center justify-center">Your cart is empty.</p>
                @else
                <!-- Cart Items Container -->
<div class="flex-grow space-y-4">
    @foreach ($cartItems as $cart)
        <div class="grid grid-cols-3 gap-4 p-4 border-b bg-gray-50 rounded-md mb-4 relative">
            <!-- Left Column (Image, Details) -->
            <div class="flex items-center gap-4">
                @php
                    $images = is_array($cart->product->image) ? $cart->product->image : json_decode($cart->product->image, true);
                @endphp

                @if(is_array($images))
                    @foreach($images as $image)
                        <img src="{{ asset('storage/' . $image) }}" 
                            alt="{{ $cart->product->name }}" 
                            class="w-10 h-10 rounded cursor-pointer hover:scale-110 transition">
                    @endforeach
                @else
                    <img src="{{ asset('storage/' . $cart->product->image) }}" 
                        alt="{{ $cart->product->name }}" 
                        class="w-10 h-10 rounded cursor-pointer hover:scale-110 transition">
                @endif

                <div>
                    <h3 class="text-lg font-semibold">{{ $cart->product->name }}</h3>
                    <p class="text-sm text-gray-600 text-clip w-48">{{ $cart->product->description }}</p>
                    <p class="text-green-600 text-sm font-medium mt-1">Stock: {{ $cart->product->stock }}</p>
                </div>
            </div>

            <!-- Center Column (Size Selection) -->
            <div class="flex flex-col items-center justify-center">
                <p class="text-sm font-semibold">Size:</p>
                <div class="flex gap-2 mt-1">
                    @php
                        $sizes = is_array($cart->product->size) ? $cart->product->size : json_decode($cart->product->size, true);
                    @endphp
                    @if(is_array($sizes))
                        @foreach($sizes as $size)
                            <button wire:click="selectSize({{ $cart->id }}, '{{ $size }}')" 
                                class="px-3 py-1 text-sm font-semibold rounded border
                                    {{ $cart->selectedSize === $size ? 'bg-black text-white' : 'bg-gray-200 text-gray-500 opacity-50 cursor-not-allowed' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    @else
                        <span class="text-gray-500">No sizes available</span>
                    @endif
                </div>
            </div>

        
            <!-- Right Column (Quantity & Remove) -->
            <div class="flex items-center justify-between mt-3">
                <!-- Quantity Controls -->
                <div class="flex items-center space-x-2">
                    <button wire:click.prevent="decreaseQuantity({{ $cart->id }})" 
                        class="bg-black hover:bg-gray-600 px-3 py-1 rounded text-sm text-white">-</button>
                    <span class="text-lg font-semibold">{{ $cart->quantity }}</span> 
                    <button wire:click.prevent="increaseQuantity({{ $cart->id }})" 
                        class="bg-black hover:bg-gray-600 px-3 py-1 rounded text-sm text-white">+</button>  
                </div>

                <!-- Remove Button -->
                <button @click="showModal = true"
                    class="bg-black text-white px-3 py-2 text-sm rounded hover:bg-gray-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Remove Confirmation Modal -->
            <div x-show="showModal" 
                x-transition.opacity
                class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50">
                
                <div x-show="showModal" 
                    x-transition.scale
                    class="bg-white shadow-lg border border-gray-300 p-6 rounded-md w-96">
                    
                    <p class="text-lg font-semibold text-center">Remove this item?</p>
                    
                    <div class="flex justify-center space-x-3 mt-4">
                        <button @click="showModal = false" 
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Cancel
                        </button>

                        <button wire:click="delete({{ $cart->id }})" 
                            @click="showModal = false"
                            class="flex items-center gap-2 px-4 py-2 bg-black text-white rounded hover:bg-gray-800">
                            Remove from Cart
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    

                    <div class="py-4 px-3">
                        <div class="flex">
                            <div class="flex space-x-4 items-center mb-3">
                                <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                                <select wire:model.live='perPage'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="200">200</option>
                                </select>
                            </div> 

                        </div> 
                        {{ $cartItems->links() }}
                    </div> 
                 </div>
                </div>

                    <!-- Total & Checkout -->
                    <div class="p-4 border-t bg-white flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-700">Total: ₱{{ number_format($cartItems->sum(fn($cart) => $cart->product->price * $cart->quantity), 2) }}</h3>
                        <button class="bg-blue-500 text-white px-6 py-2 text-lg rounded hover:bg-blue-600 transition">
                            Proceed to Checkout
                        </button>
                    </div>
                @endif
        
                
    </div> 
</div> 
        