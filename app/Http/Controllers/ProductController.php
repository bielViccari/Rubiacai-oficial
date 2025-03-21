<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function indexPage() {
        return view('site/userPages/main');
    }

    public function dashboard() {
        return view('site/admin/dashboard');
    }

}
