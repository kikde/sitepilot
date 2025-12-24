<style>
  :root{
    --mt-frame: #3ea859;      /* inner photo frame color */
    --mt-nameplate: #ed801b;  /* bar behind name/designation */
    --mt-ring: #ffffff;
  }

  .management-team-section * { box-sizing:border-box; }

  .management-team-section{
    max-width:420px;
    margin:24px auto;
  }

  /* Management Team pill button */
  #kp-btns-mgmt{
    text-align:center;
    margin: 0 auto 10px;
  }
  #kp-btns-mgmt .pill{
    border-radius:999px;
  }

  /* Slider shell */
  .mt-slider{
    position:relative;
    background:#f1f5f9;
    border-radius:18px;
    padding:6px;
    box-shadow:0 18px 42px rgba(15,23,42,.18);
  }

  .mt-viewport{
    overflow:hidden;
    border-radius:16px;
    background:#ffffff;
  }

  .mt-track{
    display:flex;
    flex-direction:row;          /* horizontal */
    transition:transform .6s ease;
  }

  .mt-slide{
    flex:0 0 100%;               /* one slide per view */
    padding:8px;
  }

  /* Inner card look (red/orange background) */
  .mt-card{
    background:linear-gradient(180deg,#ff0000,#ffb300);
    border-radius:14px;
    padding:8px 8px 14px;
    position:relative;
  }

  /* Photo frame */
  .mt-photo-frame{
    background:linear-gradient(180deg,#ffb36c,var(--mt-frame));
    padding:10px;
    border-radius:12px;
    margin:4px 4px 10px;
  }

  .mt-photo-wrap{
    border-radius:10px;
    background:#fff;
    padding:6px;
    border:3px solid var(--mt-ring);
  }

  .mt-photo{
    width:100%;
    aspect-ratio:3/4;
    object-fit:cover;
    border-radius:8px;
    display:block;
  }

  /* Nameplate */
  .mt-nameplate{
    background:var(--mt-nameplate);
    color:#fff;
    border-radius:10px;
    padding:8px 6px;
    text-align:center;
    font-weight:800;
    letter-spacing:.3px;
    margin:0 8px;
  }

  .mt-nameplate h5{
    margin:0;
    font-weight:800;
    font-size:1rem;
  }
  .mt-nameplate h5 + h5{
    margin-top:2px;
    font-weight:700;
    font-size:.95rem;
  }

  /* Arrows */
  .mt-arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:30px;
    height:30px;
    border-radius:999px;
    border:none;
    background:rgba(255,255,255,.85);
    display:grid;
    place-items:center;
    cursor:pointer;
    font-size:20px;
    font-weight:900;
    color:#d42323;
    box-shadow:0 8px 18px rgba(0,0,0,.25);
  }
  .mt-prev{ left:12px; }
  .mt-next{ right:12px; }

  /* Dots */
  .mt-dots{
    display:flex;
    justify-content:center;
    gap:6px;
    margin-top:8px;
  }
  .mt-dot{
    width:18px;
    height:4px;
    border-radius:999px;
    background:rgba(255,255,255,.5);
  }
  .mt-dot.active{
    background:#ffffff;
  }

  .management-team-section .view-all{
    text-align:center;
    margin-top:10px;
  }
  .management-team-section .view-all a{
    color:#cf1111;
    font-weight:800;
    text-decoration:none;
  }

  @media (max-width:420px){
    .management-team-section{ max-width:360px; }
  }
</style>


<div class="management-team-section">

  {{-- Management Team button --}}
  <div id="kp-btns-mgmt">
    <button class="btn pill"
            style="background:#fff; color:#1a52ff; border:3px solid #392482">
      Management Team
    </button>
  </div>

  {{-- Custom horizontal slider --}}
  <div class="mt-slider" id="management-team-slider">
    <div class="mt-viewport">
      <div class="mt-track">
        @foreach($manage as $list)
          <article class="mt-slide">
            <div class="mt-card">
              {{-- arrows on top of card --}}
              <button class="mt-arrow mt-prev" type="button" aria-label="Previous">‹</button>
              <button class="mt-arrow mt-next" type="button" aria-label="Next">›</button>

              <div class="mt-photo-frame">
                <div class="mt-photo-wrap">
                  @if($list->images)
                    <img class="mt-photo"
                         src="{{ asset('backend/teams/'.$list->images) }}"
                         alt="{{ $list->name ?? 'Management Member' }}">
                  @else
                    <img class="mt-photo"
                         src="{{ asset('frontend/custom/user.png') }}"
                         alt="member">
                  @endif
                </div>
              </div>

              <div class="mt-nameplate">
                <h5 class="card-title text-center">{{ $list->name }}</h5>
                <h5 class="card-title text-center">{{ $list->desg }}</h5>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </div>

    {{-- dots --}}
    <div class="mt-dots"></div>
  </div>

  <div class="view-all">
    <a href="{{ url('/our-management-body') }}"
       class="theme-btn-four thm-btn fw-bold text-danger text-decoration-none">
      View All Team
    </a>
  </div>
</div>


<script>
(function(){
  const slider = document.getElementById('management-team-slider');
  if (!slider) return;

  const track  = slider.querySelector('.mt-track');
  const slides = Array.from(track.children);
  const dotsContainer = slider.querySelector('.mt-dots');
  const prevButtons = slider.querySelectorAll('.mt-prev');
  const nextButtons = slider.querySelectorAll('.mt-next');

  const total = slides.length;
  if (total === 0) return;

  let index = 0;

  // create dots
  slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = 'mt-dot' + (i === 0 ? ' active' : '');
    dot.dataset.index = i;
    dotsContainer.appendChild(dot);
  });

  const dots = Array.from(dotsContainer.children);

  function updateDots(){
    dots.forEach((d, i) => {
      d.classList.toggle('active', i === index);
    });
  }

  function goTo(i, animate = true){
    index = (i + total) % total;
    track.style.transition = animate ? 'transform .6s ease' : 'none';
    track.style.transform = 'translateX(-' + (index * 100) + '%)';
    updateDots();
  }

  // arrow events
  prevButtons.forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      goTo(index - 1);
    });
  });

  nextButtons.forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      goTo(index + 1);
    });
  });

  // dots click
  dots.forEach(dot => {
    dot.addEventListener('click', function(){
      const i = parseInt(this.dataset.index, 10);
      goTo(i);
    });
  });

  // autoplay
  let timer = setInterval(() => goTo(index + 1), 3000);

  slider.addEventListener('mouseenter', () => {
    clearInterval(timer);
  });
  slider.addEventListener('mouseleave', () => {
    timer = setInterval(() => goTo(index + 1), 3000);
  });

  // initial
  goTo(0, false);
})();
</script>
