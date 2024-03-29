<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\On; 

class Cart extends ModalComponent
{
    public $carrinho = [];
    public $precoTotal = 0;

     public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    #[On('product-added')]
    public function mount(Request $request) {
        $this->carrinho = session('carrinho');
        if($this->carrinho) {
            foreach ($this->carrinho as $item) {
                $precoItem = $item['price'];
                $quantidadeItem = $item['quantity'];
    
                $precoTotalItem = $precoItem * $quantidadeItem;
    
                $this->precoTotal += $precoTotalItem;
            }
        }
    }

    public function removeProduct($id, Request $request) {
        $removeProduct = $request->session()->get('carrinho');
        unset($removeProduct[$id]);
        $request->session()->put('carrinho', $removeProduct);
        $this->dispatch('product-deleted');
        return response()->json(['carrinho' => $removeProduct]);
    }

    #[On('product-deleted')]
    public function updateCart(Request $request) {
        $this->carrinho = $request->session()->get('carrinho');
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
