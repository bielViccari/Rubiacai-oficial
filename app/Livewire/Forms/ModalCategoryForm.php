<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ModalCategoryForm extends ModalComponent
{
    use WithFileUploads;
    public $name = '';
    public $image;
    public $showLoading = false;
    public function createCategory() {
        $this->validate([
            'image' => 'required|image',
            'name' => 'required'
        ]);

        $category = Category::create([
            'name' => $this->name,
            'image' => $this->image->getClientOriginalName()
        ]);

        $this->showLoading = true;
        $imageName = $this->image->getClientOriginalName();
        $this->image->storeAs('public/categoryImages', $imageName);
        $this->dispatch('category-created');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal-category');
    }
}
