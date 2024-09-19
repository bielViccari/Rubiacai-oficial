<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class EditProductForm extends Component
{
    use WithFileUploads;

    public $name = '';
    public $category_id = '';
    public $price = '';
    public $image;
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

        $priceFormated = number_format(floatval(str_replace(',', '.', $this->product->price)), 2, '.', '');
        
        $this->name = $this->product->name;
        $this->category_id = $this->product->category_id;
        $this->price = $priceFormated;
        $this->description = $this->product->description;
        $this->categories = Category::all();
        $this->checkCategory();
    }

    public function checkCategory() {
        $categoryName = '';
    
        foreach ($this->categories as $category) {
            if ($category->id == $this->category_id) {
                $categoryName = $category->name;
            }
        }
        if ($categoryName == 'Açai Pronto' || $categoryName == 'Açai pronto') {
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
        $priceFormated = number_format(floatval($this->price), 2, '.', ',');

        $product = Product::findOrFail($this->productId);
        $product->name = $this->name;
        $product->price = $priceFormated;
        $product->category_id = $this->category_id;
    
        if ($this->image) {
            $this->validate([
                'image' => 'image',
            ]);

            if ($product->image && Storage::exists('public/productImages/' . $product->image)) {
                Storage::delete('public/productImages/' . $product->image);
            }
            $imageName = $this->image->getClientOriginalName();
            $this->image->storeAs('public/productImages', $imageName);


            $product->image = $imageName;
        }
        $product->save();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Produto Editado com sucesso!',
            position: 'center',
        );
        $this->redirectRoute('dashboard');
    }
    

    public function render()
    {
        return view('livewire.edit-product');
    }
}
