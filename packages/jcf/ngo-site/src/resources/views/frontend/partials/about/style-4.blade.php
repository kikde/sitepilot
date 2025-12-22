
  <title>About Tabs – Dark Version</title>

  <style>
    :root{
      --about2-bg:#f5f6f7;
      --about2-ink:#0f172a;
      --about2-brand:#ef3a14;
      --about2-brand2:#ff6b2b;
      --about2-stroke:#ffbfab;
    }

    *{ box-sizing:border-box; }

    .about2-wrap{
      max-width:680px;
      margin:0 auto;
      padding:22px 10px;
      background:var(--about2-bg);
      font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial;
      color:var(--about2-ink);
    }

    .about2-heading{
      text-align:center;
      color:#fb6003;
      font-weight:900;
      font-size:1.9rem;
      margin:6px 0 16px;
    }

    /* ---- TAB BAR (round, near border) ---- */
    .about2-tabs{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:4px;                         /* tiny gap between pills */
      background:#fff;
      border:2px solid var(--about2-stroke);
      padding:4px;                     /* almost touching border */
      border-radius:999px;             /* rounded outer bar */
      box-shadow:0 1px 0 rgba(0,0,0,.03);
    }

    .about2-tab{
      appearance:none;
      cursor:pointer;
      border:0;
      background:transparent;
      padding:10px 10px;
      border-radius:999px;             /* round pills */
      font-weight:800;
      color:#111;                      /* dark text */
      min-width:0;
      transition:background .18s ease, transform .12s ease;
    }

    .about2-tab:hover{
      transform:translateY(-1px);
    }

    .about2-tab[aria-selected="true"]{
      background:linear-gradient(180deg,#e85903,#fc6403);
      color:#ffffff;
      box-shadow:0 4px 14px rgba(0,0,0,.12);
    }

    @media (max-width:420px){
      .about2-tab{ padding:9px 6px; font-size:.95rem; }
    }

    /* ---- PANEL CARD ---- */
    .about2-card{
      margin:14px auto 0;
      padding:22px 16px 26px;
      border-radius:16px;
      color:#111;                      /* dark text in card */
      text-align:center;
      background:#fff;
      border:1px solid var(--about2-stroke);
      box-shadow:0 10px 28px rgba(0,0,0,.08);
    }

    .about2-card h3{
      margin:0 0 10px;
      font-weight:900;
      color: #e85903 !important;
    }

    .about2-card p{
      margin:0 auto 16px;
      line-height:1.6;
      max-width:60ch;
    }

    .about2-btn{
      appearance:none;
      border:none;
      cursor:pointer;
      background:linear-gradient(#fff89a,#ffd400);
      color:#111;
      font-weight:900;
      padding:10px 20px;
      border-radius:14px;
      box-shadow:0 8px 18px rgba(0,0,0,.15);
    }

    .about2-hidden{ display:none; }

     .about2-justify p {
  padding-left: 1.2rem;
  margin-bottom: 0.75rem;
}

    .about2-justify ul {
  padding-left: 1.2rem;
  margin-bottom: 0.75rem;
}
.about2-justify ul li {
  text-align: justify;
  margin-bottom: 4px;
}
  </style>

@php
  $__about = ['title'=>'About Us','mission'=>null,'vision'=>null,'values'=>null];
  try {
    $p = storage_path('app/home_about.json');
    if (is_file($p)) {
      $j = json_decode(file_get_contents($p), true);
      if (is_array($j)) { $__about = array_merge($__about, $j); }
    }
  } catch (Throwable $e) {}
@endphp

<main class="about2-wrap">
  <div class="about2-heading">{{ $__about['title'] ?: 'About Us' }}</div>

  <div class="about2-tabs" role="tablist" aria-label="About tabs dark">
    <button class="about2-tab" role="tab" id="about2-t-mission"
            aria-controls="about2-p-mission" aria-selected="true">
      Our Mission
    </button>
    <button class="about2-tab" role="tab" id="about2-t-vision"
            aria-controls="about2-p-vision" aria-selected="false">
      Our Vision
    </button>
    <button class="about2-tab" role="tab" id="about2-t-values"
            aria-controls="about2-p-values" aria-selected="false">
      Our Values
    </button>
  </div>

  {{-- MISSION --}}
  <section id="about2-p-mission" class="about2-card about2-justify"
            role="tabpanel" aria-labelledby="about2-t-mission">
    <h3>Our Mission</h3>
    @if(!empty($__about['mission']))
      {!! $__about['mission'] !!}
    @else
      <p>
        {{$setting->title}} is a non-profit organisation dedicated to the
        holistic development of underprivileged children, women and vulnerable
        communities. Our mission is to provide access to <b>education, healthcare,
        nutrition, livelihood support and social security</b> so that every person
        can live with dignity, confidence and self-reliance.
      </p>
    @endif
   
    <a href="{{ url('/user-donate') }}" class="about2-btn">Donate Now 🧡</a>
  </section>

  {{-- VISION --}}
  <section id="about2-p-vision" class="about2-card about2-hidden about2-justify"
            role="tabpanel" aria-labelledby="about2-t-vision">
    <h3>Our Vision</h3>
    @if(!empty($__about['vision']))
      {!! $__about['vision'] !!}
    @else
      <p>
        We envision a <b>strong, inclusive and compassionate India</b> where every
        child learns, every woman is empowered, and every vulnerable family has a
        fair chance to build a better future.
      </p>
      <p>
        {{$setting->title}} strives for communities where there is
        <b>no hunger, no discrimination and no denial of basic rights</b> - only
        opportunities, dignity and hope for all.
      </p>
    @endif
    <a href="{{ url('/user-donate') }}" class="about2-btn">Donate Now 🧡</a>
  </section>

  {{-- VALUES --}}
  <section id="about2-p-values"
         class="about2-card about2-hidden about2-justify"
         role="tabpanel"
         aria-labelledby="about2-t-values">
  <h3>Our Values</h3>
  @if(!empty($__about['values']))
    {!! $__about['values'] !!}
  @else
    <p>
      Every initiative of {{ $setting->title }} is guided by our core values:
    </p>
    <ul>
      <li><b>Compassion:</b> Serving with empathy, respect and sensitivity.</li>
      <li><b>Integrity & Transparency:</b>Using every donation responsibly and honestly.</li>
      <li><b>Equity & Inclusion:</b>Reaching the most marginalised without any bias of caste, religion, gender or region.</li>
      <li><b>Seva (Service):</b>Believing that service to people in need is the highest form of duty.</li>
    </ul>
  @endif
  <a href="{{ url('/user-donate') }}" class="about2-btn">Donate Now 🧡</a>
</section>
</main>


<script>
  // Simple tab switcher (scoped to about2- classes)
  const about2Tabs = document.querySelectorAll('.about2-tab');
  const about2Panels = {
    mission: document.getElementById('about2-p-mission'),
    vision: document.getElementById('about2-p-vision'),
    values: document.getElementById('about2-p-values')
  };

  function about2SelectTab(id){
    about2Tabs.forEach(btn =>
      btn.setAttribute('aria-selected', btn.id === id ? 'true' : 'false')
    );

    Object.values(about2Panels).forEach(p =>
      p.classList.add('about2-hidden')
    );

    if(id === 'about2-t-mission') about2Panels.mission.classList.remove('about2-hidden');
    if(id === 'about2-t-vision')  about2Panels.vision.classList.remove('about2-hidden');
    if(id === 'about2-t-values')  about2Panels.values.classList.remove('about2-hidden');
  }

  about2Tabs.forEach(btn =>
    btn.addEventListener('click', () => about2SelectTab(btn.id))
  );
</script>


