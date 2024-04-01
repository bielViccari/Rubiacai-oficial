<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use App\Models\Product;

class Cart extends ModalComponent
{
    public $carrinho = [];
    public $precoTotal = 0;
    public $valorUnitarioAcaiPersonalizado = [];

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    #[On('product-added')]
    #[On('product-deleted')]
    public function mount(Request $request)
    {
        $this->carrinho = session('carrinho');
        $this->calcularPrecoTotal();

        if ($this->carrinho && isset($this->carrinho['acaiPersonalizado'])) {
            foreach ($this->carrinho['acaiPersonalizado'] as $index => $acai) {
                $this->valorUnitarioAcaiPersonalizado[$index] = $acai['precoTotal'];
            }
    }
}

    public function removeProduct($id, Request $request)
    {
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

        if ($this->carrinho) {
            // Percorra os itens do carrinho
            foreach ($this->carrinho as $item) {
                if (is_array($item) && array_key_exists('price', $item)) {
                    $precoItem = $item['price'];
                    $quantidadeItem = $item['quantity'];
                    $this->precoTotal += $precoItem * $quantidadeItem;
                }
            }
            foreach($this->carrinho['acaiPersonalizado'] as $a) {
                $this->precoTotal += $a['precoTotal'];
            }
        }
    }

    public function removeAcaiPersonalizado($index)
{
    unset($this->carrinho['acaiPersonalizado'][$index]);
    $this->calcularPrecoTotal(); // Recalcular o preço total
    $this->dispatch('product-deleted');
    session()->flash('sucesso', 'Produto personalizado removido com sucesso');
}


    public function render()
    {

        return view('livewire.cart');
    }
}
