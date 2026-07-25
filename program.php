<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('department');

if(!$aryData) {
    header("Location: ".href("course.php"));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['title']);?> - Courses, Intake & Eligibility - Bhabha University Bhopal</title>
<meta name="description" content="Offered courses, intake capacities, and eligibility requirements under <?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-program-list-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 20px;
  margin-top: 20px;
}
.bu-program-card {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 24px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05);
  transition: all 0.28s ease;
  border-left: 4px solid #0A1B54;
}
.bu-program-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 32px rgba(6,29,124,0.12);
  border-left-color: #FFC107;
  text-decoration: none;
}
.bu-program-card h4 {
  font-size: 16px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 12px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.4;
}
.bu-program-card p {
  font-size: 13px;
  color: #6B7280;
  margin-bottom: 16px;
}
.bu-program-link {
  font-size: 11.5px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: auto;
}
.bu-program-card:hover .bu-program-link i {
  transform: translateX(4px);
}
.bu-program-link i {
  transition: transform 0.2s ease;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = htmlspecialchars($aryData['title']);
  $page_subtitle = 'Offered Degree Programs, Seat Intake Capacity & Eligibility Criteria.';
  $page_icon     = 'fa-university';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Courses & Intake', 'url' => href("course.php")],
    ['label' => $aryData['title'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Offered Programs</span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($aryData['title']);?> — <em>Courses &amp; Intake</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-program-list-grid">
          <?php
          $db->where('department', $id);
          $courses = $db->get('course');
          if(is_array($courses) && count($courses) > 0) {
            foreach($courses as $icourse) {
          ?>
          <a href="<?php echo href("eligibility.php", "id=".$icourse['id']);?>" class="bu-program-card">
            <div>
              <h4><?php echo htmlspecialchars($icourse['course']);?></h4>
              <p>Explore seat intake, course duration, stream eligibility, and admission criteria.</p>
            </div>
            <span class="bu-program-link">View Intake &amp; Eligibility <i class="fa fa-arrow-right"></i></span>
          </a>
          <?php
            }
          } else {
            echo '<p style="font-size:14px;color:#6B7280;">No individual courses listed under this department yet. Please check back soon.</p>';
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
