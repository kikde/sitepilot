         <!-- subscribe-section -->
        <section class="subscribe-section bg-color-1">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                        <div class="text">
                            <h3><i class="flaticon-email-1"></i>Subscribe Our Newsletter</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                        <form action="{{url('/')}}" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your email address ..." required="">
                                <button type="submit" class="theme-btn-two">Subscribe Us</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-section end -->
 
 
 <!-- main-footer -->
      <footer class="main-footer bg-color-2">
        <div class="auto-container">
            <div class="footer-top">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="{{url('/')}}"><img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" height="150" width="150" alt=""></a></figure>
                            <div class="text"> 
                                <p>{{$setting->meta_description}} </p>
                            </div>
                            <ul class="award-list clearfix">
                                <li><img src="{{asset('frontend/assets/images/resource/award-1.png')}}" alt=""></li>
                                <li><img src="{{asset('frontend/assets/images/resource/award-2.png')}}" alt=""></li>
                                <li><img src="{{asset('frontend/assets/images/resource/award-3.png')}}" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h4>Company</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('/about')}}">About Us</a></li>
                                    <li><a href="{{url('/our-team')}}">Management Team</a></li>
                                    <li><a href="{{url('/our-members')}}">Members</a></li>
                                    <li><a href="{{url('/objective-details')}}">Objective</a></li>
                                    <li><a href="{{url('/all-donars')}}">Donars</a></li>
                                    <li><a href="{{url('/media-gallery')}}">Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h4>Our Work</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    @foreach($footermenu as $sector)
                                    <li><a href="{{url('/sector-details/'.$sector->id.'/'.$sector->slug)}}">{{$sector->sector_name}}</a></li>
                                    @endforeach
                                    {{-- <li><a href="{{url('/')}}">PharmaCeutical</a></li>
                                    <li><a href="{{url('/about')}}">Hospitality & Travel</a></li>
                                    <li><a href="{{url('/')}}">Mineral Water</a></li>
                                    <li><a href="{{url('/')}}">School & Institute</a></li>
                                    <li><a href="{{url('/our-clients')}}">Private & Public </a></li> --}}
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h4>Essentials</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="{{url('/faq')}}">FAQ's</a></li>
                                    <li><a href="{{url('/')}}">Privacy Policy</a></li>
                                    <li><a href="{{url('/')}}">Terms & Conditions</a></li>
                                    <li><a href="{{url('/')}}">Our Team</a></li>
                                    <li><a href="{{url('/')}}">Refund Policy</a></li>
                                    <li><a href="{{url('/')}}">Desclimiar</a></li>
                                    <li><a href="{{url('/contact')}}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget contact-widget">
                            <div class="widget-title">
                                <h4>Get In Touch</h4>
                            </div>
                            <ul class="info clearfix"> 
                                <li>
                                    <a href="tel:{!!$setting->phone!!}">{!!$setting->phone!!}</a><br/>
                                    <a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a>
                                    <br/>{{$setting->address}}
                                </li>
                               
                            </ul>
                            <ul class="footer-social clearfix">
                                <li><a href="{{$setting->facebook_url}}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{$setting->insta_url}}"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom centred">
                <p>&copy; 2025 By <a href="{{url('/')}}">{{$setting->site_url}}</a>, Powered By Kikde Group. All Rights Reserved. </p>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->

     <!--Scroll to top-->
