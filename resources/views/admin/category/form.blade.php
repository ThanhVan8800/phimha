@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
    .read-more {
        height:100px;
        overflow:hidden;
    }
</style>
@endsection 
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('Dashboard') }}</div> -->
                    <div class="card-body img">
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
                                <div class="form-group text-white">
                                    {!! Form::label('title', 'Tiêu đề', []) !!}
                                    {!! Form::text('title', isset($category) ? $category->title : '', 
                                        ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'slug','onkeyup' =>'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($category) ? $category->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'điền đi','id' => '']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '2' => 'Không hiện'], isset($category) ? $category->status : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                @if(!isset($category))
                                        {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @else
                                        {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary']) !!}
                                @endif
                            {!! Form::close() !!}
                    </div>
                    
                    <div class="card-body table-responsive p-0">
                    <div class="form-group">
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" name="keyword" id="keyword" class="form-control input-lg" placeholder="Tìm kiếm danh mục phim"/>
                            </div>
                            <form action="{{route('filter')}}" method='GET'>
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <select name="title" id="" class="custom-select is-warning">
                                            <option value="">---Chọn danh mục---</option>
                                            @foreach ($lstCate as $cate )
                                                <option value="{{ $cate->title}}">{{ $cate->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4 ">
                                        <select name="status" id="" class="custom-select is-warning">
                                                <option value="">---Chọn trạng thái---</option>
                                                <option value="1"> Show </option>
                                                <option value="2">  Không hiện </option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary"><i class="fa-solid fa-filter"></i></button>
                                <div class="row">
                                    
                                </div>
                            </form>
                        </div>
                            
                    </div>
                        <table class="table img" id="myTable">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Tiêu đề phim</th>
                                <th scope="col" class="text-white" style="width:300px;">Mô tả</th>
                                <th scope="col" class="text-white">Slug</th>
                                <th scope="col" class="text-white">Vị trí hiển thị(mới nhất)</th>
                                <th scope="col" class="text-white">Trạng thái</th>
                                <th scope="col" class="text-white">Chức năng quản lý</th>
                                </tr>
                            </thead>
                            <tbody class="order_position" id="lst">
                                @foreach($lstCate as $key => $cate)
                                    <tr id="{{$cate->id}}">
                                            <td scope="row" class="text-white">{{$key}} </td>
                                            <td class="text-white">{{ $cate->title }}</td>
                                            <td class="text-white  " >
                                                <p id="more-{{ $cate->id }}" class="read-more">
                                                    {{ $cate->description }}
                                                </p>
                                                <!-- <a href="javascript:void()" class="readmore-btn">Read More</a> -->
                                                <a href="" class="xemtoanbo btn btn-primary">Xem thêm</a>
                                            </td>
                                            <!-- !! để thực thi đọc html -->
                                            <td class="text-white">{{ $cate->slug }}</td>
                                            <td class="text-white">{{ $cate->position }}</td>
                                            <td class="text-white">
                                                @if($cate -> status == 1 )
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
                    <div>
                        {{$lstCate->links("pagination::bootstrap-5")}}
                    </div>
                
@endsection
@section('footer')

            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
            <!-- <script>
                $(".xemtoanbo").on('click', function() {
                    $(this).parent().parent('td').children('p');

                    // var  replaceText = $(this).parent().hasClass("showContent") ? "Read less" : "Read more";
                    // $(this).text(replaceText);
                });
            </script> -->
            <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->
    <script>
        $(".xemtoanbo").click(function(e) {
            e.preventDefault()
            let el = $(this).parent('td').children('p');
            el.removeClass('read-more');
            $(this).remove();
            
        });
    </script>
            
@endsection
