<?php
// Bhabha University – Programs Offered Section (Dynamic from Database)
global $db;
$db->where('section_key', 'degree_programs');
$deg_sec = $db->getOne('homepage_sections');

if (!$deg_sec || $deg_sec['status'] != 1) {
    return;
}

$deg_heading = !empty($deg_sec['heading']) ? $deg_sec['heading'] : '85+ programs across<br>every degree level.';
$deg_extra = !empty($deg_sec['extra_data']) ? json_decode($deg_sec['extra_data'], true) : [];
$all_programs = $deg_extra['programs'] ?? [];

$cert_count = count(array_filter($all_programs, function($p) {
    return (!empty($p['levels']) && in_array('certificate', $p['levels'])) || ($p['level'] ?? '') === 'certificate';
}));

if ($cert_count === 0) {
    $all_programs = array_merge($all_programs, [
        ['title'=>'Hotel Management Diploma/Certificate', 'levels'=>['diploma','certificate'], 'level'=>'certificate', 'duration'=>'6 Mo / 1 yr', 'eligibility'=>'10+2 Any Stream', 'tag'=>'FEATURED'],
        ['title'=>'Media certificate/diploma Courses', 'levels'=>['diploma','certificate'], 'level'=>'certificate', 'duration'=>'6 Mo / 1 yr', 'eligibility'=>'10+2 Any Stream', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Digital Marketing & AI Tools', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 Any Stream', 'tag'=>'TRENDING'],
        ['title'=>'Certificate in Cyber Security & Ethical Hacking', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 / IT Interest', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Full Stack Web Development', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 / BCA / B.Tech', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Data Science & Machine Learning', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 with Math / Grad', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Dental Assistant & Oral Hygiene', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 PCB / Any', 'tag'=>'POPULAR'],
        ['title'=>'Certificate in Hospital Administration', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'Graduation / 10+2', 'tag'=>'POPULAR'],
    ]);
}

$tab_categories = [
    'undergraduate' => 'UNDERGRADUATE',
    'postgraduate'  => 'POSTGRADUATE',
    'diploma'       => 'DIPLOMA',
    'doctoral'      => 'DOCTORAL',
    'certificate'   => 'CERTIFICATE'
];
?>
<section class="bu-deg-programs-section">
  <div class="bu-deg-container">
    
    <!-- Top Header -->
    <div class="bu-deg-header">
      <div class="bu-deg-header-left">
        <h2 class="bu-deg-heading"><?php echo $deg_heading; ?></h2>
      </div>
      
      <!-- Interactive Degree Tabs -->
      <div class="bu-deg-tabs-wrapper">
        <?php 
        $t_idx = 0;
        foreach ($tab_categories as $tab_key => $tab_label): 
          $t_idx++;
        ?>
          <button class="bu-deg-tab <?php echo ($t_idx === 1) ? 'active' : ''; ?>" data-tab="<?php echo $tab_key; ?>"><?php echo $tab_label; ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Interactive Grids -->
    <div class="bu-deg-grids-container">
      
      <?php 
      $g_idx = 0;
      foreach ($tab_categories as $tab_key => $tab_label): 
        $g_idx++;
        // Filter programs for this tab
        $tab_items = array_filter($all_programs, function($p) use ($tab_key) {
            if (!empty($p['levels']) && is_array($p['levels'])) {
                return in_array($tab_key, $p['levels']);
            }
            return isset($p['level']) && strtolower(trim($p['level'])) === strtolower($tab_key);
        });
      ?>
        <!-- ============ <?php echo strtoupper($tab_key); ?> GRID ============ -->
        <div class="bu-deg-grid <?php echo ($g_idx === 1) ? 'active' : ''; ?>" id="<?php echo $tab_key; ?>">
          <?php if (!empty($tab_items)): ?>
            <?php foreach ($tab_items as $item): ?>
              <div class="bu-deg-card">
                <div class="bu-deg-card-top">
                  <span class="bu-deg-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                      <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                  </span>
                  <span class="bu-deg-card-tag"><?php echo htmlspecialchars($item['tag'] ?? 'FEATURED'); ?></span>
                </div>
                <h3 class="bu-deg-card-title"><?php echo htmlspecialchars($item['title'] ?? ''); ?></h3>
                <div class="bu-deg-card-details">
                  <div class="bu-detail-row"><span>Duration</span><strong><?php echo htmlspecialchars($item['duration'] ?? ''); ?></strong></div>
                  <div class="bu-detail-row"><span>Eligibility</span><strong><?php echo htmlspecialchars($item['eligibility'] ?? ''); ?></strong></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted" style="grid-column: 1 / -1; padding: 20px 0;">Programs will be updated shortly.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

    </div>

    <!-- View All Programmes Link -->
    <div style="text-align: center; margin-top: 40px;">
      <a href="<?php echo href('programmes.php'); ?>" class="bu-deg-view-all-btn">
        Explore All 85+ Academic Programmes &nbsp;→
      </a>
    </div>

  </div>
</section>

<!-- ===== PROGRAMS OFFERED HOVER & BLUR STYLES ===== -->
<style>
.bu-deg-programs-section {
  background-color: #FAF7F2 !important; /* Soft warm light beige / cream */
  padding: 80px 24px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
  box-sizing: border-box !important;
}
.bu-deg-container {
  max-width: 1240px !important;
  margin: 0 auto !important;
}

/* Header layout */
.bu-deg-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 45px !important;
  gap: 30px !important;
}
.bu-deg-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 3.6vw, 44px) !important;
  font-weight: 700 !important;
  color: #0B2545 !important; /* Elegant Navy Blue */
  line-height: 1.18 !important;
  margin: 0 !important;
  letter-spacing: -0.5px !important;
}

/* Tabs right aligned */
.bu-deg-tabs-wrapper {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: wrap !important;
  align-items: center !important;
  justify-content: flex-end !important;
  gap: 6px !important;
}

/* Tab buttons */
.bu-deg-tab {
  background-color: transparent !important;
  border: 1px solid #D5D0C7 !important;
  color: #0B2545 !important;
  font-size: 10.5px !important;
  font-weight: 700 !important;
  letter-spacing: 0.5px !important;
  padding: 8px 14px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
  outline: none !important;
  border-radius: 2px !important;
  text-transform: uppercase !important;
  display: inline-block !important;
  white-space: nowrap !important;
}
.bu-deg-tab:hover {
  background-color: rgba(11, 37, 69, 0.04) !important;
  border-color: #0B2545 !important;
}
.bu-deg-tab.active {
  background-color: #0B2545 !important;
  border-color: #0B2545 !important;
  color: #FFFFFF !important;
  font-weight: 800 !important;
}

/* Grids */
.bu-deg-grids-container {
  width: 100% !important;
  min-height: 380px !important;
}
.bu-deg-grid {
  display: none !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 20px !important;
}
.bu-deg-grid.active {
  display: grid !important;
}

/* ============================================================
   UNIFORM CARD BASE STYLES (Clean Off-White State)
   ============================================================ */
.bu-deg-card {
  background-color: #FAF8F5 !important;
  border: 1px solid #EBE6DE !important;
  border-radius: 4px !important;
  padding: 24px 22px 26px 22px !important;
  display: flex !important;
  flex-direction: column !important;
  justify-content: space-between !important;
  transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
  box-sizing: border-box !important;
  cursor: pointer !important;
  position: relative !important;
}

/* Card Top Bar */
.bu-deg-card-top {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  margin-bottom: 22px !important;
}
.bu-deg-card-icon {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
}
.bu-deg-card-icon svg {
  stroke: #D99B00 !important;
  transition: stroke 0.35s ease !important;
}
.bu-deg-card-tag {
  font-size: 9px !important;
  font-weight: 800 !important;
  letter-spacing: 1.5px !important;
  color: #D99B00 !important; /* Golden Amber */
  text-transform: uppercase !important;
  transition: color 0.35s ease !important;
}

/* Card Titles */
.bu-deg-card-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 22px !important;
  font-weight: 700 !important;
  color: #0B2545 !important;
  margin: 0 0 24px 0 !important;
  line-height: 1.25 !important;
  transition: color 0.35s ease !important;
}

/* Details list */
.bu-deg-card-details {
  display: flex !important;
  flex-direction: column !important;
  gap: 10px !important;
  width: 100% !important;
  margin-top: auto !important;
}
.bu-detail-row {
  display: flex !important;
  justify-content: space-between !important;
  align-items: baseline !important;
  font-size: 12.5px !important;
}
.bu-detail-row span {
  color: #8E98A8 !important;
  font-weight: 500 !important;
  transition: color 0.35s ease !important;
}
.bu-detail-row strong {
  color: #0B2545 !important;
  font-weight: 700 !important;
  text-align: right !important;
  transition: color 0.35s ease !important;
}

/* ============================================================
   CARD HOVER EFFECT: DARK BLUE BG + SOFT BLUR & GLOW SHADOW
   ============================================================ */
.bu-deg-card:hover {
  background-color: #0B2545 !important; /* Dark Navy Blue fill on Hover */
  border-color: #0B2545 !important;
  transform: translateY(-6px) scale(1.015) !important;
  box-shadow: 0 16px 36px rgba(11, 37, 69, 0.28) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
}

.bu-deg-card:hover .bu-deg-card-title {
  color: #FFFFFF !important; /* White title on hover */
}
.bu-deg-card:hover .bu-deg-card-icon svg {
  stroke: #EAB308 !important; /* Bright Gold Icon on hover */
}
.bu-deg-card:hover .bu-deg-card-tag {
  color: #EAB308 !important; /* Bright Gold Tag on hover */
}
.bu-deg-card:hover .bu-detail-row span {
  color: #94A3B8 !important; /* Muted Light Blue/Grey Label on hover */
}
.bu-deg-card:hover .bu-detail-row strong {
  color: #FFFFFF !important; /* Pure White Value on hover */
}

/* Mobile & Tablet Responsive */
@media (max-width: 1100px) {
  .bu-deg-grid {
    grid-template-columns: repeat(3, 1fr) !important;
  }
}
@media (max-width: 900px) {
  .bu-deg-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 20px !important;
    margin-bottom: 30px !important;
  }
  .bu-deg-tabs-wrapper {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch !important;
    width: 100% !important;
    justify-content: flex-start !important;
    padding: 4px 2px 10px 2px !important;
    gap: 8px !important;
    scrollbar-width: none !important;
  }
  .bu-deg-tabs-wrapper::-webkit-scrollbar {
    display: none !important;
  }
  .bu-deg-tab {
    flex-shrink: 0 !important;
    border-radius: 20px !important;
    padding: 8px 16px !important;
    font-size: 11px !important;
  }
  .bu-deg-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
  }
  .bu-deg-programs-section {
    padding: 55px 18px !important;
  }
}
@media (max-width: 580px) {
  .bu-deg-heading {
    font-size: clamp(24px, 7vw, 32px) !important;
    line-height: 1.22 !important;
  }
  .bu-deg-programs-section {
    padding: 45px 16px !important;
  }
  .bu-deg-grid {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
  .bu-deg-card {
    padding: 24px 20px !important;
    border-radius: 12px !important;
  }
  .bu-deg-card-title {
    font-size: 20px !important;
  }
.bu-deg-view-all-btn {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  background: #0B2545 !important;
  color: #FFC107 !important;
  font-size: 13.5px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.8px !important;
  padding: 14px 34px !important;
  border-radius: 50px !important;
  border: 2px solid #0B2545 !important;
  text-decoration: none !important;
  transition: all 0.3s ease !important;
  box-shadow: 0 8px 24px rgba(11, 37, 69, 0.2) !important;
}
.bu-deg-view-all-btn:hover {
  background: #FFC107 !important;
  border-color: #FFC107 !important;
  color: #0B2545 !important;
  text-decoration: none !important;
  transform: translateY(-3px) !important;
  box-shadow: 0 12px 30px rgba(255, 193, 7, 0.35) !important;
}
</style>

<!-- ===== INTERACTIVE TABS SCRIPT ===== -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.bu-deg-tab');
    var grids = document.querySelectorAll('.bu-deg-grid');
    
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var targetTab = tab.getAttribute('data-tab');
        
        // Remove active class from all tabs
        tabs.forEach(function (t) { t.classList.remove('active'); });
        // Add active class to clicked tab
        tab.classList.add('active');
        
        // Hide all grids
        grids.forEach(function (grid) { grid.classList.remove('active'); });
        // Show matching grid
        var matchingGrid = document.getElementById(targetTab);
        if (matchingGrid) {
          matchingGrid.classList.add('active');
        }
      });
    });
  });
})();
</script>
