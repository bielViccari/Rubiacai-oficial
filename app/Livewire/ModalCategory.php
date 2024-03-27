<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ModalCategory extends ModalComponent
{
    use WithFileUploads;
    public $name = '';
    public $image ='';
    public function createCategory() {
        $this->validate([
            'image' => 'required|image',
            'name' => 'required'
        ]);

        $category = Category::create([
            'name' => $this->name,
            'image' => $this->image->getClientOriginalName()
        ]);

        $imageName = $category->id . '.' . $this->image->extension();
        $this->image->storeAs('categoryImages', $imageName);
        $this->dispatch('category-created');
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.modal-category');
    }
}
