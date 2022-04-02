<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $film_hot = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->get();
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $category_home = Category::with('movie')->orderBy('id','desc')->where('status',1)->get();
        return view('pages.home',[
            'category' => $category, 
            'genre' => $genre,
            'country' => $country,
            'category_home' => $category_home,
            'film_hot' => $film_hot,
        ]);
    }
    public function category($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('update_day','DESC')->paginate(25);
        return view('pages.category', compact('category', 'genre', 'country','cate_slug','movie'));
    }
    public function genre($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $genre_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('genre_id',$genre_slug->id)->orderBy('update_day','DESC')->paginate(25);
        return view('pages.genre', compact('category', 'genre', 'country','movie'));
    }
    public function country($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc');
        $country = Country::orderBy('id','desc');
        $country_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$country_slug->id)->orderBy('update_day','DESC')->paginate(25);
        return view('pages.country', compact('category', 'genre', 'country','movie'));
    }
    public function movie($slug)
    {
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc');
        $country = Country::orderBy('id','desc');
        $movie = Movie::with('category','genre','country')->where('slug',$slug)->where('status',1)->first();
        //phim lien quan 
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        return view('pages.movie',compact('category','genre','country','movie','related'));
    }
    public function watch()
    {
        return view('pages.watch');
    }
    public function episode()
    {
        return view('pages.episode');
    }

}
