<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On; 

class CreateProduct extends Component
{
    use WithFileUploads;

    #[Validate('required', 'min:1', message: 'Selecione o nome do produto.')]
    public $name = '';
    #[Validate('required', 'min:1', message: 'Selecione uma categoria para o produto.')]
    public $category_id = '';
    #[Validate('required', 'decimal:2', 'min:1', message: 'Insira um preço válido para o produto')]
    public $price = '';
    #[Validate('required', 'image', 'mimes:jpeg,png,jpg,gif', message: 'Por favor, selecione uma imagem válida (JPEG, PNG, JPG ou GIF) com tamanho máximo de 2MB e dimensões entre 100x100 e 2000x2000 pixels.')]
    public $image = '';
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

        $product = Product::create([
            'name' => $this->name,
            'price' => $this->price,
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
        if($this->categories[$this->category_id - 1]->name == 'Açai Pronto') {
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
