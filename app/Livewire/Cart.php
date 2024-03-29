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
    #[On('product-deleted')]
    public function mount(Request $request) {
        $this->carrinho = session('carrinho');
        $this->calcularPrecoTotal();
    }

    public function removeProduct($id, Request $request) {
        $removeProduct = $request->session()->get('carrinho');
        unset($removeProduct[$id]);
        $request->session()->put('carrinho', $removeProduct);
        $this->dispatch('product-deleted');
        session()->flash('sucess', 'Produto removido com sucesso');
        return response()->json(['carrinho' => $removeProduct]);
    }


    private function calcularPrecoTotal()
    {
        $this->precoTotal = 0; // Resetar o preço total
        foreach ($this->carrinho as $item) {
            $precoItem = $item['price'];
            $quantidadeItem = $item['quantity'];

            $precoTotalItem = $precoItem * $quantidadeItem;

            $this->precoTotal += $precoTotalItem;
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
