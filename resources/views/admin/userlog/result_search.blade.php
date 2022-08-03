@extends('layouts.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
.border {
    border-radius: 10px;
}
</style>
@endsection
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  ">
                <div class="card-header">{{ __('Dashboard') }}</div> -->
<div class="card-body img">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <!-- kiểm tra nếu không tồn tại dùng form store -->

</div>
<div class="card-body table-responsive p-0">
    <div class="form-group container ml-3">
        <form action="{{route('searchUserlog')}}" method="get">
            <label>Chọn thời gian</label><br>
            <input type="date" class="border border-warning" name="fromDate">
            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
            <input type="date" class="border border-warning" name="toDate">
            <input type="text" name="name" id="" class="border" style="margin-left: 20%;"
                placeholder="Tìm kiếm danh mục phim" />
            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i>Tìm</button>
        </form>
    </div>
    <table class="table  text-nowrap " id="">
        <thead>
            <tr>
                <th scope="col" class="text-white">ID</th>
                <th scope="col" class="text-white">Tên tài khoản</th>
                <th scope="col" class="text-white">Email</th>
                <th scope="col" class="text-white">Địa chỉ</th>
                <th scope="col" class="text-white">Thời gian tác động</th>
                <th scope="col" class="text-white">Thao tác thực hiện</th>
            </tr>
        </thead>
        <tbody class="" id="">
            @foreach($query as $key => $usLog)
            <tr id="{{$usLog->id}}">
                <td scope="row" class="text-white">{{$key}} </td>
                <td class="text-white">{{ $usLog->name }}</td>
                <td class="text-white">{{ $usLog->email }}</td>
                <!-- !! để thực thi đọc html -->
                <td class="text-white">{{ $usLog->address }}</td>
                <td class="text-white">
                    {{$usLog->date_time}}
                </td>
                <td>
                    {{$usLog->modify_user}}
                </td>
                <td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{$query->links("pagination::bootstrap-5")}}
    </div>
</div>
<div>
</div>

@endsection