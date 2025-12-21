<section class="gallery-masonry">
  <h3 class="gms-title">Moments</h3>

  <div class="gms-columns">
    @forelse($photos as $photo)
      <a class="gms-item" href="{{ url('photo-gallery') }}">
        <img 
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}" 
          alt="{{ $photo->title ?? 'Gallery Photo' }}" 
          loading="lazy">
      </a>
    @empty
      {{-- Fallback placeholders if no photos exist --}}
      @for($i = 1; $i <= 8; $i++)
        <a class="gms-item" href="#">
          <img src="https://picsum.photos/seed/a{{ $i }}/600/800" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>

  <div class="gms-footer">
    <a href="https://mdmks.kikde.in/photo-gallery" class="gms-btn">Explore More</a>
  </div>
</section>
