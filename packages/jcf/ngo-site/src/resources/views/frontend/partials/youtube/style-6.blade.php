{{-- resources/views/frontend/partials/section/style-6.blade.php --}}
<style>
  #kp-yt-showcase{--bg:#0b1020;--ink:#e5e7eb}
  #kp-yt-showcase,#kp-yt-showcase *{box-sizing:border-box}
  #kp-yt-showcase .wrapper{max-width:1100px;margin:0 auto 24px;padding:18px;color:var(--ink)}
  #kp-yt-showcase h1{font-size:22px;margin:0 0 8px}
  #kp-yt-showcase p.lead{margin:0 0 16px;color:#a7b1c2}
  #kp-yt-showcase .grid{display:grid;grid-template-columns:1fr;gap:16px}
  @media(min-width:760px){#kp-yt-showcase .grid{grid-template-columns:1fr 1fr}}
  @media(min-width:1100px){#kp-yt-showcase .grid{grid-template-columns:1fr 1fr 1fr}}
  #kp-yt-showcase .v{position:relative;isolation:isolate}
  #kp-yt-showcase .frame{position:relative;width:100%;aspect-ratio:16/9;overflow:hidden}
  #kp-yt-showcase iframe{position:absolute;inset:0;width:100%;height:100%;border:0;display:block}
  #kp-yt-showcase .cap{display:flex;align-items:center;justify-content:space-between;gap:10px}
  #kp-yt-showcase .cap strong{font-size:14px}
  #kp-yt-showcase .badge{font-size:12px;padding:6px 10px;border-radius:999px;font-weight:800;letter-spacing:.2px}
  /* variants */
  #kp-yt-showcase .s1 .frame{border-radius:18px;box-shadow:0 20px 40px rgba(3,7,18,.45)}
  #kp-yt-showcase .s2 .frame{border-radius:26px;background:#000;box-shadow:0 20px 34px rgba(0,0,0,.5), inset 0 0 0 2px rgba(255,255,255,.06)}
  #kp-yt-showcase .s3{background:linear-gradient(180deg,rgba(255,255,255,.08),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(8px);border-radius:16px;padding:10px;box-shadow:0 20px 50px rgba(2,6,23,.45)}
  #kp-yt-showcase .s3 .frame{border-radius:14px}
  #kp-yt-showcase .s4 .frame{padding:2px;border-radius:20px;background:linear-gradient(135deg,#22d3ee,#a78bfa)}
  #kp-yt-showcase .s4 .frame > div{border-radius:inherit;overflow:hidden}
  #kp-yt-showcase .s4 iframe{border-radius:18px}
  #kp-yt-showcase .s5 .frame{border-radius:18px;box-shadow:0 0 0 2px #3b82f6,0 0 34px 6px rgba(59,130,246,.45),0 20px 40px rgba(0,0,0,.5)}
  #kp-yt-showcase .s6{background:#fff;color:#0b1020;border-radius:12px;box-shadow:0 24px 40px rgba(0,0,0,.35)}
  #kp-yt-showcase .s6 .frame{border-radius:10px 10px 6px 6px}
  #kp-yt-showcase .s6 .cap{padding:10px 12px 12px}
  #kp-yt-showcase .s7 .frame{border-radius:16px;position:relative;background:#000;box-shadow:0 22px 40px rgba(0,0,0,.55)}
  #kp-yt-showcase .s7 .frame:after{content:"";position:absolute;right:0;top:0;width:70px;height:70px;background:linear-gradient(135deg,transparent 50%,rgba(255,255,255,.06) 51%)}
  #kp-yt-showcase .s8 .frame{border-radius:18px;transform:perspective(900px) rotateX(0) rotateY(0);transition:transform .25s ease,box-shadow .25s ease;box-shadow:0 20px 40px rgba(0,0,0,.5)}
  #kp-yt-showcase .s8 .frame:hover{transform:perspective(900px) rotateX(2deg) rotateY(-2deg)}
  #kp-yt-showcase .s9 .frame{border-radius:18px;box-shadow:0 0 0 2px rgba(255,255,255,.4),0 0 0 8px rgba(255,255,255,.08),0 20px 40px rgba(0,0,0,.5)}
  #kp-yt-showcase .s10{position:relative}
  #kp-yt-showcase .s10 .ribbon{position:absolute;left:-34px;top:12px;transform:rotate(-45deg);background:#f59e0b;color:#111;font-weight:900;padding:6px 36px;z-index:2}
  #kp-yt-showcase .s10 .frame{border-radius:16px;box-shadow:0 20px 40px rgba(0,0,0,.5)}
  #kp-yt-showcase .s10 .cap{padding-top:6px}
  #kp-yt-showcase .s11 .frame{border-radius:0;clip-path:polygon(12px 0, calc(100% - 12px) 0, 100% 12px, 100% calc(100% - 12px), calc(100% - 12px) 100%, 12px 100%, 0 calc(100% - 12px), 0 12px);box-shadow:0 20px 40px rgba(0,0,0,.5)}
  #kp-yt-showcase .s12 .frame{--c:radial-gradient(50% 60% at 20% 30%,#000 98%,transparent 100%),radial-gradient(60% 50% at 80% 20%,#000 98%,transparent 100%),radial-gradient(60% 70% at 70% 80%,#000 98%,transparent 100%),radial-gradient(70% 60% at 25% 75%,#000 98%,transparent 100%);-webkit-mask:var(--c);mask:var(--c);border-radius:16px;box-shadow:0 20px 40px rgba(0,0,0,.55)}
  #kp-yt-showcase .badge.blue{background:#1f2937;color:#93c5fd}
  #kp-yt-showcase .badge.green{background:#1f2937;color:#86efac}
  #kp-yt-showcase .badge.pink{background:#1f2937;color:#f9a8d4}
  #kp-yt-showcase .badge.gold{background:#1f2937;color:#fde68a}
  #kp-yt-showcase .cardpad{padding:10px 2px 2px}
</style>
<div id="kp-yt-showcase">
  <div class="wrapper">
    <h1>Glimpse of the Videos</h1>
    <p class="lead">Twelve stylish, responsive wrappers you can drop into your Blade views. All use the same video ID for demo.</p>
    <div class="grid">
      <section class="v s1">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Soft Rounded</strong><span class="badge blue">Default</span></div>
      </section>
      <section class="v s2">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Pill Corners</strong><span class="badge green">Pill</span></div>
      </section>
      <section class="v s3">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Glass Card</strong><span class="badge pink">Frosted</span></div>
      </section>
      <section class="v s4">
        <div class="frame"><div class="inner"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div></div>
        <div class="cap"><strong>Gradient Border</strong><span class="badge gold">Glow</span></div>
      </section>
      <section class="v s5">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Neon Glow</strong><span class="badge blue">Accent</span></div>
      </section>
      <section class="v s6">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Polaroid</strong><span class="badge green">Caption</span></div>
      </section>
      <section class="v s7">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Cut‑Corner</strong><span class="badge pink">Trim</span></div>
      </section>
      <section class="v s8">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Tilt Hover</strong><span class="badge gold">Playful</span></div>
      </section>
      <section class="v s9">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Double Outline</strong><span class="badge blue">Chic</span></div>
      </section>
      <section class="v s10">
        <span class="ribbon">Featured</span>
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Ribbon</strong><span class="badge green">Spotlight</span></div>
      </section>
      <section class="v s11">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Notched</strong><span class="badge pink">Retro</span></div>
      </section>
      <section class="v s12">
        <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/o6Gld2guZ5g" title="YouTube video" allowfullscreen></iframe></div>
        <div class="cap"><strong>Blob Mask</strong><span class="badge gold">Organic</span></div>
      </section>
    </div>
  </div>
</div>
