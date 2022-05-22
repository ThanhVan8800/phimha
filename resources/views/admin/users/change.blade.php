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
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu : <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="password" value="" class="form-control"  >    
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nhập mật khẩu mới: <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="new_password" value="" class="form-control">  
                                    @error('new_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror  
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu mới: <span style="color:#FF4747;">*</span></label>
                                    <input type="password" name="confirm_password" value="" class="form-control">   
                                    @error('confirm_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                
                                
                                
                            </div>
                        
                        </div>
                        <div class="form-group">
                            <label for="" style="color: #7E7D88;margin-top:50px;"><span style="color:#FF4747;">*</span> Là trường thông tin bắt buộc</label>
                        </div>
                        <div class="row">
                            <!-- <label for="" class="btn-cancel">Hủy bỏ</label> -->
                            <a href="" ><label for="" class="btn-cancel">Hủy bỏ</label></a>
                            <input type="submit" class="btn-create" value="Cập nhật">
                        </div>
        </div>
    </div>
    
</form>
@endsection