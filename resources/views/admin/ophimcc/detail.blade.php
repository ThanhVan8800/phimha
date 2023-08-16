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
                        @foreach($resp_movie as $key => $gen)
                        <tr id="">
                            <td scope="row" class="text-white"> {{$gen['name']}} </td>
                            
                            
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