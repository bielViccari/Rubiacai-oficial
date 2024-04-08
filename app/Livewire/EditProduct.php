<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On; 
class EditProduct extends ModalComponent
{
    use WithFileUploads;

    public $name = '';
    public $category_id = '';
    public $price = '';
    public $image = '';
    public $id;
    public $categories;
    public $product;
    

    public function mount()
    {
        $this->categories = Category::all();
        $this->product = Product::find($this->id);
    }
    
    #[On('category-created')] 
    public function updateCategories() {
        $this->categories = Category::all();
    }

    public function update()
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

        $imageName = $this->image->getClientOriginalName();
        $this->image->storeAs('public/productImages', $imageName);
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
