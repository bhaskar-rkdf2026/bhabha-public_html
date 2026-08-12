<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Official Notices &amp; Circulars - Bhabha University Bhopal</title>
  <meta name="description" content="Stay updated with the latest official notices, examination circulars, academic announcements, and administrative notifications from Bhabha University Bhopal.">
  <?php include('inc.meta.php'); ?>

  <style>
  /* ============================================================
     BHABHA UNIVERSITY - NOTICE BOARD & CIRCULARS PAGE
     Theme: Navy #0A1B54  Gold #FFC107  BG #F8FAFC
     ============================================================ */
  .bu-notice-page-wrap {
    background-color: #F8FAFC;
    padding: 70px 20px 90px 20px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1E293B;
    clear: both;
    width: 100%;
    float: left;
    box-sizing: border-box;
  }
  .bu-notice-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* ---- LAYOUT GRID ---- */
  .bu-notice-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 36px;
    align-items: start;
  }

  /* ---- FILTER & SEARCH BAR ---- */
  .bu-notice-header-bar {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 20px 24px;
    margin-bottom: 28px;
    box-shadow: 0 4px 18px rgba(6, 29, 124, 0.04);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
  }
  .bu-notice-tabs {
    display: flex;
    gap: 8px;
    background: #F1F5F9;
    padding: 5px;
    border-radius: 10px;
  }
  .bu-notice-tab-btn {
    padding: 8px 18px;
    font-size: 12.5px;
    font-weight: 700;
    border-radius: 7px;
    border: none;
    background: transparent;
    color: #64748B;
    cursor: pointer;
    transition: all 0.22s ease;
  }
  .bu-notice-tab-btn.active {
    background: #0A1B54;
    color: #FFC107;
    box-shadow: 0 4px 12px rgba(10, 27, 84, 0.15);
  }
  .bu-notice-tab-btn:hover:not(.active) {
    color: #0A1B54;
    background: #E2E8F0;
  }

  .bu-notice-search-box {
    position: relative;
    max-width: 340px;
    width: 100%;
  }
  .bu-notice-search-input {
    width: 100%;
    padding: 10px 16px 10px 40px;
    background: #F8FAFC;
    border: 1px solid #CBD5E1;
    border-radius: 9px;
    font-size: 13px;
    color: #0F172A;
    outline: none;
    transition: all 0.2s ease;
  }
  .bu-notice-search-input:focus {
    border-color: #0A1B54;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.1);
  }
  .bu-notice-search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 13px;
  }

  /* ---- RESULTS COUNTER ---- */
  .bu-notice-counter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-size: 13px;
    color: #64748B;
    font-weight: 600;
  }
  .bu-notice-counter-badge {
    background: #FEF3C7;
    color: #92400E;
    font-weight: 800;
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 20px;
    letter-spacing: 0.5px;
  }

  /* ---- NOTICE CARDS LIST ---- */
  .bu-notice-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }
  .bu-notice-card {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 24px 28px;
    box-shadow: 0 4px 18px rgba(6, 29, 124, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    display: flex;
    align-items: flex-start;
    gap: 22px;
    position: relative;
    overflow: hidden;
  }
  .bu-notice-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    background: #0A1B54;
    transition: background 0.25s ease;
  }
  .bu-notice-card.is-exam::before {
    background: #DC2626; /* Red accent for exam notices */
  }
  .bu-notice-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(6, 29, 124, 0.1);
    border-color: #CBD5E1;
  }
  .bu-notice-card:hover::before {
    background: #FFC107;
  }

  /* Notice Icon Badge */
  .bu-notice-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: rgba(10, 27, 84, 0.07);
    color: #0A1B54;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    transition: all 0.25s ease;
  }
  .bu-notice-card.is-exam .bu-notice-icon-box {
    background: #FEF2F2;
    color: #DC2626;
  }
  .bu-notice-card:hover .bu-notice-icon-box {
    background: #0A1B54;
    color: #FFC107;
  }

  /* Notice Card Content */
  .bu-notice-card-content {
    flex: 1;
  }
  .bu-notice-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
    flex-wrap: wrap;
  }
  .bu-notice-badge {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 5px;
    display: inline-block;
  }
  .bu-notice-badge-gen {
    background: rgba(10, 27, 84, 0.08);
    color: #0A1B54;
  }
  .bu-notice-badge-exam {
    background: #FEF2F2;
    color: #DC2626;
    border: 1px solid #FCA5A5;
  }
  .bu-notice-date {
    font-size: 12px;
    color: #64748B;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .bu-notice-title {
    font-size: 17px;
    font-weight: 700;
    color: #0F172A;
    margin: 0 0 8px 0;
    line-height: 1.45;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .bu-notice-desc {
    font-size: 13.5px;
    color: #475569;
    line-height: 1.6;
    margin: 0 0 14px 0;
  }

  .bu-notice-actions {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .bu-notice-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #0A1B54;
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 7px;
    text-decoration: none !important;
    transition: all 0.22s ease;
  }
  .bu-notice-btn-primary:hover {
    background: #061D7C;
    color: #FFC107;
  }
  .bu-notice-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #F1F5F9;
    color: #334155;
    font-size: 12.5px;
    font-weight: 700;
    padding: 8px 16px;
    border-radius: 7px;
    text-decoration: none !important;
    transition: all 0.22s ease;
  }
  .bu-notice-btn-secondary:hover {
    background: #FFC107;
    color: #0A1B54;
  }

  /* ---- SIDEBAR WIDGETS ---- */
  .bu-notice-sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }
  .bu-sidebar-card {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(6, 29, 124, 0.04);
  }
  .bu-sidebar-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 18px;
    font-weight: 700;
    color: #0A1B54;
    margin: 0 0 16px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #FFC107;
  }

  .bu-contact-helpline-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  .bu-helpline-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }
  .bu-helpline-icon {
    width: 36px;
    height: 36px;
    background: rgba(255, 193, 7, 0.15);
    color: #D99B00;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
  }
  .bu-helpline-info span {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: #64748B;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .bu-helpline-info a {
    font-size: 13.5px;
    font-weight: 700;
    color: #0A1B54;
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .bu-helpline-info a:hover {
    color: #D99B00;
  }

  .bu-alert-box {
    background: linear-gradient(135deg, #051235, #0A1B54);
    color: #ffffff;
    border-radius: 12px;
    padding: 22px;
    text-align: center;
  }
  .bu-alert-box h4 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 17px;
    font-weight: 700;
    color: #FFC107;
    margin: 0 0 8px 0;
  }
  .bu-alert-box p {
    font-size: 12.5px;
    color: rgba(255, 255, 255, 0.75);
    line-height: 1.5;
    margin: 0 0 16px 0;
  }
  .bu-alert-btn {
    display: block;
    width: 100%;
    background: #FFC107;
    color: #0A1B54;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 10px 0;
    border-radius: 6px;
    text-decoration: none !important;
    transition: background 0.2s ease;
  }
  .bu-alert-btn:hover {
    background: #e0a800;
    color: #000;
  }

  /* ---- EMPTY STATE ---- */
  .bu-notice-empty {
    text-align: center;
    padding: 50px 20px;
    background: #ffffff;
    border-radius: 14px;
    border: 1px dashed #CBD5E1;
  }
  .bu-notice-empty i {
    font-size: 42px;
    color: #94A3B8;
    margin-bottom: 12px;
  }
  .bu-notice-empty h4 {
    font-size: 18px;
    color: #0F172A;
    margin: 0 0 6px 0;
  }
  .bu-notice-empty p {
    font-size: 13.5px;
    color: #64748B;
    margin: 0;
  }

  /* ---- RESPONSIVE ---- */
  @media (max-width: 991px) {
    .bu-notice-layout {
      grid-template-columns: 1fr;
    }
  }
  @media (max-width: 575px) {
    .bu-notice-card {
      flex-direction: column;
      align-items: stretch;
      gap: 14px;
    }
    .bu-notice-header-bar {
      flex-direction: column;
      align-items: stretch;
    }
    .bu-notice-search-box {
      max-width: 100%;
    }
  }
  </style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- HERO BANNER -->
  <?php 
  $page_title    = "Official Notices &amp; Circulars";
  $page_subtitle = "Stay informed with official university notifications, academic circulars, examination schedules, and administrative announcements.";
  $page_icon     = "fa-bullhorn";
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Notices & Circulars', 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <!-- MAIN CONTENT AREA -->
  <div class="bu-notice-page-wrap">
    <div class="bu-notice-container">
      
      <div class="bu-notice-layout">
        
        <!-- LEFT COLUMN: NOTICES STREAM -->
        <div class="bu-notice-main">
          
          <!-- SEARCH & TABS BAR -->
          <div class="bu-notice-header-bar">
            <!-- Tabs -->
            <div class="bu-notice-tabs">
              <button class="bu-notice-tab-btn active" onclick="filterCategory('all', this)">All Notices</button>
              <button class="bu-notice-tab-btn" onclick="filterCategory('general', this)">General Academic</button>
              <button class="bu-notice-tab-btn" onclick="filterCategory('exam', this)">Examination</button>
            </div>

            <!-- Search Box -->
            <div class="bu-notice-search-box">
              <i class="fa fa-search bu-notice-search-icon"></i>
              <input type="text" id="noticeSearchInput" class="bu-notice-search-input" placeholder="Search notice title..." onkeyup="searchNotices()">
            </div>
          </div>

          <?php 
          $notices = $db->get('notice');
          $total_count = is_array($notices) ? count($notices) : 0;
          ?>

          <!-- COUNTER BAR -->
          <div class="bu-notice-counter-bar">
            <span>Showing official announcements &amp; circulars</span>
            <span class="bu-notice-counter-badge" id="noticeCountBadge"><?php echo $total_count; ?> Active Notices</span>
          </div>

          <!-- NOTICES CARDS CONTAINER -->
          <div class="bu-notice-list" id="noticeListContainer">
            <?php 
            if(is_array($notices) && count($notices) > 0) {
              foreach($notices as $inotice) {
                $title = !empty($inotice['title']) ? $inotice['title'] : 'University Official Notice';
                $desc  = !empty($inotice['description']) ? $inotice['description'] : '';
                $image = !empty($inotice['image']) ? $inotice['image'] : '';
                $is_exam = isset($inotice['is_examination']) && $inotice['is_examination'] == 1;
                $category_key = $is_exam ? 'exam' : 'general';
                $file_url = !empty($image) ? URL_UPLOAD . 'notice/' . $image : '';
                $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                $is_pdf = ($ext === 'pdf');
            ?>

            <div class="bu-notice-card <?php echo $is_exam ? 'is-exam' : ''; ?>" data-category="<?php echo $category_key; ?>" data-title="<?php echo htmlspecialchars(strtolower($title)); ?>">
              
              <!-- Icon -->
              <div class="bu-notice-icon-box">
                <i class="fa <?php echo $is_exam ? 'fa-pencil-square-o' : ($is_pdf ? 'fa-file-pdf-o' : 'fa-bullhorn'); ?>"></i>
              </div>

              <!-- Content -->
              <div class="bu-notice-card-content">
                <div class="bu-notice-card-header">
                  <span class="bu-notice-badge <?php echo $is_exam ? 'bu-notice-badge-exam' : 'bu-notice-badge-gen'; ?>">
                    <?php echo $is_exam ? 'EXAMINATION CIRCULAR' : 'GENERAL NOTICE'; ?>
                  </span>
                  <span class="bu-notice-date">
                    <i class="fa fa-calendar-o"></i> Latest Update
                  </span>
                </div>

                <h3 class="bu-notice-title"><?php echo htmlspecialchars($title); ?></h3>

                <?php if(!empty($desc)): ?>
                  <p class="bu-notice-desc"><?php echo nl2br(htmlspecialchars(strip_tags($desc))); ?></p>
                <?php endif; ?>

                <div class="bu-notice-actions">
                  <?php if(!empty($file_url)): ?>
                    <a href="<?php echo $file_url; ?>" target="_blank" class="bu-notice-btn-primary">
                      <i class="fa <?php echo $is_pdf ? 'fa-file-pdf-o' : 'fa-external-link'; ?>"></i> View Circular
                    </a>
                    <a href="<?php echo $file_url; ?>" download target="_blank" class="bu-notice-btn-secondary">
                      <i class="fa fa-download"></i> Download
                    </a>
                  <?php else: ?>
                    <span class="bu-notice-btn-secondary" style="cursor:default;"><i class="fa fa-info-circle"></i> Official Notification</span>
                  <?php endif; ?>
                </div>
              </div>

            </div>

            <?php 
              }
            } else {
            ?>
              <!-- EMPTY STATE -->
              <div class="bu-notice-empty">
                <i class="fa fa-bell-slash-o"></i>
                <h4>No Notices Found</h4>
                <p>There are currently no active notices or circulars listed at this time.</p>
              </div>
            <?php } ?>
          </div>

          <!-- HIDDEN NO SEARCH RESULTS BOX -->
          <div id="noNoticeSearchResult" class="bu-notice-empty" style="display:none; margin-top:20px;">
            <i class="fa fa-search"></i>
            <h4>No Matching Notices</h4>
            <p>No announcements found matching your search query. Try searching another keyword.</p>
          </div>

        </div>

        <!-- RIGHT COLUMN: SIDEBAR WIDGETS -->
        <div class="bu-notice-sidebar">
          
          <!-- HELPLINE CARD -->
          <div class="bu-sidebar-card">
            <h4 class="bu-sidebar-title">Important Helplines</h4>
            <div class="bu-contact-helpline-list">
              <div class="bu-helpline-item">
                <div class="bu-helpline-icon"><i class="fa fa-phone"></i></div>
                <div class="bu-helpline-info">
                  <span>Admission Helpline</span>
                  <a href="tel:+919165025500">+91 91650 25500</a>
                </div>
              </div>
              <div class="bu-helpline-item">
                <div class="bu-helpline-icon"><i class="fa fa-graduation-cap"></i></div>
                <div class="bu-helpline-info">
                  <span>Examination Cell</span>
                  <a href="mailto:exam@bhabhauniversity.edu.in">exam@bhabhauniversity.edu.in</a>
                </div>
              </div>
              <div class="bu-helpline-item">
                <div class="bu-helpline-icon"><i class="fa fa-envelope-o"></i></div>
                <div class="bu-helpline-info">
                  <span>Registrar Office</span>
                  <a href="mailto:info@bhabhauniversity.edu.in">info@bhabhauniversity.edu.in</a>
                </div>
              </div>
            </div>
          </div>


          <!-- QUICK LINKS -->
          <div class="bu-sidebar-card">
            <h4 class="bu-sidebar-title">Quick Portals</h4>
            <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px;">
              <li><a href="<?php echo href('course.php');?>" style="color:#0A1B54; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa fa-angle-right" style="color:#FFC107; margin-right:6px;"></i> Academic Programs</a></li>
              <li><a href="<?php echo href('news.php');?>" style="color:#0A1B54; font-size:13px; font-weight:700; text-decoration:none;"><i class="fa fa-angle-right" style="color:#FFC107; margin-right:6px;"></i> Press Coverage &amp; Media</a></li>
            </ul>
          </div>

        </div>

      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>

<!-- JAVASCRIPT FOR CATEGORY FILTER & SEARCH -->
<script>
var currentCategory = 'all';

function filterCategory(cat, btn) {
  currentCategory = cat;
  
  // Update Tab active styling
  document.querySelectorAll('.bu-notice-tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  searchNotices();
}

function searchNotices() {
  var input = document.getElementById('noticeSearchInput').value.toLowerCase().trim();
  var cards = document.querySelectorAll('.bu-notice-card');
  var visibleCount = 0;

  cards.forEach(function(card) {
    var title = card.getAttribute('data-title') || '';
    var cat = card.getAttribute('data-category') || '';

    var matchesCat = (currentCategory === 'all') || (cat === currentCategory);
    var matchesSearch = (input === '') || (title.indexOf(input) !== -1);

    if (matchesCat && matchesSearch) {
      card.style.display = 'flex';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Update counter
  document.getElementById('noticeCountBadge').innerText = visibleCount + ' Active Notices';

  // Toggle no results box
  var noResultBox = document.getElementById('noNoticeSearchResult');
  if (visibleCount === 0 && cards.length > 0) {
    noResultBox.style.display = 'block';
  } else {
    noResultBox.style.display = 'none';
  }
}
</script>

<?php include('inc.footer.js.php'); ?>
</body>
</html>
