<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
         <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <!-- Styles / Scripts -->
       
    </head>
    <body class="bg-gray-white">
        <div class="flex justify-center mt-5">
            <h1 class="font-bold text-4xl"> Sample Data tables in Livewire</h1>
        </div>
        
        @livewire('nav-bar')
       @livewire('data-tables')

<<<<<<< HEAD
=======
       <livewire:CreateItem />
>>>>>>> ac0b52d5c9c2a3990e724e2f3a71e632e1ae840f
    </body>
</html>
