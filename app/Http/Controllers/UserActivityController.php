<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userlog_Activity;

class UserActivityController extends Controller
{
    public function index()
    {
        $lstUserlog_Ac = Userlog_Activity::orderBy('id','desc')->paginate(10);

        return view('admin.userlog.index',[
            'title' => 'Nhật ký hoạt động',
            'lstUserlog_Ac' => $lstUserlog_Ac
        ]);
    }
    public function searchUserlog(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $query = Userlog_Activity   :: where('date_time', '>=', $fromDate)
                                    -> where('date_time', '<=', $toDate)
                                    -> orderBy('id','desc')
                                    -> get();
        // dd($query);
        return view('admin.userlog.result_search',[
            'title' => 'Kết quả tìm kiếm',
            'query' => $query
        ]);
    }
}
