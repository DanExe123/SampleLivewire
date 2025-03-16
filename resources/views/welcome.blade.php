<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chrome Heart</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- Styles / Scripts -->

</head>

<body class="bg-gray-white">
    <div class="flex justify-center mt-5">
      
    </div>
    @livewire('header')
    @livewire('nav-bar')
    @livewire('background-image')
    @livewire('product-section')
    @livewire('chat-support')
    @livewire('chat-support')
    @livewire('login')
    
   





</body>

</html>
