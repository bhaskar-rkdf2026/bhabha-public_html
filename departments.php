<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('sub_department');
if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}

$institute = null;
$department = null;
if (!empty($aryData['institute'])) {
    $db->where('id', $aryData['institute']);
    $institute = $db->getOne('institute');
    if ($institute && !empty($institute['department'])) {
        $db->where('id', $institute['department']);
        $department = $db->getOne('department');
    }
}

$sub_approval_tag = !empty($aryData['approval_tag']) ? $aryData['approval_tag'] : (!empty($institute['approval_tag']) ? $institute['approval_tag'] : (!empty($department['approval_tag']) ? $department['approval_tag'] : 'UGC / Recognized'));
$sub_affiliation_tag = !empty($aryData['affiliation_tag']) ? $aryData['affiliation_tag'] : (!empty($institute['institute_name']) ? $institute['institute_name'] : 'Bhabha University Bhopal');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['title']);?> - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal. Explore department academic details, curriculum and facilities.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}
.bu-dept-badge-row {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 14px;
}
.bu-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}
.bu-badge-gold {
  background: rgba(255, 193, 7, 0.15);
  color: #B45309;
  border: 1px solid rgba(255, 193, 7, 0.35);
}
.bu-badge-navy {
  background: rgba(6, 29, 124, 0.08);
  color: #061D7C;
  border: 1px solid rgba(6, 29, 124, 0.2);
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = $aryData['title'];
  $page_subtitle = 'Academic department offering specialized courses, research labs, and hands-on practical training.';
  $page_icon     = 'fa-folder-open';
  $breadcrumbs   = [
    ['label' => 'Home',    'url' => URL_ROOT],
    ['label' => 'Institutes', 'url' => href('institutes.php')],
    ['label' => $aryData['title'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>
      <div class="bu-content-card">
        <span class="bu-content-label">Department Details</span>
        <div class="bu-dept-badge-row">
          <span class="bu-badge bu-badge-gold"><i class="fa fa-certificate"></i> <?php echo htmlspecialchars($sub_approval_tag); ?></span>
          <span class="bu-badge bu-badge-navy"><i class="fa fa-university"></i> <?php echo htmlspecialchars($sub_affiliation_tag); ?></span>
        </div>
        <h2 class="bu-content-h2"><?php echo $aryData['title'];?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php echo $aryData['content'];?>
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
