<div class="z-50">
    <div class="flex items-center justify-center flex-col mt-12">
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
        @if ($closed == true)
            <span
                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Não
                estamos aceitando pedido, abrimos de Terça-feira à Domingo das 15:00 às 21:00</span>
        @endif
    </div>

    <div class=" mt-8 md:mt-12">
        <div class="rounded-3xl bg-white shadow-lg">
            <div class="px-4 py-6 sm:px-8 sm:py-10">
                <div class="flow-root">
                    <ul class="-my-8">
                        @if ($carrinho)
                            <h1 class="text-2xl font-semibold text-gray-900">Meu Carrinho</h1>
                            @foreach ($carrinho as $c)
                                @if (isset($c['name']))
                                    <!-- Verifica se é um produto padrão -->
                                    <li
                                        class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                        <div class="shrink-0 relative">
                                            <span
                                                class="absolute top-1 left-1 flex h-6 w-6 items-center justify-center rounded-full border bg-gray-200 text-sm font-medium text-purple-500 shadow sm:-top-2 sm:-right-2">{{ $c['quantity'] }}</span>
                                            <img class="h-24 w-24 max-w-full rounded-lg object-cover"
                                                src="storage/productImages/{{ $c['image'] }}" alt="" />
                                        </div>
                                        <div class="relative flex flex-1 flex-col justify-between">
                                            <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                                <div class="pr-8 sm:pr-5">
                                                    <p class="text-base font-semibold text-gray-900">
                                                        {{ $c['name'] }} </p>
                                                    <p class="mx-0 mt-1 mb-0 text-sm text-gray-400"></p>
                                                </div>
                                                <div
                                                    class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                                    <p
                                                        class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">
                                                        R${{ number_format($c['price'], 2, ',', '.') }}</p>
                                                </div>
                                            </div>
                                            <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                                <button wire:click='removeProduct({{ $c['id'] }})' type="button"
                                                    class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" class="">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                @endif
                            @endforeach
                            @if (isset($carrinho['acaiPersonalizado']))
                                @foreach ($carrinho['acaiPersonalizado'] as $index => $acai)
                                    @if (is_array($acai))
                                        <li
                                            class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
                                            <div class="relative flex flex-1 flex-col justify-between">
                                                <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
                                                    <div class="pr-8 sm:pr-5">
                                                        <p class="text-base font-semibold text-gray-900">
                                                            {{ $acai['quantidade'] }}x - Açai Montado</p>
                                                        @if (isset($acai['tamanho']))
                                                            <div class="relative">
                                                                <details class="mb-2">
                                                                    <summary class="text-gray-900 cursor-pointer mb-1">
                                                                        <span class="font-semibold">Ver itens</span>
                                                                    </summary>
                                                                    <ul
                                                                        class="absolute top-full left-0 mt-1 ml-0 max-h-[20rem] overflow-y-auto bg-white p-2  z-50">
                                                                        @if ($acai['frutas'])
                                                                            <li>
                                                                                <details class="mb-2">
                                                                                    <summary
                                                                                        class="bg-gray-100 p-3 rounded-lg cursor-pointer shadow">
                                                                                        <span
                                                                                            class="font-semibold">Frutas</span>
                                                                                    </summary>
                                                                                    @foreach ($acai['frutas'] as $i => $fruta)
                                                                                        <div class="bg-white p-4">
                                                                                            <p class="text-gray-800">
                                                                                                @if (isset($acai['frutas_quantidade'][$i]))

                                                                                                    {{ $acai['frutas_quantidade'][$i] }}x
                                                                                                    -
                                                                                                @endif
                                                                                                {{ $fruta->name }} - R$
                                                                                                {{ number_format($fruta->price, 2, ',', '.') }}
                                                                                            </p>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </details>
                                                                            </li>
                                                                        @endif
                                                                        @if ($acai['adicionais'])
                                                                            <li>
                                                                                <details class="mb-2">
                                                                                    <summary
                                                                                        class="bg-gray-100 p-3 rounded-lg cursor-pointer shadow">
                                                                                        <span
                                                                                            class="font-semibold">Adicionais</span>
                                                                                    </summary>
                                                                                    @foreach ($acai['adicionais'] as $i => $adicionais)
                                                                                        <div class="bg-white p-4">
                                                                                            <p class="text-gray-800">
                                                                                                @if (isset($acai['adicionais_quantidade'][$i]))
                                                                                                    QTD
                                                                                                    {{ $acai['adicionais_quantidade'][$i] }}
                                                                                                @endif
                                                                                                {{ $adicionais->name }}
                                                                                                - R$
                                                                                                {{ number_format($adicionais->price, 2, ',', '.') }}
                                                                                            </p>

                                                                                        </div>
                                                                                    @endforeach
                                                                                </details>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </details>
                                                                </p>
                                                            </div>
                                                        @endif

                                                        @if (isset($acai['observação']))
                                                            <p class="mx-0 mt-1 mb-0 text-sm text-gray-400">
                                                                {{ $acai['observação'] }}</p>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                                                        <p
                                                            class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">
                                                            R$
                                                            {{ number_format($valorUnitarioAcaiPersonalizado[$index], 2, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
                                                    <button wire:click='removeAcaiPersonalizado({{ $index }})'
                                                        type="button"
                                                        class="flex rounded text-center text-gray-500 transition-all duration-200 ease-in-out hover:text-gray-900">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"
                                                                class=""></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <hr>
                                    @endif
                                @endforeach
                            @endif

                        @endif
                        @if (!$carrinho)
                            <div class="flex flex-col justify-center items-center">

                                <img class="w-full h-full" src="images/empty-cart.png" alt="" srcset="">
                            </div>
                        @endif
                    </ul>
                </div>

                <!-- <hr class="mx-0 mt-6 mb-0 h-0 border-r-0 border-b-0 border-l-0 border-t border-solid border-gray-300" /> -->
                @if ($carrinho)
                    <div class="mt-6 space-y-3 border-t border-b py-8">
                        <div class="flex items-center justify-between">
                            <p class="text-gray-400">Subtotal</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ number_format($precoTotal, 2, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-400">Entrega</p>
                            <p class="text-lg font-semibold text-gray-900">R$1,00</p>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900">Total</p>
                        <p class="text-2xl font-semibold text-gray-900"><span
                                class="text-xs font-normal text-gray-400">R$</span>{{ number_format($precoTotal + 1, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="mt-6 text-center flex flex-col">
                        @if ($closed == true || $system && $system->status == 1)
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Não
                                estamos aceitando pedido</span>
                            <button type="button" disabled
                                class="group inline-flex w-full items-center justify-center rounded-md bg-purple-500 px-6 py-4 text-lg font-semibold text-white">
                                Gerar pedido
                                <svg xmlns="http://www.w3.org/2000/svg" class=" ml-4 h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        @else
                            <button type="button" wire:click="$dispatch('openModal', {component: 'invoice'})"
                                class="group inline-flex w-full items-center justify-center rounded-md bg-purple-500 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-purple-800">
                                Gerar pedido
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        @endif
                        <span class="text-gray-400 text-sm pt-2">ou</span>
                        <a wire:click="$dispatch('closeModal')"
                            class=" text-gray-600 cursor-pointer font-bold text-sm py-2 px-4 rounded">Continuar
                            comprando</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
