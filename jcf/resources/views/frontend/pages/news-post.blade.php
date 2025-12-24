@extends('layouts.master')

@section('content')

<section class="ng-grid2">
  <header class="ng-head">
    <span class="ng-title">All Posts</span>
  </header>

  <div class="ng-grid">
    <!-- Card 1 -->
   @if(count($newspost)> 0)
        @foreach( $newspost as $newslist)
        <article class="ng-card">
        <a class="ng-thumb" href="#p1">
            <img src="{{asset('backend/uploads/'.$newslist->breadcrumb)}}" alt="">

            
        </a>
        <h3 class="ng-link"><a href="{{url('/news-details/'.$newslist->id.'/'.$newslist->slug)}}">{{$newslist->pagetitle}}</a></h3>
        <div class="ng-meta"><time datetime="2024-02-03">{{ $newslist->updated_at->format('F d, Y') }}</time></div>
        </article>
        @endforeach
            {{ $newspost->links('vendor.pagination.default') }} 
                        @else
                <h5 class="justify-content-center"> No Data found</h5>
    @endif
    
  </div>
</section>

@endsection









