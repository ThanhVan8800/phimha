@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection
@section('content')
<div class="card-body">

    <div class="row">

        <div class="col-md-6">
            <div class="form-group col-md-8 margin-top">
                <label for="name">Tên phim: {{$movie->title}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="name ">Mô tả:</label>
                <p>{!!Str::limit($movie->description,120)!!}
                </p>
            </div>
            <div class="form-group col-md-8">
                <label for="name">Hình ảnh: </label><br />
                <img src="{{asset('uploads/movie/'.$movie->image)}}" style="width:200px; height:200px" alt="">

            </div>
            <div class="form-group col-md-8">
                <label for="name">Trạng thái:
                    @if ($movie->status == 1)
                    Hiển thị phim
                    @else
                    Không hiện
                    @endif
                </label>
            </div>
            <div class="form-group col-md-8">
                <label for="name">Phim hot:
                    @if ($movie->film_hot == 1)
                    Phim hot
                    @else
                    Ẩn phim
                    @endif
                </label>
            </div>
            <div class="form-group col-md-8">
                <label for="name">Tên tiếng anh:{{$movie->name_eng}}</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-8 margin-top">
                <label for="name">Chất lượng phim:
                    @if($movie->resolution == 0)
                    HD
                    @elseif ($movie->resolution == 1)
                    SD
                    @elseif ($movie->resolution == 2)
                    HDCam
                    @elseif ($movie->resolution == 3)
                    Cam
                    @else
                    FullHD
                    @endif
                </label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Phụ đề:
                    @if ($movie->subtitle == 0)
                    Vietsub
                    @else
                    Thuyết minh
                    @endif
                </label>
            </div>
            <div class="form-group col-md-4">
                <label for="">Ngày tạo:{{$movie->date_created}}</label>
            </div>
            <div class="form-group col-md-4">
                <label for="">Ngày cập nhật:{{$movie->update_day}}</label>
            </div>
            <div class="form-group col-md-4">
                <label for="">Năm phát sóng:{{$movie->year}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Thời lượng phim:{{$movie->movie_duration}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Từ khóa tìm kiếm :{{$movie->tags}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Mùa :{{$movie->season}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Trailer :
                    @if ($movie->trailer)
                    {{$movie->trailer}}
                    @else
                    Không có trailer
                    @endif
                </label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Số tập phim :
                    @if ($movie->episode_film)
                    {{$movie->episode_film}}
                    @else
                    Phim chiếu rạp
                    @endif</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Phim thuộc :
                    @if ($movie->belonging_movie == 0)
                    Phim lẻ
                    @else
                    Phim bộ
                    @endif</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Danh mục :{{$movie->category->title}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Thể loại :{{$movie->genre->title}}</label>
            </div>
            <div class="form-group col-md-8">
                <label for="">Quốc gia :{{$movie->country->title}}</label>
            </div>
            <div class="form-group margin-top">
                <a href="http://127.0.0.1:8000/admin/movies/movie" class="btn__neon btn-warning text-white  ">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Quay lại</a>
            </div>
        </div>

    </div>
</div>
<script>
$(".xemtoanbo").click(function(e) {
    e.preventDefault()
    let el = $(this).parent('td').children('p');
    el.removeClass('read-more');
    $(this).remove();

});
</script>
@endsection