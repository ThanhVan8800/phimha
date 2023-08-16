   <!DOCTYPE html>
   <html lang="vi">
      <head>
         <meta charset="utf-8" />
         <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
         <meta name="theme-color" content="#234556">
         <meta http-equiv="Content-Language" content="vi" />
         <meta content="VN" name="geo.region" />
         <meta name="DC.language" scheme="utf-8" content="vi" />
         <meta name="language" content="Việt Nam">
         

         <link rel="shortcut icon" href="https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png" type="image/x-icon" />
         <meta name="revisit-after" content="1 days" />
         <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
         <title>Phim hay CKC - Xem phim hay nhất</title>
         <meta name="description" content="Phim hay 2021 - Xem phim hay nhất, xem phim online miễn phí, phim hot , phim nhanh" />
         <link rel="canonical" href="{{Request::url()}}">
         <link rel="next" href="" />
         <meta property="og:locale" content="vi_VN" />
         <meta property="og:title" content="Phim hay 2020 - Xem phim hay nhất" />
         <meta property="og:description" content="Phim hay 2020 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
         <meta property="og:url" content="{{Request::url()}}" />
         <meta property="og:site_name" content="Phim hay 2021- Xem phim hay nhất" />
         <meta property="og:image" content="" />
         <meta property="og:image:width" content="300" />
         <meta property="og:image:height" content="55" />
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
         <link rel='dns-prefetch' href='//s.w.org' />
         
         <link rel='stylesheet' id='bootstrap-css' href='{{asset('css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
      <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

         <link rel='stylesheet' id='style-css' href='{{asset('css/style.css?ver=5.7.2')}}' media='all' />
         <link rel='stylesheet' id='wp-block-library-css' href='{{asset('css/style.min.css?ver=5.7.2')}}' media='all' />
         <!-- dùng ajax thì cần phải có cái csrf-token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">
      
         <!-- Bootstrap -->
         @yield('head')
         <script type='text/javascript' src='{{asset('js/jquery.min.js?ver=5.7.2')}}'' id='halim-jquery-js'></script>
         <style type="text/css" id="wp-custom-css">
            .textwidget p a img {
            width: 100%;
            }
         </style>
         <style>#header .site-title {  background: url('/img/bg_tree.jpg') no-repeat top left;
                                       background-size: contain;
                                       text-indent: -9999px;
                                       border: 1px solid #ccc;
                                       border-radius: 25px 25px;
                                    }
               #header .site-logo{
                  border: 1px solid #ccc;
                  border-radius: 25px 25px;
                  text-indent: -9999px;
                  height:50px;
                  width: 100px;
                  background-size: contain;
               }
         </style>
      </head>
      <body class="home blog halimthemes halimmovies" data-masonry="">
         <header id="header">
            <div class="container">
               <div class="row" id="headwrap">
                  <div class="col-md-3 col-sm-6 slogan">
                     <p class="">
                        <a class="logo" href="" title="phim hay ">
                           
                           <img src="{{asset('uploads/info/'.$info->image)}}" class="site-logo" alt="">
                        </a>
                     </p>
                  </div>
                  <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                     <div class="header-nav">
                        <div class="col-xs-12">
                           <style type="text/css">
                              ul#result{
                                 position:absolute;
                                 z-index: 9999;
                                 background: #1b2d3c;
                                 width:94%;
                                 padding: 10px;
                                 margin:1px;
                              }
                           </style>
                           <div class="form-group form-timkiem">
                              <div class="input-group col-xs-12">
                                    <form action="{{route('tim-kiem')}}" method="GET">
                                       <input id="timkiem" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" >
                                       <div class="search-i">
                                          <button class="btn btn-warning btn__warning"><i class="fa-solid fa-magnifying-glass"></i></button>
                                       </div>
                                    </form>
                              </div>
                           </div>
                           <ul class="list-group" id="result" style="display: none">
                                 
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 hidden-xs">   
                     <div id="get-bookmark" class="box-shadow"><i class="fa-solid fa-user-check"></i>
                        @if(auth()->check())
                           <a href="{{route('profile')}}">
                              <span>
                                 Hi {{auth()->user()->name}}
                              </span>
                           </a>
                           ||
                           <a class="nav-link href="{{ route('logoutUser') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                              <span class="menu-icon">
                                 <i class="mdi mdi-speedometer"></i>
                              </span>
                              <span class="menu-title">Đăng xuất</span>
                           </a>    
                           <form id="frm-logout" action="{{ route('logoutUser') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                           </form>
                        @else
                           
                           <span class="">
                              <a href="/register-user">Đăng Ký</a>
                           </span>||
                           <span class="">
                              <a href="/login-user">Đăng nhập</a>
                           </span>
                        @endif
                     </div>
                     <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                        <ul style="margin: 0;"></ul>
                     
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="navbar-container">
               <div class="container">
                  <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                     <span class="sr-only">Menu</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     
                     <button type="text" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                        @if(auth()->check())
                           <a href="{{route('profile')}}"></a>
                              <span>
                                 Hi {{auth()->user()->name}}
                              </span>||
                                 <a class="nav-link href="{{ route('logoutUser') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                 <span class="menu-icon">
                                    <i class="mdi mdi-speedometer"></i>
                                 </span>
                                 <span class="menu-title">Đăng xuất</span>
                                 </a>    
                                 <form id="frm-logout" action="{{ route('logoutUser') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                 </form>
                           @else
                              <span class="">
                                 <a href="/register-user">Đăng Ký</a>
                              </span>||
                              <span class="">
                                 <a href="/login-user">Đăng nhập</a>
                              </span>
                           @endif
                     </button>
                  </div>
                  
                  <div class="collapse navbar-collapse" id="halim">
                     <div class="menu-menu_1-container">
                           <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                              <li class="current-menu-item active"><a title="Trang Chủ" href="{{route('homepage')}}">Trang Chủ</a></li>
                              <li class="mega dropdown">
                                 <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                                    <ul role="menu" class=" dropdown-menu">
                                       @foreach ( $genre as $key => $genre)
                                          <li><a title="{{$genre->title}}" href="{{route('genre',$genre->slug)}}">{{$genre->title}}</a></li>
                                       @endforeach  
                                    </ul>
                              </li>
                              <li class="mega dropdown">
                                 <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Năm <span class="caret"></span></a>
                                 <ul role="menu" class=" dropdown-menu">
                                    @for($year = 1995 ; $year <= 2025 ; $year++)
                                       <li><a title="{{$year}}" href="{{url('/year/'.$year)}}">{{$year}}</a></li>
                                    
                                    @endfor
                                 </ul>
                              </li>
                              @foreach ( $category as $key => $cate)
                                    <li class="mega"><a title="{{$cate->title}}" href="{{route('cate',$cate->slug)}}">{{$cate->title}}</a></li>
                              @endforeach
                              
                              
                              <li class="mega dropdown">
                              <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                              <ul role="menu" class=" dropdown-menu">
                                 @foreach ( $country as $key => $coun)
                                    <li><a title="{{$coun->title}}" href="{{route('country',$coun->slug)}}">{{$coun->title}}</a></li>
                                 @endforeach
                                 
                              </ul>
                              </li>
                              
                           </ul>
                     </div>
                     <ul class="nav navbar-nav navbar-left" style="background:#000;">
                           <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim <i class="fas fa-filter"></i></a></li>

                     </ul>
                     
                  </div>
                  <!-- Lọc Phim -->
                  <!-- <form action="{{route('search_allfilm')}}" method="GET" >

                           <div class="select-form">
                                 <select name="title" id="">
                                    <option value="">Chọn mục phim</option>
                                    @foreach ( $category as $key => $cate)
                                       <option value="{{$cate->title}}">{{$cate->title}}</option>
                                    @endforeach
                                 </select>
                           </div>
                           <div class="btn__loc">
                              
                              <button class="btn btn-primary">Lọc</button>
                           </div>
                  </form> -->
                     
                  </nav>
                  <div class="collapse navbar-collapse" id="search-form">
                  <div id="mobile-search-form" class="halim-search-form"></div>
                  </div>
                  <div class="collapse navbar-collapse" id="user-info">
                  <div id="mobile-user-login"></div>
                  </div>
               </div>
         </div>
         </div>
         
         <div class="container">
               <div class="row fullwith-slider"></div>
         </div>
         <div class="container">
         
               @yield('content')
         </div>
         </div>
         
         <div class="clearfix"></div>
         
         <footer id="footer" class="clearfix">
            <div class="container footer-columns">
               <div class="row container">
                  <div class="widget about col-xs-12 col-sm-4 col-md-4">
                     
                     @include('footer')
                  </div>
               </div>
            </div>
         </footer>
         <div id='easy-top'></div>
         @yield('footer')
         <script type='text/javascript' src='{{asset('js/bootstrap.min.js?ver=5.7.2')}}' id='bootstrap-js'></script>
         <script type='text/javascript' src='{{asset('js/owl.carousel.min.js?ver=5.7.2')}}' id='carousel-js'></script>
      
         <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js?ver=1626273138')}}' id='halim-init-js'></script>
         
         <!-- cmt = acc fb -->
         <div id="fb-root"></div>
         <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=514048372971177&autoLogAppEvents=1" 
         nonce="2znNyN6z"></script>
         
         <!-- animate có trailer phim khi click xem  -->
         <!-- xem trailer k load lai trang -->
         <script type="text/javascript">
            $(".watch_trailer").click(function(event){
                  event.preventDefault();
                  var aid = $(this).attr("href");
                  $('html, body').animate({scrollTop: $(aid).offset().top},'slow');
            });
         </script>
         <!-- popup PR -->
         <script>
               $(window).on('load', function() {
                  $('#banner_pr').modal('show');
               })
         </script>
            
         <!-- // tìm kiếm phim -->
         <script type='text/javascript'>
            $(document).ready(function() {
                  $('#timkiem').keyup(function() {
                     //alert('ss')
                     $('#result').html('');
                     var search = $('#timkiem').val();
                     if(search!=''){
                              $('#result').css('display', 'inherit');
                              var expression = new RegExp(search,"i");
                              $.getJSON('/json/movies.json', function(data){
                                       $.each(data, function(key, value){
                                          if(value.title.search(expression) != -1){
                                             $('#result').append('<li class="list-group-item" style="cursor:pointer;"><img style=" width:80px; height:80px; border-radius:50%;" src="/uploads/movie/' + value.image + '">' + '<span style="margin-left:5px;">'+value.title+'</span>'   + '</li>');
                                    }
                                 });
                              })
                        }else{
                              $('#result').css('display', 'none');
                        }
                  })
               
                     $('#result').on('click','li',function(){
                        var click_text = $(this).text().split('|'); //ngắt ra title vs description [0] && [1]
                        $('#timkiem').val($.trim(click_text[0]));
                        $('#result').html('');
                        $('#result').css('display', 'none');
                     });
               })
         </script>
         <script type="text/javascript">
            $(document).ready(function(){
               $.ajax({
                  url:"{{url('/filter-topview-default')}}",
                  method:"GET",
                  success:function(data)
                     {
                           $('#show_default').html(data);
                     }   
               }); 
               $('.filter-sidebar').click(function(){
                  var href = $(this).attr('href');
                  if(href=='#ngay'){
                     var value = 0;
                  }else if(href=='#tuan'){
                     var value = 1;
                  }else{
                     var value = 2;
                  }
                  $.ajax({
                     url:"{{url('/filter-topview-phim')}}",
                     method:"POST",
                     headers: {
                              'X-CSRF-TOKEN': $('meta[name ="csrf-token"]').attr('content'),
                           },
                     data:{value:value},
                     success:function(data)
                        {
                              $('#halim-ajax-popular-post-default').css('display','none');
                              $('#show_data').html(data);
                        }   
                  }); 
               })
            })
         </script>
      <script>
         var myModal = document.getElementById('myModal')
         var myInput = document.getElementById('myInput')

         myModal.addEventListener('shown.bs.modal', function () {
         myInput.focus()
         })
      </script>
      
         <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>
      
         <style>
            #overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
            }
            #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
            }
            .overlay_pc_block {
            display: inline-block;
            position: relative;
            }
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            }
            #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
            }
            #overlay_pc img {
            position: relative;
            z-index: 999;
            }
            @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 400px;
            top: 3%;
            transform: translate(-50%, 3%);
            }
            }
            @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 310px;
            top: 3%;
            transform: translate(-50%, 3%);
            }
            }
         </style>
      
         <style>
            .float-ck { position: fixed; bottom: 0px; z-index: 9}
            * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
            #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
            #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
            span.bannermobi2 img {height: 70px;width: 300px;}
            #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
         </style>
         <style>
            .search-i{
               display:flex;justify-content:flex-end;
            }
            .btn__warning{
               z-index: 1;border-radius: 20px;
            }
         
         </style>
      </body>
   </html>