<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\Country;
use PDF;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Country\CountryFormRequest;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resorting(Request  $request)
    {
        $data = $request->all();//[1,2,3,3]
        foreach($data['array_id'] as $key => $stt){
            //[0=>1]
            //[1=>2]
            //[2=>3]
            //[3=>3]
            $category = Country::find($stt);
            $category->position = $key;
            $category->save();
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
        $lstCountry = Country::paginate(8);
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
    public function store(CountryFormRequest $request)
    {
        try{
            $data = $request -> all();
            $country = new Country();
            $country -> title = $data['title'];
            $country -> slug = $data['slug'];
            $country -> description = $data['description'];
            $country -> status = $data['status'];
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
                'modify_user' => $name.' tạo tên quốc gia '.$country -> title.' cho phim'
            ];
            DB::table('userlog_activities')->insert($activity);
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
        $lstCountry = Country::paginate(8);
        return view('admin.country.form', compact('id', 'lstCountry', 'country'),[
            'title'=>'Chỉnh sửa phim theo quốc gia',

        ]);
    }
    public function downloadPDF(){
        $lstCountry = Country::all();
        $pdf = PDF::loadView('admin.country.list', compact('lstCountry'),['title'=>'Chỉnh sửa phim theo quốc gia']);
        return $pdf->download('Danh_Sách_Quốc_Gia.pdf');
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
                'modify_user' => $name.' cập nhật phim thuộc quốc gia '.$country -> title.''
            ];
            DB::table('userlog_activities')->insert($activity);

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
        try{
            $country = Country::find($id);
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
                        'modify_user' => $name.' đã xóa phim thuộc quốc gia '.$country -> title.''
                    ];
                    DB::table('userlog_activities')->insert($activity);
                Country::find($id)->delete();
                Session()->flash('success','Bạn đã xóa  phim thuộc quốc gia thành công!');
                return redirect()->back();
        }catch(Exception $err)
        {
            Session()->flash('error','Không thể xóa được phim thuộc quốc gia!');
            Log::info("message");
            return false;
        }
        return redirect()->back();
    }
    
}
