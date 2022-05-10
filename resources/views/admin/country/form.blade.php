@extends('layouts.main')

@section('content')
                    <div class="card-body img">
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
                                <div class="form-group text-white">
                                    {!! Form::label('title', 'Tên Quốc Gia', []) !!}
                                    {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'slug','onkeyup' => 'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group text-white">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($country) ? $country->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'Nhập nội dung','id' => 'description']) !!}
                                </div>
                                <div class="form-group text-white">
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
                    <table class="table-warning img" id="myTable">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Quốc gia</th>
                                <th scope="col" class="text-white">Mô tả</th>
                                <th scope="col" class="text-white">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lstCountry as $key => $gen)
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
@endsection
