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
$why_intro = !empty($why_sec['subheading']) ? $why_sec['subheading'] : "From academic excellence to ecosystem — every dimension of the Bhabha experience is \n          engineered for academic depth, global mobility and lifelong opportunity.";

$default_features = [
    ['icon' => 'fa fa-certificate', 'title' => 'UGC Recognised', 'desc' => 'UGC recognised under Section 2(f) with approvals from AICTE, PCI, BCI, DCI, NCTE.', 'url' => 'approvals.php'],
    ['icon' => 'fa fa-flask', 'title' => 'Research Excellence', 'desc' => '120+ research labs, 250+ patents and 2,500+ publications.', 'url' => 'research.php'],
    ['icon' => 'fa fa-globe', 'title' => 'Global Collaborations', 'desc' => 'MoUs with 60+ international universities across 4 continents.', 'url' => 'page.php?id=9'],
    ['icon' => 'fa fa-mortar-board', 'title' => 'Outstanding Placements', 'desc' => '98% placement rate with 300+ recruiters and packages up to ₹60 LPA.', 'url' => 'placements.php'],
    ['icon' => 'fa fa-building-o', 'title' => 'Smart Campus', 'desc' => '32-acre wifi-enabled green campus with smart classrooms.', 'url' => 'infrastructure.php'],
    ['icon' => 'fa fa-rocket', 'title' => 'Innovation Ecosystem', 'desc' => 'Incubation centre, student startups and industry mentoring.', 'url' => 'research.php#incubation-edc']
];

$why_extra = !empty($why_sec['extra_data']) ? json_decode($why_sec['extra_data'], true) : [];
$why_features = !empty($why_extra['features']) ? $why_extra['features'] : $default_features;

// Helper to resolve card redirect URL
if (!function_exists('bu_resolve_feature_url')) {
    function bu_resolve_feature_url($feature, $index = 0) {
        $rawUrl = trim($feature['url'] ?? '');
        $title = trim($feature['title'] ?? '');

        // If no explicit URL is stored, match based on title or fallback to default
        if (empty($rawUrl)) {
            if (stripos($title, 'UGC') !== false || stripos($title, 'Recognis') !== false || stripos($title, 'Accredit') !== false || stripos($title, 'Approval') !== false) {
                $rawUrl = 'approvals.php';
            } elseif (stripos($title, 'Research') !== false || stripos($title, 'Patent') !== false || stripos($title, 'Publication') !== false) {
                $rawUrl = 'research.php';
            } elseif (stripos($title, 'Global') !== false || stripos($title, 'Collaboration') !== false || stripos($title, 'MoU') !== false || stripos($title, 'International') !== false) {
                $rawUrl = 'page.php?id=9';
            } elseif (stripos($title, 'Placement') !== false || stripos($title, 'Recruiter') !== false || stripos($title, 'Package') !== false) {
                $rawUrl = 'placements.php';
            } elseif (stripos($title, 'Campus') !== false || stripos($title, 'Smart') !== false || stripos($title, 'Infrastruct') !== false || stripos($title, 'Classroom') !== false) {
                $rawUrl = 'infrastructure.php';
            } elseif (stripos($title, 'Innovation') !== false || stripos($title, 'Incubat') !== false || stripos($title, 'Startup') !== false || stripos($title, 'Ecosystem') !== false) {
                $rawUrl = 'research.php#incubation-edc';
            } else {
                $defaults = ['approvals.php', 'research.php', 'page.php?id=9', 'placements.php', 'infrastructure.php', 'research.php#incubation-edc'];
                $rawUrl = $defaults[$index] ?? '#';
            }
        }

        if (empty($rawUrl) || $rawUrl === '#') {
            return '#';
        }

        // Check if already an absolute URL or anchor
        if (strpos($rawUrl, 'http://') === 0 || strpos($rawUrl, 'https://') === 0 || strpos($rawUrl, '//') === 0) {
            return $rawUrl;
        }

        // Process internal relative URLs
        $hash = '';
        if (strpos($rawUrl, '#') !== false) {
            $parts = explode('#', $rawUrl, 2);
            $rawUrl = $parts[0];
            $hash = '#' . $parts[1];
        }

        if (strpos($rawUrl, '.php') !== false) {
            if (strpos($rawUrl, '?') !== false) {
                $paramParts = explode('?', $rawUrl, 2);
                $page = $paramParts[0];
                $param = $paramParts[1];
                return function_exists('href') ? href($page, $param) . $hash : $page . '?' . $param . $hash;
            } else {
                return function_exists('href') ? href($rawUrl) . $hash : $rawUrl . $hash;
            }
        }

        return (defined('URL_ROOT') ? URL_ROOT : '') . ltrim($rawUrl, '/') . $hash;
    }
}
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
      <?php foreach ($why_features as $idx => $feature): 
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
        $cardTargetUrl = bu_resolve_feature_url($feature, $idx);
      ?>
        <a href="<?php echo htmlspecialchars($cardTargetUrl); ?>" class="bu-why-item" title="Explore <?php echo htmlspecialchars($feature['title']); ?>">
          <div class="bu-why-icon-row">
            <div class="bu-why-icon"><i class="<?php echo htmlspecialchars($iconClass); ?>"></i></div>
            <div class="bu-why-arrow-indicator"><i class="fa fa-arrow-right"></i></div>
          </div>
          <h3 class="bu-why-title"><?php echo htmlspecialchars($feature['title']); ?></h3>
          <p class="bu-why-desc"><?php echo htmlspecialchars($feature['desc']); ?></p>
          <div class="bu-why-link-cta">
            <span>Explore Details</span>
            <i class="fa fa-angle-right"></i>
          </div>
        </a>
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
  transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1) !important;
  cursor: pointer !important;
  box-sizing: border-box !important;
  text-decoration: none !important;
  color: inherit !important;
}
.bu-why-item:nth-child(3n) {
  border-right: none !important;
}
.bu-why-item:nth-child(n+4) {
  border-bottom: none !important;
}
.bu-why-item:hover,
.bu-why-item:focus {
  background: rgba(255, 255, 255, 0.12) !important;
  backdrop-filter: blur(10px) !important;
  -webkit-backdrop-filter: blur(10px) !important;
  box-shadow: 0 14px 35px rgba(0, 0, 0, 0.3) !important;
  border-radius: 0 !important;
  z-index: 2 !important;
  text-decoration: none !important;
  transform: translateY(-2px);
}

.bu-why-icon-row {
  width: 100% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  margin-bottom: 20px !important;
}
.bu-why-icon {
  font-size: 26px !important;
  color: #FFC107 !important;
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
  transform: scale(1.12) !important;
}

.bu-why-arrow-indicator {
  width: 32px !important;
  height: 32px !important;
  border-radius: 50% !important;
  background: rgba(255, 255, 255, 0.08) !important;
  color: #FFC107 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 13px !important;
  opacity: 0.5 !important;
  transform: translateX(-4px) !important;
  transition: all 0.3s ease !important;
}
.bu-why-item:hover .bu-why-arrow-indicator {
  opacity: 1 !important;
  background: #FFC107 !important;
  color: #061D7C !important;
  transform: translateX(0) !important;
}

.bu-why-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 0 12px 0 !important;
  line-height: 1.3 !important;
  transition: color 0.3s ease !important;
}
.bu-why-item:hover .bu-why-title {
  color: #FFFFFF !important;
}

.bu-why-desc {
  font-size: 14px !important;
  line-height: 1.65 !important;
  color: rgba(255, 255, 255, 0.68) !important;
  margin: 0 0 16px 0 !important;
  flex: 1 !important;
}

.bu-why-link-cta {
  font-size: 13px !important;
  font-weight: 700 !important;
  color: #FFC107 !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
  opacity: 0.85 !important;
  transition: all 0.3s ease !important;
  margin-top: auto !important;
}
.bu-why-link-cta i {
  font-size: 15px !important;
  transition: transform 0.3s ease !important;
}
.bu-why-item:hover .bu-why-link-cta {
  opacity: 1 !important;
  color: #FFD54F !important;
}
.bu-why-item:hover .bu-why-link-cta i {
  transform: translateX(4px) !important;
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
    gap: 0 !important;
  }
  .bu-why-item {
    border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding: 30px 24px !important;
  }
  .bu-why-item:nth-child(2n) {
    border-right: none !important;
  }
  .bu-why-item:nth-child(n+5) {
    border-bottom: none !important;
  }
}
@media (max-width: 575px) {
  .bu-why-section {
    padding: 60px 16px !important;
  }
  .bu-why-grid {
    grid-template-columns: 1fr !important;
    gap: 0 !important;
  }
  .bu-why-item {
    border-right: none !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    padding: 24px 16px !important;
  }
  .bu-why-item:last-child {
    border-bottom: none !important;
  }
  .bu-why-title {
    font-size: 19px !important;
  }
}
</style>
