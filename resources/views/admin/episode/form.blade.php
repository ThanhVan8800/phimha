@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    @if(!isset($episode))
                        {!! Form::open(['route' => 'episode.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route' => ['episode.update', $episode->id],'method'=>'PUT']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('linkfilm', 'Link Phim', []) !!}
                        {!! Form::text('linkfilm', isset($episode) ? $episode->linkfilm : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('Phim', ' Phim', []) !!}
                        {!! Form::select('movie_id',['0'=> 'Chọn phim', '1'=>$movie], isset($episode) ? $episode->movie_id : '', ['class' =>'form-control  select-episode', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        <!-- <label for="">Tập Phim</label>
                        <select name="episode" class="form-control " id="show_movie">
                            <option value="">Chọn tập phim</option>
                        
                        </select> -->
                        @if(isset($episode))
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class' => 'form-control', 'placeholder' =>'điền đi', isset($episode) ? 'readonly':'']) !!}
                        @else 
                            <label for="">Tập Phim</label>
                            <select name="episode" class="form-control " id="show_movie">
                                <option value="">Chọn tập phim</option>
                            
                            </select>
                        @endif
                    </div>
                    @if(!isset($episode))
                                        {!! Form::submit('Thêm phim', ['class' => 'btn btn-primary']) !!}
                                @else
                                
                                        {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                                @endif
                    {!! Form::close() !!}
                    </div>
                    <table class="table-warning" id="">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên phim</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Link Film</th>
                    <th scope="col">Phim</th>
                    <th scope="col">Tập Phim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lstEpisode as $key => $movi)
                        <tr>
                                <th scope="row">{{ $movi->id }}</th>
                                
                                <td>
                                    {{$movi->movie->title}}
                                </td>
                                <td>
                                    <img src="{{asset('uploads/movie/'.$movi->movie->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($movi->movie->image)}}">
                                </td>
                                <td>
                                        <!-- {{Illuminate\Support\Str::of($movi->linkfilm)->words(5)}} -->
                                        {!!$movi->linkfilm!!}
                                </td>
                                <td value="{{$movi->episode}}">
                                    {{$movi->episode}}
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'delete','route' => ['episode.destroy', $movi->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                    {!! Form::close() !!}                                
                                </td>
                                <td>
                                    <a href="{{route('episode.edit', $movi->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
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
    <script type="text/javascript">
        $('.select-episode').change(function() {
            var id = $(this).val();
            // alert(id);
            $.ajax({
                url: "{{route('select-movie')}}",
                method: 'GET',
                data: {id: id},
                success: function(data) {
                    $('#show_movie').html(data);
                }
            })
        })
    </script>

@endsection