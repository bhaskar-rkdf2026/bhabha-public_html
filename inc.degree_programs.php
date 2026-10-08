<?php
// Bhabha University – Programs Offered Section (Dynamic from Database)
global $db;
$db->where('section_key', 'degree_programs');
$deg_sec = $db->getOne('homepage_sections');

if (!$deg_sec || $deg_sec['status'] != 1) {
    return;
}

$deg_heading = !empty($deg_sec['heading']) ? $deg_sec['heading'] : '85+ programs across<br>every degree level.';

// Fetch active courses directly from database table `course`
$all_programs = [];
if (isset($db) && is_object($db)) {
    try {
        $raw_courses = $db->rawQuery("
            SELECT c.*, p.program AS prog_name, d.title AS dept_title 
            FROM course c 
            LEFT JOIN program p ON c.program = p.id 
            LEFT JOIN department d ON c.department = d.id 
            WHERE (c.status = 1 OR c.status IS NULL) 
            ORDER BY c.id ASC
        ");
        
        if (!empty($raw_courses) && is_array($raw_courses)) {
            $prog_id_map = [
                1 => 'doctoral',
                2 => 'postgraduate',
                3 => 'undergraduate',
                4 => 'diploma',
                5 => 'certificate',
                6 => 'integrated'
            ];
            
            foreach ($raw_courses as $rc) {
                $c_name = trim($rc['course']);
                if (empty($c_name)) continue;
                $c_id = (int)$rc['id'];
                $p_id = (int)($rc['program'] ?? 0);
                
                $levels = [];
                if (!empty($prog_id_map[$p_id])) {
                    $levels[] = $prog_id_map[$p_id];
                }
                
                // Cross-tag integrated programs (e.g. B.Sc. B.Ed.)
                if ($p_id === 6 || stripos($c_name, 'bscbed') !== false || stripos($c_name, 'integrated') !== false || stripos($c_name, 'b.sc. b.ed') !== false || stripos($c_name, 'ba.bed') !== false) {
                    if (!in_array('integrated', $levels)) $levels[] = 'integrated';
                }

                // Cross-tag dual diploma/certificate courses
                if (stripos($c_name, 'certificate/diploma') !== false) {
                    if (!in_array('certificate', $levels)) $levels[] = 'certificate';
                    if (!in_array('diploma', $levels)) $levels[] = 'diploma';
                }

                // Title-based fallback if program ID unassigned
                if (empty($levels)) {
                    if (stripos($c_name, 'm.') === 0 || stripos($c_name, 'mba') !== false || stripos($c_name, 'mca') !== false || stripos($c_name, 'm.tech') !== false || stripos($c_name, 'm.pharm') !== false) {
                        $levels[] = 'postgraduate';
                    } elseif (stripos($c_name, 'd.') === 0 || stripos($c_name, 'diploma') !== false) {
                        $levels[] = 'diploma';
                    } else {
                        $levels[] = 'undergraduate';
                    }
                }
                
                // Extract duration and eligibility from details text
                $duration = '';
                $eligibility = '';
                if (!empty($rc['details'])) {
                    $det_text = strip_tags($rc['details']);
                    if (preg_match('/(\d+(?:\.\d+)?\s*(?:years?|yrs?|months?))/i', $det_text, $dur_match)) {
                        $duration = trim($dur_match[1]);
                    }
                    if (preg_match('/eligibility\s*[:\-]?\s*([^,\n\r<]+)/i', $det_text, $elig_match)) {
                        $raw_elig = trim($elig_match[1]);
                        if (
                            strlen($raw_elig) <= 26 &&
                            stripos($raw_elig, 'criteria') === false &&
                            stripos($raw_elig, 'approved') === false &&
                            stripos($raw_elig, 'seats') === false &&
                            stripos($raw_elig, 'department') === false &&
                            stripos($raw_elig, '&') !== 0 &&
                            stripos($raw_elig, 'college') === false &&
                            stripos($raw_elig, 'semesters') === false
                        ) {
                            $eligibility = $raw_elig;
                        }
                    }
                }
                
                // Default durations by level
                if (empty($duration)) {
                    if (in_array('doctoral', $levels)) $duration = '3-5 Years';
                    elseif (in_array('postgraduate', $levels)) $duration = '2 Years';
                    elseif (in_array('integrated', $levels)) $duration = '4 Years';
                    elseif (in_array('diploma', $levels)) $duration = '2-3 Years';
                    elseif (in_array('certificate', $levels)) $duration = '6 Months';
                    else $duration = (stripos($c_name, 'b.tech') !== false || stripos($c_name, 'b.pharm') !== false) ? '4 Years' : '3 Years';
                }
                
                // Default eligibility by level
                if (empty($eligibility)) {
                    if (in_array('doctoral', $levels)) $eligibility = "Master's Degree";
                    elseif (in_array('postgraduate', $levels)) $eligibility = 'Graduation 50%';
                    elseif (in_array('integrated', $levels)) $eligibility = '10+2 50%';
                    elseif (in_array('diploma', $levels)) $eligibility = '10th / 10+2';
                    elseif (in_array('certificate', $levels)) $eligibility = '10+2 Any Stream';
                    else $eligibility = (stripos($c_name, 'b.tech') !== false) ? '10+2 PCM 60%' : ((stripos($c_name, 'b.pharm') !== false) ? '10+2 PCB/PCM' : '10+2 Any Stream');
                }
                
                $disp_title = (strcasecmp($c_name, 'b.tech cse') === 0 || strcasecmp($c_name, 'btech cse') === 0) ? 'B.Tech' : $c_name;
                
                $all_programs[] = [
                    'id'          => $c_id,
                    'title'       => $disp_title,
                    'levels'      => $levels,
                    'duration'    => $duration,
                    'eligibility' => $eligibility,
                    'tag'         => 'FEATURED'
                ];
            }
        }
    } catch (\Throwable $e) {}
}

// Supplement Certificate & Integrated with popular offerings if few exist in DB
$cert_count = count(array_filter($all_programs, function($p) {
    return in_array('certificate', $p['levels'] ?? []);
}));
if ($cert_count < 4) {
    $all_programs = array_merge($all_programs, [
        ['id'=>0, 'title'=>'Certificate in Digital Marketing & AI Tools', 'levels'=>['certificate'], 'duration'=>'6 Months', 'eligibility'=>'10+2 Any Stream', 'tag'=>'TRENDING'],
        ['id'=>0, 'title'=>'Certificate in Cyber Security & Ethical Hacking', 'levels'=>['certificate'], 'duration'=>'6 Months', 'eligibility'=>'10+2 / IT Interest', 'tag'=>'FEATURED'],
        ['id'=>0, 'title'=>'Certificate in Full Stack Web Development', 'levels'=>['certificate'], 'duration'=>'6 Months', 'eligibility'=>'10+2 / BCA / B.Tech', 'tag'=>'FEATURED'],
        ['id'=>0, 'title'=>'Certificate in Dental Assistant & Oral Hygiene', 'levels'=>['certificate'], 'duration'=>'6 Months', 'eligibility'=>'10+2 PCB / Any', 'tag'=>'POPULAR'],
    ]);
}

$integ_count = count(array_filter($all_programs, function($p) {
    return in_array('integrated', $p['levels'] ?? []);
}));
if ($integ_count < 2) {
    $all_programs = array_merge([
        ['id'=>17, 'title'=>'BA B.Ed.', 'levels'=>['integrated'], 'duration'=>'4 Years', 'eligibility'=>'10+2 Any Stream 50%', 'tag'=>'POPULAR'],
    ], $all_programs);
}

// Fallback to extra_data from homepage_sections if course table is empty
if (empty($all_programs)) {
    $deg_extra = !empty($deg_sec['extra_data']) ? json_decode($deg_sec['extra_data'], true) : [];
    $all_programs = $deg_extra['programs'] ?? [];
}

$tab_categories = [
    'undergraduate' => 'UNDERGRADUATE',
    'postgraduate'  => 'POSTGRADUATE',
    'integrated'    => 'INTEGRATED',
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
        $tab_items = array_values(array_filter($all_programs, function($p) use ($tab_key) {
            if (!empty($p['levels']) && is_array($p['levels'])) {
                return in_array($tab_key, $p['levels']);
            }
            return isset($p['level']) && strtolower(trim($p['level'])) === strtolower($tab_key);
        }));
        
        $total_tab_count = count($tab_items);
        // Limit to 8 cards per tab on homepage
        $display_items = array_slice($tab_items, 0, 8);
      ?>
        <!-- ============ <?php echo strtoupper($tab_key); ?> GRID ============ -->
        <div class="bu-deg-grid <?php echo ($g_idx === 1) ? 'active' : ''; ?>" id="<?php echo $tab_key; ?>">
          <?php if (!empty($display_items)): ?>
            <?php foreach ($display_items as $item): 
              $c_id = !empty($item['id']) ? (int)$item['id'] : 0;
              $tab_item_url = $c_id ? href('eligibility.php', 'id=' . $c_id) : href('programmes.php', 'type=' . $tab_key);
            ?>
              <div class="bu-deg-card" onclick="window.location.href='<?php echo $tab_item_url; ?>';" style="cursor:pointer;" title="Click to view details">
                <div class="bu-deg-card-top">
                  <span class="bu-deg-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                      <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                  </span>
                  <span class="bu-deg-card-tag"><?php echo htmlspecialchars($item['tag'] ?? 'FEATURED'); ?></span>
                </div>
                <h3 class="bu-deg-card-title">
                  <a href="<?php echo $tab_item_url; ?>" style="color:inherit;text-decoration:none;">
                    <?php echo htmlspecialchars($item['title'] ?? ''); ?>
                  </a>
                </h3>
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
        Explore All Academic Programmes &nbsp;→
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
  max-width: 65% !important;
  white-space: nowrap !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
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
