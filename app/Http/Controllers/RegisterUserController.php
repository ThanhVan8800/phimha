<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UserFormRequest;
class RegisterUserController extends Controller
{
    public function index()
    {
        return view('user_viewer.register',[
            'title'=> 'Đăng ký'
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //         'name' => 'required|string',
        //         'email' => 'required|email|unique:users,email',
        //         'password' => 'required|min:6|confirmed',
        //     ]);
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        // $data = User::create([
        //     'name' => $request->input('name'),
        //     'email'=> $request->input('email'),
        //     'status'=> $request->input('status'),
        //     'password'=> Hash::make($request->input('password'),),
        // ]);
        // dd($data);
        return redirect('/login-user');
    }
    
}
