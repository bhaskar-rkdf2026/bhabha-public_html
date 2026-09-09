<?php
// Bhabha University – International / Global Network section (Exact Design Match)
$glob_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'global_network');
    $glob_sec = $db->getOne('homepage_sections');
}
if ($glob_sec && isset($glob_sec['status']) && $glob_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$glob_label = !empty($glob_sec['title']) ? $glob_sec['title'] : 'INTERNATIONAL';
$glob_heading = !empty($glob_sec['heading']) ? $glob_sec['heading'] : 'A truly <em>global</em> network.';
$glob_sub = !empty($glob_sec['subheading']) ? $glob_sec['subheading'] : '60+ MoUs with leading universities across North America, Europe and Asia. Student exchange, joint research and dual degree pathways.';

$glob_extra = !empty($glob_sec['extra_data']) ? json_decode($glob_sec['extra_data'], true) : [];
$glob_tags = !empty($glob_extra['tags']) ? $glob_extra['tags'] : ['University of Toronto', 'TU Munich', 'NUS Singapore', 'Monash', 'Curtin', 'UPenn', 'Sheffield', 'Kyoto University', 'ETH Zürich'];
$glob_btn_text = !empty($glob_extra['button_text']) ? $glob_extra['button_text'] : 'APPLY NOW &nbsp;→';
$glob_btn_url = !empty($glob_extra['button_url']) ? $glob_extra['button_url'] : (function_exists('href') ? href("enquiry.php") : 'enquiry.php');
if (strpos($glob_btn_url, 'http') !== 0 && strpos($glob_btn_url, '/') !== 0 && strpos($glob_btn_url, '#') !== 0) {
    $glob_btn_url = URL_ROOT . $glob_btn_url;
}
?>
<section class="bu-global-network-section">
  <div class="bu-global-network-container">
    
    <!-- Top Icon -->
    <div class="bu-network-icon-wrap">
      <i class="fa fa-globe"></i>
    </div>
    
    <!-- Header Block -->
    <span class="bu-network-label"><?php echo htmlspecialchars($glob_label); ?></span>
    <h2 class="bu-network-heading"><?php echo $glob_heading; ?></h2>
    <p class="bu-network-sub"><?php echo nl2br(htmlspecialchars($glob_sub)); ?></p>
    
    <!-- Partner Tags Grid -->
    <div class="bu-network-tags">
      <div class="bu-network-tags-row">
        <?php foreach ($glob_tags as $tag): ?>
          <span class="bu-net-tag"><?php echo htmlspecialchars($tag); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    
    <!-- Bottom Button -->
    <div class="bu-network-btn-wrap">
      <a href="<?php echo $glob_btn_url; ?>" class="bu-btn-gold"><?php echo $glob_btn_text; ?></a>
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
.bu-network-icon-wrap i,
.bu-network-icon-wrap .fa {
  font-family: 'FontAwesome' !important;
  font-style: normal !important;
  font-weight: normal !important;
  display: inline-block !important;
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
