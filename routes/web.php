<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home']);
Route::get('/nabidka/{category}', [PageController::class, 'browseCategory']);
Route::get('/kosik', [PageController::class, 'cart']);
Route::post('/kosik/{product}/{amount}', [CartController::class, 'addCartItem']);
Route::get('/kosik/odstranit/{product}', [CartController::class, 'removeCartItem']);

Route::prefix('/login')->group(function() {
    Route::get('', [LoginController::class, 'loginPage'])->name('login');
    Route::get('/google', [LoginController::class, 'googleRedirect']);
    Route::get('/google/callback', [LoginController::class, 'googleCallback']);
    Route::get('/fb', [LoginController::class, 'facebookRedirect']);
    Route::get('/fb/callback', [LoginController::class, 'facebookCallback']);
});
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => '/ucet', 'middleware' => 'auth'], function() {
    Route::get('', [PageController::class, 'account']);
    Route::post('', [PageController::class, 'account']);
    Route::get('/objednavky', [PageController::class, 'orders']);
});

Route::get('/objednavka', [PageController::class, 'order'])->middleware('auth');
Route::get('/platba', [PageController::class, 'placeOrder'])->middleware('auth');
