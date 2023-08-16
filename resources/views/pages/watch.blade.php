@extends('layout')
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

@endsection
@section('content')

<div class="row container" id="wrapper">
         <div class="halim-panel-filter">
            <div class="panel-heading">
               <div class="row">
                  <div class="col-xs-6">
                     <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{$movie->title}}</a> » <span>
                        <a href="{{route('country',[$movie->country->slug])}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
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
                  <style type="text/css">
                        .iframe-film iframe{
                           width: 100%;
                           height: 500px;
                        }
                  </style>
                  <div class="button-watch">
                     <div class="iframe-film">
                        {!! $episode->linkfilm !!}

                     </div>
                     <!-- @foreach ($movie->episode as $epi)
                           @endforeach -->
                     <ul class="halim-social-plugin col-xs-4 hidden-xs">
                              @php
                                 $current_url = Request::url();
                              @endphp
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
                     </ul>
                     
                     <ul class="col-xs-12 col-md-8">
                        <!-- <div id="autonext" class="btn-cs autonext">
                           <i class="icon-autonext-sm"></i>
                           <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                        </div> -->
                        <!-- <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                           Expand 
                        </div> -->
                        <div id="toggle-light"><i class="hl-adjust"></i>
                           Light Off 
                        </div>
                        <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                        <div class="luotxem"><i class="fa-solid fa-eye"></i>
                           <span>
                              @if ($episode->views < 1000)
                                 {{$episode->views}}
                              @elseif($episode->views >= 1000 && $episode->views < 1000000)
                                    {{number_format($episode->views/1000)}} K
                              @elseif ($episode->views >= 1000000)
                                    {{number_format($episode->views/1000000)}} M
                              @endif
                           </span> lượt xem 
                        </div>
                        <div class="luotxem">
                           <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="fa-solid fa-eye"></i> Share</a>
                        </div>
                     </ul>
                  </div>
                     
                  
                  <div class="collapse" id="moretool">
                     <ul class="nav nav-pills x-nav-justified">
                        <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                        <div class="fb-save" data-uri="" data-size="small"></div>
                     </ul>
                  </div>
               
                  <div class="clearfix"></div>
                  <div class="clearfix"></div>
                  <div class="title-block">
                     
                     <h2 class="entry-title" ><a href="" title="{{$movie->title}}" class="tl" style="color: #bdbdbd;line-height: 35px;">{{$movie->title}} - {{$movie->name_eng}}</a></h2>
                     <!-- <div class="title-wrapper-xem full">
                     </div> -->
                     <div class="height-100 container d-flex justify-content-center align-items-center">
                        
                        @if(auth()->check())
                        <p>Đánh giá phim(Có {{$count}} đánh giá) </p>
                        <div class="rating-review">
                           <div class="rating__s">
                                 <ul class="list-inline" style="display: flex;">
                                    
                                    @for($count=1;$count<=5;$count++)
                                    @php
                                    if($count<=$ratingAvg){
                                             $color = 'color:#ffcc00;';
                                          }else{
                                             $color = 'color:#ccc;';
                                          }
                                       @endphp
                                       <li title="Đánh giá sao"
                                          id="{{$episode->id}}-{{$count}}"
                                          data-index="{{$count}}"
                                          data-episode_id="{{$episode->id}}"
                                          data-user_id="{{auth()->user()->id}}"
                                          data-rating="{{$ratingAvg}}"
                                          class="rating" 
                                          style="cursor: pointer;{{$color}} font-size:45px">
                                                   &#9733;
                                       </li>
                                    @endfor
                                 </ul> 
                              </div>
                           </div>
                           
                        @else
                              <span>Đăng nhập để đánh giá cho phim</span>
                        @endif
                        
                  <div class="card p-3">
                     
               
               </div>
                  </div>
                  <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                     <article id="post-37976" class="item-content post-37976"></article>
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     <div id="halim-ajax-list-server"></div>
                  </div>
                  <div id="halim-list-server">
                     <ul class="nav nav-tabs" role="tablist">
                           @if($movie->resolution == 0)
                                 <li  role="presentation" class="active server-1">
                                    <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                       HD</a>
                                 </li> 
                           @elseif ($movie->resolution == 1)
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                    SD</a>
                              </li>
                           @elseif ($movie->resolution == 2)
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                    HDCam</a>
                              </li>
                           @elseif ($movie->resolution == 3)
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                    Cam</a>
                              </li>
                           @else 
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                    FullHD</a>
                              </li>
                           @endif   
                           @if ($movie->subtitle == 0)
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                 Vietsub</a>
                              </li>
                           @else
                              <li role="presentation" class="active server-1">
                                 <a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab">
                                 Thuyết minh</a>
                              </li>
                           @endif    
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                           <div class="halim-server">
                              <ul class="halim-list-eps">
                                 <!-- 0 là phim lẻ -->
                                 @if($movie->belonging_movie == 0)
                                    @foreach ($movie->episode  as  $key => $sotap)
                                       <li class="halim-episode">
                                             <!-- Để  chữ tập trong url vì có truyền tham số tap substr để lấy số tập -->
                                             <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)}}">
                                                <span class="halim-btn halim-btn-2 {{$tapphim == $sotap->episode ? 'active':''}} halim-info-1-1 box-shadow" data-post-id="37976" 
                                                data-server="1" data-episode="1" data-position="first" data-embed="0" 
                                                data-title="Xem phim {{$movie->title}} - {{$sotap->episode}} - {{$movie->name_eng}} Vietsub + Thuyết Minh" 
                                                data-h1=" - {{$movie->title}} tập {{$sotap->episode}}">Link dự phòng
                                                </span>
                                             </a>
                                       </li>
                                    @endforeach
                                 @else
                                    @foreach ($movie->episode  as  $key => $sotap)
                                       <li class="halim-episode">
                                             <!-- Để  chữ tập trong url vì có truyền tham số tap substr để lấy số tập -->
                                             <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)}}">
                                                <span class="halim-btn halim-btn-2 {{$tapphim == $sotap->episode ? 'active':''}} halim-info-1-1 box-shadow" data-post-id="37976" 
                                                data-server="1" data-episode="1" data-position="first" data-embed="0" 
                                                data-title="Xem phim {{$movie->title}} - {{$sotap->episode}} - {{$movie->name_eng}} Vietsub + Thuyết Minh" 
                                                data-h1=" - {{$movie->title}} tập {{$sotap->episode}}">{{$sotap->episode}}
                                                </span>
                                             </a>
                                          </li>
                                    @endforeach
                                 @endif
                                 
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                           //* Server film
                           <div class="halim-server">
                              <ul class="halim-list-eps">
                                 <!-- 0 là phim lẻ -->
                                    @foreach ($server  as  $key => $serv)
                                          @foreach ($episode_movie as $list )
                                             @if ($list->server == $serv->id)
                                                <li class="halim-episode">
                                                      <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow" data-post-id="37976">{{$serv->title}}</span>
                                                </li>
                                                <ul class="halim-list-eps">
                                                @foreach ($episode_list as $epi )
                                                   @if ($epi->server  == $serv->id)
                                                      <li class="halim-episode">
                                                            <!-- Để  chữ tập trong url vì có truyền tham số tap substr để lấy số tập -->
                                                            <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$epi->episode.'/server-'.$epi->server)}}">
                                                               <span class="halim-btn halim-btn-2 {{$tapphim == $epi->episode && $server_active == 'server-'.$serv->id ? 'active':''}} halim-info-1-1 box-shadow" data-post-id="37976" 
                                                               data-server="1" data-episode="1" data-position="first" data-embed="0" 
                                                               data-title="Xem phim {{$movie->title}} - {{$sotap->episode}} - {{$movie->name_eng}} Vietsub + Thuyết Minh" 
                                                               data-h1=" - {{$movie->title}} tập {{$sotap->episode}}">{{$epi->episode}}
                                                               </span>
                                                            </a>
                                                         </li>
                                                         @endif
                                                         @endforeach
                                                      </ul>
                                                
                                             @endif
                                          @endforeach
                                       
                                    @endforeach
                                 
                                             <!-- Để  chữ tập trong url vì có truyền tham số tap substr để lấy số tập -->
                                             <!-- <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$sotap->episode)}}">
                                                <span class="halim-btn halim-btn-2 {{$tapphim == $sotap->episode ? 'active':''}} halim-info-1-1 box-shadow" data-post-id="37976" 
                                                data-server="1" data-episode="1" data-position="first" data-embed="0" 
                                                data-title="Xem phim {{$movie->title}} - {{$sotap->episode}} - {{$movie->name_eng}} Vietsub + Thuyết Minh" 
                                                data-h1=" - {{$movie->title}} tập {{$sotap->episode}}">{{$sotap->episode}}
                                                </span>
                                             </a>
                                          </li> -->
                                    
                                 
                              </ul>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="htmlwrap clearfix">
                     <div id="lightout"></div>
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
                     <!-- Cmt Fb -->
                  </div>
            </section>
            <section class="related-movies">
            <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
               <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach($related as $key=>$movie)
                  <article class="thumb grid-item post-38494">
                              <div class="halim-item">
                                 <a class="halim-thumb" href="{{route('movie',$movie->slug)}}" title="{{$movie->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                                    <span class="status">
                                          @if($movie->resolution == 0)
                                                HD
                                             @elseif ($movie->resolution == 1)
                                                   SD
                                             @elseif ($movie->resolution == 2)
                                                   HDCam
                                             @elseif ($movie->resolution == 3)
                                                   Cam
                                             @else 
                                                   FullHD
                                          @endif
                                    </span>
                                    <span class="episode">
                                       <i class="fa fa-play" aria-hidden="true"></i>
                                          @if ($movie->subtitle == 0)
                                             Vietsub
                                          @else
                                             Thuyết minh
                                          @endif  
                                    </span> 
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$movie->title}}</p><p class="original_title">{{$movie->name_eng}}</p>
                                 </div>
                                 </div>
                                 </a>
                              </div>
                  </article>
               @endforeach
            </div>
            <script>
               jQuery(document).ready(function($) {				
               var owl = $('#halim_related_movies-2');
               owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-caret-left"></i>', '<i class="fa-solid fa-caret-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
            </script>
            </div>
            </section>
         </main>
            @include('pages.includes.sidebar')

      </div>

@endsection

@section('footer')
<!-- ratings -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css" integrity="sha512-JEUoTOcC35/ovhE1389S9NxeGcVLIqOAEzlpcJujvyUaxvIXJN9VxPX0x1TwSo22jCxz2fHQPS1de8NgUyg+nA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<script>
      $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
</script>
<script>
	function remove_background(episode_id) {
		for(var count = 1; count <= 5 ; count++) {
			$('#' + episode_id + '-' + count).css('color','#ccc');
		}
	}
   //hover chuột đánh giá sao
// 	$(document).on('mouseenter','.rating',function(){
// 		var index = $(this).data('index');
// 		var episode_id = $(this).data('episode_id');
// 		var user_id = $(this).data('user_id');
// //       		alert(index);
// // alert(user_id);
// 		remove_background(episode_id);
// 		for(var count = 1; count<= index; count++)
// 		{
// 			$('#' + episode_id + '-' + count).css('color','#ffcc00');
// 		}
// 	});
// 	$(document).on('mouseleave','.rating',function(){
// 		var index = $(this).data('index');
// 		var episode_id = $(this).data('episode_id');
//       var ratingAvg = $(this).data('ratingAvg');
//       var user_id = $(this).data('user_id');
// // 		alert(index);
// // alert(product_id);
// 		remove_background(episode_id);
// 		for(var count = 1; count<= ratingAvg; count++)
// 		{
// 			$('#' + episode_id + '-' + count).css('color','#ffcc00');
// 		}
// 	});
	$(document).on('click','.rating', function() {
		var index = $(this).data('index');
		var episode_id = $(this).data('episode_id');
      var user_id = $(this).data('user_id');
		var _token = $('input[name="_token]').val();
		$.ajax({
			url:"{{url('insert-rating')}}",
			method:"post",
			data:{index:index,episode_id:episode_id,user_id:user_id,_token:'{{csrf_token()}}'},
			success:function(data){
            console.log(data);
				if(data == 'done')
				{
					alert('Bạn đã đánh giá ' + index + " trên 5 sao");
				}else{
					alert('Bạn đã đánh giá phim này rồi!');
				}
			}
		})
	})
</script>
<!-- <script>
   $(function () {
   
   $("#rateYo").rateYo({
      rating: {{$ratingAvg}}
   });

   });
</script>

<script>
   $(function(){
      $("#rateYo").rateYo({
         rating:{{$ratingAvg}},
         normalFill:"#AOAOAO",
         ratedFill:"#ffff00"
      }).on("rateyo.set", function(e, data){
         $('#rating_star').val(data.rating);
         $('#formRating').submit();
      });

      $("#rateYo1").rateYo({
         rating:{{$ratingAvg}},
         normalFill:"#AOAOAO",
         ratedFill:"#ffff00"
      }).on("rateyo.set", function(e, data){
         alert('Bạn chưa đăng nhập')
      })
   })
</script> -->
@endsection
