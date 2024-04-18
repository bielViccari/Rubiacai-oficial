<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate; 

class Invoice extends ModalComponent
{
    public $carrinho;
    public $dataAtual;
    public $successMessage;

    #[Validate('required','min:1', message: 'Insira um método de pagamento.')]
    public $payment;
    #[Validate('required', message: 'Insira o nome de quem receberá a entrega.')]
    public $name;
    #[Validate('required', message: 'Insira o numero de whatsapp para confirmar a entrega.')]
    public $phone;
    #[Validate('required', message: 'Insira seu indereço para entrega.')]
    public $address;
    #[Validate('required','min:1', message: 'Selecione o método de entrega.')]
    public $delivery;
    public $valorEntrega = 1;

    public function save(Request $request) {
        $this->validate();
        $order = Order::create([
            'name' => $this->name,
            'payment' => $this->payment,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => 'n',
            'delivery' => $this->delivery,
            'precoTotal' => $this->precoTotal,
            'itens' => $this->carrinho,
        ]);
        
        $request->session()->forget('carrinho');
        $this->dispatch('ordered');
        $this->successMessage = 'Pedido realizado com sucesso! Aguarde a mensagem no whatsapp para confirmação';
        $this->closeModal();
    }

    #[On('product-added')]
    public function mount(Request $request)
    {
        $this->carrinho = $request->session()->get('carrinho');
        $this->prices();
        $this->dataAtual = Carbon::now()->format('d/m/Y H:i');
    }

    public $priceOfSize = [];
    public $unityPrice = [];
    public $precoTotal;
    public function prices()
    {
        if (isset($this->carrinho['acaiPersonalizado'])) {

            foreach ($this->carrinho['acaiPersonalizado'] as $index => $item) {
                if ($item['tamanho'] != '') {
                    $product = Product::where('name', $item['tamanho'])->first();
                    $sizeValue = $product->price;
                    $this->priceOfSize[$index] = $sizeValue * $item['quantidade'];
                    $this->unityPrice[$index] = $sizeValue;
                }
            }
            $this->precoTotal = 0; // Resetar o preço total

            if (isset($this->carrinho['acaiPersonalizado'])) {
                foreach ($this->carrinho['acaiPersonalizado'] as $a) {
                    $this->precoTotal += $a['precoTotal'];
                }
            }
        }
        if (isset($this->carrinho)) {
            foreach ($this->carrinho as $item) {
                if (is_array($item) && array_key_exists('price', $item)) {
                    $precoItem = $item['price'];
                    $quantidadeItem = $item['quantity'];
                    $this->precoTotal += $precoItem * $quantidadeItem;
                }
            }
        }

    }

    public function render()
    {
        return view('livewire.invoice');
    }
}
