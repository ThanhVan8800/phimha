@extends('layouts.app')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection 
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
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        @if(!isset($category))
                            {!! Form::open(['route'=>'category.store','method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['category.update', $category->id],'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group">
                                    {!! Form::label('title', 'Tiêu đề', []) !!}
                                    {!! Form::text('title', isset($category) ? $category->title : '', 
                                        ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'slug','onkeyup' =>'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($category) ? $category->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'điền đi','id' => 'content']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($category) ? $category->status : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                @if(!isset($category))
                                        {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @else
                                        {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @endif
                            {!! Form::close() !!}
                    </div>
                    <table class="table-warning" id="myTable">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tiêu đề phim</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach($lstCate as $key => $cate)
                                <tr id="{{$cate->id}}">
                                        <th scope="row">{{$key}} </th>
                                        <td>{{ $cate->title }}</td>
                                        <td>{!! $cate->description !!}</td>
                                        <!-- !! để thực thi đọc html -->
                                        <td>{{ $cate->slug }}</td>
                                        <td>
                                            @if($cate -> status )
                                                Show
                                            @else  Không hiển thị
                                            @endif
                                        </td>
                                        <td>
                                            {!! Form::open(['method'=>'delete','route' => ['category.destroy', $cate->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                            {!! Form::close() !!}                                
                                        </td>
                                        <td>
                                            <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
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
            <script >
                $(document).ready( function () {
                    $('#myTable').DataTable();
                } );
            </script>
@endsection
