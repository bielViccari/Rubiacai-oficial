<div x-data="{
    @if($attributes->wire('model')->value())
        show: @entangle($attributes->wire('model')->value()),
    @endif
    }"
    x-on:open-modal.window="show = ($event.detail.id === $id)"
    x-on:close-modal.window ="show != ($event.detail.id === $id)"
    x-on:click.away="show = false"
    x-on:keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-show="show"
    class="fixed inset-0 z-20 p-4 everflow"
    style="display: none;"
    >
    <div 
        x-on:click="show = false"  
        class="absolute inset-0 overflow-hidden transition-opacity bg-gray-400 bg-opacity-75"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        aria-hidden="true">
    </div>

    <div class="flex flex-col w-full max-w-2xl mx-auto transform bg-white rounded shadow"> 
        <div class="flex items-center justify-between px-5 py-3 border-b">
            <div>{{$title}}</div>
            <button x-on:click="show = false; window.location.reload();" class="text-2xl"> 
                &times;
            </button>
            
        </div>

        <div class="p-5">
            {{$slot}}
        </div>

    </div>



</div>