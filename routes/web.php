<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin');
});
Route::get('/register', function () {
    return view('register');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('Login/login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login_post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.content');
    })->name('dashboard');

    Route::get('/logout', [LogoutController::class, 'logout'])
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('todos.home');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::delete('/selected', [TaskController::class, 'deleteChecked'])->name('tasks.deleteSelected');
    Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::delete('/tasks/{task}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.show_form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');






