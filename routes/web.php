<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::get('/privada', [ProductController::class, 'privada'])->middleware('auth')->name('privada');


Route::post('/validar-registro', [LoginController::class,'register'])-> name('validar-registro');
Route::post('iniciar-sesion',[LoginController::class,'login'])->name('iniciar-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductController::class, 'store'])->name('productos.store');
Route::resource('productos', ProductController::class);
Route::get('productos/{producto}/edit', [ProductController::class, 'edit'])->name('productos.edit');
Route::put('productos/{producto}', [ProductController::class, 'update'])->name('productos.update');

Route::get('/secret', [App\Http\Controllers\ProductController::class, 'secret'])->name('secret');


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');