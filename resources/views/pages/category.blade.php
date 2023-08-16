@extends('layout')
@section('content')
<div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div class="panel-heading">
                  <div class="row">
                     <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{$cate_slug->title}}</a> » <span class="breadcrumb_last" aria-current="page">2022</span></span></span></div>
                     </div>
                  </div>
               </div>
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="halim-advanced-widget-2">
                  <div class="section-bar clearfix">
                     <h1 class="section-title"><span>{{$cate_slug->title}}</span></h1>
                  </div>
                  <div class="section-bar clearfix">

                  <style>
                     .pg{
                           padding: 10px;
                     }
                     .mt{
                           margin-top: 10px;
                     }
                     .dis{
                           display: flex;
                           justify-content: space-around;
                     }
                  </style>  
                  <div class="dis">
                  <form action="{{route('filter_film')}}" method="GET">

                     <select class="form-select pg" name="order" aria-label="Default select example" style="width:170px">
                           <option value="" selected>-- Sắp xếp --</option>
                           <option value="date">Ngày đăng</option>
                           <option value="year_release">Năm sản xuất</option>
                           <option value="name_a_z">Tên phim</option>
                           <option value="watch_views">Lượt xem</option>
                     </select>
                     <select class="form-select pg" name="genre" aria-label="Default select example" style="width:170px">
                           <option value="" selected>-- Thể loại --</option>
                           @foreach ( $genre as $key => $genre_filter)
                              <option value="{{$genre_filter->id}}">{{$genre_filter->title}}</option>
                           @endforeach  
                           
                     </select>
                     <select class="form-select pg" name="country" aria-label="Default select example" style="width:170px">
                           <option value="" selected>-- Quốc gia --</option>
                           @foreach ( $country as $key => $country_filter)
                              <option {{isset($_GET['country']) && $_GET['country'] == $country_filter->id ? 'selected':''}} value="{{$country_filter->id}}">{{$country_filter->title}}</option>
                           @endforeach 
                     </select>
                     <select class="form-select pg" name="year" aria-label="Default select example" style="width:170px">
                           <option value="" selected>-- Năm phim --</option>
                           @for($year = 1995 ; $year <= 2025 ; $year++)
                              <option value="{{$year}}">{{$year}}</option>
                           @endfor
                     </select>
                     
                  </div>
                  
                  <div class="mt">
                     
                     <button class="btn btn-primary mx-auto">Lọc phim</button>
                     
                  </div>
               </form>      
                  </div>

                  <div class="halim_box">
                     @foreach($movie as $key => $mov)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                           <div class="halim-item">
                              <a class="halim-thumb" href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}" alt="{{$mov->title}}" title="{{$mov->title}}"></figure>
                                 <span class="status">
                                    @if($mov->resolution == 0)
                                       HD
                                    @elseif ($mov->resolution == 1)
                                       SD
                                    @elseif ($mov->resolution == 2)
                                       HDCam
                                    @elseif ($mov->resolution == 3)
                                       Cam
                                    @else 
                                       FullHD
                                    @endif
                                 </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if ($mov->subtitle == 0)
                                       Vietsub
                                          @if ($mov->session != 0)
                                             -Session-{{$mov->session}}
                                          @endif
                                    @else
                                       Thuyết minh
                                       @if ($mov->session != 0)
                                             -Session-{{$mov->session}}
                                          @endif
                                    @endif
                                 </span> 
                                 <div class="icon_overlay"></div>
                                 <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                       <p class="entry-title">{{$mov->title}}</p>
                                       <p class="original_title">{{$mov->name_eng}}</p>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </article>
                     @endforeach
                  
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     {!!$movie->links("pagination::bootstrap-4")!!}
                     <!-- <ul class='page-numbers'>
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                     </ul> -->
                  </div>
               </section>
            </main>
            @include('pages.includes.sidebar')
         </div>
@endsection