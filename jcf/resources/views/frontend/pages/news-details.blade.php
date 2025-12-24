@extends('layouts.master')

@section('content')

<style>
  /* Scoped only to this page */
  .news-detail-page{
    background:#f9fafb;
    padding:40px 0 60px;
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Noto Sans", Arial, sans-serif;
  }

  .news-detail-page .nd-wrapper{
    max-width:1140px;
    margin:0 auto;
  }

  .news-detail-page .nd-main{
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 18px 40px rgba(15,23,42,.12);
    padding:20px 20px 28px;
  }

  @media (min-width:992px){
    .news-detail-page .nd-main{
      padding:26px 28px 32px;
    }
  }

  .news-detail-page .nd-hero{
    position:relative;
    border-radius:16px;
    overflow:hidden;
    margin-bottom:18px;
    background:#111827;
  }

  .news-detail-page .nd-thumb img{
    width:100%;
    display:block;
    object-fit:cover;
    max-height:420px;
  }

  .news-detail-page .nd-meta-strip{
    position:absolute;
    left:16px;
    bottom:16px;
    right:16px;
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
    gap:8px;
    align-items:center;
    padding:8px 14px;
    border-radius:999px;
    background:linear-gradient(90deg, rgba(220,53,69,.9), rgba(239,90,40,.9));
    color:#fff;
    font-size:.82rem;
  }

  .nd-badge{
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.08em;
  }

  .nd-date{
    display:flex;
    align-items:center;
    gap:6px;
  }

  .nd-date i{
    font-size:.9rem;
  }

  .news-detail-page .nd-header{
    margin-bottom:14px;
  }

  .nd-title{
    font-size:1.7rem;
    font-weight:800;
    color:#111827;
    margin-bottom:6px;
    line-height:1.25;
  }

  @media (min-width:992px){
    .nd-title{
      font-size:2rem;
    }
  }

  .nd-subtitle{
    margin:0;
    color:#6b7280;
    font-size:.95rem;
  }

  /* Share strip */
 /* base (desktop / tablet) */
.nd-share-strip{
  display:flex;
  flex-wrap:wrap;
  align-items:center;
  gap:8px;
  padding:10px 12px;
  border-radius:16px;
  background:#f3f4ff;
  border:1px solid #e0e7ff;
  margin-bottom:18px;
}

.nd-share-strip .label{
  font-size:.85rem;
  font-weight:600;
  color:#1f2937;
  margin-right:6px;
}

/* buttons */
.nd-share-link{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:6px;
  padding:6px 12px;
  border-radius:999px;
  font-size:.8rem;
  font-weight:600;
  border:none;
  text-decoration:none;
  cursor:pointer;
  transition:.18s;
  white-space:nowrap;
}

.nd-share-link i{
  font-size:.9rem;
}

/* colors */
.nd-share-link.fb{
  background:#1877f2;
  color:#fff;
}
.nd-share-link.x{
  background:#0f172a;
  color:#fff;
}
.nd-share-link.wa{
  background:#16a34a;
  color:#fff;
}
.nd-share-link.copy{
  background:#ffffff;
  color:#111827;
  border:1px solid #e5e7eb;
}

.nd-share-link:hover{
  transform:translateY(-1px);
  box-shadow:0 8px 18px rgba(15,23,42,.1);
}

  /* Content */
  .nd-content{
    color:#111827;
    font-size:.98rem;
    line-height:1.7;
  }

  .nd-content p{
    margin-bottom:1rem;
  }

  .nd-content h2,
  .nd-content h3,
  .nd-content h4{
    margin-top:1.2rem;
    margin-bottom:.4rem;
    font-weight:700;
    color:#111827;
  }

  .nd-tags{
    margin-top:18px;
    display:flex;
    flex-wrap:wrap;
    gap:8px;
  }

  .nd-tag{
    font-size:.78rem;
    padding:4px 10px;
    border-radius:999px;
    background:#fef2f2;
    color:#b91c1c;
    border:1px solid #fecaca;
  }

  /* Sidebar */
  .nd-sidebar{
    background:#0b1120;
    color:#e5e7eb;
    border-radius:18px;
    padding:18px 16px 20px;
    box-shadow:0 18px 34px rgba(15,23,42,.22);
  }

  .nd-sidebar-title{
    font-size:1.1rem;
    font-weight:700;
    margin-bottom:6px;
    color:#f9fafb;
  }

  .nd-sidebar-sub{
    font-size:.8rem;
    color:#9ca3af;
    margin-bottom:16px;
  }

  .nd-recent-list{
    list-style:none;
    padding:0;
    margin:0;
    display:flex;
    flex-direction:column;
    gap:10px;
  }

  .nd-recent-item{
    display:flex;
    gap:10px;
  }

  .nd-recent-thumb img{
    width:70px;
    height:55px;
    object-fit:cover;
    border-radius:8px;
    border:2px solid rgba(251,113,133,.4);
  }

  .nd-recent-body{
    flex:1;
  }

  .nd-recent-body a{
    display:block;
    font-size:.84rem;
    font-weight:600;
    color:#e5e7eb;
    text-decoration:none;
  }

  .nd-recent-body a:hover{ color:#f97316; }

  .nd-recent-date{
    font-size:.75rem;
    color:#9ca3af;
  }

  @media (max-width:991.98px){
    .news-detail-page{
      padding:24px 0 40px;
    }
    .nd-sidebar{
      margin-top:16px;
    }
  }
  @media (max-width: 575.98px){
  .nd-share-strip{
    flex-direction:column;
    align-items:stretch;
    gap:6px;
    padding:10px 10px 12px;
    border-radius:14px;
  }

  .nd-share-strip .label{
    margin:0 0 2px 2px;
  }

  .nd-share-link{
    width:100%;                 /* full-width buttons */
    justify-content:flex-start; /* icon + text left like apps */
    padding:8px 12px;
    border-radius:10px;
  }

  .nd-share-link i{
    font-size:1rem;
  }
}
/* MOBILE: icon-only buttons in a HORIZONTAL row */
@media (max-width: 767.98px){
  .nd-share-strip{
    display:flex;
    flex-direction:row;       /* row, not column */
    align-items:center;
    justify-content:flex-start;
    gap:8px;
    padding:8px 10px;
    border-radius:14px;
    flex-wrap:nowrap;         /* don't wrap to next line */
  }

  .nd-share-strip .label{
    margin:0;
    font-size:.8rem;
    width:auto;               /* important: no 100% width */
  }

  .nd-share-link{
    width:40px !important;
    height:40px !important;
    padding:0 !important;
    border-radius:10px !important;
    justify-content:center;
  }

  /* hide text on mobile, show only icon */
  .nd-share-link .nd-text{
    display:none !important;
  }

  .nd-share-link i{
    font-size:1.1rem;
  }
}

</style>

@php
  /** @var \App\Models\Post $newspost */
  $articleUrl = url('/news-details/'.$newspost->id.'/'.$newspost->slug);
@endphp

<section class="news-detail-page">
  <div class="nd-wrapper auto-container">
    <div class="row clearfix">
      {{-- Main article --}}
      <div class="col-lg-8 col-md-12 col-sm-12">
        <article class="nd-main">
          {{-- Hero image + meta strip --}}
          <div class="nd-hero">
            <div class="nd-thumb">
              @if($newspost->breadcrumb)
                <img src="{{ asset('backend/uploads/'.$newspost->breadcrumb) }}"
                     alt="{{ $newspost->pagetitle }}">
              @else
                <img src="{{ asset('frontend/custom/news-placeholder.jpg') }}"
                     alt="{{ $newspost->pagetitle }}">
              @endif
            </div>

            <div class="nd-meta-strip">
              <span class="nd-badge">News</span>
              <span class="nd-date">
                <i class="far fa-calendar-alt"></i>
                {{ optional($newspost->updated_at ?? $newspost->created_at)->format('F d, Y') }}
              </span>
            </div>
          </div>

          {{-- Title + subtitle --}}
          <header class="nd-header">
            <h1 class="nd-title">{{ $newspost->pagetitle }}</h1>
            @if(!empty($newspost->meta_title))
              <p class="nd-subtitle">{{ $newspost->meta_title }}</p>
            @endif
          </header>

          {{-- Share strip (top) --}}
          <div class="nd-share-strip">
          <span class="label">Share:</span>

            <a class="nd-share-link fb "
              target="_blank"
              href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($articleUrl) }}">
              <i class="fab fa-facebook-f"></i>
              <span class="nd-text">Facebook</span>
            </a>

            <a class="nd-share-link x"
              target="_blank"
              href="https://twitter.com/intent/tweet?url={{ urlencode($articleUrl) }}&text={{ urlencode($newspost->pagetitle) }}">
              <i class="fab fa-twitter"></i>
              <span class="nd-text">X Twitter</span>
            </a>

            <a class="nd-share-link wa"
              target="_blank"
              href="https://wa.me/?text={{ urlencode($newspost->pagetitle.' '.$articleUrl) }}">
              <i class="fab fa-whatsapp"></i>
              <span class="nd-text">WhatsApp</span>
            </a>

            <button class="nd-share-link copy" type="button"
                    onclick="navigator.clipboard.writeText('{{ $articleUrl }}')">
              <i class="fas fa-link"></i>
              <span class="nd-text">Copy Link</span>
            </button>
          </div>


          {{-- Article content --}}
          <div class="nd-content">
            {{-- Replace 'description' with your actual content field if different --}}
            {!! $newspost->description ?? $newspost->event_content ?? '' !!}
          </div>

          {{-- Tags (from meta_tags as comma-separated) --}}
          @if(!empty($newspost->meta_tags))
            @php
              $tags = is_array($newspost->meta_tags)
                ? $newspost->meta_tags
                : array_filter(array_map('trim', explode(',', $newspost->meta_tags)));
            @endphp

            @if(count($tags))
              <div class="nd-tags">
                @foreach($tags as $tag)
                  <span class="nd-tag">#{{ $tag }}</span>
                @endforeach
              </div>
            @endif
          @endif
        </article>
      </div>

      {{-- Sidebar --}}
      <div class="col-lg-4 col-md-12 col-sm-12">
        <aside class="nd-sidebar">
          <h3 class="nd-sidebar-title">Recent Posts</h3>
          <p class="nd-sidebar-sub">Latest updates from Vihatmaa Sewa Foundation</p>

          @if(isset($recentPosts) && $recentPosts->count())
            <ul class="nd-recent-list">
              @foreach($recentPosts as $post)
                <li class="nd-recent-item">
                  <div class="nd-recent-thumb">
                    @if($post->breadcrumb)
                      <img src="{{ asset('/backend/uploads/'.$post->breadcrumb) }}"
                           alt="{{ $post->pagetitle }}">
                    @else
                      <img src="{{ asset('frontend/custom/news-thumb.jpg') }}"
                           alt="{{ $post->pagetitle }}">
                    @endif
                  </div>
                  <div class="nd-recent-body">
                    <a href="{{ url('/news-post/'.$post->id.'/'.$post->slug) }}">
                      {{ \Illuminate\Support\Str::limit($post->pagetitle, 70) }}
                    </a>
                    <div class="nd-recent-date">
                      {{ optional($post->updated_at ?? $post->created_at)->format('M d, Y') }}
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          @else
            <p class="nd-sidebar-sub">No recent posts available.</p>
          @endif
        </aside>
      </div>
    </div>
  </div>
</section>

@endsection
