<?php

namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\VNPay;
use App\Models\Rating;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Category;
use App\Models\LinkMovie;
use App\Models\InfoWebsite;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function ui(){
        return view('index');
    }
    public function search()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderBy('position','ASC')->where('status', 1)->get();
            $genre = Genre::orderBy('id','desc')->get();
            $country = Country::orderBy('id','desc')->get();
            // $cate_slug = Category::where('slug',$slug)->first();
            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('update_day','DESC')->paginate(25);
    
            // film cho sidebar
            $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
    
            //film- sidebar trailer
            $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
    
            return view('pages.search', compact('category', 'genre', 'country','search','movie','film_sidebar','filmhot_trailer'));
        }else{
            return redirect()->to('');
        }
        
    }
    public function index()
    {
        // $view_movie = DB::table('movies')
        //         ->join('episodes', 'movies.id', '=', 'episodes.movie_id')
        //         // ->join('orders', 'users.id', '=', 'orders.user_id')
        //         ->select('movies.*', 'episodes.views')
        //         ->select( DB::raw('views'))
        //         ->groupBy('views')
        // //         ->havingRaw('SUM(SL_Ton) > 0')

        //         ->get();
                // dd($view_movie);
        //film_hot cho slider
        $film_hot = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->get();
        // film cho sidebar
        $film_sidebar = Movie::with('episode')->where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $category_home = Category::with('movie')->orderBy('id','desc')->where('status',1)->get();
        $info = InfoWebsite::find(5);
        return view('pages.home',[
            'category' => $category, 
            'genre' => $genre,
            'country' => $country,
            'category_home' => $category_home,
            'film_hot' => $film_hot,
            'film_sidebar' => $film_sidebar,
            'filmhot_trailer' => $filmhot_trailer,
            // 'view_movie' => $view_movie,
            
        ]);
    }
    public function category($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('update_day','DESC')->paginate(25);

        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();

        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();

        return view('pages.category', compact('category', 'genre', 'country','cate_slug','movie','film_sidebar','filmhot_trailer'));
    }
    public function genre($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $genre_slug = Genre::where('slug',$slug)->first();

        //Hiển thị phim thuộc nhiều thể loại
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug -> id) -> get();
        $many_genre = [];
        foreach($movie_genre as $key => $movie){
            $many_genre[] = $movie -> movie_id;
        }  
        //return response()->json($many_genre);   
        $movie = Movie::whereIn('id',$many_genre)->withCount('episode')->orderBy('update_day','DESC')->paginate(25);

        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
        return view('pages.genre', compact('category', 'genre', 'country','genre_slug','movie','movie_genre','film_sidebar','filmhot_trailer'));
    }
    public function year($year)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        // $genre_slug = Category::where('slug',$slug)->first();
        // $movie = Movie::where('genre_id',$genre_slug->id)->orderBy('update_day','DESC')->paginate(25);
        $year = $year;
        $movie = Movie::where('year',$year)->orderBy('update_day','DESC')->paginate(25);

        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();

        return view('pages.year', compact('category', 'genre', 'country','movie','year','film_sidebar','filmhot_trailer'));
    }
    public function tag($tag)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        // $genre_slug = Category::where('slug',$slug)->first();
        // $movie = Movie::where('genre_id',$genre_slug->id)->orderBy('update_day','DESC')->paginate(25);
        $tag = $tag;
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('update_day','DESC')->paginate(25);
        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();

        return view('pages.tag', compact('category', 'genre', 'country','movie','tag','film_sidebar','filmhot_trailer'));
    }
    public function country($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $country_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$country_slug->id)->orderBy('update_day','DESC')->paginate(25);

        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
        
        return view('pages.country', compact('category', 'genre', 'country','country_slug','movie','film_sidebar','filmhot_trailer'));
    }
    public function movie($slug)
    {
        //Lấy ngày hiện tại kiểm tra ngày hết hạn
        // $current_time = Carbon\Carbon::now()->toDateTimeString();
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $movie = Movie::with('category','genre','country')->where('slug',$slug)->where('status',1)->first();
        //phim lien quan 
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
          //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();

        //film_hot cho slider
        $film_hot = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->get();

        // Tập phim d
        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(5)->get();
        //tạo url slug cho tập phim mặc định là tập 1 khi click vào film,

        $episode_numfilm = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();
        $vnPay = VNPay::all();
        //hiện tổng số tập đã có
        $episode_current = Episode::with('movie')->where('movie_id',$movie->id)->get();

        $episode_count = $episode_current->count();

        return view('pages.movie',compact('category','genre','country','movie','related','filmhot_trailer','film_hot','episode','episode_numfilm','episode_count','vnPay'));
    }
    public function watch($slug,$tap,$server_active)
    {
        // if(isset($_GET['tap-phim']))
        //     {
        //         $tap_phim =$_GET['tap-phim'];
        //     }
        // else{
        //     $tap_phim = 1;
        // }
        //     $tap_phim = substr($tap_phim,0,9);
            // dd($tapphim);
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        //phim lien quan 
        //film- sidebar trailer
        $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
        // film cho sidebar
        $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
        
        //film_hot cho slider
        $film_hot = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->get();
        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();
        // lấy phim theo điều kiện của tập phim theo

        if(isset($tap)){
            $tapphim = $tap;
            $tapphim = substr($tap,4,20);
            // dd($tapphim);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
            $episode->increment('views');
            $ratingAvg = Rating::where('episode_id',$episode->id)->avg('rating_star');
            $ratingAvg = round($ratingAvg);
            $count = Rating::where('episode_id',$episode->id)->count();
            // dd($ratingAvg);
        }
        else{
            $tapphim = 1;
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
            $ratingAvg = Rating::where('episode_id',$tapphim)->avg('rating_star');
            $ratingAvg = round($ratingAvg);
            $episode->increment('views');
            $count = Rating::where('episode_id',$episode->id)->count();
        }
        // return response()->json($movie);
        
        //*Server film
        $server = LinkMovie::orderBy('id','DESC')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->get()->unique('server');
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        //*Gợi ý phim 
        $related = Movie::with('category', 'movie_genre','country','genre')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->orderByDesc('status',1)->whereNotIn('slug',[$slug])->get();
        
        
        return view('pages.watch',compact('category','genre','country','movie',
                                        'film_sidebar','filmhot_trailer','film_hot','episode',
                                        'tapphim','related','ratingAvg','count','server','episode_list','episode_movie',
                                        'server_active'
                                    ));
    }
    public function episode()
    {
        return view('pages.episode');
    }
    //* Lọc phim 
    public function filter_film(Request $request)
    {
        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $category_home = Category::with('movie')->orderBy('id','desc')->where('status',1)->get();
        $info = InfoWebsite::find(5);
        if($sapxep == '' && $genre_get == '' && $country_get == '' && $year_get == ''){
            return redirect()->back()->with('Error', 'Please select a country');
        }else{
            $movie = Movie::withCount('episode');
            if($genre_get){
                $movie = $movie->where('genre_id',$genre_get);
            }elseif($country_get){
                $movie = $movie->where('country_id',$country_get);
            }elseif($year){
                $movie = $movie->where('year',$year_get);
            }elseif($sapxep){
                $movie = $movie->orderBy('title','ASC');
            }
            $movie = $movie->orderBy('update_day','DESC')->paginate(50);
            return view('pages.includes.filler_researcher_episode',[
                'movie' => $movie,
                'category' => $category,
                'genre' => $genre,
                'country' => $country,
                'category_home' => $category_home,
                'info' => $info
            ]);
        }

    }

}
