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
                    <a href="{{route('movie.index')}}"><button>Danh sách phim</button></a>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        @if(!isset($movie))
                            {!! Form::open(['route'=>'movie.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route'=>['movie.update', $movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                        @endif
                                <div class="form-group">
                                    {!! Form::label('title', 'Tiêu đề', []) !!}
                                    {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'slug','onkeyup' => 'ChangeToSlug()']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Slug', 'Slug', []) !!}
                                    {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'convert_slug']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description','Mô tả', []) !!}
                                    {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style' => 'resize:none','class' => 'form-control', 'placeholder' =>'điền đi','id' => 'content']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('image', 'Hình ảnh', []) !!}
                                    {!! Form::file('image', ['class' => 'form-control-file']) !!}
                                    @if(isset($movie))
                                    <img src="{{asset('uploads/movie/'.$movie->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($movie->image)}}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Category', 'Danh mục', []) !!}
                                    {!! Form::select('category_id', $category ,isset($movie) ? $movie->category_id : ''  , ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Genre', 'Loại phim', []) !!}
                                    {!! Form::select('genre_id', $genre ,isset($movie) ? $movie->genre_id : ''   , ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Country', 'Quốc gia', []) !!}
                                    {!! Form::select('country_id', $country ,isset($movie) ? $movie->country_id : ''   , ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::label('Active','Trạng thái', []) !!}
                                    {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($movie) ? $movie->status : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                                </div>
                                @if(!isset($movie))
                                        {!! Form::submit('Thêm phim', ['class' => 'btn btn-primary']) !!}
                                @else
                                
                                        {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                                @endif
                            {!! Form::close() !!}
                    </div>
                    
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

@endsection