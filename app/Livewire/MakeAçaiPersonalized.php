<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;

class MakeAçaiPersonalized extends ModalComponent
{

    public $quantities = [];
    public $acai;
    public $products;
    public $categories;
    public $fruits;
    public $aditionals;
    public function increment($categoryId)
    {
        $this->quantities[$categoryId]++;
    }

    public function mount()
    {
        $category = Category::where('name', 'Açai Pronto')->first();
        $this->acai = $category->product()->get();

        $fruitCategory = Category::where('name', 'frutas')->first();

        $this->fruits = Product::with('category')
            ->whereHas('category', function ($query) use ($fruitCategory) {
                $query->where('id', $fruitCategory->id);
            })
            ->get();

        $aditionalsCategory = Category::where('name', 'Adicionais')->first();

        $this->aditionals = Product::with('category')
            ->whereHas('category', function ($query) use ($aditionalsCategory) {
                $query->where('id', $aditionalsCategory->id);
            })
            ->get();

        $this->categories = Category::get()->all();
        foreach ($this->fruits as $f) {
            $this->quantities[$f->id] = 1;
        }

        foreach ($this->aditionals as $a) {
            $this->quantities[$a->id] = 1;
        }
    }

    public function decrement($categoryId)
    {
        if ($this->quantities[$categoryId] > 0) {
            $this->quantities[$categoryId]--;
        }
    }
    public function render()
    {
        return view('livewire.make-açai-personalized');
    }
}
