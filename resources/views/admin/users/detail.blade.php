@extends('layouts.main')

@section('content')
<form action="" method="POST" >
    @csrf
    
    <div class="card card-primary mt-3">
        <div class="card-body img">
                        <div class="col-md-3">
                                <div class="form-group">
                                                <label style="color:#FF7506;">Thông tin tài khoản</label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Họ tên: <span style="color:#FF4747;">*</span> </label>
                                <input type="text" name="name" value="{{$user->name}}" readonly class="form-control" id="" placeholder="Nhập mã thiết bị">
                            </div>
                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address: <span style="color:#FF4747;">*</span></label>
                                                <input type="text" name="address" value="{{$user->address}}" readonly class="form-control" id="exampleInputEmail1" placeholder="Nhập tài khoản">
                                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Số điện thoại: <span style="color:#FF4747;">*</span> </label>
                                <input type="number" name="phone_number" value="{{$user -> phone_number}}" readonly class="form-control" id="exampleInputEmail1" placeholder="Nhập tên thiết bị">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mật khẩu: <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="password" value="{{$user -> password}}" readonly class="form-control" id="" placeholder="Nhập tài khoản">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Email: <span style="color:#FF4747;">*</span> </label>
                                <input type="email" name="email" value="{{ $user->email }}" readonly class="form-control" id="exampleInputEmail1" placeholder="Nhập địa chỉ IP">
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Vai trò: <span style="color:#FF4747;">*</span> </label>
                                <select class="form-control select2" name="role"  style="width: 100%;">
                                    <option value="{{$user->role}}">{{$user->role}}</option>
                                    <option value="manage" {{$user->role == 'manage' ? 'selected' :''}} >manage</option>
                                    <option value="admin" {{$user->role == 'admin' ? 'selected' :''}} >admin</option>
                                    <!-- <option value="superadmin" {{$user->role == 'superadmin' ? 'selected' :''}} >superadmin</option> -->
                                </select>
                            </div>
                            <div class="col-md-6">
                            <label>Tình trạng: <span style="color:#FF4747;">*</span></label>
                                    <select class="form-control select2" name="status" value="{{$user->status}}" style="width: 100%;">
                                        <option selected="selected" value="{{$user->status}}" >
                                            @if ($user->status == 1)
                                                Hoạt động
                                            @else 
                                                Ngưng hoạt động    
                                            @endif    
                                        </option>
                                        <option value="1" {{$user->status == '1' ? 'selected' :''}}>Hoạt động</option>
                                        <option value="0"{{$user->status == '0' ? 'selected' :''}}>Ngưng hoạt động</option>
                            </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="menu">Ảnh đại diện</label>
                                    @if ($user->thumb)
                                            <a href="{{$user->thumb}}">
                                                <img src="{{$user->thumb}}" class="avatar-user" width="100px" alt="">
                                            </a>
                                    @else  
                                            <a href="http://127.0.0.1:8000/storage/user_none.jpg">
                                                <img src="http://127.0.0.1:8000/storage/user_none.jpg" alt="" class="avatar-user">
                                            </a>
                                    @endif
                                            
                                </div>
                                
                                <div class="form-group">
                                    
                                </div>
                                
                            </div>
                        
                        </div>
                        <div class="form-group">
                            <label for="" style="color: #7E7D88;margin-top:50px;"><span style="color:#FF4747;">*</span> Là trường thông tin bắt buộc</label>
                        </div>
                        <div class="row">
                            <!-- <label for="" class="btn-cancel">Hủy bỏ</label> -->
                            <a href="{{route('user.index')}}" ><label for="" class="btn-cancel">Hủy bỏ</label></a>
                            <input type="submit" class="btn-create" value="Cập nhật">
                        </div>
        </div>
    </div>
    
</form>
@endsection