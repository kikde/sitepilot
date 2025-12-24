
<style>
#kp-s8 { margin: 18px 0; }
#kp-s8 :root{
  --brand:#ff4d4d; --brand2:#ff944d; --mint:#11c2a0; --vio:#7c3aed; --sky:#0ea5e9; --rose:#fb7185;
  --ink:#0f172a; --muted:#6b7280; --line:#e5e7eb; --card:#ffffff; --bg:#f7f8fb;
  --glass:rgba(255,255,255,.65); --darkglass:rgba(15,23,42,.45);
  --shadow:0 12px 28px rgba(2,8,23,.14); --blur:10px;
  --radius:18px;
  font-family:'Poppins', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
}#kp-s8 html, #kp-s8 body{margin:0;background:var(--bg);color:var(--ink);}#kp-s8 .wrap{max-width:440px;margin:18px auto;padding:0 10px;}#kp-s8 .demo-card{
  margin:16px 0;border:1px solid var(--line);border-radius:16px;overflow:hidden;background:#fff;
  box-shadow:0 8px 24px rgba(2,8,23,.06);
}#kp-s8 .demo-title{margin:0;padding:8px 10px;background:var(--brand);color:#fff;font-size:13px;letter-spacing:.4px;text-align:center;}#kp-s8 .preview{padding:0;background:#fff;}#kp-s8 /* Generic header surface */
.hd{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;}#kp-s8 /* Buttons / icons */
.i{font-size:20px;line-height:1;}#kp-s8 .btn{border:0;border-radius:12px;padding:8px 12px;font-weight:600}#kp-s8 .cta{background:#fff;color:var(--brand);}#kp-s8 /* NAV PANELS (shared) */
.nav-panel{display:none;}#kp-s8 .nav-panel.show{display:block;}#kp-s8 .nav-sheet{position:fixed;left:0;right:0;bottom:0;background:#fff;border-top-left-radius:20px;border-top-right-radius:20px;box-shadow:0 -10px 30px rgba(2,8,23,.15);padding:14px;z-index:55;}#kp-s8 .nav-sheet a, #kp-s8 .dropdown a, #kp-s8 .offcanvas a{display:block;padding:12px;border-radius:12px;color:#0f172a;text-decoration:none;border:1px solid #f1f5f9;margin-bottom:10px;font-weight:600}#kp-s8 .nav-sheet a:active{transform:scale(.98)}#kp-s8 .dropdown{position:absolute;right:12px;top:54px;background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:10px;box-shadow:0 12px 28px rgba(2,8,23,.15);z-index:40;min-width:62%;}#kp-s8 .offcanvas{
  position:fixed;top:0;bottom:0;left:-82%;width:80%;background:#fff;z-index:60;padding:16px;border-right:1px solid #e5e7eb;transition:transform .35s ease, left .35s ease;
  box-shadow:10px 0 28px rgba(2,8,23,.15)
}#kp-s8 .offcanvas.show{left:0;}#kp-s8 /* UTILITIES */
.logo{font-weight:800;letter-spacing:.3px}#kp-s8 .badge{padding:3px 8px;border-radius:999px;font-size:11px;font-weight:700}#kp-s8 .g{ gap:10px; display:flex; align-items:center;}#kp-s8 hr.soft{border:0;border-top:1px dashed #e5e7eb;margin:10px 0}#kp-s8 /* ————————— INDIVIDUAL HEADER LOOKS ————————— */

/* 1 Glass Gradient */
.h1{backdrop-filter:blur(var(--blur)); background:linear-gradient(90deg,#ff4d4dcc,#ff944dcc); color:#fff; border-bottom-left-radius:22px;border-bottom-right-radius:22px;}#kp-s8 /* 2 Wave Bottom */
.h2{background:var(--brand); color:#fff; position:relative;}#kp-s8 .h2:after{content:""; position:absolute; left:0; right:0; bottom:-18px; height:36px; background:radial-gradient(50% 40px at 50% 0,#ff4d4d 40%,transparent 41%);}#kp-s8 /* 3 Floating Card + CTA */
.h3{background:#fff; margin:12px; border-radius:18px; box-shadow:var(--shadow);}#kp-s8 /* 4 Split Ribbon */
.h4{background:linear-gradient(90deg,var(--brand) 50%,var(--brand2) 50%); color:#fff; border-bottom-left-radius:22px;border-bottom-right-radius:22px;}#kp-s8 /* 5 Notch Center Logo */
.h5{background:#0f172a; color:#fff; position:relative; justify-content:center;}#kp-s8 .h5 .notch{position:absolute; bottom:-14px; width:120px; height:28px; background:#0f172a; border-bottom-left-radius:30px; border-bottom-right-radius:30px; left:50%; transform:translateX(-50%);}#kp-s8 /* 6 Glass Border */
.h6{background:linear-gradient(180deg,#ffffff,#fdf2f2); border-bottom:1px solid #ffe1e1;}#kp-s8 .h6 .chip{border:1px solid #ffc6c6; padding:5px 10px; border-radius:999px; color:#ff4d4d; font-weight:700}#kp-s8 /* 7 Neon Glow */
.h7{background:#0b1220;color:#fff; box-shadow:0 0 0 1px #1f2b46 inset;}#kp-s8 .h7 .logo{ text-shadow:0 0 12px rgba(124,58,237,.8) }#kp-s8 .h7 .btn{background:linear-gradient(90deg,#7c3aed,#0ea5e9); color:#fff; box-shadow:0 10px 20px rgba(124,58,237,.35)}#kp-s8 /* 8 Soft Clay (neumorphism) */
.h8{background:#f3f5fa; color:#111827; border-bottom-left-radius:20px;border-bottom-right-radius:20px; box-shadow:inset 5px 5px 12px rgba(0,0,0,.04), inset -5px -5px 12px rgba(255,255,255,.9);}#kp-s8 /* 9 Bottom Sheet Menu */
.h9{background:linear-gradient(90deg,#ff6b6b,#f59e0b); color:#fff; border-bottom-left-radius:22px;border-bottom-right-radius:22px;}#kp-s8 /* nav uses .nav-sheet */

/* 10 Frosted White on Photo */
.h10{position:relative; color:#fff; overflow:hidden;}#kp-s8 .h10::before{content:""; position:absolute; inset:0; background:url('https://images.unsplash.com/photo-1520975431070-d1edb73bba24?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat; filter:brightness(.6);}#kp-s8 .h10 .inner{position:relative; backdrop-filter:blur(6px); background:rgba(255,255,255,.06); border-bottom-left-radius:20px; border-bottom-right-radius:20px;}#kp-s8 /* 11 Diagonal Cut */
.h11{background:linear-gradient(120deg,#0ea5e9 0%,#2563eb 60%); color:#fff; clip-path:polygon(0 0,100% 0,100% 78%,0 100%); padding-bottom:24px}#kp-s8 /* 12 Minimal Pill */
.h12{background:#fff; border-bottom:1px solid #e5e7eb;}#kp-s8 .h12 .pill{background:linear-gradient(90deg,#ff4d4d,#ff944d); color:#fff; border-radius:999px; padding:6px 12px; font-weight:700}#kp-s8 /* 13 Center Title + Icons */
.h13{background:#fff1f2; color:#111;}#kp-s8 .h13 .g.center{justify-content:center;}#kp-s8 /* 14 Gradient Ring Logo */
.h14{background:#ffffff; border-bottom:1px solid #eee;}#kp-s8 .h14 .ring{width:38px;height:38px;border-radius:999px; background:conic-gradient(from 180deg,#ff4d4d,#ff944d,#11c2a0,#7c3aed,#ff4d4d); padding:2px;}#kp-s8 .h14 .ring>div{width:100%;height:100%;background:#fff;border-radius:999px;display:flex;align-items:center;justify-content:center;font-weight:900;color:#ff4d4d}#kp-s8 /* 15 Shadowed Card Bar */
.h15{background:#fff; margin:10px; border-radius:16px; box-shadow:0 10px 26px rgba(2,8,23,.12);}#kp-s8 /* 16 Skyglass Sticky */
.h16{position:sticky; top:0; z-index:30; backdrop-filter:blur(6px); background:rgba(14,165,233,.12); border-bottom:1px solid rgba(14,165,233,.35)}#kp-s8 /* 17 Ribbon Tag */
.h17{background:linear-gradient(90deg,#f97316,#ef4444); color:#fff;}#kp-s8 .h17 .badge{background:#fff;color:#ef4444}#kp-s8 /* 18 Card with Search */
.h18{background:#fff; border-bottom:1px solid #eee;}#kp-s8 .h18 .search{flex:1; display:flex; align-items:center; gap:8px; border:1px solid #e5e7eb; padding:8px 10px; border-radius:12px}#kp-s8 .h18 input{border:0; outline:0; width:100%; font-size:14px}#kp-s8 /* 19 Icon Tabs (rounded) */
.h19{background:#111827;color:#fff; border-bottom-left-radius:18px;border-bottom-right-radius:18px;}#kp-s8 .tabrow{display:flex; gap:10px;}#kp-s8 .tabrow a{flex:1; text-align:center; padding:10px 0; border-radius:12px; background:rgba(255,255,255,.1); color:#fff; text-decoration:none; font-weight:600}#kp-s8 /* 20 Soft Mint */
.h20{background:linear-gradient(90deg,#11c2a0,#22d3ee); color:#0b1220;}#kp-s8 .h20 .btn{background:#0b1220;color:#fff}#kp-s8 /* 21 Vivid Rose Card */
.h21{background:#fff; border-bottom:1px solid #ffe4e6;}#kp-s8 .h21 .card{background:linear-gradient(90deg,#fb7185,#f472b6); color:#fff; border-radius:14px; padding:10px 12px; box-shadow:0 10px 24px rgba(251,113,133,.35)}#kp-s8 /* 22 Clean Brand Bar */
.h22{background:#fff; border-bottom:2px solid #ff4d4d;}#kp-s8 .h22 .donate{background:#ff4d4d;color:#fff}#kp-s8 /* small helpers */
.small{font-size:12px;color:#6b7280}#kp-s8 .sep{height:8px}
</style>
<div id="kp-s8">
<div class="wrap">

  <!-- 1 GLASS GRADIENT -->
  <div class="demo-card">
    <p class="demo-title">1) Glass Gradient</p>
    <div class="preview">
      <header class="hd h1">
        <div class="logo">🌺 MDMKS</div>
        <div class="g">
          <span class="badge" style="background:#ffffffcc;color:#ff4d4d;">80G</span>
          <button class="btn cta" onclick="toggleDrop('d1')"><i class="fa-solid fa-bars"></i></button>
        </div>
      </header>
      <div id="d1" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">About</a><a href="#">Projects</a><a href="#">Donate</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 2 WAVE BOTTOM -->
  <div class="demo-card">
    <p class="demo-title">2) Wave Bottom</p>
    <div class="preview" style="padding-bottom:20px">
      <header class="hd h2">
        <div class="logo">Mahadev Samiti</div>
        <button class="btn cta" onclick="toggleSheet('s2')">Menu</button>
      </header>
      <div class="sep"></div>
      <div id="s2" class="nav-panel nav-sheet">
        <a href="#">Donate Now</a><a href="#">Our Work</a><a href="#">Members</a><a href="#">Events</a><a href="#" onclick="toggleSheet('s2')">Close</a>
      </div>
    </div>
  </div>

  <!-- 3 FLOATING CARD + CTA -->
  <div class="demo-card">
    <p class="demo-title">3) Floating Card</p>
    <div class="preview">
      <header class="hd h3">
        <div class="g">
          <i class="fa-solid fa-leaf i" style="color:var(--brand)"></i>
          <div class="logo">MDMKS Trust</div>
        </div>
        <div class="g">
          <button class="btn" style="background:var(--brand);color:#fff">Donate</button>
          <button class="btn" onclick="toggleDrop('d3')"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </div>
      </header>
      <div id="d3" class="nav-panel dropdown">
        <a href="#">Impact</a><a href="#">Volunteers</a><a href="#">Gallery</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 4 SPLIT RIBBON -->
  <div class="demo-card">
    <p class="demo-title">4) Split Ribbon</p>
    <div class="preview">
      <header class="hd h4">
        <div class="logo">🌞 Mahadev</div>
        <button class="btn cta" onclick="toggleOff('o4')"><i class="fa-solid fa-bars"></i></button>
      </header>
      <nav id="o4" class="nav-panel offcanvas">
        <h3>Navigation</h3><hr class="soft">
        <a href="#">Home</a><a href="#">About</a><a href="#">Causes</a><a href="#">Donate</a><a href="#" onclick="toggleOff('o4')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 5 NOTCH CENTER -->
  <div class="demo-card">
    <p class="demo-title">5) Notch Center</p>
    <div class="preview" style="padding-bottom:18px">
      <header class="hd h5">
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleSheet('s5')"></i></div>
        <div class="logo">Mahadev NGO</div>
        <div class="badge" style="background:#22d3ee;color:#0b1220">Join</div>
        <div class="notch"></div>
      </header>
      <div id="s5" class="nav-panel nav-sheet">
        <a href="#">Programs</a><a href="#">Success Stories</a><a href="#">Gallery</a><a href="#" onclick="toggleSheet('s5')">Close</a>
      </div>
    </div>
  </div>

  <!-- 6 GLASS BORDER -->
  <div class="demo-card">
    <p class="demo-title">6) Glass Border</p>
    <div class="preview">
      <header class="hd h6">
        <div class="g">
          <span class="chip">80G</span>
          <span class="chip">CSR</span>
        </div>
        <div class="logo" style="color:#ff4d4d;font-weight:800">MDMKS</div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d6')"></i></div>
      </header>
      <div id="d6" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">Donate</a><a href="#">Volunteer</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 7 NEON GLOW -->
  <div class="demo-card">
    <p class="demo-title">7) Neon Glow</p>
    <div class="preview">
      <header class="hd h7">
        <div class="logo">✨ NGO Impact</div>
        <button class="btn" onclick="toggleOff('o7')">Menu</button>
      </header>
      <nav id="o7" class="nav-panel offcanvas">
        <h3>Explore</h3><hr class="soft">
        <a href="#">Causes</a><a href="#">Reports</a><a href="#">Partners</a><a href="#" onclick="toggleOff('o7')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 8 SOFT CLAY -->
  <div class="demo-card">
    <p class="demo-title">8) Soft Clay</p>
    <div class="preview">
      <header class="hd h8">
        <div class="g">
          <div style="width:34px;height:34px;border-radius:10px;background:#fff;display:flex;align-items:center;justify-content:center;border:1px solid #e5e7eb">🌿</div>
          <div class="logo">Mahadev Care</div>
        </div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d8')"></i></div>
      </header>
      <div id="d8" class="nav-panel dropdown">
        <a href="#">Initiatives</a><a href="#">Members</a><a href="#">Donate</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 9 BOTTOM SHEET -->
  <div class="demo-card">
    <p class="demo-title">9) Bottom Sheet Menu</p>
    <div class="preview">
      <header class="hd h9">
        <div class="logo">🪷 MDMKS Trust</div>
        <button class="btn cta" onclick="toggleSheet('s9')">Open</button>
      </header>
      <div id="s9" class="nav-panel nav-sheet">
        <a href="#">Donate</a><a href="#">Causes</a><a href="#">Events</a><a href="#" onclick="toggleSheet('s9')">Close</a>
      </div>
    </div>
  </div>

  <!-- 10 PHOTO + FROST -->
  <div class="demo-card">
    <p class="demo-title">10) Photo Frost</p>
    <div class="preview">
      <div class="h10">
        <div class="hd inner">
          <div class="logo">Mahadev Samiti</div>
          <div class="i"><i class="fa-solid fa-bars" onclick="toggleOff('o10')"></i></div>
        </div>
      </div>
      <nav id="o10" class="nav-panel offcanvas">
        <h3>Menu</h3><hr class="soft">
        <a href="#">Home</a><a href="#">Work</a><a href="#">Donate</a><a href="#" onclick="toggleOff('o10')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 11 DIAGONAL CUT -->
  <div class="demo-card">
    <p class="demo-title">11) Diagonal Cut</p>
    <div class="preview" style="padding-bottom:10px">
      <header class="hd h11">
        <div class="logo">SkyHope</div>
        <button class="btn cta" onclick="toggleDrop('d11')">Menu</button>
      </header>
      <div id="d11" class="nav-panel dropdown">
        <a href="#">Impact</a><a href="#">Volunteer</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 12 MINIMAL PILL -->
  <div class="demo-card">
    <p class="demo-title">12) Minimal Pill</p>
    <div class="preview">
      <header class="hd h12">
        <div class="pill">MDMKS</div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d12')"></i></div>
      </header>
      <div id="d12" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">About</a><a href="#">Donate</a>
      </div>
    </div>
  </div>

  <!-- 13 CENTER TITLE + ICONS -->
  <div class="demo-card">
    <p class="demo-title">13) Centered Title</p>
    <div class="preview">
      <header class="hd h13">
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleOff('o13')"></i></div>
        <div class="g center"><div class="logo">Mahadev NGO</div></div>
        <div class="i"><i class="fa-solid fa-phone"></i></div>
      </header>
      <nav id="o13" class="nav-panel offcanvas">
        <h3>Explore</h3><hr class="soft">
        <a href="#">Projects</a><a href="#">Members</a><a href="#">Contact</a><a href="#" onclick="toggleOff('o13')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 14 GRADIENT RING LOGO -->
  <div class="demo-card">
    <p class="demo-title">14) Gradient Ring Logo</p>
    <div class="preview">
      <header class="hd h14">
        <div class="g">
          <div class="ring"><div>म</div></div>
          <div class="logo">Mahadev Samiti</div>
        </div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d14')"></i></div>
      </header>
      <div id="d14" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">Causes</a><a href="#">Donate</a><a href="#">Contact</a>
      </div>
    </div>
  </div>

  <!-- 15 SHADOWED CARD BAR -->
  <div class="demo-card">
    <p class="demo-title">15) Shadowed Card</p>
    <div class="preview">
      <header class="hd h15">
        <div class="logo">❤️ CareFund</div>
        <div class="g">
          <button class="btn" style="background:var(--brand);color:#fff">Donate</button>
          <button class="btn" onclick="toggleOff('o15')"><i class="fa-solid fa-bars"></i></button>
        </div>
      </header>
      <nav id="o15" class="nav-panel offcanvas">
        <h3>Navigate</h3><hr class="soft">
        <a href="#">Home</a><a href="#">Stories</a><a href="#">Team</a><a href="#" onclick="toggleOff('o15')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 16 STICKY SKYGLASS -->
  <div class="demo-card">
    <p class="demo-title">16) Sticky Skyglass</p>
    <div class="preview">
      <header class="hd h16">
        <div class="g">
          <i class="fa-solid fa-dove"></i>
          <div class="logo">HopeWings</div>
        </div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d16')"></i></div>
      </header>
      <div id="d16" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">Programs</a><a href="#">Donate</a>
      </div>
    </div>
  </div>

  <!-- 17 RIBBON TAG -->
  <div class="demo-card">
    <p class="demo-title">17) Ribbon Tag</p>
    <div class="preview">
      <header class="hd h17">
        <div class="logo">Mahadev</div>
        <span class="badge">80G Approved</span>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleSheet('s17')"></i></div>
      </header>
      <div id="s17" class="nav-panel nav-sheet">
        <a href="#">About</a><a href="#">Initiatives</a><a href="#">Donate</a><a href="#" onclick="toggleSheet('s17')">Close</a>
      </div>
    </div>
  </div>

  <!-- 18 SEARCH IN HEADER -->
  <div class="demo-card">
    <p class="demo-title">18) Search in Header</p>
    <div class="preview">
      <header class="hd h18">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input placeholder="Search causes...">
        </div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleOff('o18')"></i></div>
      </header>
      <nav id="o18" class="nav-panel offcanvas">
        <h3>Menu</h3><hr class="soft">
        <a href="#">Home</a><a href="#">Volunteer</a><a href="#">Donate</a><a href="#" onclick="toggleOff('o18')">Close</a>
      </nav>
    </div>
  </div>

  <!-- 19 ICON TABS -->
  <div class="demo-card">
    <p class="demo-title">19) Icon Tabs Bar</p>
    <div class="preview">
      <header class="hd h19">
        <div class="logo">NGO</div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d19')"></i></div>
      </header>
      <div id="d19" class="nav-panel dropdown">
        <div class="tabrow">
          <a href="#"><i class="fa-solid fa-house"></i><br>Home</a>
          <a href="#"><i class="fa-solid fa-hands-holding-heart"></i><br>Causes</a>
          <a href="#"><i class="fa-solid fa-image"></i><br>Gallery</a>
        </div>
        <a href="#" style="margin-top:10px">Donate</a>
      </div>
    </div>
  </div>

  <!-- 20 SOFT MINT -->
  <div class="demo-card">
    <p class="demo-title">20) Soft Mint</p>
    <div class="preview">
      <header class="hd h20">
        <div class="g">
          <i class="fa-solid fa-seedling"></i>
          <div class="logo">GreenHope</div>
        </div>
        <button class="btn" onclick="toggleSheet('s20')">Menu</button>
      </header>
      <div id="s20" class="nav-panel nav-sheet">
        <a href="#">Our Work</a><a href="#">Team</a><a href="#">Donate</a><a href="#" onclick="toggleSheet('s20')">Close</a>
      </div>
    </div>
  </div>

  <!-- 21 VIVID ROSE CARD -->
  <div class="demo-card">
    <p class="demo-title">21) Vivid Rose Card</p>
    <div class="preview">
      <header class="hd h21">
        <div class="card g">
          <i class="fa-solid fa-heart"></i>
          <div class="logo">CareKind</div>
        </div>
        <div class="i"><i class="fa-solid fa-bars" onclick="toggleDrop('d21')"></i></div>
      </header>
      <div id="d21" class="nav-panel dropdown">
        <a href="#">Home</a><a href="#">Impact</a><a href="#">Donate</a>
      </div>
    </div>
  </div>

  <!-- 22 CLEAN BRAND BAR -->
  <div class="demo-card">
    <p class="demo-title">22) Clean Brand Bar</p>
    <div class="preview">
      <header class="hd h22">
        <div class="g">
          <img src="https://via.placeholder.com/36" alt="" style="width:36px;height:36px;border-radius:10px;border:1px solid #eee">
          <div class="logo">MDMKS</div>
        </div>
        <div class="g">
          <button class="btn donate">Donate</button>
          <button class="btn" onclick="toggleOff('o22')"><i class="fa-solid fa-bars"></i></button>
        </div>
      </header>
      <nav id="o22" class="nav-panel offcanvas">
        <h3>Quick Links</h3><hr class="soft">
        <a href="#">Home</a><a href="#">About</a><a href="#">Members</a><a href="#">Contact</a><a href="#" onclick="toggleOff('o22')">Close</a>
      </nav>
    </div>
  </div>

</div>

<script>
/* Basic togglers — no dependencies */
function closeAll(){
  document.querySelectorAll('.nav-panel').forEach(el=>el.classList.remove('show'));
}
function toggleDrop(id){
  const el = document.getElementById(id);
  const open = el.classList.contains('show');
  closeAll();
  if(!open) el.classList.add('show');
}
function toggleOff(id){
  const el = document.getElementById(id);
  const open = el.classList.contains('show');
  closeAll();
  if(!open) el.classList.add('show');
}
function toggleSheet(id){
  const el = document.getElementById(id);
  const open = el.classList.contains('show');
  closeAll();
  if(!open) el.classList.add('show');
}
/* click-away close for dropdowns */
document.addEventListener('click', (e)=>{
  const isToggle = e.target.closest('button, i');
  const isPanel = e.target.closest('.dropdown,.offcanvas,.nav-sheet');
  if(!isToggle && !isPanel){ closeAll(); }
});
</script>
</div>
