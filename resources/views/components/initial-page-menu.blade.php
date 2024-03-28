<script>
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        if (window.scrollY > 0) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

<style>
    .scrolled {
        background-color: rgba(150, 131, 236, 0.3);
        backdrop-filter: blur(10px);
    }
</style>

<nav class="flex items-center justify-between p-2 lg:px-8 navbar fixed top-0 left-0 right-0 transition-all duration-300">
    <div class="flex lg:flex-1">
        <a class="-m-1.5 p-1.5">
            <span class="sr-only">Rubiaçai</span>
            <img class="h-12 w-auto" src="{{ asset('images/rubiacai.png') }}" alt="">
        </a>
    </div>
    <!-- Botão para abrir slideOver do Carrinho -->
    <div class="flex lg:hidden">
        <a  wire:click="$dispatch('openModal', { component: 'cart' })"
            id="botao-abrir-slideover-mobile"
            class="text-sm font-semibold leading-6 text-gray-900 hover:cursor-pointer pr-4 items-center flex">
            Carrinho <span aria-hidden="true" style="margin-left: 5px;"><x-zondicon-shopping-cart
                    width="15px" height="15px" /></span>
        </a>
        <!-- Hamburguer para abrir menu mobile-->
        <button id="open-menu" type="button"
            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Abrir menu principal</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Produtos</a>
        <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Categorias</a>
        <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Sobre Nós</a>
    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a  wire:click="$dispatch('openModal', { component: 'cart' })"
            id="botao-abrir-slideover"
            class="text-sm font-semibold leading-6 text-gray-900 hover:cursor-pointer"
            style="display: flex; align-items: center;">
            Carrinho <span aria-hidden="true" style="margin-left: 5px;"><x-zondicon-shopping-cart
                    width="15px" height="15px" /></span>
        </a>
    </div>
</nav>
@livewire('wire-elements-modal')
