<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userlog_Activity;

class UserActivityController extends Controller
{
    public function index()
    {
        $lstUserlog_Ac = Userlog_Activity::orderBy('id','desc')->paginate(20);

        return view('admin.userlog.index',[
            'title' => 'Nhật ký hoạt động',
            'lstUserlog_Ac' => $lstUserlog_Ac
        ]);
    }
    public function searchUserlog(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        
        if(!empty($fromDate) && !empty($toDate)){
            $query = Userlog_Activity   :: where('date_time', '>=', $fromDate)
            -> where('date_time', '<=', $toDate)
            -> orderBy('id','desc')
            -> paginate(15);
        } 
        // if(isset($query))
        if(!empty($request->name)){
            $query = Userlog_Activity::where('name', $request->name)->paginate(15);
        }else{
            $query = Userlog_Activity::paginate(15);
        }
        // dd($query);
        return view('admin.userlog.result_search',[
            'title' => 'Kết quả tìm kiếm',
            'query' => $query
        ]);
    }
}
