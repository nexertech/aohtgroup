<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/frontend.php';

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('company-info', App\Http\Controllers\Admin\CompanyInfoController::class);
    Route::resource('team-members', App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('product-categories', App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::get('get-subcategories/{id}', [App\Http\Controllers\Admin\ProductCategoryController::class, 'getSubcategories'])->name('get-subcategories');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product-galleries', App\Http\Controllers\Admin\ProductGalleryController::class);
    Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
    Route::resource('contact-messages', App\Http\Controllers\Admin\ContactMessageController::class);
    Route::resource('job-openings', App\Http\Controllers\Admin\JobOpeningController::class);
    Route::resource('job-applications', App\Http\Controllers\Admin\JobApplicationController::class);
    Route::resource('clients', App\Http\Controllers\Admin\ClientController::class);
    Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class);
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
    Route::resource('email-templates', App\Http\Controllers\Admin\EmailTemplateController::class);

    // Pages Management
    Route::get('pages/about', [App\Http\Controllers\Admin\AboutPageController::class, 'index'])->name('pages.about');
    Route::put('pages/about', [App\Http\Controllers\Admin\AboutPageController::class, 'update'])->name('pages.about.update');

    // Logs
    Route::get('activity-logs', [App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('error-logs', [App\Http\Controllers\Admin\ErrorLogController::class, 'index'])->name('error-logs.index');
    Route::get('visitors', [App\Http\Controllers\Admin\VisitorController::class, 'index'])->name('visitors.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {
    require __DIR__ . '/auth.php';
});
