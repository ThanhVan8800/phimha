<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\User;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\VNPay;

use Carbon\Carbon;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstCountUser = User::count();
        $lstCountMovie = Movie::count();
        $lstCountCate = Category::count();
        $lstCountGenres = Genre::count();
        $Episode_View = Episode::with('movie')->orderBy('views','desc')->take(15)->get();
        $Count_rating = Rating::with('episode')->orderBy('rating_star','desc')->take(15)->get();
        return view('admin.dashboard',[
            'title' => 'Dashboard'
        ], compact('lstCountUser','lstCountMovie','lstCountCate','lstCountGenres','Episode_View','Count_rating'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $query = VNPay::whereBetween('PayDate',[$from_date,$to_date])->orderBy('PayDate','ASC')->get();
        foreach($query as $key => $value){
            $chart_data[] = array(
                'PayDate' => Carbon::createFromFormat('Y-m-d H:i:s', $value->PayDate)->format('Y-m-d'),
                'Amount' => $value->Amount,
                // 'CardType' => $value->CardType,
                'TransactionNo' => $value->TransactionNo,
                // 'OrderInfor' => $value->OrderInfor,
                'user_id' => $value->user_id,
            );
        }
        echo $data = json_encode($chart_data);
        // dd($data);
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $subtuthang6 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
        // dd($dauthangnay);
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value'] == '7ngay'){
            $get = VNPay::whereBetween('PayDate',[$sub7days,$now])->orderBy('PayDate','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = VNPay::whereBetween('PayDate',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('PayDate','ASC')->get();
        }elseif($data['dashboard_value'] == 'thang6'){
            $get = VNPay::where('PayDate',$subtuthang6)->orderBy('PayDate','ASC')->get();
        }else{
            $get = VNPay::whereBetween('PayDate',[$sub365days,$now])->orderBy('PayDate','ASC')->get();
        }
        foreach($get as $val){
            $chart_data[] = array(
                'PayDate' => $val->PayDate,
                'Amount' => $val->Amount,
                // 'CardType' => $value->CardType,
                'TransactionNo' => $val->TransactionNo,
                // 'OrderInfor' => $value->OrderInfor,
                'user_id' => $val->user_id,
            );
        }
        echo $data = json_encode($chart_data);
        // dd($data);

    }
    public function chart30days(Request $request)
    {
        $chart60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $query = VNPay::whereBetween('PayDate',[$chart60days,$now])->orderBy('PayDate','ASC')->get();
        foreach($query as $days)
        {
            $chart_data[] = array(
                'PayDate' => $days->PayDate,
                'Amount' => $days->Amount,
                // 'CardType' => $value->CardType,
                // 'TransactionNo' => $val->TransactionNo,
                // 'OrderInfor' => $value->OrderInfor,
                'user_id' => $days->user_id,
            );
        }
        echo $data = json_encode($chart_data);
    }
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
        //
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
        //
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
        //
    }
}
