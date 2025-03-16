<div>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-700">Customer Account Management</h1>
    
        <!-- Search & Add Customer -->
        <div class="flex justify-between items-center mt-4">
            <input type="text" class="input input-bordered w-64" placeholder="Search customers..." wire:model="search">
            <button class="btn btn-primary">+ Add Customer</button>
        </div>
    
        <!-- Customer Table -->
        <div class="mt-6 bg-white p-4 rounded-xl shadow-md">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <span class="badge {{ $customer->status == 'Active' ? 'badge-success' : 'badge-error' }}">
                                {{ $customer->status }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info">✏️</button>
                            <button class="btn btn-sm btn-error">🗑️</button>
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
</div>
