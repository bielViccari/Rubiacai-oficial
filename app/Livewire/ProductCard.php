<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ProductCard extends Component
{
    use WithPagination;
    public $quantities = [];

    public $isNew = false;
    public $searchProduct;


    public function increment($productId)
    {
        $this->quantities[$productId]++;
        $this->dispatch('increment');
    }

    public function decrement($productId)
    {
        if ($this->quantities[$productId] > 0) {
            $this->quantities[$productId]--;
            $this->dispatch('decrement');
        }
    }

    public function mount() {
        $products = Product::get()->all();
        foreach ($products as $p) {
            $this->quantities[$p->id] = 1;
        }
    }
    public function addToCart($product, $quantity, Request $request)
    {
        // Inicializar a sessão do carrinho se não existir
        $request->session()->put('carrinho', $request->session()->get('carrinho', []));

        // Obter o carrinho da sessão
        $carrinho = $request->session()->get('carrinho');

        // Verificar se o carrinho já tem o produto, se já estiver, aumentar a quantidade
        if (isset($carrinho[$product['id']])) {
            $carrinho[$product['id']]['quantity'] += $quantity;
        } else {
            // Se o produto não estiver no carrinho, adicioná-lo ao carrinho
            $carrinho[$product['id']] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => $quantity,
            ];
        }

        $request->session()->put('carrinho', $carrinho);
        $this->dispatch('product-added');
        return response()->json(['carrinho' => $carrinho]);
    }

    #[On('increment')]
    #[On('decrement')]
    public function render()
    {
        $products = Product::with('category')->where(function ($sub_query) {
            $sub_query->where('name', 'like', '%' . $this->searchProduct . '%');
        })->paginate(20, pageName: 'products-page');


        // Inicializar as quantidades para cada produto como 1
        foreach ($products as $product) {
            //pega a data, e verifica com a atual, para verificar se o produto é novo.
            $createdAt = Carbon::parse($product->created_at);
            if ($createdAt->diffInDays(Carbon::now()) <= 3) {
                $this->isNew = true;
            }
        }
        return view('livewire.product-card', ['products' => $products]);
    }
}
