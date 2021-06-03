<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

class PageController extends Controller
{
    public function home () {
        return view('home', [
            'products' => Product::inRandomOrder()->take(12)->get(),
        ]);
    }

    public function browseCategory (Category $category) {
        return view('browse', [
            'selectedCategory' => $category,
        ]);
    }

    public function cart () {
        return view('cart');
    }

    public function account (Request $request) {
        if ($request->isMethod('post')) {
            $user = auth()->user();
            $user->given_name = $request->givenName;
            $user->family_name = $request->familyName;
            $user->street = $request->street;
            $user->house_number = $request->houseNumber;
            $user->town = $request->town;
            $user->postal_code = $request->postalCode;
            $user->save();
            $request->session()->flash('successMessage', 'Osobní údaje byly úspěšně změněny.');
        }

        return view('account');
    }

    public function order () {
        if (!auth()->user()->street) {
            session()->flash('errorMessage', 'Nejprve musíte přidat adresu.');
            return redirect('ucet');
        }

        return view('order');
    }

    public function placeOrder () {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->save();

        $cart = session('cart');
        $cart->each(function($item) use ($order) {
            $product = Product::findOrFail($item->product->id);
            $order->products()->attach($product, ['amount' => $item->amount]);
        });

        session()->forget(['cart', 'totalPrice']);
        session()->flash('successMessage', 'Děkujeme za objednávku.');

        return redirect('ucet');
    }

    public function orders () {
        return view('orders', [
            'orders' => Order::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
