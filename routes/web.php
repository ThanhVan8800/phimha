<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserActivityController;

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
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class,'watch'])->name('watch');
Route::get('/so-tap', [IndexController::class,'so_tap'])->name('so-tap');
Route::get('/episode',[IndexController::class,'episode'])->name('episode');
// năm phim
Route::get('year/{year}',[IndexController::class,'year']);
//tags phim
Route::get('tag/{tag}',[IndexController::class,'tag']);

// search film
Route::get('search',[IndexController::class,'search'])->name('tim-kiem');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout_ad');

// admin routes
Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        //*Danh mục
        Route::prefix('categories')->group(function(){
            Route::resource('category', CategoryController::class);
            Route::get('filter',[CategoryController::class,'filter'])->name('filter');
        });
        //*Phim
        Route::prefix('movies')->group(function(){
            Route::resource('movie', MovieController::class);
            //* Tìm kiếm cho phim theo Ngày
            Route::get('search-movie', [MovieController::class,'searchMovie'])->name('searchMovie');
        });
        //* Quản lí tài khoản user
        // Route::prefix('users')->group(function(){
        //     Route::resource('user',UserController::class);
        // });
        //* Tài khoản cá nhân
        Route::prefix('users')->group(function(){
            Route::resource('user',UserController::class);
            Route::get('info',[UserController::class,'info']);
            Route::get('user/show/{user}',[UserController::class,'show']);
            Route::post('user/show/{user}',[UserController::class,'role']);
            Route::get('changePassword/{user}',[UserController::class,'changePassword']);
            Route::post('changePassword/{user}',[UserController::class,'pass']);
        });
        //* Nhật ký hoạt động
        Route::get('userlog-activities',[UserActivityController::class,'index']);
        Route::get('search-userlog',[UserActivityController::class,'searchUserlog'])->name('searchUserlog');

        //*Upload image
        Route::post('upload/services',[UploadController::class,'store']);
    });
    
});




Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);

Route::get('pdf', [CountryController::class,'index']);
Route::get('downloadPDF',[CountryController::class,'downloadPDF']);



Route::get('/update-year-film', [MovieController::class,'update_year'])->name('update-year');
Route::get('/update-session-film', [MovieController::class,'update_session'])->name('update-session');
Route::resource('watch', WatchController::class);

// thêm tập phim
Route::resource('episode', App\Http\Controllers\EpisodeController::class);
Route::get('episode-option',[App\Http\Controllers\EpisodeController::class,'select_movie'])->name('select-movie');
//*Tìm kiếm cho tập phim
Route::get('filter-search-episode',[App\Http\Controllers\EpisodeController::class,'search_episode'])->name('search-episode');
// Tìm kiếm cho admin
Route::get('search_ad', [CategoryController::class,'search'])->name('search_admin');
Route::get('ui', [IndexController::class,'ui']);
