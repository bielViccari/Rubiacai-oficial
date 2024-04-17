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

    #[On('statusChanged')]
    public function mount()
    {
        $this->system = System::find(1);
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
        session()->flash('success', 'Pedido excluido com sucesso');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('success', 'produto deletado com sucesso');
        $this->dispatch('deleteProduct');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        Product::where('category_id', $id)->delete();
        $category->delete();
        $this->dispatch('deleteCategory');
    }

    #[On('deleteProduct')]
    #[On('deleteCategory')]
    #[On('statusChanged')]
    public function render()
    {
        $orders = Order::orderBy('created_at', 'desc')->get()->all();
        $newOrders = [];
        foreach ($orders as $o) {
            $createdAt = Carbon::parse($o->created_at);
            $isNew = $createdAt->diffInMinutes(Carbon::now()) <= 10;
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
                'created_at' => $o->created_at,
                'isNew' => $isNew
            ];
        }


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
