<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// USERS
Route::get('/users/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/users/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/users/{id}/comments', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'detail'])->name('user.detail');
// CRUD AJAX
Route::post('/users/storeAjax', [App\Http\Controllers\UserController::class, 'storeAjax'])->name('user.storeAjax');
Route::post('/users/deleteAjax', [App\Http\Controllers\UserController::class, 'deleteAjax'])->name('user.deleteAjax');
Route::get('/users-ajax/getDataEdit', [App\Http\Controllers\UserController::class, 'getDataEdit'])->name('user.getDataEdit');
Route::post('/users-ajax/updateUser', [App\Http\Controllers\UserController::class, 'updateUser'])->name('user.updateUser');


//USERS AJAX
Route::get('/users-ajax/index', [App\Http\Controllers\UserController::class, 'indexAjax'])->name('user.ajax.index');
Route::get('/users-ajax/getDataTable', [App\Http\Controllers\UserController::class, 'getDataTable'])->name('user.ajax.getDataTable');

Route::post('/users-ajax/search-name', [App\Http\Controllers\UserController::class, 'searchDataName'])->name('user.search.searchDataName');
Route::post('/users-ajax/search-post-total', [App\Http\Controllers\UserController::class, 'searchDataPost'])->name('user.search.searchDataPost');
Route::post('/users-ajax/search-comment-total', [App\Http\Controllers\UserController::class, 'searchDataComment'])->name('user.search.searchDataComment');

// POSTS
Route::get('/posts/{id}/shows', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

//COMMENTS
Route::get('/comments/index', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
Route::get('/comments/{id}/users', [App\Http\Controllers\CommentController::class, 'show'])->name('comments.users');
