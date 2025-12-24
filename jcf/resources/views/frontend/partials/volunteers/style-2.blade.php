<style>
  :root{
    --frame: #3ea859;      /* inner photo frame color */
    --nameplate: #ed801b;  /* bar behind name/designation */
    --ring: #ffffff;
  }

  .member-section * { box-sizing:border-box; }

  .member-section{
    max-width:420px;
    margin:24px auto;
  }

  /* Members pill button */
  #kp-btns-4{
    text-align:center;
    
  }
  #kp-btns-4 .pill{
    border-radius:999px;
  }

  /* Slider shell */
  .mg-slider{
    position:relative;
    background: #f1f5f9;
    border-radius:18px;
    padding:6px;
    box-shadow:0 18px 42px rgba(15,23,42,.18);
  }

  .mg-viewport{
    overflow:hidden;
    border-radius:16px;
    background:#ffffff;
  }

  .mg-track{
    display:flex;
    flex-direction:row;          /* horizontal */
    transition:transform .6s ease;
  }

  .mg-slide{
    flex:0 0 100%;               /* one slide per view */
    padding:8px;
  }

  /* Inner card look (red background like screenshot) */
  .mg-card{
    background:linear-gradient(180deg, #3ea859, #ffb300);
    border-radius:14px;
    padding:8px 8px 14px;
    position:relative;
  }

  /* Photo frame */
  .mg-photo-frame{
    background:linear-gradient(180deg, #ffb36c,var(--frame));
    padding:10px;
    border-radius:12px;
    margin:4px 4px 10px;
  }

  .mg-photo-wrap{
    border-radius:10px;
    background:#fff;
    padding:6px;
    border:3px solid var(--ring);
  }

  .mg-photo{
    width:100%;
    aspect-ratio:3/4;
    object-fit:cover;
    border-radius:8px;
    display:block;
  }

  /* Nameplate */
  .mg-nameplate{
    background:var(--nameplate);
    color:#fff;
    border-radius:10px;
    padding:8px 6px;
    text-align:center;
    font-weight:800;
    letter-spacing:.3px;
    margin:0 8px;
  }

  .mg-nameplate h5{
    margin:0;
    font-weight:800;
    font-size:1rem;
  }
  .mg-nameplate h5 + h5{
    margin-top:2px;
    font-weight:700;
    font-size:.95rem;
  }

  /* Arrows */
  .mg-arrow{
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
    color: #3ea859;
    box-shadow:0 8px 18px rgba(0,0,0,.25);
  }
  .mg-prev{ left:12px; }
  .mg-next{ right:12px; }

  /* Dots */
  .mg-dots{
    display:flex;
    justify-content:center;
    gap:6px;
    margin-top:8px;
  }
  .mg-dot{
    width:18px;
    height:4px;
    border-radius:999px;
    background:rgba(255,255,255,.5);
  }
  .mg-dot.active{
    background: #ffffff;
  }

  .member-section .view-all{
    text-align:center;
    margin-top:10px;
  }
  .member-section .view-all a{
    color: #cf1111;
    font-weight:800;
    text-decoration:none;
  }

  @media (max-width:420px){
    .member-section{ max-width:360px; }
  }
</style>


<div class="member-section">

  {{-- Members button --}}
  <div id="kp-btns-4">
    <button class="btn pill"
            style="background:#fff; color:#1a52ff; border:3px solid #392482">
      Members
    </button>
  </div>

  {{-- Custom horizontal slider --}}
  <div class="mg-slider" id="members-slider">
    <div class="mg-viewport">
      <div class="mg-track">
        @foreach($members as $list)
          <article class="mg-slide">
            <div class="mg-card">
              {{-- arrows on top of card --}}
              <button class="mg-arrow mg-prev" type="button" aria-label="Previous">‹</button>
              <button class="mg-arrow mg-next" type="button" aria-label="Next">›</button>

              <div class="mg-photo-frame">
                <div class="mg-photo-wrap">
                  @if($list->profile_image)
                    <img class="mg-photo"
                         src="{{ asset('backend/uploads/'.$list->profile_image) }}"
                         alt="{{ $list->name ?? 'Member' }}">
                  @else
                    <img class="mg-photo"
                         src="{{ asset('backend/uploads/user.jpg') }}"
                         alt="member">
                  @endif
                </div>
              </div>

              <div class="mg-nameplate">
                <h5 class="card-title text-center">{{ $list->name }}</h5>
                <h5 class="card-title text-center">{{ $list->desg }}</h5>
              </div>
            </div>
          </article>
        @endforeach
      </div>
    </div>

    {{-- dots --}}
    <div class="mg-dots"></div>
  </div>
 <div class="text-center mt-2">
    <a href="{{url('/our-members')}}"
       class="theme-btn-four thm-btn fw-bold text-danger text-decoration-none">
      View All Members
    </a>
</div>



<script>
(function(){
  const slider = document.getElementById('members-slider');
  if (!slider) return;

  const track  = slider.querySelector('.mg-track');
  const slides = Array.from(track.children);
  const dotsContainer = slider.querySelector('.mg-dots');
  const prevButtons = slider.querySelectorAll('.mg-prev');
  const nextButtons = slider.querySelectorAll('.mg-next');

  const total = slides.length;
  if (total === 0) return;

  let index = 0;

  // create dots
  slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = 'mg-dot' + (i === 0 ? ' active' : '');
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

  // arrow events (event delegation per slider)
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
