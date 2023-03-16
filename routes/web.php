<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

Route::get('/admin', function () {
    return view('admin');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('Login/login');
    })->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login_post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.content');
    })->name('dashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
