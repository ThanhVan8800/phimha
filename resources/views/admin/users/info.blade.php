@extends('layouts.main')



@section('content')
<form action="{{route('user.edit',['user'=>$user])}}" >
    <div class="card-body">
                <div class="row">
                    <div class="col-md-4 margin-top-img ">
                        <div class="boxed">
                            @if(Auth::user()->thumb)
                                <img src="{{$user->thumb}}" alt="" class=" avatar-user" >
                            @else
                                <img src="http://127.0.0.1:8000/storage/user_none.jpg" alt="" class=" avatar-user">
                            @endif
                        </div>
                        <div class="loader">
                            <div class="loader1"></div>
                        </div>
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
                            <label for="name">Trạng thái</label>
                            <input type="text" name="status" class="form-control" value="@if($user->status == 1) Hoạt động @else Ngưng hoạt động @endif" disabled>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">Vai trò</label>
                            <input type="name" name="name" id="name" class="form-control" value="{{$user->role}}" disabled>
                        </div>
                    </div>
                    
                </div>
                <div class="form-groupp" >
                    <button class="btn btn-outline-info">
                        Thay đổi thông tin
                    </button>
                    <a href="/admin/users/changePassword/{{Auth::user()->id}}" class="btn__neon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Đổi mật khẩu
                    </a>
                </div>
                
                <!-- /.card-body -->
    </div>
</form>
@endsection