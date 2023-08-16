@extends('layouts.main')

@section('content')
<form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="movie_id" id="" value="{{$movie_id}}">
    <!-- value={{Request::segment(2)}} -->
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
                        <label for="menu">Tải ảnh lên</label>
                        <input type="file" class="form-control" multiple name="image[]">
                        <div id="image_show" style="margin-top:10px">
                            <a href="">
                                <img src="" width="100px" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($gallery as $key=> $ga )
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            
                                <div id="image_show" style="margin-top:10px">
                                    <a href="">
                                        <img src="{{asset('uploads/gallery/'.$ga->image)}}" width="100px" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <div class="form-group">
                <label for="" style="color: #7E7D88;margin-top:50px;"><span style="color:#FF4747;">*</span> Là trường
                    thông tin bắt buộc</label>
            </div>
            <div class="row">
                <!-- <label for="" class="btn-cancel">Hủy bỏ</label> -->
                <a href=""><label for="" class="btn-cancel">Hủy bỏ</label></a>
                <input type="submit" class="btn-create" value="Cập nhật">
            </div>
        </div>
    </div>

</form>
@endsection