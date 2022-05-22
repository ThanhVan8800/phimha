@extends('layouts.main')

@section('content')
                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- kiểm tra nếu không tồn tại dùng form store -->
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <a href="{{route('user.create')}}" class="btn btn-primary">Thêm tài khoản</a>
                        @endif
                    </div>
                    <table class="table-dark " id="myTable">
                            <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Name</th>
                                <th scope="col" class="text-white">Email</th>
                                <th scope="col" class="text-white">Thumb</th>
                                <th scope="col" class="text-white">Vai trò</th>
                                <th scope="col" class="text-white">Address</th>
                                <th scope="col" class="text-white">Phone Number</th>
                                <th scope="col" class="text-white">Trạng thái </th>
                                <th scope="col" class="text-white">Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lstUser as $user)
                                    <tr>
                                            <th scope="row" class="text-white">{{$user->id}}</th>
                                            <td class="text-white">{{$user->name}}</td>
                                            <td class="text-white">{{$user->email}}</td>
                                            <td class="text-white">
                                                @if ($user->thumb)
                                                    <img src="{{$user->thumb}}" alt="" style="width:125px; max-height:250px"> 
                                                @else
                                                    <img src="http://127.0.0.1:8000/storage/user_none.jpg" alt="" style="width:125px; max-height:250px"> 
                                                @endif
                                            </td>
                                            <td class="text-white">{{$user->role}}</td>
                                            <td class="text-white">{{$user->address}}</td>
                                            <td class="text-white">{{$user->phone_number}}</td>
                                            <td class="text-white">
                                                @if ($user->status == '1')
                                                    Hoạt động
                                                @else 
                                                    Ngưng hoạt động
                                                @endif
                                            </td>
                                            <td class="text-white">{{$user->created_at}}</td>
                                            <td>
                                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                    <a href="#"  class="btn btn-outline-danger"
                                                        onclick="removeRow( {{ $user -> id }} , '/admin/users/user/destroy' )" >
                                                        <i class="far fa-trash-alt"></i> Xóa 
                                                    </a>
                                                    <a href="/admin/users/user/show/{{$user->id}}">
                                                        <button class="btn btn-outline-warning">
                                                            <i class="fa-solid fa-book-open-reader"></i>
                                                            Chi tiết
                                                        </button> 
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                
                                            </td>
                                            
                                    </tr>
                                @endforeach
                                    
                                
                            </tbody>
                    </table>  
                    <div>
                        {{$lstUser->links("pagination::bootstrap-5")}}
                    </div>    
                
@endsection

@section('footer')
<!-- Xóa tài khoàn user quản lý   -->
    <script>
        function removeRow(id, url) {
            if (confirm('Xóa và không thể khôi phục. Bạn có chắc ?')) {
                $.ajax({
                    type: 'DELETE',
                    datatype: 'JSON',
                    data: { id },
                    url: url,
                    success: function(result) {
                        if (result.error === false) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Xóa lỗi vui lòng thử lại');
                        }
                    }
                })
            }
        }
    </script>
@endsection
