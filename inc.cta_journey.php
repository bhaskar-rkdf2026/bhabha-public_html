<?php
// Bhabha University – Journey Starts Now Admissions CTA Section (Dynamic from Database)
global $db;
$db->where('section_key', 'cta_journey');
$cta_sec = $db->getOne('homepage_sections');

if (!$cta_sec || $cta_sec['status'] != 1) {
    return;
}

$cta_label = !empty($cta_sec['title']) ? $cta_sec['title'] : 'ADMISSIONS OPEN · 2026-27';
$cta_heading = !empty($cta_sec['heading']) ? $cta_sec['heading'] : 'Your journey starts now.';
$cta_sub = !empty($cta_sec['subheading']) ? $cta_sec['subheading'] : 'Applications open across all 25 schools and institutes. Speak to an advisor, download the prospectus, or apply online in minutes.';

$cta_extra = !empty($cta_sec['extra_data']) ? json_decode($cta_sec['extra_data'], true) : [];

$btn1_text = $cta_extra['btn1_text'] ?? 'APPLY NOW';
$btn1_url  = !empty($cta_extra['btn1_url']) ? (strpos($cta_extra['btn1_url'], 'http') === 0 ? $cta_extra['btn1_url'] : URL_ROOT . ltrim($cta_extra['btn1_url'], '/')) : href("enquiry.php");

$btn2_text = $cta_extra['btn2_text'] ?? 'DOWNLOAD PROSPECTUS';
$btn2_url  = $cta_extra['btn2_url'] ?? 'https://drive.google.com/file/d/1jhIfUzZbjtOWSCnYu77C0MM5C8U5vumt/view';

$btn3_text = $cta_extra['btn3_text'] ?? 'SCHEDULE CALL';
$btn3_phone = $cta_extra['btn3_phone'] ?? '07554246498';
?>
<section class="bu-journey-section">
  <div class="bu-journey-container">
    
    <!-- LEFT: Text details -->
    <div class="bu-journey-text-col">
      <span class="bu-journey-label"><?php echo htmlspecialchars($cta_label); ?></span>
      <h2 class="bu-journey-heading"><?php echo $cta_heading; ?></h2>
      <p class="bu-journey-sub"><?php echo htmlspecialchars($cta_sub); ?></p>
    </div>

    <!-- RIGHT: 3 stacked buttons -->
    <div class="bu-journey-buttons-col">
      <a href="<?php echo $btn1_url; ?>" class="bu-journey-btn bu-btn-navy">
        <span><?php echo htmlspecialchars($btn1_text); ?></span>
        <i class="fa fa-arrow-right"></i>
      </a>
      <a href="<?php echo $btn2_url; ?>" target="_blank" class="bu-journey-btn bu-btn-white">
        <span><?php echo htmlspecialchars($btn2_text); ?></span>
        <i class="fa fa-file-pdf-o"></i>
      </a>
      <a href="tel:<?php echo htmlspecialchars($btn3_phone); ?>" class="bu-journey-btn bu-btn-outline">
        <span><?php echo htmlspecialchars($btn3_text); ?></span>
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
  border-radius: 4px !important;
  text-decoration: none !important;
  transition: all 0.25s ease !important;
  box-sizing: border-box !important;
}

/* Navy Button */
.bu-btn-navy {
  background-color: #040F4A !important;
  color: #FFFFFF !important;
}
.bu-btn-navy:hover {
  background-color: #000830 !important;
  color: #FFC107 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 15px rgba(4, 15, 74, 0.2) !important;
  text-decoration: none !important;
}

/* White Button */
.bu-btn-white {
  background-color: #FFFFFF !important;
  color: #040F4A !important;
}
.bu-btn-white:hover {
  background-color: #F8F9FA !important;
  color: #040F4A !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1) !important;
  text-decoration: none !important;
}

/* Outline Button */
.bu-btn-outline {
  background-color: transparent !important;
  color: #040F4A !important;
  border: 1.5px solid #040F4A !important;
}
.bu-btn-outline:hover {
  background-color: #040F4A !important;
  color: #FFC107 !important;
  transform: translateY(-2px) !important;
  text-decoration: none !important;
}

/* Responsive */
@media (max-width: 991px) {
  .bu-journey-container {
    flex-direction: column !important;
    text-align: center !important;
    gap: 35px !important;
  }
  .bu-journey-text-col {
    align-items: center !important;
  }
  .bu-journey-sub {
    margin: 0 auto !important;
  }
  .bu-journey-buttons-col {
    max-width: 100% !important;
  }
}
@media (max-width: 575px) {
  .bu-journey-section {
    padding: 55px 16px !important;
  }
  .bu-journey-heading {
    font-size: 32px !important;
  }
  .bu-journey-btn {
    padding: 15px 20px !important;
  }
}
</style>
