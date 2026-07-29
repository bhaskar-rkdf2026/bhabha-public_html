<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exam Time Table - Bhabha University Bhopal</title>
<meta name="description" content="Official semester examination schedules, datesheets, and session timetables for all undergraduate, postgraduate, and diploma programs at Bhabha University Bhopal.">
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

/* Timetable Cards List */
.bu-tt-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.bu-tt-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-left: 5px solid #0A1B54;
  border-radius: 10px;
  padding: 20px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  transition: all 0.25s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.bu-tt-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(10,27,84,0.1);
  border-color: #CBD5E1;
  border-left-color: #FFC107;
}
.bu-tt-info {
  display: flex;
  align-items: center;
  gap: 16px;
  flex: 1;
}
.bu-pdf-badge {
  width: 46px;
  height: 46px;
  border-radius: 8px;
  background: rgba(220, 38, 38, 0.08);
  color: #DC2626;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.bu-tt-title {
  font-size: 15.5px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 4px 0;
  line-height: 1.45;
}
.bu-tt-tag {
  font-size: 12px;
  font-weight: 600;
  color: #64748B;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.bu-tt-tag span {
  background: #F1F5F9;
  color: #334155;
  padding: 2px 8px;
  border-radius: 4px;
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

/* Notice Box */
.bu-info-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 24px;
  margin-top: 40px;
}
.bu-info-box h4 {
  color: #0A1B54;
  font-size: 16px;
  font-weight: 700;
  margin: 0 0 12px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-info-box ul {
  margin: 0;
  padding-left: 20px;
  color: #475569;
  font-size: 13.5px;
  line-height: 1.7;
}

.bu-no-data {
  text-align: center;
  padding: 40px 20px;
  background: #F8FAFC;
  border-radius: 8px;
  color: #64748B;
  font-size: 14.5px;
}

@media (max-width: 640px) {
  .bu-tt-card {
    flex-direction: column;
    align-items: flex-start;
  }
  .bu-dl-btn {
    width: 100%;
    justify-content: center;
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
  $page_title    = 'Exam <em>Time Table</em>';
  $page_subtitle = 'Official semester examination schedules, datesheets, and session timetables for all departments.';
  $page_icon     = 'fa-calendar-check-o';
  $breadcrumbs   = [
    ['label' => 'Home',        'url' => URL_ROOT],
    ['label' => 'Examination', 'url' => '#'],
    ['label' => 'Exam Time Table', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Academic Examinations</span>
        <h2 class="bu-content-h2">Exam Schedule &amp; <em>Time Table</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter / Search Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="ttSearchInput" class="bu-search-input" placeholder="Search timetable by course, branch, semester or session (e.g., B.Tech, MBA, Diploma, 2025)..." onkeyup="filterTimetables()">
        </div>

        <!-- Timetable Cards List -->
        <div class="bu-tt-list" id="ttList">
          <?php
          $timetable = $db->get('timetable');
          if(is_array($timetable) && count($timetable) > 0) {
            foreach($timetable as $itimetable) {
              $title = htmlspecialchars($itimetable['title']);
              $pdf_url = URL_UPLOAD . 'timetable/' . htmlspecialchars($itimetable['image']);
          ?>
          <div class="bu-tt-card tt-item">
            <div class="bu-tt-info">
              <div class="bu-pdf-badge">
                <i class="fa fa-file-pdf-o"></i>
              </div>
              <div>
                <h3 class="bu-tt-title"><?php echo $title;?></h3>
                <div class="bu-tt-tag">
                  <i class="fa fa-tag"></i> <span>Official Notification</span>
                </div>
              </div>
            </div>
            <a target="_blank" href="<?php echo $pdf_url;?>" class="bu-dl-btn">
              <i class="fa fa-download"></i> Download PDF
            </a>
          </div>
          <?php
            }
          } else {
            echo '<div class="bu-no-data"><i class="fa fa-info-circle" style="font-size:24px;margin-bottom:8px;display:block;"></i>No exam timetable published currently. Please check back later.</div>';
          }
          ?>
        </div>

        <!-- Important Guidelines Box -->
        <div class="bu-info-box">
          <h4><i class="fa fa-exclamation-triangle" style="color:#D97706;"></i> Important Exam Guidelines for Students:</h4>
          <ul>
            <li>Students must carry their official <strong>Admit Card / Hall Ticket</strong> along with University Photo ID card to the examination hall.</li>
            <li>Please reach the examination center at least <strong>30 minutes prior</strong> to the scheduled time.</li>
            <li>Mobile phones, electronic gadgets, programmable calculators, and smartwatches are strictly prohibited inside examination rooms.</li>
            <li>In case of any discrepancy in timetable dates or course codes, immediately contact the <strong>Controller of Examinations Office</strong>.</li>
          </ul>
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
function filterTimetables() {
  var input = document.getElementById("ttSearchInput");
  var filter = input.value.toLowerCase();
  var items = document.getElementsByClassName("tt-item");
  
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
