<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
class Cart extends ModalComponent
{
    public $carrinho = [];
    public $precoTotal = 0;

     public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return '7xl';
    }

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
    public function render()
    {
        return view('livewire.cart');
    }
}
