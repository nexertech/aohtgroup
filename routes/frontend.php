<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'categories'])->name('frontend.categories');

// Frontend Authentication Pages
Route::get('/login', function () {
    return view('frontend.login');
})->name('frontend.login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', function () {
    return view('frontend.register');
})->name('frontend.register');

Route::post('/register', [RegisteredUserController::class, 'store']);
