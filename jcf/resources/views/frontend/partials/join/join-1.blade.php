<style>
:root {
  --join-primary: #005bff;
  --join-accent: #ff4747;
  --join-text: #0f172a;
}

.join-ngo-section {
  margin: 60px 0;
  border-radius: 20px;
  overflow: hidden;
  position: relative;
  background: #fff;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.join-ngo-banner {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
}

.join-ngo-banner .join-img {
  flex: 1 1 45%;
  min-width: 300px;
  position: relative;
}

.join-ngo-banner .join-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.join-ngo-banner .join-content {
  flex: 1 1 50%;
  padding: 50px 40px;
  position: relative;
  z-index: 1;
}

.join-ngo-banner::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(0,91,255,0.1), rgba(255,71,71,0.05));
  z-index: 0;
}

.join-ngo-banner h2 {
  font-size: 2rem;
  color: var(--join-text);
  font-weight: 800;
  margin-bottom: 15px;
}

.join-ngo-banner p {
  font-size: 1rem;
  color: #475569;
  margin-bottom: 25px;
  line-height: 1.6;
}

.join-ngo-banner .join-btn {
  background: linear-gradient(90deg, var(--join-primary), var(--join-accent));
  color: #fff;
  padding: 14px 32px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: 700;
  font-size: 1rem;
  box-shadow: 0 8px 25px rgba(0,91,255,0.3);
  transition: all 0.3s ease;
}

.join-ngo-banner .join-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(0,91,255,0.45);
}

@media(max-width:768px) {
  .join-ngo-banner {
    flex-direction: column;
    text-align: center;
  }
  .join-ngo-banner .join-content {
    padding: 40px 20px;
  }
}
</style>

<section class="join-ngo-section">
  <div class="join-ngo-banner">
    <div class="join-img">
      <img src="https://images.unsplash.com/photo-1581090464777-f3220bbe1b8b?auto=format&fit=crop&w=800&q=80" alt="Join our NGO">
    </div>
    <div class="join-content">
      <h2>🤝 Join Our Mission of Kindness</h2>
      <p>
        Be part of a growing community that’s changing lives every day — through education, environment care, and social upliftment.  
        Together, we can create a stronger, kinder future.
      </p>
      <a href="/join" class="join-btn">Join Us Now</a>
    </div>
  </div>
</section>
