@extends('layouts.master')

@section('content')


        <!-- Page Title -->
        <section class="page-title style-two centred" style="background-image: url({{asset('frontend/assets/images/background/story.png')}});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Media Coverage</h1>
                    </div>
                   
                </div>
            </div>
        </section>
        <!-- End Page Title -->


<!-- sidebar-page-container -->
<section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-classic-content">
                    @if(count($story)> 0)
                    @foreach($story as $list)
                    <div class="news-block-two wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}"><img src="{{asset('backend/story/'.$list->image)}}" alt=""></a></figure>
                            <div class="lower-content">
                                <div class="info-box">
                                    <div class="post-date"><h3><span>{{date_format($list->created_at,'d M Y')}}</span></h3></div>
                                    <div class="share-box">
                                        <span>Share</span>
                                        <div class="social-links">
                                            <ul class="social-box clearfix">
                                                <li><a href="{{ $setting->facebook_url }}"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="{{ $setting->linkdin_url }}"><i class="fab fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner">
                                    <div class="category"><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}">{{$list->category->name ?? 'Uncategorized'}}</a></div>
                                    <h2><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}">{{$list->title}}</a></h2>
                                    <p>{{$list->meta_description}}</p>
                                    <div class="link"><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}">Read More</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $story->links('vendor.pagination.default') }} 
                    @else
                    <h5 class="justify-content-center"> No Data found</h5>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar ml-30">
                    <div class="sidebar-widget sidebar-search">
                        <div class="widget-title">
                            <h4>Search</h4>
                        </div>
                        <form action="{{url('/searchstory')}}" method="post" class="search-form">
                            <div class="form-group">
                                <input type="search" name="searchinput" placeholder="Keyword..." required="">
                                <button type="submit"><i class="flaticon-loupe"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <h4>Categories</h4>
                        </div>
                        @foreach($categ as $category)
                        <div class="widget-content">
                            
                            <ul class="category-list clearfix">
                                {{-- <li><a href="">Home Cleaning<span></span></a></li> --}}
                                <li><a href="{{url('/categoryby/'.$category->id)}}">{{$category->name}}</a></li>
                            </ul>

                        </div>
                        @endforeach
                    </div>
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Recent Success Story</h4>
                        </div>
                        <div class="post-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                @foreach($new as $recent)
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{url('/success-story-details/'.$recent->id.'/'.$recent->slug)}}"><img src="{{asset('backend/story/'.$recent->image)}}" alt=""></a></figure>
                                    <div class="category"><a href="{{url('/success-story-details/'.$recent->id.'/'.$recent->slug)}}">{{$recent->slug}}</a></div>
                                    <h5><a href="{{url('/success-story-details/'.$recent->id.'/'.$recent->slug)}}">{{$recent->title}}</a></h5>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    
                   {{-- <div class="sidebar-widget tags-widget">
                        <div class="widget-title">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="tags-list clearfix">
                                <li><a href="#">Appliance</a></li>
                                <li><a href="#">Commercial</a></li>
                                <li><a href="#">Covid19</a></li>
                                <li><a href="#">Event</a></li>
                                <li><a href="#">Hospital</a></li>
                                <li><a href="#">Safety</a></li>
                                <li><a href="#">School</a></li>
                                <li><a href="#">Residential</a></li>
                                <li><a href="#">Restaurant</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget archives-widget">
                        <div class="widget-title">
                            <h4>Archive</h4>
                        </div>
                        <div class="widget-content">
                            <div class="icon-box"><i class="flaticon-appointment"></i></div>
                            <div class="select-box">
                                <select class="wide">
                                   <option data-display="Dec 2019">Dec 2019</option>
                                   <option value="1">Nov 2019</option>
                                   <option value="2">Oct 2019</option>
                                   <option value="3">Sep 2019</option>
                                   <option value="4">Aug 2019</option>
                                </select>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container end -->






       


@endsection