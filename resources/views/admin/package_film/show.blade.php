@extends('layouts.main')

@section('content')
                    <table class="table-dark " id="">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-white">ID</th>
                                    <th scope="col" class="text-white">Amount</th>
                                    <th scope="col" class="text-white">BankCode</th>
                                    <th scope="col" class="text-white">CardType</th>
                                    <th scope="col" class="text-white">OrderInfo</th>
                                    <th scope="col" class="text-white">TmnCode</th>
                                    <th scope="col" class="text-white">PayDate</th>
                                    <th scope="col" class="text-white">EndDate</th>
                                    <th scope="col" class="text-white">User Name</th>
                                </tr>
                            </thead>
                            <tbody id="">
                            
                                @foreach ($lstUserPay as $key=>$user)
                                    <tr>
                                            <td scope="row" class="text-white">{{$user->id}}</td>
                                            <td class="text-white">{{$user->Amount}}</td>
                                            <td class="text-white">{{$user->BankCode}}</td>
                                            <td class="text-white">{{$user->CardType}}</td>
                                            <td class="text-white">{{$user->OrderInfo}}</td>
                                            <td class="text-white">{{$user->TmnCode}}</td>
                                            <td class="text-white" value="">
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->PayDate)->format('Y-m-d') }}
                                            </td>
                                            <td class="text-white">
                                                @if ($user->Amount == 60000)
                                                    @php
                                                        $start_date = $user->PayDate;  
                                                        $date = strtotime($start_date);
                                                        $date = strtotime("+60 day", $date);
                                                        echo date('Y-m-d', $date);
                                                    @endphp
                                                @elseif ($user->Amount == 180000)
                                                    @php
                                                        $start_date = $user->PayDate;  
                                                        $date = strtotime($start_date);
                                                        $date = strtotime("+180 day", $date);
                                                        echo date('Y-m-d', $date);
                                                    @endphp
                                                @else
                                                    @php
                                                        $start_date = $user->PayDate;  
                                                        $date = strtotime($start_date);
                                                        $date = strtotime("+365 day", $date);
                                                        echo date('Y-m-d', $date);
                                                    @endphp
                                                @endif
                                            </td>
                                            <td class="text-white">
                                                {{$user->user_id}} | {{$user->user->name}}
                                            </td>
                                    </tr>
                                @endforeach
                                    
                                
                            </tbody>
                    </table>  
                    <div>
                    
                    </div>    
                
@endsection

