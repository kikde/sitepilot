
@php
  $storyUrl = url('/success-story-details/'.$detail->id.'/'.$detail->slug);
  $waText = "👍 I am intersted in your product\n👉 ".$storyUrl."\n😎 Thanks";
  $waUrl = 'https://api.whatsapp.com/send?phone=' . ($setting->phone ?? '') . '&text=' . rawurlencode($waText);
@endphp

<style>

</style>

<!-- sidebar-page-container -->
<section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="content-one">
                        <figure class="image-box">
                           @if($detail->image)
                                <img src="{{asset('backend/story/'.$detail->image)}}" alt="">
                           @else
                                <img src="{{asset('frontend/custom/breadcrump.png')}}" alt="">
                           @endif
                        </figure>
                        <div class="text">
                            <h3>{{ $detail->title }}</h3>
                            <p>{{$detail->excerpt}}</p>
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
                            <li><a href="{{ $waUrl }}"><i class="fab fa-whatsapp"></i>Whatsapp</a></li>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- sidebar-page-container end -->

<script type="text/JavaScript">
    function enableEmail() {
                document.getElementById("hiddenemail").classList.remove("d-none");
                document.getElementById("hidewhatsapp").classList.remove("d-none");
            }
</script>

