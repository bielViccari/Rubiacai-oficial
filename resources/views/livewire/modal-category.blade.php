<div>
        <x-modal-category form-action="createCategory">
            <x-slot name="title">
                Cadastrar Categoria
            </x-slot>
            <x-slot name="content">
                <form wire:submit='createCategory'>
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="name">
                                Nome da categoria
                            </label>
                            <input
                                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Açai 500ml" wire:model="name">
                            @error('name')
                                <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <!-- Prévia da Imagem -->
                        <div class="mb-4 text-center">
                            <!-- Adicionado text-center para centralizar o conteúdo horizontalmente -->
                            <label class="block mb-2 text-sm font-medium text-gray-900"
                                for="image">Imagem da categoria</label>
                            <div class="mx-auto w-32 h-32 bg-gray-200 rounded-lg overflow-hidden">
                                @if ($image)
                                    <img class="h-full w-full object-cover" src="{{ $image->temporaryUrl() }}"
                                        alt="Prévia da imagem">
                                @endif
                            </div>
                            <input wire:model='image' accept="image/png, image/jpg, image/jpeg"
                                class="block w-full mt-2 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="small_size" type="file">
                            @error('image')
                                <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Salvar Categoria
                        </button>
                    </div>
    
                </form>
            </x-slot>
    
            <x-slot name="buttons">
                <button wire:click="$dispatch('closeModal')"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cancelar</button>
            </x-slot>
        </x-modal-category>
</div>
