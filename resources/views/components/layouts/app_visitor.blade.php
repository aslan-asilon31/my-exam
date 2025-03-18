<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title }}</title>
    @livewireStyles
    
</head>
<body class="bg-gradient-to-r from-orange-700 to-orange-900 p-10">
    <x-toast />

    <livewire:partials.header />


    <div class="flex items-center justify-center ">
        {{ $slot }}
    </div>


    @livewireScripts
</body>
</html>