<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'categories'])->name('frontend.categories');
Route::get('/products', [HomeController::class, 'products'])->name('frontend.products');


// Frontend Authentication Pages
Route::get('/login', function () {
    return view('frontend.login');
})->name('frontend.login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', function () {
    return view('frontend.register');
})->name('frontend.register');

Route::post('/register', [RegisteredUserController::class, 'store']);

// Dynamic Pages Routes
Route::get('/about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('/companies', [HomeController::class, 'companies'])->name('frontend.companies');
Route::get('/companies/{id}', [HomeController::class, 'companyShow'])->name('frontend.company.show');
Route::get('/category/{slug}', [HomeController::class, 'categoryDetail'])->name('frontend.category.detail');
Route::get('/services', [HomeController::class, 'services'])->name('frontend.services');
Route::get('/services/{slug}', [HomeController::class, 'serviceDetail'])->name('frontend.services.detail');
Route::get('/careers', [HomeController::class, 'careers'])->name('frontend.careers');
Route::post('/careers/apply', [HomeController::class, 'applyJob'])->name('frontend.careers.apply');
Route::get('/news', [HomeController::class, 'news'])->name('frontend.news');
Route::get('/news/{id}', [HomeController::class, 'newsDetail'])->name('frontend.news.detail');
Route::get('/products/{slug}', [HomeController::class, 'productDetail'])->name('frontend.products.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.contact');
