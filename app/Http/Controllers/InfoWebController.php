<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoWebsite;

class InfoWebController extends Controller
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
        $lstInfo = InfoWebsite::all();
        return view('admin.info_web.create',[
            'title' => 'Thông tin web',
            'lstInfo' => $lstInfo
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
        $this->validate($request,[
            'title' => 'required|unique:categories,title',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048|dimensions:min_width:50, min_height:50,max_width:2000,max_height:2000'
        ]);
        $info = new InfoWebsite();
        $info->title = $data['title'];
        $info->description = $data['description'];
        $get_image = $request->file('image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName(); // hinhDaLat.jpg
            $name_image = current(explode('.', $get_name_image));//tách ra
            $new_image = $name_image.rand(0,9999).'.' . $get_image->getClientOriginalExtension(); //gộp đuôi lại
            $get_image->move('uploads/info/',$new_image);
            $info->image = $new_image;
        }
        toastr()->success('Data has been saved successfully!');
        $info->save();
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
        $lstInfo = InfoWebsite::all();

        $info = InfoWebsite::find($id);

        return view('admin.info_web.create',[
            'title' => "Chỉnh sửa thông tin web",
            'lstInfo' => $lstInfo,
            'info' => $info
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
        $info = InfoWebsite::find($id);
        $info->title = $data['title'];
        $info->description = $data['description'];
        $get_image = $request->file('image');

        if($get_image){
            if(file_exists('uploads/info/'.$info->image)){
                unlink('uploads/info/'.$info->image);
                $get_name_image = $get_image->getClientOriginalName(); // hinhDaLat.jpg
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/info/',$new_image);
                $info->image = $new_image;
            }
        }
        toastr()->success('Successfully uploaded successfullyLoaded');
        $info->save();
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
        $info = InfoWebsite::find($id);
        $info->delete();
        toastr()->error('Successfully deleted successfullyLoaded');
        return redirect()->back();
    }
}
