@extends('layout')
@section('content')


<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs">
                           <span>
                                    <span>
                                       <a href="{{route('cate',[$movie->category->slug])}}">{{$movie->category->title}}</a> 
                                             » <span>
                                                   <a href="{{route('country',[$movie->country->slug])}}">{{$movie->country->title}}</a>
                                                      » <span class="breadcrumb_last" aria-current="page">{{$movie->title}} 
                                                            <!-- » @foreach ($movie->movie_genre as $gen )
                                                                  <span>
                                                                     <a href="{{route('genre',[$gen->slug])}}">{{$gen->title}}</a> »
                                                                  </span> 
                                                            @endforeach -->
                                                      </span>
                                                </span>
                                    </span>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="content" class="test">
                  <div class="clearfix wrap-content">
                  
                     <div class="halim-movie-wrapper">
                        <div class="title-block">
                           <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                              <div class="halim-pulse-ring"></div>
                           </div>
                           @php
                              $current_time = Carbon\Carbon::now()->toDateTimeString();
                              $current = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $current_time)->format('Y-m-d');
                           @endphp
                           @if (Auth::check() &&  $movie->film_vip == 1 )
                                 <div class="title-wrapper" style="font-weight: bold;">
                                    Chúc bạn xem phim vui vẻ! 
                                 </div>
                           @elseif(Auth::check() && $current < Auth::user() -> EndDate && $movie->film_vip == 2)
                                 <div class="title-wrapper" style="font-weight: bold;">
                                    Chúc bạn xem phim vui vẻ! 
                                 </div>
                           @elseif(Auth::check() && $movie->film_vip == 2 && $current > Auth::user() -> EndDate)
                                 <div class="title-wrapper" style="font-weight: bold;">
                                    Opps! Gói Vip của bạn đã hết <a href="{{ url('/planform')}}">đăng ký gói VIP </a>  để xem được phim này!
                                 </div>
                           @else
                                 Bạn cần có tài khoản để xem phim này!
                           @endif
                           
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                              @if(Auth::check() && $movie->film_vip == 2 && $current < Auth::user() -> EndDate)
                                    @if($movie->resolution != 5 )
                                          @if($episode_count>0)
                                             <div class="bwa-content">
                                                <div class="loader"></div>
                                                <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_numfilm->episode)}}" class="bwac-btn">
                                                   <i class="fa fa-play"></i>
                                                </a>
                                             </div>
                                          @endif
                                    @endif
                              @elseif($movie->film_vip == 1)
                                    @if($movie->resolution != 5 )
                                          @if($episode_count>0)
                                             <div class="bwa-content">
                                                <div class="loader"></div>
                                                <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_numfilm->episode)}}" class="bwac-btn">
                                                   <i class="fa fa-play"></i>
                                                </a>
                                             </div>
                                          @endif
                                    @endif
                              @endif
                              <a href="#watch_trailer" class="btn btn-danger watch_trailer" style="display:block">Xem Trailer</a>
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Chất lượng phim</span> : 
                                          <span class="quality">
                                                @if($movie->resolution == 0)
                                                      HD
                                                @elseif ($movie->resolution == 1)
                                                      SD
                                                @elseif ($movie->resolution == 2)
                                                      HDCam
                                                @elseif ($movie->resolution == 3)
                                                      Cam
                                                @elseif($movie->resolution == 4)
                                                      FullHD
                                                @else 
                                                      Trailer
                                                @endif
                                          </span>
                                          @if($movie->resolution != 5)
                                             <span class="episode">
                                                   @if ($movie->subtitle == 0)
                                                      Vietsub 
                                                         @if ($movie->session != 0)
                                                            -Session-{{$movie->session}}
                                                         @endif
                                                   @else
                                                         Thuyết minh
                                                         @if ($movie->session != 0)
                                                            -Session-{{$movie->session}}
                                                         @endif
                                                   @endif
                                             </span>
                                          @endif
                                       </li>
                                 <!-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> -->
                                 <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->movie_duration}}</li>
                                 <li class="list-info-group-item"><span>Số tập phim</span> : 
                                    @if ($movie->belonging_movie == 1)
                                             {{$episode_count}}/{{$movie->episode_film}} - 
                                          @if($episode_count == $movie->episode_film)
                                             Hoàn Thành
                                             @else   
                                             Đang cập nhật      
                                          @endif
                                    @elseif($movie->belonging_movie == 0)
                                             @foreach ($episode as $key => $epi_le )
                                                <a href="{{url('xem-phim/'.$epi_le->movie->slug.'/tap-'.$epi_le->episode)}}" rel="tag">{{$epi_le->episode}} </a>
                                             @endforeach
                                    @endif
                                 </li>
                                 <li class="list-info-group-item"><span>Thể loại</span> : <a href="{{route('genre',$movie->genre->slug)}}" rel="category tag">{{$movie->genre->title}}</a></li>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{route('country',$movie->country->slug)}}" rel="tag">{{$movie->country->title}}</a></li>
                                 <li class="list-info-group-item">
                                    <span>Tập phim mới nhất</span> :  
                                    @if($episode_count>0)
                                       @if ($movie->belonging_movie == 1)
                                                @foreach ($episode as $key => $epi )
                                                   <a href="{{url('xem-phim/'.$epi->movie->slug .'/tap-'.$epi->episode)}}" rel="tag">Tập {{$epi->episode}}</a>
                                                @endforeach
                                       @elseif($movie->belonging_movie == 0)
                                             @foreach ($episode as $key => $epi_le )
                                                <a href="{{url('xem-phim/'.$epi_le->movie->slug.'/tap-'.$epi_le->episode)}}" rel="tag">{{$epi_le->episode}} </a>
                                             @endforeach
                                       @endif
                                    @else
                                          Đang cập nhật
                                    @endif
                                    
                                 </li>
                                 <li class="list-info-group-item"><span>Đạo diễn</span> : <span class="director" rel="nofollow" href="#" title="Cate Shortland">{{$movie->director}}</span></li>
                                 <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <span href="" rel="nofollow" title="{{$movie->actor}}">{{$movie->actor}}</span></li>
                              </ul>
                              <div class="movie-trailer hidden"></div>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="halim_trailer"></div>
                     <div class="clearfix"></div>
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              Phim <a href="#">{{$movie->title}}</a> - {{$movie->year}} - {{$movie->country->title}}:
                              <p>{!!$movie->description!!}</p>
                           </article>
                        </div>
                     </div>
                     <!-- Tags Phim -->
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content">
                              <!-- print_r($tags); -->
                              @if($movie->tags != NULL)
                                 @php
                                    $tags = array();
                                    $tags = explode(".", $movie->tags);
                                 @endphp
                                 @foreach ($tags as $tag) 
                                    <a href="{{url('tag/' . $tag)}}">{!!$tag!!}</a>
                                    
                                 @endforeach
                              @else
                                    {!!$movie->tags!!}
                              @endif
                           </article>
                        </div>
                     </div>
                     <!-- COMMENT FB -->
                     <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                     </div>
                     <div class="entry-content htmlwrap clearfix " style="background: lightyellow !important;" >
                        @php
                           $current_url = Request::url();
                        @endphp
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content cmt_fb" >
                              <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="9" data-colorscheme="dark"></div>
                           </article>
                        </div>
                     </div>
                     @if ($movie->trailer != null)
                        <!-- Trailer Phim -->
                        <div class="section-bar clearfix">
                           <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix ">
                           <div class="video-item halim-entry-box">
                              <!-- ddawtjt id trùng vs cái href -->
                              <article id="watch_trailer" class="item-content">
                                 <iframe width="100%" height="350" src="https://www.youtube.com/embed/{{$movie->trailer}}" 
                                    title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                 </iframe>
                              </article>
                           </div>
                        </div>
                     @endif
                  </div>
               </section>
               <section class="related-movies">
                  <div id="halim_related_movies-2xx" class="wrap-slider">
                  <div class="section-bar clearfix">
                              <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                           </div>
                           <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                              @foreach($film_hot as $key=>$film)
                              <article class="thumb grid-item post-38498">
                              <div class="halim-item">
                                 <a class="halim-thumb" href="{{route('movie',$film->slug)}}" title="{{$film->title}}">
                                       <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$film->image)}}" alt="{{$film->title}}" title="{{$film->title}}"></figure>
                                       <span class="status">
                                             @if($film->resolution == 0)
                                                   HD
                                             @elseif ($film->resolution == 1)
                                                   SD
                                             @elseif ($film->resolution == 2)
                                                   HDCam
                                             @elseif ($film->resolution == 3)
                                                   Cam
                                             @else 
                                                   FullHD
                                             @endif
                                       </span>
                                       <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                          @if ($film->subtitle == 0)
                                             Vietsub
                                          @else
                                             Thuyết minh
                                          @endif  
                                       </span> 
                                       <div class="icon_overlay"></div>
                                       <div class="halim-post-title-box">
                                          <div class="halim-post-title ">
                                          <p class="entry-title">{{$film->title}}</p>
                                          <p class="original_title">{{$film->name_eng}}</p>
                                          </div>
                                       </div>
                                 </a>
                              </div>
                              </article>     
                              @endforeach                       
                           </div>
                           <script>
                              $(document).ready(function($) {				
                              var owl = $('#halim_related_movies-2');
                              owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-caret-left"></i>', '<i class="fa-solid fa-caret-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                           </script>
                  </div>
               </section>
               
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
         </div>
@endsection
@section('footer')
   <script>
      $(function(){
         $("#rateYo").rateYo({
            rating:,
            normalFill:"#AOAOAO",
            ratedFill:"#ffff00"
         }).on("rateyo.set", function(e, data){
            $('#rating_star').val(data.rating);
            $('#formRating').submit();
         });

         $("#rateYo1").rateYo({
            rating:,
            normalFill:"#AOAOAO",
            ratedFill:"#ffff00"
         }).on("rateyo.set", function(e, data){
            alert('Bạn chưa đăng nhập')
         })
      })
   </script> 
@endsection