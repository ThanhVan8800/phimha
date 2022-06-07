@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>

@endsection 
@section('content')
    <div class="card-body ">
            <a href="{{route('movie.index')}}"><button>Danh sách phim</button></a>
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
                        {!! Form::label('Year', 'Year', []) !!}
                        {!! Form::text('year', isset($movie) ? $movie->year : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'year']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Trailer', 'Trailer', []) !!}
                        {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'trailer']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Tags', 'Tags', []) !!}
                        {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'tags']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('Name_eng', 'Phim tên Tiếng Anh', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class' => 'form-control col-md-8', 'placeholder' =>'điền đi','id' => 'name_eng']) !!}

                            {!! Form::label('Name_eng', 'Đạo diễn', []) !!}
                            {!! Form::text('director', isset($movie) ? $movie->director : '', ['class' => 'form-control col-md-8', 'placeholder' =>'điền đi','id' => 'director']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('movie_duration', 'Thời lượng phim', []) !!}
                            {!! Form::text('movie_duration', isset($movie) ? $movie->movie_duration : '', ['class' => 'form-control col-md-8 ', 'placeholder' =>'điền đi','id' => 'movie_duration']) !!}

                            {!! Form::label('Name_eng', 'Tên diễn viên', []) !!}
                            {!! Form::text('actor', isset($movie) ? $movie->actor : '', ['class' => 'form-control col-md-8', 'placeholder' =>'điền đi','id' => 'actor']) !!}

                            
                        </div>
                        <div class="col-md-4">
                        {!! Form::label('resolution', 'Resolutions',[]) !!}
                        {!! Form::select('resolution', ['0' => 'HD', '1' => 'SD', '2' => 'HDCam','3' => 'Cam','4' => 'FullHD','5'=>'Trailer'], isset($movie) ? $movie->resolution :'', ['class' => 'form-control col-md-8', 'placeholder' =>'điền đi']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'Phụ đề',[]) !!}
                        {!! Form::select('subtitle', ['0' => 'Vietsub', '1' => 'Thuyết minh'], isset($movie) ? $movie->subtitle :'', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('PhimHot', 'Phim Hot', []) !!}
                        {!! Form::select('film_hot', ['1' => 'Hot' , '0' => 'Không hot'], isset($movie) ? $movie->film_hot : '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Episode', 'Tập Phim', []) !!}
                        {!! Form::text('episode_film', isset($movie) ? $movie->episode_film : '', ['class' => 'form-control', 'placeholder' =>'điền đi','id' => 'episode']) !!}
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
                        {!! Form::label('belonging_movie', 'Phim thuộc',[]) !!}
                        {!! Form::select('belonging_movie', ['0' => 'Phim lẻ', '1' => 'Phim bộ'], isset($movie) ? $movie->belonging_movie :'', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Category', 'Danh mục', []) !!}
                        {!! Form::select('category_id', $category ,isset($movie) ? $movie->category_id : ''  , ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Genre', 'Loại phim', []) !!}<br>
                        <!-- {!! Form::select('genre_id', $genre ,isset($movie) ? $movie->genre_id : ''   , ['class' => 'form-control', 'placeholder' =>'điền đi']) !!} -->
                        @foreach ($lstGenre as $key => $genre)
                            @if(isset($movie))
                                        {!! Form::checkbox('genre[]',$genre->id, isset($movie_genre) && $movie_genre -> contains($genre->id) ? true : false)!!}
                                        <!-- contains dùng để cho check  phim chứa nhiều loại phim -->
                                        {!!Form::label('genre',$genre->title) !!}
                            @else
                                        {!! Form::checkbox('genre[]',$genre->id, '')!!}
                                        {!!Form::label('genre',$genre->title) !!}
                            @endif
                        @endforeach
                        
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
@endsection
@section('footer')
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>

@endsection