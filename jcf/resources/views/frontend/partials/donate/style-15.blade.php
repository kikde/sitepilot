<style>
:root{--ink:#fff;--muted:#e6e6e6;--orange:#ff6f3d}
*{box-sizing:border-box} body{margin:0;padding:16px;background:#fff;font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink);display:flex;justify-content:center}
.wrap{max-width:420px;width:100%}
.card{background:#ee4d2d;border-radius:18px;padding:14px;box-shadow:0 16px 40px rgba(0,0,0,.1);color:#fff;overflow:hidden}
h3{margin:0 0 10px}
.chips{display:flex;gap:10px;margin:10px 0}
.chips button{background:#fff;color:#111;border:none;border-radius:999px;padding:8px 14px;font-weight:900;opacity:.9}
.input{background:#fff;border:none;border-radius:999px;padding:12px 14px;color:#111;width:100%;font-weight:900}
.cta{display:inline-block;margin-top:10px;background:#222;color:#fff;border:none;border-radius:999px;padding:12px 16px;font-weight:900}
h4{margin:14px 0 6px}
.progress{height:8px;background:#ffd4c6;border-radius:999px;overflow:hidden}
.fill{height:100%;width:64%;background:#ffc19e}
.meta{display:flex;justify-content:space-between;opacity:.9;margin-top:6px}
</style></head><body>
<div class="wrap">
  <article class="card">
    <h3>Custom Donate Now</h3>
    <div class="chips">
      <button>$10</button><button>$20</button><button>$30</button><button>$40</button><button>$50</button>
    </div>
    <input class="input" value="10">
    <button class="cta">➤ Donate Now</button>
    <h4>❤ Donate Now</h4>
    <div style="font-size:1.2rem;font-weight:900;margin-bottom:4px">Support Kids by Raising Valuable Donations</div>
    <div class="progress"><div class="fill"></div></div>
    <div class="meta"><span>Raised : $25,000</span><span>Goal : $30,000</span></div>
  </article>
</div>

