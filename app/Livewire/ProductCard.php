<?php

namespace App\Livewire;

use App\Models\Category;
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
    public $filteredProducts;
    public $filterId;
    public $nameOfCategoryFiltered;
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

    public $carrinho = [];
    #[On('product-deleted')]
    #[On('product-added')]
    public function mount(Request $request)
    {
        $products = Product::get()->all();
        foreach ($products as $p) {
            $this->quantities[$p->id] = 1;
        }
        $this->carrinho = $request->session()->get('carrinho');
        $this->totalProductsInCard();
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
        return response()->json(['carrinho' => $carrinho]);
    }

    #[On('selectedCategory')]
    public function updateProducts($categoryId)
    {
        $this->filterId = $categoryId;
        $category = Category::find($categoryId);
        $this->nameOfCategoryFiltered = $category ? $category->name : null;
        $this->filteredProducts = Product::with('category')->where('category_id', $categoryId)->get();
    }

    public function removeFilter()
    {
        $this->filterId = null;
        $this->nameOfCategoryFiltered = null;
        $this->filteredProducts = null;

        $this->redirectRoute('pagina.inicial');
    }

    public $totalProducts;

    public function totalProductsInCard()
    {
        $this->totalProducts = 0;
        if (isset($this->carrinho)) {
            if (isset($this->carrinho['acaiPersonalizado'])) {
                foreach ($this->carrinho as $item) {
                    if ($item !== $this->carrinho['acaiPersonalizado'] && $item !== []) {
                        $this->totalProducts += 1;
                    }
                }
            } else {
                foreach ($this->carrinho as $item) {
                    $this->totalProducts += 1;
                }
            }
        }

        $this->totalProducts += isset($this->carrinho['acaiPersonalizado']) ? count($this->carrinho['acaiPersonalizado']) : 0;

    }

    #[On('increment')]
    #[On('decrement')]
    public function render()
    {
        if ($this->filteredProducts) {
            $products = $this->filteredProducts;
        } else {
            $products = Product::with('category')->where(function ($sub_query) {
                $sub_query->where('name', 'like', '%' . $this->searchProduct . '%');
            })->paginate(12, pageName: 'products-page');
        }

        foreach ($products as $product) {
            //pega a data, e verifica com a atual, para verificar se o produto é novo.
            $createdAt = Carbon::parse($product->created_at);
            if ($createdAt->diffInDays(Carbon::now()) <= 3) {
                $this->isNew = true;
            }
        }
        if (session('carrinho')) {
            $carrinho = session('carrinho');
            return view('livewire.product-card', ['products' => $products, 'carrinho' => $carrinho]);
        } else {
            return view('livewire.product-card', ['products' => $products]);
        }
    }
}
