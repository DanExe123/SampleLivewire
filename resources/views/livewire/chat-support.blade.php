<div>
    <div x-data="{ open: false }">
        <!-- Overlay -->
        <div x-show="open" class="fixed inset-0  bg-opacity-50 z-40" @click="open = false"></div>
    
        <!-- Floating Chat Icon -->
        <button @click="open = !open" 
            class="fixed bottom-5 right-5 bg-black hover:bg-gray-600 text-white p-4 rounded-full shadow-lg transition duration-300 z-50">
            <div>
                <img src="{{ asset('logo/icon.ico') }}" alt="Logo" class="w-10 h-auto">
            </div>
        </button>
    
        <!-- Chatbox (Overlay Effect) -->
        <div x-show="open" x-transition 
            class="fixed bottom-16 right-5 w-80 bg-white shadow-lg rounded-lg p-4 border border-gray-300 z-50">
            
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-lg font-semibold">Chat Support</h2>
                <button @click="open = false" class="text-gray-600 hover:text-red-500">&times;</button>
            </div>
    
            <!-- Chat Messages -->
            <div class="h-40 overflow-y-auto p-2">
                @foreach($messages as $msg)
                    <div class="mb-2 {{ $msg['sender'] == 'user' ? 'text-right' : 'text-left' }}">
                        <p class="inline-block px-3 py-1 rounded {{ $msg['sender'] == 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                            {{ $msg['text'] }}
                        </p>
                    </div>
                @endforeach
            </div>
    
            <!-- Chat Input -->
            <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                class="w-full p-2 border rounded mt-2" placeholder="Type your message...">
        </div>
    </div>
    
</div>
