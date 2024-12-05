<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

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

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductController::class, 'create'])->name('productos.create');
    Route::get('/productos/estadisticas', [ProductController::class, 'estadisticas'])->name('productos.estadisticas');
    Route::resource('productos', ProductController::class);
    Route::post('/productos', [ProductController::class, 'store'])->name('productos.store');
    Route::get('productos/{producto}/edit', [ProductController::class, 'edit'])->name('productos.edit');
    Route::put('productos/{producto}', [ProductController::class, 'update'])->name('productos.update');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/privada', [ProductController::class, 'privada'])->name('privada');
    Route::get('/productos/privada', [ProductController::class, 'privada'])->name('productos.privada');
    Route::get('/producto/{id}', [ProductController::class, 'show'])->middleware('auth')->name('productos.show');
    
});

Route::get('/social-media', function () {
    return view('social-media');
})->name('social-media');

Route::get('/social-mediacontacto', function () {
    return view('social-mediacontacto');
})->name('social-mediacontacto');





Route::get('/productos/export', [ProductController::class, 'exportarExcel'])->name('productos.export');



Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::get('/privada', [ProductController::class, 'privada'])->middleware('auth')->name('privada');
Route::get('/productos/privada', [ProductController::class, 'privada'])->middleware('auth')->name('productos.privada');
Route::get('/producto/{id}', [ProductController::class, 'show'])->middleware('auth')->name('productos.show');
Route::get('/productos/graficos', [ProductController::class, 'graficos'])->middleware('auth')->name('productos.graficos');

// Mostrar el formulario de login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Procesar el login
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// Cerrar sesión
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::post('/validar-registro', [LoginController::class,'register'])-> name('validar-registro');
Route::post('iniciar-sesion',[LoginController::class,'login'])->name('iniciar-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');



Route::get('/productos/exportar-excel', [ProductController::class, 'exportarExcel'])->name('productos.exportar-excel');

Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');

Route::get('/secret', [App\Http\Controllers\ProductController::class, 'secret'])->name('secret');


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::delete('/remove-all', [CheckoutController::class, 'removeAll'])->name('removeAll');
