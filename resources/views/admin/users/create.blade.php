@extends('layouts.main')

@section('content')
<form action="{{route('user.store')}}" method="post">
        
    <div class="card card-primary mt-3">
        <div class="card-body img">
                        <div class="col-md-3">
                                <div class="form-group">
                                                <label style="color:#FF7506;">Thêm mới tài khoản</label>
                                </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Tên tài khoản: <span style="color:#FF4747;">*</span> </label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên tài khoản...">
                            </div>
                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role: <span style="color:#FF4747;">*</span></label>
                                                            <select class="form-control select2" name="role" style="width: 100%;">
                                                                <option selected="selected" >---Phân quyền cho tài khoản---</option>
                                                                <option value="manage" {{$user->role == 'manage' ? 'selected' :''}} >manage</option>
                                                                <option value="admin" {{$user->role == 'admin' ? 'selected' :''}} >admin</option>
                                                                <option value="superadmin" {{$user->role == 'superadmin' ? 'selected' :''}} >superadmin</option>
                                                                
                                                            </select>
                                            </div>
                                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Email: <span style="color:#FF4747;">*</span> </label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email...">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password: <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nhập mật khẩu...">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Chọn ảnh đại diện: <span style="color:#FF4747;">*</span> </label>
                                <input type="file"  class="form-control" id="upload">
                                    <div id="image_show">
                                        <a href="{{$user->thumb}}">
                                            <img src="{{$user->thumb}}" width="100px" alt="">
                                        </a>
                                    </div>
                                <input type="hidden" name="thumb" id="thumb" value="">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password: <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nhập mật khẩu">   
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Phone number: <span style="color:#FF4747;">*</span> </label>
                                <input type="number" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="Nhập dịch vụ sử dụng">
                            </div>
                            <div class="form-group">
                                <label>Kích Hoạt: <span style="color:#FF4747;">*</span></label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="1" type="radio" id="active" name="status"
                                        checked="">
                                        <label for="active" class="custom-control-label">Có</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"
                                        checked="" >
                                        <label for="no_active" class="custom-control-label">Không</label>
                                    </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Address: <span style="color:#FF4747;">*</span> </label>
                                <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Nhập dịch vụ sử dụng">
                            </div>
                        </div>
                        <label for="" style="color: #ccc;"><span style="color:#FF4747;">*</span> Là trường thông tin bắt buộc</label>
                        <div class="row">
                            <!-- <label for="" class="btn-cancel">Hủy bỏ</label> -->
                            <a href="" ><label for="" class="btn-cancel"><i class="fa-solid fa-arrow-rotate-left"></i>Hủy bỏ</label></a>
                            <button class="btn-create"><i class="fa-solid fa-square-plus"> </i>Thêm</button>
                            @csrf
                        </div>
        </div>
        
    </div>
    
</form>                
@endsection

@section('footer')
<!-- Xóa tài khoàn user quản lý   -->
    <script>
        function removeRow(id, url) {
            if (confirm('Xóa và không thể khôi phục. Bạn có chắc ?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { id },
                    url: url,
                    success: function(result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Xóa lỗi vui lòng thử lại');
                        }
                    }
                })
            }
        }
    </script>
@endsection
