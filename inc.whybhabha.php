<?php
// Bhabha University – Why Bhabha section (Exact Design Match)
$why_sec = null;
if (isset($db) && is_object($db)) {
    $db->where('section_key', 'why_bhabha');
    $why_sec = $db->getOne('homepage_sections');
}
if ($why_sec && isset($why_sec['status']) && $why_sec['status'] == 0) {
    return; // Section disabled from Admin
}

$why_label = !empty($why_sec['title']) ? $why_sec['title'] : 'WHY BHABHA';
$why_heading = !empty($why_sec['heading']) ? $why_sec['heading'] : "A university built<br>\n          for <em>impact.</em>";
$why_intro = !empty($why_sec['subheading']) ? $why_sec['subheading'] : "From accreditation to ecosystem — every dimension of the Bhabha experience is \n          engineered for academic depth, global mobility and lifelong opportunity.";

$why_extra = !empty($why_sec['extra_data']) ? json_decode($why_sec['extra_data'], true) : [];
$why_features = !empty($why_extra['features']) ? $why_extra['features'] : [
    ['icon' => 'fa fa-certificate', 'title' => 'NAAC & UGC Recognised', 'desc' => 'Accredited by NAAC; UGC recognised under 2(f) & 12(B).'],
    ['icon' => 'fa fa-flask', 'title' => 'Research Excellence', 'desc' => '120+ research labs, 250+ patents and 1,200+ publications.'],
    ['icon' => 'fa fa-globe', 'title' => 'Global Collaborations', 'desc' => 'MoUs with 60+ international universities across 4 continents.'],
    ['icon' => 'fa fa-mortar-board', 'title' => 'Outstanding Placements', 'desc' => '98% placement rate with 500+ recruiters and packages up to ₹52 LPA.'],
    ['icon' => 'fa fa-building-o', 'title' => 'Smart Campus', 'desc' => '150-acre wifi-enabled green campus with smart classrooms.'],
    ['icon' => 'fa fa-rocket', 'title' => 'Innovation Ecosystem', 'desc' => 'Incubation centre, student startups and industry mentoring.']
];
?>
<section class="bu-why-section">
  <div class="bu-why-container">
    
    <!-- Top Header Row -->
    <div class="bu-why-header">
      <div class="bu-why-header-left">
        <span class="bu-why-label"><?php echo htmlspecialchars($why_label); ?></span>
        <h2 class="bu-why-heading">
          <?php echo $why_heading; ?>
        </h2>
      </div>
      <div class="bu-why-header-right">
        <p class="bu-why-intro">
          <?php echo nl2br(htmlspecialchars($why_intro)); ?>
        </p>
      </div>
    </div>
    
    <!-- Features Grid -->
    <div class="bu-why-grid">
      <?php foreach ($why_features as $feature): 
        $rawIcon = trim($feature['icon'] ?? '');
        if (!empty($rawIcon)) {
            if (strpos($rawIcon, 'fa ') !== 0 && strpos($rawIcon, 'fas ') !== 0 && strpos($rawIcon, 'far ') !== 0 && strpos($rawIcon, 'fab ') !== 0) {
                $iconClass = 'fa ' . (strpos($rawIcon, 'fa-') === 0 ? $rawIcon : 'fa-' . $rawIcon);
            } else {
                $iconClass = $rawIcon;
            }
        } else {
            $iconClass = 'fa fa-certificate';
        }
      ?>
        <div class="bu-why-item">
          <div class="bu-why-icon"><i class="<?php echo htmlspecialchars($iconClass); ?>"></i></div>
          <h3 class="bu-why-title"><?php echo htmlspecialchars($feature['title']); ?></h3>
          <p class="bu-why-desc"><?php echo htmlspecialchars($feature['desc']); ?></p>
        </div>
      <?php endforeach; ?>
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
  gap: 0 !important;
  position: relative !important;
}
.bu-why-item {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  position: relative !important;
  padding: 40px 36px !important;
  border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  background: transparent !important;
  transition: all 0.3s ease !important;
  cursor: pointer;
  box-sizing: border-box !important;
}
.bu-why-item:nth-child(3n) {
  border-right: none !important;
}
.bu-why-item:nth-child(n+4) {
  border-bottom: none !important;
}
.bu-why-item:hover {
  background: rgba(255, 255, 255, 0.12) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  box-shadow: 0 14px 35px rgba(0, 0, 0, 0.25) !important;
  border-radius: 0 !important;
  z-index: 2 !important;
}
.bu-why-icon {
  font-size: 26px !important;
  color: #FFC107 !important;
  margin-bottom: 20px !important;
  height: 36px !important;
  display: flex !important;
  align-items: center !important;
  transition: transform 0.3s ease !important;
}
.bu-why-icon i,
.bu-why-icon .fa {
  font-family: 'FontAwesome' !important;
  font-style: normal !important;
  font-weight: normal !important;
  line-height: 1 !important;
  display: inline-block !important;
  -webkit-font-smoothing: antialiased !important;
  -moz-osx-font-smoothing: grayscale !important;
}
.bu-why-item:hover .bu-why-icon {
  transform: scale(1.15) !important;
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
