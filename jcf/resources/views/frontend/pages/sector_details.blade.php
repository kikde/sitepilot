@extends('layouts.master')

@section('content')


        <!-- Page Title -->
        <section class="page-title style-two centred" style="background-image: url({{asset('/backend/uploads/'.$sectorpage->breadcrumb)}});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>{{$sectorpage->sector_name}}</h1>
                    </div>
                   
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- service-details -->
        <section class="service-details">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="service-sidebar">
                            <div class="sidebar-widget category-widget">

                                <ul class="category-list clearfix">
                                    @foreach($sectors as $key=>$items)
                                  
                                 
                                     <li><a href="{{url('/objective-details/'.$items->id.'/'.$items->slug)}}" class="
                                        @if($items->id == $sectorpage->id)
                                         current
                                         @else ' '
                                          @endif">{{$items->sector_name}}</a></li>
                                
                                    @endforeach
                                </ul>
                               
                            </div>
                            <div class="sidebar-widget banner-widget">
                                <div class="form-inner">
                                    <a href="{{url('/user-donate')}}"><div class="widget-content" style="background-image: url({{asset('frontend/assets/images/background/1.png')}});">
                                    {{-- <div class="shape" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div> --}}
                                    {{-- <div class="content-box"> --}}
                                        {{-- <div class="icon-box"> --}}
                                            {{-- <i class="flaticon-money"></i> --}}
                                            {{-- <div class="icon-shape" style="background-image: url({{asset('frontend/assets/images/icons/star-7.png')}});"></div> --}}
                                        {{-- </div> --}}
                                        {{-- <h3>Give what you can.</h3> --}}
                                        {{-- <a href="{{url('/')}}" class="theme-btn-two">Donate Now</a>
                                    </div> --}}
                                </div></a>
                            </div>
                                <div class="form-inner">
                                    <h3>Become Member Now</h3>
                                    <a href="{{url('/user-donate')}}"><div class="widget-content" style="background-image: url({{asset('frontend/assets/images/background/2.png')}});">
                                        {{-- <div class="shape" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div> --}}
                                        {{-- <div class="content-box">
                                            <div class="icon-box">
                                                <i class="flaticon-man"></i>
                                                <div class="icon-shape" style="background-image: url({{asset('frontend/assets/images/icons/star-7.png')}});"></div>
                                            </div>
                                            <h3>Give what you can.</h3>
                                            <a href="{{url('/user-donate')}}" class="theme-btn-two">Rgister Now</a>
                                        </div> --}}
                                    </div></a>
                                    {{-- <form action="{{url('/send-mail')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Your Name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email Address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="mobile" placeholder="Phone"  />
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Write Your Text..."></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn-four thm-btn">Send Message</button>
                                        </div>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="service-details-content">
                            <div class="content-one">
                                {{-- <figure class="image-box"><img src="{{asset('frontend/assets/images/service/service-8.jpg')}}" alt=""></figure> --}}
                                {{-- <h3>{{$sectorpage->Heading}}</h3> --}}
                                <div class="text mylist">
                                    <p>{!!$sectorpage->description!!}</p>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-details end -->


@endsection