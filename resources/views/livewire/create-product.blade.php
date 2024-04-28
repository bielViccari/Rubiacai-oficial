<div>
    @if($successMessage != null)
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
    @livewire('wire-elements-modal')
    <x-navbar />
    <form wire:submit='save'>
        <div class="max-w-sm mx-auto mt-20 bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-900 text-white">
                <h1 class="text-lg font-bold">Cadastrar produto</h1>

                <!-- Spinner SVG -->
                @if ($showLoading)
                    <div
                        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; z-index: 9999;">
                        <img src="images/spinner.svg" alt="" srcset="">
                    </div>
                @endif
            </div>
            <div class="px-6 py-4">
                <!-- Nome do Produto -->
                <div class="mb-4">
                    @if ($errors->has('name'))
                        <label class="block text-red-700 font-bold mb-2" for="name">
                            Nome do produto
                        </label>
                        <input
                            class="appearance-none border border-red-400 rounded w-full py-2 px-3 text-red-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name" type="text" placeholder="Açaí 500ml" wire:model="name">
                        <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('name') }}</span>
                    @else
                        <label class="block text-gray-700 font-bold mb-2" for="name">
                            Nome do produto
                        </label>
                        <input
                            class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name" type="text" placeholder="Açaí 500ml" wire:model="name">
                    @endif
                </div>

                <!-- Preço -->
                <div class="mb-4">
                    @if ($errors->has('price'))
                        <label class="block text-red-700 font-bold mb-2" for="price">
                            Preço
                        </label>
                        <input
                            class="appearance-none border border-red-400 rounded w-full py-2 px-3 text-red-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="price" type="text" placeholder="20,00" wire:model='price'>
                        <span class="mt-2 text-xs text-red-600 dark:text-red-400">O preço deve ser somente numeros, por ex: 12.99 ou 12,99</span>
                    @else
                        <label class="block text-gray-700 font-bold mb-2" for="price">
                            Preço
                        </label>
                        <input
                            class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="price" type="text" placeholder="20,00" wire:model='price'>
                    @endif
                </div>

                <!-- Prévia da Imagem -->
                <div class="mb-4 text-center">
                    <!-- Adicionado text-center para centralizar o conteúdo horizontalmente -->
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Imagem do
                        Produto</label>
                    <div class="mx-auto w-32 h-32 bg-gray-200 rounded-lg overflow-hidden">
                        @if ($image)
                            <img class="h-full w-full object-cover" src="{{ $image->temporaryUrl() }}"
                                alt="Prévia da imagem">
                        @endif
                    </div>
                    <input wire:model='image' accept="image/png, image/jpg, image/jpeg"
                        class="block w-full mt-2 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="small_size" type="file">
                    @if ($errors->has('image'))
                        <span class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errors->first('image') }}</span>
                    @endif
                </div>


                <!-- Categoria do Produto -->
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

                    @if($needDescription)
                    <label class="block text-gray-700 font-bold mb-2 mt-4" for="description">
                        descrição do produto
                    </label>
                        <textarea name="description" id="description" cols="30" rows="3" wire:model='description'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    @endif
                </div>
                <button type="button" wire:click="$dispatch('openModal', { component: 'modal-category' })"
                    class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-1 px-2 mt-2 rounded">
                    Criar categoria
                </button>

                <!-- Botão de Salvar Produto -->
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="bg-gray-900 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Salvar Produto
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
