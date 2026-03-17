<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', AdminController::class)->name('admin.index');
});
