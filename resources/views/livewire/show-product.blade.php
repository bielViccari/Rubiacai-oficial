<div class="flex justify-center items-center">
            <a class="flex justify-center items-center">
                <img class="h-60 w-60 rounded-t-lg object-cover" src="storage/productImages{{ asset($product->image) }}"
                    alt="product image" />
            </a>
            <div class="mt-4 px-5 pb-5">
                <a class="flex justify-between">
                    <h5 class="text-xl font-semibold tracking-tight text-slate-900">{{ $product->name }}</h5>
                    <button type="button" wire:click="$dispatch('closeModal')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                      </svg></button>
                </a>
                <div class="mt-2.5 mb-5 flex items-center">
                    <span
                        class="mr-2 rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-semibold">{{ $product->category->name }}</span>
                </div>
                <p class="flex flex-row justify-between">
                    <span class="text-2xl font-bold text-slate-900">R$
                        {{ number_format($product->price, 2, ',', '.') }}</span>
                </p>
                <p>
                    {{ $product->description }}
                </p>


                <div class="flex items-center justify-around mt-12">
                    <div class="inline-flex items-center mt-2">
                        <button wire:click='decrement({{ $product->id }})'
                            class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 12H4" />
                            </svg>
                        </button>
                        <div
                            class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none">
                            {{ $quantities ? $quantities[$product->id] : 0 }}
                        </div>
                        <button wire:click='increment({{ $product->id }})'
                            class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>

                        <a wire:click="addToCart({{ $product }},{{ $quantities ? $quantities[$product->id] : 1 }}); $dispatch('openModal', { component: 'cart' })"
                            class="flex items-center rounded-md bg-purple-500 px-4 py-2 text-center text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Adicionar ao carrinho</a>
                </div>
            </div>
</div>
