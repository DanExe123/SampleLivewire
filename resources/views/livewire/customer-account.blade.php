<div>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-700">Customer Account Management</h1>
    
        <!-- Search & Add Customer -->
        <div class="flex justify-between items-center mt-4">
            <div class="relative w-64">
                <input type="text" 
                    class="bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pr-10 pl-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow w-full" 
                    placeholder="Search customers..." 
                    wire:model.live.debounce.300ms="search">

                    
                
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 rounded bg-slate-800 p-1.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" 
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        
        </div>
        
        
        <!-- Customer Table -->
<div class="overflow-x-auto mt-4">
    <table class="w-full table-auto border-collapse text-sm text-gray-600">
        <thead class="bg-gray-100 text-gray-700 uppercase text-left">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Actions</th>   
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($customers as $customer)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-3">{{ $customer->name }}</td>
                <td class="px-6 py-3">{{ $customer->email }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 text-xs font-semibold rounded 
                        {{ $customer->status == 'Active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ $customer->status }}
                    </span>
                </td>
                
                <td class="px-6 py-3 text-center">
                    @include('livewire.includes.modal-edit-delete-customer')
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $customers->links() }}
    </div>
</div>

</div>
