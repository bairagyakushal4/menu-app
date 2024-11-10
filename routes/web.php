<?php

use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return redirect('/admin');
});


// =================admin====================

Route::group(['prefix' => 'admin'], function () {
    require_once __DIR__ . '/admin-auth.php';

    Route::middleware('auth')->group(function () {
        require_once __DIR__ . '/admin.php';
    });
});

// =================admin====================
