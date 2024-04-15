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
