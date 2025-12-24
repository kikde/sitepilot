@extends('layouts.master')

@section('content')
<style>
    .page-title.style-two {
  width: 100%;
  height: 120px; 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  margin: 0;
  padding: 0;
  border: none;
}
    </style>

        <!-- Page Title -->
        <!--<section class="page-title style-two centred"-->
        <!--    style="background-image: url({{asset('frontend/assets/images/background/team-management.png')}});">-->
        <!--    <div class="auto-container">-->
        <!--        <div class="content-box">-->
        <!--            <div class="title">-->
        <!--                <h1>Management Team</h1>-->
        <!--            </div>-->
                 
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- End Page Title -->

     

      @include('frontend.partials.team.style-2')

        @include('frontend.partials.blog.style-1')

@endsection