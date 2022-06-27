<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UserFormRequest;
use Illuminate\Support\Facades\Session;
class RegisterUserController extends Controller
{
    public function index()
    {
        return view('user_viewer.register',[
            'title'=> 'Đăng ký'
        ]);
    }

    public function store(UserFormRequest $request)
    {
        try{
            $data = $request->all();
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->phone_number = $data['phone_number'];
            $user->save();
            Session::flash('success','Thêm danh mục phim thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        // $request->validate([
        //         'name' => 'required|string',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|min:6|confirmed',
        //     ]);
        
        // $data = User::create([
        //     'name' => $request->input('name'),
        //     'email'=> $request->input('email'),
        //     'status'=> $request->input('status'),
        //     'password'=> Hash::make($request->input('password'),),
        // ]);
        // dd($data);
        return redirect('/login-user');
    }
    public function planform()
    {
        return view('user_viewer.vip_pay',[
            'title' => 'Phim Vip',
        ]);
    }
    
}
