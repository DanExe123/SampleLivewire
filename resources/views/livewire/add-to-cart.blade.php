<div class="py-12">
    <div class="p-4 mx-auto lg:max-w-6xl md:max-w-4xl">


<!-- Search & Category Filter -->
<div class="flex flex-wrap gap-4 justify-center items-center mb-4">

    <!-- Search Bar (75% width) -->
    <div class="flex items-center w-3/4">
        <input wire:model.live.debounce.300ms="search" type="text"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
            placeholder="Search">
    </div>

    <!-- Category Selection (25% width) -->
    @if(Auth::check() && Auth::user()->hasRole('customer'))
    <div class="flex items-center w-1/4  ">
        <select wire:model.live.debounce.300ms="category_id" 
            class=" p-2 rounded w-full bg-black text-white font-bold ">
            <option value="">Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    @endif
</div>



        <!-- Product Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($products as $product)
                <div class="bg-white flex flex-col rounded-lg overflow-hidden shadow-md cursor-pointer hover:scale-[1.01] transition-all">
                    <!-- Image Container -->
                    <div class="w-full h-40 md:h-48 flex items-center justify-center bg-white">
                        @php
                            $images = json_decode($product->image, true);
                        @endphp
                        <img src="{{ isset($images[0]) ? asset('storage/' . $images[0]) : asset('default-image.jpg') }}" 
                             alt="{{ $product->name }}" 
                             class="w-3/4 h-3/4 object-contain">
                    </div>
    
                    <!-- Card Content -->
                    <div class="p-4 flex-1 flex flex-col">
                        <div class="flex-1">
                            <h5 class="text-sm sm:text-base font-semibold text-slate-900 line-clamp-2">
                                {{ $product->name }}
                            </h5>
                            <div class="mt-2 flex items-center flex-wrap gap-2">
                                <h6 class="text-sm sm:text-base font-semibold text-slate-900">
                                    ₱{{ number_format($product->price, 2) }}
                                </h6>
                                <div class="bg-slate-100 w-8 h-8 flex items-center justify-center rounded-full cursor-pointer ml-auto" title="Wishlist">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-slate-800 inline-block" viewBox="0 0 64 64">
                                        <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>


                        <div x-data="{ animate: false }" class="relative">
                            <!-- Add to Cart Button -->

                            <!-- costumer permission -->
                                @if(Auth::user() && Auth::user()->can('add to cart'))
                                <button type="button" 
                                    wire:click="addToCart({{ $product->id }})" 
                                    @click="animate = true; setTimeout(() => animate = false, 800)"
                                    class="text-sm px-2 py-2 font-medium w-full mt-4 bg-black hover:bg-gray-500 text-white tracking-wide outline-none border-none rounded">
                                    Add to Cart
                                </button>
                            @else
                                <button type="button" disabled 
                                    class="text-sm px-2 py-2 font-medium w-full mt-4 bg-gray-400 text-white tracking-wide outline-none border-none rounded cursor-not-allowed">
                                    Customers Only
                                </button>
                            @endif



                            <!-- Throwing Animation Element -->
                            <div x-show="animate" x-transition
                                class="absolute left-1/2 top-0 w-10 h-10 bg-black text-white flex items-center justify-center rounded-full"
                                :class="animate ? 'animate-throw' : ''">
                                🛒
                            </div>
                        </div>
                        
                        
                        <!-- Tailwind Custom Animation -->
                        <style>
                            @keyframes throwToTop {
                                0% { transform: translate(0, 0) scale(1); opacity: 1; }
                                50% { transform: translateY(-200px) scale(1.3); opacity: 0.7; }
                                100% { transform: translateY(-500px) scale(0); opacity: 0; }
                            }
                        
                            .animate-throw {
                                animation: throwToTop 0.8s ease-in-out forwards;
                            }
                        </style>
                        
                        


                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- Pagination Controls -->
        
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
    

      </div>   
</div>