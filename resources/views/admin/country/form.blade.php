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
                        @if(!isset($country))
                            {!! Form::open(['route'=>'country.store','method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['country.update', $country->id],'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group text-white">
                                    {!! Form::label('title', 'Tên Quốc Gia', []) !!}
                                    {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'slug','onkeyup' => 'ChangeToSlug()']) !!}
                                    @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' =>'auto','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($country) ? $country->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'content']) !!}
                                    @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($country) ? $country->status : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung']) !!}
                                    @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' && Auth::user()->status == '1')
                                    @if(!isset($country))
                                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                                    @else
                                    
                                            {!! Form::submit('Cập nhật dữ liệu', ['class' => 'btn btn-primary']) !!}
                                    @endif
                                @endif
                            {!! Form::close() !!}
                    </div>
                    <table class="table-warning img" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">ID</th>
                                    <th scope="col" class="text-white">Quốc gia</th>
                                    <th scope="col" class="text-white">Mô tả</th>
                                    <th scope="col" class="text-white">Trạng thái</th>
                                    <th>Quản lý</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="order_position">
                                @foreach($lstCountry as $key => $gen)
                                    <tr>
                                            <td scope="row" class="text-white">{{ $gen->id }}</td>
                                            <td class="text-white">{{ $gen->title }}</td>
                                            <td class="text-white">{!! $gen->description !!}</td>
                                            <td class="text-white">
                                                @if($gen -> status )
                                                    Hiển thị
                                                @else  
                                                    Không hiển thị
                                                @endif
                                            </td>
                                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' && Auth::user()->status == '1')
                                                <td>
                                                    {!! Form::open(['method'=>'delete','route' => ['country.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                                    {!! Form::close() !!}                                
                                                </td>
                                                <td>
                                                    <a href="{{route('country.edit', $gen->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                                </td>
                                            @endif
                                    </tr>
                                @endforeach
                                
                            </tbody>
                    </table>      
                    <form action="{{url('/downloadPDF')}}" method="get">
                            @csrf
                            <button class="btn btn-primary">Tải về</button>
                    </form>    
                    
                    <div>
                        {{$lstCountry->links("pagination::bootstrap-5")}}
                    </div>
@endsection
@section('footer')
@section('footer')

            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>

@endsection
