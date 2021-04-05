<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    function addCartItem(Product $product, Request $request) {
        $cart = session('cart') ? session('cart') : [];
        if (isset($cart[$product->id]))
            $cart[$product->id]->amount += $request->amount;
        else {
            $product->amount = $request->amount;
            $cart[$product->id] = $product;
        }

        $subtotal = session('subtotal') ? session('subtotal') : 0;
        $subtotal += $request->amount * $product->price;
        session(['cart' => $cart, 'subtotal' => $subtotal]);
        return ['product' => $product, 'subtotal' => $subtotal];
    }

    function removeCartItem(Product $product) {
        if(session('cart')) {
            $cart = session('cart');
            $subtotal = session('subtotal') - session('cart')[$product->id]->amount * $product->price;
            unset($cart[$product->id]);
            session(['cart' => $cart, 'subtotal' => $subtotal]);
        }
        return redirect()->back();
    }
}
