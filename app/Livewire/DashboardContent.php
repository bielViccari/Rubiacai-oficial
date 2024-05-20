<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\System;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Carbon\Carbon;

class DashboardContent extends Component
{
    use WithPagination;

    public $search;
    public $searchCategory;
    public $isNew = false;
    public $modal = false;
    public $message;
    public Order $selectedOrder;
    public $successMessage;

    public $system;
    public $productsGraph = [];
    public $productsOrderCounts = [];
    public $deliveredOrderCounts = [];
    public $undeliveredOrderCounts = [];
    public $months = [];
    
    #[On('statusChanged')]
    public function mount()
    {
        $this->system = System::find(1);
        $this->initializeProductData();
        $this->graphOrders();
    }
    
    private function initializeProductData()
    {
        // Obtém os produtos e inicializa contadores de pedidos por produto
        $productos = Product::pluck('name', 'id')->toArray();
        $orderCounts = array_fill_keys(array_keys($productos), 0);
    
        // Obtém os pedidos do último mês
        $orders = Order::where('created_at', '>=', Carbon::now()->subMonth())
                       ->where('status', 'd')
                       ->get();
    
        // Conta quantos pedidos existem para cada produto
        foreach ($orders as $order) {
            $itens = is_string($order->itens) ? json_decode($order->itens, true) : $order->itens;
            if (is_array($itens)) {
                foreach ($itens as $itemId => $itemDetails) {
                    if (isset($orderCounts[$itemId])) {
                        $orderCounts[$itemId] += $itemDetails['quantity'];
                    }

                    if($itemId == 'acaiPersonalizado') {
                       foreach ($itemDetails as $item => $i) {
                        $acai = Product::where('name', $i['tamanho'])->first();
                        $orderCounts[$acai->id] += $i['quantidade'];
                        if(isset($i['frutas'])) {
                            foreach ($i['frutas'] as $fruta => $f) {
                                $orderCounts[$f['id']] += $i['frutas_quantidade'][$fruta];
                            }
                        }

                        if(isset($i['adicionais'])) {
                            foreach ($i['adicionais'] as $adicionais => $a) {
                                $orderCounts[$a['id']] += $i['adicionais_quantidade'][$adicionais];
                            }
                        }
                       }
                    };
                }
            }
        }
        // Prepara os dados para o gráfico
        $this->productsGraph = array_values($productos);
        $this->productsOrderCounts = array_values($orderCounts);
    }
    
    public function graphOrders()
    {
        // Obtém os meses do último ano
        $months = collect(range(0, 11))->map(function ($i) {
            return Carbon::now()->subMonths($i)->locale('pt_BR')->translatedFormat('F');;
        })->reverse()->values()->all();
    
        // Inicializa arrays para contar pedidos entregues e não entregues por mês
        $deliveredOrderCounts = array_fill_keys($months, 0);
        $undeliveredOrderCounts = array_fill_keys($months, 0);
    
        // Obtém os pedidos dos últimos 12 meses
        $orders = Order::where('created_at', '>=', Carbon::now()->subMonths(11))
                       ->whereIn('status', ['d', 'n'])
                       ->get();
    
        // Conta os pedidos entregues e não entregues para cada mês
        foreach ($orders as $order) {
            $month = $order->created_at->locale('pt_BR')->translatedFormat('F');
            $status = $order->status;
    
            if (isset($deliveredOrderCounts[$month])) {
                if ($status === 'd') {
                    $deliveredOrderCounts[$month]++;
                } elseif ($status === 'n') {
                    $undeliveredOrderCounts[$month]++;
                }
            }
        }
    
        // Prepara os dados para o gráfico
        $this->deliveredOrderCounts = array_values($deliveredOrderCounts);
        $this->undeliveredOrderCounts = array_values($undeliveredOrderCounts);
        $this->months = $months;
    }
    
    private function initializeMonthArrays($months)
    {
        return array_fill_keys($months, 0);
    }
    
    public function toggleModal()
    {
        $this->modal = !$this->modal;
    }

    public function closeSystem()
    {
        $validatedData = $this->validate([
            'message' => 'required',
        ]);

        $system = System::find(1);

        $system->status = true;
        $system->message = $this->message;

        $system->save();
        $this->reset();
        $this->successMessage = 'Sistema Temporariamente inativo, Lembre-se de reativar quando der a hora!';
        $this->dispatch('statusChanged');
    }

    public function openSystem()
    {
        $system = System::find(1);
        $system->status = false;
        $system->save();

        $this->successMessage = 'Pedidos Funcionando!';
        $this->dispatch('statusChanged');
    }

    public function viewOrder($id)
    {
        $order = Order::find($id);
        $this->selectedOrder = $order;
        $this->toggleModal();
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
        $this->successMessage = 'Pedido excluido com sucesso';
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->successMessage = 'produto deletado com sucesso';
        $this->dispatch('deleteProduct');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        Product::where('category_id', $id)->delete();
        $category->delete();
        $this->dispatch('deleteCategory');
    }


    public $orders;
    public $diaryRelatory = [];
    public $weekendRelatory = [];
    public $monthRelatory = [];
    public $invoicedAmount;
    public $totalOrdersDelivered;
    public $totalOrdersInProcess;
    public $totalOrdersNotDelivered;
    public $valueOrderDiary;
    public $valueOrderWeek;
    public $valueOrderMonthly;
    public function relatory()
    {
        $this->diaryRelatory = [];
        $this->weekendRelatory = [];
        $this->monthRelatory = [];
        foreach ($this->orders as $o) {
            if ($o->created_at->diffInDays(Carbon::now()) < 1 && $o->status === 'd') {
                $this->diaryRelatory[] = [
                    'id' => $o->id,
                    'name' => $o->name,
                    'payment' => $o->payment,
                    'delivery' => $o->delivery,
                    'phone' => $o->phone,
                    'address' => $o->address,
                    'status' => $o->status,
                    'precoTotal' => $o->precoTotal,
                    'itens' => $o->itens,
                    'created_at' => $o->created_at,
                ];

                $this->valueOrderWeek += number_format($o->precoTotal, 2, '.', ',');
            }
            if ($o->created_at->diffInDays(Carbon::now()) < 8 && $o->status === 'd') {
                $this->weekendRelatory[] = [
                    'id' => $o->id,
                    'name' => $o->name,
                    'payment' => $o->payment,
                    'delivery' => $o->delivery,
                    'phone' => $o->phone,
                    'address' => $o->address,
                    'status' => $o->status,
                    'precoTotal' => $o->precoTotal,
                    'itens' => $o->itens,
                    'created_at' => $o->created_at,
                ];
                $this->valueOrderDiary += number_format($o->precoTotal, 2, '.', ',');
            }
            if ($o->created_at->diffInMonths(Carbon::now()) < 1 && $o->status === 'd') {
                $this->monthRelatory[] = [
                    'id' => $o->id,
                    'name' => $o->name,
                    'payment' => $o->payment,
                    'delivery' => $o->delivery,
                    'phone' => $o->phone,
                    'address' => $o->address,
                    'status' => $o->status,
                    'precoTotal' => $o->precoTotal,
                    'itens' => $o->itens,
                    'created_at' => $o->created_at,
                ];
                $this->valueOrderMonthly += number_format($o->precoTotal, 2, '.', ',');

            }
        }
    }

    public $invoicedAmountFormated;
    #[On('deleteProduct')]
    #[On('deleteCategory')]
    #[On('statusChanged')]
    public function render()
    {
        $this->totalOrdersDelivered = 0;
        $this->totalOrdersInProcess = 0;
        $this->totalOrdersNotDelivered = 0;
        $this->orders = Order::orderBy('created_at', 'desc')->get()->all();
        $newOrders = [];
        foreach ($this->orders as $o) {
            switch ($o->status) {
                case 'd':
                    $this->totalOrdersDelivered += 1;
                    $this->invoicedAmount += $o->precoTotal;
                    break;
                case 'i':
                    $this->totalOrdersInProcess += 1;
                    break;

                case 'n':
                    $this->totalOrdersNotDelivered += 1;
                    break;
            }
            $this->invoicedAmountFormated = number_format($this->invoicedAmount, 2, ',', '.');
            $createdAt = Carbon::parse($o->created_at);
            $isNew = $createdAt->diffInMinutes(Carbon::now()) <= 10;
            $createdAtFormated = $createdAt->format('d/m/Y H:i');
            $newOrders[] = [
                'id' => $o->id,
                'name' => $o->name,
                'payment' => $o->payment,
                'phone' => $o->phone,
                'address' => $o->address,
                'delivery' => $o->delivery,
                'price' => $o->precoTotal,
                'status' => $o->status,
                'itens' => $o->itens,
                'created_at' => $createdAtFormated,
                'isNew' => $isNew
            ];
        }
        $this->relatory();

        return view('livewire.dashboard-content', [
            'isNew' => $this->isNew, // Passa isNew para a visualização
            'products' => Product::where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->search . '%');
            })->paginate(15, pageName: 'products-page'),
            'categories' => Category::where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->searchCategory . '%');
            })->paginate(15, pageName: 'categories-page'),
            'orders' => $newOrders,
        ]);
    }

}
