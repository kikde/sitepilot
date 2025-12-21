<section class="gallery-section-4">
  <h3 class="gallery-title">Photo Gallery</h3>

  <!-- Always 4 columns, even on mobile -->
  <div class="gallery-grid-4">
    @forelse($photos as $photo)
      <a class="gallery-item" href="#">
        <img
          src="{{ asset('backend/gallery/photo/'.$photo->images) }}"
          alt="{{ $photo->title ?? 'Gallery Image' }}"
          loading="lazy">
      </a>
    @empty
      {{-- fallback if no records --}}
      @for($i=1;$i<=8;$i++)
        <a class="gallery-item" href="#">
          <img src="https://picsum.photos/seed/f{{ $i }}/600/400" alt="Placeholder">
        </a>
      @endfor
    @endforelse
  </div>

  <div class="gallery-footer">
    <a href="{{ route('front.photo', ['share_site' => 'gallery']) }}" class="gallery-btn">View All Gallery</a>
  </div>
</section>


{{--<section class="gallery-section cert-slider-section">
  <header class="gallery-header">
    <h3 class="gallery-title">All Certificates</h3>
  </header>

  @if($certificates->count())
    <div class="cert-slider" id="cert-slider">
      <div class="cert-viewport">
        <div class="cert-track">
          @foreach($certificates as $certificate)
            <div class="cert-slide">
              <div class="gallery-item">
                <img
                  src="{{ asset('backend/gallery/photo/'.$certificate->images) }}"
                  alt="{{ $certificate->title ?? 'Certificate' }}"
                  loading="lazy">
              </div>
            </div>
          @endforeach
        </div>
      </div>

     
      <button class="cert-arrow cert-prev" type="button" aria-label="Previous">‹</button>
      <button class="cert-arrow cert-next" type="button" aria-label="Next">›</button>

    
      <div class="cert-dots"></div>
    </div>
  @else
    <p>No certificates found.</p>
  @endif

  <div class="gallery-footer">
 
  </div>
</section>--}}

<style>
  .cert-slider-section *{
    box-sizing:border-box;
  }

  .cert-slider-section{
    max-width: 900px;
    margin: 0 auto 40px;
  }

  /* slider shell */
  .cert-slider{
    position: relative;
    background:#f8fafc;
    border-radius:16px;
    padding:10px 10px 30px;
    box-shadow:0 14px 40px rgba(15,23,42,.12);
    overflow:hidden;
  }

  .cert-viewport{
    overflow:hidden;
    border-radius:12px;
  }

  .cert-track{
    display:flex;                 /* d-flex horizontal */
    flex-direction:row;
    transition:transform .6s ease;
  }

  .cert-slide{
    flex:0 0 100%;                /* one slide per view */
    display:flex;
    align-items:center;
    justify-content:center;
    padding:10px;
  }

  /* your gallery item, but scoped */
  .cert-slider-section .gallery-item{
    display:flex;
    align-items:center;
    justify-content:center;
  }

  .cert-slider-section .gallery-item img{
    max-width:100%;
    height:auto;
    border-radius:12px;
    box-shadow:0 10px 26px rgba(15,23,42,.18);
    border:4px solid #ffffff;
    background:#ffffff;
  }

  /* arrows */
  .cert-arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:34px;
    height:34px;
    border-radius:50%;
    border:none;
    background:rgba(255,255,255,.9);
    display:grid;
    place-items:center;
    cursor:pointer;
    font-size:20px;
    font-weight:900;
    color:#1f2937;
    box-shadow:0 8px 18px rgba(15,23,42,.3);
    z-index:5;
  }
  .cert-prev{ left:10px; }
  .cert-next{ right:10px; }

  /* dots */
  .cert-dots{
    display:flex;
    justify-content:center;
    gap:6px;
    margin-top:14px;
  }
  .cert-dot{
    width:16px;
    height:4px;
    border-radius:999px;
    background:rgba(15,23,42,.2);
    transition:background .2s ease,width .2s ease;
  }
  .cert-dot.active{
    background:#1f2937;
    width:22px;
  }

  @media (max-width:640px){
    .cert-slider{
      padding:8px 6px 26px;
    }
  }
</style>
<script>
(function(){
  const slider = document.getElementById('cert-slider');
  if (!slider) return;

  const track = slider.querySelector('.cert-track');
  const slides = Array.from(track.children);
  const dotsContainer = slider.querySelector('.cert-dots');
  const prevBtn = slider.querySelector('.cert-prev');
  const nextBtn = slider.querySelector('.cert-next');

  const total = slides.length;
  if (total === 0) return;

  let index = 0;

  // build dots
  slides.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = 'cert-dot' + (i === 0 ? ' active' : '');
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

  // arrow listeners
  prevBtn.addEventListener('click', function(e){
    e.preventDefault();
    goTo(index - 1);
  });

  nextBtn.addEventListener('click', function(e){
    e.preventDefault();
    goTo(index + 1);
  });

  // dot click
  dots.forEach(dot => {
    dot.addEventListener('click', function(){
      const i = parseInt(this.dataset.index, 10);
      goTo(i);
    });
  });

  // autoplay
  let timer = setInterval(() => goTo(index + 1), 3500);

  slider.addEventListener('mouseenter', () => clearInterval(timer));
  slider.addEventListener('mouseleave', () => {
    timer = setInterval(() => goTo(index + 1), 3500);
  });

  // initial
  goTo(0, false);
})();
</script>
