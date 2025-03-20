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


<div class="container mx-auto w-full max-w-none p-6 bg-white rounded-lg  flex flex-col">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold mb-3 text-gray-800">To Be Shipped</h2>
        
        @if($customerPurchases->isEmpty())
        <p class="text-gray-500 text-center">No purchases to be shipped.</p>
    @else

    @foreach($customerPurchases as $purchase)
    <div class="grid grid-cols-3 gap-4 p-4 border-b bg-gray-50 rounded-md shadow-md relative">
        <div class="flex items-center gap-4">
            @php
                // Decode product images safely
                $images = is_array($purchase->cart->product->image) ? $purchase->cart->product->image : json_decode($purchase->cart->product->image, true);
            @endphp

            @if(is_array($images) && count($images) > 0)
                @foreach($images as $image)
                    <img src="{{ asset('storage/' . $image) }}" 
                        alt="{{ $purchase->cart->product->name ?? 'Product Image' }}" 
                        class="w-16 h-16 rounded-lg cursor-pointer hover:scale-110 transition">
                @endforeach
            @else
                <img src="{{ asset('storage/' . ($purchase->cart->product->image ?? 'default-image.jpg')) }}" 
                    alt="{{ $purchase->cart->product->name ?? 'Product Image' }}" 
                    class="w-16 h-16 rounded-lg cursor-pointer hover:scale-110 transition">
            @endif
            
            <div>
                        <h3 class="text-lg font-semibold">{{ $purchase->cart->product->name ?? 'Product Name' }}</h3>
                        <p class="text-sm text-gray-600 w-48 truncate">{{ $purchase->cart->product->description ?? 'No description' }}</p>
                        <p class="text-blue-600 text-sm font-medium mt-1">Tracking No: {{ $purchase->id }}</p>
                    </div>
                </div>




                <div class="flex flex-col items-center justify-center">
                    <p class="text-sm font-semibold text-gray-700">Status:</p>
                    <span class="px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded-full">
                        {{ ucfirst($purchase->cart->status) }}
                    </span>
                    <p class="text-xs text-gray-500 mt-1">Expected: Sept 30, 2025</p>
                    <div>
                        <p class="text-xs text-gray-500">
                            Address: {{ $purchase->resolved_address ?? 'Invalid coordinates' }}
                        </p>
                    </div>
                </div>
                
                <div class="flex items-center justify-end space-x-4">
                    @include('livewire.includes.mypurchases-modal-view-cancelled')
                </div>
            </div>
        @endforeach
    @endif
    
        </div>
    </div>
    
  </div>
  </div>

<!--Parent Div -->
 </div>

