<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditCategory extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $categoryId;
    public $category;

    public function mount()
    {
        $this->categoryId = request()->route('id');
        if (!$this->category = Category::find($this->categoryId)) {
            $this->redirectRoute('dashboard');
        }

        $this->name = $this->category->name;
        $this->category_id = $this->category->image;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
        ]);
    
        $category = Category::findOrFail($this->categoryId);
    
        $category->name = $this->name;

        if ($this->image) {
            $this->validate([
                'image' => 'image',
            ]);

            $imageName = $this->image->getClientOriginalName();
            $this->image->storeAs('public/productImages', $imageName);

            if ($category->image && Storage::exists('public/categoryImages/' . $category->image)) {
                Storage::delete('public/categoryImages/' . $category->image);
            }

            $category->image = $imageName;
        }
        $category->save();

        return redirect()->route('dashboard');
    }


    public function render()
    {
        return view('livewire.edit-category');
    }
}
