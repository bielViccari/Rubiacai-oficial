<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Http\Client\Request;
use LivewireUI\Modal\ModalComponent;

class ShowProduct extends ModalComponent
{
    public $productId;
    public $product;
    public $quantities = [];

    public function mount() {
        $this->product = Product::find($this->productId);

        $products = Product::get()->all();
        foreach ($products as $p) {
            $this->quantities[$p->id] = 1;
        }
    }


    public function increment($productId)
    {
        $this->quantities[$productId]++;
        $this->dispatch('increment');
    }

    public function decrement($productId)
    {
        if ($this->quantities[$productId] > 1) {
            $this->quantities[$productId]--;
            $this->dispatch('decrement');
        }
    }

    public function addToCart($product, $quantity, Request $request)
    {

        $request->session()->put('carrinho', $request->session()->get('carrinho', []));

        $carrinho = $request->session()->get('carrinho');


        if (isset($carrinho[$product['id']])) {
            $carrinho[$product['id']]['quantity'] += $quantity;
        } else {
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
        $this->successMessage = 'Produto adicionado ao carrinho';
        return response()->json(['carrinho' => $carrinho]);
    }


    public function render()
    {
        return view('livewire.show-product');
    }
}
