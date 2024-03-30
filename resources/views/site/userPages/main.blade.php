<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rubiaçai</title>
</head>

<body class="bg-gray-200">
    <!--navbar e header -->
    <div class="bg-gray-200">
        <header class="absolute inset-x-0 top-0 z-50">
            <x-initial-page-menu />
            <x-initial-page-menu-mobile />
        </header>
        <x-initial-page-hero-section />
        <livewire:categories-slide />
        <livewire:product-card />
    </div>
</body>
</html>
@livewire('wire-elements-modal')
@vite(['resources/css/app.css', 'resources/js/category-slide.js'])
