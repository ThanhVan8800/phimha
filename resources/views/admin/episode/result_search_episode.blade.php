@extends('layouts.main')

@section('content')
                    <div class="form-group">
                        <div class="card-body">

                            <div class="mb-3">
                                <input type="text" name="episode" id="episode" class="form-control input-lg" placeholder="Tìm kiếm tập episode" />

                            </div>
                        </div>
                    </div>
                    <table class="table-warning img" id="">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tên phim</th>
                                <th scope="col" class="text-white">Hình ảnh</th>
                                <th scope="col" class="text-white">Link Film</th>
                                <!-- <th scope="col" class="text-white">Phim</th> -->
                                <th scope="col" class="text-white">Tập Phim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as $key => $movi)
                                    <tr>
                                            <th scope="row" class="text-white">{{ $movi->id }}</th>
                                            
                                            <td class="text-white">
                                                {{$movi->movie->title}}
                                            </td>
                                            <td class="text-white">
                                                <img src="{{asset('uploads/movie/'.$movi->movie->image)}}" style="width:150px;max-height:300px;object-fit:contain" alt="{{asset($movi->movie->image)}}">
                                            </td>
                                            <td class="text-white">
                                                    <!-- {{Illuminate\Support\Str::of($movi->linkfilm)->words(5)}} -->
                                                    {!!$movi->linkfilm!!}
                                            </td>
                                            <td value="" class="text-white">
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