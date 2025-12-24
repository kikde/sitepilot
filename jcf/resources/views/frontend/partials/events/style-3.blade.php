@php use Illuminate\Support\Str; @endphp

<section class="news-twoCol">
  <header class="ntc-head">
    <span class="ntc-title">Latest Events</span>
    <span class="ntc-icon" aria-hidden="true">🗂️</span>
  </header>

  <div class="ntc-cols">
    <div class="ntc-col">
      @foreach($newspost as $newslist)
        <article class="ntc-item">
          <a class="ntc-thumb" href="#p{{ $loop->iteration }}">
            <img src="{{ asset('/backend/uploads/'.$newslist->breadcrumb) }}" alt="">
          </a>

          <div class="ntc-body">
            {{-- Limit to 20 words and visually 2 lines --}}
            <a class="ntc-link text-limit-2" href="#p{{ $loop->iteration }}">
              {{ Str::words($newslist->pagetitle, 20, '…') }}
            </a>

            <div class="ntc-meta">
              <time datetime="{{ $newslist->created_at->toDateString() }}">
                {{ $newslist->created_at->format('F j, Y') }}
              </time>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section> 
