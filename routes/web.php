<?php

use App\Events\ChatEvent;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\WheelController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InfoWebController;


use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\SortMovieController;
use App\Http\Controllers\LeechMovieController;
use App\Http\Controllers\FilmPackageController;
use App\Http\Controllers\ChatRealTimeController;
use App\Http\Controllers\RegisterUserController;
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

// web.php
Route::get('/export-view', [ExportController::class,'index']);
Route::post('/export', [ExportController::class,'export'])->name('export');

//Đăng ký đăng nhập cho người xem
Route::get('/login-user',[UserViewController::class,'index'])->name('loginUser');
Route::post('login-user',[UserViewController::class,'loginAuth'])->name('loginUser');
Route::get('/register-user',[RegisterUserController::class,'index'])->name('registerUser');
Route::post('/register-user',[RegisterUserController::class,'store']);
//* Login = Google Account
Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);

Route::post('/logout-user',[UserViewController::class,'logout'])->name('logoutUser');
//* Export excel 
Route::get('/export', function(){
    return Excel::download(new UsersExport,'users.xlsx');
})->name('excel_export');
Route::post('/import',function(Request $request){
    Excel::import(new UsersImport, $request->file('file'));
    return redirect('/admin/users/user');
})->name('excel_import');
// Route::get('/excel', 'ExportExcelController@excel')->name('export_excel.excel');


//* Xóa tất cả 
Route::delete('/admin/categories/selected-category',[CategoryController::class,'deleteAll'])->name('deleteCategoryAll');



Route::get('/',[IndexController::class,'index'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class,'category'])->name('cate');
Route::get('/the-loai/{slug}',[IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}',    [IndexController::class,'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_active}', [IndexController::class,'watch'])->name('watch');
Route::get('/so-tap', [IndexController::class,'so_tap'])->name('so-tap');
Route::get('/episode',[IndexController::class,'episode'])->name('episode');
// năm phim
Route::get('year/{year}',[IndexController::class,'year']);
//tags phim
Route::get('tag/{tag}',[IndexController::class,'tag']);
// search film
Route::get('search',[IndexController::class,'search'])->name('tim-kiem');


//!Lọc phim ở danh mục
Route::get('filter-film',[IndexController::class,'filter_film'])->name('filter_film');

Route::get('search_allfilm',[FilterController::class,'index'])->name('search_allfilm');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout_ad');

Route::post('resorting',[CategoryController::class,'resorting'])->name('resortingcategory');

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
            Route::get('addEpisode',[MovieController::class,'addEpisode'])->name('addEpisode');
            //* Tìm kiếm cho phim theo Ngày
            Route::get('search-movie', [MovieController::class,'searchMovie'])->name('searchMovie');
            //* Cập nhật phim bằng ajax
            Route::post('update-image-movie-ajax',[MovieController::class,'update_image_movie_ajax'])->name('update-image-movie-ajax');
            //* Gallery Film
            Route::resource('gallery', GalleryController::class);
            //*Sắp xếp phim 
            Route::get('/sortmovie',[SortMovieController::class,'sortfilm'])->name('sort-film');
            Route::post('sortmovie',[SortMovieController::class,'resorting_cate'])->name('resorting_cate');
            Route::post('resorting_movie',[SortMovieController::class,'resorting_movie'])->name('resorting_movie');

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

        //* Thống kêloginUser
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
        Route::post('/filter-by-date',[DashboardController::class,'filter'])->name('filter-by-date');
        Route::post('/dashboard-filter',[DashboardController::class,'dashboard_filter'])->name('dashboard-filter');
        Route::post('/chart30days',[DashboardController::class,'chart30days'])->name('chart30days');

        Route::get('/send-mail', [SendMailController::class, 'sendMail'])->name('sendMail');
        //* Thông tin giao diện web
        Route::resource('infoWeb', InfoWebController::class);
        //
        //*
        Route::resource('/linkmovie',LinkMovieController::class);
    });
    
});


Route::resource('genre', GenreController::class);


Route::get('pdf', [CountryController::class,'index']);
Route::get('downloadPDF',[CountryController::class,'downloadPDF']);



Route::get('/update-year-film', [MovieController::class,'update_year'])->name('update-year');
Route::get('/update-session-film', [MovieController::class,'update_session'])->name('update-session');
// Route::resource('watch', WatchController::class);

// thêm tập phim
Route::resource('episode', App\Http\Controllers\EpisodeController::class);
//thêm tập phim ở ds phim
Route::get('/add-episode/{$id}',[App\Http\Controllers\EpisodeController::class,'add_episode'])->name('addEpisode');

Route::get('episode-option',[App\Http\Controllers\EpisodeController::class,'select_movie'])->name('select-movie');
//*Tìm kiếm cho tập phim
Route::get('filter-search-episode',[App\Http\Controllers\EpisodeController::class,'search_episode'])->name('search-episode');
// Tìm kiếm cho admin
Route::get('search_ad', [CategoryController::class,'search'])->name('search_admin');

//* Đánh giá sao cho phim
// Route::post('rating', [RatingController::class,'rating'])->name('rate');
    Route::post('/insert-rating',[RatingController::class, 'insert_rating']);
//* Thay đổi dữ liệu bằng ajax
    Route::get('/update-year-phim', [MovieController::class, 'update_year']);
    Route::get('/update-topview-phim', [MovieController::class, 'update_topview']);
    Route::post('/filter-topview-phim', [MovieController::class, 'filter_topview']);
    Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);
    // Route::post('watch-video',[MovieController::class, 'watch_video'])->name('watch-video');
    Route::post('watch-video',[MovieController::class,'watch_video'])->name('watch-videoo');



//* Đăng ký gói Vip
Route::get('/planform',[RegisterUserController::class,'planform']);
//PaymentController

Route::post('/vnpay_payment',[PaymentController::class,'vnpay_payment']);

//* Cảm ơn khi đăng ký
Route::get('/thank-you',[UserViewController::class,'show']);
//Trang thông tin khách hàng
Route::get('/profile',[UserViewController::class,'profile'])->name('profile');

Route::get('ui', [IndexController::class,'ui']);

//! Tạo vòng quay
Route::get('index',[WheelController::class,'index']);


//* Leecch phim
Route::get('/leech-phim',[LeechMovieController::class,'leech_movie']);
Route::get('leech-phim-detail/{$slug}',[LeechMovieController::class,'leech_movie_detail'])->name('leech-phim-detail');
