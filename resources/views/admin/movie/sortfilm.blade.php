@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 60%;
    }

    #sortable li {
        margin: 0 5px 5px 5px;
        padding: 5px;
        font-size: 1.2em;
        height: 1.5em;
    }

    html>body #sortable li {
        height: 1.5em;
        line-height: 1.2em;
    }

    .ui-state-highlight {
        height: 1.5em;
        line-height: 1.2em;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 cate_position" id="sortable">
                @foreach ($lstCate as $key => $value)
                <li id="{{$value->id}}"
                    class="nav-item ui-state-default {{ request()->route()->getName() == '$value->title'? 'active': '' }} ">
                    {{$value->title}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
<div>
    @foreach ($category_home as $key=>$value )
    <h2>{{$value->title}}</h2>
    <div class="row movie_position sortable_movie">
        @foreach ($value->movie->sortBy('position')->take(16) as $mov )
        <div class="col-lg-2 col-md-3 col-sm-12 col-xs-12 box_phim" id="{{$mov->id}}">
            <figure>
                <img src="{{asset('uploads/movie/'.$mov->image)}}" alt="" class="img-responsive" width="100%">
                <p>{{$mov->title}}</p>
            </figure>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$(function() {
    $("#sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function(event, ui) {
            var array_id = [];
            $('.cate_position li').each(function() {
                array_id.push($(this).attr('id'));
            })
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('resorting_cate')}}",
                method: "POST",
                data: {
                    array_id: array_id
                },
                success: function(data) {
                    alert('Success');
                }
            })
        }
    });
    $("#sortable").disableSelection();
});
</script>
<script>
$(function() {
    $(".sortable_movie").sortable({
        update: function(event, ui) {
            var array_id = [];
            $('.movie_position div').each(function() {
                array_id.push($(this).attr('id'));
            })
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('resorting_movie')}}",
                method: "POST",
                data: {array_id: array_id},
                success: function(data) {
                    alert('Success');
                }
            })
        }
    });
    $("#.sortable_movie").disableSelection();
});
</script>
@endsection