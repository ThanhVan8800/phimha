  <!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link">
            <img src="/templates/admin/dist/img/flower.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="/templates/admin/dist/img/yua-mikami.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
                            <a href="{{route('home')}}">Trang chủ</a>
                            
                                <a href="{{route('category.create')}}" class="nav-link">
                                    Danh mục phim
                                </a>
                            
                            <!-- Sản phẩm -->
                            
                                <a  class="nav-link" href="{{route('genre.create')}}">Thể loại
                                
                                </a>
                                
                        
                        
                                <a href="{{route('country.create')}}" class="nav-link">
                                        Quốc gia
                                
                                </a>
                            
                        
                                <a href="{{route('movie.create')}}" class="nav-link">
                                        Phim
                                
                                </a>
                            
                        
                                <a href="{{route('episode.create')}}" class="nav-link">
                                        Tập phim
                                
                                </a>
                        
                    </nav>
            <!-- /.sidebar-menu -->
                </div>
            <!-- /.sidebar -->
</aside>