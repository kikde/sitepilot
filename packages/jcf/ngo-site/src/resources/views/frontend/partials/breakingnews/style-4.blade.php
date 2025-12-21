<section class="rp-card">
  <header class="rp-head">
<span class="rp-title" style="color:#ff7a00; font-weight:700;">
  Latest Activity
</span>
    <span class="rp-icon" aria-hidden="true">⚡</span>
  </header>

  <div class="rp-grid">
       @foreach( $newspost as $newslist)
    <!-- Card 1 -->
    <article class="rp-item">
     
      <a class="rp-thumb" href="{{url('/news-details/'.$newslist->id.'/'.$newslist->slug)}}">
        <img src="{{asset('backend/uploads/'.$newslist->breadcrumb)}}" alt="">
      </a>
      <h3 class="rp-link"><a href="{{url('/news-details/'.$newslist->id.'/'.$newslist->slug)}}">{{$newslist->pagetitle}}</a></h3>
      <div class="rp-meta">
        <time datetime="2024-02-03">{{ $newslist->updated_at->format('F d, Y') }}</time>
      </div>
    </article>

  @endforeach

<div class="all-activity" style="display:flex; justify-content:center; margin-top:16px;">
    <a href="{{url('/news-post')}}"
       class="activity-btn"
       style="
           background: linear-gradient(90deg, #6ab4cf, #00a5e2);
           color: #ffffff;
           padding: 8px 28px;
           border-radius: 999px;
           font-weight: 700;
           text-decoration: none;
           display: inline-flex;
           align-items: center;
           justify-content: center;
           border: none;
       ">
        View All Activity
    </a> 
</div>
</section>


   