<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  :root{
    --ink:#ffffff; --muted:#fffbf7; --bg:#e4624d; --line:rgba(255,255,255,.25);
  }
  *{box-sizing:border-box}
  
  .wrap{max-width:420px; width:100%; background:var(--bg); color:var(--ink); border-radius:6px; overflow:hidden;}
  .inner{padding:18px 16px 22px; position:relative;}
  .texture{position:absolute; inset:0; background:url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 600 900\"><path d=\"M0 0h600v900H0z\" fill=\"none\"/><g fill=\"none\" stroke=\"%23ffffff\" stroke-opacity=\".18\"><path d=\"M-80 140c220-40 260 240 520 200M-60 460c300-60 260 260 560 220\"/><path d=\"M-80 280c240-40 260 240 520 200\"/></g></svg>') no-repeat center/cover; opacity:.35; mix-blend:screen; pointer-events:none;}
  .kicker{font-weight:800; margin-bottom:8px;}
  h1{margin:6px 0 10px; line-height:1.25; font-size:1.6rem;}
  p.lead{margin:0 0 14px; color:rgba(255,255,255,.9); line-height:1.75;}
  hr{border:none; border-top:1px solid var(--line); margin:10px 0 16px;}
  .item{display:grid; grid-template-columns:68px 1fr; gap:14px; align-items:center; padding:12px 0; border-top:1px solid var(--line);}
  .item:first-of-type{border-top:none}
  .icon{width:68px; height:68px; border-radius:999px; background:#fff; color:#e4624d; display:grid; place-items:center; font-size:26px;}
  .title{font-weight:900; margin-bottom:6px;}
  .desc{margin:0; color:rgba(255,255,255,.92)}
</style>


  <section class="wrap">
    <div class="inner">
      <div class="texture" aria-hidden="true"></div>
      <div class="kicker">About Us</div>
      <h1>Helping Each Other can Make World Better</h1>
      <p class="lead">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using lorem Ipsum is that it has a more.</p>
      <hr>
      <div class="item">
        <div class="icon"><i class="fa-solid fa-hand-holding-droplet"></i></div>
        <div>
          <div class="title">Safe Water Access</div>
          <p class="desc">It is a long established fact that a reader will be distracted by the readable content.</p>
        </div>
      </div>
      <div class="item">
        <div class="icon"><i class="fa-solid fa-soap"></i></div>
        <div>
          <div class="title">Hygiene Solutions</div>
          <p class="desc">It is a long established fact that a reader will be distracted by the readable content.</p>
        </div>
      </div>
    </div>
  </section>

