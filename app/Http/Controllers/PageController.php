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

    public function browseCategory (Category $category) {
        return view('browse', [
            'category' => $category,
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }

    public function cart () {
        $cartDetails = [];
        if (session()->has('cart')) {
            $priceSum = 0;
            foreach (session('cart') as $key => $value) {
                $product = Product::findOrFail($key);
                $priceSum += $value * $product->price;
                array_push($cartDetails, (object) [
                    'product' => $product,
                    'amount' => $value,
                    'total_price' => $value * $product->price,
                ]);
            }
        }

        return view('cart', [
            'cartDetails' => $cartDetails,
            'priceSum' => $priceSum,
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }
}
