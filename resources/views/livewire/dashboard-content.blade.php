<div class="p-4 sm:ml-64 flex justify-center items-center bg-gray-200">
    <div class="w-10/12">
        @if ($products) 
            <span class="px-6 font-bold text-gray-500">Listagem de produtos - Total de {{ $products->total() }} produtos</span>
            <div class="flex flex-wrap gap-4 p-6 justify-center text-lg">
                @foreach ($products as $p)   
                    <a href="#"
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $p->name }}</span>
                        <img width="40px" height="40px" src="storage/productImages/{{ $p->image }}" alt="">
                        <div class="text-gray-500 text-sm pt-1 flex flex-col">
                            <span><strong>Categoria:</strong> {{ $p->category->name }}</span>
                            <span>Preço: R${{ number_format($p->price, 2, ',', '.') }}</span>
                        </div>

                        <div class="text-gray-500 text-sm pt-1 flex flex-row justify-items-end">
                            <span class="text-orange-500 text-sm font-semibold pr-4">Editar</span>
                            <span wire:click='deleteProduct({{ $p->id }})' class="text-red-500 text-sm font-semibold pl-4">Apagar</span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-end pb-12">
                <span>{{ $products->links('vendor.pagination.personalized') }}</span>
            </div>
        @endif

        @if ($categories)         
            <span class="px-6 font-bold text-gray-500">Listagem de categorias - Total de {{ count($categories) }} categorias</span>
            <div class="flex flex-wrap gap-4 p-6 justify-center text-lg">
                @foreach ($categories as $c)   
                    <a href="#"
                        class="bg-gray-100 flex-grow text-black border-l-8 border-gray-500 shadow px-3 py-2 w-full md:w-5/12 lg:w-3/12">
                        <span class="text-gray-700 font-bold">{{ $c->name }}</span>
                        <div class="justify-center items-center">
                            <img width="40px" height="40px" src="storage/categoryImages/{{ $c->image }}" alt="">
                        </div>
                        <div class="text-gray-500 text-sm pt-1 flex flex-row justify-items-end">
                            <span class="text-orange-500 text-sm font-semibold pr-4">Editar</span>
                            <span wire:click='deleteCategory({{ $c->id }})' class="text-red-500 text-sm font-semibold pl-4">Apagar</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
 </div>
