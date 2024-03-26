@vite(['resources/css/app.css', 'resources/js/app.js'])


   <!--navbar e header -->
   <div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
        <x-initial-page-menu />
        <x-initial-page-menu-mobile />
    </header>

    <x-initial-page-hero-section />

    <livewire:counter />
</div>

