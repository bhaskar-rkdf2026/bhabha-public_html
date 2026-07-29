<?php
// Bhabha University – Why Bhabha section (Exact Design Match)
?>
<section class="bu-why-section">
  <div class="bu-why-container">
    
    <!-- Top Header Row -->
    <div class="bu-why-header">
      <div class="bu-why-header-left">
        <span class="bu-why-label">WHY BHABHA</span>
        <h2 class="bu-why-heading">
          A university built<br>
          for <em>impact.</em>
        </h2>
      </div>
      <div class="bu-why-header-right">
        <p class="bu-why-intro">
          From accreditation to ecosystem — every dimension of the Bhabha experience is 
          engineered for academic depth, global mobility and lifelong opportunity.
        </p>
      </div>
    </div>
    
    <!-- Features Grid -->
    <div class="bu-why-grid">
      
      <!-- Item 1 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-certificate"></i></div>
        <h3 class="bu-why-title">NAAC & UGC Recognised</h3>
        <p class="bu-why-desc">Accredited by NAAC; UGC recognised under 2(f) & 12(B).</p>
      </div>
      
      <!-- Item 2 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-flask"></i></div>
        <h3 class="bu-why-title">Research Excellence</h3>
        <p class="bu-why-desc">120+ research labs, 250+ patents and 1,200+ publications.</p>
      </div>
      
      <!-- Item 3 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-globe"></i></div>
        <h3 class="bu-why-title">Global Collaborations</h3>
        <p class="bu-why-desc">MoUs with 60+ international universities across 4 continents.</p>
      </div>
      
      <!-- Item 4 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-mortar-board"></i></div>
        <h3 class="bu-why-title">Outstanding Placements</h3>
        <p class="bu-why-desc">98% placement rate with 500+ recruiters and packages up to ₹52 LPA.</p>
      </div>
      
      <!-- Item 5 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-building-o"></i></div>
        <h3 class="bu-why-title">Smart Campus</h3>
        <p class="bu-why-desc">150-acre wifi-enabled green campus with smart classrooms.</p>
      </div>
      
      <!-- Item 6 -->
      <div class="bu-why-item">
        <div class="bu-why-icon"><i class="fa fa-rocket"></i></div>
        <h3 class="bu-why-title">Innovation Ecosystem</h3>
        <p class="bu-why-desc">Incubation centre, student startups and industry mentoring.</p>
      </div>

    </div>

  </div>
</section>

<!-- ===== WHY BHABHA STYLES ===== -->
<style>
.bu-why-section {
  background-color: #061D7C !important; /* Deep Navy background */
  padding: 90px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  position: relative !important;
  overflow: hidden !important;
}
.bu-why-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-why-header {
  display: flex !important;
  align-items: flex-end !important;
  justify-content: space-between !important;
  margin-bottom: 70px !important;
  gap: 40px !important;
}
.bu-why-header-left {
  flex: 1 !important;
}
.bu-why-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-why-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(34px, 4.2vw, 54px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.15 !important;
  margin: 0 !important;
}
.bu-why-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}
.bu-why-header-right {
  flex: 1.1 !important;
  max-width: 540px !important;
}
.bu-why-intro {
  font-size: 16px !important;
  line-height: 1.75 !important;
  color: rgba(255, 255, 255, 0.72) !important;
  margin: 0 !important;
}

/* Features Grid */
.bu-why-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 60px 48px !important;
  position: relative !important;
}
.bu-why-item {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  position: relative !important;
  padding: 10px 0 !important;
  border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
  padding-right: 30px !important;
}
.bu-why-item:nth-child(3n) {
  border-right: none !important;
  padding-right: 0 !important;
}
.bu-why-item:nth-child(-n+3) {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  padding-bottom: 40px !important;
}
.bu-why-item:nth-child(n+4) {
  padding-top: 20px !important;
}
.bu-why-icon {
  font-size: 24px !important;
  color: #FFC107 !important;
  margin-bottom: 20px !important;
  height: 32px !important;
  display: flex !important;
  align-items: center !important;
}
.bu-why-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 0 12px 0 !important;
  line-height: 1.3 !important;
}
.bu-why-desc {
  font-size: 14px !important;
  line-height: 1.65 !important;
  color: rgba(255, 255, 255, 0.65) !important;
  margin: 0 !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-why-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 20px !important;
    margin-bottom: 50px !important;
  }
  .bu-why-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 40px 30px !important;
  }
  .bu-why-item {
    border-right: none !important;
    padding-right: 0 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding-bottom: 24px !important;
  }
  .bu-why-item:nth-child(-n+3) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding-bottom: 24px !important;
  }
  .bu-why-item:nth-child(n+4) {
    padding-top: 0 !important;
  }
  .bu-why-item:last-child {
    border-bottom: none !important;
    padding-bottom: 0 !important;
  }
}
@media (max-width: 575px) {
  .bu-why-section {
    padding: 60px 16px !important;
  }
  .bu-why-grid {
    grid-template-columns: 1fr !important;
    gap: 30px !important;
  }
  .bu-why-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding-bottom: 20px !important;
  }
  .bu-why-item:last-child {
    border-bottom: none !important;
  }
  .bu-why-title {
    font-size: 19px !important;
  }
}
</style>
