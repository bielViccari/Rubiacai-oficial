<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Rubiaçai' }}</title>
    </head>
    <body>
        {{ $slot }}
    </body>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/show-sidebar.js', 'resources/js/show-navbar.js'])
    @stack('modals')
    @livewireScripts
</html>
