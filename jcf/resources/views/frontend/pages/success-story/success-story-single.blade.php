@extends('layouts.master')

@section('content')
<style>

</style>

<!-- Page Title -->
<!-- <section class="page-title style-two centred"
    style="background-image: url({{ asset('frontend/assets/images/background/story.png') }});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{ $detail->title }}</h1>
            </div>
           
        </div>
    </div>
</section> -->
<!-- End Page Title -->

 <!-- sidebar-page-container -->
 <section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="content-one">
                        {{-- <div class="top-text">
                            <p>Equal blame belongs too those who fail in their through weakness will shrinking duty the obligation off business it will frequently occur that pleasures have to be repudiated annoyances accepted the wise man therefore always holds in these matters this principle selection rejects  greater pleasures else he endures pains to avoid worse untrammelled and when nothing prevents.</p>
                        </div> --}}
                        <figure class="image-box">

                           @if($detail->image)
                                        <img src="{{asset('backend/story/'.$detail->image)}}" alt="">
                                        @else
                                        <img src="{{asset('frontend/custom/breadcrump.png')}}" alt="">
                                        @endif
                        </figure>
                        <div class="text">
                           {{-- <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself because it is pain but all because occasionally circumstances occur take a trivial examples, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it.</p>
                            <ul class="list clearfix"> 
                                <li>Indignation and dislike men who are beguiled and demoralized  charms.</li>
                                <li>Untrammelled and when nothing prevents work.</li>
                                <li>Owing to the claims of duty or the obligations of business it will frequently occur.</li>
                                <li>Duty or the obligations of business it will frequently occur that pleasures.</li>
                            </ul>--}}
                            <h3>{{ $detail->title }}</h3>
                            <p>{{$detail->excerpt}}</p>
                            {{-- <p>Fault with a man who chooses to enjoy a pleasure that annoying consequences, or one who avoids.</p> --}}
                        </div>
                    </div>
                    <div class="content-two">
                        <div class="two-column">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                    <figure class="image-box">
                                        @if($detail->og_meta_image)
                                        <img src="{{asset('backend/story/'.$detail->og_meta_image)}}" alt="">
                                        @else
                                        <img src="{{asset('frontend/custom/breadcrump.png')}}" alt="">
                                        @endif
                                    </figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 quote-column">
                                    <blockquote>
                                        <div class="icon-box"><i class="flaticon-right-quotes-symbol"></i></div>
                                        <p>{{$detail->og_meta_description}}</p>
                                        <h4>{{$detail->og_meta_title}}</h4>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="text">
                            <p>{{$detail->meta_description}}</p>
                        </div>
                    </div>
                    <div class="post-share-option">
                        <ul class="post-tags clearfix">
                            <li><h6><i class="fas fa-hashtag"></i>Tags:</h6></li>
                            <li><a href="#">{{$detail->meta_tags}}</a>,</li>
                         
                        </ul>
                        <ul class="social-links clearfix">
                            <li><a href="{{ $setting->facebook_url }}"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                            <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i>Twitter</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#inlineForm"><i class="fa fa-envelope"></i>Email</a></li>

                        <?php $urlset = getenv('APP_URL').'story-details/'.$detail->id.'/'.$detail->slug ;
                                  
                        ?>
                            <li><a href="https://api.whatsapp.com/send?phone={{$setting->phone}}&text=%F0%9F%91%8D%20I%20am%20intersted%20in%20your%20product%20%0A%F0%9F%91%89%20{{ $urlset }}%0A%F0%9F%98%8E%20Thanks"><i class="fab fa-whatsapp"></i>Whatsapp</a></li>
                        </ul>
                    </div>
                     <!-- Modal -->
                     <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel33" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel33">Quick Enquiry</h4>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <form action="{{ url('/send-mail') }}" method="POST">
                                 @csrf
                                 <div class="modal-body">


                                     <div class="form-group">
                                         <input type="text" name="name" placeholder="Name" class="form-control" />
                                     </div>

                                     <div class="form-group">
                                         <input type="text" name="email" placeholder="Email" class="form-control" />
                                     </div>

                                     <div class="form-group">
                                         <input type="number" name="mobile" placeholder="Phone"
                                             class="form-control" />
                                     </div>


                                     <div class="form-group">
                                         <textarea class="form-control" name="message"
                                             placeholder="Message"></textarea>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="submit" class="btn btn-primary">Send mail</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
                    {{-- <div class="post-nav clearfix">
                        <div class="left-nav pull-left">
                            <figure class="image-box"><i class="fal fa-angle-left"></i><img src="assets/images/news/nav-1.jpg" alt=""></figure>
                            <span>Office Cleaning</span>
                            <h5><a href="blog-details.html">Publish Guide For Infection <br />Control</a></h5>
                        </div>
                        <div class="right-nav pull-right text-right">
                            <figure class="image-box"><i class="fal fa-angle-right"></i><img src="assets/images/news/nav-2.jpg" alt=""></figure>
                            <span>Home Cleaning</span>
                            <h5><a href="blog-details.html">Cleaning Forgotten Spots In <br />Your House</a></h5>
                        </div>
                    </div> --}}
                    {{-- <div class="comment-box">
                        <div class="group-title">
                            <h3>2 Comments</h3>
                        </div>
                        <div class="comment">
                            <figure class="thumb-box">
                                <img src="assets/images/news/comment-1.jpg" alt="">
                            </figure>
                            <div class="comment-inner">
                                <div class="comment-info clearfix">
                                    <h4>Isaac Herman</h4>
                                    <span class="post-date">May 14, 2020 [11.00am]</span>
                                </div>
                                <p>How all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>
                                <a href="blog-details.html" class="reply-btn"><i class="flaticon-share"></i>Reply</a>
                            </div>
                        </div>
                        <div class="comment reply-comment">
                            <figure class="thumb-box">
                                <img src="assets/images/news/comment-2.jpg" alt="">
                            </figure>
                            <div class="comment-inner">
                                <div class="comment-info clearfix">
                                    <h4>William Cobus</h4>
                                    <span class="post-date">May 14, 2020 [11.00am]</span>
                                </div>
                                <p>Undertakes laborious physical exercise, except to obtain some advantage from it but who has any right to find fault.</p>
                                <a href="blog-details.html" class="reply-btn"><i class="flaticon-share"></i>Reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comments-form-area">
                        <div class="group-title">
                            <h3>Leave Comments</h3>
                            <p>Your email address will not be published, All fields are required. </p>
                        </div>
                        <form method="post" action="blog-details.html" class="default-form"> 
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="name" placeholder="Your Name *" required="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email Address *" required="">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Comment ..."></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <button class="theme-btn-three thm-btn" type="submit" name="submit-form"><span class="btn-shape"></span>post comment</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
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
                                <li><a href="{{url('/categoryby/'.$category->id)}}">{{$category->name}}</a></li>
                             
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h4>Related Success Stories</h4>
                        </div>
                        <div class="post-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                @foreach($newpro  as $list)
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}"><img src="{{ asset('backend/story/'.$list->image) }}" alt=""></a></figure>
                                    <div class="category"><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}">{{ $list->category->name ?? 'Uncategorized'  }}</a></div>
                                    <h5><a href="{{url('/success-story-details/'.$list->id.'/'.$list->slug)}}">{{ $list->title }}</a></h5>
                                </div>
                               @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget tags-widget">
                        <div class="widget-title">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="tags-list clearfix">

                                <li><a href="#">{{$detail->meta_tags}}</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    {{--<div class="sidebar-widget archives-widget">
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






<!-- related-products -->
{{-- <section class="related-products">
    <div class="auto-container">
        <div class="title-box">
            <h3>Related Success Stories</h3>
        </div>
        <div class="row">
            @foreach($newpro  as $list)
                <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ asset('backend/story/'.$list->image) }}" alt="">

                            </figure>
                            <div class="lower-content">
                                
                                <a href="#">{{ $list->title }}</a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}
<!-- related-products end -->

<script type="text/JavaScript">
    function enableEmail() {
                document.getElementById("hiddenemail").classList.remove("d-none");
                document.getElementById("hidewhatsapp").classList.remove("d-none");
            }
        
        
</script>

@endsection
