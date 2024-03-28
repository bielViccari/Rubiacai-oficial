<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductCard extends Component
{
    public $quantities = [];
    public $products = '';
    public $isNew = false;
    public function mount()
    {
        $this->products = Product::with('category')->get()->all();

        // Inicializar as quantidades para cada produto como 1
        foreach ($this->products as $product) {
            //pega a data, e verifica com a atual, para verificar se o produto é novo.
            $createdAt = Carbon::parse($product->created_at);
            if ($createdAt->diffInDays(Carbon::now()) <= 3) {
                $this->isNew = true;
            }
            $this->quantities[$product->id] = 1;
        }
    }

    public function increment($productId)
    {
        $this->quantities[$productId]++;
    }

    public function decrement($productId)
    {
        if ($this->quantities[$productId] > 0) {
            $this->quantities[$productId]--;
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
        dd($carrinho);
        return response()->json(['carrinho' => $carrinho]);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
