<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function indexPage() {
        $products = Product::get()->all();
        return view('site/userPages/main', compact('products'));
    }

    public function dashboard() {
        $products = Product::get()->all();
        return view('site/admin/dashboard', compact('products'));
    }

}
