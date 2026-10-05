<?php 
include('config.php'); 

// Self-healing database check for `news_date` column in `news` table (fail-safe for live server)
$hasNewsDate = false;
if (isset($db) && is_object($db)) {
    try {
        $cols = $db->rawQuery("SHOW COLUMNS FROM `news` LIKE 'news_date'");
        if (!empty($cols)) {
            $hasNewsDate = true;
        } else {
            // Attempt auto-migration on live server
            @$db->rawQuery("ALTER TABLE `news` ADD COLUMN `news_date` DATE NULL DEFAULT NULL AFTER `title`");
            $checkColsAgain = $db->rawQuery("SHOW COLUMNS FROM `news` LIKE 'news_date'");
            $hasNewsDate = !empty($checkColsAgain);
            if ($hasNewsDate && file_exists(__DIR__ . '/migrate_news_date.php')) {
                @include_once(__DIR__ . '/migrate_news_date.php');
            }
        }
    } catch (\Throwable $e) {
        $hasNewsDate = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>News & Press Coverage - Bhabha University Bhopal</title>
<meta name="description" content="Latest news updates, press releases, media coverage, and academic milestones from Bhabha University, Bhopal Madhya Pradesh.">

<!-- Include standard meta and fonts -->
<?php include('inc.meta.php'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* ============================================================
   BHABHA UNIVERSITY - NEWS & PRESS COVERAGE PAGE
   Theme: Navy #0A1B54 | Gold #FFC107 | Light BG #F8FAFC
   ============================================================ */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
  --bu-navy-light: #162B75;
  --bu-gold: #FFC107;
  --bu-gold-hover: #D99B00;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
  --bu-bg-light: #F8FAFC;
  --bu-card-bg: #FFFFFF;
  --bu-border: #E2E8F0;
}

body {
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
  background-color: var(--bu-bg-light) !important;
  color: var(--bu-text-dark) !important;
}

/* Force hide all selectric ghost elements and inputs */
input.selectric-input,
.selectric-input,
.selectric,
.selectric-items {
  display: none !important;
  visibility: hidden !important;
  opacity: 0 !important;
  height: 0 !important;
  width: 0 !important;
  padding: 0 !important;
  margin: 0 !important;
  border: none !important;
  position: absolute !important;
  pointer-events: none !important;
}
.selectric-wrapper,
.selectric-hide-select {
  display: contents !important;
}

.bu-news-page-wrap {
  background-color: var(--bu-bg-light);
  padding: 40px 20px 80px 20px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: var(--bu-text-dark);
  clear: both;
  width: 100%;
  float: left;
  box-sizing: border-box;
}

.bu-news-container {
  max-width: 1240px;
  margin: 0 auto;
}

/* ============================================================
   PREMIUM FILTER & SEARCH BAR
   ============================================================ */
.bu-news-filter-card {
  background: #FFFFFF;
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 22px 24px;
  margin-bottom: 30px;
  box-shadow: 0 4px 20px rgba(10, 27, 84, 0.04);
}

.bu-news-filter-grid {
  display: flex;
  align-items: flex-end;
  gap: 14px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}

.bu-filter-field {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.bu-field-search {
  flex: 2 1 280px;
}

.bu-field-date {
  flex: 1 1 160px;
}

.bu-field-month {
  flex: 1 1 160px;
}

.bu-field-sort {
  flex: 1 1 160px;
}

.bu-field-btn {
  flex: 0 0 auto;
}

.bu-filter-field label {
  font-size: 11.5px;
  font-weight: 700;
  color: #475569;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 5px;
}

.bu-search-input-wrap {
  position: relative;
  width: 100%;
}

.bu-search-input-wrap input {
  width: 100%;
  height: 42px;
  padding: 8px 16px 8px 40px;
  font-size: 13.5px;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  background: #F8FAFC;
  color: var(--bu-text-dark);
  outline: none;
  transition: all 0.25s ease;
  box-sizing: border-box;
}

.bu-search-input-wrap input:focus {
  border-color: var(--bu-navy);
  background: #FFFFFF;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.08);
}

.bu-search-input-wrap .search-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 14px;
}

.bu-native-select, .bu-native-date {
  width: 100% !important;
  height: 42px !important;
  padding: 8px 12px !important;
  font-size: 13.5px !important;
  font-weight: 600 !important;
  border: 1px solid #CBD5E1 !important;
  border-radius: 8px !important;
  background: #FFFFFF !important;
  color: var(--bu-navy) !important;
  outline: none !important;
  cursor: pointer !important;
  box-sizing: border-box !important;
  display: block !important;
  visibility: visible !important;
  opacity: 1 !important;
  position: static !important;
}

.bu-native-select:focus, .bu-native-date:focus {
  border-color: var(--bu-navy) !important;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.08) !important;
}

.bu-btn-reset-filter {
  height: 42px;
  background: #F1F5F9;
  color: #334155;
  border: 1px solid #CBD5E1;
  padding: 0 16px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all 0.2s;
  white-space: nowrap;
  box-sizing: border-box;
}

.bu-btn-reset-filter:hover {
  background: #E2E8F0;
  color: var(--bu-navy);
}

/* Year Filter Navigation Pills */
.bu-news-year-row {
  display: flex;
  align-items: center;
  gap: 10px;
  padding-top: 16px;
  border-top: 1px dashed var(--bu-border);
  overflow-x: auto;
  scrollbar-width: thin;
}

.bu-news-year-row::-webkit-scrollbar {
  height: 4px;
}

.bu-news-year-row::-webkit-scrollbar-thumb {
  background: #CBD5E1;
  border-radius: 4px;
}

.bu-year-pill {
  padding: 7px 18px;
  border-radius: 24px;
  font-size: 13px;
  font-weight: 700;
  color: #475569;
  background: #F1F5F9;
  border: 1px solid #E2E8F0;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.22s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.bu-year-pill:hover {
  background: #E2E8F0;
  color: var(--bu-navy);
}

.bu-year-pill.active {
  background: var(--bu-navy);
  color: #FFFFFF;
  border-color: var(--bu-navy);
  box-shadow: 0 4px 14px rgba(10, 27, 84, 0.2);
}

.bu-year-pill.active .bu-year-count {
  background: var(--bu-gold);
  color: var(--bu-navy);
}

.bu-year-count {
  font-size: 11px;
  background: rgba(0,0,0,0.06);
  padding: 2px 8px;
  border-radius: 12px;
  font-weight: 800;
}

/* Status Bar */
.bu-news-status-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  font-size: 14px;
  color: var(--bu-text-muted);
  font-weight: 600;
}

.bu-news-status-bar span.bu-count-highlight {
  color: var(--bu-navy);
  font-weight: 800;
}

/* ============================================================
   NEWS CARDS GRID
   ============================================================ */
.bu-news-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 30px;
}

.bu-news-card {
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(10, 27, 84, 0.04);
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  position: relative;
}

.bu-news-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 36px rgba(10, 27, 84, 0.12);
  border-color: var(--bu-gold);
}

/* Framed Image Box */
.bu-news-card-img-wrap {
  position: relative;
  height: 240px;
  background: #F8FAFC;
  padding: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  cursor: pointer;
  border-bottom: 1px solid #E2E8F0;
}

.bu-news-card-img {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: contain;
  display: block;
  border-radius: 6px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
  transition: transform 0.35s ease;
}

.bu-news-card:hover .bu-news-card-img {
  transform: scale(1.03);
}

/* Image Hover Zoom Overlay */
.bu-news-card-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 27, 84, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 2;
  backdrop-filter: blur(2px);
}

.bu-news-card-img-wrap:hover .bu-news-card-overlay {
  opacity: 1;
}

.bu-news-zoom-btn {
  background: #FFFFFF;
  color: var(--bu-navy);
  border: none;
  padding: 9px 18px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(0,0,0,0.25);
  transition: transform 0.2s ease, background 0.2s ease;
}

.bu-news-zoom-btn:hover {
  background: var(--bu-gold);
  color: var(--bu-navy);
  transform: scale(1.05);
}

/* Card Body */
.bu-news-card-body {
  padding: 20px 22px;
  display: flex;
  flex-direction: column;
  flex: 1;
  justify-content: space-between;
}

.bu-news-meta-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
  gap: 8px;
}

.bu-news-date-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #EEF2FF;
  color: #1E40AF;
  border: 1px solid #C7D2FE;
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
}

.bu-news-cat-badge {
  display: inline-flex;
  align-items: center;
  background: #FFFBEB;
  color: #B45309;
  border: 1px solid #FDE68A;
  font-size: 11px;
  font-weight: 800;
  padding: 4px 8px;
  border-radius: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.bu-news-card-title {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 15.5px;
  font-weight: 700;
  color: var(--bu-navy);
  line-height: 1.45;
  margin: 0 0 16px 0;
  min-height: 44px;
  letter-spacing: -0.2px;
}

/* Card Footer */
.bu-news-card-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  margin-top: auto;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.bu-news-btn-small {
  background: var(--bu-navy);
  color: #FFFFFF !important;
  border: none;
  padding: 7px 16px;
  border-radius: 8px;
  font-size: 12.5px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.25s ease;
  white-space: nowrap;
}

.bu-news-btn-small:hover {
  background: var(--bu-gold);
  color: var(--bu-navy) !important;
}

/* Empty State */
.bu-news-empty {
  text-align: center;
  padding: 60px 20px;
  background: #FFFFFF;
  border-radius: 16px;
  border: 2px dashed #CBD5E1;
  grid-column: 1 / -1;
}

.bu-news-empty i {
  font-size: 48px;
  color: #94A3B8;
  margin-bottom: 16px;
}

.bu-news-empty h3 {
  font-size: 20px;
  color: var(--bu-text-dark);
  font-weight: 700;
  margin: 0 0 8px 0;
}

/* Lightbox Modal */
.bu-modal {
  position: fixed;
  inset: 0;
  z-index: 99999;
  background: rgba(5, 18, 53, 0.92);
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

.bu-modal.active {
  opacity: 1;
  visibility: visible;
}

.bu-modal-dialog {
  position: relative;
  max-width: 900px;
  width: 100%;
  max-height: 90vh;
  background: #FFFFFF;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
  display: flex;
  flex-direction: column;
}

.bu-modal-header {
  padding: 16px 24px;
  background: var(--bu-navy);
  color: #FFFFFF;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bu-modal-title {
  font-size: 16px;
  font-weight: 700;
  margin: 0;
  color: #FFFFFF;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding-right: 15px;
}

.bu-modal-close {
  background: rgba(255,255,255,0.15);
  border: none;
  color: #FFFFFF;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.2s ease;
}

.bu-modal-close:hover {
  background: rgba(255,255,255,0.3);
}

.bu-modal-body {
  padding: 20px;
  overflow-y: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #0f172a;
  min-height: 380px;
  max-height: calc(90vh - 120px);
  position: relative;
}

.bu-modal-loader {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  color: #FFC107;
  font-size: 32px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 5;
  pointer-events: none;
}

.bu-modal-loader span {
  font-size: 13.5px;
  font-weight: 600;
  color: #CBD5E1;
  letter-spacing: 0.3px;
  font-family: 'Plus Jakarta Sans', sans-serif;
}

.bu-modal-img {
  max-width: 100%;
  max-height: 75vh;
  object-fit: contain;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
  opacity: 0;
  transition: opacity 0.22s ease-in-out;
}

.bu-modal-footer {
  padding: 14px 24px;
  background: #F8FAFC;
  border-top: 1px solid var(--bu-border);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bu-modal-dl-btn {
  background: var(--bu-gold);
  color: var(--bu-navy) !important;
  font-weight: 700;
  font-size: 13.5px;
  padding: 8px 18px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: background 0.2s ease;
}

.bu-modal-dl-btn:hover {
  background: var(--bu-gold-hover);
}

/* Responsive */
@media (max-width: 992px) {
  .bu-field-search { flex: 1 1 100%; }
  .bu-field-date, .bu-field-month, .bu-field-sort { flex: 1 1 45%; }
  .bu-field-btn { flex: 1 1 100%; }
  .bu-btn-reset-filter { width: 100%; justify-content: center; }
}

@media (max-width: 576px) {
  .bu-news-grid {
    grid-template-columns: 1fr;
  }
  .bu-field-date, .bu-field-month, .bu-field-sort { flex: 1 1 100%; }
  .bu-news-card-img-wrap {
    height: 220px;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- Header -->
  <?php include('inc.header.php'); ?>

  <!-- Reusable Page Hero Banner with Breadcrumbs -->
  <?php
  $page_title    = 'News & <em>Press Coverage</em>';
  $page_subtitle = 'Explore official news updates, press releases, newspaper clippings, and academic milestones from Bhabha University date-wise.';
  $page_icon     = 'fa-newspaper-o';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'News Media', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <?php
  // Fetch dynamic available years with counts (fail-safe for live server)
  $yearsData = [];
  $totalNewsCount = 0;
  if ($hasNewsDate && isset($db) && is_object($db)) {
      try {
          $yearsData = $db->rawQuery("SELECT YEAR(news_date) as yr, COUNT(*) as cnt FROM `news` WHERE news_date IS NOT NULL AND news_date != '0000-00-00' GROUP BY YEAR(news_date) ORDER BY yr DESC");
          if (is_array($yearsData)) {
              foreach ($yearsData as $yd) {
                  $totalNewsCount += (int)$yd['cnt'];
              }
          }
      } catch (\Throwable $e) {
          $yearsData = [];
      }
  }
  ?>

  <!-- News Content Wrapper -->
  <div class="bu-news-page-wrap">
    <div class="bu-news-container">
      
      <!-- Premium Filter & Search Card -->
      <div class="bu-news-filter-card">
        
        <!-- Filter Row -->
        <div class="bu-news-filter-grid">
          
          <!-- 1. Search by Title/Headline -->
          <div class="bu-filter-field bu-field-search">
            <label for="buNewsSearchInput"><i class="fa fa-search"></i> Search News Headline</label>
            <div class="bu-search-input-wrap">
              <i class="fa fa-search search-icon"></i>
              <input type="text" id="buNewsSearchInput" placeholder="Search news by title or keyword..." onkeyup="applyNewsFilters()">
            </div>
          </div>

          <!-- 2. Exact Date Picker -->
          <div class="bu-filter-field bu-field-date">
            <label for="buNewsExactDate"><i class="fa fa-calendar"></i> Exact Date</label>
            <input type="date" id="buNewsExactDate" class="bu-native-date bu-form-control no-selectric" onchange="applyNewsFilters()">
          </div>

          <!-- 3. Month Filter -->
          <div class="bu-filter-field bu-field-month">
            <label for="buNewsMonthSelect"><i class="fa fa-filter"></i> Month</label>
            <select id="buNewsMonthSelect" class="bu-native-select bu-form-control no-selectric" onchange="applyNewsFilters()">
              <option value="all">All Months</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>

          <!-- 4. Sort Order -->
          <div class="bu-filter-field bu-field-sort">
            <label for="buNewsSortSelect"><i class="fa fa-sort-amount-desc"></i> Sort Order</label>
            <select id="buNewsSortSelect" class="bu-native-select bu-form-control no-selectric" onchange="applyNewsSorting()">
              <option value="date-desc">Newest First</option>
              <option value="date-asc">Oldest First</option>
            </select>
          </div>

          <!-- 5. Reset Filter Button -->
          <div class="bu-filter-field bu-field-btn">
            <button type="button" class="bu-btn-reset-filter" onclick="resetNewsFilters()">
              <i class="fa fa-refresh"></i> Reset
            </button>
          </div>

        </div>

        <!-- Year Filter Navigation Pills -->
        <div class="bu-news-year-row" id="buNewsYearBar">
          <button type="button" class="bu-year-pill active" data-year="all" onclick="selectYearFilter('all', this)">
            <i class="fa fa-newspaper-o"></i> All News <span class="bu-year-count"><?php echo $totalNewsCount; ?></span>
          </button>
          <?php if (!empty($yearsData)): ?>
            <?php foreach ($yearsData as $yd): ?>
              <?php if (!empty($yd['yr'])): ?>
                <button type="button" class="bu-year-pill" data-year="<?php echo $yd['yr']; ?>" onclick="selectYearFilter('<?php echo $yd['yr']; ?>', this)">
                  <i class="fa fa-calendar"></i> <?php echo $yd['yr']; ?> <span class="bu-year-count"><?php echo $yd['cnt']; ?></span>
                </button>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>

      <!-- Status / Count Bar -->
      <div class="bu-news-status-bar">
        <div>Showing <span id="buNewsVisibleCount" class="bu-count-highlight"><?php echo $totalNewsCount; ?></span> News Clippings</div>
        <div id="buActiveFilterText" style="font-size:13px; color:#64748B;">Showing: All News</div>
      </div>

      <!-- Main News Grid -->
      <div class="bu-news-grid" id="buNewsGrid">
        <?php
        $news = [];
        if (isset($db) && is_object($db)) {
            try {
                if ($hasNewsDate) {
                    $db->orderBy("news_date", "desc");
                }
                $db->orderBy("id", "desc");
                $news = $db->get('news');
            } catch (\Throwable $e) {
                try {
                    $news = $db->rawQuery("SELECT * FROM `news` ORDER BY id DESC");
                } catch (\Throwable $e2) {
                    $news = [];
                }
            }
        }
        if ($totalNewsCount === 0 && !empty($news)) {
            $totalNewsCount = count($news);
        }

        // If yearsData was empty (due to missing column), derive years dynamically from titles
        if (empty($yearsData) && !empty($news)) {
            $yearCounts = [];
            foreach ($news as $item) {
                $t = $item['title'] ?? '';
                if (preg_match('/20\d{2}/', $t, $ym)) {
                    $yr = $ym[0];
                } else {
                    $yr = '2026';
                }
                $yearCounts[$yr] = ($yearCounts[$yr] ?? 0) + 1;
            }
            krsort($yearCounts);
            foreach ($yearCounts as $yr => $cnt) {
                $yearsData[] = ['yr' => $yr, 'cnt' => $cnt];
            }
        }
        
        if (is_array($news) && count($news) > 0):
          foreach ($news as $inews):
            $imgUrl = !empty($inews['image']) ? URL_UPLOAD . 'news/' . $inews['image'] : URL_ROOT . 'extra-images/news1.jpg';
            $thumbUrl = !empty($inews['image']) ? URL_UPLOAD . 'news/thumb/' . $inews['image'] : $imgUrl;
            $title = !empty($inews['title']) ? htmlspecialchars($inews['title']) : 'Bhabha University News Update';
            
            $rawDate = '';
            if (!empty($inews['news_date']) && $inews['news_date'] !== '0000-00-00') {
                $rawDate = $inews['news_date'];
            } else {
                // Try parsing from title
                if (preg_match('/(\d{1,2})[-\/](\d{1,2})[-\/](20\d{2})/', $title, $m)) {
                    $rawDate = "{$m[3]}-" . str_pad($m[2], 2, '0', STR_PAD_LEFT) . "-" . str_pad($m[1], 2, '0', STR_PAD_LEFT);
                } else {
                    $rawDate = '2026-01-01';
                }
            }
            $timestamp = strtotime($rawDate) ?: time();
            $formattedDate = date('d M Y', $timestamp);
            $itemYear = date('Y', $timestamp);
            $itemMonth = date('m', $timestamp);
        ?>
        <div class="bu-news-card bu-news-item" 
             id="news-item-<?php echo $inews['id']; ?>"
             data-id="<?php echo $inews['id']; ?>"
             data-title="<?php echo htmlspecialchars(strtolower($title)); ?>"
             data-year="<?php echo $itemYear; ?>"
             data-month="<?php echo $itemMonth; ?>"
             data-date="<?php echo $rawDate; ?>"
             data-timestamp="<?php echo $timestamp; ?>">
             
          <!-- Framed Image Box -->
          <div class="bu-news-card-img-wrap" onclick="openNewsModal('<?php echo $imgUrl; ?>', '<?php echo addslashes($title); ?>')">
            <img src="<?php echo $thumbUrl; ?>" alt="<?php echo $title; ?>" class="bu-news-card-img" onerror="this.src='<?php echo URL_ROOT;?>extra-images/news1.jpg'">
            <div class="bu-news-card-overlay">
              <button type="button" class="bu-news-zoom-btn">
                <i class="fa fa-search-plus"></i> View Clipping
              </button>
            </div>
          </div>

          <!-- Card Body -->
          <div class="bu-news-card-body">
            <!-- Date & Category Meta Row -->
            <div class="bu-news-meta-row">
              <span class="bu-news-date-badge">
                <i class="fa fa-calendar-check-o"></i> <?php echo $formattedDate; ?>
              </span>
              <span class="bu-news-cat-badge">PRESS</span>
            </div>

            <!-- Title -->
            <h4 class="bu-news-card-title"><?php echo $title; ?></h4>
            
            <!-- Side-by-Side Action Button -->
            <div class="bu-news-card-footer">
              <button type="button" class="bu-news-btn-small" onclick="openNewsModal('<?php echo $imgUrl; ?>', '<?php echo addslashes($title); ?>')">
                View Clipping <i class="fa fa-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>
        <?php 
          endforeach;
        else:
        ?>
        <!-- Empty State -->
        <div class="bu-news-empty">
          <i class="fa fa-newspaper-o"></i>
          <h3>No News Updates Found</h3>
          <p style="color:#64748B;">Please check back later for the latest news updates and press releases.</p>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <?php include('inc.footer.php'); ?>
</div>

<!-- Lightbox Modal for High-Res View -->
<div class="bu-modal" id="buNewsModal" onclick="closeNewsModalOnOverlay(event)">
  <div class="bu-modal-dialog">
    <div class="bu-modal-header">
      <h3 class="bu-modal-title" id="buModalTitle">News Clipping</h3>
      <button type="button" class="bu-modal-close" onclick="closeNewsModal()" aria-label="Close">
        <i class="fa fa-times"></i>
      </button>
    </div>
    <div class="bu-modal-body">
      <div class="bu-modal-loader" id="buModalLoader">
        <i class="fa fa-circle-o-notch fa-spin"></i>
        <span>Loading Clipping...</span>
      </div>
      <img src="" id="buModalImg" class="bu-modal-img" alt="News Image Clipping">
    </div>
    <div class="bu-modal-footer">
      <span style="font-size:13px; color:#64748B;">Press & Media Coverage • Bhabha University</span>
      <a href="#" id="buModalDl" target="_blank" class="bu-modal-dl-btn" download>
        <i class="fa fa-download"></i> Download Clipping
      </a>
    </div>
  </div>
</div>

<!-- Footer Scripts -->
<?php include('inc.footer.js.php'); ?>

<script>
var currentSelectedYear = 'all';

// Clean any selectric ghost input artifacts on load
$(document).ready(function() {
  $('input.selectric-input').remove();
  $('.selectric').remove();
  $('.selectric-items').remove();
  if (typeof $.fn.selectric !== 'undefined') {
    $('.no-selectric').selectric('destroy');
  }
  setTimeout(function() {
    $('input.selectric-input').remove();
    $('.selectric').remove();
    $('.selectric-items').remove();
  }, 100);
});

function selectYearFilter(year, btnEl) {
  currentSelectedYear = year;
  
  // Clear exact date picker if year pill clicked
  if (document.getElementById('buNewsExactDate')) {
    document.getElementById('buNewsExactDate').value = '';
  }
  
  // Update active class on year pills
  var pills = document.querySelectorAll('.bu-year-pill');
  pills.forEach(function(pill) {
    pill.classList.remove('active');
  });
  if (btnEl) {
    btnEl.classList.add('active');
  }
  
  applyNewsFilters();
}

function applyNewsFilters() {
  var searchQuery = (document.getElementById('buNewsSearchInput').value || '').toLowerCase().trim();
  var exactDate = document.getElementById('buNewsExactDate') ? document.getElementById('buNewsExactDate').value : '';
  var selectedMonth = document.getElementById('buNewsMonthSelect').value;
  var items = document.querySelectorAll('.bu-news-item');
  var visibleCount = 0;

  items.forEach(function(item) {
    var title = item.getAttribute('data-title') || '';
    var itemYear = item.getAttribute('data-year') || '';
    var itemMonth = item.getAttribute('data-month') || '';
    var itemDate = item.getAttribute('data-date') || '';

    var matchesYear = (currentSelectedYear === 'all' || itemYear === currentSelectedYear);
    var matchesMonth = (selectedMonth === 'all' || itemMonth === selectedMonth);
    var matchesExactDate = (exactDate === '' || itemDate === exactDate);
    var matchesSearch = (searchQuery === '' || title.indexOf(searchQuery) !== -1 || itemDate.indexOf(searchQuery) !== -1);

    if (matchesYear && matchesMonth && matchesExactDate && matchesSearch) {
      item.style.display = '';
      visibleCount++;
    } else {
      item.style.display = 'none';
    }
  });

  // Update visible count
  var countEl = document.getElementById('buNewsVisibleCount');
  if (countEl) {
    countEl.textContent = visibleCount;
  }

  // Update active filter indicator text
  var filterTextEl = document.getElementById('buActiveFilterText');
  if (filterTextEl) {
    var desc = [];
    if (exactDate !== '') {
      desc.push('Date: ' + exactDate);
    } else if (currentSelectedYear !== 'all') {
      desc.push('Year ' + currentSelectedYear);
    } else {
      desc.push('All Years');
    }
    
    if (selectedMonth !== 'all') {
      var monthSelect = document.getElementById('buNewsMonthSelect');
      var monthText = monthSelect.options[monthSelect.selectedIndex].text;
      desc.push(monthText);
    }
    if (searchQuery !== '') {
      desc.push('Title: "' + searchQuery + '"');
    }
    filterTextEl.textContent = 'Active Filter: ' + desc.join(' • ');
  }

  // Handle dynamic empty state
  var emptyEl = document.getElementById('buNewsDynamicEmpty');
  var grid = document.getElementById('buNewsGrid');
  if (visibleCount === 0) {
    if (!emptyEl) {
      emptyEl = document.createElement('div');
      emptyEl.id = 'buNewsDynamicEmpty';
      emptyEl.className = 'bu-news-empty';
      emptyEl.innerHTML = '<i class="fa fa-filter"></i><h3>No Matching News Found</h3><p style="color:#64748B;">No news clippings match the selected criteria.</p><button type="button" class="bu-btn-reset-filter" onclick="resetNewsFilters()" style="margin:10px auto 0; display:inline-flex;"><i class="fa fa-refresh"></i> Reset All Filters</button>';
      grid.appendChild(emptyEl);
    }
  } else if (emptyEl) {
    emptyEl.remove();
  }
}

function applyNewsSorting() {
  var sortOrder = document.getElementById('buNewsSortSelect').value;
  var grid = document.getElementById('buNewsGrid');
  var items = Array.from(document.querySelectorAll('.bu-news-item'));

  items.sort(function(a, b) {
    var timeA = parseInt(a.getAttribute('data-timestamp') || '0', 10);
    var timeB = parseInt(b.getAttribute('data-timestamp') || '0', 10);
    if (sortOrder === 'date-asc') {
      return timeA - timeB;
    } else {
      return timeB - timeA;
    }
  });

  items.forEach(function(item) {
    grid.appendChild(item);
  });
}

function resetNewsFilters() {
  document.getElementById('buNewsSearchInput').value = '';
  if (document.getElementById('buNewsExactDate')) {
    document.getElementById('buNewsExactDate').value = '';
  }
  document.getElementById('buNewsMonthSelect').value = 'all';
  document.getElementById('buNewsSortSelect').value = 'date-desc';
  
  var allPill = document.querySelector('.bu-year-pill[data-year="all"]');
  selectYearFilter('all', allPill);
  applyNewsSorting();
}

var currentModalRequestId = 0;

function openNewsModal(imgUrl, titleText) {
  var modal = document.getElementById('buNewsModal');
  var imgEl = document.getElementById('buModalImg');
  var titleEl = document.getElementById('buModalTitle');
  var dlEl = document.getElementById('buModalDl');
  var loaderEl = document.getElementById('buModalLoader');
  
  // Set title and download link
  titleEl.textContent = titleText;
  dlEl.href = imgUrl;
  
  // CRITICAL FIX: Immediately clear previous image and hide it
  // This prevents the old news clipping from flashing for 1-2 seconds
  imgEl.removeAttribute('src');
  imgEl.style.opacity = '0';
  if (loaderEl) {
    loaderEl.style.display = 'flex';
  }
  
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';

  // Incremental ID to prevent race conditions on fast switching
  var requestId = ++currentModalRequestId;
  
  // Preload new image in memory before painting
  var preloader = new Image();
  preloader.onload = function() {
    if (requestId === currentModalRequestId) {
      imgEl.src = imgUrl;
      imgEl.style.opacity = '1';
      if (loaderEl) {
        loaderEl.style.display = 'none';
      }
    }
  };
  preloader.onerror = function() {
    if (requestId === currentModalRequestId) {
      imgEl.src = '<?php echo URL_ROOT;?>extra-images/news1.jpg';
      imgEl.style.opacity = '1';
      if (loaderEl) {
        loaderEl.style.display = 'none';
      }
    }
  };
  preloader.src = imgUrl;
}

function closeNewsModal() {
  var modal = document.getElementById('buNewsModal');
  var imgEl = document.getElementById('buModalImg');
  var loaderEl = document.getElementById('buModalLoader');
  
  // Cancel any pending background load
  currentModalRequestId++;
  
  modal.classList.remove('active');
  document.body.style.overflow = '';
  
  // Wipe out image source completely on close
  imgEl.removeAttribute('src');
  imgEl.style.opacity = '0';
  if (loaderEl) {
    loaderEl.style.display = 'flex';
  }
}

function closeNewsModalOnOverlay(e) {
  if (e.target.id === 'buNewsModal') {
    closeNewsModal();
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeNewsModal();
  }
});

// Auto scroll and open modal if news ?id=XX or /news/XX/ is in URL
$(document).ready(function() {
  var urlParams = new URLSearchParams(window.location.search);
  var newsId = urlParams.get('id');
  if (!newsId) {
    var parts = window.location.pathname.split('/').filter(Boolean);
    var lastPart = parts[parts.length - 1];
    if (lastPart && /^\d+$/.test(lastPart)) {
      newsId = lastPart;
    }
  }
  if (newsId) {
    var targetCard = document.getElementById('news-item-' + newsId);
    if (targetCard) {
      setTimeout(function() {
        targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        targetCard.style.boxShadow = '0 0 0 3px #FFC107, 0 16px 36px rgba(10, 27, 84, 0.2)';
        var zoomBtn = targetCard.querySelector('.bu-news-card-img-wrap');
        if (zoomBtn) {
          zoomBtn.click();
        }
      }, 400);
    }
  }
});
</script>
</body>
</html>
