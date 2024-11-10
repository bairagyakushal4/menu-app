<?php

use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return redirect('/admin');
});


// =================admin====================

Route::group(['prefix' => 'admin'], function () {
    require_once __DIR__ . '/admin-auth.php';
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    require_once __DIR__ . '/admin.php';
});

// =================admin====================
