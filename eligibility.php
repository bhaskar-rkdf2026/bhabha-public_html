<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('course');

if(!$aryData) {
    header("Location: ".href("course.php"));
    exit;
}

$db->where('id', $aryData['department']);
$department = $db->getOne('department');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['course']);?> - Intake & Eligibility - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['course']);?> eligibility criteria, seat intake capacity, duration, and admission requirements at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Styled Table Content for Eligibility */
.bu-content-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  font-size: 14px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05) !important;
}
.bu-content-body table th {
  background: #0A1B54 !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
  padding: 14px 18px !important;
  text-align: left !important;
  border-bottom: 2px solid #061D7C !important;
}
.bu-content-body table td {
  padding: 14px 18px !important;
  border-bottom: 1px solid #E5E7EB !important;
  color: #374151 !important;
  line-height: 1.6 !important;
}
.bu-content-body table tr:nth-child(even) {
  background: #F8FAFC !important;
}
.bu-content-body table tr:hover {
  background: #F1F5F9 !important;
}
.bu-content-body table th,
.bu-content-body table td {
  word-break: normal !important;
}
.bu-content-body table th:nth-child(1),
.bu-content-body table td:nth-child(1) {
  min-width: 150px !important;
}
.bu-content-body table th:nth-child(2),
.bu-content-body table td:nth-child(2) {
  min-width: 200px !important;
}

.bu-cta-box {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 10px;
  padding: 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-top: 30px;
  flex-wrap: wrap;
}
.bu-cta-box h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 6px 0;
}
.bu-cta-box p {
  font-size: 13.5px;
  color: rgba(255,255,255,0.75);
  margin: 0;
}
.bu-btn-apply {
  background: #FFC107;
  color: #0A1B54;
  font-weight: 800;
  font-size: 13.5px;
  padding: 14px 28px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.25s ease;
  flex-shrink: 0;
}
.bu-btn-apply:hover {
  background: #ffffff;
  color: #061D7C;
  transform: translateY(-2px);
  text-decoration: none;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = htmlspecialchars($aryData['course']);
  $page_subtitle = 'Course details, seat intake, duration, and entry eligibility criteria.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Courses & Intake', 'url' => href("course.php")],
    ['label' => isset($department['title']) ? $department['title'] : 'School', 'url' => isset($department['id']) ? href("program.php", "id=".$department['id']) : '#'],
    ['label' => $aryData['course'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Academic Specifications</span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($aryData['course']);?> — <em>Intake &amp; Eligibility</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php 
          if(!empty($aryData['details'])) {
              echo $aryData['details'];
          } else {
              echo '<p style="font-size:14px;color:#6B7280;">Eligibility details for this program are being updated. Please contact the admission helpline for instant assistance.</p>';
          }
          ?>
        </div>

        <!-- Quick Apply Callout Banner -->
        <div class="bu-cta-box">
          <div>
            <h3>Ready to Join <?php echo htmlspecialchars($aryData['course']);?>?</h3>
            <p>Submit your admission enquiry online to get connected with our faculty advisors.</p>
          </div>
          <a href="<?php echo href("enquiry.php");?>" class="bu-btn-apply">Apply For Admission <i class="fa fa-arrow-right" style="margin-left:6px;"></i></a>
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
