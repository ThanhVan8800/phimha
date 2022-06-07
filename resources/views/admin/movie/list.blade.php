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
                    <table class="table  text-nowrap bg-navy" id="myTable" >
                        <thead>
                            <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tên phim</th>
                                <th scope="col" class="text-white">Tên phim English</th>
                                <th scope="col" class="text-white">Slug</th>
                                <th scope="col" class="text-white">Đạo diễn</th>
                                <th scope="col" class="text-white">Diễn viên</th>
                                <th scope="col" class="text-white">Tags Phim</th>
                                <th scope="col" class="text-white">Thời lượng phim</th>
                                <th scope="col" class="text-white">Phụ đề</th>
                                <th scope="col" class="text-white">Định dạng</th>
                                <!-- <th scope="col">Mô tả</th> -->
                                <th scope="col" class="text-white">Hình ảnh</th>
                                <th scope="col" class="text-white">Phim thuộc</th>
                                <th scope="col" class="text-white">Danh mục</th>
                                <th scope="col" class="text-white">Loại phim</th>
                                <th scope="col" class="text-white">Quốc gia</th>
                                <th scope="col" class="text-white">Phim hot</th>
                                <th scope="col" class="text-white">Số tập phim</th>
                                <th scope="col" class="text-white">Năm</th>
                                <th scope="col" class="text-white">Trailer</th>
                                <th scope="col" class="text-white">Session</th>
                                <th scope="col" class="text-white">Trạng thái</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="order_position" >
                            @foreach($lstMovie as $key => $movie)
                                <tr>
                                        <th scope="row" class="text-white">{{ $movie->id }}</th>
                                        <td class="text-white">{{ $movie->title }}</td>
                                        <td class="text-white">{{ $movie->name_eng }}</td>
                                        <td class="text-white">{{ $movie->slug }}</td>
                                        <td class="text-white">
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
                                        </td>
                                        <td class="text-white ">
                                            @if ($movie->tags != NULL)
                                                {{substr($movie->tags, 0,50)}}...
                                            @else
                                                Chưa có từ khóa của phim
                                            @endif
                                        </td>
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
                                            @else 
                                                FullHD
                                            @endif
                                        </td>
                                        <!-- <td>{!! $movie->description !!}</td> -->
                                        <td>
                                            <img src="{{asset('uploads/movie/'.$movie->image)}}" style="width:100px;max-height:200px;object-fit:contain" alt="{{asset($movie->image)}}">
                                        </td>
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
                                                <label class="btn btn-block btn-outline-warning btn-flat">    {{$mov  -> title }} </label>

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
                                        <td class="text-white" value= "{{$movie->episode_film}}">
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
                                                {!! Form::selectRange('session', 0, 20,
                                                    isset($movie) ? $movie->session :'', ['class' => 'select-session', 'id'=>$movie->id]) !!}
                                            </form>
                                        </td>
                                        <td class="text-white">
                                            @if($movie -> status )
                                                Hiển thị
                                            @else  
                                                Không hiển thị
                                            @endif
                                        </td>
                                        <td>
                                            {!! Form::open(['method'=>'delete','route' => ['movie.destroy', $movie->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                            {!! Form::close() !!}                                
                                        </td>
                                        <td>
                                            <a href="{{route('movie.edit', $movie->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('movie.show',[ $movie->id])}}" class="btn btn-primary ">Xem chi tiet</a>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>           
                </div>
            </div>   
    </div>     
</div>       
@endsection
@section('footer')
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
        
            <!-- <script type="text/javascript" >
                $(document).ready( function () {
                    $('#myTable').DataTable();
                } );
            </script> -->

@endsection