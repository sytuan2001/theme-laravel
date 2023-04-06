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

//Route::get('/task', [TaskController::class, 'index']) ->name('todo.app');
//Route::post('/todos', [TaskController::class, 'store']) ->name('todo.store');
//Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])-> name('todo.delete');
//Route::get('todo/index',[TaskController::class, 'index']) ->name('todo.index');
//Route::get('todo/create',[TaskController::class, 'create']) ->name('todo.create');
Route::delete('/selected',[TaskController::class,'deleteChecked'])->name('todo.deleteSelected');
//Route::put('/task/{id}',[TaskController::class,'update'])->name('todo.update');
//Route::post('/tasks', 'TaskController@store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

