<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\User;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Rating;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstCountUser = User::count();
        $lstCountMovie = Movie::count();
        $lstCountCate = Category::count();
        $lstCountGenres = Genre::count();
        $Episode_View = Episode::with('movie')->orderBy('views','desc')->take(15)->get();
        $Count_rating = Rating::with('episode')->orderBy('rating_star','desc')->take(15)->get();
        return view('admin.dashboard',[
            'title' => 'Dashboard'
        ], compact('lstCountUser','lstCountMovie','lstCountCate','lstCountGenres','Episode_View','Count_rating'));
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
