<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 

class CreateProductForm extends Component
{
    use WithFileUploads;

    #[Validate('required|min:1', message: 'Selecione o nome do produto.')]
    public $name = '';
    #[Validate('required', 'min:1', message: 'Selecione uma categoria para o produto.')]
    public $category_id = '';
    #[Validate('required|min:1|regex:/^[0-9]+([,.][0-9]+)?$/', message: 'Insira um preço válido para o produto')]
    public $price = '';
    #[Validate('required', 'image', 'max:1024', message: 'Por favor, selecione uma imagem válida (JPEG, PNG, JPG ou GIF) com tamanho máximo de 2MB e dimensões entre 100x100 e 2000x2000 pixels.')]
    public $image;
    public $description = '';
    public $categories;
    public $showLoading = false;
    public $successMessage;
    
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
        $this->validate();
        $priceFormated = number_format(floatval(str_replace(',', '.', $this->price)), 2, '.', '');
        Product::create([
            'name' => $this->name,
            'price' => $priceFormated,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'image' => $this->image->getClientOriginalName()
        ]);

        $imageName = $this->image->getClientOriginalName();
        $this->image->storeAs('public/productImages', $imageName);
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Produto adicionado com sucesso!',
            position: 'center',
        );
        $this->reset('name', 'price', 'image', 'description');
    }

    public $needDescription = false;
    public function checkCategory() {
        $categoryName = '';
    
        foreach ($this->categories as $category) {
            if ($category->id == $this->category_id) {
                $categoryName = $category->name;
            }
        }
        if ($categoryName == 'Açai Pronto' || $categoryName == 'Açai pronto') {
           $this->needDescription = true;
        } else {
            $this->needDescription = false;
        }
    }
    
    public function setLoading() {
        $this->showLoading = true;
    }
 
    public function render()
    {
        return view('livewire.create-product');
    }
}
