<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use Carbon\Carbon;
use File;
use Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\Movie\MovieFormRequest;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstMovie = Movie::with('movie_genre')->orderBy('id', 'desc')->get();
       // return response()->json($lstMovie);
        // tạo file movie_json để load tìm kiếm cho nhẹ trang
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json', json_encode($lstMovie));

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

        $lstGenre = Genre::all();
        $lstMovie = Movie::with('category','country','genre')->orderBy('id', 'desc')->get();
        return view('admin.movie.form',[
            'lstMovie' => $lstMovie,
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'lstGenre' => $lstGenre,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieFormRequest $request)
    {
        // dd($request->input());
        $data = $request->all();
        $movie = new Movie();
        $movie -> title = $data['title'];
        $movie -> film_hot = $data['film_hot'];
        $movie -> name_eng = $data['name_eng'];
        $movie -> year = $data['year'];
        $movie -> trailer = $data['trailer'];
        $movie -> resolution = $data['resolution'];
        $movie -> movie_duration = $data['movie_duration'];
        $movie -> subtitle = $data['subtitle'];
        $movie -> slug = $data['slug'];
        $movie -> tags = $data['tags'];
        $movie -> description = $data['description'];
        $movie -> category_id = $data['category_id'];
        $movie -> episode_film = $data['episode_film'];


        // $movie -> genre_id = $data['genre_id'];
        foreach($data['genre'] as $key => $gen)
        {
            $movie -> genre_id = $gen['0'];
        }


        $movie -> country_id = $data['country_id'];
        $movie -> status = $data['status'];
        $movie -> date_created = Carbon::now('Asia/Ho_Chi_Minh');
        $movie -> update_day = Carbon::now('Asia/Ho_Chi_Minh');
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
        //thêm nhiều thể loại cho phim
        $movie -> save();
        $movie -> movie_genre() -> attach($data['genre']);
        //$request -> Session()->flash('error','Email hoặc password không đúng vui lòng đăng nhập lại!');// luu y!
        return redirect()->route('movie.index');
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
        $category = Category::pluck('title', 'id');
        // khi dùng pluck muốn select hiện title thì để thứ tự title đứng trước và ngược lại
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        
        $lstGenre = Genre::all();
        $movie = Movie::find($id);
        $movie_genre = $movie -> movie_genre;
        $lstMovie = Movie::with('category','country','genre')->orderBy('id', 'desc')->get();
        return view('admin.movie.form',[
            'lstMovie' => $lstMovie,
            'category' => $category,
            'genre' => $genre,
            'country' => $country,
            'movie' => $movie,
            'lstGenre' => $lstGenre,
            'movie_genre' => $movie_genre,
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
        // return response()->json($data['genre']);
        $movie =  Movie::find($id);
        $movie -> title = $data['title'];
        $movie -> film_hot = $data['film_hot'];
        $movie -> name_eng = $data['name_eng'];
        $movie -> year = $data['year'];
        $movie -> trailer = $data['trailer'];
        $movie -> resolution = $data['resolution'];
        $movie -> movie_duration = $data['movie_duration'];
        $movie -> subtitle = $data['subtitle'];
        $movie -> slug = $data['slug'];
        $movie -> tags = $data['tags'];
        $movie -> description = $data['description'];
        $movie -> category_id = $data['category_id'];
        // $movie -> genre_id = $data['genre_id'];
        foreach($data['genre'] as $key => $gen)
        {
            $movie -> genre_id = $gen['0'];
        }
        $movie -> country_id = $data['country_id'];
        $movie -> status = $data['status'];
        $movie -> episode_film = $data['episode_film'];


        $movie -> date_created = Carbon::now('Asia/Ho_Chi_Minh');
        $movie -> update_day = Carbon::now('Asia/Ho_Chi_Minh');
        
        // Thêm hình ảnh
        $get_image = $request->file('image');
        $path = 'public/uploads/movie/';
        if($get_image)
        {
            // !empty tồn tại link thì xóa || isset
            if(file_exists('uploads/movie/' . $movie->image))
            {
                unlink('uploads/movie/' . $movie->image);
            }else{
                $get_name_image = $get_image -> getClientOriginalName(); // hinhDaLat.jpg
                $name_image = current(explode('.',$get_name_image)); //current để lấy phần trước dấu . là lấy hinhDaLat còn để là end thì ngược lại
                $new_image = $name_image.rand(0,9999) .'.' . $get_image->getClientOriginalExtension(); // hinhDaLat789.jpg
                $get_image -> move('uploads/movie/',$new_image);
                $movie->image = $new_image;
            }

        }

        $movie -> save();
        $movie -> movie_genre() -> sync($data['genre']);
        //detach , sync đồng bộ cho csdl

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
        if(file_exists('uploads/movie/' . $movie->image))
        {
            unlink('uploads/movie/' . $movie->image);
        }
        Movie_Genre :: whereIn('movie_id', [$movie->id])->delete();
        $movie->delete();
        return redirect()->back();
    }
    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie -> year = $data['year'];
        $movie -> save();
    }
    public function update_session(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_session']);
        $movie -> session = $data['session'];
        $movie -> save();
    }
}
