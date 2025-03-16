<div>
    <div x-data="{ open: false, showLogin: false }" x-init="showLogin = false">
        <!-- Overlay -->
        <div x-show="open || showLogin" x-cloak class="fixed inset-0 bg-opacity-50 z-40" @click="open = false; showLogin = false"></div>
    
        <!-- Floating Chat Icon -->
        <button @click="open = @json(auth()->check()) ? true : false; showLogin = @json(auth()->check()) ? false : true"
            class="fixed bottom-25 right-5 bg-black hover:bg-gray-600 text-white p-4 rounded-full shadow-lg transition duration-300 z-50">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-auto">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    
        <!-- Login Modal (For Guests) -->
        <div x-show="showLogin" x-cloak x-transition 
            class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-black w-96 p-6 rounded-lg shadow-lg border border-gray-300">
                <div class="flex justify-center">
                    <img src="{{ asset('logo/logo-chrome-hearts-removebg-preview.png') }}" alt="Logo" class="w-64 h-auto">
                </div>
    
                <form wire:submit.prevent="login">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-gray-600 text-sm">Email</label>
                        <input type="email" wire:model="email" class="w-full p-2 border rounded bg-white text-black" placeholder="Enter your email">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="block text-gray-600 text-sm">Password</label>
                        <input type="password" wire:model="password" class="w-full p-2 border rounded bg-white text-black" placeholder="Enter your password">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex items-center mb-3">
                        <input type="checkbox" wire:model="remember" class="mr-2 text-blue-500">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </div>
    
                    <div class="flex items-center justify-end">
                        <button type="submit" class="w-full bg-black hover:bg-gray-800 text-white py-2 rounded flex justify-center items-center relative" wire:loading.attr="disabled">
                            <!-- Loading Spinner -->
                            <svg wire:loading wire:target="login" class="animate-spin h-5 w-5 mr-2 text-white" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 108 8h-4l3 3 3-3h-4a8 8 0 01-8 8z"></path>
                            </svg>
    
                            <span wire:loading.remove wire:target="login">Log in</span>
                            <span wire:loading wire:target="login">Processing...</span>
                        </button>
                    </div>
                </form>
    
                <div class="mt-3 text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Sign up</a>
                </div>
    
                <!-- Cancel Button -->
                <button @click="showLogin = false" class="mt-3 w-full text-gray-500 hover:text-red-500">Cancel</button>
            </div> 


            <style>
            [x-cloak] { display: none !important; }
            </style>
       
    </div>
</div>
</div>

