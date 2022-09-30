<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Genre\GenreFormRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstGenre = Genre::all();
        return view('admin.genre.form',['title'=>'Thể loại phim','lstGenre' => $lstGenre]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreFormRequest $request)
    {
        try{
            $data =  $request->all();
            $genre = new Genre();
            $genre -> title = $data['title'];
            $genre -> slug = $data['slug'];
            $genre -> description = $data['description'];
            $genre -> status = $data['status'];
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
                'modify_user' => $name.' tạo thể loại phim '.$genre -> title.' '
            ];
            DB::table('userlog_activities')->insert($activity);
            $genre -> save();
            Session::flash('success','Thể loại phim được tạo thành công');
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
        $genre = Genre::find($id);
        $lstGenre = Genre::all();
        return view('admin.genre.form',compact('lstGenre', 'genre'),[
            'title'=>'Chỉnh sửa thể loại phim'
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
            $data =  $request->all();
            $genre =  Genre :: find($id);
            $genre -> title = $data['title'];
            $genre -> slug = $data['slug'];
            $genre -> description = $data['description'];
            $genre -> status = $data['status'];
            $genre -> save();
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
                'modify_user' => $name.' cập nhật thể loại phim '.$genre -> title.''
            ];
            DB::table('userlog_activities')->insert($activity);
            Session::flash('success','Cập nhật thể loại phim thành công');
        }catch(Exception $err) {
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
                $genre =  Genre::find($id);
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
                    'modify_user' => $name.' đã xóa danh mục phim '.$genre->title.''
                ];
                DB::table('userlog_activities')->insert($activity);
                Genre::find($id)->delete();
                Session()->flash('success','Bạn đã xóa thể loại phim thành công!');
            return redirect()->route('genre.create');
        }catch(\Exception $err){
            Session()->flash('error','Không thể xóa được thể loại phim. Vui lòng kiểm tra lại!');
            Log::info("message");
            return false;
        }
        
    }
}
