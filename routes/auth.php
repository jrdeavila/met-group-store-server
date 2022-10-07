<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::post('auth', LoginController::class)->name('login');
Route::post('register', RegisterController::class)->name('register');;
