<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;

class IndexController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id','DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $category_home = Category::with('movie')->orderBy('id','desc')->get();
        return view('pages.home',[
            'category' => $category, 
            'genre' => $genre,
            'country' => $country,
            'category_home' => $category_home
        ]);
    }
    public function category($slug)
    {
        $category = Category::orderBy('id','desc')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        return view('pages.category', compact('category', 'genre', 'country','cate_slug'));
    }
    public function genre($slug)
    {
        $category = Category::orderBy('id','desc')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc')->get();
        $country = Country::orderBy('id','desc')->get();
        return view('pages.genre', compact('category', 'genre', 'country'));
    }
    public function country($slug)
    {
        $category = Category::orderBy('id','desc')->where('status', 1)->get();
        $genre = Genre::orderBy('id','desc');
        $country = Country::orderBy('id','desc');
        return view('pages.country', compact('category', 'genre', 'country'));
    }
    public function movie()
    {
        return view('pages.movie');
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
