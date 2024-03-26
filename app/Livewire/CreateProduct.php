<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $name = '';
    public $price = '';
    public $image = '';
    public $category_id = '';

    public $categories;

    
    public function mount()
    {
        // Recupera os dados do banco de dados (por exemplo, todas as categorias)
        $this->categories = Category::all();
    }
 
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpg,png,jpeg,gif|max:10240', // máximo de 10 MB
            'category_id' => 'required|exists:categories,id',
        ]);

        $productData = [
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ];

        $product = Product::create($productData);

        // Salva a imagem
        $this->image->store('images');

        session()->flash('status', 'Product successfully created.');

        return redirect()->route('dashboard');
    }
 
    public function render()
    {
        return view('livewire.create-product');
    }
}
