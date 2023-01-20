<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TotalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/category', function () {
    return view('admin/category');
});
Route::get('/author', function () {
    return view('admin/author');
});
Route::get('/reg', function () {
    return view('admin/user');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::view('/login', 'admin.login')->name('admin.login');
        Route::post('/login', [App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/book', [BookController::class, 'book']);

        Route::get('/fetchall', [BookController::class, 'fetchAll'])->name('fetchAll');
        Route::delete('/delete', [BookController::class, 'delete'])->name('delete');
        Route::get('/edit', [BookController::class, 'edit'])->name('edit');
        Route::post('/update', [BookController::class, 'update'])->name('update');
        Route::post('store', [BookController::class, 'store'])->name('store');
        // Category
        Route::post('/form_submit', [CategoryController::class, 'form_submit'])->name('form_submit');
        Route::get('user', [CategoryController::class, 'getUser'])->name('get.users');
        Route::delete('/delete_cat', [CategoryController::class, 'delete'])->name('delete_cat');
        Route::get('/edit_cat', [CategoryController::class, 'edit'])->name('edit_cat');
        Route::post('/update_cat', [CategoryController::class, 'update'])->name('update_cat');

  // Author
  Route::post('/formsubmitauth', [AuthorController::class, 'form_submit'])->name('formsubmitauth');;
  Route::get('author', [AuthorController::class, 'getRecord'])->name('get.record');
  Route::delete('/deleteauth', [AuthorController::class, 'delete'])->name('deleteauth');
  Route::get('/editauth', [AuthorController::class, 'edit'])->name('editauth');
  Route::post('/updateauth', [AuthorController::class, 'update'])->name('updateauth');
    });


    //User
    Route::get('reg', [UserController::class, 'regUser'])->name('reg.user');
    Route::get('/rentbook', [UserController::class, 'rentBook'])->name('rentbook');
});


Route::get('show/{id}', [App\Http\Controllers\HomeController::class, 'index'])->name('display');
Route::get('pdf/{id}', [App\Http\Controllers\HomeController::class, 'pdf'])->name('pdf_display');

Route::get('add-to-cart/{id}', [App\Http\Controllers\HomeController::class, 'order'])->name('add-cart');
Route::get('leave/{id}', [App\Http\Controllers\HomeController::class, 'leave'])->name('leave');

