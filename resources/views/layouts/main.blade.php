
<!DOCTYPE html>
<html lang="en">
<head>
        @include('layouts.head')
        
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper img">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            </ul>
            
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
        
            <!-- Notifications Dropdown Menu -->
            <a href="/admin/users/info" class="brand-link">
                @php
                    $thumb = '/storage/'.Auth::user()->thumb
                @endphp
                @if(Auth::user()->thumb)
                    <img src="{{Auth::user()->thumb}}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: 1.8">
                @else 
                <img src="http://127.0.0.1:8000/storage/user_none.jpg" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: 1.8">
                @endif
            </a>
            <span class="brand-text font-weight-dark">
                    @auth
                        <label for="">Xin chào</label> <br />
                        <label for="">{{Auth::user()->name}} </label>
                    @endauth
            </span>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            
            </ul>
        </nav>
        <!-- /.navbar -->

    @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                
                    <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card bg-navy color-palette mt-1">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-bottom: -1px;">{{$title}}<!-- <small>jQuery Validation</small>--></h3>
                        </div>
                        <!--NOI DUNG GHI O DAY-->
                            @include('layouts.alert')
                            @yield('content')
                            
                    <!-- right column -->
                    <div class="col-md-6">
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            </div>
        </footer>

        
</div>
<!-- ./wrapper -->
@include('layouts.footer')

</body>
</html>
