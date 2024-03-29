<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\VNPay;
use DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Mail\ThankMail;
use Illuminate\Support\Facades\Mail;
class UserViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember_token'))) {
            $request->session()->regenerate();

            return redirect('/');// để đến trang khi login vào
        }

        return back()->withErrors([
            'email' => 'Email nhập không chính xác vui lòng đăng nhập lại!',
            'password' => 'Mật khẩu bạn nhập không chính xác vui lòng đăng nhập lại!'
        ]);
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('homepage');
    }

    public function create(Request $request)
    {
        
    }
    public function show()
    {
        $created = Carbon::now('Asia/Ho_Chi_Minh');
        if(isset($_GET['vnp_Amount'])){
            $vnp_Amount = $_GET['vnp_Amount']/100;
            $vnp_BankCode = $_GET['vnp_BankCode'];
            $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
            $vnp_CardType = $_GET['vnp_CardType'];
            $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
            $vnp_PayDate = $_GET['vnp_PayDate'];
            $vnp_TmnCode = $_GET['vnp_TmnCode'];
            $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
            // dd($vnp_Amount);
            $user = User::find(1);
            $email = Auth::user()->email;
            $mailable = new ThankMail($user);
            Mail::to($email)
            ->queue($mailable);

            $query = DB::table('v_n_pays')->insert(
                array(
                    'Amount'     =>   $vnp_Amount, 
                    'BankCode' => $vnp_BankCode,
                    'BankTranNo' => $vnp_BankTranNo,
                    'CardType' => $vnp_CardType,
                    'OrderInfo' => $vnp_OrderInfo,
                    'PayDate' => $vnp_PayDate,
                    'TmnCode' => $vnp_TmnCode,
                    'TransactionNo' => $vnp_TransactionNo,
                    'user_id' => Auth::user()->id,
                )
            );
            
        }
            
        return view('user_viewer.thank_you',[
            'title' => 'Cảm ơn',
        ]);
    }
    public function profile()
    {
        $user = User::all();
        return view('user_viewer.information',[
            'title' => 'Thông tin khách hàng',
            'user' => $user,
        ]);
    }
    public function index()
    {
        return view('user_viewer.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
