<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesSlide extends Component
{
    public $categories ='';

    public function selectedCategory($categoryId) {
        $this->dispatch('selectedCategory', categoryId: $categoryId)->to(ProductCard::class);
    }

    public function mount() {
        $this->categories = Category::get()->all();
    }
    public function render()
    {
        return view('livewire.categories-slide');
    }
}
