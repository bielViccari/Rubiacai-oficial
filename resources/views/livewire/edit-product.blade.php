<div>
    <x-navbar />
    @livewire('wire-elements-modal')
<form wire:submit='update'>
    <div class="max-w-sm mx-auto mt-20 bg-white rounded-md shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-900 text-white">
            <h1 class="text-lg font-bold">Editando - {{ $product->name }}</h1>
        </div>
        <div class="px-6 py-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">
                    Nome do produto
                </label>
                <input
                    class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" type="text" placeholder="Açai 500ml"
                    wire:model="name"
                    >
                    @error('name')
                    <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="price">
                    Preço
                </label>
                <input
                    class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="price" type="text" placeholder="20,00"
                    wire:model='price'
                    >
                    @error('price')
                    <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
            </div>

            @if ($image)
                <figure class="max-w-lg">
                    <img class="h-auto max-w-full rounded-lg" src="{{ $image->temporaryUrl() }}" alt="image description">
                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Prévia da imagem</figcaption>
                </figure>
            @else
                <figure class="max-w-lg">
                    <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/productImages/' . $product->image) }}" alt="image description">
                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Prévia da imagem</figcaption>
                </figure>
            @endif
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Imagem do Produto</label>
                <input wire:model='image' accept="image/png, image/jpg, image/jpeg" class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
                @error('image')
                <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                @if ($errors->has('category_id'))
                    <label class="block text-red-700 font-bold mb-2" for="category_id">
                        Categoria do produto
                    </label>
                    <select id="category_id" wire:model='category_id' wire:change='checkCategory'
                        class="bg-red-50 border border-red-300 text-red-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                        <option value="">Selecione uma categoria</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <span
                        class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('category_id') }}</span>
                @else
                    <label class="block text-gray-700 font-bold mb-2" for="category_id">
                        Categoria do produto
                    </label>
                    <select id="category_id" wire:model='category_id' wire:change='checkCategory'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Selecione uma categoria</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                @endif
                <button type="button" wire:click="$dispatch('openModal', { component: 'modal-category' })"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-1 px-2 mt-2 rounded">
                Criar categoria
                </button>
                @if($needDescription)
                <label class="block text-gray-700 font-bold mb-2 mt-4" for="description">
                    descrição do produto
                </label>
                    <textarea name="description" id="description" cols="30" rows="3" wire:model='description'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-gray-900 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Salvar Produto
                </button>
            </div>
        </div>
    </div>
</form>
@vite('resources/css/app.css')
</div>

