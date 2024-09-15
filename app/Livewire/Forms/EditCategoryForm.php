<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditCategoryForm extends Component
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
        $this->image = $this->category->image;
    }

    public function update()
{
    $validatedData = $this->validate([
        'name' => 'required',
    ]);

    $category = Category::findOrFail($this->categoryId);
    $category->name = $this->name;

    if ($this->image) {
        // Validação do tipo de arquivo
        $this->validate([
            'image' => 'image|max:2048', // Limite de 2MB, ajuste conforme necessário
        ]);

        // Definindo o nome único para a imagem (para evitar sobrescrever)
        $imageName = time() . '_' . $this->image->getClientOriginalName();

        // Salvando a imagem na pasta 'public/categoryImages'
        $this->image->storeAs('public/categoryImages', $imageName);

        // Removendo a imagem antiga, se existir
        if ($category->image && Storage::exists('public/categoryImages/' . $category->image)) {
            Storage::delete('public/categoryImages/' . $category->image);
        }

        // Atualizando o nome da imagem no banco de dados
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
