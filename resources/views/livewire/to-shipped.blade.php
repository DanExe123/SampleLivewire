<div>
    @livewire('user-nav')
    @include('livewire.includes.user-nav-bar')


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

    <div class="container mx-auto w-full max-w-none p-6 bg-white rounded-lg flex flex-col">
        <h2 class="text-2xl font-bold mb-3 text-gray-800">To Be Shipped</h2>
    
        @if($customerPurchases->isEmpty())
            <p class="text-gray-500 text-center">No purchases to be shipped.</p>
        @else
            <div class="flex flex-col gap-4"> <!-- Changed grid to flex-col for vertical stacking -->
                @foreach($customerPurchases as $purchase)
                    <div class="grid grid-cols-3 gap-4 p-4 border bg-gray-50 rounded-md shadow-md">
                        <!-- Product Image -->
                        <div class="flex items-center gap-4">
                            @php
                                $images = is_array($purchase->cart->product->image) 
                                    ? $purchase->cart->product->image 
                                    : json_decode($purchase->cart->product->image, true);
                            @endphp
    
                            <img src="{{ asset('storage/' . ($images[0] ?? 'default-image.jpg')) }}" 
                                alt="{{ $purchase->cart->product->name ?? 'Product Image' }}" 
                                class="w-16 h-16 rounded-lg cursor-pointer hover:scale-110 transition">
    
                            <div>
                                <h3 class="text-lg font-semibold">{{ $purchase->cart->product->name ?? 'Product Name' }}</h3>
                                <p class="text-sm text-gray-600 w-48 truncate">{{ $purchase->cart->product->description ?? 'No description' }}</p>
                                <p class="text-blue-600 text-sm font-medium mt-1">Tracking No: {{ $purchase->id }}</p>
                            </div>
                        </div>
    
                       <!-- Order Status -->
                       <div class="flex flex-col items-center justify-center">
                        <p class="text-sm font-semibold text-gray-700">Status:</p>
                        <span class="px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded-full">
                            {{ ucfirst($purchase->cart->status) }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">Expected: Sept 30, 2025</p>
                        
                        <!-- Display latitude and longitude -->
                        <p class="text-xs text-gray-500">
                            Location: 
                            @if (!empty($purchase->cart->address))
                                {{ $purchase->cart->address }}
                            @elseif (!empty($purchase->cart->latitude) && !empty($purchase->cart->longitude))
                                Lat: {{ $purchase->cart->latitude }}, Lng: {{ $purchase->cart->longitude }}
                            @else
                                <span class="text-red-500">Coordinates not available</span>
                            @endif
                        </p>
                        
                    </div>
                    

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            @include('livewire.includes.mypurchases-modal-view-cancelled')
                        </div>

                        </div>
                        </div>
                    </div>
             
                @endforeach
            </div>
        </div>
        @endif
<!--Parent Div -->
 </div>

