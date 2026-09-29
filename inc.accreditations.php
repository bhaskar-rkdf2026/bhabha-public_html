<?php
// Bhabha University – Statutory Approvals Component (Dynamic from Database)
global $db;
$db->where('section_key', 'accreditations');
$accred_sec = $db->getOne('homepage_sections');

if (!$accred_sec || $accred_sec['status'] != 1) {
    return;
}

$accred_label = !empty($accred_sec['title']) ? $accred_sec['title'] : 'Statutory Approvals';
$accred_heading = !empty($accred_sec['heading']) ? $accred_sec['heading'] : 'Recognised by <em>leading bodies.</em>';

$accred_extra = !empty($accred_sec['extra_data']) ? json_decode($accred_sec['extra_data'], true) : [];
$accred_items = $accred_extra['items'] ?? [];

function bu_resolve_accred_img($img) {
    if (empty($img)) return URL_IMG . 'ugc_new_logo.jpg';
    if (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0) return $img;
    if (strpos($img, 'images/') === 0 || strpos($img, 'upload/') === 0) return URL_ROOT . ltrim($img, '/');
    return URL_IMG . ltrim($img, '/');
}
?>
<!-- =================== STATUTORY APPROVALS SECTION =================== -->
<section class="bu-statutory-section" id="buStatutoryApprovalsSection">
  <div class="bu-statutory-container">
    <span class="bu-accred-section-label"><?php echo htmlspecialchars($accred_label); ?></span>
    <h2 class="bu-stat-title"><?php echo $accred_heading; ?></h2>
    
    <!-- Continuous Auto-Sliding Marquee Container (Desktop & Mobile) -->
    <div class="bu-accred-slider-wrap">
      <div class="bu-accred-track">
        <!-- Set 1 -->
        <?php foreach ($accred_items as $item): 
          $item_link = !empty($item['link']) ? (strpos($item['link'], 'http') === 0 ? $item['link'] : URL_ROOT . ltrim($item['link'], '/')) : href('approvals.php');
          $item_img = bu_resolve_accred_img($item['img'] ?? '');
          $item_alt = $item['alt'] ?? $item['name'];
        ?>
          <a href="<?php echo $item_link; ?>" class="bu-accred-badge" title="<?php echo htmlspecialchars($item_alt); ?>">
            <img src="<?php echo $item_img; ?>" alt="<?php echo htmlspecialchars($item_alt); ?>" class="bu-accred-logo" loading="lazy" decoding="async" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name'] ?? ''); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc'] ?? ''); ?></span>
          </a>
        <?php endforeach; ?>

        <!-- Set 2 (Duplicate for Seamless Infinite Auto-Scroll on Desktop & Mobile) -->
        <?php foreach ($accred_items as $item): 
          $item_link = !empty($item['link']) ? (strpos($item['link'], 'http') === 0 ? $item['link'] : URL_ROOT . ltrim($item['link'], '/')) : href('approvals.php');
          $item_img = bu_resolve_accred_img($item['img'] ?? '');
          $item_alt = $item['alt'] ?? $item['name'];
        ?>
          <a href="<?php echo $item_link; ?>" class="bu-accred-badge bu-accred-duplicate" title="<?php echo htmlspecialchars($item_alt); ?>" aria-hidden="true" tabindex="-1">
            <img src="<?php echo $item_img; ?>" alt="<?php echo htmlspecialchars($item_alt); ?>" class="bu-accred-logo" loading="lazy" decoding="async" onerror="this.style.display='none';">
            <span class="bu-accred-badge-name"><?php echo htmlspecialchars($item['name'] ?? ''); ?></span>
            <span class="bu-accred-badge-desc"><?php echo htmlspecialchars($item['desc'] ?? ''); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</section>

<!-- ===== STYLES ===== -->
<style>
.bu-statutory-section {
  background: #FFFFFF;
  padding: 60px 20px 70px 20px;
  width: 100%;
  float: left;
  clear: both;
  box-sizing: border-box;
  overflow: hidden;
  font-family: 'Plus Jakarta Sans', sans-serif;
  border-top: 1px solid #EDEDED;
}
.bu-statutory-container {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
}
.bu-accred-section-label {
  font-size: 11.5px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #D99B00;
  display: block;
  margin-bottom: 8px;
}
.bu-stat-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 34px;
  color: #040F4A;
  margin: 0 0 40px 0;
  font-weight: 700;
}
.bu-stat-title em {
  font-style: italic;
  color: #D99B00;
}

/* Continuous Auto Slider Wrap */
.bu-accred-slider-wrap {
  width: 100%;
  overflow: hidden;
  position: relative;
  mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
  -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
  padding: 10px 0;
}
.bu-accred-track {
  display: flex;
  gap: 24px;
  width: max-content;
  animation: buAccredScroll 32s linear infinite;
}
.bu-accred-track:hover {
  animation-play-state: paused;
}
@keyframes buAccredScroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(calc(-50% - 12px)); }
}

/* Badges */
.bu-accred-badge {
  background: #FFFFFF;
  border: 1px solid #EAEAEA;
  border-radius: 12px;
  padding: 16px 20px;
  min-width: 140px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  flex-shrink: 0;
}
.bu-accred-badge:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(4, 15, 74, 0.08);
  border-color: #D99B00;
  text-decoration: none;
}
.bu-accred-logo {
  height: 48px;
  width: auto;
  max-width: 90px;
  object-fit: contain;
  margin-bottom: 12px;
}
.bu-accred-badge-name {
  font-size: 13.5px;
  font-weight: 800;
  color: #040F4A;
  margin-bottom: 2px;
}
.bu-accred-badge-desc {
  font-size: 11px;
  font-weight: 600;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

@media (max-width: 768px) {
  .bu-statutory-section {
    padding: 45px 15px 50px 15px;
  }
  .bu-stat-title {
    font-size: 26px;
    margin-bottom: 25px;
  }
  .bu-accred-track {
    gap: 16px;
    animation-duration: 22s;
  }
  .bu-accred-badge {
    padding: 12px 16px;
    min-width: 115px;
  }
  .bu-accred-logo {
    height: 38px;
    margin-bottom: 8px;
  }
}
</style>
