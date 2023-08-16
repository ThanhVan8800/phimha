@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table-dark bg-navy" border="5" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">Tên phim</th>
                            <th scope="col" class="text-white">Slug</th>
                            <th scope="col" class="text-white">Origin name</th>
                            <th scope="col" class="text-white">Thumb</th>
                            <th scope="col" class="text-white">Poster</th>
                            <th scope="col" class="text-white">Year</th>
                            <th>Quản lý</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="order_position22" id="lst">
                        @foreach($resp['items'] as $key => $gen)
                        <tr id="">
                            <td scope="row" class="text-white"> {{$gen['name']}} </td>
                            <td scope="row" class="text-white"> {{$gen['slug']}} </td>
                            <td scope="row" class="text-white"> {{$gen['origin_name']}} </td>
                            <td scope="row" class="text-white">
                                <img src="https://img.ophim8.cc/uploads/movies/{{$gen['thumb_url']}}"
                                    style="width:100px;max-height:200px;object-fit:contain"
                                    alt="{{$gen['thumb_url']}}">    
                            </td>
                            <td scope="row" class="text-white">
                                <img src="{{$resp['pathImage'].$gen['poster_url']}}"
                                    style="width:100px;max-height:200px;object-fit:contain"
                                    alt="{{$gen['thumb_url']}}">
                            </td>
                            <td scope="row" class="text-white"> {{$gen['year']}} </td>
                            <td>{{$resp['pagination']['totalPages']}}</td>
                            <td> <a href="{{route('leech-phim-detail',$gen['slug'])}}" target="_blank">Chi tiết phim</a> </td>
                            
                        </tr>
                        @endforeach
                    

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <form action="{{url('/downloadPDF')}}" method="get">
                            @csrf
                            <button class="btn btn-primary">Tải về</button>
                    </form>     -->
@endsection
@section('footer')
@section('footer')
@endsection