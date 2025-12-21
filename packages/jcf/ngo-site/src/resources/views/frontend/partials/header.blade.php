 <!-- main header -->
  <header class="main-header style-five">
      <div class="page-header-mobile-info">
          <div class="page-header-mobile-info-content">
              <!-- header-top -->
              <div class="header-top-two">
                  <div class="auto-container">
                      <div class="top-inner clearfix">
                          <ul class="info pull-left clearfix">
                              <li><i class="flaticon-telephone"></i>For Enquiries <a href="tel:+91-9852525297">{{$setting->phone}}</a></li>
                              <li><i class="flaticon-email"></i><a
                                      href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></li>
                          </ul>
                          <ul class="info pull-right clearfix">
                            <li><i class="flaticon-appointment"></i><a href="{{route('register')}}">Register</a></li> 
                            <li><i class="flaticon-home"></i><a href="{{route('login')}}">Login</a></li>
                            
                        </ul>
                         
                      </div>
                  </div>
              </div>
              <!-- header-upper -->
              <div class="header-upper">
                  <div class="auto-container">
                      <div class="upper-inner clearfix">
                          {{-- <div class="logo-box pull-left">
                              <figure class="logo"><a href="{{url('/')}}"><img
                                          src="{{ asset('backend/uploads/'.$setting->site_logo) }}"
                                          alt=""></a></figure>
                          </div> --}}
                          <div class="right-column pull-right">
                              <ul class="info-list clearfix">
                                  <li>
                                      <div class="shape"
                                          style="background-image: url({{ asset('frontend/assets/images/icons/star-8.png') }});">
                                      </div>
                                      <i class="flaticon-location"></i>
                                      <h6>Location</h6>
                                      <h5>{{$setting->address}}</h5>
                                  </li>
                                  <li>
                                      <div class="shape"
                                          style="background-image: url({{ asset('frontend/assets/images/icons/star-8.png') }});">
                                      </div>
                                      <i class="flaticon-circular-clock"></i>
                                      <h6>Off. Hours</h6>
                                      {{-- <h5>9.00 to 7.00 [sun: closed]</h5> --}}
                                  </li>
                                  {{-- <li class="btn-box">
                                      <a href="{{ url('/') }}"
                                          class="theme-btn-four thm-btn">Request a Quote</a>
                                  </li> --}}
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- <div class="toggle-box clearfix">
              <div class="page-header-mobile-info-toggle"></div>
              <div class="btn-box">
                  <a href="{{route('login')}}" class="theme-btn-four thm-btn">Login</a>
              </div>
          </div> -->
      </div>
      <!-- header-top -->
      <div class="header-top-two auto-hidden">
          <div class="auto-container">
              <div class="top-inner clearfix">
                  <ul class="info pull-left clearfix">
                      <li><i class="flaticon-telephone"></i>For Enquiries <a href="tel:+91-9852525297">{{$setting->phone}}</a>
                      </li>
                      <li><i class="flaticon-email"></i><a
                              href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></li>
                  </ul>
                  <ul class="info pull-right clearfix">
                    <li><i class="flaticon-property"></i><a href="{{url('/user-donate')}}">Donates</a></li>   
                    <li><i class="flaticon-appointment"></i><a href="{{route('register')}}">Register</a></li>   
                    <li><i class="flaticon-home"></i><a href="{{route('login')}}">Login</a></li>
                    
                </ul>
              </div>
          </div>
      </div>
      <!-- header-upper -->
      

      <!-- header-lower -->
      <div class="header-lower">
          <div class="auto-container">
              <div class="outer-box clearfix">
                  <div class="menu-area pull-left clearfix">
                      <!--Mobile Navigation Toggler-->
                      <div class="mobile-nav-toggler">
                          <i class="icon-bar"></i>
                          <i class="icon-bar"></i>
                          <i class="icon-bar"></i>
                      </div>
                      <nav class="main-menu navbar-expand-md navbar-light">
                          <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                              <ul class="navigation clearfix">
                                <div class="logo-box pull-left">
                                    <figure class="logo"><a href="shop-details"><img
                                                src="{{ asset('backend/uploads/'.$setting->site_logo) }}" 
                                                alt="" ></a></figure>
                                </div>
                                  <li class=" {{Request::is('/') ? 'current': ''}}"><a href="{{ url('/') }}">Home</a> </li>
                                 

        
                                 
                                  <li class="dropdown {{Request::is('about') ? 'current': ''}}"><a href="{{ url('/about') }}">About</a>
                                    <ul>
                                          <li>
                                            <a href="{{ url('/news-post') }}">Breaking News</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/success-story') }}">Success Stories</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/support-ticket') }}">Support Ticket</a>
                                        </li>
                                        <li><a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
                                                <li><a href="{{ url('/privacy-policy') }}">Privacy Policy </a></li>
                                      
                                        </li>
                                    </ul>
                                  
                                  </li>
                                  <li class="dropdown {{Request::is('our-team') ? 'current': ''}}"><a href="{{ url('our-management-body') }}">Management Body</a>   
                                  </li>

                                
                                  <li class="dropdown {{Request::is('all-donars') ? 'current': ''}}"><a
                                          href="{{ url('/donors') }}">Donors</a>
                                     
                                  </li>
                                  <li class="{{Request::is('our-members') ? 'current': ''}}"><a href="{{ url('/our-members') }}">Members</a></li>
                                  
                                  <li class="dropdown {{Request::is('objective') ? 'current': ''}}"><a href="#">Objective</a> 
                                    {{-- <a href="{{ url('our-sectors') }}">Sectors</a> --}}
                                    
                                <ul>
                                
                                  @foreach($secmenu as $items)
                                  
                                  @if($items->pagestatus == "Published")
                                  <li class="{{Request::is('objective-details') ? 'current': ''}}"><a href="{{ url('/objective-details/'.$items->id.'/'.$items->slug) }}">{{$items->sector_name}}</a></li>
                                  @endif
                                  @endforeach                          
                                    
                                </ul>
                               
                            </li>
                                  {{-- <li><a href="{{ url('/faq') }}">Faq</a></li> --}}

                                  <li class="dropdown"><a href="#">Gallery</a>
                                      <ul>
                                        <li class="{{Request::is('photo-gallery') ? 'current': ''}}">
                                            <a href="{{ url('/photo-gallery') }}">Photo Gallery</a>
                                        </li>
                                        <li class="{{Request::is('video-gallery') ? 'current': ''}}">
                                            <a href="{{ url('/video-gallery') }}">Video Gallery</a>
                                        </li>
                                      </ul>
                                </li>
                                  <li class="{{Request::is('contact') ? 'current': ''}}"><a href="{{ url('/contact') }}">Contact Us</a></li>
                              </ul>
                              
                          </div>
                      </nav>
                  </div>
                  <div class="menu-right-content clearfix">
                      {{-- <div class="cart-box"><a href="index.php"><i class="flaticon-shopping-bag"></i><span>0</span></a></div> --}}
                      {{-- <div class="search-box-outer">
                          <div class="dropdown">
                              <button class="search-box-btn" type="button" id="dropdownMenu3" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false"><i class="flaticon-loupe"></i></button>
                              <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu3">
                                  <div class="form-container">
                                      <form method="post" action="#">
                                          <div class="form-group">
                                              <input type="search" name="search-field" value="" placeholder="Search...."
                                                  required="">
                                              <button type="submit" class="search-btn"><span
                                                      class="fas fa-search"></span></button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div> --}}
                     
                      <ul class="social-links clearfix">
                    
                        <li><a href="{{url($setting->facebook_url)}}"><i class="fab fa-facebook-f"></i></a></li>
                        
                        <li><a href="{{url($setting->twitter)}}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{url($setting->insta_url)}}"><i class="fab fa-instagram"></i></a></li>
                        {{-- <li><a href="{{url($setting->insta_url)}}"><i class="fab fa-whatsapp"></i></a></li> --}}
                      </ul>
                  </div>
              </div>
          </div>
      </div>

      <!--sticky Header-->
       <div class="sticky-header">
          <div class="auto-container">
              <div class="outer-box clearfix">
                  <div class="menu-area pull-left">
                      <nav class="main-menu clearfix">
                          <!--Keep This Empty / Menu will come through Javascript-->
                      </nav>
                  </div>
                  <div class="menu-right-content clearfix">
                      {{-- <div class="cart-box"><a href="#"><i class="flaticon-shopping-bag"></i><span>0</span></a></div> --}}
                      {{-- <div class="search-box-outer">
                          <div class="dropdown">
                              <button class="search-box-btn" type="button" id="dropdownMenu4" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false"><i class="flaticon-loupe"></i></button>
                              <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu4">
                                  <div class="form-container">
                                      <form method="post" action="#">
                                          <div class="form-group">
                                              <input type="search" name="search-field" value="" placeholder="Search...."
                                                  required="">
                                              <button type="submit" class="search-btn"><span
                                                      class="fas fa-search"></span></button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div> --}}
                      
                      <ul class="social-links clearfix">
                      
                        <li><a href="{{url($setting->facebook_url)}}"><i class="fab fa-facebook-f"></i></a></li>
                        
                        <li><a href="{{url($setting->twitter)}}"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{url($setting->insta_url)}}"><i class="fab fa-instagram"></i></a></li>
                        {{-- <li><a href="{{url($setting->insta_url)}}"><i class="fab fa-whatsapp"></i></a></li> --}}
                      </ul>
                  </div>
              </div>
          </div>
      </div>  
  </header>
  <!-- main-header end -->


  <!-- Mobile Menu  -->
  <div class="mobile-menu">
      <div class="menu-backdrop"></div>
      <div class="close-btn"><i class="fas fa-times"></i></div>

      <nav class="menu-box">
          {{-- <div class="nav-logo"><a href="#"><img
                      src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="" title=""></a>
          </div> --}}
          <div class="menu-outer">
              <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
          </div>
          <div class="contact-info">
              <h4>Contact Info</h4>
              <ul>
                  <li>{{$setting->address}}</li>
                  <li><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
                  <li><a href="mailto:{{$setting->site_email}}">{{$setting->site_email}}</a></li>
              </ul>
          </div>
          <div class="social-links">
              <ul class="clearfix">
                <li><a href="{{url($setting->facebook_url)}}"><i class="fab fa-facebook-f"></i></a></li>
                        
                <li><a href="{{url($setting->twitter)}}"><i class="fab fa-twitter"></i></a></li>
                <li><a href="{{url($setting->insta_url)}}"><i class="fab fa-instagram"></i></a></li>
              </ul>
          </div>
      </nav>
  </div><!-- End Mobile Menu -->