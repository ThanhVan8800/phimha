<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\LinkMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Episode\EpisodeFormRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstEpisode = Episode::with('movie')->orderBy('id','ASC')->get();
        // ->latest()->paginate(2);
        $movie = Movie::orderBy('id','desc')->pluck('title', 'id');
        $lstLinkMovi = LinkMovie::orderBy('id','desc')->pluck('title', 'id');
        $linkserve = LinkMovie::orderBy('id','desc')->get();
        return view('admin.episode.form',[
            'lstEpisode' => $lstEpisode,
            'movie' => $movie,
            'title' => 'Tập phim',
            'lstLinkMovi' => $lstLinkMovi,
            'linkserve' => $linkserve,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeFormRequest $request)
    {
        try{

            $data = $request->all();
            // TODO: Kiểm tra số tập thêm có trùng hay không
            $episode_check = Episode::where('episode',$data['episode'])->where('movie_id',$data['movie_id'])->count();
            if($episode_check)
            {
                return redirect()->back();
            }else{
                $episode = new Episode();
                $episode -> linkfilm = $data['linkfilm'];
                $episode -> episode = $data['episode'];
                $episode -> movie_id = $data['movie_id'];
                $episode -> server = $data['server'];
                $episode -> created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $episode -> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
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
                    'modify_user' => $name.' tạo tập phim '.$episode -> episode.' '
                ];
                DB::table('userlog_activities')->insert($activity);
                $episode->save();
                Session::flash('success','Tạo tập phim thành công');
            }
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        
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

        $movie = Movie::find($id);
        $lstEpisode = Episode::with('movie')->where('movie_id',$id)->orderBy('episode','DESC')->get();
        return view('admin.episode.add_episode',[
            'title' => 'Thêm tập phim',
            'lstEpisode' => $lstEpisode,
            'movie' => $movie,
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
        $episode = Episode::find($id);
        $movie = Movie::pluck('title','id');
        $linkservename = LinkMovie::orderBy('id','desc')->pluck('title', 'id');
        $lstLinkMovi = LinkMovie::orderBy('id','desc')->pluck('title', 'id');
        $lstEpisode = Episode::get();
        $linkserve = LinkMovie::orderBy('id','desc')->get();
        return view('admin.episode.form',compact('movie','lstEpisode','episode'),[
            'title' => 'Chỉnh sửa tập phim',
            'lstLinkMovi' => $lstLinkMovi,
            'linkserve' => $linkserve,
            'linkservename' => $linkservename,

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
            $episode = Episode::find($id);
            $episode -> linkfilm = $data['linkfilm'];
            $episode -> episode = $data['episode'];
            $episode -> movie_id = $data['movie_id'];
            $episode -> server = $data['server'];
            // $episode -> created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode -> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
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
                'modify_user' => $name.' cập nhật tập phim '.$episode -> episode.''
            ];
            DB::table('userlog_activities')->insert($activity);
            Session::flash('success','Cập nhật tập phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        
        return redirect()->route('episode.create');
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
            $episode = Episode::find($id);
            
            //userlog_activities
            $user = Auth::user();
            Session()->put('user', $user);
            $user = Session()->get('user');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            // $todayDate = $dt->toDayDateTimeString();
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
                'modify_user' => $name.' đã xóa tập phim '.$episode->episode.''.' có ID phim  '.$episode->movie_id.''
            ];
            DB::table('userlog_activities')->insert($activity);
            $episode->delete();
        }
        catch(\PDOException $err)
        {

        }
        return redirect()->back();
    }
    public function select_movie()
    {
        $id = $_GET['id'];
        $id_movie = Movie::find($id);
        // echo $id_movie->episode;
        $output = '<option value="">Chọn tập phim</option>';
        if($id_movie->belonging_movie == 1){
            for($i = 1; $i <= $id_movie->episode_film; $i++)
            {
                $output .= '<option value="'.$i.'">'.$i.'</option>';
            }
        }else{
            $output .= '<option value="HD">HD</option>
                        <option value="FullHD">FullHD</option>
                        <option value="Cam">Cam</option>
                        <option value="HDCam">HDCam</option>';
        }
        
        echo $output;
    }
    public function search_episode(Request $request)
    {
        $lstEpisode = Episode::with('movie')->orderBy('movie_id','desc')->paginate(5);
        $movie = Movie::orderBy('id','desc')->pluck('title', 'id');
        if($request->title)
        {
            $result  = Movie::with('episode')->select()->from('movies','episodes')->where('title','LIKE','%'.$request->title.'%')->get();
            // dd($result);
        }
        if($request->episode)
        {
            $result  = Episode::where('episode','LIKE','%'.$request->episode.'%')->get();
            // dd($result);
        }
        // $query = Episode::with('movie')->select()->where('title','LIKE','%'.$request->title.'%')->get();
        // return response()->json($lstEpisode);
        return view('admin.episode.result_search_episode',compact('result'),[
            'title' => 'Kết quả tập phim tìm được',
            'movie' => $movie,
        ]);
    }
}
