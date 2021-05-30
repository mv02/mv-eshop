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
}
