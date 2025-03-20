<div class="flex gap-2 mt-1">
    @php
        $sizes = is_array($cart->product->size) ? $cart->product->size : json_decode($cart->product->size, true);
    @endphp

    @if(is_array($sizes) && count($sizes) > 0)
        @foreach($sizes as $size)
            <button wire:click="selectSize('{{ $size }}')"
                class="px-3 py-1 text-sm font-semibold rounded border
                {{ $selectedSize === $size ? 'bg-black text-white' : 'bg-gray-200 text-gray-500 opacity-50' }}">
                {{ $size }}
            </button>
        @endforeach
    @else
        <span class="text-gray-500">No sizes available</span>
    @endif
</div>
