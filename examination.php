<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Examination Notice - Bhabha University Bhopal</title>
<meta name="description" content="Official examination notices, exam postponements, rescheduled timetable alerts, and circulars from Controller of Examinations at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Search Bar Filter */
.bu-search-filter-box {
  position: relative;
  margin: 24px 0 30px;
}
.bu-search-input {
  width: 100%;
  padding: 14px 20px 14px 48px;
  font-size: 15px;
  border: 1px solid #D1D5DB;
  border-radius: 8px;
  background: #F8FAFC;
  color: #1E293B;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-search-input:focus {
  outline: none;
  border-color: #0A1B54;
  background: #ffffff;
  box-shadow: 0 0 0 4px rgba(10,27,84,0.1);
}
.bu-search-icon {
  position: absolute;
  left: 18px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748B;
  font-size: 16px;
}

/* Notice Cards List */
.bu-notice-list {
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.bu-notice-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-left: 5px solid #D97706;
  border-radius: 10px;
  padding: 22px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  transition: all 0.25s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.bu-notice-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(10,27,84,0.1);
  border-color: #CBD5E1;
  border-left-color: #0A1B54;
}
.bu-notice-info {
  display: flex;
  align-items: flex-start;
  gap: 18px;
  flex: 1;
}
.bu-notice-badge {
  width: 50px;
  height: 50px;
  border-radius: 8px;
  background: rgba(217, 119, 6, 0.1);
  color: #D97706;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.bu-notice-title {
  font-size: 16px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 6px 0;
  line-height: 1.45;
}
.bu-notice-date {
  font-size: 12.5px;
  color: #64748B;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-weight: 500;
}

/* Download Button */
.bu-dl-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #0A1B54;
  color: #FFC107;
  font-weight: 700;
  font-size: 13px;
  padding: 10px 22px;
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.2s ease;
  white-space: nowrap;
  flex-shrink: 0;
}
.bu-dl-btn:hover {
  background: #061D7C;
  color: #ffffff;
  text-decoration: none;
  box-shadow: 0 4px 14px rgba(10,27,84,0.25);
}

.bu-contact-box {
  background: #0A1B54;
  color: #ffffff;
  border-radius: 12px;
  padding: 28px;
  margin-top: 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
}
.bu-contact-text h4 {
  color: #FFC107;
  font-size: 18px;
  font-weight: 700;
  margin: 0 0 8px 0;
}
.bu-contact-text p {
  color: rgba(255,255,255,0.85);
  font-size: 13.5px;
  margin: 0;
  line-height: 1.6;
}

.bu-no-data {
  text-align: center;
  padding: 40px 20px;
  background: #F8FAFC;
  border-radius: 8px;
  color: #64748B;
  font-size: 14.5px;
}

@media (max-width: 768px) {
  .bu-notice-card {
    flex-direction: column;
    align-items: flex-start;
  }
  .bu-dl-btn {
    width: 100%;
    justify-content: center;
  }
  .bu-contact-box {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Examination <em>Notices</em>';
  $page_subtitle = 'Official notifications, exam postponements, rescheduling alerts, and Controller of Examination circulars.';
  $page_icon     = 'fa-bullhorn';
  $breadcrumbs   = [
    ['label' => 'Home',        'url' => URL_ROOT],
    ['label' => 'Examination', 'url' => '#'],
    ['label' => 'Examination Notice', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Official Circulars</span>
        <h2 class="bu-content-h2">Examination Notices &amp; <em>Alerts</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter / Search Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="noticeSearchInput" class="bu-search-input" placeholder="Search notice by title, keyword or date (e.g., Nursing, Rescheduling, June 2026)..." onkeyup="filterNotices()">
        </div>

        <!-- Examination Notices Cards List -->
        <div class="bu-notice-list" id="noticeList">
          <?php
          $db->where('is_examination', 1);
          $notice = $db->get('notice');
          if(is_array($notice) && count($notice) > 0) {
            foreach($notice as $inotice) {
              $title = htmlspecialchars($inotice['title']);
              $pdf_url = URL_UPLOAD . 'notice/' . htmlspecialchars($inotice['image']);
              $date_formatted = !empty($inotice['date']) ? date('M d, Y', strtotime($inotice['date'])) : 'Latest Notice';
          ?>
          <div class="bu-notice-card notice-item">
            <div class="bu-notice-info">
              <div class="bu-notice-badge">
                <i class="fa fa-bell"></i>
              </div>
              <div>
                <h3 class="bu-notice-title"><?php echo $title;?></h3>
                <div class="bu-notice-date">
                  <i class="fa fa-calendar" style="color:#D97706;"></i> <?php echo $date_formatted;?> &bull; <span style="background:#FEF3C7;color:#92400E;padding:2px 8px;border-radius:4px;font-size:11.5px;font-weight:700;">Examination Dept</span>
                </div>
              </div>
            </div>
            <a target="_blank" href="<?php echo $pdf_url;?>" class="bu-dl-btn">
              <i class="fa fa-file-pdf-o"></i> View Notice PDF
            </a>
          </div>
          <?php
            }
          } else {
            echo '<div class="bu-no-data"><i class="fa fa-info-circle" style="font-size:24px;margin-bottom:8px;display:block;"></i>No examination notices published currently. Please check back later.</div>';
          }
          ?>
        </div>

        <!-- Helpdesk & Contact Section -->
        <div class="bu-contact-box">
          <div class="bu-contact-text">
            <h4><i class="fa fa-phone" style="margin-right:8px;"></i> Controller of Examination Helpdesk</h4>
            <p>For urgent queries regarding exam schedules, admit cards, or result discrepancies, visit the Examination Cell at Bhabha University Campus or contact us directly.</p>
          </div>
          <a href="<?php echo URL_ROOT;?>page.php?id=24" class="bu-dl-btn" style="background:#FFC107;color:#0A1B54;">
            <i class="fa fa-envelope-o"></i> Contact Exam Cell
          </a>
        </div>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>

<script>
function filterNotices() {
  var input = document.getElementById("noticeSearchInput");
  var filter = input.value.toLowerCase();
  var items = document.getElementsByClassName("notice-item");
  
  for (var i = 0; i < items.length; i++) {
    var text = items[i].innerText.toLowerCase();
    if (text.indexOf(filter) > -1) {
      items[i].style.display = "flex";
    } else {
      items[i].style.display = "none";
    }
  }
}
</script>
</body>
</html>
