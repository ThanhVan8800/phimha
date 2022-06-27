<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VNPay;
use Illuminate\Support\Facades\Session;
use DB;
class FilmPackageController extends Controller
{
    public function film_package(Request $request)
    {
        $users = DB::table('v_n_pays')
                ->join('users', 'v_n_pays.user_id', '=', 'users.id')
                // ->join('orders', 'users.id', '=', 'orders.user_id')
                ->select('v_n_pays.*', 'v_n_pays.Amount')
                ->select( DB::raw('Amount'))
                ->groupBy('Amount')
                ->get();
        // dd($users);
        $lstUserVip = User::with('vnpay')->orderBy('id', 'DESC')->get();
        return view('admin.package_film.list',[
            'title' => 'Danh sách tài khoản đã mua gói phim',
            'lstUserVip' => $lstUserVip,
            'users' => $users,
        ]);
    }
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $lstUserVip = User::all();
        return view('admin.package_film.list',compact('user','lstUserVip'),[
            'title'=>'Chỉnh sửa gói hạn phim',
        ]);
    }
    public function update(Request $request, $id)
    {
        try{
            $data = $request->all();
            $userId = User::find($id);
            $userId->PayDate = $request->input('PayDate');
            $userId->EndDate = $request->input('EndDate');
            // dd($userId);
            $userId -> save();
            Session::flash('success','Cập nhật danh mục phim thành công');
        }catch(Exception $e)
        {
            Session::flash('error',$err->getMessage());
            return false;
        }
        return redirect()->back();
    }
}
