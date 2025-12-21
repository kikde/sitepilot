<style>
*,*::before,*::after{box-sizing:border-box}
html,body{margin:0;padding:0}
img{display:block;max-width:100%}
:root{
  --accent:#ff1744;
  --ink:#0b0f19;
  --muted:#6b7280;
  --line:#eceff3;
}
body{font:500 15px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink);background:#fff}
.wrap{max-width:760px;margin:14px auto;padding:0 12px}

/* Tabs */
.tabs{display:grid;grid-template-columns:1fr 1fr;background:#111;border-radius:4px;overflow:hidden;position:relative}
.tab{appearance:none;border:0;background:#111;color:#cbd5e1;padding:14px 0;font-weight:900}
.tab.active{background:var(--accent);color:#fff;position:relative}
.tab.active::after{
  content:"";position:absolute;left:50%;bottom:-8px;transform:translateX(-50%);
  width:0;height:0;border-left:8px solid transparent;border-right:8px solid transparent;border-top:8px solid var(--accent);
}

/* Panel */
.panel{display:none}
.panel.active{display:block}
.list{padding:16px 8px}

/* Item */
.item{display:grid;grid-template-columns:96px 1fr;gap:14px;align-items:center;padding:14px 0;border-bottom:1px solid var(--line)}
.thumb{width:96px;height:76px;border-radius:4px;overflow:hidden;background:#eee}
.meta{display:flex;align-items:center;gap:8px;color:var(--muted);font-size:13px;margin:0 0 6px}
.meta .cal{width:18px;height:18px;display:inline-block;background:center/contain no-repeat url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%23ff1744' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");}
.title{margin:0;font-weight:900;line-height:1.35}
.title a{color:var(--ink);text-decoration:none}
.title a:hover{color:var(--accent)}

/* Clamp title to 2 lines */
.title{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}

@media (min-width:420px){
  .item{grid-template-columns:110px 1fr}
  .thumb{width:110px;height:82px}
}
</style>

  <main class="wrap">
    <!-- Tabs -->
    <div class="tabs" role="tablist">
      <button class="tab" role="tab" aria-selected="true" data-panel="recent">Recent</button>
      <button class="tab active" role="tab" aria-selected="false" data-panel="popular">Popular</button>
    </div>

    <!-- Recent -->
    <section class="panel" id="recent" role="tabpanel" aria-hidden="true">
      <div class="list">
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1011/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>April 1, 2022</span></div>
            <h4 class="title"><a href="#">Meet the Hair Style Which is That Swept Copenhagen Fashion Week</a></h4>
          </div>
        </article>
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1020/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>May 31, 2022</span></div>
            <h4 class="title"><a href="#">Swiss Chard and Lamb Torte With Fennel National Day Special</a></h4>
          </div>
        </article>
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1016/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>April 1, 2022</span></div>
            <h4 class="title"><a href="#">This Beauty Brand is not Tackles Skincare From the Inside Out</a></h4>
          </div>
        </article>
      </div>
    </section>

    <!-- Popular (default active like screenshot) -->
    <section class="panel active" id="popular" role="tabpanel" aria-hidden="false">
      <div class="list">
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1003/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>April 1, 2022</span></div>
            <h4 class="title"><a href="#">Meet the Hair Style Which is That Swept Copenhagen Fashion Week</a></h4>
          </div>
        </article>
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1019/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>May 31, 2022</span></div>
            <h4 class="title"><a href="#">Swiss Chard and Lamb Torte With Fennel National Day Special</a></h4>
          </div>
        </article>
        <article class="item">
          <a class="thumb" href="#"><img src="https://picsum.photos/id/1024/300/200" alt=""></a>
          <div>
            <div class="meta"><span class="cal"></span><span>April 1, 2022</span></div>
            <h4 class="title"><a href="#">This Beauty Brand is not Tackles Skincare From the Inside Out</a></h4>
          </div>
        </article>
      </div>
    </section>
  </main>

<script>
const tabs = document.querySelectorAll('.tab');
const panels = document.querySelectorAll('.panel');
function show(key){
  panels.forEach(p=>p.classList.remove('active'));
  document.getElementById(key).classList.add('active');
  tabs.forEach(t=>t.classList.remove('active'));
  document.querySelector('.tab[data-panel="'+key+'"]').classList.add('active');
}
tabs.forEach(t=>t.addEventListener('click',()=>show(t.dataset.panel)));
</script>
