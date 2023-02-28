<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//   Route::get('/', function () {
//     return view('welcome');
//      });

// Route::get('/unicode', function(){
//     return view('product');
// });
//  Route::put('/unicode', function(){
//      return "Sytuan";
//  });
// Route::delete('/unicode', function(){
//     return "Sytuan";
// })
//Route::match(['get','post'], 'unicode',function(){
    //return $_SERVER['REQUEST_METHOD'];
//});
// Route::redirect('unicode','show-form')
// Route::view('index','admin');
// Route::prefix('admin')->group(function(){
//     Route::get('unicode',function(){
//         return '1';
//     });
//     Route::get('show',function(){
//         return view('product');
//     });
// });
// Client Route
Route::prefix('categories')->group( function() {
    //Danh sach chuyen muc
    Route::get('/',[CategoriesController::class, 'index']);
});
// Route::get('/layouts',function(){
//     view('layouts/master');
// });
