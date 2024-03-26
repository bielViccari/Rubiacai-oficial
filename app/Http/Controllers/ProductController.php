<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function indexPage() {
        return view('site/userPages/main');
    }

}
