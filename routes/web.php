<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;

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
