

<!--navbar e header -->
<div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
        <x-initial-page-menu />
        <x-initial-page-menu-mobile />
    </header>
    
    <x-initial-page-hero-section />
    <livewire:categories-slide />
    @foreach ($products as $p)
    <h1>{{ $p->name }}</h1>
    @endforeach
</div>


@vite(['resources/css/app.css', 'resources/js/app.js'])