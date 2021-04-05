<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    function loginPage() {
        return view('login');
    }

    function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    function googleCallback() {
        $this->loginOrCreateUser('google');
        return redirect()->intended('/ucet');
    }

    function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    function facebookCallback() {
        $this->loginOrCreateUser('facebook');
        return redirect()->intended('/ucet');
    }

    function loginOrCreateUser($driver) {
        $socialUser = Socialite::driver($driver)->stateless()->user();
        $user = User::where('email', $socialUser->email)->first();
        if (!$user)
            $user = User::create(['email' => $socialUser->email]);
        auth()->login($user);
    }

    function logout() {
        auth()->logout();
        return redirect('');
    }
}
