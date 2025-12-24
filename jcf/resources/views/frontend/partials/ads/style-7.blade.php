<style>
:root{
  --ad-primary:#005bff;   /* main brand color */
  --ad-accent:#ff4747;    /* secondary accent */
  --ad-bg:#ffffff;
}

.ad-image-section{
  margin:50px 0;
  position:relative;
  overflow:hidden;
  border-radius:20px;
  background:var(--ad-bg);
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:20px 25px;
  flex-wrap:wrap;
}

.ad-image-section::before{
  content:"";
  position:absolute;
  inset:0;
  background:linear-gradient(90deg,rgba(0,91,255,0.15),rgba(255,71,71,0.15));
  z-index:0;
}

.ad-image-section .ad-content{
  position:relative;
  z-index:1;
  flex:1 1 300px;
  padding:10px 20px;
}

.ad-image-section h3{
  font-size:1.8rem;
  font-weight:800;
  color:#0f172a;
  margin-bottom:10px;
}

.ad-image-section p{
  font-size:1rem;
  color:#334155;
  margin-bottom:18px;
}

.ad-image-section .ad-btn{
  background:linear-gradient(90deg,var(--ad-primary),var(--ad-accent));
  color:#fff;
  padding:12px 28px;
  border-radius:30px;
  text-decoration:none;
  font-weight:700;
  transition:all 0.3s ease;
  box-shadow:0 8px 20px rgba(0,91,255,0.3);
}

.ad-image-section .ad-btn:hover{
  transform:translateY(-3px);
  box-shadow:0 12px 30px rgba(0,91,255,0.4);
}

.ad-image-section .ad-photo{
  flex:1 1 280px;
  text-align:center;
  position:relative;
  z-index:1;
}

.ad-image-section .ad-photo img{
  max-width:100%;
  border-radius:16px;
  transition:transform 0.3s ease;
}

.ad-image-section:hover .ad-photo img{
  transform:scale(1.03);
}

@media(max-width:768px){
  .ad-image-section{
    flex-direction:column-reverse;
    text-align:center;
    padding:30px 20px;
  }
  .ad-image-section .ad-photo img{
    max-width:90%;
  }
}
</style>

<div class="ad-image-section">
  <div class="ad-content">
    <h3>📢 Advertise with Us Today!</h3>
    <p>Showcase your brand to thousands of real visitors. Get premium visibility and better engagement.</p>
    <a href="#" class="ad-btn">Place Your Ad</a>
  </div>

  <div class="ad-photo">
    <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=600&q=80" alt="Advertise banner sample">
  </div>
</div>
