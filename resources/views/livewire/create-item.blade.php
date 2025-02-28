<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white text-sm p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveItem" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Item Name:</label>
            <input type="text" id="name" wire:model="name"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('name') 
                <span class="text-red-500 text-xs">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="description" wire:model="description"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Save Item
        </button>
    </form>
</div>
