@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@endsection
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
    <!-- kiểm tra nếu không tồn tại dùng form store -->
    @if(!isset($genre))
    {!! Form::open(['route'=>'genre.store','method'=>'POST']) !!}
    @else
    {!! Form::open(['route'=>['genre.update', $genre->id],'method'=>'PUT']) !!}
    @endif
    <div class="form-group text-white">
        {!! Form::label('title', 'Tiêu đề', []) !!}
        {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' =>'Tên thể loại' ,'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group text-white">
        {!! Form::label('slug', 'SLug', []) !!}
        {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' =>'auto','id' => 'convert_slug']) !!}
    </div>
    <div class="form-group text-white">
        {!! Form::label('description','Mô tả', []) !!}
        {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style' => 'resize:none','class' =>
        'form-control', 'placeholder' =>'Mô tả thể loại','id' => 'content']) !!}
    </div>
    <div class="form-group text-white">
        {!! Form::label('Active','Trạng thái', []) !!}
        {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($genre) ?
        $genre->status : '', ['class' => 'form-control', 'placeholder' =>'Chọn trạng thái hiển thị']) !!}
    </div>

    @if( Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' )
        @if (Auth::user()->status == 1)
            @if(!isset($genre))
            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-outline-info btn-sm']) !!}
            <a href="" class="btn btn-outline-warning btn-sm">Hủy bỏ</a>
            @else
            {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-outline-primary btn-sm']) !!}
            <a href="" class="btn btn-outline-warning btn-sm">Hủy bỏ</a>
            @endif
        @endif
    @endif
    {!! Form::close() !!}
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table-dark bg-navy" border="5" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white" style="width:161px">Tiêu đề phim</th>
                            <!-- <th scope="col" class="text-white" style="width:508px">Mô tả</th> -->
                            <th scope="col" class="text-white">Slug</th>
                            <th scope="col" class="text-white">Trạng thái</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="lst" class="order_position">
                        @foreach($lstGenre as $key => $gen)
                        <tr>
                            <td scope="row" class="text-white">{{ $gen->id }}</td>
                            <td class="text-white">{{ $gen->title }}</td>
                            <!-- <td class="text-white">
                                {!!Illuminate\Support\Str::of($gen->description)->words(15)!!}
                            </td> -->
                            <td class="text-white">{{ $gen->slug }}</td>
                            <td class="text-white">
                                @if($gen -> status )
                                Hiển thị
                                @else
                                Không hiển thị
                                @endif
                            </td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ||
                            Auth::user()->role == 'manage' )
                                @if ( Auth::user()->status == 1)
                                    <td>
                                        {!! Form::open(['method'=>'delete','route' => ['genre.destroy', $gen->id], 'onsubmit' =>'return confirm("Bạn có muốn xóa thể loại này?")']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a href="{{route('genre.edit', $gen->id)}}" class="btn btn-warning"
                                            style="height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                    </td>
                                @else 
                                    <td></td>
                                    <td></td>   
                                @endif

                            @endif
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
                CKEDITOR.replace('content');
                </script>
                @endsection