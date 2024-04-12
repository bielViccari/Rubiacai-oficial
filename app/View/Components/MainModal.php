<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $title,
    )
    {
        //
    }


    public function render(): View|Closure|string
    {
        return view('components.main-modal');
    }
}
