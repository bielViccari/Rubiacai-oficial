<div>
    @if($successMessage != null)
                    @script
                        <script>
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '{{ $successMessage }}',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        </script>
                    @endscript
    @endif
    @if ($system)
        @script
        <script>
                Swal.fire({
    title: "Não estamos recebendo pedidos",
    text: "{{ $system->message }}",
    icon: "warning"
    });
        </script>
        @endscript
    @endif
    <div class="flex justify-center items-center">
        <h3 class="pb-4 font-semibold text-2xl text-gray-600">Veja os produtos</h3>
    </div>
    <div class="relative px-14">
        <input
            class="appearance-none  border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors rounded-md w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-gray-600 focus:border-gray-600 focus:shadow-outline"
            wire:model.live='searchProduct' type="text" placeholder="Buscar um produto..." />

        <div class="absolute inset-y-0 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 text-gray-400 hover:text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>
    <div id="card" class="flex justify-between px-14">
        <div id="montarAçai">
            <button type="button" wire:click="$dispatch('openModal', {component: 'makeAçaiPersonalized'})"
                class="rounded-md bg-purple-500 px-3.5 py-2.5 mt-5 text-sm font-semibold text-white shadow-sm hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Montar
                Açai</button>
        </div>
        <span class="pt-6 flex flex-row">
            @if ($nameOfCategoryFiltered)    
            <span class="">
                Filtrando por: {{ $nameOfCategoryFiltered }} 
            </span> 
            <svg wire:click='removeFilter' class="w-6 h-6 pt-1 text-gray-500 hover:text-gray-700 dark:text-white cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
              </svg>
              
            @endif
        </span>
        <div  class="py-2">
            <a wire:click="$dispatch('openModal', { component: 'cart' })"
                class="text-sm font-semibold leading-6 text-gray-900 hover:cursor-pointer pr-4 items-center flex">
                <span class="mt-3">Meu carrinho</span>
                <div class="relative py-2">
                    <div class="t-0 absolute left-3">
                        <p
                            class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-3 text-xs text-white">
                            {{ isset($carrinho) ? $totalProducts : 0 }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="file: mt-4 h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
            </a>
        </div>
    </div>
    <div class="flex flex-wrap justify-center flex-row">
        @if (count($products) == 0)
          <span class="pt-6 text-gray-600 font-semibold">Oops.. Nenhum produto encontrado... </span>  
        @endif
        @foreach ($products as $p)
        @if($p->category->name != "Frutas" && $p->category->name != "Adicionais")
            <div class="flex flex-col mx-2">
                <div class="relative my-2 w-full max-w-xs overflow-hidden rounded-lg bg-white shadow-md">
                    <a href="#" class="flex justify-center items-center">
                        <img class="h-60 w-60 rounded-t-lg object-cover"
                            src="storage/productImages{{ asset($p->image) }}" alt="product image" />
                    </a>
                    @if ($isNew)
                        <span
                            class="absolute top-0 left-0 w-28 translate-y-4 -translate-x-6 -rotate-45 bg-purple-500 text-center text-sm text-white">Novo</span>
                    @endif
                    <div class="mt-4 px-5 pb-5">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-slate-900">{{ $p->name }}</h5>
                        </a>
                        <div class="mt-2.5 mb-5 flex items-center">
                            <span
                                class="mr-2 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">{{ $p->category->name }}</span>
                        </div>
                        <p>
                            <span class="text-2xl font-bold text-slate-900">R$
                                {{ number_format($p->price, 2, ',', '.') }}</span>
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center mt-2">
                                <button wire:click='decrement({{ $p->id }})'
                                    class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <div
                                    class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none">
                                    {{ $quantities ? $quantities[$p->id] : 0 }}
                                </div>
                                <button wire:click='increment({{ $p->id }})'
                                    class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                            <a wire:click="addToCart({{ $p }},{{ $quantities ? $quantities[$p->id] : 1 }}); $dispatch('openModal', { component: 'cart' })"
                                href="#"
                                class="flex items-center rounded-md bg-purple-500 px-4 py-2 text-center text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Adicionar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
<div class="p-12">
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <span>{{ $products->links( data: ['scrollTo' => '#card']) }}</span>
    @endif
</div>

</div>
