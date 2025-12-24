<!-- team-section -->
<section class="team-section sec-pad">
  <div class="auto-container">
    <div class="sec-title text-left">
      <h2 style="color:#230c74; font-weight:700; margin:20px 0;">Management Team</h2>

      <div class="row clearfix">
        @foreach($manage as $list)
        <div class="col-lg-3 col-md-6 col-sm-12 team-block">
          <div class="team-card">
            <!-- Square photo using background-image (always centered) -->
            <div class="team-photo" style="background-image:url('{{ asset('backend/teams/'.$list->images) }}')"></div>

            <div class="team-meta">
              <h4 class="team-name">{{ $list->name }}</h4>
              <span class="team-role">{{ $list->desg }}</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="btn-box">
        <a href="{{ url('/our-management-body') }}" class="theme-btn-three thm-btn blue-color">View All Team</a>
      </div>
    </div>
  </div>
</section> 
<!-- team-section end -->
