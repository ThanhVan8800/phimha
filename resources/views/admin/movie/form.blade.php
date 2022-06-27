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
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <!-- kiểm tra nếu không tồn tại dùng form store -->
            @if(!isset($movie))
                {!! Form::open(['route'=>'movie.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            @else
                {!! Form::open(['route'=>['movie.update', $movie->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
            @endif
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('title', 'Tên phim', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'placeholder' =>'Nhập tên phim mới','id' => 'slug','onkeyup' => 'ChangeToSlug()']) !!}
                                @error('title')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('Slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'placeholder' =>'Auto','id' => 'convert_slug']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('Year', 'Năm phát hành', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::text('year', isset($movie) ? $movie->year : '', ['class' => 'form-control', 'placeholder' =>'Nhập năm phát hành phim','id' => 'year']) !!}
                                @error('year')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                            {!! Form::label('Episode', 'Tập Phim', []) !!}
                            {!! Form::text('episode_film', isset($movie) ? $movie->episode_film : '', ['class' => 'form-control', 'placeholder' =>'Nhập số tập phim(phim lẻ có thể không điền)','id' => 'episode']) !!}
                            @error('episode_film')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Tags', 'Tags', []) !!}
                        {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['class' => 'form-control','rows' => '5','placeholder' =>'Tags phim','id' => 'tags']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('movie_duration', 'Thời lượng phim', []) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::text('movie_duration', isset($movie) ? $movie->movie_duration : '', ['class' => 'form-control col-md-8 ', 'placeholder' =>'Nhập thời lượng phim','id' => 'movie_duration']) !!}
                            @error('movie_duration')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {!! Form::label('PhimHot', 'Phim Hot', []) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::select('film_hot', ['1' => 'Hot' , '0' => 'Không hot'], isset($movie) ? $movie->film_hot : '', ['class' => 'form-control col-md-8', 'placeholder' =>'--Chọn phim hot hoặc không--']) !!}
                            @error('film_hot')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('resolution', 'Định dạng phim',[]) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::select('resolution', ['0' => 'HD', '1' => 'SD', '2' => 'HDCam','3' => 'Cam','4' => 'FullHD','5'=>'Trailer'], isset($movie) ? $movie->resolution :'', ['class' => 'form-control col-md-8', 'placeholder' =>'--Chọn loại định dạng   phim--']) !!}
                            @error('resolution')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {!! Form::label('subtitle', 'Phụ đề',[]) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::select('subtitle', ['0' => 'Vietsub', '1' => 'Thuyết minh'], isset($movie) ? $movie->subtitle :'', ['class' => 'form-control col-md-8', 'placeholder' =>'--Chọn phụ đề phim']) !!}
                            @error('subtitle')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('Trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control col-md-8', 'placeholder' =>'Nhập Trailer','id' => 'trailer']) !!}
                            {!! Form::label('', 'Phim Vip', []) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::select('film_vip',['1' => 'Phim thường', '2' => 'Phim Vip'], isset($movie) ? $movie->film_vip : '', ['class' => 'form-control col-md-8', 'placeholder' =>'Chọn dạng phim','id' => '']) !!}
                            @error('film_vip')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('Name_eng', 'Phim tên Tiếng Anh', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class' => 'form-control ', 'placeholder' =>'Tên Tiếng Anh','id' => 'name_eng']) !!}
                                @error('name_eng')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('director', 'Đạo diễn', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::text('director', isset($movie) ? $movie->director : '', ['class' => 'form-control ', 'placeholder' =>'Tên đạo diễn','id' => 'director']) !!}
                                @error('director')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            {!! Form::label('actor', 'Tên diễn viên', []) !!}
                            {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                            {!! Form::text('actor', isset($movie) ? $movie->actor : '', ['class' => 'form-control ', 'placeholder' =>'Tên diễn viên','id' => 'actor']) !!}
                            @error('actor')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Mô tả', []) !!}
                        {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                        {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style' => 'resize:none','class' => 'form-control','id' => 'content']) !!}
                        @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('image', 'Hình ảnh', []) !!}
                        {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                        {!! Form::file('image', ['class' => 'form-control-file']) !!}
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if(isset($movie))
                        <img src="{{asset('uploads/movie/'.$movie->image)}}" style="width:100px;max-height:100px;object-fit:contain" alt="{{asset($movie->image)}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('belonging_movie', 'Phim thuộc',[]) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::select('belonging_movie', ['0' => 'Phim lẻ', '1' => 'Phim bộ'], isset($movie) ? $movie->belonging_movie :'', ['class' => 'form-control', 'placeholder' =>'--Chọn phim thuộc--']) !!}
                                @error('belonging_movie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('Category', 'Danh mục', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::select('category_id', $category ,isset($movie) ? $movie->category_id : ''  , ['class' => 'form-control', 'placeholder' =>'--Chọn danh mục phim--']) !!}
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Genre', 'Loại phim', []) !!}
                        {!! Form::label('title', '*', ['class' => 'text-danger']) !!}<br>
                        
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
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('Country', 'Quốc gia', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::select('country_id', $country ,isset($movie) ? $movie->country_id : '', ['class' => 'form-control', 'placeholder' =>'--Chọn quốc gia của phim']) !!}
                                @error('country_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('Active','Trạng thái', []) !!}
                                {!! Form::label('title', '*', ['class' => 'text-danger']) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị danh mục phim' , '0' => 'Không hiện'], isset($movie) ? $movie->status : '', ['class' => 'form-control', 'placeholder' =>'Trạng thái hiển thị phim']) !!}
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('title', '* Là trường bắt buộc phải nhập', ['class' => 'text-danger']) !!}
                    </div>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'manage' && Auth::user()->status == '1')
                        @if(!isset($movie))
                                {!! Form::submit('Thêm phim', ['class' => 'btn btn-primary']) !!}
                        @else
                        
                                {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                        @endif
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