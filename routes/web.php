<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Auth\AdminAuthController;

Route::get('/', fn() => view('welcome'));



Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';







// =================ADMIN====================

Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['RedirectAdminAuth', 'guest:admin'])->group(function () {
        Route::get('login', [AdminAuthController::class, 'showAdminLogin'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'adminLogin']);
    });

    Route::middleware(['AdminCheckMiddleware', 'auth:admin'])->group(function () {
        Route::post('logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
        require_once __DIR__ . '/admin.php';
    });
});

// =================ADMIN====================