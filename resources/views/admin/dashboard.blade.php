@extends('layouts.main')
@section('head')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Tempusdominus Bootstrap 4 -->
@endsection
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row mt-3">
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
                <a href="/admin/movies/movie" class="small-box-footer">Xem thông tin <i
                        class="fas fa-arrow-circle-right"></i></a>
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
                <a href="/admin/categories/category/create" class="small-box-footer">Xem thông tin <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$lstCountUser}}</h3>

                    <p>Tài khoản đã tạo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/users/user" class="small-box-footer">Xem thông tin <i
                        class="fas fa-arrow-circle-right"></i></a>
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
                <a href="/genre/create" class="small-box-footer">Xem thông tin <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- /.card-header -->
    <div class="container-fluid">
        <p>Thống kê doanh thu</p>
        <form action="" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="">Từ ngày</label>
                    <input type="text" id="datepicker" class="form-control btn-sm" placeholder="">

                </div>
                <div class="col-md-2">
                    <label for="">Đến ngày</label>
                    <input type="text" id="datepicker2" class="form-control btn-sm" placeholder="">
                </div>
                <div class="col-md-2">
                    <label for="">Lọc theo</label>
                    <select name="" id="" class="dashboard-filter form-control btn-sm">
                        <option value="7ngay">7 ngày</option>
                        <option value="thangtruoc">Tháng trước </option>
                        <option value="thangnay">Tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                        <option value="thang6">2 tháng gần đây</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Tra cứu</label>
                    <input type="button" id="btn-dashboard-filter" class="form-control btn btn-primary btn-sm"
                        value="Lọc kết quả">
                </div>
            </div>

        </form>
    </div>
</div>
<div class="col-md-12">
    <div id="myfirstchart" style="height: 250px;"></div>
</div>
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
                            <small class="badge badge-danger"><i class="far fa-eye"></i> Lượt xem
                                {{$views->views}}</small>
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
                            <span class="text">{{$rating->episode->movie->title}}||{{$rating->episode->episode}}</span>
                            <small class="badge badge-danger"><i class="far fa-star"></i> {{$rating->rating_star}}
                            </small>
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="ml-3 ">
            <div class="card-body ">
                <table class="table table-bordered" id="">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">Tháng</th>
                            <th scope="col" class="text-white">Tổng doanh thu theo tháng </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totals as $user )
                        <tr>
                            <td>{{$user->pay_date}}</td>
                            <td>
                                @php
                                    $number = $user->total_amount;
                                    
                                @endphp
                                {{number_format($number)}} vnd;
                                <!-- @if ($number < 1000000) 
                                @elseif ($number < 1000000000) 
                                        {{number_format($number / 1000000, 2)}}vnd;
                                @else
                                    {{ number_format($number / 1000000000, 2)}} . 'B';
                                
                                @endif -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mr-3 ">
            <div class="card-body ">
                <table class="table table-bordered" id="">
                        <thead>
                            <tr>
                                <th scope="col" class="text-white">Tổng doanh thu  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totals_money as $money)
                                <tr>
                                    <td>
                                        @php
                                            $number = $money->total_amount;
                                        @endphp
                                            {{number_format($number)}} vnd
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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


@section('footer')
<script type="text/javascript">
$(function() {
    $("#datepicker").datepicker({
        prevText: 'Tháng trước',
        nextText: 'Tháng sau',
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
    });
    $("#datepicker2").datepicker({
        prevText: 'Tháng trước',
        nextText: 'Tháng sau',
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
        duration: "slow"
    });

})
</script>

@endsection

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
        labelColor: "#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [{label:"User", value:{{$lstCountUser}}, color:colorDanger},
                {label:"Phim", value:{{$lstCountMovie}}},
                {label:"Danh mục", value:{{$lstCountCate}}},
                {label:"Thể loại", value:{{$lstCountGenres}}},
        ]
    });
})
</script>
<script>
$(document).ready(function() {
    chart30days();
    var chart = new Morris.Area({
        // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        //option
        lineColors: ['#819C79', '#FF6541', '#FF6541', '#FF6541'],
        pointColors: ['#ffffff'],
        pointStrokeColor: ['black'],
        fillOpacity: 0.6,
        hideHover: 'auto',
        parseTime: false,

        // The name of the data record attribute that contains x-values.
        xkey: 'PayDate',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['Amount', 'user_id'],

        behaveLikeLine: true,
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Số tiền', 'IDUser']
    });
    $('#btn-dashboard-filter').click(function() {
        // alert('oke');
        // var _token = $('input[name="token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content'),
            },
            url: "{{route('filter-by-date')}}",
            method: "POST",
            dataType: "json",
            data: {
                from_date: from_date,
                to_date: to_date
            },
            success: function(data) {
                chart.setData(data);
            }
        })
    });
    $('.dashboard-filter').change(function() {
        var dashboard_value = $(this).val();
        // var _token = $('input[name="_token"]').val();
        // alert(dashboard_value);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content'),
            },
            url: "{{ route('dashboard-filter')}}",
            method: "POST",
            dataType: "JSON",
            data: {
                dashboard_value: dashboard_value
            },
            success: function(data) {
                chart.setData(data);
            }
        })
    });

    function chart30days() {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{route('chart30days')}}",
            method: "POST",
            dataType: "json",
            data: {
                _token: _token
            },
            success: function(data) {
                chart.setData(data);
            }
        })
    }

})
</script>

@endsection