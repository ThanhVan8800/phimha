@extends('layouts.main')

@section('content')

                    <div class="card-body img">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                    @if(!isset($episode))
                        {!! Form::open(['route' => 'episode.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route' => ['episode.update', $episode->id],'method'=>'PUT']) !!}
                    @endif
                    <div class="form-group text-white">
                        {!! Form::label('Phim', ' Phim', []) !!}
                        {!! Form::label('','*',['class' => 'text-danger'])!!}
                        {!! Form::select('movie_id',['0'=> 'Chọn phim', '1' =>$movie], isset($episode) ? $episode->movie_id : '', ['class' =>'form-control  select-episode', 'placeholder' =>'Chọn phim cần thêm ']) !!}
                        @error('movie_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-white">
                        {!! Form::label('linkfilm', 'Link Phim', []) !!}
                        {!! Form::label('','*',['class' => 'text-danger'])!!}
                        {!! Form::text('linkfilm', isset($episode) ? $episode->linkfilm : '', ['class' => 'form-control', 'placeholder' =>'Nhập link film vào...']) !!}
                        @error('linkfilm')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group text-white">
                        <!-- <label for="">Tập Phim</label>
                        <select name="episode" class="form-control " id="show_movie">
                            <option value="">Chọn tập phim</option>
                        
                        </select> -->
                        @if(isset($episode))
                            {!! Form::label('episode', 'Tập Phim', []) !!}
                            {!! Form::label('','*',['class' => 'text-danger'])!!}
                            {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class' => 'form-control', 'placeholder' =>'điền đi', isset($episode) ? 'readonly':'']) !!}
                        @else 
                            <label for="">Tập Phim</label>
                            {!! Form::label('','*',['class' => 'text-danger'])!!}
                            <select name="episode" class="form-control " id="show_movie"> </select>
                        @endif
                    </div>
                    {!! Form::label('','*',['class' => 'text-danger'])!!}
                    {!! Form::label('','Là các trường bắt buộc điền',['class' => 'text-white'])!!}<br/>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' && Auth::user()->status == '1')
                        @if(!isset($episode))
                                {!! Form::submit('Thêm phim', ['class' => 'btn btn-outline-primary']) !!}
                        @else
                                {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                        @endif
                        
                        {!! Form::close() !!}
                    @endif
                    </div>
                    <div class="form-group">
                        <!-- <form action="{{route('search-episode')}}" method="GET"> -->
                            <div class="card-body">
                                
                            <div class="mb-3">
                                <input type="text" name="keyword" id="keyword" class="form-control input-lg" placeholder="Tìm kiếm danh mục phim" />
                            </div>
                            </div>  
                        <!-- </form> -->
                        
                    </div>
                    <div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table img" >
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tên phim</th>
                                <th scope="col" class="text-white">Hình ảnh</th>
                                <th scope="col" class="text-white" >Link Film</th>
                                <!-- <th scope="col" class="text-white">Phim</th> -->
                                <th scope="col" class="text-white">Tập Phim</th>
                                <th scope="col" class="text-white">Lượt xem</th>
                                <th scope="col" class="text-white">Ngày thêm tập phim</th>
                                <th scope="col" class="text-white">Ngày cập nhật Phim</th>
                                </tr>
                            </thead>
                            <tbody id="lst">
                                @foreach($lstEpisode as $key => $movi)
                                    <tr>
                                            <td scope="row" class="text-white">{{ $movi->id }}</td>
                                            
                                            <td class="text-white">
                                                {{$movi->movie->title}}
                                            </td>
                                            <td class="text-white">
                                                <img src="{{asset('uploads/movie/'.$movi->movie->image)}}" style="width:150px;max-height:300px;object-fit:contain" alt="{{asset($movi->movie->image)}}">
                                            </td>
                                            <td class="text-white" style="width:10px;">
                                                    <!-- {{Illuminate\Support\Str::of($movi->linkfilm)->words(5)}} -->
                                                    {{$movi->linkfilm}}
                                            </td>
                                            
                                            <td value="{{$movi->episode}}" class="text-white">
                                                    {{$movi->episode}}
                                            </td>
                                            <td>{{$movi->views}}</td>
                                            <td>{{$movi->created_at}}</td>
                                            <td>{{$movi->updated_at}}</td>
                                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' && Auth::user()->status == '1')
                                                <td>
                                                    {!! Form::open(['method'=>'delete','route' => ['episode.destroy', $movi->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                                    {!! Form::close() !!}                                
                                                </td>
                                                <td>
                                                    <a href="{{route('episode.edit', $movi->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                                </td>
                                            @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div>
                        {!!$lstEpisode->links("pagination::bootstrap-5")!!}
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