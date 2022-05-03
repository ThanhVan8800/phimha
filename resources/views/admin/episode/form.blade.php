@extends('layouts.main')

@section('content')

                    <div class="card-body img">
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
                    <div class="form-group text-white">
                        {!! Form::label('linkfilm', 'Link Phim', []) !!}
                        {!! Form::text('linkfilm', isset($episode) ? $episode->linkfilm : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    
                    <div class="form-group text-white">
                        {!! Form::label('Phim', ' Phim', []) !!}
                        {!! Form::select('movie_id',['0'=> 'Chọn phim', '1'=>$movie], isset($episode) ? $episode->movie_id : '', ['class' =>'form-control  select-episode', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group text-white">
                        <!-- <label for="">Tập Phim</label>
                        <select name="episode" class="form-control " id="show_movie">
                            <option value="">Chọn tập phim</option>
                        
                        </select> -->
                        @if(isset($episode))
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class' => 'form-control', 'placeholder' =>'điền đi', isset($episode) ? 'readonly':'']) !!}
                        @else 
                            <label for="">Tập Phim</label>
                            <select name="episode" class="form-control " id="show_movie"> </select>
                        @endif
                    </div>
                    @if(!isset($episode))
                                        {!! Form::submit('Thêm phim', ['class' => 'btn btn-primary']) !!}
                                @else
                                
                                        {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                                @endif
                    {!! Form::close() !!}
                    </div>
                    <table class="table-warning img" id="">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tên phim</th>
                                <th scope="col" class="text-white">Hình ảnh</th>
                                <th scope="col" class="text-white">Link Film</th>
                                <th scope="col" class="text-white">Phim</th>
                                <th scope="col" class="text-white">Tập Phim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lstEpisode as $key => $movi)
                                    <tr>
                                            <th scope="row" class="text-white">{{ $movi->id }}</th>
                                            
                                            <td class="text-white">
                                                {{$movi->movie->title}}
                                            </td>
                                            <td class="text-white">
                                                <img src="{{asset('uploads/movie/'.$movi->movie->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($movi->movie->image)}}">
                                            </td>
                                            <td class="text-white">
                                                    <!-- {{Illuminate\Support\Str::of($movi->linkfilm)->words(5)}} -->
                                                    {!!$movi->linkfilm!!}
                                            </td>
                                            <td value="{{$movi->episode}}" class="text-white">
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