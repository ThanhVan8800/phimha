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
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ChatRealTimeController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FilmPackageController;
use App\Http\Controllers\SendMailController;


use App\Events\ChatEvent;

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


//Đăng ký đăng nhập cho người xem
Route::get('/login-user',[UserViewController::class,'index'])->name('loginUser');
Route::post('login-user',[UserViewController::class,'loginAuth'])->name('loginUser');
Route::get('/register-user',[RegisterUserController::class,'index'])->name('registerUser');
Route::post('/register-user',[RegisterUserController::class,'store']);

Route::post('/logout-user',[UserViewController::class,'logout'])->name('logoutUser');




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

//Lọc phim

Route::get('search_allfilm',[FilterController::class,'index'])->name('search_allfilm');

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
        //*Quản lí quốc gia 
        Route::prefix('countries')->group(function(){
            Route::resource('country', CountryController::class);
            //* Tìm kiếm cho phim theo Ngày
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

        //*Chat realtime
        Route::prefix('chat')->group(function(){
            Route::get('index',[ChatRealTimeController::class,'index']);
            Route::post('store',[ChatRealTimeController::class,'store'])->name('chat.store');
        });
        //* Danh sách tài khoản đăng ký gói phim
        Route::prefix('film_package')->group(function(){
            Route::get('film-package',[FilmPackageController::class,'film_package'])->name('film_package');
            Route::get('film-package/{id}',[FilmPackageController::class,'edit'])->name('film_package.edit');
            Route::post('film-package/{id}',[FilmPackageController::class,'update']);
            Route::get('vnpay-payment',[FilmPackageController::class,'show'])->name('vnpay');
        });
        //* Nhật ký hoạt động
        Route::get('userlog-activities',[UserActivityController::class,'index']);
        Route::get('search-userlog',[UserActivityController::class,'searchUserlog'])->name('searchUserlog');

        //*Upload image
        Route::post('upload/services',[UploadController::class,'store']);

        //* Thống kê
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
        Route::post('/filter-by-date',[DashboardController::class,'filter'])->name('filter-by-date');
        Route::post('/dashboard-filter',[DashboardController::class,'dashboard_filter'])->name('dashboard-filter');
        Route::post('/chart30days',[DashboardController::class,'chart30days'])->name('chart30days');

        Route::get('/send-mail', [SendMailController::class, 'sendMail'])->name('sendMail');
    });
    
});




Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::resource('genre', GenreController::class);


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

//* Đánh giá sao cho phim
// Route::post('rating', [RatingController::class,'rating'])->name('rate');
    Route::post('/insert-rating',[RatingController::class, 'insert_rating']);

    Route::get('/update-year-phim', [MovieController::class, 'update_year']);
    Route::get('/update-topview-phim', [MovieController::class, 'update_topview']);
    Route::get('/filter-topview-phim', [MovieController::class, 'filter_topview']);
    Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);


//* Đăng ký gói Vip
Route::get('/planform',[RegisterUserController::class,'planform']);
//PaymentController

Route::post('/vnpay_payment',[PaymentController::class,'vnpay_payment']);

//* Cảm ơn khi đăng ký
Route::get('/thank-you',[UserViewController::class,'show']);
//Trang thông tin khách hàng
Route::get('/profile',[UserViewController::class,'profile'])->name('profile');

Route::get('ui', [IndexController::class,'ui']);
