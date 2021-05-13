<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/detail', [DetailController::class, 'update'])->name('detail.update');
Route::put('/profile/upload', [AvatarController::class, 'upload'])->name('profile.upload');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/store',function (){
    return view('postCreate');
});
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
