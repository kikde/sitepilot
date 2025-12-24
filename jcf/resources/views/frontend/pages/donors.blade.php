@extends('layouts.master')

@section('content')

        <!-- Page Title -->
        @if(!$bannerimg == 0)
        <section class="page-title centred" style="background-image: url({{asset('/backend/uploads/'.$bannerimg->breadcrumb)}});">
            @else 
            <section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/default-banner.jpg')}});">
            @endif
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Donors</h1>
                    </div>
                  
                </div>
            </div>
        </section>
        <!-- End Page Title -->

        <section class="service-style-three sec-pad-2 elements">
            <div class="auto-container">
                @if(count($donars)> 0)
                <div class="row clearfix">
                    @foreach($donars as $list)
                    <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                        <div class="service-block-two">
                            <div class="inner-box">
                                <div class="image-box">
                                    <div class="shape-1" style="background-image: url({{asset('frontend/assets/images/icons/star-4.png')}});"></div>
                                    <div class="shape-2" style="background-image: url({{asset('frontend/assets/images/icons/star-5.png')}});"></div>
                                    <div class="shape-3" style="background-image: url({{asset('frontend/assets/images/shape/shape-7.png')}});"></div>
                                    @if($list->profile)
                                    <figure class="image"><a href="{{url('/')}}"><img src="{{asset('backend/uploads/'.$list->profile)}}" alt=""></a></figure>
                                    @else
                                    <figure class="image"><a href="{{url('/')}}"><img src="{{asset('frontend/custom/user.png')}}" alt=""></a></figure>
                                    @endif
                                </div>
                                <div class="lower-content">
                                    <h4><a href="service-2.html">{{$list->name}}</a></h4>
                                    {{-- <p>Beguiled and demoralized by the charms pleasures the moment</p>
                                    <div class="link"><a href="{{url('/')}}">Read More</a></div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $donars->links('vendor.pagination.default') }} 
                @else
                <h5 class="justify-content-center"> No Data found</h5>
                @endif
                 
                 
 
                  
               
            </div>
        </section>




    


@endsection