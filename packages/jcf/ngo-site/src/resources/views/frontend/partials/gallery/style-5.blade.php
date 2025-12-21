<section class="gallery-polaroid">
  <h3 class="gp-title">Memories</h3>
  <div class="gp-grid">
    @forelse($photos as $photo)
      <a class="gp-item" href="{{ url('photo-gallery') }}">
        <img 
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}" 
          alt="{{ $photo->title ?? 'Gallery Photo' }}" 
          loading="lazy">
      </a>
    @empty
      {{-- Fallback placeholders if no photos found --}}
      @for($i = 1; $i <= 8; $i++)
        <a class="gp-item" href="#">
          <img src="https://picsum.photos/seed/p{{ $i }}/600/400" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>
</section>

<script>
  // Add slight random tilt to each photo (polaroid effect)
  document.querySelectorAll('.gp-item').forEach((el, i) => {
    const angle = (Math.random() * 6 - 3).toFixed(1); // -3° to +3°
    el.style.setProperty('--tilt', angle + 'deg');
  });
</script>
