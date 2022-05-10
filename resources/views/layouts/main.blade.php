
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
            <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        
</div>
<!-- ./wrapper -->
@include('layouts.footer')

</body>
</html>
