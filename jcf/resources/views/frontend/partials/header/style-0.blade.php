<!-- Fancy Ribbon Header -->
<header class="mh-header">
  <div class="mh-inner">
    <!-- Logo badge -->
    <a href="/" class="mh-logo" aria-label="Home">
      <img src="{{ asset('backend/uploads/'.$setting->site_logo) }}" alt="" />
    </a>

    <!-- Hindi Title -->
 <div class="mh-title">
  <span class="mh-line1">{{$setting->title}}</span>
  <span class="mh-line2">{{$setting->meta_keywords}}</span>
</div>
  </div>
</header>