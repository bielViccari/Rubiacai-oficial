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
    public $successMessage;
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
        if ($this->successMessage) {
            $this->successMessage = null;
        }
    }

    public function removeProduct($id, Request $request)
    {
        $removeProduct = $request->session()->get('carrinho');
        unset($removeProduct[$id]);
        $request->session()->put('carrinho', $removeProduct);
        $this->dispatch('product-deleted');
        $this->successMessage = 'Produto removido';
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
            if(isset($this->carrinho['acaiPersonalizado'])) {
                foreach($this->carrinho['acaiPersonalizado'] as $a) {
                    $this->precoTotal += $a['precoTotal'];
                }
            }
        }
    }

    public function removeAcaiPersonalizado($index, Request $request)
{
    $removeAcai = $request->session()->get('carrinho');
    unset($removeAcai['acaiPersonalizado'][$index]);
    $request->session()->put('carrinho', $removeAcai);
    $this->dispatch('product-deleted');
    $this->successMessage = 'Produto removido';
    return response()->json(['carrinho' => $removeAcai]);
}


    public function render()
    {

        return view('livewire.cart');
    }
}
