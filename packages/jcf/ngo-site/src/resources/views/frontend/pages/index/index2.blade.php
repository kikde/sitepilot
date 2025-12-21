@extends('layouts.master')

<!-- MINIFIED -->

@section('content')

{!! SEO::generate(true) !!}

  
   @include ("frontend.partials.ticker.style-2")
   @include ("frontend.partials.banner.style-1")
   @include ("frontend.partials.ticker.style-4") <!--Frams Ticker-->
   @include ("frontend.partials.breakingnews.style-1")
   @include('frontend.partials.volunteers.style-2')
   @include('frontend.partials.team.style-4')
   @include ("frontend.partials.about.style-4") 
   @include ("frontend.partials.message.presidentmessage")
   @include ("frontend.partials.blog.style-1")
   @include ("frontend.partials.review.style-1") 
   @include ("frontend.partials.gallery.style-1")
   @include ("frontend.partials.ads.style-7")




@endsection


