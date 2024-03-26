@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="flex justify-center items-center h-screen">
    <form wire:submit="save" class="w-3/4 bg-white p-8 rounded-lg shadow-lg" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="selectedCategoryId" name="category">

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Cadastrar produto</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">O produto aparacerá na página inicial, na seção de
                    categoria que você selecionar abaixo.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome do
                            Produto</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input wire:model="name" type="text" name="name" id="name" autocomplete="name"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Nome do produto">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about"
                            class="block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                        <div>
                            <label id="listbox-label"
                                class="block text-sm font-medium leading-6 text-gray-900"></label>
                            <div class="relative mt-2">
                                <button type="button"
                                    class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
                                    aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                    <span class="flex items-center">
                                        <span class="ml-3 block truncate">Selecione uma Categoria</span>
                                    </span>
                                    <span
                                        class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                                <ul id="category-options" class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm hidden" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                                    @foreach ($categories as $c)
                                    <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-{{ $c->id }}" role="option" data-category-id="{{ $c->id }}" wire:model>
                                        <div class="flex items-center">
                                            <span class="font-normal ml-3 block truncate">{{ $c->name }}</span>
                                        </div>
                                        <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4"> 
                                            <svg class="h-5 w-5 hidden selected-svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <button id="createCategoryButton" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-1">Criar nova categoria</button>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Preço</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">R$</span>
                            </div>
                            <input wire:model="price" type="text" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-9 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                        </div>
                        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-full">
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Foto do
                        produto</label>
                    <div
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div id="drop-area" class="text-center">
                            <svg id="svg-icon" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <img id="image-preview" class="hidden mx-auto h-40" src="#"
                                alt="Preview da Imagem">
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Adicione uma imagem</span>
                                    <input wire:model="image" id="file-upload" name="image" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">ou arraste e solte</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF até 10MB</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Publicar produto</button>
        </div>
    </form>
</div>