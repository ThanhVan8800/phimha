@extends('layouts.main')

@section('content')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        @if(!isset($genre))
                            {!! Form::open(['route'=>'genre.store','method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['genre.update', $genre->id],'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group">
                                    {!! Form::label('title', 'Tiêu đề', []) !!}
                                    {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('slug', 'SLug', []) !!}
                                    {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'điền đi','id' => 'description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($genre) ? $genre->status : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                @if(!isset($genre))
                                        {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @else
                                
                                        {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @endif
                            {!! Form::close() !!}
                    </div>
                    <input type="text" name="keyword" id="keyword" class="form-control input-lg" placeholder="Enter Country Name" />
                    <table class="table-warning img" id="myTable">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tiêu đề phim</th>
                                <th scope="col" class="text-white">Mô tả</th>
                                <th scope="col" class="text-white">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="lst">
                                @foreach($lstGenre as $key => $gen)
                                    <tr>
                                            <th scope="row" class="text-white">{{ $gen->id }}</th>
                                            <td class="text-white">{{ $gen->title }}</td>
                                            <td class="text-white">{{ $gen->description }}</td>
                                            <td class="text-white">
                                                @if($gen -> status )
                                                    Hiển thị
                                                @else  
                                                    Không hiển thị
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method'=>'delete','route' => ['genre.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                                {!! Form::close() !!}                                
                                            </td>
                                            <td>
                                                <a href="{{route('genre.edit', $gen->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>           
@endsection
