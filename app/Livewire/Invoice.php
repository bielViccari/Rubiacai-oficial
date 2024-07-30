<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use App\Notifications\TelegramNotification;
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
    public $valorEntrega = 0;

    public function save(Request $request) {
        $this->validate();
        $order = Order::create([
            'name' => $this->name,
            'payment' => $this->payment,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => 'n',
            'delivery' => $this->delivery,
            'precoTotal' => $this->totalPrice,
            'itens' => $this->carrinho,
        ]);
        
        Notification::route('telegram', Config::get('services.telegram_id'))
        ->notify(new TelegramNotification($order['name']));
        $request->session()->forget('carrinho');
        $this->dispatch('ordered');
        $this->successMessage = 'Pedido realizado com sucesso! Aguarde a mensagem no whatsapp para confirmação';
        $this->closeModal();
    }

    public $valorAnteriorEntrega = 0;
    #[On('product-added')]
    public function mount(Request $request)
    {
        $this->carrinho = $request->session()->get('carrinho');
        $this->prices();
        $this->dataAtual = Carbon::now()->format('d/m/Y H:i');
        $this->valorAnteriorEntrega = 0;
    }

    public $priceOfSize = [];
    public $unityPrice = [];
    public $totalPrice;

    public function prices()
    {
        $this->totalPrice = 0; // Reinicializa o preço total
        // Verifica se o carrinho está definido e se contém a chave 'acaiPersonalizado'
        if (isset($this->carrinho['acaiPersonalizado'])) {
    
            foreach ($this->carrinho['acaiPersonalizado'] as $index => $item) {
                if ($item['tamanho'] != '') {
                    $product = Product::where('name', $item['tamanho'])->first();
                    $sizeValue = $product->price;
                    $this->priceOfSize[$index] = $sizeValue * $item['quantidade'];
                    $this->unityPrice[$index] = $sizeValue;
                    $this->totalPrice += $item['precoTotal']; // Adiciona ao preço total
                }
            }
        }
    
        // Verifica se o carrinho está definido
        if (isset($this->carrinho)) {
            foreach ($this->carrinho as $item) {
                if (is_array($item) && array_key_exists('price', $item)) {
                    $precoItem = $item['price'];
                    $quantidadeItem = $item['quantity'];
                    $this->totalPrice += $precoItem * $quantidadeItem; // Adiciona ao preço total
                }
            }
        }
    }
    public function isDelivery()
    {
        // Se a opção for "delivery", o valor da entrega é 1, caso contrário é 0
        $this->valorEntrega = ($this->delivery === 'delivery') ? 1 : 0;
    
        // Atualiza o preço total com base no valor da entrega, considerando a diferença entre o valor atual e o valor anterior da entrega
        $this->totalPrice += ($this->valorEntrega - $this->valorAnteriorEntrega);
    
        // Atualiza o valor anterior da entrega para ser usado na próxima chamada da função
        $this->valorAnteriorEntrega = $this->valorEntrega;
    }
    
    
    

    public function render()
    {
        return view('livewire.invoice');
    }
}
