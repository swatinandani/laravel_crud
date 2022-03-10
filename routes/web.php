<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store'); 
Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('category/{id}/update', [CategoryController::class, 'update'])->name('category.update'); 
Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

Route::get('product', [ProductController::class, 'index'])->name('product');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store'); 
Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/{id}/update', [ProductController::class, 'update'])->name('product.update'); 
Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');


 
Route::get('get-articles', [ArticleController::class, 'getArticles'])->name('get-articles');


