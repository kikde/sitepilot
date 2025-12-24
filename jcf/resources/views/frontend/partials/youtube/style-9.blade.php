{{-- resources/views/frontend/partials/section/style-9b.blade.php --}}
<style>
  #kp-ytf-collection,#kp-ytf-collection *{box-sizing:border-box}
  #kp-ytf-collection .space{height:24px}
  /* FRAME A */
  #kp-ytf-collection .ytf-a .wrap{max-width:820px;margin:0 auto 24px;padding:0 12px}
  #kp-ytf-collection .ytf-a .frame{position:relative;border-radius:22px;overflow:hidden}
  #kp-ytf-collection .ytf-a .frame::before{content:"";position:absolute;inset:0;border-radius:inherit;padding:3px;background:conic-gradient(from 140deg,#22d3ee,#6366f1,#f472b6,#22d3ee);-webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude;filter:drop-shadow(0 10px 26px rgba(99,102,241,.35));pointer-events:none}
  #kp-ytf-collection .ytf-a .glass{background:rgba(255,255,255,.92);border-radius:inherit;padding:10px;box-shadow:0 24px 60px rgba(15,23,42,.12),0 4px 16px rgba(15,23,42,.08)}
  #kp-ytf-collection .ytf-a .ratio{aspect-ratio:16/9;border-radius:14px;overflow:hidden}
  #kp-ytf-collection .ytf-a iframe{width:100%;height:100%;display:block;border:0}
  /* FRAME B */
  #kp-ytf-collection .ytf-b .wrap{max-width:820px;margin:0 auto 24px;padding:0 12px}
  #kp-ytf-collection .ytf-b .card{position:relative;border-radius:24px;padding:14px;background:#ffffffcc;backdrop-filter:blur(8px);border:1px solid #e8ecf7;box-shadow:0 18px 44px rgba(15,23,42,.12)}
  #kp-ytf-collection .ytf-b .ribbon{position:absolute;inset:auto 24px -10px 24px;height:20px;background:linear-gradient(90deg,#f0f5ff,#e9fcff);border-radius:0 0 24px 24px;filter:blur(6px);opacity:.9;pointer-events:none}
  #kp-ytf-collection .ytf-b .ratio{aspect-ratio:16/9;border-radius:16px;overflow:hidden}
  #kp-ytf-collection .ytf-b iframe{width:100%;height:100%;display:block;border:0}
  /* FRAME C */
  #kp-ytf-collection .ytf-c .wrap{max-width:820px;margin:0 auto 24px;padding:0 12px}
  #kp-ytf-collection .ytf-c .shell{position:relative;border-radius:28px;background:#fff;padding:10px;border:1px solid #e6ebf7;box-shadow:0 20px 50px rgba(2,6,23,.12)}
  #kp-ytf-collection .ytf-c .bar{position:absolute;left:12px;right:12px;top:10px;height:6px;border-radius:999px;background:linear-gradient(90deg,#22d3ee,#0ea5e9);box-shadow:0 8px 18px rgba(14,165,233,.25);pointer-events:none}
  #kp-ytf-collection .ytf-c .ratio{aspect-ratio:16/9;border-radius:18px;overflow:hidden;margin-top:10px}
  #kp-ytf-collection .ytf-c iframe{width:100%;height:100%;display:block;border:0}
  /* FRAME D */
  #kp-ytf-collection .ytf-d .wrap{max-width:820px;margin:0 auto 24px;padding:0 12px}
  #kp-ytf-collection .ytf-d .card{position:relative;border-radius:20px;background:#fff;padding:12px;border:1px solid #e9eef8;box-shadow:0 18px 42px rgba(15,23,42,.12);overflow:hidden}
  #kp-ytf-collection .ytf-d .pattern{position:absolute;inset:0;pointer-events:none;opacity:.08;background-image:radial-gradient(circle at 1px 1px,#111 1px,transparent 1px);background-size:14px 14px}
  #kp-ytf-collection .ytf-d .corner{position:absolute;top:0;left:0;width:0;height:0;border-top:70px solid #6366f1;border-right:70px solid transparent;filter:drop-shadow(0 4px 12px rgba(99,102,241,.35));z-index:2}
  #kp-ytf-collection .ytf-d .corner::after{content:"NEW";position:absolute;top:-56px;left:8px;color:#fff;font:900 10px/1 ui-sans-serif,system-ui;transform:rotate(-45deg);letter-spacing:.6px}
  #kp-ytf-collection .ytf-d .ratio{aspect-ratio:16/9;border-radius:12px;overflow:hidden;position:relative}
  #kp-ytf-collection .ytf-d iframe{width:100%;height:100%;border:0;display:block}
  /* FRAME E */
  #kp-ytf-collection .ytf-e .wrap{max-width:820px;margin:0 auto 24px;padding:0 12px}
  #kp-ytf-collection .ytf-e .frame{position:relative;border-radius:20px;padding:6px;background:radial-gradient(120% 120% at 0% 0%,rgba(165,180,252,.35),transparent 45%),radial-gradient(120% 120% at 100% 100%,rgba(56,189,248,.28),transparent 45%),#ffffff;box-shadow:0 10px 30px rgba(2,6,23,.08);border:1px solid #eef2ff}
  #kp-ytf-collection .ytf-e .inner{border-radius:14px;overflow:hidden;position:relative}
  #kp-ytf-collection .ytf-e .inner::after{content:"";position:absolute;inset:0;border-radius:inherit;pointer-events:none;box-shadow:inset 0 0 0 1px rgba(99,102,241,.15)}
  #kp-ytf-collection .ytf-e .ratio{aspect-ratio:16/9;position:relative}
  #kp-ytf-collection .ytf-e iframe{width:100%;height:100%;border:0;display:block}
</style>
<div id="kp-ytf-collection">
  <section class="ytf-a">
    <div class="wrap"><div class="frame"><div class="glass"><div class="ratio"><iframe src="https://www.youtube.com/embed/FudfVyYWNxQ?rel=0&modestbranding=1&color=white" title="Video A" allowfullscreen></iframe></div></div></div></div>
  </section>
  <div class="space"></div>
  <section class="ytf-b">
    <div class="wrap"><div class="card"><div class="ratio"><iframe src="https://www.youtube.com/embed/FudfVyYWNxQ?rel=0&modestbranding=1&color=white" title="Video B" allowfullscreen></iframe></div><div class="ribbon"></div></div></div>
  </section>
  <div class="space"></div>
  <section class="ytf-c">
    <div class="wrap"><div class="shell"><div class="bar"></div><div class="ratio"><iframe src="https://www.youtube.com/embed/FudfVyYWNxQ?rel=0&modestbranding=1&color=white" title="Video C" allowfullscreen></iframe></div></div></div>
  </section>
  <div class="space"></div>
  <section class="ytf-d">
    <div class="wrap"><div class="card"><div class="corner"></div><div class="pattern"></div><div class="ratio"><iframe src="https://www.youtube.com/embed/FudfVyYWNxQ?rel=0&modestbranding=1&color=white" title="Video D" allowfullscreen></iframe></div></div></div>
  </section>
  <div class="space"></div>
  <section class="ytf-e">
    <div class="wrap"><div class="frame"><div class="inner"><div class="ratio"><iframe src="https://www.youtube.com/embed/FudfVyYWNxQ?rel=0&modestbranding=1&color=white" title="Video E" allowfullscreen></iframe></div></div></div></div>
  </section>
</div>
