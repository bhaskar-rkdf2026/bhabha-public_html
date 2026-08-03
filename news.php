<?php include('config.php'); ?>
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
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ===== BHABHA UNIVERSITY HOME PAGE THEMED NEWS STYLES ===== */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-dark: #051235;
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

/* Controls & Filter Bar */
.bu-news-controls-wrap {
  background: #FFFFFF;
  border-bottom: 1px solid var(--bu-border);
  padding: 18px 0;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
  width: 100%;
  float: left;
  clear: both;
}

.bu-news-controls-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.bu-news-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
}

.bu-news-search-box {
  position: relative;
  width: 100%;
  max-width: 380px;
}

.bu-news-search-box input {
  width: 100%;
  padding: 10px 16px 10px 42px;
  font-size: 14px;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  background: #F8FAFC;
  color: var(--bu-text-dark);
  outline: none;
  transition: all 0.25s ease;
}

.bu-news-search-box input:focus {
  border-color: var(--bu-navy);
  background: #FFFFFF;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
}

.bu-news-search-box .search-icon {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 14px;
}

.bu-news-count {
  font-size: 14px;
  color: var(--bu-text-muted);
  font-weight: 500;
}

.bu-news-count span {
  color: var(--bu-navy);
  font-weight: 700;
}

/* Main Section */
.bu-news-section {
  padding: 55px 0 85px 0;
  width: 100%;
  float: left;
  clear: both;
}

.bu-news-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* News Cards Grid */
.bu-news-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
  gap: 34px;
}

/* News Card Frame */
.bu-news-card {
  background: var(--bu-card-bg);
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 6px 22px rgba(10, 27, 84, 0.05);
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
  position: relative;
}

.bu-news-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 38px rgba(10, 27, 84, 0.12);
  border-color: var(--bu-gold);
}

/* Clean Framed Image Box */
.bu-news-card-img-wrap {
  position: relative;
  height: 250px;
  background: #F1F5F9;
  padding: 16px;
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
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transition: transform 0.35s ease;
  image-rendering: -webkit-optimize-contrast;
}

.bu-news-card:hover .bu-news-card-img {
  transform: scale(1.03);
}

/* Image Hover Zoom Overlay */
.bu-news-card-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 27, 84, 0.65);
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
  padding: 9px 16px;
  border-radius: 6px;
  font-size: 12.5px;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  transition: transform 0.2s ease, background 0.2s ease;
}

.bu-news-zoom-btn:hover {
  background: var(--bu-gold);
  color: var(--bu-navy);
  transform: scale(1.04);
}

/* Card Body */
.bu-news-card-body {
  padding: 22px 24px;
  display: flex;
  flex-direction: column;
  flex: 1;
  justify-content: space-between;
}

.bu-news-card-title {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--bu-navy);
  line-height: 1.48;
  margin: 0 0 18px 0;
  min-height: 46px;
  letter-spacing: -0.2px;
}

/* Card Footer: Side-by-Side Badge and Small Action Button */
.bu-news-card-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  margin-top: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 10px;
}

.bu-news-card-badge {
  display: inline-flex;
  align-items: center;
  background: #FFFBEB;
  color: #D97706;
  border: 1px solid #FCD34D;
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 0.6px;
  padding: 5px 10px;
  border-radius: 6px;
  text-transform: uppercase;
  margin: 0;
  white-space: nowrap;
}

.bu-news-btn-small {
  background: var(--bu-navy);
  color: #FFFFFF !important;
  border: none;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 600;
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
  border: 1px dashed var(--bu-border);
  grid-column: 1 / -1;
}

.bu-news-empty i {
  font-size: 44px;
  color: #94A3B8;
  margin-bottom: 16px;
}

.bu-news-empty h3 {
  font-size: 20px;
  color: var(--bu-text-dark);
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
  padding: 18px 24px;
  background: var(--bu-navy);
  color: #FFFFFF;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.bu-modal-title {
  font-size: 16px;
  font-weight: 600;
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
}

.bu-modal-img {
  max-width: 100%;
  max-height: 75vh;
  object-fit: contain;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
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
@media (max-width: 576px) {
  .bu-news-grid {
    grid-template-columns: 1fr;
  }
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
  $page_subtitle = 'Explore official news updates, press releases, newspaper clippings, and academic milestones from Bhabha University.';
  $page_icon     = 'fa-newspaper-o';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'News Media', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <!-- Search & Filter Controls -->
  <div class="bu-news-controls-wrap">
    <div class="bu-news-controls-container">
      <div class="bu-news-controls">
        <div class="bu-news-search-box">
          <i class="fa fa-search search-icon"></i>
          <input type="text" id="buNewsSearchInput" placeholder="Search news headlines..." onkeyup="filterNewsItems()">
        </div>
        <div class="bu-news-count">
          Showing <span id="buNewsVisibleCount">0</span> News Updates
        </div>
      </div>
    </div>
  </div>

  <!-- Main News Grid Section -->
  <div class="bu-news-section">
    <div class="bu-news-container">

      <div class="bu-news-grid" id="buNewsGrid">
        <?php
        $db->orderBy("orders", "desc");
        $news = $db->get('news');
        
        if (is_array($news) && count($news) > 0):
          foreach ($news as $inews):
            $imgUrl = !empty($inews['image']) ? URL_UPLOAD . 'news/' . $inews['image'] : URL_ROOT . 'extra-images/news1.jpg';
            $thumbUrl = !empty($inews['image']) ? URL_UPLOAD . 'news/thumb/' . $inews['image'] : $imgUrl;
            $title = !empty($inews['title']) ? htmlspecialchars($inews['title']) : 'Bhabha University News Update';
        ?>
        <div class="bu-news-card bu-news-item" data-title="<?php echo htmlspecialchars(strtolower($title)); ?>">
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
            <h4 class="bu-news-card-title"><?php echo $title; ?></h4>
            
            <!-- Side-by-Side Badge & Compact Action Button -->
            <div class="bu-news-card-footer">
              <span class="bu-news-card-badge">PRESS COVERAGE</span>
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
function updateNewsCount() {
  var items = document.querySelectorAll('.bu-news-item');
  var visibleCount = 0;
  items.forEach(function(item) {
    if (item.style.display !== 'none') {
      visibleCount++;
    }
  });
  var countEl = document.getElementById('buNewsVisibleCount');
  if (countEl) {
    countEl.textContent = visibleCount;
  }
}

function filterNewsItems() {
  var query = document.getElementById('buNewsSearchInput').value.toLowerCase().trim();
  var items = document.querySelectorAll('.bu-news-item');
  
  items.forEach(function(item) {
    var title = item.getAttribute('data-title') || '';
    if (query === '' || title.indexOf(query) !== -1) {
      item.style.display = '';
    } else {
      item.style.display = 'none';
    }
  });
  
  updateNewsCount();
}

function openNewsModal(imgUrl, titleText) {
  var modal = document.getElementById('buNewsModal');
  var imgEl = document.getElementById('buModalImg');
  var titleEl = document.getElementById('buModalTitle');
  var dlEl = document.getElementById('buModalDl');
  
  imgEl.src = imgUrl;
  titleEl.textContent = titleText;
  dlEl.href = imgUrl;
  
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeNewsModal() {
  var modal = document.getElementById('buNewsModal');
  modal.classList.remove('active');
  document.body.style.overflow = '';
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

// Initialize news count
document.addEventListener('DOMContentLoaded', updateNewsCount);
</script>
</body>
</html>
