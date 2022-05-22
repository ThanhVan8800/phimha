
                    <table class="table-warning img" id="">
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
                                            
                                    </tr>
                                @endforeach
                                
                            </tbody>
                    </table>            

