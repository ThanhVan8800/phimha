<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
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
        $lstCate = Category::orderBy('position','ASC')->get();
        // asc tăng dần 
        return view('admin.category.form',['lstCate' => $lstCate]);
        // có thể dùng compact tương tự
        // return view('admin.category.form',compact('lstCate'));
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
        $category = new Category();
        $category -> title = $data['title'];
        $category -> slug = $data['slug'];
        $category -> description = $data['description'];
        $category -> status = $data['status'];
        $category -> save();
        return redirect()-> back();
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
        $category = Category::find($id);
        $lstCate = Category::all();
        return view('admin.category.form',compact( 'id','lstCate','category'));
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
        $category =  Category::find($id);
        $category -> title = $data['title'];
        $category -> slug = $data['slug'];
        $category -> description = $data['description'];
        $category -> status = $data['status'];
        $category -> save();
        return Redirect::route('category.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    public function resorting(Request  $request)
    {
        $data = $request->all();//[1,2,3,3]
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
}
