<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{
    use WithFileUploads;

    public $name = '';
    public $category_id = '';
    public $price = '';
    public $image = '';
    public $categories;
    public $product;
    public $productId;
    public $description;
    public $needDescription = false;


    public function mount()
    {
        $this->productId = request()->route('id');
        if (!$this->product = Product::find($this->productId)) {
            $this->redirectRoute('dashboard');
        }

        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->price = $this->product->price;
        $this->description = $this->product->description;
        $this->categories = Category::all();
        $this->checkCategory();
    }

    public function checkCategory() {
        if($this->categories[$this->category_id - 1]->name == 'Açai Pronto') {
            $this->needDescription = true;
        } else {
            $this->needDescription = false;
        }
    }

    #[On('category-created')]
    public function updateCategories()
    {
        $this->categories = Category::all();
    }



    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
    
        $product = Product::findOrFail($this->productId);
    
        $product->name = $this->name;
        $product->price = $this->price;
        $product->category_id = $this->category_id;
    
        if ($this->image) {
            $this->validate([
                'image' => 'image',
            ]);

            $imageName = $this->image->getClientOriginalName();
            $this->image->storeAs('public/productImages', $imageName);

            if ($product->image && Storage::exists('public/productImages/' . $product->image)) {
                Storage::delete('public/productImages/' . $product->image);
            }

            $product->image = $imageName;
        }
        $product->save();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Produto Editado com sucesso!',
            position: 'center',
        );
        $this->reset('name', 'price', 'image', 'description');
    }
    

    public function render()
    {
        return view('livewire.edit-product');
    }
}
