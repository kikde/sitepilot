<style>
/* Reset */
*,*::before,*::after{box-sizing:border-box}
html,body{margin:0;padding:0}
img{max-width:100%;display:block}
/* Theme */
:root{
  --teal:#0ab3af;
  --teal-dark:#009591;
  --bg:#e4f7f6;
  --ring:#c6d9d8;
  --ink:#0b2c2f;
  --muted:#5c7377;
  --hot:#ef4444;
}
body{background:#f3fbfb;font:500 15px/1.65 system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;color:var(--ink)}
.wrap{max-width:760px;margin:0 auto;padding:12px}
.block{background:var(--bg);border:1.5px solid var(--ring);border-radius:18px;box-shadow:0 10px 24px rgba(6,32,36,.08);overflow:hidden}
/* Header */
.head{display:flex;justify-content:space-between;align-items:flex-end;padding:10px 12px 8px}
.h-title{margin:0;color:var(--teal);font-weight:900;font-size:20px;position:relative;padding-bottom:6px}
.h-title::after{content:"";position:absolute;left:0;bottom:0;width:48px;height:4px;background:var(--teal);border-radius:6px}
.filters{display:flex;gap:14px;align-items:center}
.filters a{color:#2a4e52;text-decoration:none;font-weight:800;font-size:14px;opacity:.85}
.filters a.active{color:#0e2e31;text-decoration:underline;text-underline-offset:6px}
/* Featured */
.featured{padding:12px}
.thumb{position:relative;aspect-ratio:16/10;border-radius:12px;overflow:hidden;border:1px solid var(--ring)}
.thumb img{width:100%;height:100%;object-fit:cover}
.bolt{position:absolute;left:10px;top:10px;width:28px;height:28px;border-radius:999px;background:#fff;display:grid;place-items:center;color:#ff5763;font-weight:900}
.cat{position:absolute;right:10px;bottom:10px;background:var(--teal);color:#fff;font-size:12px;font-weight:900;padding:.28rem .55rem;border-radius:6px}
.meta{display:flex;gap:14px;align-items:center;color:#4e6a6e;font-weight:700;font-size:13px;margin:8px 4px 6px}
.meta .dot{opacity:.5}
.meta .right{margin-left:auto;display:flex;gap:14px;align-items:center}
.meta .views{color:var(--hot);font-weight:900}
.meta .icon{opacity:.8}
.title{margin:0 4px 6px;font-weight:900;line-height:1.25;font-size:clamp(18px,5vw,22px);color:#0f2f32}
.excerpt{margin:0 4px 10px;color:var(--muted);font-size:14px}
.read{display:inline-block;background:var(--teal);color:#fff;border:none;border-radius:999px;padding:.65rem 1rem;font-weight:900;margin:0 4px 8px;text-decoration:none}
.read:hover{background:var(--teal-dark)}
/* List */
.list{display:grid;gap:12px;padding:0 12px 12px}
.item{display:grid;grid-template-columns:92px 1fr;gap:12px;align-items:center;border:1px solid var(--ring);border-radius:12px;background:transparent;padding:6px}
.i-thumb{width:92px;height:72px;border-radius:10px;overflow:hidden;border:1px solid var(--ring)}
.i-meta{font-size:13px;color:#547377;font-weight:700;margin:0 0 2px;display:flex;align-items:center;gap:8px}
.i-title{margin:0;font-weight:900;line-height:1.35;color:#113437}
/* Pager */
.pager{display:flex;justify-content:space-between;padding:8px 12px 12px;border-top:1px solid var(--ring)}
.pager .btn{background:transparent;border:1px solid var(--ring);border-radius:10px;padding:.6rem .9rem;color:#0a4b50;font-weight:800}
.pager .btn:disabled{opacity:.55}
</style>

  <main class="wrap">
    <section class="block" id="newsBlock">
      <!-- Header -->
      <header class="head">
        <h3 class="h-title">Technology</h3>
        <nav class="filters" id="tabs">
          <a href="#" class="active" data-key="all">All</a>
          <a href="#" data-key="creative">Creative</a>
          <a href="#" data-key="technology">Technology</a>
          <a href="#" data-key="world">World</a>
        </nav>
      </header>

      <!-- Featured -->
      <div class="featured">
        <a class="thumb" id="featLink" href="#">
          <span class="bolt">⚡</span>
          <span class="cat" id="featCat">Travel</span>
          <img id="featImg" src="" alt="">
        </a>
        <div class="meta">
          <span><span class="icon">👤</span> <span id="featAuthor">Tony Stark</span> <span class="dot">•</span> <span class="icon">🗓</span> <span id="featDate">Oct 28, 2016</span></span>
          <span class="right"><span class="icon">💬</span> <span id="featComments">1</span> <span class="views"><span class="icon">🔥</span> <span id="featViews">106,807</span></span></span>
        </div>
        <h2 class="title" id="featTitle"></h2>
        <p class="excerpt" id="featExcerpt"></p>
        <a class="read" id="featRead" href="#">Read More »</a>
      </div>

      <!-- List -->
      <div class="list" id="listWrap"></div>

      <!-- Pager (static placeholders) -->
      <div class="pager">
        <button class="btn" disabled>‹ Previous</button>
        <button class="btn">Next ›</button>
      </div>
    </section>
  </main>

<script>
const DATA = {
  all: {
    featured: {
      img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/11-1-780x470.jpg',
      cat:'Creative', title:'Play This Game for Free on Steam This Weekend',
      author:'Tony Stark', date:'Oct 17, 2016', comments:0, views:'48,428',
      excerpt:'Stay focused and remember we design the best WordPress News and Magazine Themes. It’s the ones closest to you that want to…', url:'#'
    },
    list:[
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/pexels-photo-car-220x150.jpg', date:'Oct 15, 2016', title:'There May Be No Consoles in the Future, EA Exec Says', url:'#'},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/rope-220x150.jpg', date:'Oct 4, 2016', title:'Olympus announces PEN entry-level mirrorless', url:'#', hot:true},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/gamepad-220x150.jpg', date:'Apr 3, 2016', title:'Nintendo Details Next Miitomo Update', url:'#'},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/city-220x150.jpg', date:'Oct 8, 2015', title:'Killing Floor 2’s New Sharpshooter Class Detailed', url:'#'}
    ]
  },
  creative: {
    featured: {
      img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/demo-new-11-780x470.jpg',
      cat:'Travel', title:'Success is not a good teacher failure makes you humble',
      author:'Tony Stark', date:'Oct 28, 2016', comments:1, views:'106,807',
      excerpt:'Stay focused and remember we design the best WordPress News and Magazine Themes. It’s the ones closest to you that want to…', url:'#'
    },
    list:[
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/demo-image-2-220x150.jpg', date:'Oct 25, 2016', title:'Budget issues force the Tour to be cancelled', url:'#', hot:true},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/new-demo-3-220x150.jpg', date:'Oct 21, 2016', title:'Instagram’s big redesign goes live with black-and-white app', url:'#'},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/slide-27-220x150.jpg', date:'Oct 19, 2016', title:'The Top 10 Best Computer Speakers in the Market', url:'#'}
    ]
  },
  technology: {
    featured: {
      img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/garrett-parker-1-780x470.jpg',
      cat:'Life Style', title:'At Value-Focused Hotels, the Free Breakfast Gets Bigger',
      author:'Danny Rand', date:'Oct 16, 2016', comments:0, views:'33,012',
      excerpt:'Design choices and customer stories meet smart hospitality. Here’s what’s new this season…', url:'#'
    },
    list:[
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/11-1-220x150.jpg', date:'Oct 17, 2016', title:'Play This Game for Free on Steam This Weekend', url:'#'},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/slide15-220x150.jpg', date:'Oct 6, 2016', title:'Les nouveaux maillots du Real Madrid pour la saison', url:'#'}
    ]
  },
  world: {
    featured: {
      img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/slide15-780x470.jpg',
      cat:'Football', title:'Drug testing is scarce in Scottish football',
      author:'Tony Stark', date:'Oct 6, 2016', comments:0, views:'23,341',
      excerpt:'Coverage around testing practices and what it means for the league this year…', url:'#'
    },
    list:[
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/image9-220x150.jpg', date:'Oct 6, 2016', title:'I enjoy hard work; I love setting goals and achieving them', url:'#'},
      {img:'https://jannah.tielabs.com/demo/wp-content/uploads/sites/8/2016/10/pexels-photo-1-220x150.jpg', date:'Oct 10, 2016', title:'The Renault Trezor Concept is a Formula E car for the road', url:'#'}
    ]
  }
};

function render(key='all'){
  const data = DATA[key];
  // Featured
  document.getElementById('featImg').src = data.featured.img;
  document.getElementById('featCat').textContent = data.featured.cat;
  document.getElementById('featTitle').textContent = data.featured.title;
  document.getElementById('featAuthor').textContent = data.featured.author;
  document.getElementById('featDate').textContent = data.featured.date;
  document.getElementById('featComments').textContent = data.featured.comments;
  document.getElementById('featViews').textContent = data.featured.views;
  document.getElementById('featExcerpt').textContent = data.featured.excerpt;
  document.getElementById('featRead').href = data.featured.url;
  document.getElementById('featLink').href = data.featured.url;

  // List
  const wrap = document.getElementById('listWrap');
  wrap.innerHTML = '';
  data.list.forEach(item=>{
    const li = document.createElement('article');
    li.className = 'item';
    li.innerHTML = `
      <a class="i-thumb" href="${item.url}"><img src="${item.img}" alt=""></a>
      <div>
        <div class="i-meta">${item.hot ? '⚡ ' : ''}🗓 ${item.date}</div>
        <h4 class="i-title">${item.title}</h4>
      </div>`;
    wrap.appendChild(li);
  });
}

// Tabs
const tabs = document.querySelectorAll('#tabs a');
tabs.forEach(a=>{
  a.addEventListener('click', e=>{
    e.preventDefault();
    tabs.forEach(x=>x.classList.remove('active'));
    a.classList.add('active');
    render(a.dataset.key);
  });
});

// initial
render('all');
</script>

