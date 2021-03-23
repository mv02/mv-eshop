<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    function addCartItem(Product $product, Request $request) {
        $cart = !session()->has('cart') ? [] : session('cart');
        if (isset($cart[$product->id]))
            $cart[$product->id] += $request->amount;
        else
            $cart[$product->id] = $request->amount;
        
        $totalAmount = !session()->has('totalAmount') ? 0 : session('totalAmount');
        $totalAmount += $request->amount;
    
        session(['cart' => $cart, 'totalAmount' => $totalAmount]);
        return ['product' => $product, 'totalAmount' => $totalAmount];
    }

    function removeCartItem(Product $product) {
        if (session()->has('cart')) {
            $cart = session('cart');
            $totalAmount = session('totalAmount') - $cart[$product->id];
            unset($cart[$product->id]);
            session(['cart' => $cart, 'totalAmount' => $totalAmount]);
        }
        return redirect()->back();
    }
}
