<div id="modal" class="relative bg-gray-200 rounded-lg shadow dark:bg-gray-700">
    @if ($successMessage != null)
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
    @if ($errorMessage != null)
        @script
            <script>
                Swal.fire({
                    title: "Estamos fechados !",
                    text: "{{ $errorMessage }}",
                    icon: "warning"
                });
            </script>
        @endscript
    @endif
    <!-- Modal header -->
    <div class="flex items-center justify-between pl-5 md:pl-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white pt-4">
            Montar Açai
        </h3>
        <button type="button" wire:click="dispatch('closeModal')"
            class="text-gray-400 bg-transparent hover:bg-gray-200 pr-4 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Fechar modal</span>
        </button>
    </div>
    <div class="flex items-center justify-center border-b rounded-t dark:border-gray-600">
        <img width="150px" height="150px" src="{{ asset('images/rubiacai.png') }}" alt="">
    </div>
    <!-- Modal body -->
    @if (isset($acai))

        <form class="p-4 md:p-5">
            @if ($closed == true)
                <span
                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Não
                    estamos aceitando pedido, abrimos de Terça-feira à Domingo das 15:00 às 21:00</span>
            @endif
            <div class="grid gap-4 mb-4 grid-cols-2">
                @if ($errors->has('size'))
                    <div class="col-span-2 sm:col-span-1">
                        <label for="size"
                            class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">Tamanho</label>
                        <select id="size" wire:model='size' wire:change='updateSizePrice'
                            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500">
                            <option value="">selecionar tamanho</option>
                            @foreach ($acai as $p)
                                <option value="{{ $p->name }}">{{ $p->name }} -
                                    R${{ number_format($p->price, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">Selecione o tamanho do seu açai</p>
                    </div>
                @else
                    <div class="col-span-2 sm:col-span-1">
                        <label for="tamanho"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tamanho</label>
                        <select id="tamanho" wire:model='size' wire:change='updateSizePrice'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">selecionar tamanho</option>
                            @foreach ($acai as $p)
                                <option value="{{ $p->name }}">{{ $p->name }} -
                                    R${{ number_format($p->price, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($errors->has('quantity'))
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">quantidade</label>
                        <select id="category" wire:model='quantity' wire:change='updateSizePriceByQuantity'
                            class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500">
                            <option value="">Selecionar quantidade</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">Selecione a quantidade de açai que você deseja</p>
                    </div>
                @else
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">quantidade</label>
                        <select id="category" wire:model='quantity' wire:change='updateSizePriceByQuantity'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="">Selecionar quantidade</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                @endif
            </div>
            <div class="flex flex-col mt-6 justify-center items-center">
                <span class="font-bold text-gray-600 uppercase">Selecionar complementos</span>
            </div>
            <div class="flex flex-col mt-6">
                <span class="font-bold text-gray-600">Frutas:</span>
            </div>
            @if (isset($fruits))
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-5">
                    @foreach ($fruits as $f)
                        <section class="text-gray-700 body-font">
                            <div class="container px-2 py-2 mx-auto">
                                <div class="flex flex-col justify-center items-center">
                                    <div class="border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <div class=" flex items-center justify-center">
                                            <img src="storage/productImages/{{ $f->image }}"
                                                class=" object-center w-24 h-24 mt-2" alt="{{ $f->name }}">
                                        </div>
                                        <div class="p-2 flex items-center justify-center flex-col">
                                            <h2 class="text-lg font-medium text-gray-900">{{ $f->name }}</h2>
                                            <p class="mt-2 text-sm text-gray-500">
                                                R${{ number_format($f->price, 2, ',', '.') }}</p>
                                            <div class="flex justify-center mt-2">
                                                <button wire:click.prevent='decrement({{ $f->id }})'
                                                    class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-gray-600 inline-flex items-center px-4 py-1 select-none">
                                                    {{ $quantities[$f->id] }}
                                                </div>
                                                <button wire:click.prevent='increment({{ $f->id }})'
                                                    class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
            @endif
            <div class="flex flex-col">
                <span class="font-bold text-gray-600">Adicionais:</span>
            </div>
            @if (isset($aditionals))
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-5">
                    @foreach ($aditionals as $a)
                        <section class="text-gray-700 body-font">
                            <div class="container px-2 py-2 mx-auto">
                                <div class="flex flex-col justify-center items-center">
                                    <div class="border-2 border-gray-300 rounded-lg overflow-hidden">
                                        <div class=" flex items-center justify-center">
                                            <img src="storage/productImages/{{ $a->image }}"
                                                class=" object-center w-24 h-24 mt-2" alt="{{ $a->name }}">
                                        </div>
                                        <div class="p-2 flex items-center justify-center flex-col">
                                            <h2 class="text-lg font-medium text-gray-900">{{ $a->name }}</h2>
                                            <p class="mt-2 text-sm text-gray-500">
                                                R${{ number_format($a->price, 2, ',', '.') }}</p>
                                            <div class="flex justify-center mt-2">
                                                <button wire:click.prevent='decrement({{ $a->id }})'
                                                    class="bg-white rounded-l border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <div
                                                    class="text-gray-600 inline-flex items-center px-4 py-1 select-none">
                                                    {{ $quantities[$a->id] }}
                                                </div>
                                                <button wire:click.prevent='increment({{ $a->id }})'
                                                    class="bg-white rounded-r border text-gray-600 hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
            @endif

            <div class="col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observação:</label>
                <textarea id="description" rows="4" wire:model='observation'
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Obs..."></textarea>
            </div>

            <div class="flex justify-center items-center flex-col">
                <p class="text-lg text-gray-500 mb-4 mt-2">Total a pagar: R$ {{ number_format($totalPrice, 2, ',', '.') }}</p>
                <div class="flex justify-between">
                        <button type="button" wire:click="addToCart"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                            </svg>

                            Adicionar ao carrinho
                        </button>
                </div>
            </div>
        </form>
    @else
        <span>Nenhum produto adicionado...</span>
    @endif
</div>
