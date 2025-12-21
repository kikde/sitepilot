<section class="gallery-section">
  <header class="gallery-header">
    <h3 class="gallery-title">Photo Gallery</h3>
  </header>

  <div class="gallery-grid">
    @forelse($photos as $photo)
      <div class="gallery-item">
        <img
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}"
          alt="{{ $photo->title ?? 'Gallery Photo' }}"
          loading="lazy">
      </div>
    @empty
      {{-- Fallback placeholders if no photos --}}
      @for($i=1;$i<=8;$i++)
        <div class="gallery-item">
          <img src="https://picsum.photos/seed/f{{ $i }}/400/300" alt="Placeholder">
        </div>
      @endfor
    @endforelse
  </div>

  <div class="gallery-footer">
    <a href="https://mdmks.kikde.in/photo-gallery" class="gallery-btn">View All Gallery</a>
  </div>
</section>
