<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Mail;

require_once __DIR__ . '/auth.php';




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});











// admin

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', fn() => view('admin.index'))->name('admin.dashboard');

        Route::get('main-category-create', fn() => view('admin.main-category.main-category-create'));

        Route::controller(CategoryController::class)->group(function () {
            Route::get('main-category', 'getMainCategory')->name('main-category');
            Route::post('main-category-create', 'createMainCategory');
            Route::get('main-category-delete/{id}', 'deleteMainCategory');
            Route::get('main-category-update/{id}', 'getMainCategorySingle');
            Route::put('main-category-update', 'updateMainCategory');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('sub-category/{id?}', 'getSubCategory');
            Route::get('sub-category-create', 'getMainCategory')->name('sub-category-create');
            Route::post('sub-category-create', 'createSubCategory');
            Route::get('sub-category-delete/{id}', 'deleteSubCategory');
            Route::get('sub-category-update/{id}', 'getSubCategorySingle');
            Route::put('sub-category-update', 'updateSubCategory');
            Route::patch('change-category-status', 'changeCategoryStatus');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('product', 'getProduct');
            Route::get('product-create', 'getProductCreate');
            Route::post('product-create', 'createProduct');
            Route::get('product-update/{id}', 'getProductSingle');
            Route::put('product-update', 'updateProduct');
            Route::get('product-delete/{id}', 'deleteProduct');
            Route::patch('change-product-status', 'changeProductStatus');

            Route::post('product-imgs-bulk-upload', 'uploadBulkProductImages');
        });

        Route::get('product-imgs-bulk-upload', fn() => view('admin.product.product-imgs-bulk-upload'));
        Route::get('product-import', fn() => view('admin.product.product-import'));

        Route::get('report', fn() => view('admin.report.report'));
    });
});


Route::get('/admin/send-test-email', function () {
    Mail::raw('This is a test email using Google SMTP.', function ($message) {
        $message->to('bairagyakushal4@gmail.com')->subject('Test Email');
    });
    return 'Test email sent!';
});
