<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class SortMovieController extends Controller
{
    public function sortfilm()
    {
        $lstCate = Category::orderBy('id','ASC')->get();
        $category_home = Category::with(['movie' => function($q){
            $q->withCount('episode')->where('status',1);
        }])->orderBy('position','ASC')->where('status',1)->get();
        return view('admin.movie.sortfilm',[
            'title' => 'Sắp xếp phim',
            'lstCate' => $lstCate,
            'category_home' => $category_home
        ]);
    }
    public function resorting_cate(Request $request)
    {
        $data = $request->all();//[1,2,3,3]
        $cate = Category::all();
        foreach($data['array_id'] as $key => $value){
            //[0=>1]
            //[1=>2]
            //[2=>3]
            //[3=>3]
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
    public function resorting_movie(Request $request){
        $data = $request->all();//[1,2,3,3]
        // dd($data);  
        foreach($data['array_id'] as $key => $stt){
            //[0=>1]
            //[1=>2]
            //[2=>3]
            //[3=>3]
            $category = Movie::find($stt);
            $category->position = $key;
            $category->save();
        }
    }
}
