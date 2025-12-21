{{-- resources/views/frontend/partials/section/style-article-cards-v2.blade.php --}}
<style>
  #kp-articles{--ink:#0b1220;--muted:#667085;--brand:#12c35b;--meta:#ef4444;--ring:#e7eaf1;--bg:#f8fafc;--card:#ffffff;--radius:16px;--shadow:0 12px 26px rgba(2,6,23,.08);--btn:#ff4d4d}
  #kp-articles,#kp-articles *{box-sizing:border-box}
  #kp-articles .wrap{max-width:760px;margin:0 auto 24px;padding:16px 14px 0;background:transparent}
  #kp-articles .card{background:var(--card);border:1px solid var(--ring);border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow);padding:0 0 18px}
  #kp-articles .thumb{position:relative;aspect-ratio:16/10;background:#0b1020;overflow:hidden}
  #kp-articles .thumb img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .35s ease}
  #kp-articles .card:hover .thumb img{transform:scale(1.03)}
  #kp-articles .cat{display:inline-block;margin:12px 0 8px 18px;position:relative;background:var(--brand);color:#fff;font-weight:900;font-size:12.5px;padding:.35rem .66rem .4rem;border-radius:6px;line-height:1}
  #kp-articles .cat::after{content:"";position:absolute;right:-8px;top:50%;transform:translateY(-50%);border-left:8px solid var(--brand);border-top:8px solid transparent;border-bottom:8px solid transparent}
  #kp-articles .content{padding:0 18px}
  #kp-articles .meta{display:flex;flex-wrap:wrap;gap:10px 16px;align-items:center;margin-bottom:8px}
  #kp-articles .meta .i{display:inline-flex;align-items:center;gap:6px;color:#111827;font-weight:600;font-size:13px}
  #kp-articles .meta .i svg{width:16px;height:16px;stroke:var(--meta)}
  #kp-articles .meta .i .t strong{color:var(--meta);font-weight:900}
  #kp-articles .dot{width:4px;height:4px;background:#d1d5db;border-radius:50%;display:inline-block}
  #kp-articles .title{margin:10px 0 8px;font-weight:900;font-size:clamp(18px,5vw,22px);line-height:1.25}
  #kp-articles .excerpt{color:var(--muted);font-size:14px;margin:0 0 14px}
  #kp-articles .btn{display:inline-flex;align-items:center;justify-content:center;padding:.75rem 1rem;font-weight:900;font-size:13px;border:2px solid var(--btn);color:#111827;background:#fff;text-decoration:none;border-radius:8px;margin-left:18px}
  #kp-articles .btn:hover{background:var(--btn);color:#fff}
  #kp-articles .sp{height:16px}
</style>
<div id="kp-articles">
  <main class="wrap">
    <article class="card">
      <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1400&auto=format&fit=crop" alt="Sports car"></a>
      <span class="cat">Football</span>
      <div class="content">
        <div class="meta">
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><span class="t">May 31, 2022</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg><span class="t">by <strong>admin</strong></span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg><span class="t">0 Comments</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><span class="t">2 minutes read</span></span>
        </div>
        <h3 class="title">We Can’t Wait to Try This Gaming Area &amp; Makeup Trends.</h3>
        <p class="excerpt">WelcRimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
      </div>
      <a class="btn" href="#">READ MORE</a>
    </article>

    <div class="sp"></div>

    <article class="card">
      <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1400&auto=format&fit=crop" alt="Basketball court"></a>
      <span class="cat">Basketball</span>
      <div class="content">
        <div class="meta">
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><span class="t">Jun 12, 2022</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg><span class="t">by <strong>editor</strong></span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg><span class="t">3 Comments</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><span class="t">4 minutes read</span></span>
        </div>
        <h3 class="title">Court-Side Stories: Training that Builds Champions.</h3>
        <p class="excerpt">From basic drills to pro-level tactics, our coaches share practical tips for your next big match.</p>
      </div>
      <a class="btn" href="#">READ MORE</a>
    </article>

    <div class="sp"></div>

    <article class="card">
      <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1520975922284-5e27b2b1b86b?q=80&w=1400&auto=format&fit=crop" alt="Cricket stadium"></a>
      <span class="cat">Cricket</span>
      <div class="content">
        <div class="meta">
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><span class="t">Aug 2, 2022</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg><span class="t">by <strong>staff</strong></span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg><span class="t">1 Comment</span></span>
          <span class="i"><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><span class="t">3 minutes read</span></span>
        </div>
        <h3 class="title">Matchday: Tactics, Lineups &amp; Key Players to Watch.</h3>
        <p class="excerpt">Get ready for kick-off with quick insights and stats that matter for today’s fixture.</p>
      </div>
      <a class="btn" href="#">READ MORE</a>
    </article>
  </main>
</div>
