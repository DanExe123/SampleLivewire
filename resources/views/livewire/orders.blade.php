<div>
    <div>
        @include('livewire.includes.Status-card')
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden mt-10">
                    <div class="flex items-center justify-between d p-4">
                        <div class="flex">

                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>


                                <input wire:model.live.debounce.300ms = "search" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                    placeholder="Search" required="">
                            </div>
                        </div>
                        
                    </div>
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-xs text-gray-500 border-collapse">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left">Name</th>
                                    <th scope="col" class="px-4 py-3 text-left">Category</th>
                                    <th scope="col" class="px-4 py-3 text-center">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Images</th>   
                       
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerPurchases as $purchase)
                                <tr wire:key="{{ $purchase->id }}" class="border-b dark:border-gray-700 text-center">
                                    <!-- Name -->
                                    <td class="px-4 py-3 text-left">{{ $purchase->cart->product->name }}</td>
                                    
                                    <!-- Category -->
                                    <td class="px-4 py-3 text-left">
                                        {{ $purchase->cart->product->category->name ?? 'No Category' }}
                                    </td>    
                            
                                    <!-- Status -->
                                    <td class="px-4 py-3 relative text-center">
                                        <div x-data="{ open: false }">
                                            <button @click="open = !open"
                                            class="px-3 py-1 text-xs font-medium text-white rounded h-4 w-10 focus:outline-none 
                                                {{ $purchase->status === 'Shipped' ? 'bg-blue-500' : 
                                                ($purchase->status === 'Delivered' ? 'bg-green-500' : 'bg-gray-500') }}">
                                                {{ $purchase->status }}
                                            </button>
                                    
                                            <div x-show="open" @click.away="open = false"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 transform scale-95"
                                                x-transition:enter-end="opacity-100 transform scale-100"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 transform scale-100"
                                                x-transition:leave-end="opacity-0 transform scale-95"
                                                class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                                                
                                                <ul class="py-1 text-gray-700">
                                                    <!-- Ordered Button -->
                                                    <li>
                                                        <button wire:click="updateStatus({{ $purchase->id }}, 'ordered')" @click="open = false" 
                                                            class="block w-full px-4 py-2 text-sm hover:bg-yellow-100 
                                                            {{ $purchase->status === 'ordered' ? 'bg-yellow-500 text-white' : '' }}">
                                                            Ordered
                                                        </button>
                                                    </li>
                                                test
                                                    <!-- Shipped Button -->
                                                    <li>
                                                        <button wire:click="updateStatus({{ $purchase->id }}, 'shipped')" @click="open = false" 
                                                            class="block w-full px-4 py-2 text-sm hover:bg-blue-100 
                                                            {{ $purchase->status === 'shipped' ? 'bg-blue-500 text-white' : '' }}">
                                                            Shipped
                                                        </button>
                                                    </li>
                                                
                                                    <!-- Delivered Button -->
                                                    <li>
                                                        <button wire:click="updateStatus({{ $purchase->id }}, 'delivered')" @click="open = false" 
                                                            class="block w-full px-4 py-2 text-sm hover:bg-green-100 
                                                            {{ $purchase->status === 'delivered' ? 'bg-green-500 text-white' : '' }}">
                                                            Delivered
                                                        </button>
                                                    </li>
                                                
                                                    <!-- Completed Button -->
                                                    <li>
                                                        <button wire:click="updateStatus({{ $purchase->id }}, 'completed')" @click="open = false" 
                                                            class="block w-full px-4 py-2 text-sm hover:bg-gray-100 
                                                            {{ $purchase->status === 'completed' ? 'bg-gray-500 text-white' : '' }}">
                                                            Completed
                                                        </button>
                                                    </li>
                                                </ul>
                                                
                                            </div>
                                        </div>
                                    </td>
                            
                                    <!-- Product Image -->
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $images = is_array($purchase->cart->product->image) ? $purchase->cart->product->image : json_decode($purchase->cart->product->image, true);
                                        @endphp
                                        @if(is_array($images))
                                            @foreach($images as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="w-10 h-10 rounded mx-auto hover:scale-110 transition">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('storage/' . $purchase->cart->product->image) }}" alt="Product Image" class="w-10 h-10 rounded mx-auto hover:scale-110 transition">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>                 
                    </div>                   
                </div>
             </div>
</div>
