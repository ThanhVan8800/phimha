<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon;
use File;
use Storage;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Movie\MovieFormRequest;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->title)
        {
            $category = Category::where('title','LIKE','%'.$request->title.'%')->where('status', 1)->get();
            $genre = Genre::where('title','LIKE','%'.$request->title.'%')->orderBy('id','desc')->get();
            $country = Country::where('title','LIKE','%'.$request->title.'%')->orderBy('id','desc')->get();
            // $cate_slug = Category::where('slug',$slug)->first();
            
            // film cho sidebar
            $film_sidebar = Movie::where('film_hot',1)->where('status',1)->orderBy('update_day','DESC')->take(15)->get();
            
            //film- sidebar trailer
            $filmhot_trailer = Movie::where('resolution',5)->where('status',1)->orderBy('update_day','DESC')->take(10)->get();
            $movie = Movie::with('genre','country','category')->where('category_id','=',$category)->orderBy('update_day','DESC')->paginate(25);
            dd($movie);
        }
            
    
            return view('pages.locphim', compact('category','genre','country','movie','filmhot_trailer','film_sidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
