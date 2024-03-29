<?php

use App\Http\Controllers\ProductController;
use App\Livewire\CategoriesSlide;
use App\Livewire\Counter;
use App\Livewire\CreateProduct;
use App\Livewire\ProductCard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'indexPage'])->name('pagina.inicial');

Route::get('dashboard', [ProductController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/products', ProductCard::class)->name('products');
Route::get('/create-products', CreateProduct::class)->name('create.products');
require __DIR__.'/auth.php';
