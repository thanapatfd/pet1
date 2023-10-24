<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/pet', [App\Http\Controllers\Api\PetControllerApi::class, 'pet_list']);
Route::get('/type', [App\Http\Controllers\Api\TypeControllerApi::class, 'type_list']);
Route::get('/pet/{type_id?}', [App\Http\Controllers\Api\PetControllerApi::class, 'pet_list']);
Route::post('/pet/search', [App\Http\Controllers\Api\PetControllerApi::class, 'pet_search']);
