<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TaskController;

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

Route::get('/task', [TaskController::class, 'index']) ;
Route::post('/todos', [TaskController::class, 'store']) ->name('todo.store');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])-> name('todo.delete');
Route::get('todo/index',[TaskController::class, 'index']) ->name('todo.index');
Route::get('todo/create',[TaskController::class, 'create']) ->name('todo.create');
Route::delete('/selected',[TaskController::class,'deleteChecked'])->name('todo.deleteSelected');



