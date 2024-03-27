<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesSlide extends Component
{
    public $categories ='';

    public function mount() {
        $this->categories = Category::get()->all();
    }
    public function render()
    {
        return view('livewire.categories-slide');
    }
}
