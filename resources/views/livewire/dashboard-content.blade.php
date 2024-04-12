<div class="p-4 sm:ml-64 flex justify-center items-center bg-gray-200 flex-col">
    <h1 class="text-center font-bold text-gray-600 mb-2 uppercase">Tabela de pedidos</h1>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Endereço</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">preço
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
                    <tr wire:key="{{ strval($o['id']) }}">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $o['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $o['address'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($o['price'], 2, '.', ',') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $o['status'] == 'n' ? 'bg-red-200 text-red-800' : ($o['status'] == 'd' ? 'bg-green-200 text-green-800' : 'bg-orange-200 text-orange-800') }}">{{ $o['status'] === 'd' ? 'Entregue' : ($o['status'] === 'i' ? 'Em Processo' : 'Não Entregue') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button type="button"
                            wire:click="viewOrder({{ $o['id'] }})"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Ver</button>
                            <button
                                class="ml-2 px-4 py-2 font-medium text-white bg-orange-600 rounded-md hover:bg-orange-500 focus:outline-none focus:shadow-outline-orange active:bg-orange-600 transition duration-150 ease-in-out">Editar</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <x-main-modal title="Pedido" id="order-modal" wire:model="modal">
            @if(isset($selectedOrder))
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
                                <span wire:click='deleteProduct({{ $p->id }})' wire:confirm="Deletar produto ?"
                                    class="text-red-500 text-sm font-semibold cursor-pointer">Apagar</span>
                            </div>
                        </div>
                    </div>
                @endforeach
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
