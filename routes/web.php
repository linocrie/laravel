<?php


use App\Http\Controllers\FriendProfileController;
use App\Http\Controllers\GalleriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedController;
use \App\Http\Controllers\DetailController;
use \App\Http\Controllers\AvatarController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
Route::get('/feed/{post}', [FeedController::class, 'view'])->name('feed.view');
Route::get('/feed/profile/{post}', [FriendProfileController::class, 'show'])->name('feed.show');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/detail', [DetailController::class, 'update'])->name('detail.update');
Route::put('/profile/upload', [AvatarController::class, 'upload'])->name('profile.upload');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/store', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::put('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');

Route::get('/gallery', [GalleriesController::class, 'index'])->name('galleries.index');
Route::get('/gallery/store', [GalleriesController::class, 'create'])->name('galleries.create');
Route::post('/gallery/store', [GalleriesController::class, 'store'])->name('galleries.store');
Route::get('/gallery/{id}', [GalleriesController::class, 'show'])->name('galleries.show');
Route::put('/gallery/edit/{id}', [GalleriesController::class, 'edit'])->name('galleries.edit');
Route::delete('/gallery/delete/{id}', [GalleriesController::class, 'delete'])->name('galleries.delete');
Route::delete('/gallery/{id}', [GalleriesController::class, 'destroy'])->name('galleries.destroy');
