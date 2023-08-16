<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
        $get_img = $request->image;
        $movie_id = $request->movie_id;
        $movie = Movie::find($movie_id);

        if($get_img){
            foreach($get_img as $key => $img){
                $path = 'uploads/gallery/';
                $get_name = $img->getClientOriginalName(); //laasy ten hinhww/jpg
                $name_img = current(explode('.',$get_name)); //laasy ten hinhww
                $new_name_img = $name_img.rand(1,999).'.'.$img->getClientOriginalExtension();
                $img->move($path, $new_name_img);
                
                $gallery = new Gallery();
                $gallery->title = $movie->title;
                $gallery->movie_id = $movie->id;
                $gallery->image = $new_name_img;
                $gallery->save();
            }
        }
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
        $gallery = Gallery::where('movie_id',$id)->orderBy('id','desc')->get();
        return view('admin.gallery.index',[
            'title' =>'Gallery Edit',
            'movie_id' => $id,
            'gallery' => $gallery
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
        $gallery = Gallery::find($id);
        $path = 'uploads/gallery/'.$gallery->image;
        if(file_exists($path)){
            unlink($path);
        }
        $gallery->delete();
    }
}
