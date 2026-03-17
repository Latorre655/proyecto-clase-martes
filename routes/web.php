<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::get('/', HomeController::class);

Route::prefix("/product")->controller(ProductController::class)->group(function(){
    Route::get('/', 'index')->name("product.index");
    Route::get('/create','create')->name('product.create');
    Route::post("/store", "store")->name("product.store");
    Route::get('/{id}', 'show')->name('product.show');
    Route::delete('/{product}', 'destroy')->name('product.destroy');
});

Route::prefix('admin')->group(function(){
    Route::get('/', AdminController::class)->name('index');
    Route::resource('categories', CategoryController::class)->names('categories');
});

Route::prefix('cart')->controller(CartController::class)->group(function(){
    Route::get('/', 'index')->name('cart.index');
    Route::post('/add', 'add')->name('cart.add');
    Route::delete('/remove/{id}', 'remove')->name('cart.remove');
    Route::post('/clear', 'clear')->name('cart.clear');
});
