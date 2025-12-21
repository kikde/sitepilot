@extends('coreauth::layouts.base')

@section('content')
  <div class="container py-3">
    <div class="mb-3">
      <h3 class="mb-0">{{ $page->title ?? $page->slug }}</h3>
      @if(!$page->published)
        <span class="badge bg-warning text-dark">Draft</span>
      @endif
    </div>
    <div class="uitpl-rendered">
      {!! $html !!}
    </div>
  </div>
@endsection
