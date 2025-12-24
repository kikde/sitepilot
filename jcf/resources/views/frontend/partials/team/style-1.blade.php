<section class="gallery-section-4">
  <h3 class="gallery-title">Management Team</h3>

  <!-- Always 4 columns, even on mobile -->
  <div class="gallery-grid-4">
    @forelse($manage as $list)
      <a class="gallery-item" href="{{ url('our-team') }}">
        <img
          src="{{ asset('backend/teams/'.$list->images) }}"
          alt="{{ $list->name ?? 'Team Member' }}"
          loading="lazy">
      </a>
    @empty
      {{-- fallback if no records --}}
      @for($i=1;$i<=8;$i++)
        <a class="gallery-item" href="#">
          <img src="{{asset('frontend/custom/user.png')}}" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>

  <div class="gallery-footer">
    <a href="{{ url('/our-management-body') }}" class="gallery-btn">View All Members</a>
  </div>
</section>
