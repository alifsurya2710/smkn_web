<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            document.addEventListener('alpine:init', () => {
                console.log('Alpine initialized in Guest Layout');
            });
            window.onload = () => {
                console.log('Window loaded in Guest Layout, Alpine:', window.Alpine ? 'found' : 'missing');
            };
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-900">
        {{ $slot }}
    </body>
</html>
