<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\WithPagination;

class DashboardContent extends Component
{
    use WithPagination;
    public $categories;

    #[On('deleteCategory')]
    public function mount() {
        $this->categories = Category::get()->all();
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
      $product->delete();
        $this->dispatch('deleteProduct');
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        $category->delete();
        $this->dispatch('deleteCategory');
    }
    #[On('deleteProduct')]
    public function render()
    {
        return view('livewire.dashboard-content', [
            'products' => Product::paginate(15),
        ]);
    }
}
