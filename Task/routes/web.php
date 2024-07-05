<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileResetController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-up', [RegisterController::class, 'signUp']);
    Route::post('/sign-up', [RegisterController::class, 'register']);

    Route::get('/sign-in', [LoginController::class, 'signIn'])->name('login');
    Route::post('/sign-in', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logOut']);
    Route::get('/posts/{postId}/comments', [PostController::class, 'postComments']);
    Route::get('/users/{userId}/posts', [PostController::class, 'userPosts']);
    Route::get('/edit/posts/{postId}', [PostController::class, 'editForm']);
    Route::get('/post-add', [PostController::class, 'addForm']);
    Route::post('/comment', [CommentController::class, 'add']);
    Route::post('/posts', [PostController::class, 'add']);
    Route::put('posts/{postId}', [PostController::class, 'update']);
    Route::delete('posts/{postId}', [PostController::class, 'delete']);

});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/all-posts', [PostController::class, 'allPosts']);
Route::get('/post-search', [PostController::class, 'search']);

