<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Contact Us</h2>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Full Name</label>
            <input type="text" id="name" wire:model="name" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium">Email Address</label>
            <input type="email" id="email" wire:model="email" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Subject -->
        <div class="mb-4">
            <label for="subject" class="block text-gray-700 font-medium">Subject</label>
            <input type="text" id="subject" wire:model="subject" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Message -->
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-medium">Message</label>
            <textarea id="message" wire:model="message" rows="4" 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Send Message
        </button>
    </form>
</div>
