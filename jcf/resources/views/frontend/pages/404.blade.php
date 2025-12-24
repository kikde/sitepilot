@extends('layouts.master')

@section('content')

 <!-- Page Title -->
 <section class="page-title style-two centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-2.jpg')}});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>404</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="index.php">Home</a></li>
                <li>About</li>
                <li>Error</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->



<!-- error-section -->
<section class="error-section centred">
    <div class="auto-container">
        <div class="inner-box">
            <h1>Lost Your Way ?</h1>
            <h2>Sorry, We can't find that page. You'll find loads</br> to explore on the home page. </h2>
            <a href="index.php" class="theme-btn-three thm-btn">Ace Home</a>
        </div>
    </div>
</section>
<!-- error-section end -->

@endsection