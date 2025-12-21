<section class="gallery-mosaic">
  <h3 class="gm-title">Highlights</h3>

  <div class="gm-grid">
    @forelse($photos as $photo)
      <a class="gm-item" href="{{ url('photo-gallery') }}">
        <img 
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}"
          alt="{{ $photo->title ?? 'Gallery Photo' }}"
          loading="lazy">
      </a>
    @empty
      {{-- fallback placeholders if no photos --}}
      @for($i = 1; $i <= 8; $i++)
        <a class="gm-item" href="#">
          <img src="https://picsum.photos/seed/m{{ $i }}/800/600" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>

  <div class="gm-footer">
    <a href="https://mdmks.kikde.in/photo-gallery" class="gm-btn">View All</a>
  </div>
</section>
