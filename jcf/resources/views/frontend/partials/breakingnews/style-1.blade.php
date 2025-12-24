
<div id="kp-btns-4">
  <div class="wrap">
         <div class="section">  
      <div class="row">      
        <button class="btn pill" style="background:#fff; color:#1a52ff; border:3px solid #392482">Recent Activity</button>
      </div>
    </div>
    </div>
  </div>
<section class="ng-grid2">
  <header class="ng-head">
    <span class="ng-title">Recent Posts</span>
  </header>

  <div class="ng-grid">
    <!-- Card 1 -->

    @foreach( $newspost as $newslist)
    <article class="ng-card">
      <a class="ng-thumb" href="#p1">
        <img src="{{asset('backend/uploads/'.$newslist->breadcrumb)}}" alt="">
      </a>
      <h3 class="ng-link"><a href="#p1">{{$newslist->pagetitle}}</a></h3>
      <div class="ng-meta"><time datetime="2024-02-03">{{ $newslist->created_at->format('F d, Y') }}</time></div>
    </article>
    @endforeach

   
  </div>
</section>












