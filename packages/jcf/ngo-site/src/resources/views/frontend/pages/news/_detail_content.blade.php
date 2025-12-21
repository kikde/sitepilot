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

  .news-detail-page .nd-breadcrumb{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
    font-size:14px;
    color:#64748b;
    margin-bottom:14px;
  }

  .news-detail-page .nd-breadcrumb a{
    color:#2563eb;
    text-decoration:none;
    font-weight:600;
  }
  .news-detail-page .nd-breadcrumb a:hover{ text-decoration:underline; }

  .news-detail-page .nd-title{
    font-size:30px;
    line-height:1.2;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
  }

  .news-detail-page .nd-meta{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    align-items:center;
    font-size:14px;
    color:#64748b;
    margin-bottom:18px;
  }

  .news-detail-page .nd-meta .tag{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:6px 10px;
    border-radius:999px;
    background:#f1f5f9;
    color:#0f172a;
    font-weight:700;
    font-size:12px;
  }

  .news-detail-page .nd-hero{
    border-radius:16px;
    overflow:hidden;
    background:#0b1220;
    margin-bottom:18px;
  }
  .news-detail-page .nd-hero img{
    width:100%;
    height:auto;
    display:block;
  }

  .news-detail-page .nd-content{
    font-size:16px;
    line-height:1.8;
    color:#334155;
  }
  .news-detail-page .nd-content p{ margin:0 0 14px; }
  .news-detail-page .nd-content ul{ padding-left:20px; margin:0 0 14px; }
  .news-detail-page .nd-content a{ color:#2563eb; font-weight:700; }

  /* sidebar */
  .news-detail-page .nd-grid{
    display:grid;
    grid-template-columns: 1fr;
    gap:18px;
  }
  @media (min-width:992px){
    .news-detail-page .nd-grid{
      grid-template-columns: 1fr 360px;
    }
  }

  .news-detail-page .nd-sidebar{
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 18px 40px rgba(15,23,42,.08);
    padding:18px 18px 20px;
    position:sticky;
    top:18px;
    height:fit-content;
  }

  .news-detail-page .nd-sidebar h4{
    margin:0 0 12px;
    font-size:16px;
    font-weight:900;
    color:#0f172a;
  }

  .news-detail-page .nd-recent{
    list-style:none;
    padding:0;
    margin:0;
    display:flex;
    flex-direction:column;
    gap:12px;
  }

  .news-detail-page .nd-recent li{
    display:flex;
    gap:12px;
    align-items:flex-start;
  }

  .news-detail-page .nd-recent-thumb{
    width:76px;
    height:56px;
    border-radius:10px;
    overflow:hidden;
    background:#e2e8f0;
    flex:0 0 auto;
  }
  .news-detail-page .nd-recent-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }

  .news-detail-page .nd-recent-title{
    font-size:14px;
    font-weight:800;
    line-height:1.35;
    margin:0 0 4px;
  }
  .news-detail-page .nd-recent-title a{
    color:#0f172a;
    text-decoration:none;
  }
  .news-detail-page .nd-recent-title a:hover{
    color:#2563eb;
  }

  .news-detail-page .nd-recent-date{
    font-size:12px;
    color:#64748b;
    font-weight:700;
  }

  .news-detail-page .nd-sidebar-sub{
    font-size:14px;
    color:#64748b;
    margin:0;
  }
</style>

@php
  $pagedetails = $pagedetails ?? $newspost ?? null;
  $pages = $pages ?? $recentPosts ?? null;
  $primaryDate = $pagedetails?->updated_at ?? $pagedetails?->created_at;
@endphp

<section class="news-detail-page">
  <div class="nd-wrapper">
    <div class="nd-grid">
      <article class="nd-main">

        <div class="nd-breadcrumb">
          <a href="{{ url('/ngo') }}">Home</a>
          <span>/</span>
          <a href="{{ url('/news-post') }}">News</a>
          <span>/</span>
          <span>{{ $pagedetails->pagetitle ?? 'News Details' }}</span>
        </div>

        <h1 class="nd-title">
          {{ $pagedetails->pagetitle ?? 'News Details' }}
        </h1>

        <div class="nd-meta">
          <span class="tag">
            <i class="fa fa-calendar"></i>
            {{ optional($primaryDate)->format('M d, Y') }}
          </span>

          @if(!empty($pagedetails->category))
            <span class="tag">
              <i class="fa fa-tag"></i>
              {{ $pagedetails->category }}
            </span>
          @endif
        </div>

        @php
          $imagePath = $pagedetails->image ?? null;
        @endphp

        @if(!empty($imagePath))
          <div class="nd-hero">
            <img
              src="{{ asset('backend/pages/'.$imagePath) }}"
              alt="{{ $pagedetails->pagetitle ?? 'News Image' }}"
            >
          </div>
        @endif

        <div class="nd-content">
          {!! $pagedetails->description ?? '' !!}
        </div>
      </article>

      <aside class="nd-sidebar">
        <h4>Recent Posts</h4>

        @if(isset($pages) && count($pages))
          <ul class="nd-recent">
            @foreach($pages as $post)
              <li>
                <div class="nd-recent-thumb">
                  @if(!empty($post->image))
                    <img src="{{ asset('backend/pages/'.$post->image) }}" alt="{{ $post->pagetitle ?? '' }}">
                  @endif
                </div>
                <div>
                  <div class="nd-recent-title">
                    <a href="{{ url('/news-post/'.$post->id.'/'.$post->slug) }}">
                      {{ \Illuminate\Support\Str::limit($post->pagetitle, 70) }}
                    </a>
                    <div class="nd-recent-date">
                      {{ optional($post->updated_at ?? $post->created_at)->format('M d, Y') }}
                    </div>
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
</section>
