<div class="p-4 sm:ml-64 flex justify-center items-center bg-gray-200">
    <div class="w-10/12">
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
                    <a href="#"
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $p->name }}</span>
                        <img width="40px" height="40px" src="storage/productImages/{{ $p->image }}"
                            alt="">
                        <div class="text-gray-500 text-sm pt-1 flex flex-col">
                            <span><strong>Categoria:</strong> {{ $p->category->name }}</span>
                            <span>Preço: R${{ number_format($p->price, 2, ',', '.') }}</span>
                        </div>

                        <div class="text-gray-500 text-sm pt-1 flex flex-row justify-items-end">
                            <span wire:click.live="$dispatch('openModal', {component: 'EditProduct', id: {{ $p->id }}});" class="text-orange-500 text-sm font-semibold pr-4">Editar</span>
                            <span wire:click='deleteProduct({{ $p->id }})' wire:confirm="Deletar produto ?"
                                class="text-red-500 text-sm font-semibold pl-4">Apagar</span>
                        </div>
                    </a>
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
                    <a href="#"
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $c->name }}</span>
                        <div class="justify-center items-center">
                            <img width="40px" height="40px" src="storage/categoryImages/{{ $c->image }}"
                                alt="">
                        </div>
                        <div class="text-gray-500 text-sm pt-1 flex flex-row justify-items-end">
                            <span class="text-orange-500 text-sm font-semibold pr-4">Editar</span>
                            <span wire:click='deleteCategory({{ $c->id }})'
                                wire:confirm="Deseja apagar categoria?\n Todos os produtos relacionados a esta categoria serão deletados!!!"
                                class="text-red-500 text-sm font-semibold pl-4">Apagar</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-end pb-12">
                <span>{{ $categories->links('vendor.pagination.personalized') }}</span>
            </div>
        @endif

        <div class="shadow-lg rounded-lg overflow-hidden">
            <table class="w-full table-fixed">
                <h1 class="text-center font-bold text-gray-600 mb-2 uppercase">Tabela de pedidos</h1>
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Nome Cliente</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Endereço</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Phone</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status</th>
                        <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Alterar Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($orders)
                        @foreach ($orders as $o)
                            <tr>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $o['name'] }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 truncate">{{ $o['address'] }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $o['phone'] }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs">Pedido entregue</span>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <button class="bg-blue-500 text-white py-1 px-2 rounded text-xs">Alterar</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <td class="py-4 px-6 border-b border-gray-200">Jane Doe</td>
                        <td class="py-4 px-6 border-b border-gray-200 truncate">janedoe@gmail.com</td>
                        <td class="py-4 px-6 border-b border-gray-200">555-555-5555</td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            <span class="bg-red-500 text-white py-1 px-2 rounded-full text-xs">Inactive</span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    @livewire('wire-elements-modal')
</div>
