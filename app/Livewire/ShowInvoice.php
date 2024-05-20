<?php

namespace App\Livewire;


use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;


class ShowInvoice extends Component
{

    public $order;
    public $priceOfSize = [];
    public $unityPrice = [];
    public $precoTotal;
    public $valorEntrega;
    public $status;
    public $phoneNumber;

    public function mount()
    {
        $this->prices();
        $this->formatNumber();
    }
    public $successMessage;
    public function update()
    {
        $validatedData = $this->validate([
            'status' => 'required|min:1',
        ]);
        $pedido = Order::find($this->order->id);
        $pedido->status = $this->status;
        $pedido->save();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Status alterado!',
            position: 'center',
        );
        $this->dispatch('statusChanged');
    }

    public function formatNumber()
    {
        $codigo_area = substr($this->order->phone, 0, 2);

        $parte1 = substr($this->order->phone, 2, 5);
        $parte2 = substr($this->order->phone, 7);

        $this->phoneNumber = "($codigo_area) $parte1-$parte2";
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
        if (isset($this->order->itens)) {
            foreach ($this->order->itens as $item) {
                if (is_array($item) && array_key_exists('price', $item)) {
                    $precoItem = $item['price'];
                    $quantidadeItem = $item['quantity'];
                    $this->precoTotal += $precoItem * $quantidadeItem;
                }
            }
        }
        $this->valorEntrega = $this->order->delivery == 'delivery' ? 1 : 0;
    }

    #[On('statusChanged')]
    public function render()
    {
        return view('livewire.show-invoice');
    }
}
