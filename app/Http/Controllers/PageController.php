<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home () {
        return view('home', [
            'featuredCategories' => Category::where('featured', true)->orderBy('name', 'asc')->get(),
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }
}
