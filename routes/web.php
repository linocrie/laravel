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

Route::prefix('admin')->group(function() {

});

Route::prefix('feed')->group(function() {
    Route::get('/', [FeedController::class, 'index'])->name('feed.index');
    Route::get('/{post}', [FeedController::class, 'view'])->name('feed.view');
    Route::get('/profile/{profile}', [FriendProfileController::class, 'show'])->name('feed.show');
});

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/detail', [DetailController::class, 'update'])->name('detail.update');
    Route::put('/upload', [AvatarController::class, 'upload'])->name('profile.upload');
});

Route::prefix('post')->group(function () {
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/store/', [PostController::class, 'create'])->name('posts.create');
Route::post('/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
Route::put('/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/delete/{post}', [PostController::class, 'delete'])->name('posts.delete');
});

Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleriesController::class, 'index'])->name('galleries.index');
    Route::get('/store', [GalleriesController::class, 'create'])->name('galleries.create');
    Route::post('/store', [GalleriesController::class, 'store'])->name('galleries.store');
    Route::get('/{gallery}', [GalleriesController::class, 'show'])->name('galleries.show');
    Route::put('/edit/{gallery}', [GalleriesController::class, 'edit'])->name('galleries.edit');
    Route::delete('/delete/{image}', [GalleriesController::class, 'delete'])->name('galleries.delete');
    Route::delete('/{gallery}', [GalleriesController::class, 'destroy'])->name('galleries.destroy');
});


