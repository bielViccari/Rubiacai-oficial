<?php

use App\Http\Controllers\ProductController;
use App\Livewire\AboutUs;
use App\Livewire\CreateProduct;
use App\Livewire\EditCategory;
use App\Livewire\EditProduct;
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

Route::view('profile', 'site/admin/profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/products', ProductCard::class)->name('products');
Route::view('/about-us', 'site/userPages/about')->name('about-us');

Route::get('/create-products', CreateProduct::class)->name('create.products')
    ->middleware('auth');

Route::get('/edit-product/{id}', EditProduct::class)->name('edit.product')
    ->middleware('auth');

Route::get('/edit-category/{id}', EditCategory::class)->name('edit.category')
    ->middleware('auth');

require __DIR__.'/auth.php';
