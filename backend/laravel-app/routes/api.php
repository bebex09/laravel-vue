<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login',[App\Http\Controllers\AuthController::class,'login']);
Route::post('register',[App\Http\Controllers\AuthController::class,'register']);
Route::post('forgot',[App\Http\Controllers\ForgotController::class,'forgot']);
Route::get('user',[App\Http\Controllers\AuthController::class,'user'])->middleware('auth:api');