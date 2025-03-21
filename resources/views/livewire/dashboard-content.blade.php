<div class="p-4 sm:ml-64 flex justify-center items-center bg-gray-200 flex-col">
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '{{ Session('success') }}',
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif

    @if ($successMessage != null)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
        integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

    <main>

    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
        </nav>
        <section>
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
                <div class=" bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">RELATÓRIOS</h1>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600"><i
                                            class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Faturamento total</h2>
                                    <p class="font-bold text-3xl">R$ {{ $invoicedAmountFormated == null ? '00,00' : $invoicedAmountFormated }}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <!--/Metric Card-->
                    </div>

                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600"><i
                                            class="fa fa-credit-card fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">faturamento do dia</h2>
                                    <p class="font-bold text-3xl">R$ {{ $valueOrderDiary == null ? '00,00' :  number_format($valueOrderDiary, 2, ',', '.')}}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>

                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600"><i
                                            class="fa fa-credit-card fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Faturamento da semana</h2>
                                    <p class="font-bold text-3xl">R$ {{ $valueOrderWeek == null ? '00,00' :  number_format($valueOrderWeek, 2, ',', '.')}}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>

                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600"><i
                                            class="fa fa-credit-card fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Faturamento do mês</h2>
                                    <p class="font-bold text-3xl">R$ {{ $valueOrderMonthly == null ? '00,00' : number_format($valueOrderMonthly, 2, ',', '.')}}</p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>

                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600"><i
                                            class="fa fa-cart-arrow-down fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Pedidos entregue</h2>
                                    <p class="font-bold text-3xl">
                                        {{ $totalOrdersDelivered > 0 ? $totalOrdersDelivered : 0 }} <span
                                            class="text-green-500"></span></p>
                                </div>
                            </div>
                        </div>

                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-yellow-600"><i
                                            class="fas fa-cart-plus fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Pedidos em processo</h2>
                                    <p class="font-bold text-3xl">
                                        {{ $totalOrdersInProcess > 0 ? $totalOrdersInProcess : 0 }} <span
                                            class="text-yellow-600"></span></p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div
                            class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-red-600"><i
                                            class="fas fa-shopping-cart fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Pedidos não entregue</h2>
                                    <p class="font-bold text-3xl">
                                        {{ $totalOrdersNotDelivered > 0 ? $totalOrdersNotDelivered : 0 }} <span
                                            class="text-red-500"></span></p>
                                </div>
                            </div>
                        </div>

                        <!--/Metric Card-->
                    </div>
                </div>


                <div class="flex flex-row flex-wrap flex-grow mt-2">

                    <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                        <!--Graph Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-xl">
                            <div
                                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                <h class="font-bold uppercase text-gray-600">PEDIDOS DO SISTEMA</h>
                            </div>
                            <div class="p-5">
                                <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                                <script>
                                    new Chart(document.getElementById("chartjs-7"), {
                                        "type": "bar",
                                        "data": {
                                            "labels": @json($months),
                                            "datasets": [{
                                                "label": "Pedidos não entregue",
                                                "data": @json($undeliveredOrderCounts),
                                                "borderColor": "rgb(255, 99, 132)",
                                                "backgroundColor": "rgba(255, 99, 132, 0.2)"
                                            }, {
                                                "label": "Pedidos entregue",
                                                "data": @json($deliveredOrderCounts),
                                                "type": "line",
                                                "fill": false,
                                                "borderColor": "rgb(54, 162, 235)"
                                            }]
                                        },
                                        "options": {
                                            "scales": {
                                                "yAxes": [{
                                                    "ticks": {
                                                        "beginAtZero": true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <!--/Graph Card-->
                    </div>

                    <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                        <!--Graph Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-xl">
                            <div
                                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                <h2 class="font-bold uppercase text-gray-600">PRODUTOS SOLICITADOS NO MÊS</h2>
                            </div>
                            <div class="p-5">
                                <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        new Chart(document.getElementById("chartjs-1"), {
                                            type: "bar",
                                            data: {
                                                labels: @json($productsGraph),
                                                datasets: [{
                                                    label: "PRODUTOS",
                                                    data: @json($productsOrderCounts),
                                                    fill: false,
                                                    backgroundColor: [
                                                        "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                                                        "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)",
                                                        "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)",
                                                        "rgba(201, 203, 207, 0.2)"
                                                    ],
                                                    borderColor: [
                                                        "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                                                        "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)",
                                                        "rgb(201, 203, 207)"
                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <!--/Graph Card-->
                    </div>
                </div>
            </div>
        </section>
    </div>
    </main>

    @if ($system)
        @if ($system->status == 1)
            <main id="content" role="main" class="w-full  max-w-md mx-auto p-6">
                <div
                    class="mt-7 bg-white  rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 border-2 border-gray-300">
                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Reativar pedidos</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Os usuarios não estão podendo fazer pedidos no sistema, ative para receber pedidos
                                novos!
                            </p>
                        </div>
                        <div class="mt-5">
                            <form wire:submit='openSystem()'>
                                <div class="grid gap-y-4">
                                    <div>
                                        <label for="message"
                                            class="block text-sm font-bold ml-1 mb-2 dark:text-white">Texto do aviso
                                            atual</label>
                                        <div class="relative">
                                            <span
                                                class="py-3 px-4 text-gray-600 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">{{ $system->message }}</span>
                                        </div>
                                        @error('message')
                                            <p class="text-xs text-red-600 mt-2" id="message-error">Insira um texto para o
                                                aviso.</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">Permitir
                                        pedidos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        @else
            <main id="content" role="main" class="w-full  max-w-md mx-auto p-6">
                <div
                    class="mt-7 bg-white  rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 border-2 border-gray-300">
                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Desativar pedidos</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                Feriado? folga? reforma? desative os novos pedidos enquanto estão ocupados.
                            </p>
                        </div>
                        <div class="mt-5">
                            <form wire:submit='closeSystem()'>
                                <div class="grid gap-y-4">
                                    <div>
                                        <label for="message"
                                            class="block text-sm font-bold ml-1 mb-2 dark:text-white">Texto do
                                            aviso</label>
                                        <div class="relative">
                                            <input wire:model='message' type="text" id="message" name="message"
                                                class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                                required aria-describedby="message-error">
                                        </div>
                                        @error('message')
                                            <p class="text-xs text-red-600 mt-2" id="message-error">Insira um texto para o
                                                aviso.</p>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">Desativar
                                        pedidos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        @endif
    @endif
    <h1 class="text-center font-bold text-gray-600 mb-2 uppercase">Tabela de pedidos</h1>
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Telefone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($orders)
                    @foreach ($orders as $o)
                        <tr class="{{ $o['isNew'] == true ? 'bg-green-100' : 'bg-white' }}"
                            wire:key="{{ strval($o['id']) }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><a target="_blank" class="text-blue-500"
                                    href="https://api.whatsapp.com/send?phone={{ $o['phone'] }}">{{ $o['phone'] }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $o['created_at'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $o['status'] == 'n' ? 'bg-red-200 text-red-800' : ($o['status'] == 'd' ? 'bg-green-200 text-green-800' : 'bg-orange-200 text-orange-800') }}">{{ $o['status'] === 'd' ? 'Entregue' : ($o['status'] === 'i' ? 'Em Processo' : 'Não Entregue') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" wire:click="viewOrder({{ $o['id'] }})"
                                    class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Ver</button>
                                <button wire:click="deleteOrder({{ $o['id'] }})"
                                    wire:confirm="Tem certeza que deseja excluir este pedido?"
                                    class="ml-2 px-4 py-2 font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:shadow-outline-orange active:bg-orange-600 transition duration-150 ease-in-out">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <x-main-modal title="Pedido" id="order-modal" wire:model="modal">
        @if (isset($selectedOrder))
            <livewire:show-invoice :order="$selectedOrder" />
        @endif
    </x-main-modal>

    <div class="w-10/12 pt-12">
        <h1 class="text-center font-bold text-gray-600 mb-8 uppercase">Listagem de produtos e categorias do sistema</h1>
        @if ($products)
            @if (session('success'))
                <span>{{ session('status') }}</span>
            @endif
            <div class="relative sm:w-96 w-64">
                <input
                    class="appearance-none  border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors rounded-md w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-gray-600 focus:border-gray-600 focus:shadow-outline"
                    wire:model.live='search' type="text" placeholder="Buscar um produto..." />

                <div class="absolute left-0 inset-y-0 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 text-gray-400 hover:text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <span class="px-6 font-bold text-gray-500">Listagem de produtos - Total de {{ $products->total() }}
                produtos</span>
            <div class="flex flex-wrap gap-4 p-6 justify-center text-lg">
                @foreach ($products as $p)
                    <div
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $p->name }}</span>
                        <img width="40px" height="40px" src="storage/productImages/{{ $p->image }}"
                            alt="">
                        <div class="text-gray-500 text-sm pt-1 flex flex-col">
                            <span><strong>Categoria:</strong> {{ $p->category->name }}</span>
                            <span>Preço: R${{ number_format($p->price, 2, ',', '.') }}</span>
                        </div>

                        <div class="text-gray-500 text-sm pt-1 flex flex-row justify-start">
                            <div class="mr-4">
                                <a href="{{ route('edit.product', $p->id) }}"
                                    class="text-orange-500 text-sm font-semibold">Editar</a>
                            </div>
                            <div>
                                <span wire:click='deleteProduct({{ $p->id }})'
                                    wire:confirm="Deletar produto ?"
                                    class="text-red-500 text-sm font-semibold cursor-pointer">Apagar</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end pb-12">
                @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <span>{{ $products->links(data: ['scrollTo' => '#card']) }}</span>
                @endif
            </div>
        @endif

        @if ($categories)
            <div class="relative sm:w-96 w-64">
                <input
                    class="appearance-none  border-2 pl-10 border-gray-300 hover:border-gray-400 transition-colors rounded-md w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:ring-gray-600 focus:border-gray-600 focus:shadow-outline"
                    wire:model.live='searchCategory' type="text" placeholder="Buscar um produto..." />

                <div class="absolute left-0 inset-y-0 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 text-gray-400 hover:text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <span class="px-6 font-bold text-gray-500">Listagem de categorias - Total de {{ count($categories) }}
                categorias</span>
            <div class="flex flex-wrap gap-4 p-6 justify-center text-lg">
                @foreach ($categories as $c)
                    <div
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $c->name }}</span>
                        <div class="justify-center items-center">
                            <img width="40px" height="40px" src="storage/categoryImages/{{ $c->image }}"
                                alt="">
                        </div>
                        <a href="{{ route('edit.category', $c->id) }}"
                            class="text-orange-500 text-sm pl-2 pr-4 font-semibold cursor-pointer">Editar</a>

                        <span wire:click='deleteCategory({{ $c->id }})'
                            wire:confirm="Deletar Categoria ? Todos os produtos relacionados à esta categoria serão apagados !"
                            class="text-red-500 text-sm font-semibold cursor-pointer">Apagar</span>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end pb-12">
                <span>{{ $categories->links('vendor.pagination.personalized') }}</span>
            </div>
        @endif
    </div>

    @livewire('wire-elements-modal')
</div>
