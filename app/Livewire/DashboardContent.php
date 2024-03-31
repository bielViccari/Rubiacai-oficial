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

    public $search;
    public $searchCategory;
    public function deleteProduct($id) {
        $product = Product::find($id);
      $product->delete();
        $this->dispatch('deleteProduct');
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        Product::where('category_id', $id)->delete();
        $category->delete();
        $this->dispatch('deleteCategory');
    }
    #[On('deleteProduct')]
    #[On('deleteCategory')]
    public function render()
    {
        return view('livewire.dashboard-content', [
            'products' => Product::where(function($sub_query) {
                $sub_query->where('name', 'like', '%'.$this->search.'%');
            })->paginate(15, pageName: 'products-page'),
            'categories' => Category::where(function($sub_query) {
                $sub_query->where('name', 'like', '%'.$this->searchCategory.'%');
            })->paginate(15, pageName: 'categories-page'),
        ]);
    }
}
