<?php

use App\Http\Controllers\ProductController;
use App\Livewire\Counter;
use App\Livewire\CreateProduct;
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

Route::view('dashboard', '/site/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/counter', Counter::class);
Route::get('/create-products', CreateProduct::class);
require __DIR__.'/auth.php';
