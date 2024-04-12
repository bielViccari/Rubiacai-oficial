<?php

namespace App\Livewire;


use App\Models\Order;
use App\Models\Product;
use Livewire\Component;


class ShowInvoice extends Component
{

        public $order;
        public $priceOfSize = [];
        public $unityPrice = [];
        public $precoTotal;
        public $valorEntrega;
        public $status;
    
    public function mount()
    {
        $this->prices();
    }
  
    public function update() {
        $validatedData = $this->validate([
            'status' => 'required', 
        ]);
        $pedido = Order::find($this->order->id);
        $pedido->status = $this->status;
        $pedido->save();
    }

    public function prices()
    {
        if (isset($this->order->itens['acaiPersonalizado'])) {

            foreach ($this->order->itens['acaiPersonalizado'] as $index => $item) {
                if ($item['tamanho'] != '') {
                    $product = Product::where('name', $item['tamanho'])->first();
                    $sizeValue = $product->price;
                    $this->priceOfSize[$index] = $sizeValue * $item['quantidade'];
                    $this->unityPrice[$index] = $sizeValue;
                }
            }
            $this->precoTotal = 0; // Resetar o preço total

            if (isset($this->order->itens['acaiPersonalizado'])) {
                foreach ($this->order->itens['acaiPersonalizado'] as $a) {
                    $this->precoTotal += $a['precoTotal'];
                }
            }
        }
        if (isset($this->order)) {
            foreach ($this->order as $item) {
                if (is_array($item) && array_key_exists('price', $item)) {
                    $precoItem = $item['price'];
                    $quantidadeItem = $item['quantity'];
                    $this->precoTotal += $precoItem * $quantidadeItem;
                }
            }
        }
        $this->valorEntrega = 1;
    }

    public function render()
    {
        return view('livewire.show-invoice', [
            'order' => $this->order,
        ]);
    }
}
