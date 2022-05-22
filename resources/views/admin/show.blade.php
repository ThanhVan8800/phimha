<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <thead>
                                <tr>
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Quốc gia</th>
                                <th scope="col" class="text-white">Mô tả</th>
                                <th scope="col" class="text-white">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lstCountry as $key => $gen)
                                    <tr>
                                            <th scope="row" class="text-white">{{ $gen->id }}</th>
                                            <td class="text-white">{{ $gen->title }}</td>
                                            <td class="text-white">{{ $gen->description }}</td>
                                            <td class="text-white">
                                                @if($gen -> status )
                                                    Hiển thị
                                                @else  
                                                    Không hiển thị
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method'=>'delete','route' => ['country.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có muốn xóa?")']) !!}
                                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-dark btn-sm', 'style' => 'height:40px; width:40px'] )  }}
                                                {!! Form::close() !!}                                
                                            </td>
                                            <td>
                                                <a href="{{route('country.edit', $gen->id)}}" class="btn btn-warning" style = "height:40px; width:40px"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                    </tr>
                                @endforeach
                                <form action="{{url('/downloadPDF')}}" method="get">
                                    @csrf
                                    <button>Tải</button>
                                </form>
                                
                            </tbody>
    </table>
</body>
</html>