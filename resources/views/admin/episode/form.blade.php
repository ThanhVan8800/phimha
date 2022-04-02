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
                    @if(!isset($episode))
                        {!! Form::open(['route' => 'episode.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route' => 'episode.update','method'=>'PUT']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('linkphim', 'Link Phim', []) !!}
                        {!! Form::text('linkphim', '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episode', 'Tap Phim', []) !!}
                        {!! Form::text('episode', '', ['class' => 'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Phim', ' Phim', []) !!}
                        {!! Form::select('movie_id',[], isset($movie) ? $movie->title : '', ['class' =>'form-control', 'placeholder' =>'điền đi']) !!}
                    </div>
                    @if(!isset($episode))
                                        {!! Form::submit('Thêm phim', ['class' => 'btn btn-primary']) !!}
                                @else
                                
                                        {!! Form::submit('Cập nhật phim', ['class' => 'btn btn-primary']) !!}
                                @endif
                    {!! Form::close() !!}
                    </div>
                    <table class="table-warning" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Link Phim</th>
                    <th scope="col">Phim</th>
                    <th scope="col">Tap Phim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lstEpisode as $key => $movi)
                        <tr>
                                <th scope="row">{{ $movi->id }}</th>
                                <td>{{ $movi->linkphim }}</td>
                                <td>
                                    {{$movi->movie_id}}
                                </td>
                                <td>
                                    {{$movi->episode}}
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'delete','route' => ['episode.destroy', $movi->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                    {!! Form::close() !!}                                
                                </td>
                                <td>
                                    <a href="{{route('episode.edit', $movi->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
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