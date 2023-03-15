<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserAuth;


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post("user",[UserAuth::class,'userLogin']);

// Route::get('/login', function () {
//     return view('Login.login');
// });

Route::get('/admin', function () {
    return view('admin');
});

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', function () {
        return view('Login/login');
    })->name('login');
    Route::post('/login', [LoginController::class,'authenticate'] )->name('login_post');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('dashboard.content');
    })->name('dashboard');
});

Route::get('/something', function () {
    return redirect('/admin');
});
// Route::get('home', [
//     HomeController::class,
//     'index'
// ]);
// Route::get('/login', 'LoginController@login');

//Route::get('/home', 'dashboard@content');

