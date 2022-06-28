@extends('layouts.main')

@section('content')
                    <div class="card-body img">
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
                            <form action="" method="post" >
                                @csrf
                                <div class="form-group text-white">
                                        <label for="">Ngày mua gói VIP</label>
                                        <input type="date" name="PayDate" class="form-control" value="" required>
                                        @error('PayDate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group text-white">
                                        <label for="">Ngày hết hạn VIP</label>
                                        <input type="date" name="EndDate" class="form-control" value="" required>
                                        @error('EndDate')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group text-white">
                                    <button class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>   
                    </div>
                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        
                    </div>
                
                    <table class="table-dark " id="">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">ID</th>
                                    <th scope="col" class="text-white">Name</th>
                                    <th scope="col" class="text-white">Email</th>
                                    <th scope="col" class="text-white">Số điện thoại</th>
                                    <th scope="col" class="text-white">Ngày mua gói VIP</th>
                                    <th scope="col" class="text-white">Ngày hết gói VIP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($lstUserVip as $key=>$user)
                                    <tr>
                                            <td scope="row" class="text-white">{{$user->id}}</td>
                                            <td class="text-white">{{$user->name}}</td>
                                            <td class="text-white">{{$user->email}}</td>
                                            <td class="text-white">
                                                @if ($user->phone_number)
                                                    {{$user->phone_number}}
                                                @else
                                                    Đang cập nhật
                                                @endif
                                            </td>
                                            <td class="text-white" value="">
                                                @if ($user->PayDate)
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->PayDate)->format('Y-m-d') }}
                                                @else 
                                                    Đang cập nhật
                                                @endif
                                            </td>
                                            <td class="text-white">
                                                @if ($user->EndDate)
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->EndDate)->format('Y-m-d') }}
                                                @else 
                                                    Đang cập nhật
                                                @endif
                                            </td>
                                            <td class="text-white">
                                                <a href="{{route('film_package.edit', $user->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                    </tr>
                                @endforeach
                                    
                                
                            </tbody>
                    </table>  
                    <div>
                    
                    </div>    
                
@endsection

