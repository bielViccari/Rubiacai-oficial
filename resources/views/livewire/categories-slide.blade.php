<div id="categories" class="p-12 relative">
    <div class="flex justify-center items-center">
        <h3 class="pb-4 font-semibold text-lg text-gray-600">Procure por categorias</h3>
    </div>
    <div class="relative overflow-hidden">
        <button aria-label="slide backward" class="absolute left-0 top-1/2 transform -translate-y-1/2 ml-10 focus:outline-none" id="prev" style="z-index: 1;">
            <svg class="dark:text-gray-900" width="20" height="20" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <div id="slider" class="flex items-center space-x-2 transition-transform ease-in-out duration-300">
            @foreach ($categories as $c)
                <div class="flex-shrink-0 w-full sm:w-1/2 lg:w-1/5 xl:w-1/5 px-2">
                    <div wire:click='selectedCategory({{ $c->id }})' class="p-4 bg-white cursor-pointer rounded-lg overflow-hidden hover:shadow flex justify-center items-center flex-col">
                        <div class="w-16 h-16 rounded-lg overflow-hidden flex justify-center items-center"> <!-- Adicionado classes de alinhamento -->
                            <img src="storage/categoryImages/{{ $c->image }}" alt="{{ $c->name }}">
                        </div>
                        <h2 class="mt-2 text-gray-800 text-sm font-semibold line-clamp-1">{{ $c->name }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
        <button aria-label="slide forward" class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-10 focus:outline-none " style="z-index: 1;" id="next">
            <svg class="dark:text-gray-900" width="20" height="20" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>