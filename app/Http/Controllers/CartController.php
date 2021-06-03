<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    function addCartItem(Product $product, Request $request) {
        $cart = session('cart') ? session('cart') : collect([]);
        $entry = $cart->firstWhere('product', $product);

        if (!$entry) {
            $cart->push((object) [
                'product' => $product,
                'amount' => $request->amount,
                'subtotal' => $request->amount * $product->price,
            ]);
        }
        else {
            $entry->amount += $request->amount;
            $entry->subtotal += $request->amount * $product->price;

            $cart = $cart->filter(function($value) use ($product) {
                return $value->product != $product;
            });

            $cart->push($entry);
        }

        $totalPrice = $cart->sum('subtotal');
        session(['cart' => $cart, 'totalPrice' => $totalPrice]);
        return ['product' => $product, 'totalPrice' => $totalPrice];
    }

    function removeCartItem(Product $product) {
        if(session('cart')) {
            $cart = session('cart');
            $entry = $cart->firstWhere('product', $product);

            $cart = $cart->filter(function($value) use ($product) {
                return $value->product != $product;
            });

            $totalPrice = session('totalPrice') - $entry->subtotal;
            session(['cart' => $cart, 'totalPrice' => $totalPrice]);
        }
        return redirect()->back();
    }
}
