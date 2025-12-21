<!-- Trending Video Card (with thumbnail + clear URL slots) -->
<style>
  .tv-wrap{
    --radius:16px;
    --ink:#111827; --muted:#6b7280;
    --chip:#111827; --chipTxt:#fff;
    --accent:#e11d19;
    --shadow:0 8px 28px rgba(0,0,0,.15);
    position:relative; max-width:860px; margin:18px auto; font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
  }
  .tv-frame{ position:relative; border-radius:var(--radius); overflow:hidden; box-shadow:var(--shadow); background:#000; }
  .tv-media{ width:100%; aspect-ratio:16/9; display:block; background:#000; }
  .tv-overlay{ pointer-events:none; position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end;
    background:linear-gradient(180deg, rgba(0,0,0,0) 60%, rgba(0,0,0,.55) 100%);}
  .tv-meta{ display:flex; align-items:center; gap:10px; padding:10px 12px; color:#fff; font-size:14px; }
  .tv-title{ font-weight:700; text-shadow:0 2px 8px rgba(0,0,0,.5); }
  .tv-muted{ color:#d1d5db; font-weight:600; }
  .tv-play{ position:absolute; inset:0; display:grid; place-items:center; pointer-events:none; }
  .tv-btn{ pointer-events:auto; cursor:pointer; border:0; border-radius:999px; width:64px; height:64px; display:grid; place-items:center; background:#ffffffdd;
    box-shadow:0 8px 28px rgba(0,0,0,.35); transition:transform .15s ease, filter .15s ease;}
  .tv-btn:hover{ transform:translateY(-1px); filter:brightness(1.03); }
  .tv-btn svg{ width:26px; height:26px; color:#111; }
  .tv-controls{ position:absolute; left:10px; bottom:10px; display:flex; gap:8px; opacity:0; transform:translateY(6px);
    transition:opacity .18s ease, transform .18s ease; pointer-events:none;}
  .tv-wrap.is-playing .tv-controls{ opacity:1; transform:translateY(0); pointer-events:auto; }
  .tv-ctl{ border:0; border-radius:10px; background:rgba(255,255,255,.9); height:36px; padding:0 10px; display:flex; align-items:center; gap:8px;
    cursor:pointer; font-weight:700; box-shadow:0 4px 14px rgba(0,0,0,.25); }
  .tv-ctl svg{ width:18px; height:18px; color:#111; }
  .tv-trending{ position:absolute; top:10px; right:10px; transform:translateX(120%); transition:transform .25s ease; z-index:3; }
  .tv-trending .chip{ background:#111827; color:#fff; border-radius:999px; padding:8px 14px; font-weight:800; letter-spacing:.3px; display:flex; align-items:center; gap:8px; box-shadow:0 6px 18px rgba(0,0,0,.25); }
  .tv-trending .pulse{ width:8px; height:8px; border-radius:999px; background:#e11d19; box-shadow:0 0 0 0 rgba(225,29,25,.7); animation:tvPulse 1.4s infinite; }
  @keyframes tvPulse{ 0%{ box-shadow:0 0 0 0 rgba(225,29,25,.6);} 70%{ box-shadow:0 0 0 12px rgba(225,29,25,0);} 100%{ box-shadow:0 0 0 0 rgba(225,29,25,0);} }
  .tv-wrap:hover .tv-trending, .tv-wrap.is-active .tv-trending{ transform:none; }
  .tv-caption{ display:flex; justify-content:space-between; gap:10px; align-items:center; margin-top:8px; padding:0 2px; color:#6b7280; font-size:14px; }
  @media (max-width:620px){ .tv-btn{ width:58px; height:58px; } .tv-ctl{ height:34px; } .tv-meta{ font-size:13px; } }
</style>

<div class="tv-wrap" id="trendingVideo1">
  <div class="tv-frame">
    <!-- Trending chip -->
    <div class="tv-trending" aria-hidden="true">
      <div class="chip"><span class="pulse"></span> Trending</div>
    </div>

    <!-- 
      VIDEO URL + THUMBNAIL:
      - Put your MP4 URL in <source src="..."> below.
      - Put your thumbnail image URL in the poster="..." attribute on <video>.
    -->
    <video class="tv-media" preload="metadata"
           poster="{{ asset('backend/uploads/'.$dmessage->breadcrumb) }}">  <!-- ← THUMBNAIL URL HERE -->
      <source src="{{asset('frontend/custom/intro.mp4')}}" type="video/mp4"> <!-- ← VIDEO MP4 URL HERE -->
      <!-- Optional extra formats for broader support: 
      <source src="https://YOUR-VIDEO-FILE.webm" type="video/webm">
      -->
      Your browser does not support HTML5 video.
    </video>

    <!-- Center play button -->
    <div class="tv-play">
      <button class="tv-btn" type="button" aria-label="Play video">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
      </button>
    </div>

    <!-- Overlay meta -->
    <div class="tv-overlay" aria-hidden="true">
      <div class="tv-meta">
        <div class="tv-title">Community Highlights</div>
        <div class="tv-muted">2:10 · HD</div>
      </div>
    </div>

    <!-- Simple controls (appear after play) -->
    <div class="tv-controls">
      <button class="tv-ctl" data-action="mute" type="button" aria-label="Toggle mute">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M5 9v6h4l5 5V4L9 9H5z"/></svg>
        <span class="lab">Unmute</span>
      </button>
      <button class="tv-ctl" data-action="pause" type="button" aria-label="Pause">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 19h4V5H6v14zm8 0h4V5h-4v14z"/></svg>
        <span class="lab">Play</span>
      </button>
    </div>
  </div>

  <!-- Caption row -->
  <div class="tv-caption">
    <!-- <span>WordPress-style responsive video</span>
    <span>Default paused · Plays on tap</span> -->
  </div>
</div>

<script>
  (function(){
    const wrap   = document.getElementById('trendingVideo1');
    const video  = wrap.querySelector('.tv-media');
    const playUi = wrap.querySelector('.tv-play');
    const playBt = wrap.querySelector('.tv-btn');
    const ctrls  = wrap.querySelector('.tv-controls');
    const muteBt = ctrls.querySelector('[data-action="mute"]');
    const pauseBt= ctrls.querySelector('[data-action="pause"]');
    const pauseLab = pauseBt.querySelector('.lab');
    const muteLab  = muteBt.querySelector('.lab');

    // Slide-in "Trending" when in view (mobile-friendly)
    const io = new IntersectionObserver(entries=>{
      entries.forEach(e=>wrap.classList.toggle('is-active', e.isIntersecting));
    }, {threshold:.35});
    io.observe(wrap);

    // Start paused
    video.controls = false;
    video.preload = 'metadata';
    video.playsInline = true;  // iOS inline
    video.setAttribute('playsinline','');

    // Default muted for better UX on mobile
    video.muted = true;
    muteLab.textContent = 'Unmute'; // because we start muted
    pauseLab.textContent = 'Play';

    // Play on button
    playBt.addEventListener('click', async ()=>{
      try{
        await video.play();
        wrap.classList.add('is-playing');
        playUi.style.display='none';
        pauseLab.textContent = 'Pause';
      }catch(e){ console.debug('play error', e); }
    });

    // Pause/Resume
    pauseBt.addEventListener('click', ()=>{
      if(video.paused){ video.play(); pauseLab.textContent='Pause'; }
      else{ video.pause(); pauseLab.textContent='Play'; }
    });

    // Mute toggle
    muteBt.addEventListener('click', ()=>{
      video.muted = !video.muted;
      muteLab.textContent = video.muted ? 'Unmute' : 'Mute';
    });

    // Click video to toggle (optional)
    video.addEventListener('click', ()=>{
      if(video.paused){ video.play(); pauseLab.textContent='Pause'; }
      else{ video.pause(); pauseLab.textContent='Play'; }
    });

    // Sync labels if user pauses/plays via system UI
    video.addEventListener('pause', ()=>{ pauseLab.textContent='Play'; });
    video.addEventListener('play',  ()=>{ pauseLab.textContent='Pause'; });
  })();
</script>
