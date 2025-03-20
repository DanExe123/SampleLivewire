<div>
    @if(Auth::check() && Auth::user()->hasRole('customer'))
    <nav class="bg-black shadow-md p-4 ">

        <div class="container mx-auto flex justify-between items-center">
            <img src="{{ asset('logo/7b2641445b48e07466d8a55e86d745af-removebg-preview.png') }}" alt="Logo" class=" w-64">
           
         
            <div class="">
            <img src="{{ asset('logo/logo-chrome-hearts-removebg-preview.png') }}" alt="Logo" class=" w-64  ">
            </div>
            <div class="hidden md:flex space-x-6">
                @guest
                <a wire:navigate href="{{ route('login') }}" class="text-white font-mono hover:text-blue-500">Login</a>
                @endguest

                @auth    
                <div class="mt-2 flex space-x-3">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white hover:text-red-600 focus:outline-2 focus:outline-offset-2 focus:outline-red-500 ">
               <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                 </svg>
                </div>
                
           <div class="mt-2 flex ">
            <a  wire:navigate href="{{ route('cartpage') }}">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white  hover:text-red-600 focus:outline-2 focus:outline-offset-2 focus:outline-red-500">
               <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
              </svg> </a>
              @livewire('cart-count')
                 </div>

                <div class="mt-2">
                    <span class="text-white font-mono hover:text-red-600 font-bold cursor-pointer">
                        <a href="{{ route('my-orders') }}">
                        MyPurchase
                    </a></span>
                </div>

                
            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    {{-- :name="auth()->user()->name"--}}
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-white text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            @endauth
                


    
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-700 focus:outline-none" onclick="toggleMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden mt-2 space-y-2 bg-white shadow-md p-4">
            <a href="{{ url('/') }}" class="block text-gray-700 hover:text-blue-500">Home</a>
            <a href="{{ url('/about') }}" class="block text-gray-700 hover:text-blue-500">About</a>
            <a href="{{ url('/services') }}" class="block text-gray-700 hover:text-blue-500">Services</a>
            <a href="{{ url('/contact') }}" class="block text-gray-700 hover:text-blue-500">Contact</a>
        </div>
    
        <script>
            function toggleMenu() {
                document.getElementById("mobileMenu").classList.toggle("hidden");
            }
        </script>
    </nav>
    @endif
</div>
