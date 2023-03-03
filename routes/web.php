<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


Route::get('/login', function(){
    return view('Login/login');

});
Route::get('/admin',function(){
    return view('admin');

});
Route::get('/dashboard',function(){
    return view('dashboard.content');

})->name('dashboard');
Route::get('/something',function (){
    return redirect('/admin');
});
// Route::get('home',[
//     HomeController::class,
//     'index'

// ]);

// Route::get('login',[
//     LoginController::class,
//     'login'

//     //
// ]);



// Route::get('/home', 'HomeController@index');

// Route::get('/login', 'LoginController@login');
    

