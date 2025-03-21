<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\System;
use Carbon\Carbon;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class MakeAçaiPersonalized extends ModalComponent
{

    public $quantities = [];
    public $acai;
    public $products;
    public $categories;
    public $fruits;
    public $aditionals;
    public $successMessage;

    public $closed = false;
    public function mount()
    {
        $category = Category::where('name', 'Açai puro')->first();
        if (isset($category)) {
            $this->acai = $category->product()->get();

            $fruitCategory = Category::where('name', 'frutas')->first();
            if (isset($fruitCategory)) {
                $this->fruits = Product::with('category')
                    ->whereHas('category', function ($query) use ($fruitCategory) {
                        $query->where('id', $fruitCategory->id);
                    })
                    ->get();
            }

            $aditionalsCategory = Category::where('name', 'Adicionais')->first();
            if (isset($aditionalsCategory)) {
                $this->aditionals = Product::with('category')
                    ->whereHas('category', function ($query) use ($aditionalsCategory) {
                        $query->where('id', $aditionalsCategory->id);
                    })
                    ->get();
            }

            $this->categories = Category::get()->all();
            if (isset($this->fruits)) {
                foreach ($this->fruits as $f) {
                    $this->quantities[$f->id] = 0;
                }
            }
            if (isset($this->aditionals)) {
                foreach ($this->aditionals as $a) {
                    $this->quantities[$a->id] = 0;
                }
            }
        }
        $this->setInitialSize();
        $this->checkIsOpen();
        $this->updateTotalPrice();
    }

    public $system;
    public function checkIsOpen()
    {
        $currentTime = Carbon::now();
        $startLimit = Carbon::parse('10:00:00');
        $endLimit = Carbon::parse('22:00:00');

        if ($currentTime->between($startLimit, $endLimit) && !$currentTime->isMonday()) {
            $this->closed = false;
        } else {
            $this->closed = true;
        }

        $systemIsWorking = System::find(1);
        if ($systemIsWorking && $systemIsWorking->status == 1) {
            $this->system = $systemIsWorking;
        }
    }

    public $size;
    public $quantity;
    public $observation;
    public $errorMessage;

    public function addToCart(Request $request)
{
    $system = System::find(1);

    if ($this->closed == true || $system && $system->status == 1) {
        if ($this->closed == true) {
            $this->errorMessage = 'Atendemos de Terça-feira à Domingo das 15:00 às 21:00';
        }

        if ($system->status == 1) {
            $this->errorMessage = $system->message;
        }
    } else {
        $this->validate([
            'quantity' => 'required|min:1',
        ]);

        $acaiPersonalized = [
            'frutas' => [],
            'frutas_quantidade' => [],
            'adicionais' => [],
            'adicionais_quantidade' => [],
            'tamanho' => $this->size,
            'quantidade' => $this->quantity,
            'observacao' => $this->observation,
            'precoTotal' => 0,
        ];

        $precoFrutas = 0;
        if (isset($this->fruits)) {
            foreach ($this->fruits as $fruit) {
                if ($this->quantities[$fruit->id] > 0) {
                    $acaiPersonalized['frutas'][] = $fruit;
                    $acaiPersonalized['frutas_quantidade'][] = $this->quantities[$fruit->id] * $this->quantity;
                    $precoFrutas += $fruit->price * $this->quantities[$fruit->id] * $this->quantity;
                }
            }
        }

        $precoAditionals = 0;
        if (isset($this->aditionals)) {
            foreach ($this->aditionals as $additional) {
                if ($this->quantities[$additional->id] > 0) {
                    $acaiPersonalized['adicionais'][] = $additional;
                    $acaiPersonalized['adicionais_quantidade'][] = $this->quantities[$additional->id] * $this->quantity;
                    $precoAditionals += $additional->price * $this->quantities[$additional->id] * $this->quantity;
                }
            }
        }

        if ($this->size != '') {
            $product = Product::where('name', $this->size)->first();
            $sizeValue = $product->price;
            $acaiPersonalized['precoTotal'] = $precoAditionals + $precoFrutas + ($this->quantity * $sizeValue);
        }

        $carrinho = $request->session()->get('carrinho', []);
        $carrinho['acaiPersonalizado'][] = $acaiPersonalized;
        $request->session()->put('carrinho', $carrinho);
        $this->dispatch('product-added');
        $this->successMessage = 'Produto adicionado ao carrinho';
        $this->closeModal();
    }
}


    public $totalPrice = 0;
    public $sizePrice;
    public $totalQtdSize;

    public function setInitialSize()
    {
        $firstAcai = null;
        if($this->acai) {
            $firstAcai = $this->acai->first();
        }
        if ($firstAcai) {
            $this->sizePrice = $firstAcai->price;
            $this->size = $firstAcai->name;

            $this->quantity = 1;

            $this->totalQtdSize = $firstAcai->price * $this->quantity;
        } else {
            $this->sizePrice = null;
            $this->size = null;
            $this->quantity = null;
            $this->totalQtdSize = null;
        }
    }


    private function updateTotalPrice()
    {
        $totalPrice = 0;

        if($this->fruits) {
            // Calcular o preço das frutas selecionadas
            foreach ($this->fruits as $fruit) {
                $totalPrice += ($this->quantities[$fruit->id] * $fruit->price) * $this->quantity;
            }
        }

        if($this->aditionals) {
            // Calcular o preço dos adicionais selecionados
            foreach ($this->aditionals as $additional) {
                $totalPrice += ($this->quantities[$additional->id] * $additional->price) * $this->quantity;
            }
        }

        // Adicionar o preço do tamanho selecionado, se houver
        if ($this->totalQtdSize) {
            $totalPrice += $this->totalQtdSize;
        } elseif ($this->sizePrice) {
            $totalPrice += $this->sizePrice;
        }

        // Atualizar o preço total
        $this->totalPrice = $totalPrice;
    }


    public function updateSizePrice()
    {
        if($this->size) {
            $this->sizePrice = $this->acai->where('name', $this->size)->first()->price;
            $this->updateSizePriceByQuantity();
            $this->updateTotalPrice();
        }
    }

    public function updateSizePriceByQuantity()
    {
        if($this->sizePrice) {
            if($this->quantity) {
                $this->totalQtdSize = $this->sizePrice * $this->quantity;
                $this->updateTotalPrice();
            } else {
                $this->totalQtdSize = $this->sizePrice * 0;
                $this->updateTotalPrice();
            }
        }
    }

    public function increment($categoryId)
    {
        $filtered_array = array_filter($this->quantities, function($value) {
            return $value > 0;
        });

        if($total = array_sum($filtered_array) < 15) {
            $this->quantities[$categoryId]++;
            $this->updateTotalPrice();
        }
    }


    public function decrement($categoryId)
    {
        if ($this->quantities[$categoryId] > 0) {
            $this->quantities[$categoryId]--;
            $this->updateTotalPrice();
        }
    }

    public function render()
    {
        return view('livewire.make-açai-personalized');
    }
}
