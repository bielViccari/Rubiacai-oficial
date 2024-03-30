@if ($paginator->hasPages())
<div class="container mx-auto px-4">
    <nav class="flex flex-row flex-nowrap justify-between md:justify-center items-center" aria-label="Pagination">
        <!-- Pagina Anterior Button -->
        @if ($paginator->onFirstPage())
            <a class="disabled flex w-10 h-10 mr-1 justify-center items-center border border-gray-200 bg-white dark:bg-gray-800 text-black dark:text-white"
            title="Pagina Anterior">
            <span class="sr-only">Pagina Anterior</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="block w-5 h-5">
                <path class="text-gray-400" stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        @else
            <a class="flex w-10 h-10 mr-1 justify-center items-center border border-gray-200 bg-white dark:bg-gray-800 text-black dark:text-white hover:border-gray-300 dark:hover:border-gray-600"
                href="{{ $paginator->previousPageUrl() }}" title="Pagina Anterior">
                <span class="sr-only">Pagina Anterior</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="block w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
        @endif

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)     
            <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center border border-gray-200 bg-white dark:bg-gray-700 text-black dark:text-white hover:border-gray-300 dark:hover:border-gray-600"
                href="{{ $paginator->url($i) }}" title="Page 1">
                {{ $i }}
            </a>
        @endfor
        
        @if ($paginator->onLastPage())
        <a class="disabled flex w-10 h-10 mr-1 justify-center items-center border border-gray-200 bg-white dark:bg-gray-800 text-black dark:text-white"
        title="Proxima pagina">
            <span class="sr-only">Próxima pagina</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="block w-5 h-5">
                <path class="text-gray-400" stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        @else
            <a class="flex w-10 h-10 ml-1 justify-center items-center border border-gray-200 bg-white dark:bg-gray-800 text-black dark:text-white hover:border-gray-300 dark:hover:border-gray-600"
                href="{{ $paginator->nextPageUrl() }}" title="Next Page">
                <span class="sr-only">Next Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="block w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        @endif
    </nav>
</div>
@endif