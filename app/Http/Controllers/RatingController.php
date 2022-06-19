<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Auth;
class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rating(Request $request)
    {
        $model = Rating::with('user')->where($request->only('episode_id','user_id'))->first();
        if($model){
            Rating::with('user')->where($request->only('episode_id','user_id'))
            ->update($request->only('rating_star'));
        }else{
            Rating::with('user')->create($request->only('episode_id', 'user_id','rating_star'));
        }
        return redirect()->back();
    }
    public function insert_rating(Request $request){
            $data = $request->all();
            $status=Rating::where('user_id',Auth::user()->id)
                ->where('episode_id',$request->episode_id)
                ->first();

            if(isset($status->user_id) and isset($request->episode_id))
            {

            }
            else
            {
                    //Return to successfully added page
                    $rating = new Rating();
                    $rating->episode_id = $data['episode_id'];
                    $rating->rating_star = $data['index'];
                    $rating->user_id = $data['user_id'];
                    // dd($rating->user_id);
                    $rating->save();
                        echo 'done';
            }
            
            
    }
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
