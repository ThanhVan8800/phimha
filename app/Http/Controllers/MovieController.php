<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstMovie = Movie::orderBy('id', 'desc')->get();
        return view('admin.movie.list',[
            'lstMovie' => $lstMovie,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        // khi dùng pluck muốn select hiện title thì để thứ tự title đứng trước và ngược lại
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $lstMovie = Movie::with('category','country','genre')->orderBy('id', 'desc')->get();
        return view('admin.movie.form',[
            'lstMovie' => $lstMovie,
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie -> title = $data['title'];
        $movie -> slug = $data['slug'];
        $movie -> description = $data['description'];
        $movie -> category_id = $data['category_id'];
        $movie -> genre_id = $data['genre_id'];
        $movie -> country_id = $data['country_id'];
        $movie -> status = $data['status'];
        // Thêm hình ảnh
        $get_image = $request->file('image');
        $path = 'public/uploads/movie/';
        if($get_image)
        {
            $get_name_image = $get_image -> getClientOriginalName(); // hinhDaLat.jpg
            $name_image = current(explode('.',$get_name_image)); //current để lấy phần trước dấu . là lấy hinhDaLat còn để là end thì ngược lại
            $new_image = $name_image.rand(0,999) .'.' . $get_image->getClientOriginalExtension(); // hinhDaLat789.jpg
            $get_image -> move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }

        $movie -> save();
        return redirect()->back();
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
        $movie = Movie::find($id);
        $category = Category::pluck('title', 'id');
        // khi dùng pluck muốn select hiện title thì để thứ tự title đứng trước và ngược lại
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $lstMovie = Movie::with('category','country','genre')->orderBy('id', 'desc')->get();
        return view('admin.movie.form',[
            'lstMovie' => $lstMovie,
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'movie' => $movie
        ]);
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
        $data = $request->all();
        $movie =  Movie::find($id);
        $movie -> title = $data['title'];
        $movie -> slug = $data['slug'];
        $movie -> description = $data['description'];
        $movie -> category_id = $data['category_id'];
        $movie -> genre_id = $data['genre_id'];
        $movie -> country_id = $data['country_id'];
        $movie -> status = $data['status'];
        // Thêm hình ảnh
        $get_image = $request->file('image');
        $path = 'public/uploads/movie/';
        if($get_image)
        {
            if(!empty($movie->image))
            {
                unlink('uploads/movie/' . $movie->image);
            }
            $get_name_image = $get_image -> getClientOriginalName(); // hinhDaLat.jpg
            $name_image = current(explode('.',$get_name_image)); //current để lấy phần trước dấu . là lấy hinhDaLat còn để là end thì ngược lại
            $new_image = $name_image.rand(0,999) .'.' . $get_image->getClientOriginalExtension(); // hinhDaLat789.jpg
            $get_image -> move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }

        $movie -> save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if(!empty($movie->image))
        {
            unlink('uploads/movie/' . $movie->image);
        }
        $movie->delete();
        return redirect()->back();
    }
}
