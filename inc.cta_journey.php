<?php
// Bhabha University – Journey Starts Now Admissions CTA Section (Exact Design Match)
?>
<section class="bu-journey-section">
  <div class="bu-journey-container">
    
    <!-- LEFT: Text details -->
    <div class="bu-journey-text-col">
      <span class="bu-journey-label">ADMISSIONS OPEN · 2026-27</span>
      <h2 class="bu-journey-heading">Your journey starts now.</h2>
      <p class="bu-journey-sub">Applications open across all 15 schools. Speak to an advisor, download the prospectus, or apply online in minutes.</p>
    </div>

    <!-- RIGHT: 3 stacked buttons -->
    <div class="bu-journey-buttons-col">
      <a href="<?php echo href("enquiry.php"); ?>" class="bu-journey-btn bu-btn-navy">
        <span>APPLY NOW</span>
        <i class="fa fa-arrow-right"></i>
      </a>
      <a href="https://drive.google.com/file/d/1jhIfUzZbjtOWSCnYu77C0MM5C8U5vumt/view" target="_blank" class="bu-journey-btn bu-btn-white">
        <span>DOWNLOAD PROSPECTUS</span>
        <i class="fa fa-file-pdf-o"></i>
      </a>
      <a href="tel:07554246498" class="bu-journey-btn bu-btn-outline">
        <span>SCHEDULE CALL</span>
        <i class="fa fa-phone"></i>
      </a>
    </div>

  </div>
</section>

<!-- ===== JOURNEY SECTION STYLES ===== -->
<style>
.bu-journey-section {
  background-color: #FFC107 !important; /* Gold background */
  padding: 80px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-journey-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  gap: 50px !important;
}

/* Left Column */
.bu-journey-text-col {
  flex: 1.2 !important;
}
.bu-journey-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.2px !important;
  color: #040F4A !important;
  text-transform: uppercase !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-journey-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(34px, 4.5vw, 54px) !important;
  font-weight: 800 !important;
  color: #040F4A !important;
  line-height: 1.15 !important;
  margin: 0 0 20px 0 !important;
}
.bu-journey-sub {
  font-size: 15px !important;
  color: #040F4A !important;
  line-height: 1.7 !important;
  margin: 0 !important;
  max-width: 520px !important;
  opacity: 0.85 !important;
}

/* Right Column (Stacked Buttons) */
.bu-journey-buttons-col {
  flex: 0.8 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 16px !important;
  width: 100% !important;
  max-width: 360px !important;
}
.bu-journey-btn {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  padding: 18px 24px !important;
  font-size: 11.5px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  text-decoration: none !important;
  border-radius: 3px !important;
  transition: all 0.22s ease !important;
  width: 100% !important;
}

/* Button 1: Navy */
.bu-journey-btn.bu-btn-navy {
  background-color: #040F4A !important;
  color: #FFFFFF !important;
  border: none !important;
}
.bu-journey-btn.bu-btn-navy span,
.bu-journey-btn.bu-btn-navy i {
  border: none !important;
  outline: none !important;
  color: #FFFFFF !important;
}
.bu-journey-btn.bu-btn-navy:hover {
  background-color: #0A1B54 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 20px rgba(4, 15, 74, 0.35) !important;
}
.bu-journey-btn.bu-btn-navy:hover span,
.bu-journey-btn.bu-btn-navy:hover i {
  color: #FFFFFF !important;
}

/* Button 2: White */
.bu-journey-btn.bu-btn-white {
  background-color: #FFFFFF !important;
  color: #040F4A !important;
  border: none !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
}
.bu-journey-btn.bu-btn-white span,
.bu-journey-btn.bu-btn-white i {
  border: none !important;
  outline: none !important;
  color: #040F4A !important;
}
.bu-journey-btn.bu-btn-white:hover {
  background-color: #F8F7F4 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
}
.bu-journey-btn.bu-btn-white:hover span,
.bu-journey-btn.bu-btn-white:hover i {
  color: #040F4A !important;
}

/* Button 3: Outline */
.bu-journey-btn.bu-btn-outline {
  background-color: transparent !important;
  border: 1.5px solid #040F4A !important;
  color: #040F4A !important;
  padding: 16.5px 24px !important;
}
.bu-journey-btn.bu-btn-outline span,
.bu-journey-btn.bu-btn-outline i {
  border: none !important;
  outline: none !important;
  color: #040F4A !important;
}
.bu-journey-btn.bu-btn-outline:hover {
  background-color: rgba(4, 15, 74, 0.06) !important;
  transform: translateY(-2px) !important;
}
.bu-journey-btn.bu-btn-outline:hover span,
.bu-journey-btn.bu-btn-outline:hover i {
  color: #040F4A !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-journey-container {
    flex-direction: column !important;
    gap: 40px !important;
  }
  .bu-journey-text-col {
    text-align: center !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
  }
  .bu-journey-buttons-col {
    max-width: 100% !important;
  }
}
@media (max-width: 575px) {
  .bu-journey-section {
    padding: 60px 16px !important;
  }
}
</style>
