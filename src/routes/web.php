<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/products', [ProductsController::class, 'list'])->name('products.list');
Route::get('/thanks',[ProductsController::class, 'thanks']);
Route::get('/products/search', [ProductsController::class, 'search'])->name('products.search');

Route::get('/products/register', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products/register', [ProductsController::class, 'store'])->name('products.store');

Route::get('/products/detail/{productId}', [ProductsController::class, 'show'])->name('products.detail');
// 商品情報の更新処理
Route::patch('/products/{productId}/update', [ProductsController::class, 'update'])->name('products.update');
// 商品情報の削除処理
Route::delete('/products/{productId}/delete', [ProductsController::class, 'destroy'])->name('products.destroy');