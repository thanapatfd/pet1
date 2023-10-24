<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pet', [App\Http\Controllers\PetController::class, 'index']);
Route::get('/pet/edit/{id?}', [App\Http\Controllers\PetController::class, 'edit']);
Route::post('/pet/update', [App\Http\Controllers\PetController::class, 'update']);
Route::get('/pet/remove/{id}', [App\Http\Controllers\PetController::class, 'remove']);
Route::get('/pet/search/', [App\Http\Controllers\PetController::class, 'search']);
Route::post('/pet/search/', [App\Http\Controllers\PetController::class, 'search']);
Route::get('/pet/edit', [App\Http\Controllers\PetController::class, 'insert']);
Route::post('/pet/edit', [App\Http\Controllers\PetController::class, 'insert']);

                                                                             
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


Route::get('/cart/view', [App\Http\Controllers\CartController::class, 'viewCart']);
Route::get('/cart/add/{id?}', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::get('/cart/delete/{id?}', [App\Http\Controllers\CartController::class, 'deleteCart']);
Route::get('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout']);
Route::get('/cart/complete', [App\Http\Controllers\CartController::class, 'complete']);
Route::get('/cart/finish', [App\Http\Controllers\CartController::class, 'finish_order']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/logout',[App\Http\Controllers\LogoutController::class, 'perform' ])->name('perform');