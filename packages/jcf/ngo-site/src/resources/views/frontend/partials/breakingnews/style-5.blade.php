<style>
/* Reset */
*,*::before,*::after{box-sizing:border-box}
html,body{margin:0;padding:0}
img{max-width:100%;display:block}

/* Theme */
:root{
  --edge:#e7ecf0;
  --ink:#0f172a;
  --muted:#64748b;
  --tab:#f8fafc;
  --tab-active:#eef2ff;
  --link:#1d4ed8;
  --star:#0ea5e9;
}
body{background:#ffffff;font:500 15px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink)}
.wrap{max-width:760px;margin:16px auto;padding:0 12px}
.card{border:1px solid var(--edge);border-radius:10px;overflow:hidden}

/* tabs header */
.tabs{display:grid;grid-template-columns:1fr 1fr 1fr;border-bottom:1px solid var(--edge);background:var(--tab)}
.tab-btn{appearance:none;background:transparent;border:none;margin:0;padding:14px 0;font-weight:800;color:#334155;border-right:1px solid var(--edge)}
.tab-btn:last-child{border-right:0}
.tab-btn.active{background:var(--tab-active);color:#1e293b;box-shadow:inset 0 -3px 0 #2563eb}
/* list */
.panel{display:none}
.panel.active{display:block}
.list{display:grid;gap:14px;padding:14px}
.item{display:grid;grid-template-columns:72px 1fr;gap:12px;align-items:center}
.thumb{width:72px;height:56px;border-radius:8px;overflow:hidden}
.title{margin:0 0 4px;font-weight:800;color:#0b1a36;line-height:1.25}
.title a{color:#0b1a36;text-decoration:none}
.title a:hover{color:var(--link);text-decoration:underline}
.meta{display:flex;align-items:center;gap:6px;color:var(--muted);font-size:13px}
.meta .dot{opacity:.5}
.stars{display:inline-grid;grid-auto-flow:column;gap:2px;transform:translateY(1px)}
.star{width:12px;height:12px;display:inline-block;background:conic-gradient(from 90deg at 50% 50%, var(--star) 0 360deg);-webkit-mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>') center/contain no-repeat;mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>') center/contain no-repeat}
/* comments panel style */
.comment{display:grid;grid-template-columns:40px 1fr;gap:10px;align-items:center}
.avatar{width:40px;height:40px;border-radius:50%;overflow:hidden}
.small{font-size:13px;color:var(--muted)}
</style>

  <main class="wrap">
    <section class="card">
      <!-- Tabs header -->
      <div class="tabs">
        <button class="tab-btn active" data-panel="recent">Recent</button>
        <button class="tab-btn" data-panel="popular">Popular</button>
        <button class="tab-btn" data-panel="comments">Comments</button>
      </div>

      <!-- Recent -->
      <div class="panel active" id="recent">
        <div class="list">
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1005/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">One man with courage makes a majority</a></h4>
              <div class="meta"><span class="stars">
                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>
              </span><span class="dot">•</span><span>Oct 27, 2018</span></div>
            </div>
          </article>

          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1015/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Success is not a good teacher failure makes you humble</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 28, 2016</span></div>
            </div>
          </article>

          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1025/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Budget issues force the Tour to be cancelled</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 25, 2016</span></div>
            </div>
          </article>

          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1041/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Instagram’s big redesign goes live with black-and-white app</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 21, 2016</span></div>
            </div>
          </article>

          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1069/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">The only thing that overcomes hard luck is hard work</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 20, 2016</span></div>
            </div>
          </article>
        </div>
      </div>

      <!-- Popular -->
      <div class="panel" id="popular">
        <div class="list">
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1041/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Instagram’s big redesign goes live with black-and-white app</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 21, 2016</span></div>
            </div>
          </article>
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1015/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Success is not a good teacher failure makes you humble</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 28, 2016</span></div>
            </div>
          </article>
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1058/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">The secret of life is not to do what you like but to like what you do</a></h4>
              <div class="meta"><span>🗓</span><span>Sep 2, 2015</span></div>
            </div>
          </article>
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/1005/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">One man with courage makes a majority</a></h4>
              <div class="meta"><span class="stars">
                <span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>
              </span><span class="dot">•</span><span>Oct 27, 2018</span></div>
            </div>
          </article>
          <article class="item">
            <a class="thumb" href="#"><img src="https://picsum.photos/id/103/200/140" alt=""></a>
            <div>
              <h4 class="title"><a href="#">Education is the best provision for the journey to old age</a></h4>
              <div class="meta"><span>🗓</span><span>Oct 2, 2015</span></div>
            </div>
          </article>
        </div>
      </div>

      <!-- Comments -->
      <div class="panel" id="comments">
        <div class="list" style="padding:12px">
          <article class="comment">
            <a class="avatar" href="#"><img src="https://i.pravatar.cc/80?img=5" alt=""></a>
            <div>
              <div class="title" style="margin:0 0 2px;font-weight:800">“Amazing write‑up! Learned a lot.”</div>
              <div class="small">— Priya on <a href="#" style="color:var(--link);text-decoration:none">Success is not a good teacher…</a></div>
            </div>
          </article>
          <article class="comment">
            <a class="avatar" href="#"><img src="https://i.pravatar.cc/80?img=12" alt=""></a>
            <div>
              <div class="title" style="margin:0 0 2px;font-weight:800">“More of this content please.”</div>
              <div class="small">— Arjun on <a href="#" style="color:var(--link);text-decoration:none">Instagram’s big redesign…</a></div>
            </div>
          </article>
          <article class="comment">
            <a class="avatar" href="#"><img src="https://i.pravatar.cc/80?img=3" alt=""></a>
            <div>
              <div class="title" style="margin:0 0 2px;font-weight:800">“Well explained and concise.”</div>
              <div class="small">— Neha on <a href="#" style="color:var(--link);text-decoration:none">Budget issues force the Tour…</a></div>
            </div>
          </article>
        </div>
      </div>

    </section>
  </main>

<script>
// Simple tab switcher
const buttons = document.querySelectorAll('.tab-btn');
const panels  = document.querySelectorAll('.panel');
buttons.forEach(btn=>btn.addEventListener('click',()=>{
  buttons.forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  panels.forEach(p=>p.classList.remove('active'));
  document.getElementById(btn.dataset.panel).classList.add('active');
}));
</script>
