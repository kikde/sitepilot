<!-- Breaking News Widget -->
<section class="bn-card">
  <header class="bn-head">
    <span class="bn-title">Latest Activity</span>
    <span class="bn-icon" aria-hidden="true">🗞️</span>
  </header>
  <ol class="bn-list">

   @foreach( $newspost as $newslist)
    <!-- item 1 -->
    <li class="bn-item">
      <a class="bn-thumb" href="#news-1" aria-label="Read more">
        <img src="{{asset('backend/uploads/'.$newslist->breadcrumb)}}" alt="">
      </a>
      <span class="bn-num">1</span>
      <div class="bn-body">
        <a class="bn-link" href="#news-1">
        {{$newslist->pagetitle}}
        </a>
        <div class="bn-meta">
          <time datetime="2025-09-27">{{ $newslist->created_at->format('F d, Y') }}</time>
        </div>
      </div>
    </li>
  @endforeach


   
    
  </ol>
</section>




