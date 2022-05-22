@extends('layouts.main')



@section('content')
<form action="{{route('user.edit',['user'=>$user])}}" >
    <div class="card-body">
                <div class="row">
                    <div class="col-md-4 margin-top-img ">
                        @if(Auth::user()->thumb)
                            <img src="{{$user->thumb}}" alt="" class="avatar-user" >
                        @else
                            <img src="http://127.0.0.1:8000/storage/user_none.jpg" alt="" class="avatar-user">
                        @endif
                        <!-- <div class="avatar-input">
                            <i class="fa fa-solid fa-camera">
                                <input type="file" class="avatar-input">
                            </i>
                        </div> -->
                        <div class="d-flex justify-content-center user-name" >
                            <p>{{$user->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group col-md-8 margin-top">
                            <label for="name">Tên người dùng</label>
                            <input type="name" name="name" id="name" class="form-control " value="{{$user->name}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Số điện thoại</label>
                            <input type="name" name="name" id="name" class="form-control" value="{{$user->phone_number}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Email</label>
                            <input type="name" name="name" id="name" class="form-control" value="{{$user->email}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group col-md-8 margin-top">
                            <label for="name">Địa chỉ</label>
                            <input type="name" name="address" id="name" class="form-control" value="{{$user->address}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Mật khẩu</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$user->password}}" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Vai trò</label>
                            <input type="name" name="name" id="name" class="form-control" value="{{$user->role}}" disabled>
                        </div>
                    </div>
                    
                </div>
                <button>Chỉnh sửa</button>
                <a href="/admin/users/changePassword/{{Auth::user()->id}}">Đổi mật khẩu</a>
                <!-- /.card-body -->
    </div>
</form>



@endsection