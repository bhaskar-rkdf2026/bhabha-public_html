<?php
// Bhabha University — Campus Life & Infrastructure (World-class facilities & environment)
?>
<!-- =================== CAMPUS LIFE & INFRASTRUCTURE SECTION =================== -->
<section class="bu-campus-life-section">
  <div class="bu-campus-life-container">
    <div class="bu-campus-life-header">
      <span class="bu-campus-sec-label">CAMPUS LIFE &amp; INFRASTRUCTURE</span>
      <h2 class="bu-campus-sec-title">World-class <em>facilities &amp; environment.</em></h2>
      <p class="bu-campus-sec-desc">A 32-acre expansive green ecosystem equipped with advanced academic infrastructure, renewable research facilities, live media broadcasting studios, and modern simulation laboratories.</p>
    </div>

    <div class="bu-campus-facilities-grid">
      
      <!-- Card 1: Central Library -->
      <a href="<?php echo href('infrastructure.php'); ?>#library" class="bu-campus-facility-card">
        <div class="bu-campus-facility-img-wrap">
          <img loading="lazy" decoding="async" src="<?php echo URL_ROOT;?>images/library.jpg" alt="Central Library" class="bu-campus-facility-img">
          <span class="bu-campus-facility-badge"><i class="fa fa-book"></i> Central Library</span>
        </div>
        <div class="bu-campus-facility-info">
          <h4>Central Library</h4>
          <p>50,000+ books, digital e-journals &amp; silent reading halls</p>
          <span class="bu-campus-card-link">Explore Facility <i class="fa fa-arrow-right"></i></span>
        </div>
      </a>

      <!-- Card 2: Solar & Green Energy -->
      <a href="<?php echo href('solar.php'); ?>" class="bu-campus-facility-card">
        <div class="bu-campus-facility-img-wrap">
          <img loading="lazy" decoding="async" src="<?php echo URL_ROOT;?>images/solar.jpg" alt="Solar & Green Energy" class="bu-campus-facility-img">
          <span class="bu-campus-facility-badge"><i class="fa fa-sun-o"></i> Green Campus</span>
        </div>
        <div class="bu-campus-facility-info">
          <h4>Solar &amp; Green Energy</h4>
          <p>Eco-friendly campus with advanced solar research wing</p>
          <span class="bu-campus-card-link">Explore Facility <i class="fa fa-arrow-right"></i></span>
        </div>
      </a>

      <!-- Card 3: Radio Bhabha 90.4 FM -->
      <a href="<?php echo href('radio.php'); ?>" class="bu-campus-facility-card">
        <div class="bu-campus-facility-img-wrap">
          <img loading="lazy" decoding="async" src="<?php echo URL_ROOT;?>images/radio.jpg" alt="Radio Bhabha 90.4 FM" class="bu-campus-facility-img">
          <span class="bu-campus-facility-badge"><i class="fa fa-microphone"></i> Community Radio</span>
        </div>
        <div class="bu-campus-facility-info">
          <h4>Radio Bhabha 90.4 FM</h4>
          <p>Community radio station broadcasting student media projects</p>
          <span class="bu-campus-card-link">Explore Facility <i class="fa fa-arrow-right"></i></span>
        </div>
      </a>

      <!-- Card 4: Modern Skill Labs -->
      <a href="<?php echo href('infrastructure.php'); ?>#labs" class="bu-campus-facility-card">
        <div class="bu-campus-facility-img-wrap">
          <img loading="lazy" decoding="async" src="<?php echo URL_ROOT;?>images/skill_lab.jpg" alt="Modern Skill Labs" class="bu-campus-facility-img" onerror="this.src='<?php echo URL_ROOT;?>extra-images/col-3-thum5.jpg';">
          <span class="bu-campus-facility-badge"><i class="fa fa-cogs"></i> Skill &amp; Simulation</span>
        </div>
        <div class="bu-campus-facility-info">
          <h4>Modern Skill Labs</h4>
          <p>State-of-the-art practical simulation &amp; training centers</p>
          <span class="bu-campus-card-link">Explore Facility <i class="fa fa-arrow-right"></i></span>
        </div>
      </a>

    </div>
  </div>
</section>

<!-- ===== CAMPUS LIFE SECTION STYLES ===== -->
<style>
.bu-campus-life-section {
  background-color: #FFFFFF !important;
  padding: 70px 20px 75px !important;
  width: 100% !important;
  position: relative !important;
  float: left !important;
  clear: both !important;
  display: block !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
}

.bu-campus-life-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
}

.bu-campus-life-header {
  text-align: center !important;
  margin-bottom: 42px !important;
}

.bu-campus-sec-label {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  display: inline-block !important;
  margin-bottom: 8px !important;
}

.bu-campus-sec-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(26px, 3vw, 36px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  margin: 0 0 10px 0 !important;
  line-height: 1.25 !important;
}

.bu-campus-sec-title em {
  font-style: italic !important;
  color: #D99B00 !important;
  font-family: 'Playfair Display', Georgia, serif !important;
}

.bu-campus-sec-desc {
  font-size: 14px !important;
  color: #64748B !important;
  max-width: 720px !important;
  margin: 0 auto !important;
  line-height: 1.6 !important;
}

/* 4-Card Grid */
.bu-campus-facilities-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 22px !important;
}

.bu-campus-facility-card {
  background: #FFFFFF !important;
  border: 1px solid #E2E8F0 !important;
  border-radius: 12px !important;
  overflow: hidden !important;
  text-decoration: none !important;
  display: flex !important;
  flex-direction: column !important;
  box-shadow: 0 4px 16px rgba(6, 29, 124, 0.05) !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
  position: relative !important;
}

.bu-campus-facility-card:hover {
  transform: translateY(-6px) !important;
  box-shadow: 0 16px 36px rgba(6, 29, 124, 0.12) !important;
  border-color: #FFC107 !important;
}

.bu-campus-facility-img-wrap {
  width: 100% !important;
  height: 175px !important;
  overflow: hidden !important;
  position: relative !important;
  background: #0A1B54 !important;
}

.bu-campus-facility-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  object-position: center !important;
  display: block !important;
  transition: transform 0.4s ease !important;
}

.bu-campus-facility-card:hover .bu-campus-facility-img {
  transform: scale(1.06) !important;
}

.bu-campus-facility-badge {
  position: absolute !important;
  bottom: 10px !important;
  left: 10px !important;
  background: rgba(6, 29, 124, 0.85) !important;
  color: #FFFFFF !important;
  backdrop-filter: blur(4px) !important;
  font-size: 10px !important;
  font-weight: 700 !important;
  padding: 3px 9px !important;
  border-radius: 14px !important;
  letter-spacing: 0.3px !important;
  display: flex !important;
  align-items: center !important;
  gap: 5px !important;
}

.bu-campus-facility-badge i {
  color: #FFC107 !important;
}

.bu-campus-facility-info {
  padding: 18px 18px 16px !important;
  display: flex !important;
  flex-direction: column !important;
  flex: 1 !important;
  justify-content: space-between !important;
}

.bu-campus-facility-info h4 {
  font-size: 16px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  margin: 0 0 6px 0 !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  line-height: 1.35 !important;
}

.bu-campus-facility-info p {
  font-size: 12.5px !important;
  color: #64748B !important;
  margin: 0 0 12px 0 !important;
  line-height: 1.55 !important;
}

.bu-campus-card-link {
  font-size: 11.5px !important;
  font-weight: 700 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.6px !important;
  color: #D99B00 !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
  transition: color 0.2s ease !important;
}

.bu-campus-card-link i {
  font-size: 10px !important;
  transition: transform 0.2s ease !important;
}

.bu-campus-facility-card:hover .bu-campus-card-link {
  color: #061D7C !important;
}

.bu-campus-facility-card:hover .bu-campus-card-link i {
  transform: translateX(4px) !important;
}

/* Responsive */
@media (max-width: 991px) {
  .bu-campus-facilities-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 18px !important;
  }
}

@media (max-width: 575px) {
  .bu-campus-facilities-grid {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
  .bu-campus-life-section {
    padding: 50px 15px 55px !important;
  }
}
</style>
