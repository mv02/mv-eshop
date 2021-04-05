<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home () {
        return view('home');
    }

    public function browseCategory (Category $category) {
        return view('browse', [
            'selectedCategory' => $category,
        ]);
    }

    public function cart () {
        return view('cart');
    }

    public function account () {
        return view('account');
    }
}
