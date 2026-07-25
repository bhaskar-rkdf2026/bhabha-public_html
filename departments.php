<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('sub_department');
if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}
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
    ['label' => 'Schools', 'url' => href('faculties.php')],
    ['label' => $aryData['title'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>
      <div class="bu-content-card">
        <span class="bu-content-label">Department Details</span>
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
