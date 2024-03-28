<div class="flex flex-col items-center">
    @php
        $color = 'purple-500';
    @endphp
    <h3 class="pb-4 font-semibold text-lg text-gray-600">Procure por categorias</h3>

<div class="container max-w-[900px] mx-auto">
    <div class="flex items-center justify-center w-full h-full py-24 sm:py-8 px-4">
        <div class="w-full relative flex items-center justify-center">
            <button aria-label="slide backward" class="absolute z-30 left-0 ml-10 focus:outline-none cursor-pointer" id="prev">
                <svg class="dark:text-gray-900" width="20" height="20" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                <div id="slider" class="h-full flex lg:gap-6 md:gap-3 gap-6 items-center justify-start transition ease-out duration-700">
                    @foreach ($categories as $c)
                        <div class="w-30 h-30 flex-shrink-0 m-1 relative overflow-hidden bg-{{ $color }} rounded-lg shadow-lg group">
                        <svg class="absolute bottom-0 left-0 mb-6 scale-125 group-hover:scale-[1.5] transition-transform"
                            viewBox="0 0 375 283" fill="none" style="opacity: 0.1;">
                            <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)"
                                fill="white" />
                            <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)"
                                fill="white" />
                        </svg>
                        <div class="relative pt-6 px-6 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <div class="block absolute w-32 h-32 bottom-0 left-0 -mb-16 ml-3"
                                style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                            </div>
                            <img class="relative w-24 h-20"
                                src="storage/categoryImages/{{ asset($c->image) }}"
                                alt="">
                        </div>
                        <div class="relative text-white px-4 pb-4 mt-4">
                            <div class="flex items-center justify-center">
                                <span class="block font-semibold text-lg max-w-full break-all">{{ $c->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <button aria-label="slide forward" class="absolute z-30 right-0 mr-10 focus:outline-none " id="next">
                <svg class="dark:text-gray-900" width="20" height="20" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</div>