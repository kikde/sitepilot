@php use Illuminate\Support\Str; @endphp
@extends('layouts.master')

@section('content')
<section class="ng-grid2">
  <header class="ng-head">
    <span class="ng-title">All Events</span>
  </header>
@if(count($event)> 0)
  <div class="ng-grid">
    @foreach($event as $eventlist)
      <article class="ng-card">
        <a class="ng-thumb" href="#p1">
          <img src="{{asset('backend/events/'.$eventlist->image)}}" alt="">
        </a>

        {{-- Limit to 20 words and max 4 visible lines --}}
        <h3 class="ng-link text-limit-4">
          <a href="{{url('/event-details/'.$eventlist->id.'/'.$eventlist->slug)}}">{{ Str::words($eventlist->title, 20, '…') }}</a>
        </h3>

        <div class="ng-meta">
          <time datetime="{{ $eventlist->updated_at->toDateString() }}">
            {{ $eventlist->updated_at->format('F j, Y') }}
          </time>
        </div>
      </article>
    @endforeach


  </div>
      <div class="pagination-wrapper centred">
      {{ $event->links('vendor.pagination.default') }}
    </div>
                        @else
                <h5 class="justify-content-center"> No Data found</h5>
    @endif
</section>
@endsection