@extends('layout')
@section('content')
<div class="row container" id="wrapper">
                <div class="halim-panel-filter">
                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>
                </div>
                <div class="col-xs-12 carausel-sliderWidget">
                    
                <section id="halim-advanced-widget-4">
                    <div class="section-heading">
                        <a href="danhmuc.php" title="Phim Chiếu Rạp">
                        <span class="h-text">Phim Chiếu Rạp</span>
                        </a>
                        <ul class="heading-nav pull-right hidden-xs">
                            <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
                        </ul>
                    </div>
                    <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
                        <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                            <div class="halim-item">
                            <a class="halim-thumb" href="{{route('movie')}}" title="GÓA PHỤ ĐEN">
                                <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                                <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">GÓA PHỤ ĐEN</p>
                                        <p class="original_title">Black Widow</p>
                                    </div>
                                </div>
                            </a>
                            </div>
                        </article>
                        

                        
                    </div>
                </section>
                <div class="clearfix"></div>
                </div>
                <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
                @foreach($category_home as $key => $cate_home)
                    <section id="halim-advanced-widget-2">
                        <div class="section-heading">
                            <a href="danhmuc.php" title="Phim Bộ">
                            <span class="h-text">{{$cate_home->title}}</span>
                            </a>
                        </div>
                        <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                            @foreach($cate_home->movie->take(10) as $key => $cate_movie)
                                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                    <div class="halim-item">
                                    <a class="halim-thumb" href="chitiet.php">
                                        <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$cate_movie->image)}}" alt="{{$cate_movie->title}}" title="{{$cate_movie->title}}"></figure>
                                        <span class="status">TẬP 15</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{$cate_movie->title}}</p>
                                                <p class="original_title">#</p>
                                                <!-- {!!$cate_movie->description!!} -->
                                            </div>
                                        </div>
                                    </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                    <div class="clearfix"></div>
                @endforeach
                
                </main>
                <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
                <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                    <div class="section-bar clearfix">
                        <div class="section-title">
                            <span>Top Views</span>
                            <ul class="halim-popular-tab" role="tablist">
                            <li role="presentation" class="active">
                                <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="today">Day</a>
                            </li>
                            <li role="presentation">
                                <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="week">Week</a>
                            </li>
                            <li role="presentation">
                                <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="month">Month</a>
                            </li>
                            <li role="presentation">
                                <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <section class="tab-content">
                        <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                            <div class="halim-ajax-popular-post-loading hidden"></div>
                            <div id="halim-ajax-popular-post" class="popular-post">
                            <div class="item post-37176">
                                <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                    <div class="item-link">
                                        <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                        <span class="is_trailer">Trailer</span>
                                    </div>
                                    <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                                </a>
                                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                                <div style="float: left;">
                                    <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                    </span>
                                </div>
                            </div>
                            
                            
                            
                            </div>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
                </aside>
@endsection