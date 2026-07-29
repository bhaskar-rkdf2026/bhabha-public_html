<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Previous Year Question Papers - Bhabha University Bhopal</title>
<meta name="description" content="Download previous year semester exam question papers and question banks across Art, Engineering, Pharmacy, Dental, Law, Management, Agriculture, and Science departments at Bhabha University Bhopal.">
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
  margin: 24px 0 32px;
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

/* Department Grid */
.bu-qp-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 24px;
}
.bu-qp-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-left: 4px solid #0A1B54;
  border-radius: 12px;
  padding: 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-decoration: none;
  transition: all 0.25s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.bu-qp-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgba(10,27,84,0.12);
  border-color: #0A1B54;
  border-left-color: #FFC107;
  text-decoration: none;
}

.bu-qp-info {
  display: flex;
  align-items: center;
  gap: 16px;
}
.bu-qp-icon-badge {
  width: 52px;
  height: 52px;
  border-radius: 10px;
  background: rgba(10,27,84,0.06);
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
  transition: all 0.25s ease;
}
.bu-qp-card:hover .bu-qp-icon-badge {
  background: #0A1B54;
  color: #FFC107;
}

.bu-qp-title {
  font-size: 16px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 2px 0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-qp-sub {
  font-size: 12.5px;
  color: #64748B;
  margin: 0;
  font-weight: 500;
}

.bu-qp-arrow {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #F1F5F9;
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  flex-shrink: 0;
  transition: all 0.25s ease;
}
.bu-qp-card:hover .bu-qp-arrow {
  background: #FFC107;
  color: #0A1B54;
  transform: translateX(4px);
}

/* Info Note Card */
.bu-guide-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 24px;
  margin-top: 40px;
}
.bu-guide-box h4 {
  color: #0A1B54;
  font-size: 16px;
  font-weight: 700;
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-guide-box p {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 575px) {
  .bu-qp-grid {
    grid-template-columns: 1fr;
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
  $page_title    = 'Previous Year <em>Question Papers</em>';
  $page_subtitle = 'Access department-wise exam question papers and question banks for undergraduate and postgraduate courses.';
  $page_icon     = 'fa-file-text-o';
  $breadcrumbs   = [
    ['label' => 'Home',        'url' => URL_ROOT],
    ['label' => 'Examination', 'url' => '#'],
    ['label' => 'Question Papers', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Academic Repository</span>
        <h2 class="bu-content-h2">Explore Question Papers by <em>Department</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Filter / Search Box -->
        <div class="bu-search-filter-box">
          <i class="fa fa-search bu-search-icon"></i>
          <input type="text" id="qpSearchInput" class="bu-search-input" placeholder="Search department (e.g., Engineering, Law, Pharmacy, Management, Agriculture)..." onkeyup="filterDepartments()">
        </div>

        <!-- Department Cards Grid -->
        <div class="bu-qp-grid" id="qpGrid">
          
          <!-- 1. Art -->
          <a href="<?php echo href('BUQuestionPapers.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-paint-brush"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Art</h3>
                <p class="bu-qp-sub">BA &amp; MA Question Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 2. Agriculture -->
          <a href="<?php echo href('BUQuestionPapersBscDipAg.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-leaf"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Agriculture</h3>
                <p class="bu-qp-sub">B.Sc &amp; Diploma Agriculture</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 3. Commerce -->
          <a href="<?php echo href('BUQuestionPapersBcomMcom.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-briefcase"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Commerce</h3>
                <p class="bu-qp-sub">B.Com &amp; M.Com Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 4. Computer Applications -->
          <a href="<?php echo href('BUQuestionPapers_computer applications.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-laptop"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Computer Applications</h3>
                <p class="bu-qp-sub">BCA &amp; MCA Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 5. Dental -->
          <a href="<?php echo href('BUQuestionPapers_dental.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-hospital-o"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Dental</h3>
                <p class="bu-qp-sub">BDS &amp; MDS Exam Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 6. Engineering -->
          <a href="<?php echo href('BUQuestionPapers_engineering.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-cogs"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Engineering</h3>
                <p class="bu-qp-sub">B.Tech, M.Tech &amp; Diploma</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 7. Education -->
          <a href="<?php echo href('BUQuestionPapers_education.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Education</h3>
                <p class="bu-qp-sub">B.Ed &amp; D.El.Ed Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 8. Hotel Management -->
          <a href="<?php echo href('BUQuestionPapers_hotelmgmt.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-cutlery"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Hotel Management</h3>
                <p class="bu-qp-sub">BHMCT &amp; Diploma Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 9. Law -->
          <a href="<?php echo href('BUQuestionPapers_Law.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-gavel"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Law</h3>
                <p class="bu-qp-sub">LL.B &amp; BA LL.B Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 10. Management -->
          <a href="<?php echo href('BUQuestionPapers_management.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-line-chart"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Management</h3>
                <p class="bu-qp-sub">BBA &amp; MBA Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 11. Pharmacy -->
          <a href="<?php echo href('BUQuestionPapers_pharmacy.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-medkit"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Pharmacy</h3>
                <p class="bu-qp-sub">B.Pharm &amp; D.Pharm Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

          <!-- 12. Science -->
          <a href="<?php echo href('BUQuestionPapers_Science.php');?>" class="bu-qp-card qp-item">
            <div class="bu-qp-info">
              <div class="bu-qp-icon-badge">
                <i class="fa fa-flask"></i>
              </div>
              <div>
                <h3 class="bu-qp-title">Science</h3>
                <p class="bu-qp-sub">B.Sc &amp; M.Sc Papers</p>
              </div>
            </div>
            <div class="bu-qp-arrow">
              <i class="fa fa-arrow-right"></i>
            </div>
          </a>

        </div>

        <!-- Guide Box -->
        <div class="bu-guide-box">
          <h4><i class="fa fa-info-circle" style="color:#0A1B54;"></i> Access Instructions:</h4>
          <p>Select your department above to browse previous year semester examination question papers. The question papers are provided in PDF format for student practice and revision purposes. If your course is not listed, please contact the Central Library or Department Coordinator.</p>
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
function filterDepartments() {
  var input = document.getElementById("qpSearchInput");
  var filter = input.value.toLowerCase();
  var items = document.getElementsByClassName("qp-item");
  
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
