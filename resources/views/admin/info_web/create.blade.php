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
    @if(!isset($info))
    {!! Form::open(['route'=>'infoWeb.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    @else
    {!! Form::open(['route'=>['infoWeb.update', $info->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
    @endif
    <div class="form-group text-white">
        {!! Form::label('title', 'Tiêu đề', []) !!}
        {!! Form::text('title', isset($info) ? $info->title : '', ['class' => 'form-control', 'placeholder' =>'Tên thể loại']) !!}
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group text-white">
        {!! Form::label('image', 'Logo', []) !!}<br>
        @if(isset($info))
            <img src="{{asset('uploads/info/'.$info->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($info->image)}}">
        @endif
        {!! Form::file('image', ['class' => 'form-control']) !!}
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
    </div>
    <div class="form-group text-white">
        {!! Form::label('description','Mô tả', []) !!}
        {!! Form::textarea('description', isset($info) ? $info->description : '', ['style' => 'resize:none','class' =>
        'form-control', 'placeholder' =>'Mô tả thể loại','id' => 'content']) !!}
    </div>
    

    @if( Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' )
        @if (Auth::user()->status == 1)
            @if(!isset($info))
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
                            <th scope="col" class="text-white" style="width:161px">Tiêu đề </th>
                            <!-- <th scope="col" class="text-white" style="width:508px">Mô tả</th> -->
                            <th scope="col" class="text-white">Logo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="lst" class="order_position">
                        @foreach($lstInfo as $key => $in)
                        <tr>
                            <td scope="row" class="text-white">{{ $in->id }}</td>
                            <td class="text-white">{{ $in->title }}</td>
                            <!-- <td class="text-white">
                                {!!Illuminate\Support\Str::of($in->description)->words(15)!!}
                            </td> -->
                            <td class="text-white">
                                <img src="{{asset('uploads/info/'.$in->image)}}" width="100" alt="">    
                            </td>
                            
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' ||
                            Auth::user()->role == 'manage' )
                                @if ( Auth::user()->status == 1)
                                    <td>
                                        {!! Form::open(['method'=>'delete','route' => ['infoWeb.destroy', $in->id], 'onsubmit' =>'return confirm("Bạn có muốn xóa thể loại này?")']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  !!}
                                        {!! Form::close() !!}
                                    
                                        <a href="{{route('infoWeb.edit', $in->id)}}" class="btn btn-warning"
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