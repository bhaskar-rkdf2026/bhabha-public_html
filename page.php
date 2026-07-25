<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$pageData = $db->getOne('page');

if(!$pageData) {
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
<title><?php echo htmlspecialchars(!empty($pageData['title']) ? $pageData['title'] : $pageData['heading']);?> - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($pageData['heading']);?> at Bhabha University Bhopal. Explore official university details, announcements and guidelines.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Styled Table Content for Dynamic CMS Pages */
.bu-content-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 24px 0 !important;
  font-size: 14px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05) !important;
}
.bu-content-body table th,
.bu-content-body table tr:first-child td {
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

.bu-content-body img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 8px !important;
  margin: 16px 0 !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.08) !important;
}

.bu-content-body ul, .bu-content-body ol {
  margin: 16px 0 16px 24px !important;
  line-height: 1.75 !important;
  color: #374151 !important;
}
.bu-content-body ul li, .bu-content-body ol li {
  margin-bottom: 8px !important;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = htmlspecialchars($pageData['heading']);
  $page_subtitle = 'Official information and guidelines from Bhabha University Bhopal.';
  $page_icon     = 'fa-file-text-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => $pageData['heading'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Bhabha University</span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($pageData['heading']);?></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php echo $pageData['data'];?>
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
