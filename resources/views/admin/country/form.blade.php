@extends('layouts.app')

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
                        @if(!isset($country))
                            {!! Form::open(['route'=>'country.store','method'=>'POST']) !!}
                        @else
                            {!! Form::open(['route'=>['country.update', $country->id],'method'=>'PUT']) !!}
                        @endif
                                <div class="form-group">
                                    {!! Form::label('title', 'Tên Quốc Gia', []) !!}
                                    {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'slug','onkeyup' => 'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($country) ? $country->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'description']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($country) ? $country->status : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung']) !!}
                                </div>
                                @if(!isset($country))
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
                    <th scope="col">Quoocs gia</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lstCountry as $key => $gen)
                        <tr>
                                <th scope="row">{{ $gen->id }}</th>
                                <td>{{ $gen->title }}</td>
                                <td>{{ $gen->description }}</td>
                                <td>
                                    @if($gen -> status )
                                        Hiển thị
                                    @else  
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'delete','route' => ['country.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                    {!! Form::close() !!}                                
                                </td>
                                <td>
                                    <a href="{{route('country.edit', $gen->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
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
