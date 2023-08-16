@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
<style type='text/css'>table {
    counter-reset: rowNumber;
}
table tr {
    counter-increment: rowNumber;
}

table tr td:first-child::before {
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
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
                        
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-error">
                                {{Session::get('error')}}
                            </div>
                        @endif
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        @if(!isset($linkmovie))
                            {!! Form::open(['route'=>'linkmovie.store','method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['linkmovie.update', $linkmovie->id],'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group text-white">
                                    {!! Form::label('title', 'Tên danh mục', []) !!}
                                    {!! Form::label('','*',['class' => 'text-danger'])!!}
                                    {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', 
                                        ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'slug','onkeyup' =>'ChangeToSlug()']) !!}
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            
                                <div class="form-group text-white">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::label('','*',['class' => 'text-danger'])!!}
                                    {!! Form::textarea('description', isset($linkmovie) ? $linkmovie->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'Mô tả danh mục','id' => '']) !!}
                                    @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::label('','*',['class' => 'text-danger'])!!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '2' => 'Không hiện'], isset($linkmovie) ? $linkmovie->status : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if( Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' )
                                    @if (Auth::user()->status == 1)
                                        @if(!isset($category))
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
                                            @foreach ($lstLinkmo as $cate )
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
                            <div id='loader'></div>
                        </div>
                            <div class="ml-3">
                                <a href="" id="deleteAll" class="btn btn-primary">Xóa hết</a>
                            </div>
                            <div class=" ajax-success">
                                
                            </div>
                    </div>
                        <table class="table " id="myTable" border="5" cellpadding="0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">STT</th>
                                    <th scope="col" class="text-white"><input type="checkbox" id="chkCheckAll"></th>
                                    <th scope="col" class="text-white">ID</th>
                                    <th scope="col" class="text-white">Tiêu đề phim</th>
                                    <th scope="col" class="text-white" style="width:300px;">Mô tả</th>
                                    <th scope="col" class="text-white">Slug</th>
                                    <th scope="col" class="text-white">Vị trí hiển thị(mới nhất)</th>
                                    <th scope="col" class="text-white">Trạng thái</th>
                                    <th scope="col" class="text-white">Ngày tạo </th>
                                    <th scope="col" class="text-white">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody class="order_position" id="lst">
                                @foreach($lstLinkmo as $key => $cate)
                                
                                    <tr id="sid{{$cate->id}}">
                                        <td></td>
                                        <td><input type="checkbox" name="ids" id="" value="{{$cate->id}}" class="checkBoxClass"></td>
                                            <td scope="row" class="text-white">{{$cate->id}} </td>
                                            <td class="text-white">{{ $cate->title }}</td>
                                            <td class="text-white">
                                                <div class="comment more">
                                                    @if(strlen($cate->description) > 100)
                                                        {{substr($cate->description,0,100)}}
                                                        <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                                        <span class="read-more-content"> {{substr($cate->description,100,strlen($cate->description))}} 
                                                        <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                                    @else
                                                        {{$cate->description}}
                                                    @endif
                                                </div>
                                                <!-- <a href="javascript:void()" class="readmore-btn">Read More</a> -->
                                                <!-- <a href="" class="xemtoanbo btn btn-primary">Xem thêm</a> -->
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
                                            <td class="text-white">
                                                {{$cate->created_at}} ||{{ \Carbon\Carbon::parse($cate->created_at)->diffForHumans()}}
                                            </td>
                                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' )
                                                @if ( Auth::user()->status == 1)
                                                    <td>
                                                        {!! Form::open(['method'=>'delete','route' => ['category.destroy', $cate->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa danh mục phim này?")']) !!}
                                                            {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                                        {!! Form::close() !!}                                
                                                    </td>
                                                    <td>
                                                        <a href="{{route('category.edit', $cate->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                                    </td>
                                                @endif
                                                
                                            @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{$lstLinkmo->links("pagination::bootstrap-5")}}
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
    <script type="text/javascript">
    // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
                $('.read-more-content').addClass('hide_content')
                $('.read-more-show, .read-more-hide').removeClass('hide_content')

                // Set up the toggle effect:
                $('.read-more-show').on('click', function(e) {
                $(this).next('.read-more-content').removeClass('hide_content');
                $(this).addClass('hide_content');
                e.preventDefault();
                });

                // Changes contributed by @diego-rzg
                $('.read-more-hide').on('click', function(e) {
                var p = $(this).parent('.read-more-content');
                p.addClass('hide_content');
                p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
                e.preventDefault();
                });
    </script>
    <script>
        $(function(e){
            $("#chkCheckAll").click(function(){
                $(".checkBoxClass").prop('checked',$(this).prop('checked'));
            })

            $("#deleteAll").click(function(e){
                e.preventDefault();
                var allids = [];
                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });

                $.ajax({
                    url:"{{route('deleteCategoryAll')}}",
                    type:"DELETE",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allids
                    },
                    success:function(response){
                        $.each(allids,function(key,val){
                            $(".ajax-success").html(`<div class="ajax-success text-danger">
                            XÓa thành công danh mục
                            </div>`);
                            $("#sid" + val).remove();//sid ở tbody tr id="sid{{}}"
                        })
                    }
                })
            })
        })
    </script>
    <script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
            });
        });
    </script>
    
@endsection
