<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $lstUser = User::paginate(8);
        return view('admin.users.index',[
            'title' => 'Quản lí tài khoản',
            'lstUser' => $lstUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('admin.users.create',[
            'title' => 'Quản lí tài khoản',
            'user' => $user
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
            $this->Validate($request,[
                'password' => 'required|min:6|confirmed'
            ],[
                'password.required' => 'Vui lòng nhập mật khẩu!',
                'password_confirmation.required' => 'Mật khẩu không khớp!'
            ]);
            $data = $request->all();
            $user = new User();
            $user -> name = $data['name'];
            $user -> email = $data['email'];
            $user -> password = Hash::make($data['password']);
            $user -> phone_number = $data['phone_number'];
            $user -> role = $data['role'];
            $user -> address = $data['address'];
            $user -> status = $data['status'];
            $user -> thumb = $data['thumb'];
            // dd($user);
            $user -> save();
            Session()->flash('success','Tạo thành công');
            return redirect()->back();
        }catch(Exception $err)
        {
            Session()->flash('error','Lỗi tạo tài khoản,Vui lòng kiểm tra lại!');
            Log::info("message");
            return false;
        }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.detail',[
            'title' => 'Phân quyền',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'title' => 'Chỉnh sửa thông tin cá nhân',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try{
            
            $data = $request->all();
            $user -> name = $data['name'];
            $user -> email = $data['email'];
            $user -> phone_number = $data['phone_number'];
            $user -> role = $data['role'];
            $user -> address = $data['address'];
            $user -> status = $data['status'];
            $user -> thumb = $data['thumb'];
            $user -> save();

            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $todayDate = $dt->toDayDateTimeString();
            // dd($todayDate);
            $activity = [
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'date_time' => $todayDate,
                'modify_user' => 'Update'
            ];
            // dd($activity);
            DB::table('userlog_activities')->insert($activity);
            
            Session() ->flash('success','Cập nhật hồ sơ thành công');
            return redirect()->back();
        }catch(Exception $error){
            Session() ->flash('error', 'Cập nhật bị lỗi!!');
            Log::info($error->getMessage());
            return false;
        }
        return redirect()->back();
    }
    //Phân quyền no user
    public function role(Request $request, User $user)
    {
        try{
            
            $data = $request->all();
            
            $user -> role = $data['role'];
            
            $user -> status = $data['status'];
            $user -> save();
            $user = Auth::user();
            Session()->put('user', $user);
            $user = Session()->get('user');
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            // $todayDate = $dt->toDayDateTimeString();

            $name = $user->name;
            // dd($todayDate);
            $activity = [
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'date_time' => $dt,
                'modify_user' => $name.' vừa mới cập nhật tài khoản',
            ];
            // dd($activity);
            DB::table('userlog_activities')->insert($activity);
            Session() ->flash('success','Cập nhật hồ sơ thành công');
            return redirect()->back();
        }catch(Exception $error){
            Session() ->flash('error', 'Cập nhật bị lỗi!!');
            Log::info($error->getMessage());
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
    public function destroy(Request $request)
    {
        
        $result = $this->user->delete($request);
        if($result)
            {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa thành công'
                ]);
            }
            return response()->json(['error' => true]);
    }
    public function info()
    {
        $user = User::find(Auth::user()->id);

        return view('admin.users.info',[
            'title' => 'Trang cá nhân',
            'user' => $user
        ]);
    }
    public function changePassword(User $user)
    {
        $user = User::find(Auth::user()->id);

        return view('admin.users.change',[
            'title' => 'Trang cá nhân',
            'user' => $user
        ]);
    }
    public function pass(Request $request, User $user) 
    {
        $this->Validate($request,[
            'password' => 'required',
            'new_password' => 'required|string|min:6|max:255|different:password',
            'confirm_password' => 'required|same:new_password',
        ],[
            'password.required' => 'Mật khẩu bạn nhập không trùng khớp. Vui lòng nhập lại!',
            'confirm_password.required' => 'Nhập khẩu mới bạn nhập không đúng. Vui lòng nhập lại!'
        ]);
        $user = request()->user();
            if(!Hash::check($request->password, $user->password)){
                // return response()->json([
                //     'status_code' => 422,
                //     'message' => ' Mật khẩu không tồn tại'
                // ]);
                Session()->flash('error','Mật khẩu không trùng khớp!');
                return redirect()->back();
            }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect('admin/users/info');
    }
}
