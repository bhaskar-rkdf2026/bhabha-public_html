<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>All Academic Programs &amp; Degrees - Bhabha University Bhopal</title>
<meta name="description" content="Explore all 200+ undergraduate, postgraduate, diploma, doctoral &amp; certificate programs offered at Bhabha University Bhopal. Filter by degree level and search courses easily.">
<?php include('inc.meta.php'); ?>

<style>
.bu-all-prog-page {
  background-color: #F8FAFC !important;
  padding: 60px 0 100px 0 !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  display: block !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
}
.bu-all-prog-container {
  max-width: 1170px !important;
  margin: 0 auto !important;
  padding: 0 20px !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

/* Search & Filter Header */
.bu-prog-filter-bar {
  background: #FFFFFF;
  border: none;
  border-radius: 16px;
  padding: 28px 32px;
  margin-bottom: 40px;
  box-shadow: 0 10px 35px rgba(10, 27, 84, 0.05);
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.bu-prog-search-box {
  position: relative;
  width: 100%;
}
.bu-prog-search-box input {
  width: 100%;
  padding: 16px 20px 16px 52px;
  border: 1px solid #E2E8F0;
  border-radius: 50px;
  font-size: 15px;
  font-weight: 500;
  color: #0A1B54;
  outline: none;
  background: #F8FAFC;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-prog-search-box input:focus {
  background: #FFFFFF;
  border-color: #0A1B54;
  box-shadow: 0 0 0 4px rgba(10, 27, 84, 0.08);
}
.bu-prog-search-icon {
  position: absolute;
  left: 22px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 18px;
}

/* Category Tabs */
.bu-prog-tabs-row {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
.bu-prog-tab-btn {
  background: #F1F5F9;
  border: none;
  color: #475569;
  font-size: 12.5px;
  font-weight: 700;
  padding: 10px 22px;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.25s ease;
  outline: none;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-prog-tab-btn:hover {
  background: #E2E8F0;
  color: #0A1B54;
}
.bu-prog-tab-btn.active {
  background: #0A1B54;
  color: #FFC107;
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.2);
}

/* Results Count */
.bu-prog-results-count {
  font-size: 14px;
  font-weight: 700;
  color: #64748B;
  margin-bottom: 24px;
}

/* Grid: Fixed 4 Columns */
.bu-all-prog-grid {
  display: grid !important;
  grid-template-columns: repeat(4, 1fr) !important;
  gap: 18px !important;
}

/* Compact Borderless Elevated Card Design */
.bu-all-card {
  background: #FFFFFF;
  border: none !important;
  border-radius: 12px !important;
  padding: 18px 18px 20px 18px !important;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 8px 24px rgba(10, 27, 84, 0.05) !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  position: relative;
  outline: none !important;
}
.bu-all-card:hover {
  transform: translateY(-5px) !important;
  box-shadow: 0 16px 36px rgba(10, 27, 84, 0.12) !important;
  border: none !important;
}
.bu-all-card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}
.bu-all-card-badge {
  background: #EFF6FF;
  color: #1D4ED8;
  font-size: 9.5px;
  font-weight: 800;
  padding: 4px 10px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-all-card-featured {
  background: #FEF3C7;
  color: #D97706;
  font-size: 8.5px;
  font-weight: 800;
  padding: 2px 7px;
  border-radius: 4px;
}
.bu-all-card-title {
  font-size: 16px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 12px 0;
  line-height: 1.25;
}
.bu-all-card-details {
  background: #F8FAFC;
  border: none;
  border-radius: 6px;
  padding: 10px 12px;
  margin-bottom: 14px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.bu-all-detail-item {
  display: flex;
  justify-content: space-between;
  font-size: 11.5px;
}
.bu-all-detail-item span {
  color: #64748B;
}
.bu-all-detail-item strong {
  color: #0F172A;
  font-weight: 700;
}
.bu-all-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}
.bu-all-card-apply {
  background: #0A1B54;
  color: #FFFFFF;
  font-size: 11px;
  font-weight: 700;
  padding: 7px 14px;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-all-card-apply:hover {
  background: #FFC107;
  color: #0A1B54;
  text-decoration: none;
}

@media (max-width: 1024px) {
  .bu-all-prog-grid {
    grid-template-columns: repeat(2, 1fr) !important;
  }
}
@media (max-width: 575px) {
  .bu-all-prog-grid {
    grid-template-columns: 1fr !important;
  }
}

/* No Results State */
.bu-no-results {
  grid-column: 1 / -1;
  text-align: center;
  padding: 60px 20px;
  background: #FFFFFF;
  border-radius: 12px;
  border: 1px dashed #CBD5E1;
}
.bu-no-results i {
  font-size: 40px;
  color: #94A3B8;
  margin-bottom: 14px;
}
.bu-no-results h3 {
  font-size: 20px;
  color: #0F172A;
  margin-bottom: 8px;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'All Academic <em>Programs &amp; Degrees</em>';
  $page_subtitle = 'Explore 200+ undergraduate, postgraduate, diploma, doctoral &amp; certificate courses offered across Bhabha University.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'All Programs', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-all-prog-page">
    <div class="bu-all-prog-container">

      <!-- Filter & Search Bar -->
      <div class="bu-prog-filter-bar">
        <div class="bu-prog-search-box">
          <i class="fa fa-search bu-prog-search-icon"></i>
          <input type="text" id="buProgSearchInput" placeholder="Search program by name, degree, or eligibility (e.g. B.Tech, Nursing, MBA, MBBS, Law)...">
        </div>

        <div class="bu-prog-tabs-row" id="buProgTabButtons">
          <button class="bu-prog-tab-btn active" data-level="all">All Degree Levels</button>
          <button class="bu-prog-tab-btn" data-level="undergraduate">Undergraduate (UG)</button>
          <button class="bu-prog-tab-btn" data-level="postgraduate">Postgraduate (PG)</button>
          <button class="bu-prog-tab-btn" data-level="diploma">Diploma</button>
          <button class="bu-prog-tab-btn" data-level="doctoral">Doctoral / Ph.D</button>
          <button class="bu-prog-tab-btn" data-level="certificate">Certificate</button>
        </div>
      </div>

      <div class="bu-prog-results-count" id="buProgResultsCount">Showing all programs</div>

      <!-- Programs Grid -->
      <div class="bu-all-prog-grid" id="buProgCardsGrid">
        <?php
        $all_courses = [];
        if (isset($db) && is_object($db)) {
            $db->where('status', 1);
            $all_courses = $db->get('course');
        }

        // Program Map for Level Name (DB program table: 1: PhD, 2: PG, 3: UG, 4: Diploma, 5: Certificate)
        $prog_level_map = [
            3 => 'undergraduate',
            2 => 'postgraduate',
            4 => 'diploma',
            1 => 'doctoral',
            5 => 'certificate'
        ];
        $prog_level_labels = [
            3 => 'UG',
            2 => 'PG',
            4 => 'DIPLOMA',
            1 => 'PH.D',
            5 => 'CERTIFICATE'
        ];

        if (!empty($all_courses) && is_array($all_courses)):
            foreach ($all_courses as $c):
                $p_id = (int)$c['program'];
                $level_key = isset($prog_level_map[$p_id]) ? $prog_level_map[$p_id] : 'undergraduate';
                $level_lbl = isset($prog_level_labels[$p_id]) ? $prog_level_labels[$p_id] : 'UG';
                $title = !empty($c['course']) ? $c['course'] : 'Degree Course';
                $duration = !empty($c['duration']) ? $c['duration'] : '4 yrs';
                $eligibility = !empty($c['eligibility']) ? $c['eligibility'] : '10+2';
                $seats = !empty($c['seats']) ? $c['seats'] : '120';
                $is_feat = !empty($c['is_featured']);
        ?>
          <div class="bu-all-card" data-level="<?php echo $level_key; ?>" data-title="<?php echo htmlspecialchars(strtolower($title)); ?>" data-eligibility="<?php echo htmlspecialchars(strtolower($eligibility)); ?>">
            <div class="bu-all-card-top">
              <span class="bu-all-card-badge"><?php echo $level_lbl; ?></span>
              <?php if($is_feat): ?>
                <span class="bu-all-card-featured">FEATURED</span>
              <?php endif; ?>
            </div>
            <h3 class="bu-all-card-title"><?php echo htmlspecialchars($title); ?></h3>
            <div class="bu-all-card-details">
              <div class="bu-all-detail-item"><span>Duration</span><strong><?php echo htmlspecialchars($duration); ?></strong></div>
              <div class="bu-all-detail-item"><span>Eligibility</span><strong><?php echo htmlspecialchars($eligibility); ?></strong></div>
              <div class="bu-all-detail-item"><span>Seats</span><strong><?php echo htmlspecialchars($seats); ?></strong></div>
            </div>
            <div class="bu-all-card-footer">
              <a href="<?php echo href('enquiry.php'); ?>" class="bu-all-card-apply">Apply Now <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        <?php 
            endforeach;
        else:
            // Fallback Static Array
            $static_programs = [
                ['title'=>'B.Tech CSE', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'4 yrs', 'elig'=>'10+2 PCM 60%', 'seats'=>'240'],
                ['title'=>'MBBS', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'5.5 yrs', 'elig'=>'NEET-UG', 'seats'=>'150'],
                ['title'=>'B.Pharm', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'4 yrs', 'elig'=>'10+2 PCB/PCM', 'seats'=>'100'],
                ['title'=>'BA LLB', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'5 yrs', 'elig'=>'10+2 50%', 'seats'=>'60'],
                ['title'=>'BBA', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'3 yrs', 'elig'=>'10+2 50%', 'seats'=>'180'],
                ['title'=>'B.Sc Nursing', 'level'=>'undergraduate', 'lbl'=>'UG', 'dur'=>'4 yrs', 'elig'=>'10+2 PCB', 'seats'=>'60'],
                ['title'=>'MBA Finance', 'level'=>'postgraduate', 'lbl'=>'PG', 'dur'=>'2 yrs', 'elig'=>'Graduation 50%', 'seats'=>'120'],
                ['title'=>'M.Tech CSE', 'level'=>'postgraduate', 'lbl'=>'PG', 'dur'=>'2 yrs', 'elig'=>'B.Tech CSE', 'seats'=>'18'],
                ['title'=>'MCA', 'level'=>'postgraduate', 'lbl'=>'PG', 'dur'=>'2 yrs', 'elig'=>'BCA / Grad', 'seats'=>'60'],
                ['title'=>'M.Pharm', 'level'=>'postgraduate', 'lbl'=>'PG', 'dur'=>'2 yrs', 'elig'=>'B.Pharm 55%', 'seats'=>'36'],
                ['title'=>'Diploma Engineering', 'level'=>'diploma', 'lbl'=>'DIPLOMA', 'dur'=>'3 yrs', 'elig'=>'10th Pass', 'seats'=>'180'],
                ['title'=>'D.Pharm', 'level'=>'diploma', 'lbl'=>'DIPLOMA', 'dur'=>'2 yrs', 'elig'=>'10+2 PCB/PCM', 'seats'=>'60'],
                ['title'=>'Ph.D Engineering', 'level'=>'doctoral', 'lbl'=>'PH.D', 'dur'=>'3-5 yrs', 'elig'=>'M.Tech Pass', 'seats'=>'30'],
                ['title'=>'Ph.D Pharmacy', 'level'=>'doctoral', 'lbl'=>'PH.D', 'dur'=>'3-5 yrs', 'elig'=>'M.Pharm Pass', 'seats'=>'10'],
                ['title'=>'Digital Marketing', 'level'=>'certificate', 'lbl'=>'CERTIFICATE', 'dur'=>'6 months', 'elig'=>'10+2 Pass', 'seats'=>'40'],
                ['title'=>'Cyber Security', 'level'=>'certificate', 'lbl'=>'CERTIFICATE', 'dur'=>'6 months', 'elig'=>'10+2 / IT', 'seats'=>'30'],
            ];
            foreach($static_programs as $sp):
        ?>
          <div class="bu-all-card" data-level="<?php echo $sp['level']; ?>" data-title="<?php echo htmlspecialchars(strtolower($sp['title'])); ?>" data-eligibility="<?php echo htmlspecialchars(strtolower($sp['elig'])); ?>">
            <div class="bu-all-card-top">
              <span class="bu-all-card-badge"><?php echo $sp['lbl']; ?></span>
              <span class="bu-all-card-featured">FEATURED</span>
            </div>
            <h3 class="bu-all-card-title"><?php echo htmlspecialchars($sp['title']); ?></h3>
            <div class="bu-all-card-details">
              <div class="bu-all-detail-item"><span>Duration</span><strong><?php echo htmlspecialchars($sp['dur']); ?></strong></div>
              <div class="bu-all-detail-item"><span>Eligibility</span><strong><?php echo htmlspecialchars($sp['elig']); ?></strong></div>
              <div class="bu-all-detail-item"><span>Seats</span><strong><?php echo htmlspecialchars($sp['seats']); ?></strong></div>
            </div>
            <div class="bu-all-card-footer">
              <a href="<?php echo href('enquiry.php'); ?>" class="bu-all-card-apply">Apply Now <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        <?php 
            endforeach;
        endif; 
        ?>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('buProgSearchInput');
  const tabButtons = document.querySelectorAll('#buProgTabButtons .bu-prog-tab-btn');
  const cards = document.querySelectorAll('#buProgCardsGrid .bu-all-card');
  const countDisplay = document.getElementById('buProgResultsCount');

  let activeLevel = 'all';
  let searchQuery = '';

  function filterCards() {
    let visibleCount = 0;
    cards.forEach(card => {
      const cardLevel = card.getAttribute('data-level');
      const cardTitle = card.getAttribute('data-title');
      const cardElig = card.getAttribute('data-eligibility');

      const matchesTab = (activeLevel === 'all' || cardLevel === activeLevel);
      const matchesSearch = (!searchQuery || cardTitle.includes(searchQuery) || cardElig.includes(searchQuery));

      if (matchesTab && matchesSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (countDisplay) {
      countDisplay.textContent = `Showing ${visibleCount} program${visibleCount !== 1 ? 's' : ''}`;
    }
  }

  tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      tabButtons.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      activeLevel = this.getAttribute('data-level');
      filterCards();
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', function() {
      searchQuery = this.value.trim().toLowerCase();
      filterCards();
    });
  }
});
</script>
</body>
</html>
