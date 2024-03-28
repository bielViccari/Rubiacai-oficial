<div>
    <div class="flex flex-wrap justify-center flex-row">
        @foreach ($products as $p)
            <div class="flex flex-col">
                <div class="relative m-10 w-full max-w-xs overflow-hidden rounded-lg bg-white shadow-md">
                    <a href="#" class="flex ">
                        <img class="h-60 rounded-t-lg object-cover"
                            src="storage/productImages{{ asset($p->image) }}"
                            alt="product image" />
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
                            <span class="mr-2 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">{{ $p->category->name }}</span>
                        </div>
                        <p>
                            <span class="text-2xl font-bold text-slate-900">R$ {{ number_format($p->price, 2, ',', '.') }}</span>
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center mt-2">
                                <button
                                    wire:click='decrement({{ $p->id }})'
                                    class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <div
                                    class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none">
                                    {{ $quantities[$p->id] }}
                                </div>
                                <button
                                    wire:click='increment({{ $p->id }})'
                                    class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                            <a 
                                wire:click='addToCart({{ $p }},{{ $quantities[$p->id] }})'
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
        @endforeach
    </div>
</div>
