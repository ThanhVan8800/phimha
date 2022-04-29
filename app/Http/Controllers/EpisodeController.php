<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Movie;
use Carbon\Carbon;
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
        $lstEpisode = Episode::with('movie')->orderBy('movie_id','desc')->get();
        $movie = Movie::orderBy('id','desc')->pluck('title', 'id');
        // return response()->json($lstEpisode);
        return view('admin.episode.form',[
            'lstEpisode' => $lstEpisode,
            'movie' => $movie
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
        $episode = new Episode();
        $episode -> linkfilm = $data['linkfilm'];
        $episode -> episode = $data['episode'];
        $episode -> movie_id = $data['movie_id'];
        $episode -> created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode -> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
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
        $episode = Episode::find($id);
        $movie = Movie::pluck('title','id');
        $lstEpisode = Episode::all();
        return view('admin.episode.form',compact('movie','lstEpisode','episode'));
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
        $episode = Episode::find($id);
        $episode -> linkfilm = $data['linkfilm'];
        $episode -> episode = $data['episode'];
        $episode -> movie_id = $data['movie_id'];
        $episode -> created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode -> updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
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
        $episode = Episode::find($id);
        $episode->delete();
        return redirect()->back();
    }
    public function select_movie()
    {
        $id = $_GET['id'];
        $id_movie = Movie::find($id);
        // echo $id_movie->episode;
        $output = '<option value="">Chọn tập phim</option>';
        for($i = 1; $i <= $id_movie->episode_film; $i++)
        {
            $output .= '<option value="'.$i.'">'.$i.'</option>';
        }
        echo $output;
    }
}
