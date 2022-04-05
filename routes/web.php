<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchController;
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

Route::get('/',[IndexController::class,'index'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class,'category'])->name('cate');
Route::get('/the-loai/{slug}',[IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}',    [IndexController::class,'movie'])->name('movie');
Route::get('/xem-phim',[IndexController::class,'watch'])->name('watch');
Route::get('/episode',[IndexController::class,'episode'])->name('episode');
// năm phim
Route::get('year/{year}',[IndexController::class,'year']);
//tags phim
Route::get('tag/{tag}',[IndexController::class,'tag']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin routes
Route::resource('category', CategoryController::class);
Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('movie', MovieController::class);
Route::get('/update-year-film', [MovieController::class,'update_year'])->name('update-year');
Route::get('/update-session-film', [MovieController::class,'update_session'])->name('update-session');
Route::resource('watch', WatchController::class);
Route::resource('episode', App\Http\Controllers\EpisodeController::class);
