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


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }
    public function filter_topview(Request $request){
        $data = $request->all();
        // dd($data);
        $movie = Movie::where('topview',$data['value'])->orderBy('update_day','DESC')->take(10)->get();
        $output = '';
            foreach($movie as $key => $mov){
                if($mov->resolution==0){
                    $text = 'HD';
                }elseif($mov->resolution==1){
                    $text = 'SD';
                }
                elseif($mov->resolution==2){
                    $text = 'HDCam';
                }
                elseif($mov->resolution==3){
                    $text = 'Cam';
                }
                elseif($mov->resolution==4){
                    $text = 'FullHD';
                }else{
                    $text = 'Tralier';
                }
        $output.='<div class="item">
                            <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                <div class="item-link">
                                <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                                <span class="is_trailer">
                                    '.$text.'
                                </span>
                                </div>
                                <p class="title">'.$mov->title.'</p>
                                <p class="original_title">'.$mov->name_eng.'</p>
                            </a>
                            
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>';
    }
    echo $output;
    }
        public function filter_default(Request $request){
            $data = $request->all();
            $movie = Movie::where('topview',0)->orderBy('update_day','DESC')->take(10)->get();
            $output = '';
            foreach($movie as $key => $mov){
                
                                    if($mov->resolution==0){
                                            $text = 'HD';
                                        }elseif($mov->resolution==1){
                                            $text = 'SD';
                                        }
                                        elseif($mov->resolution==2){
                                            $text = 'HDCam';
                                        }
                                        elseif($mov->resolution==3){
                                            $text = 'Cam';
                                        }
                                        elseif($mov->resolution==4){
                                            $text = 'FullHD';
                                        }else{
                                            $text = 'Tralier';
                                        }
                $output.='<div class="item">
                                <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                                    <div class="item-link">
                                        <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                                        <span class="is_trailer">
                                            '.$text.'
                                        </span>
                                    </div>
                                    <p class="title">'.$mov->title.'</p>
                                    <p class="original_title">'.$mov->name_eng.'</p>
                                </a>
                                
                                <div style="float: left;">
                                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                    </span>
                                </div>
                            </div>';
            }
            echo $output;
    }
    public function index()
    {
        $Movie_Json = Movie::with('category','movie_genre','country','genre')->orderBy('id', 'DESC')->get();
        // $lstMovie = Movie::with('category','movie_genre','country','genre')->orderBy('id', 'DESC')->paginate(8);

        //* đếm số tập

        $lstMovie = Movie::with('category','movie_genre','country','genre')->withCount('episode')->orderBy('id', 'DESC')->get();
        // dd($lstCount);
       // return response()->json($lstMovie);
        // tạo file movie_json để load tìm kiếm cho nhẹ trang
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json', json_encode($Movie_Json));

        return view('admin.movie.list',[
            'lstMovie' => $lstMovie,
            'title' => 'Thêm phim mới',
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
            'title' => 'Danh sách phim'
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
        try{
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
            //*Tác giả, đạo diễn
            $movie -> actor = $data['actor'];
            $movie -> director = $data['director'];
            // thuộc phim
            $movie -> belonging_movie = $data['belonging_movie'];
            $movie -> film_vip = $data['film_vip'];

            //Thêm nhiều thể loại phim
            // $movie -> genre_id = $data['genre_id'];
            foreach($data['genre'] as $key => $gen)
            {
                $movie -> genre_id = $gen[0];
            }
            // dd($movie->genre_id);
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
            //* Nhật ký hoạt động
            $user = Auth::user();
            Session()->put('user', $user);
            $user = Session()->get('user');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $todayDate = $dt->toDayDateTimeString();
            // dd($todayDate);
            $name = $user->name;
            $email = $user->email;
            $address = $user->address;
            // $date_time = $user->date_time;
            $activity = [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'date_time' => $dt,
                'modify_user' => $name.' tạo phim mới '.$movie -> title.' '
            ];
            DB::table('userlog_activities')->insert($activity);

            //thêm nhiều thể loại cho phim
            $movie -> save();
            $movie -> movie_genre() -> attach($data['genre']);
            Session::flash('success','Tạo phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        
        //$request -> Session()->flash('error','Email hoặc password không đúng vui lòng đăng nhập lại!');// luu y!
        return redirect()->back();
    }

    public function addEpisode(Request $request, $id){
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $movie = Movie::with('category','country','genre')->find($id);

        return view('admin.movie.detail',[
            'title' => 'Chi tiết phim',
            'movie' => $movie
        ]);
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
            'title' => 'Chỉnh sửa phim'

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
        try{
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
            //*Tác giả, đạo diễn
            $movie -> actor = $data['actor'];
            $movie -> director = $data['director'];
            
            $movie -> category_id = $data['category_id'];
            $movie -> belonging_movie = $data['belonging_movie'];
            $movie -> film_vip = $data['film_vip'];
            
            $movie -> country_id = $data['country_id'];
            $movie -> status = $data['status'];
            $movie -> episode_film = $data['episode_film'];
    
    
            $movie -> update_day = Carbon::now('Asia/Ho_Chi_Minh');
            // $movie -> image = $data['image'];
            // Thêm hình ảnh
            $get_image = $request->file('image');
            // $path = 'public/uploads/movie/';
            if($get_image)
            {
                // !empty tồn tại link thì xóa || isset
                if(file_exists('uploads/movie/' . $movie->image))
                {
                    unlink('uploads/movie/' . $movie->image);
                    $get_name_image = $get_image -> getClientOriginalName(); // hinhDaLat.jpg
                    $name_image = current(explode('.',$get_name_image)); //current để lấy phần trước dấu . là lấy hinhDaLat còn để là end thì ngược lại
                    $new_image = $name_image.rand(0,9999) .'.' . $get_image->getClientOriginalExtension(); // hinhDaLat789.jpg
                    $get_image -> move('uploads/movie/',$new_image);
                    $movie->image = $new_image;
                }
    
            }
            // $movie -> genre_id = $data['genre_id'];
            foreach($data['genre'] as $key => $gen)
            {
                $movie -> genre_id = $gen['0'];
            }
            $movie -> save();
            $movie -> movie_genre() -> sync($data['genre']);
            //* Nhật ký hoạt động
            $user = Auth::user();
            Session()->put('user', $user);
            $user = Session()->get('user');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $todayDate = $dt->toDayDateTimeString();
            // dd($todayDate);
            $name = $user->name;
            $email = $user->email;
            $address = $user->address;
            // $date_time = $user->date_time;
            $activity = [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'date_time' => $dt,
                'modify_user' => $name.' cập nhật phim '.$movie -> title.''
            ];
            DB::table('userlog_activities')->insert($activity);
            

            //detach , sync đồng bộ cho csdl
            Session::flash('success','Cập nhật phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        

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
        try{
            $movie = Movie::find($id);
            if(file_exists('uploads/movie/' . $movie->image))
            {
                unlink('uploads/movie/' . $movie->image);
            }
            Movie_Genre :: whereIn('movie_id', [$movie->id])->delete();
            Episode :: whereIn('movie_id', [$movie->id])->delete();

            //*whereIn xóa 1 mảng thuộc film đó
            $movie->delete();
            return redirect()->back();
            //* Nhật ký hoạt động
            $user = Auth::user();
            Session()->put('user', $user);
            $user = Session()->get('user');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $todayDate = $dt->toDayDateTimeString();
            // dd($todayDate);
            $name = $user->name;
            $email = $user->email;
            $address = $user->address;
            // $date_time = $user->date_time;
            $activity = [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'date_time' => $dt,
                'modify_user' => $name.' cập nhật phim '.$movie -> title.''
            ];
            DB::table('userlog_activities')->insert($activity);
        }catch(Exception $err){
            Session()->flash('error','Không thể xóa phim này. Vui lòng kiểm tra lại!');
            Log::info("message");
            return false;
        }
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
    //Tìm kiếm cho phim 
    public function searchMovie(Request $request)
    {
        $Movie_Json = Movie::with('category','movie_genre','country','genre')->orderBy('id', 'DESC')->get();
        $lstMovie = Movie::with('category','movie_genre','country','genre')->orderBy('id', 'DESC')->paginate(8);
        // return response()->json($lstMovie);
        // tạo file movie_json để load tìm kiếm cho nhẹ trang
        $path = public_path()."/json/";
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        File::put($path.'movies.json', json_encode($Movie_Json));
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $query = Movie::
                        with('category','movie_genre','country','genre')
                        ->select()
                        ->where('date_created','>=',$fromDate)
                        ->where('date_created','<=',$toDate)
                        ->get();
                        // dd($query);

        return view('admin.movie.result_search_movie',[
            'title' => 'Danh sách phim',
            'query' => $query
        ]);
    }
}
