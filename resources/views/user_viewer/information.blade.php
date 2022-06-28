    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title}}  </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/templates/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/templates/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/templates/admin/dist/css/adminlte.min.css">
    <link href="/css/support.css" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if(Auth::user()->thumb)
                            <img src="{{Auth::user()->thumb}}" class="profile-user-img img-fluid img-circle" alt="User profile picture" >
                        @else
                            <img class="profile-user-img img-fluid img-circle"
                            src="/templates/admin/dist/img/user4-128x128.jpg"
                            alt="User profile picture">
                        @endif
                    </div>

                    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Email</strong>

                    <p class="text-muted">
                        {{Auth::user()->email}}
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Số điện thoại</strong>

                    <p class="text-muted">
                        @if (Auth::user()->phone_number)
                            {{Auth::user()->phone_number}}
                        @else  
                            Chưa có
                        @endif
                    </p>
                    <hr>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                            <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin tài khoản</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Ngày bạn tham gia trang của chúng tôi</strong>
                                <p class="text-muted">
                                    {{Auth::user()->created_at}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i>Ngày đăng ký gói VIP</strong>
                                    <p class="text-muted">
                                        @if (Auth::user()->PayDate)
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->PayDate)->format('Y-m-d') }}
                                        @else  
                                            Chúng tôi sẽ cập nhật trong 7 ngày
                                        @endif
                                    </p>
                                <hr>
                                <strong><i class="fas fa-pencil-alt mr-1"></i> Ngày hết hạn gói VIP</strong>
                                <p class="text-muted">
                                    @if (Auth::user()->EndDate)
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->EndDate)->format('Y-m-d') }}
                                    @else  
                                        Chúng tôi sẽ cập nhật trong 7 ngày
                                    @endif
                                </p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Hỏi đáp</strong>
                                <p class="text-muted">
                                    Mọi thắc mắc vui lòng gửi về email: thanh07345@gmail.com
                                </p>
                            </div>
                        </div><!-- /.card-body -->
                    </div>  
                    <a href="{{route('homepage')}}" class="btn btn__neon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Quay về trang chủ
                    </a>
                </div><!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
                @include('footer')
        <!-- /.content -->
        <script src="/templates/admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/templates/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/templates/admin/dist/js/adminlte.min.js"></script>
        <script src="/templates/admin/js/main.js"></script>
        </body>
    </html>