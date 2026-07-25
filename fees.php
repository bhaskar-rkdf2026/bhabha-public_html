<?php include('config.php');
$aryFormAbout = $db->get("fees");
$aryAbout = array();
if(!is_null($aryFormAbout) && is_array($aryFormAbout) && count($aryFormAbout) > 0)
{			
	foreach($aryFormAbout as $iAbout)
	{
		$aryAbout[$iAbout['field']] = $iAbout['value'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fees Structure - Bhabha University Bhopal</title>
<meta name="description" content="Fee structure for undergraduate, postgraduate, diploma and doctoral courses at Bhabha University Bhopal. Transparent and approved fee schedules.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Styled Fee Table */
.bu-content-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 20px 0 !important;
  font-size: 13.5px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.04) !important;
}
.bu-content-body table th {
  background: #0A1B54 !important;
  color: #FFC107 !important;
  font-weight: 700 !important;
  padding: 14px 16px !important;
  text-align: left !important;
  border-bottom: 2px solid #061D7C !important;
}
.bu-content-body table td {
  padding: 12px 16px !important;
  border-bottom: 1px solid #E5E7EB !important;
  color: #374151 !important;
}
.bu-content-body table tr:nth-child(even) {
  background: #F8FAFC !important;
}
.bu-content-body table tr:hover {
  background: #F1F5F9 !important;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Fees <em>Structure</em>';
  $page_subtitle = 'Approved fee schedules for academic courses, hostels, and university services.';
  $page_icon     = 'fa-calculator';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Admissions', 'url' => '#'],
    ['label' => 'Fees Structure', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Financial Overview</span>
        <h2 class="bu-content-h2"><?php echo isset($aryAbout['about_title']) ? $aryAbout['about_title'] : 'Fee Structure & Schedule';?></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php echo isset($aryAbout['content']) ? $aryAbout['content'] : '<p>Fee details are currently being updated. Please contact the admission helpline for instant details.</p>';?>
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
