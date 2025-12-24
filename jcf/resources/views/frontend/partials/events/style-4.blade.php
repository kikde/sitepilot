@php use Illuminate\Support\Str; @endphp

<section class="rp-card">
  <header class="rp-head">
    <span class="rp-title">Latest Events</span>
    <span class="rp-icon" aria-hidden="true">🗂️</span>
  </header>

  <div class="rp-grid">
    @foreach($newspost as $newslist)
      <article class="rp-item">
        <a class="rp-thumb" href="#post-{{ $loop->iteration }}">
          <img src="{{ asset('/backend/uploads/'.$newslist->breadcrumb) }}" alt="">
        </a>

        {{-- Restrict to 20 words and max 2 visible lines --}}
        <h3 class="rp-link text-limit-2">
          <a href="#post-{{ $loop->iteration }}">
            {{ Str::words($newslist->pagetitle, 20, '…') }}
          </a>
        </h3>

        <div class="rp-meta">
          <time datetime="{{ $newslist->created_at->toDateString() }}">
            {{ $newslist->created_at->format('F j, Y') }}
          </time>
        </div>
      </article>
    @endforeach
  </div>
</section>
