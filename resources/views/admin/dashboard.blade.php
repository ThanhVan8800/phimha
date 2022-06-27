@extends('layouts.main')
@section('head')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
@endsection
@section('content')
<!-- Main content -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$lstCountMovie}}</h3>

                    <p>Tổng số phim</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/admin/movies/movie" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$lstCountCate}}</h3>

                    <p>Danh mục phim</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/admin/categories/category/create" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$lstCountUser}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                    <a href="/admin/users/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$lstCountGenres}}</h3>
                    <p>Thể loại phim</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/genre/create" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->
<!-- /.card-header -->
            <div class="container">
                <div class="row ">
                    <div class="col-6">
                        <div class="card-body ">
                            <h4 class="text-left">Phim có lượt xem cao nhất</h4>
                            <ol class="" data-widget="todo-list">
                            @foreach ($Episode_View as $views )
                                <li>
                                    <div class="form-group bg-light">
                                        <span class="text">{{$views->movie->title}} | </span>
                                        <span class="text badge badge-info">{{$views->movie->category->title}}</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-danger"><i class="far fa-eye"></i> Lượt xem {{$views->views}}</small>
                                        <!-- General tools such as edit or delete-->
                                    </div>
                                </li>
                            @endforeach
                            </ol>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-body ">
                            <h4>Phim có nhiều đánh giá sao nhất</h4>
                            <ol>
                                @foreach ($Count_rating as $rating )
                                    <li>
                                        <div class="form-group bg-light">
                                            <span class="text">{{$rating->episode->movie->title}}</span>
                                            <small class="badge badge-danger"><i class="far fa-star"></i> {{$rating->rating_star}} </small>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div id="donut">

                        </div>
                    </div>
                </div>
            </div>
                <!-- /.card-body -->
                    
                    <div class="canvass">
                        <canvas id="canvas" width="250" height="250">
                        </canvas>
                    </div>
<style>
    .canvass{
        display:flex; justify-content:right;
    }
    
</style>
<script>
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
    drawFace(ctx, radius);
    drawNumbers(ctx, radius);
    drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
    var grad;
    ctx.beginPath();
    ctx.arc(0, 0, radius, 0, 2*Math.PI);
    ctx.fillStyle = 'white';
    ctx.fill();
    grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
    grad.addColorStop(0, '#333');
    grad.addColorStop(0.5, 'white');
    grad.addColorStop(1, '#333');
    ctx.strokeStyle = grad;
    ctx.lineWidth = radius*0.1;
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
    ctx.fillStyle = '#333';
    ctx.fill();
    }

    function drawNumbers(ctx, radius) {
    var ang;
    var num;
    ctx.font = radius*0.15 + "px arial";
    ctx.textBaseline="middle";
    ctx.textAlign="center";
    for(num = 1; num < 13; num++){
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius*0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius*0.85);
        ctx.rotate(-ang);
    }
    }

    function drawTime(ctx, radius){
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        //hour
        hour=hour%12;
        hour=(hour*Math.PI/6)+
        (minute*Math.PI/(6*60))+
        (second*Math.PI/(360*60));
        drawHand(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>
<script>
        $(document).ready(function() {
            var colorDanger = "#FF1744";
            Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#E0F7FA',
                '#B2EBF2',
                '#80DEEA',
                '#4DD0E1',
                '#26C6DA',
                '#00BCD4',
                '#00ACC1',
                '#0097A7',
                '#00838F',
                '#006064'
            ],
            labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [
                {label:"User", value:{{$lstCountUser}}, color:colorDanger},
                {label:"Phim", value:{{$lstCountMovie}}},
                {label:"Dato Ej.3", value:{{$lstCountCate}}},
                {label:"Dato Ej.4", value:{{$lstCountGenres}}},
            ]
            });
        })
        

    </script>          
            
@endsection
