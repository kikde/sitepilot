@extends('layouts.master')
<!-- MINIFIED -->
@section('content')

{!! SEO::generate(true) !!}
  
   @include ("frontend.partials.ticker.style-2")                  <!--Ticker Section-->
   @include ("frontend.partials.banner.style-1")              <!--Banner Section-->

   @include ("frontend.partials.todo.quick-link")                 <!--QUICK LINK-->

     @include ("frontend.partials.todo.style-1")               <!--What we do-->

    {{--@include ("frontend.partials.ticker.style-31")--}}
   
   @include ("frontend.partials.message.presidentmessage")           <!--Messgae-->

   @include ("frontend.partials.breakingnews.style-4")                <!--Latest Activity-->

   @include ("frontend.partials.breakingnews.style-3")                <!--upcoming events section-->
    
   @include ("frontend.partials.events.style-2")                      <!--upcoming events Slider--> 

   @include ("frontend.partials.ticker.style-1")
 
   @include('frontend.partials.team.style-2')                <!--Management Team-->

    @include('frontend.partials.volunteers.style-3')               <!--Members-->
   
  @include('frontend.partials.donor.style-1')          <!--Donor-->
   
  @include('frontend.partials.faq.style-1') 
   
  
   @include('frontend.partials.join.join-2')                   <!--Member Apply-->
   @include('frontend.partials.join.join-3')
   @include('frontend.partials.youtube.style-11')              <!--youtube-->
   @include ("frontend.partials.about.style-4")  
   @include ("frontend.partials.blog.style-1")                 <!--Objective-->
   @include ("frontend.partials.story.style-1")
   
 
  @include ("frontend.partials.crowdfunding.style-1")         <!--crowdfunding-->

  @include ("frontend.partials.review.style-1")               <!--Testimonial-->


  @include ("frontend.partials.gallery.style-1")              <!--Gallery / Certificate style-1-->

  @include('frontend.partials.certificate.style-2')

  
  @include ("frontend.partials.awards.style-2")

  @include('frontend.partials.forms.donation.style-3')     <!--Form Donation-->
   

   @include ("frontend.partials.ads.style-7")
   @include ("frontend.partials.ads.style-8")            <!--Management Team-->

@endsection




