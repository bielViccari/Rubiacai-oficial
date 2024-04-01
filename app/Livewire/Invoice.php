<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;

class Invoice extends ModalComponent
{
    public $carrinho;
    public function mount(Request $request) {
        $this->carrinho = $request->session()->get('carrinho');
    }
    public function render()
    {
        return view('livewire.invoice');
    }
}
