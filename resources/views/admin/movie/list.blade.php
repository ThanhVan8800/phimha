@extends('layouts.app')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection 
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('Dashboard') }}</div>
            
                    <table class="table-warning" >
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Tên phim English</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Phụ đề</th>
                            <th scope="col">Định dạng</th>
                            <!-- <th scope="col">Mô tả</th> -->
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Loại phim</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">Phim hot</th>
                            <th scope="col">Năm</th>
                            <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody  >
                            @foreach($lstMovie as $key => $movie)
                                <tr>
                                        <th scope="row">{{ $movie->id }}</th>
                                        <td>{{ $movie->title }}</td>
                                        <td>{{ $movie->name_eng }}</td>
                                        <td>{{ $movie->slug }}</td>
                                        <td>
                                            @if ($movie->subtitle == 0)
                                                    Vietsub 
                                                @else
                                                    Thuyết minh
                                            @endif
                                        </td>
                                        <td>
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
                                            <img src="{{asset('uploads/movie/'.$movie->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($movie->image)}}">
                                        </td>
                                        <td>{{ $movie->category->title }}</td>
                                        <td>{{ $movie->genre->title }}</td>
                                        <td>{{ $movie->country->title }}</td>
                                        <td>
                                            @if($movie->film_hot == 1)
                                                Hot
                                            @else
                                                No Hot
                                            @endif
                                        </td>
                                        <td>
                                            {!! Form::selectYear('year', 1995, 2025,
                                                    isset($movie) ? $movie->year :'', ['class' => 'select-year', 'id'=>$movie->id]) !!}
                                    
                                        </td>
                                        <td>
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
            

@endsection