<div class="">
    @if(Auth::check() && Auth::user()->hasRole('customer'))
    @livewire('user-nav')
    @include('livewire.includes.user-nav-bar')
    @livewire('background-image')
    @livewire('product-section')
    @livewire('chat-support')
    @livewire('login')
    @else

    @php abort(404); @endphp
@endif
</div>
