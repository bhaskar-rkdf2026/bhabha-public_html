<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Courses, Intake & Eligibility - Bhabha University Bhopal</title>
<meta name="description" content="Explore programs offered by Bhabha University Bhopal — Courses, seat intake capacity, eligibility criteria across Engineering, Pharmacy, Management, Dental, Science and Nursing.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
  margin-top: 20px;
}
.bu-course-card {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 10px;
  padding: 28px 24px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  gap: 14px;
  box-shadow: 0 4px 18px rgba(6,29,124,0.05);
  transition: all 0.28s ease;
  border-top: 4px solid #0A1B54;
}
.bu-course-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 18px 36px rgba(6,29,124,0.12);
  border-top-color: #FFC107;
  text-decoration: none;
}
.bu-course-icon {
  width: 52px; height: 52px;
  background: rgba(10,27,84,0.07);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 22px;
  color: #0A1B54;
  transition: all 0.28s ease;
}
.bu-course-card:hover .bu-course-icon {
  background: #0A1B54;
  color: #FFC107;
}
.bu-course-card h4 {
  font-size: 17px;
  font-weight: 700;
  color: #061D7C;
  margin: 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.35;
}
.bu-course-card p {
  font-size: 13px;
  line-height: 1.6;
  color: #6B7280;
  margin: 0;
}
.bu-course-btn {
  font-size: 11.5px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: auto;
}
.bu-course-btn i {
  transition: transform 0.2s ease;
}
.bu-course-card:hover .bu-course-btn i {
  transform: translateX(4px);
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Courses, Intake &amp; <em>Eligibility</em>';
  $page_subtitle = 'Detailed information about academic programs, seat intake capacity, and entry requirements across all faculties.';
  $page_icon     = 'fa-book';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Admissions', 'url' => '#'],
    ['label' => 'Courses & Intake', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Academic Programs</span>
        <h2 class="bu-content-h2">Select School to View <em>Courses &amp; Eligibility</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-course-grid">
          <?php
          $department = $db->get('department');
          if(is_array($department) && count($department) > 0) {
            foreach($department as $idepartment) {
              $icon = !empty($idepartment['icon']) ? $idepartment['icon'] : 'fa-university';
          ?>
          <a href="<?php echo href("program.php", "id=".$idepartment['id']);?>" class="bu-course-card">
            <div class="bu-course-icon">
              <i class="<?php echo $icon;?>"></i>
            </div>
            <h4><?php echo $idepartment['title'];?></h4>
            <p>Explore undergraduate, postgraduate, diploma, and Ph.D. degree courses, seat matrix, and admission criteria.</p>
            <span class="bu-course-btn">View Courses &amp; Eligibility <i class="fa fa-arrow-right"></i></span>
          </a>
          <?php
            }
          }
          ?>
        </div>
      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
