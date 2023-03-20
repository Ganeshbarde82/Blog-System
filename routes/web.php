<?php

use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\TagController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::view('/theme', 'layouts.dashbord');

Auth::routes();

// Auth::routes([
//     'register' => false
// ]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('auth/posts', PostController::class);
Route::get('auth/categories', [CategoryController::class, 'openCategoriesPage'])->name('auth.categories');
Route::get('auth/tags', [TagController::class, 'openTagsPage'])->name('auth.tags');
Route::get('auth/profile', [ProfileController::class, 'openProfilePage'])->name('auth.index');
Route::post('auth/profile', [ProfileController::class, 'storeProfile'])->name('auth.store');

});



//Route::view('/', 'site.index');

Route::get('/',[BlogController::class, 'index'])->name('home');
Route::get('single/{id}',[BlogController::class, 'openSingle'])->name('single-blog');

Route::post('post/comment/{postId}',[CommentController::class, 'postComment'])->name('post.comment')->middleware('auth');
Route::post('comment/reply/{commentId}',[CommentController::class, 'postCommentReply'])->name('comment.reply');
Route::delete('comment/reply/delete',[CommentController::class, 'deleteCommentReply'])->name('comment.reply.delete');