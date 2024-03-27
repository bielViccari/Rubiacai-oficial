<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On; 

class CreateProduct extends Component
{
    use WithFileUploads;
    public $name = '';
    public $category_id = '';
    public $price = '';
    public $image = '';

    public $categories;

    
    public function mount()
    {
        // Recupera todas as categorias)
        $this->categories = Category::all();
    }
    
    #[On('category-created')] 
    public function updateCategories() {
        $this->categories = Category::all();
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required|image', 
        ]);


        $product = Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'image' => $this->image->getClientOriginalName()
        ]);

        $imageName = $product->id . '.' . $this->image->extension();
        $this->image->storeAs('productImages', $imageName);
        return redirect()->route('dashboard');
    }
 
    public function render()
    {
        return view('livewire.create-product');
    }
}
