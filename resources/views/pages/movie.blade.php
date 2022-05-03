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
                           <div class="title-wrapper" style="font-weight: bold;">
                              Bookmark
                           </div>
                        </div>
                        <div class="movie_info col-xs-12">
                           <div class="movie-poster col-md-3">
                              <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
                              @if($movie->resolution != 5 )
                                    @if($episode_count>0)
                                       <div class="bwa-content">
                                          <div class="loader"></div>
                                          <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_numfilm->episode)}}" class="bwac-btn">
                                             <i class="fa fa-play"></i>
                                          </a>
                                       </div>
                                    @endif
                              @else 
                                    <a href="#watch_trailer" class="btn btn-danger watch_trailer" style="display:block">Xem Trailer</a>
                              @endif
                           </div>
                           <div class="film-poster col-md-9">
                              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                              <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
                              <ul class="list-info-group">
                                 <li class="list-info-group-item"><span>Trạng Thái</span> : 
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
                                    @if ($movie->belonging_movie == 'phimbo')
                                             {{$episode_count}}/{{$movie->episode_film}} - 
                                          @if($episode_count == $movie->episode_film)
                                             Hoàn Thành
                                             @else   
                                             Đang cập nhật      
                                          @endif
                                    @else
                                          <a href="" rel="tag">FullHD</a>
                                          <a href="" rel="tag">HD</a>
                                    @endif

                                 </li>
                                 <li class="list-info-group-item"><span>Thể loại</span> : <a href="" rel="category tag">Chiếu Rạp</a>, <a href="" rel="category tag">Hành động</a>, <a href="" rel="category tag">Phiêu Lưu</a>, <a href="" rel="category tag">Viễn Tưởng</a></li>
                                 <li class="list-info-group-item"><span>Quốc gia</span> : <a href="" rel="tag">{{$movie->country->title}}</a></li>
                                 <li class="list-info-group-item">
                                    <span>Tập phim mới nhất</span> :  
                                    @if($episode_count>0)
                                       @if ($movie->belonging_movie == 'phimbo')
                                                @foreach ($episode as $key => $epi )
                                                   <a href="{{url('xem-phim/'.$epi->movie->slug .'/tap-'.$epi->episode)}}" rel="tag">Tập {{$epi->episode}}</a>
                                                   <!-- <a href="{{route('watch',['slug' => $epi->movie->slug,'tap-phim'=>$episode_numfilm->episode])}}" rel="tag">Tập {{$epi->episode}}</a> -->
                                                @endforeach
                                       @elseif($movie->belonging_movie == 'phimle')
                                             @foreach ($episode as $key => $epi_le )
                                                <a href="{{url('xem-phim/'.$epi_le->slug.'/tap-'.$epi_le->episode)}}" rel="tag">{{$epi_le->episode}} </a>
                                             @endforeach
                                       @endif
                                    @else
                                          Đang cập nhật
                                    @endif
                                    
                                 </li>
                                 <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                                 <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li>
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
                              Phim <a href="https://phimhay.co/goa-phu-den-38424/">GÓA PHỤ ĐEN</a> - 2021 - Mỹ:
                              <p>{!!$movie->description!!}</p>
                              <h5>Từ Khoá Tìm Kiếm:</h5>
                              <ul>
                                 <li>black widow vietsub</li>
                                 <li>Black Widow 2021 Vietsub</li>
                                 <li>phim black windows 2021</li>
                                 <li>xem phim black windows</li>
                                 <li>xem phim black widow</li>
                                 <li>phim black windows</li>
                                 <li>goa phu den</li>
                                 <li>xem phim black window</li>
                                 <li>phim black widow 2021</li>
                                 <li>xem black widow</li>
                              </ul>
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
                     <!-- <div class="entry-content htmlwrap clearfix " style="background: lightyellow !important;" >
                        @php
                           $current_url = Request::url();
                        @endphp
                        <div class="video-item halim-entry-box">
                           <article id="post-38424" class="item-content cmt_fb" >
                              <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="7" data-colorscheme="dark"></div>
                           </article>
                        </div>
                     </div> -->
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
                              owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
                           </script>
                  </div>
               </section>
               
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
         </div>
@endsection