<style>
:root {
  --donate-primary: #ff4747;
  --donate-accent: #ff8847;
  --donate-text: #0f172a;
}

.donate-section {
  margin: 60px 0;
  border-radius: 20px;
  overflow: hidden;
  position: relative;
  background: #fff;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.donate-banner {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
}

.donate-banner .donate-img {
  flex: 1 1 45%;
  min-width: 300px;
  position: relative;
}

.donate-banner .donate-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.donate-banner .donate-content {
  flex: 1 1 50%;
  padding: 50px 40px;
  position: relative;
  z-index: 1;
}

.donate-banner::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(255,71,71,0.08), rgba(255,136,71,0.05));
  z-index: 0;
}

.donate-banner h2 {
  font-size: 2rem;
  color: var(--donate-text);
  font-weight: 800;
  margin-bottom: 15px;
}

.donate-banner p {
  font-size: 1rem;
  color: #475569;
  margin-bottom: 25px;
  line-height: 1.6;
}

.donate-banner .donate-btn {
  background: linear-gradient(90deg, var(--donate-primary), var(--donate-accent));
  color: #fff;
  padding: 14px 32px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 700;
  font-size: 1rem;
  box-shadow: 0 8px 25px rgba(255,71,71,0.3);
  transition: all 0.3s ease;
}

.donate-banner .donate-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(255,71,71,0.45);
}

@media(max-width:768px) {
  .donate-banner {
    flex-direction: column-reverse;
    text-align: center;
  }
  .donate-banner .donate-content {
    padding: 40px 20px;
  }
}
</style>

<section class="donate-section">
  <div class="donate-banner">
    <div class="donate-content">
      <h2>❤️ Give Hope. Change Lives.</h2>
      <p>
        Your support can light up lives — providing education, food, and shelter to families in need.  
        Together, we can make the world a kinder place. Every contribution makes a difference.
      </p>
      <a href="/donate" class="donate-btn">Donate Now</a>
    </div>
    <div class="donate-img">
      <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=900&q=80" alt="Donate and help families">
    </div>
  </div>
</section>
