<div>
    <x-navbar />
    <div class="sm:ml-64 flex-1">
        <form wire:submit='update'>
            <div class="max-w-sm mx-auto mt-20 bg-white rounded-md shadow-md">
                <div class="px-6 py-4 bg-gray-900 text-white">
                    <h1 class="text-lg font-bold">Editando - {{ $category->name }}</h1>
                </div>
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="name">
                            Nome da Categoria
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
        
        
                    @if ($image instanceof \Illuminate\Http\UploadedFile)
                        <figure class="max-w-lg">
                            <img class="h-auto max-w-full rounded-lg" src="{{ $image->temporaryUrl() }}" alt="image description">
                            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Prévia da imagem</figcaption>
                        </figure>
                    @else
                        <figure class="max-w-lg">
                            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/categoryImages/' . $category->image) }}" alt="image description">
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
        
        
                    <div class="flex justify-end">
                        <button type="submit" class="bg-gray-900 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Salvar alterações
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@vite('resources/css/app.css')
</div>