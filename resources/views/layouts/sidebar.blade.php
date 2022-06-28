  <!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link">
            <img src="/templates/admin/dist/img/flower.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Phim_ThanhVan</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            @if(Auth::user()->thumb)
                                <img src="{{Auth::user()->thumb}}" class="img-circle elevation-2" alt="User Image">
                            @else
                                <img src="http://127.0.0.1:8000/storage/user_none.jpg" class="img-circle elevation-2" alt="User Image">
                            @endif

                        </div>
                        <div class="info">
                        <a href="/admin/users/info" class="d-block">
                            {{ Auth::user()->name }}
                        </a>
                        </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                                <a href="{{route('home')}}" class="">
                                <i class="nav-icon fa-solid fa-house"></i>
                                    Trang chủ
                                </a>
                                <!--  Thống kê -->
                                <a href="{{route('dashboard')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-bars-staggered"></i>
                                    Thống kê
                                </a>
                                <a href="{{route('category.create')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-bars-staggered"></i>
                                    Danh mục phim
                                </a>
                                <!-- Sản phẩm -->
                                <a  class="nav-link" href="{{route('genre.create')}}">
                                    <i class="nav-icon fa-solid fa-indent"></i>
                                        Thể loại
                                
                                </a>
                                <a href="{{route('country.create')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-earth-asia"></i>
                                        Quốc gia
                                </a>
                                <a href="{{route('movie.create')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-film"></i>
                                        Phim
                                </a>
                                <a href="{{route('episode.create')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-video"></i>
                                        Tập phim
                                </a>
                                <a href="{{route('user.index')}}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-users"></i>
                                        Quản lí tài khoản
                                </a>
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item menu-open">
                                        <a href="{{route('film_package')}}" class="nav-link ">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>
                                            Danh sách gói phim Vip
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{route('vnpay')}}" class="nav-link">
                                            <p>Khách hàng thanh toán</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('film_package')}}" class="nav-link">
                                            <p>Hạn dùng</p>
                                            </a>
                                        </li>
                                        </ul>
                                    </li>
                                </ul>
                                <a href="/admin/userlog-activities" class="nav-link">
                                    <i class="nav-icon fa-solid fa-book-medical"></i>
                                        Nhật ký hoạt động
                                </a>
                                <li class="nav-item menu-open">
        
                                
        
                                @auth
                                    <label for="" class="nav-link text-white">{{Auth::user()->name}} |</label>    
                                    <form method="post" action="{{route('logout_ad')}}">
                                        @csrf 
                                            <button type="submit" class="btn  text-white" name=""> 
                                                <i class="fas fa-sign-out-alt"></i>
                                                Logout
                                            </button>
                                    </form>
                                @endauth
                                
                    </nav>
            <!-- /.sidebar-menu -->
                </div>
            <!-- /.sidebar -->
</aside>