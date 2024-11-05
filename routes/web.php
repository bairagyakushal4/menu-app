<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', fn() => redirect('admin'));

// admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', fn() => view('admin.index'));

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
