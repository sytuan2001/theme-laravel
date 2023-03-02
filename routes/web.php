<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


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
// Route::prefix('categories')->group( function() {
//     //Danh sach chuyen muc
//     Route::get('/',[CategoriesController::class, 'index']);
// });
// Route::get('/layouts',function(){
//     view('layouts/master');
// });
Route::get('/login', function(){
    return view('Login/login');

});
Route::get('/admin',function(){
    return view('admin');

});
Route::get('/dashboard',function(){
    return view('Dashboard.content');

})->name('dashboard');
Route::get('/something',function (){
    return redirect('/admin');
});
Route::get('home',[
    HomeController::class,
    'index'

]);
// Route::get('category/{id}',function($id){
//     return 'Category'.$id;
// })-> where('id','[0-9]+'); 
// Route::get('/admin/user',function(){
//     return "/admin/user";
// });

// Route::get('/admin/slide',function(){
//     return "/admin/slide";
// });
// Route::get('/admin/category',function(){
//     return "/admin/category";
// });
$prefixAdmin="admin100";

Route::prefix($prefixAdmin)->group(function () {
    Route::get('/user', function () {
        return "/admin/user";
        // Matches The "/admin/users" URL
    });
    Route::get('/slide',function(){
        return "/admin/slide";
    });
    Route::get('/category',function(){
        return "/admin/category";
    });
});


Route::get('users/{id}', function($id) {
    //
});

Route::group(['prefix' => 'admin'], function() {
    
    Route::get('users/', function() {
        return "123";
        //
    });
    
});

Route::get('users/{id}', function($id) {
    //
});
