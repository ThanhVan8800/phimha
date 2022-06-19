@extends('layouts.main')

@section('content')
<h5 class="mb-2">Custom Shadows Variations <small><i>Using Bootstrap's Shadow Utility</i></small></h5>
<div class="container">

<div class="row align-items-center">
    <div class="col ">
<div id="data">

                <!-- DIRECT CHAT WARNING -->
                <div class="card card-widget card-warning direct-chat direct-chat-warning shadow " style="height:550px;">
                <div class="card-header">
                    <h3 class="card-title">Shadow - Regular</h3>

                    <div class="card-tools">
                    <span title="3 New Messages" class="badge bg-danger">3</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height:100%;">
                    <!-- Message. Default to the left -->
                    <div id="data">
                        @foreach($chats as $ch)
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">{{$ch->author}}</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="/templates/admin/dist/img/user1-128x128.jpg" alt="Message User Image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                {{$ch->content}}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    
                    <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <form action="{{route('chat.store')}}" method="post" id="">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="content"
                                name="content" placeholder="Type Message ..." 
                                class="form-control @error('content') is-invalid @enderror" 
                                value="{{old('content')}}" required>
                        <span class="input-group-append">
                        <button type="submit" class="btn btn-warning">Send</button>
                        </span>
                    </div>
                    </form>
                </div>
                <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
            <!-- /.col -->

        
            <!-- /.col -->
            </div>

</div>
</div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.3/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/socket.io/socket.io.js"></script>
<script>
    var socket = io('http://localhost:6001')
    
    socket.on('demo_database_chat:message', function(data) {
        console.log(data);
        if($('#' + data.id).length == 0){
            $('#data').append('<p><strong>' +data.author+'</strong>:'+ data.content+ '</p>'); 
        }
        else{
            console.log('Đã có tin nhắn')
        }
    })
</script>