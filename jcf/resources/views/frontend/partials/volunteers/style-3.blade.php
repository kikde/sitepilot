<section class="gallery-section-4">
  <h3 class="gallery-title">Our Members</h3>

  <!-- Always 4 columns, even on mobile -->
  <div class="gallery-grid-4">
      @foreach($members as $list)
      <a class="gallery-item" href="{{ url('our-members') }}">
        @if($list->profile_image)
        <img src="{{asset('backend/uploads/members/'.$list->profile_image)}}"
          alt="{{ $list->profile_image ?? '' }}"
          loading="lazy">
      </a>
      @else
       <img src="{{asset('backend/uploads/user.jpg')}}" alt="member">
      @endif
      
     @endforeach
  </div>

  <div class="gallery-footer">
    <a href="{{url('/our-members')}}" class="gallery-btn">View All Member</a>
  </div>
</section>

