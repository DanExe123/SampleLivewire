<div wire:poll.3s>
    @hasrole('admin')
    <section class="mt-10">
        <div class="mx-auto w-full max-w-screen-xl px-4 lg:px-5">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
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


                    <div class="flex space-x-3">
                        @livewire('modal-product')

                       
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-gray-500 border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                            <tr>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">Category</th>
                                <th scope="col" class="px-4 py-3">Size</th>
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">Stock</th>
                                <th scope="col" class="px-4 py-3">Description</th>
                                <th scope="col" class="px-4 py-3">Images</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr wire:key="{{ $product['id'] }}" class="border-b dark:border-gray-700 text-center">
                                <td class="px-4 py-3 text-left">{{ $product['name'] }}</td>
                                <td class="px-4 py-3 text-left">{{ $product->category->name ?? 'No Category' }}</td>
                                <td class="px-4 py-3">{{ str_replace(['["', '"]'], '', $product->size) }}</td>
                                <td class="px-4 py-3">{{ $product['price'] }}</td>
                                <td class="px-4 py-3">{{ $product['stock'] }}</td>
                                <td class="px-4 py-3 text-left">{{ $product['description'] }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $images = is_array($product['image']) ? $product['image'] : json_decode($product['image'], true);
                                    @endphp
                                    @if(is_array($images))
                                        @foreach($images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="w-10 h-10 rounded mx-auto hover:scale-110 transition">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('storage/' . $product['image']) }}" alt="Product Image" class="w-10 h-10 rounded mx-auto hover:scale-110 transition">
                                    @endif
                                </td>
                                <td class="px-4 py-3 relative">
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" class="px-3 py-1 text-gray-700 rounded relative z-40">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition x-cloak class="absolute right-0 w-15 bg-white border border-gray-300 shadow-md rounded-md z-50">
                                            <ul class="py-1 text-sm text-gray-700">
                                                <li>
                                                    <a wire:navigate href="{{ route('edit-product', $product->id) }}" class="block px-4 py-2 hover:bg-gray-100">
                                                        <div class="flex justify-center py-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>                                                              
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button onclick="confirm('Are you sure you want to delete this product {{ $product->id }} ?') ? '' : event.stopImmediatePropagation()" wire:click="delete({{ $product->id }})" class="w-full text-left block px-4 py-2 text-red-600 hover:bg-gray-100">
                                                        <div class="flex justify-center py-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                


                <div class="py-4 px-3">
                    <div class="flex ">
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
                        {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
    @endhasrole
</div>

