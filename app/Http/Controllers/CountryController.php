<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\Country;
class CountryController extends Controller
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
        $lstCountry = Country::all();
        return view('admin.country.form',compact('lstCountry'),[
            'title'=>'Quốc gia',
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
        try{
            $data = $request -> all();
            $country = new Country();
            $country -> title = $data['title'];
            $country -> slug = $data['slug'];
            $country -> description = $data['description'];
            $country -> status = $data['status'];
            $country -> save();
            Session::flash('success','Tạo phim theo quốc gia thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
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
        $country = Country::find($id);
        $lstCountry = Country::all();
        return view('admin.country.form', compact('id', 'lstCountry', 'country'),[
            'title'=>'Chỉnh sửa phim theo quốc gia',

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
            $data = $request -> all();
            $country = Country::find($id);
            $country -> title = $data['title'];
            $country -> slug = $data['slug'];
            $country -> description = $data['description'];
            $country -> status = $data['status'];
            $country -> save();
            Session::flash('success','Cập nhật phim theo quốc gia thành công');
        }catch(Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        
        return Redirect::route('country.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}
