<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Livewire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">

 @livewire('nav-bar')
    <div class="container mx-auto p-6">
    {{ $slot }}
       {{--  @yield('content') --}}
    </div>

    @livewireScripts
</body>
</html>
