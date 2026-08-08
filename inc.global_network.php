<?php
// Bhabha University – International / Global Network section (Exact Design Match)
?>
<section class="bu-global-network-section">
  <div class="bu-global-network-container">
    
    <!-- Top Icon -->
    <div class="bu-network-icon-wrap">
      <i class="fa fa-globe"></i>
    </div>
    
    <!-- Header Block -->
    <span class="bu-network-label">INTERNATIONAL</span>
    <h2 class="bu-network-heading">A truly <em>global</em> network.</h2>
    <p class="bu-network-sub">60+ MoUs with leading universities across North America, Europe and Asia. Student exchange, joint research and dual degree pathways.</p>
    
    <!-- Partner Tags Grid -->
    <div class="bu-network-tags">
      <div class="bu-network-tags-row">
        <span class="bu-net-tag">University of Toronto</span>
        <span class="bu-net-tag">TU Munich</span>
        <span class="bu-net-tag">NUS Singapore</span>
        <span class="bu-net-tag">Monash</span>
        <span class="bu-net-tag">Curtin</span>
        <span class="bu-net-tag">UPenn</span>
        <span class="bu-net-tag">Sheffield</span>
      </div>
      <div class="bu-network-tags-row">
        <span class="bu-net-tag">Kyoto University</span>
        <span class="bu-net-tag">ETH Zürich</span>
      </div>
    </div>
    
    <!-- Bottom Button -->
    <div class="bu-network-btn-wrap">
      <a href="<?php echo href("enquiry.php"); ?>" class="bu-btn-gold">APPLY NOW &nbsp;→</a>
    </div>

  </div>
</section>

<!-- ===== GLOBAL NETWORK SECTION STYLES ===== -->
<style>
.bu-global-network-section {
  background-color: #061D7C !important; /* Deep Navy Blue */
  padding: 90px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  text-align: center !important;
  position: relative !important;
  overflow: hidden !important;
}
.bu-global-network-container {
  max-width: 900px !important;
  margin: 0 auto !important;
}

/* Icon */
.bu-network-icon-wrap {
  font-size: 36px !important;
  color: #FFC107 !important;
  margin-bottom: 20px !important;
}

/* Header */
.bu-network-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin-bottom: 16px !important;
  display: block !important;
}
.bu-network-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 4vw, 48px) !important;
  font-weight: 800 !important;
  color: #FFFFFF !important;
  line-height: 1.2 !important;
  margin: 0 0 20px 0 !important;
}
.bu-network-heading em {
  font-style: italic !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
}
.bu-network-sub {
  font-size: 15.5px !important;
  line-height: 1.75 !important;
  color: rgba(255, 255, 255, 0.72) !important;
  margin: 0 auto 48px auto !important;
  max-width: 650px !important;
}

/* Partner tags */
.bu-network-tags {
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
  align-items: center !important;
  margin-bottom: 48px !important;
}
.bu-network-tags-row {
  display: flex !important;
  gap: 12px !important;
  justify-content: center !important;
  flex-wrap: wrap !important;
}
.bu-net-tag {
  background-color: #040F4A !important; /* Slightly darker navy */
  border: 1px solid rgba(255, 255, 255, 0.12) !important;
  color: #FFFFFF !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  padding: 10px 18px !important;
  border-radius: 3px !important;
  transition: all 0.22s ease !important;
  cursor: default !important;
}
.bu-net-tag:hover {
  border-color: #FFC107 !important;
  color: #FFC107 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(255, 193, 7, 0.15) !important;
}

/* Button */
.bu-network-btn-wrap {
  display: flex !important;
  justify-content: center !important;
}
.bu-btn-gold {
  background-color: #FFC107 !important;
  color: #061D7C !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  padding: 14px 32px !important;
  border-radius: 3px !important;
  text-decoration: none !important;
  transition: all 0.22s ease !important;
  display: inline-block !important;
  border: none !important;
}
.bu-btn-gold:hover {
  background-color: #D99B00 !important;
  color: #000000 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 24px rgba(255, 193, 7, 0.35) !important;
  text-decoration: none !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 575px) {
  .bu-global-network-section {
    padding: 60px 16px !important;
  }
  .bu-network-tags-row {
    gap: 8px !important;
  }
  .bu-net-tag {
    font-size: 11px !important;
    padding: 8px 14px !important;
  }
  .bu-btn-gold {
    padding: 12px 28px !important;
    font-size: 11px !important;
  }
}
</style>
