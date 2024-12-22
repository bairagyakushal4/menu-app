<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// function currentUserType()
// {
//     if (Auth::guard('admin')->check()) {
//         return 'admin';
//     } elseif (Auth::guard('web')->check()) {
//         return 'user';
//     }

//     return null; // Not logged in
// }


function isAdminLoggedIn()
{
    return Auth::guard('admin')->check() && Auth::guard('admin')->user()->user_type === 'admin';
}


// function isUserLoggedIn()
// {
//     return Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 'user';
// }
