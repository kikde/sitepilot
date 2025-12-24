@extends('layouts.master')

@section('content')


   <!-- Page Title -->
   <section class="page-title style-two centred" style="background-image: url({{asset('backend/uploads/'.$privacy->breadcrumb)}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{$privacy->name }}</h1>
            </div>
           
        </div>
    </div>
</section>
<!-- End Page Title -->


<section class="feature-style-two sec-pad">
    <div class="auto-container">
        <div class="upper-content">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 title-column">
                    <div class="sec-title text-left justify-content-evenly ">
                        <h4>{{$privacy->name }}</h4>
                        <div class="text">
                        <h2>{{$privacy->name}}</h2>
                        <p>{!! $privacy->description !!}</p>
                         </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

 <!-- review-page-section -->
 <section class="review-page-section">
    <div class="auto-container">
        <div class="row clearfix">

            @if(count($review)>0)
            @foreach($review as $list)
            <div class="col-lg-4 col-md-12 col-sm-12 testimonial-block">

               
                <div class="testimonial-block-two">
                    <div class="inner-box">
                        {{-- <figure class="image-box">
                            <img src="{{asset('backend/testimonial/'.$list->images)}}" alt="">
                            
                        </figure> --}}
    
                        <div class="icon-box"><i class="flaticon-quote"></i></div>
                        {{-- <h4>Local Upstanding & Reliable</h4> --}}
                        <ul class="rating-box clearfix">
                            @for ($i = 0; $i < $list->rating; $i++)
                                                <li><i class="fas fa-star"></i></li>
                                                @endfor
                        </ul>
    
                        <p>
                            {!! \Illuminate\Support\Str::limit(strip_tags($list->description), 118) !!}
    
                            @if (strlen(strip_tags($list->description)) > 118)
                            <button  class="designation" href="#" onclick="openmodel('{{$list->description}}')">Read More</button>
                            @endif
                        </p>

                            {{-- {!! $list->description !!} --}}
                        <div class="author-info">
                            <h4>{{$list->name}}</h4>
                            <span class="designation">{{$list->desg}}</span>
                        </div>
                    </div>
                </div>
               
            </div>
            @endforeach
            @else
            <h1>No Data Found</h1>
             @endif
        </div>
    </div>
</section>
<!-- review-page-section end -->
@endsection