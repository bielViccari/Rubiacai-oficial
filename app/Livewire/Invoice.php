<?php

namespace App\Livewire;

use App\Models\Product;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;

class Invoice extends ModalComponent
{
    public $carrinho;
    public $dataAtual;

    #[On('product-added')]
    public function mount(Request $request) {
        $this->carrinho = $request->session()->get('carrinho');
        $this->prices();
        $this->dataAtual = Carbon::now()->format('d/m/Y H:i');
    }

    public $priceOfSize = [];
    public $unityPrice = [];
    public $precoTotal;
    public function prices() {
        if($this->carrinho['acaiPersonalizado']) {

            foreach($this->carrinho['acaiPersonalizado'] as $index => $item) {
                if($item['tamanho'] != '') {
                    $product = Product::where('name', $item['tamanho'])->first();
                    $sizeValue = $product->price;
                    $this->priceOfSize[$index] = $sizeValue * $item['quantidade'];
                    $this->unityPrice[$index] = $sizeValue;
                }
            }
            $this->precoTotal = 0; // Resetar o preço total

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

    public function render()
    {
        return view('livewire.invoice');
    }
}
