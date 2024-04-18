<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('contacts',[App\Http\Controllers\ContactController::class,'contacts']);
Route::post('save_contact',[App\Http\Controllers\ContactController::class,'saveContact']);
Route::delete('delete_contact/{id}',[App\Http\Controllers\ContactController::class,'deleteContact']);
Route::get('get_contact/{id}',[App\Http\Controllers\ContactController::class,'getContact']);
Route::post('update_contact/{id}',[App\Http\Controllers\ContactController::class,'updateContact']);
Route::post('login',[App\Http\Controllers\AuthController::class,'login']);
Route::post('register',[App\Http\Controllers\AuthController::class,'register']);

Route::get('user',[App\Http\Controllers\AuthController::class,'user'])->middleware('auth:api');

//store product
Route::middleware('auth:api')->group(function () {
Route::post('store', [App\Http\Controllers\ProductController::class,'store']);
});

//get products by user_id
Route::get('products',[App\Http\Controllers\ProductController::class,'products'])->middleware('auth:api');

//get product by id
Route::get('getProduct/{id}',[App\Http\Controllers\ProductController::class,'getProduct']);

//update product
Route::post('update_product/{id}',[App\Http\Controllers\ProductController::class,'updateProduct'])->middleware('auth:api');

//delete product
Route::post('delete_product/{id}',[App\Http\Controllers\ProductController::class,'deleteProduct'])->middleware('auth:api');

