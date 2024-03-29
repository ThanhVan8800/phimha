@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection
@section('content')
<form action="{{route('searchMovie')}}" method='GET'>
    <div class="row">
        <div class="mb-3 col-3">
            <label for="date" class="col-form-label ">Ngày tạo phim từ</label>
            <input type="date" class="form-control " id="from" name="fromDate" placeholder="" required>
        </div>
        <div class="mb-3 col-3">
            <label for="date" class="col-form-label ">Ngày tạo phim đến</label>
            <input type="date" class="form-control " id="to" name="toDate" placeholder="" required>
        </div>
    </div>
    <button class="btn btn-primary"><i class="fa-solid fa-filter"></i></button>
    <div class="row">

    </div>
    </div>

</form>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table  text-nowrap bg-navy" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">STT</th>
                            <!-- Button trigger modal -->
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white">Tên phim</th>
                            <th scope="col" class="text-white">Thư viện</th>
                            <th scope="col" class="text-white">Thêm tập phim</th>
                            <th scope="col" class="text-white">Hình ảnh</th>
                            <th scope="col" class="text-white">Số tập</th>
                            <th scope="col" class="text-white">Tên phim English</th>
                            <th scope="col" class="text-white">Slug</th>
                            <!-- <th scope="col" class="text-white">Đạo diễn</th>
                            <th scope="col" class="text-white">Diễn viên</th> -->
                            <!-- <th scope="col" class="text-white">Tags Phim</th> -->
                            <th scope="col" class="text-white">Thời lượng phim</th>
                            <th scope="col" class="text-white">Phụ đề</th>
                            <th scope="col" class="text-white">Định dạng</th>
                            <!-- <th scope="col">Mô tả</th> -->
                            <th scope="col" class="text-white">Phim thuộc</th>
                            <th scope="col" class="text-white">Danh mục</th>
                            <th scope="col" class="text-white">Loại phim</th>
                            <th scope="col" class="text-white">Quốc gia</th>
                            <th scope="col" class="text-white">Phim hot</th>
                            <th scope="col" class="text-white">Phim VIP</th>
                            <th scope="col" class="text-white">Số tập phim</th>
                            <th scope="col" class="text-white">Năm</th>
                            <th scope="col">Top views</th>
                            <th scope="col" class="text-white">Trailer</th>
                            <th scope="col" class="text-white">Season</th>
                            <th scope="col" class="text-white">Trạng thái</th>
                            <th scope="col" class="text-white">Quản lý</th>
                            
                        </tr>
                    </thead>
                    <tbody class="order_position">
                        @foreach($lstMovie as $key => $movie)
                        <tr>
                            <td>
                                @if ($key == 0)
                                    1
                                @else
                                    {{$key+1}}
                                @endif
                            </td>
                            <th scope="row" class="text-white">{{ $movie->id }}</th>
                            <td class="text-white">{{ $movie->title }}</td>
                            <td><a href="{{route('gallery.edit',[$movie->id])}}"  class="btn btn-primary btn-sm">Thêm ảnh
                                    
                                </a>
                            </td>
                            <td class="text-white"><a href="{{route('episode.show',[$movie->id])}}" class="btn btn-primary btn-sm">Thêm tập phim</a><br>
                                    @foreach ($movie->episode as $count_epi)
                                        <a href="" class="show_video" 
                                            data-movie_video_id="{{$count_epi->id}}" 
                                            data-video_episode="{{$count_epi->episode}}">
                                            <span class="badge badge-yellow">{{$count_epi->episode}}</span>
                                        </a>
                                    @endforeach
                            </td>
                            <td>
                                <img src="{{asset('uploads/movie/'.$movie->image)}}"
                                    style="width:100px;max-height:200px;object-fit:contain"
                                    alt="{{asset($movie->image)}}">
                                <input type="file" class="form-control-file file-image" data-movie_id="{{$movie->id}}" accept="image/*" id="file-{{$movie->id}}">
                                <span id="success_image"></span>
                                
                            </td>
                            <!-- Thêm _count để nó đếm số tập  -->
                            <td class="text-white">
                                @if($movie->episode_film > 0)
                                    {{$movie->episode_count}}/{{$movie->episode_film}}
                                    
                                @else
                                    Hoàn Thành
                                @endif
                            </td>
                            <td class="text-white">{{ $movie->name_eng }}</td>
                            <td class="text-white">{{ $movie->slug }}</td>
                            <!-- <td class="text-white">
                                @if($movie->director)
                                    {{ $movie->director }}
                                @else
                                    Đang cập nhật
                                @endif
                            </td>
                            <td class="text-white">
                                @if($movie->actor)
                                    {{ $movie->actor }}
                                @else
                                    Đang cập nhật
                                @endif
                            </td> -->
                            <!-- <td class="text-white ">
                                @if ($movie->tags != NULL)
                                    {{substr($movie->tags, 0,50)}}...
                                @else
                                    Chưa có từ khóa của phim
                                @endif
                            </td> -->
                            <td class="text-white">{{ $movie->movie_duration }}</td>
                            <td class="text-white">
                                @if ($movie->subtitle == 0)
                                    Vietsub
                                @else
                                    Thuyết minh
                                @endif
                            </td>
                            <td class="text-white">
                                @if($movie->resolution == 0)
                                    HD
                                @elseif ($movie->resolution == 1)
                                    SD
                                @elseif ($movie->resolution == 2)
                                    HDCam
                                @elseif ($movie->resolution == 3)
                                    Cam
                                @elseif($movie->resolution == 4)
                                    FullHD
                                @else
                                    Trailer
                                @endif
                            </td>
                            <!-- <td>{!! $movie->description !!}</td> -->
                            
                            <td class="text-white">
                                @if ($movie->belonging_movie == 0)
                                Phim lẻ
                                @elseif($movie->belonging_movie == 1)
                                Phim bộ
                                @endif
                            </td>
                            <td class="text-white">{{ $movie->category->title }}</td>
                            <td class="text-white">
                                @foreach($movie -> movie_genre as $key => $mov)
                                    <label class="btn btn-block btn-outline-warning btn-flat"> {{$mov  -> title }} </label>
                                @endforeach
                            </td>
                            <td class="text-white">{{ $movie->country->title }}</td>
                            <td class="text-white">
                                @if($movie->film_hot == 1)
                                Hot
                                @else
                                No Hot
                                @endif
                            </td>
                            <td class="text-white">
                                @if($movie->film_vip == 2)
                                Phim VIP
                                @else
                                Phim thường
                                @endif
                            </td>
                            <td class="text-white" value="{{$movie->episode_film}}">
                                @if($movie->episode_film > 0)
                                    {{$movie->episode_film}}
                                @else
                                    Phim lẻ
                                @endif
                            </td>
                            <td>
                                {!! Form::selectYear('year', 1995, 2025,
                                isset($movie) ? $movie->year :'', ['class' => 'select-year', 'id'=>$movie->id]) !!}

                            </td>
                            <td>
                                {!! Form::select('topview', ['0'=>'Ngày','1'=>'Tuần','2'=>'Tháng'],
                                isset($movie->topview) ? $movie->topview : '',
                                ['class'=>'select-topview','id'=>$movie->id]) !!}
                            </td>
                            <td class="text-white">
                                @if ($movie->trailer)
                                {{$movie->trailer}}
                                @else
                                Chưa có Trailer
                                @endif
                            </td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    {!! Form::selectRange('season', 0, 20,
                                    isset($movie) ? $movie->season :'', ['class' => 'select-session', 'id'=>$movie->id])
                                    !!}
                                </form>
                            </td>
                            <td class="text-white">
                                @if($movie -> status )
                                Hiển thị
                                @else
                                Không hiển thị
                                @endif
                            </td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ||
                            Auth::user()->role == 'manage' && Auth::user()->status == '1')
                            <td>
                                {!! Form::open(['method'=>'delete','route' => ['movie.destroy', $movie->id], 'onsubmit'
                                => 'return confirm("Bạn có muốn xóa phim này?")']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                                btn-dark btn-sm', 'style' => 'height:40px; width:40px'] ) !!}
                                {!! Form::label('','XÓA PHIM', [] ) !!}
                                {!! Form::close() !!}
                                <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning"><i
                                        class="fa-solid fa-pen"></i> CHỈNH SỬA</a><br>
                                <a href="{{route('movie.show',[ $movie->id])}}" class="btn__neon ">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Xem chi tiết</a>
                            </td>
                            
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal">
                                    Thêm nhanh danh mục
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="videoModal" tabindex="-1" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="video_title">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <p id="video_title"></p>
                                    <p id="video_description"></p>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
@endsection
@section('footer')
<script>
// Replace the <textarea id="editor1"> with a CKEditor 4
// instance, using default configuration.
CKEDITOR.replace('content');
</script>

<!-- <script type="text/javascript" >
                $(document).ready( function () {
                    $('#myTable').DataTable();
                } );
            </script> -->


@endsection