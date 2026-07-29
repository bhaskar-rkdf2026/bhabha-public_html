<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('institute');

if(!$aryData) {
    header("Location: ".URL_ROOT);
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
<title><?php echo htmlspecialchars($aryData['institute_name']);?> - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['institute_name']);?> at Bhabha University Bhopal. Explore programs, faculty, labs and opportunities.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}
.bu-inst-quote-box {
  background: #F8FAFC;
  border-left: 4px solid #FFC107;
  padding: 24px 28px;
  border-radius: 0 8px 8px 0;
  margin: 16px 0;
  font-style: italic;
  color: #374151;
}
.bu-dept-list-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 16px;
  margin: 16px 0;
}
.bu-dept-item {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 6px;
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
  box-shadow: 0 2px 10px rgba(6,29,124,0.04);
  transition: all 0.25s ease;
}
.bu-dept-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(6,29,124,0.1);
  border-color: #FFC107;
  text-decoration: none;
}
.bu-dept-item i {
  color: #D99B00;
  font-size: 14px;
}
.bu-dept-item strong {
  font-size: 13.5px;
  color: #061D7C;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = $aryData['institute_name'];
  $page_subtitle = 'Providing transformative, high-quality education and career preparation under Bhabha University.';
  $page_icon     = 'fa-university';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => isset($department['title']) ? $department['title'] : 'School', 'url' => isset($department['id']) ? href("department.php","id=".$department['id']) : '#'],
    ['label' => $aryData['institute_name'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <!-- About Institute Card -->
      <div class="bu-content-card">
        <span class="bu-content-label">Institute Overview</span>
        <h2 class="bu-content-h2"><?php echo $aryData['institute_name'];?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php echo $aryData['about_institute'];?>
        </div>
      </div>

      <!-- Principal Message Card (if available) -->
      <?php if(!empty($aryData['principal_message'])): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Leadership</span>
        <h2 class="bu-content-h2">Principal's <em>Message</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-inst-quote-box">
          <?php echo $aryData['principal_message'];?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Courses & Branches Card -->
      <?php if(!empty($aryData['courses']) || !empty($aryData['branches'])): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Academic Programs</span>
        <h2 class="bu-content-h2">Courses &amp; <em>Branches</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php if(!empty($aryData['courses'])): ?>
            <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin-bottom:10px;">Offered Courses</h4>
            <?php echo $aryData['courses'];?>
          <?php endif; ?>
          
          <?php if(!empty($aryData['branches'])): ?>
            <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin:20px 0 10px 0;">Specializations &amp; Branches</h4>
            <?php echo $aryData['branches'];?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Departments Card -->
      <?php
      $db->where('institute', $id);
      $sub_department = $db->get('sub_department');
      if((is_array($sub_department) && count($sub_department)>0) || !empty($aryData['departments'])): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Academic Units</span>
        <h2 class="bu-content-h2">Departments &amp; <em> Wings</em></h2>
        <div class="bu-content-divider"></div>
        <?php if(is_array($sub_department) && count($sub_department)>0): ?>
          <div class="bu-dept-list-grid">
            <?php foreach($sub_department as $isub_department): ?>
              <a href="<?php echo href("departments.php","id=".$isub_department['id']);?>" class="bu-dept-item">
                <i class="fa fa-folder-open"></i>
                <strong><?php echo $isub_department['title'];?></strong>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        
        <?php if(!empty($aryData['departments'])): ?>
          <div class="bu-content-body" style="margin-top:14px;">
            <?php echo $aryData['departments'];?>
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <!-- Activities & Placement Card -->
      <?php if(!empty($aryData['activities']) || !empty($aryData['placement'])): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Student Success</span>
        <h2 class="bu-content-h2">Activities &amp; <em>Placements</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php if(!empty($aryData['activities'])): ?>
            <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin-bottom:10px;">Co-Curricular Activities</h4>
            <?php echo $aryData['activities'];?>
          <?php endif; ?>

          <?php if(!empty($aryData['placement'])): ?>
            <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin:20px 0 10px 0;">Career &amp; Placements</h4>
            <?php echo $aryData['placement'];?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
