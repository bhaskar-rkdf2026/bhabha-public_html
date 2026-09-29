<?php
// Bhabha University — Campus Life & Infrastructure (Dynamic from Database)
global $db;
$db->where('section_key', 'campus_life');
$cl_sec = $db->getOne('homepage_sections');

if (!$cl_sec || $cl_sec['status'] != 1) {
    return;
}

$cl_label = !empty($cl_sec['title']) ? $cl_sec['title'] : 'CAMPUS LIFE & INFRASTRUCTURE';
$cl_heading = !empty($cl_sec['heading']) ? $cl_sec['heading'] : 'World-class <em>facilities &amp; environment.</em>';
$cl_desc = !empty($cl_sec['subheading']) ? $cl_sec['subheading'] : 'A 32-acre expansive green ecosystem equipped with advanced academic infrastructure, renewable research facilities, live media broadcasting studios, and modern simulation laboratories.';

$cl_extra = !empty($cl_sec['extra_data']) ? json_decode($cl_sec['extra_data'], true) : [];
$cl_cards = $cl_extra['cards'] ?? [];

function bu_resolve_cl_img($img) {
    if (empty($img)) return URL_ROOT . 'images/library.jpg';
    if (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0) return $img;
    return URL_ROOT . ltrim($img, '/');
}
?>
<!-- =================== CAMPUS LIFE & INFRASTRUCTURE SECTION =================== -->
<section class="bu-campus-life-section">
  <div class="bu-campus-life-container">
    <div class="bu-campus-life-header">
      <span class="bu-campus-sec-label"><?php echo htmlspecialchars($cl_label); ?></span>
      <h2 class="bu-campus-sec-title"><?php echo $cl_heading; ?></h2>
      <p class="bu-campus-sec-desc"><?php echo htmlspecialchars($cl_desc); ?></p>
    </div>

    <div class="bu-campus-facilities-grid">
      <?php foreach ($cl_cards as $card): 
        $c_link = !empty($card['link']) ? (strpos($card['link'], 'http') === 0 ? $card['link'] : URL_ROOT . ltrim($card['link'], '/')) : href('infrastructure.php');
        $c_img = bu_resolve_cl_img($card['image'] ?? '');
        $c_icon = !empty($card['icon']) ? $card['icon'] : 'fa fa-star';
      ?>
        <a href="<?php echo $c_link; ?>" class="bu-campus-facility-card">
          <div class="bu-campus-facility-img-wrap">
            <img loading="lazy" decoding="async" src="<?php echo $c_img; ?>" alt="<?php echo htmlspecialchars($card['title'] ?? ''); ?>" class="bu-campus-facility-img" onerror="this.src='<?php echo URL_ROOT;?>extra-images/col-3-thum5.jpg';">
            <span class="bu-campus-facility-badge"><i class="<?php echo htmlspecialchars($c_icon); ?>"></i> <?php echo htmlspecialchars($card['badge'] ?? ''); ?></span>
          </div>
          <div class="bu-campus-facility-info">
            <h4><?php echo htmlspecialchars($card['title'] ?? ''); ?></h4>
            <p><?php echo htmlspecialchars($card['desc'] ?? ''); ?></p>
            <span class="bu-campus-card-link">Explore Facility <i class="fa fa-arrow-right"></i></span>
          </div>
        </a>
      <?php endforeach; ?>
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
  display: block !important;
  margin-bottom: 8px !important;
}

.bu-campus-sec-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.5vw, 42px) !important;
  font-weight: 700 !important;
  color: #040F4A !important;
  line-height: 1.2 !important;
  margin: 0 0 14px 0 !important;
}

.bu-campus-sec-title em {
  font-style: italic !important;
  color: #D99B00 !important;
}

.bu-campus-sec-desc {
  font-size: 14.5px !important;
  line-height: 1.65 !important;
  color: #555555 !important;
  max-width: 680px !important;
  margin: 0 auto !important;
}

.bu-campus-facilities-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 22px !important;
}

.bu-campus-facility-card {
  background: #FFFFFF !important;
  border: 1px solid #EDEDED !important;
  border-radius: 12px !important;
  overflow: hidden !important;
  display: flex !important;
  flex-direction: column !important;
  text-decoration: none !important;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
  box-shadow: 0 4px 14px rgba(4, 15, 74, 0.04) !important;
}

.bu-campus-facility-card:hover {
  transform: translateY(-6px) !important;
  box-shadow: 0 14px 30px rgba(4, 15, 74, 0.12) !important;
  border-color: #D99B00 !important;
  text-decoration: none !important;
}

.bu-campus-facility-img-wrap {
  position: relative !important;
  width: 100% !important;
  height: 180px !important;
  overflow: hidden !important;
}

.bu-campus-facility-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block !important;
  transition: transform 0.45s ease !important;
}

.bu-campus-facility-card:hover .bu-campus-facility-img {
  transform: scale(1.06) !important;
}

.bu-campus-facility-badge {
  position: absolute !important;
  top: 12px !important;
  left: 12px !important;
  background: rgba(4, 15, 74, 0.85) !important;
  backdrop-filter: blur(4px) !important;
  color: #FFC107 !important;
  font-size: 10.5px !important;
  font-weight: 700 !important;
  padding: 4px 10px !important;
  border-radius: 20px !important;
  letter-spacing: 0.5px !important;
  display: flex !important;
  align-items: center !important;
  gap: 5px !important;
}

.bu-campus-facility-info {
  padding: 18px 18px 20px !important;
  display: flex !important;
  flex-direction: column !important;
  flex-grow: 1 !important;
  justify-content: space-between !important;
}

.bu-campus-facility-info h4 {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 18px !important;
  font-weight: 700 !important;
  color: #040F4A !important;
  margin: 0 0 8px 0 !important;
  line-height: 1.3 !important;
  transition: color 0.2s !important;
}

.bu-campus-facility-card:hover .bu-campus-facility-info h4 {
  color: #D99B00 !important;
}

.bu-campus-facility-info p {
  font-size: 12.5px !important;
  color: #666666 !important;
  line-height: 1.55 !important;
  margin: 0 0 16px 0 !important;
}

.bu-campus-card-link {
  font-size: 12px !important;
  font-weight: 700 !important;
  color: #040F4A !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  margin-top: auto !important;
  transition: all 0.2s !important;
}

.bu-campus-facility-card:hover .bu-campus-card-link {
  color: #D99B00 !important;
  transform: translateX(4px) !important;
}

@media (max-width: 991px) {
  .bu-campus-facilities-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 18px !important;
  }
}

@media (max-width: 575px) {
  .bu-campus-life-section {
    padding: 50px 16px !important;
  }
  .bu-campus-facilities-grid {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
  .bu-campus-facility-img-wrap {
    height: 160px !important;
  }
}
</style>
