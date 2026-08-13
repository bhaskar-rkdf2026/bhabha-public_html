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

/* ============================================================
   BHABHA UNIVERSITY - DYNAMIC CMS PAGE CONTENT STYLING
   ============================================================ */

/* Main Headings inside CMS Body */
.bu-content-body h1,
.bu-content-body h2,
.bu-content-body h3 {
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  color: #0A1B54 !important;
  margin: 18px 0 10px 0 !important;
  font-weight: 700 !important;
  line-height: 1.5 !important;
}

.bu-content-body h1 { font-size: 22px !important; }
.bu-content-body h2 { font-size: 20px !important; }
.bu-content-body h3 { font-size: 18px !important; }

/* When Headings wrap Links (e.g., <h1><a href="...">Title</a></h1> in CMS video/link lists) */
.bu-content-body h1:has(a),
.bu-content-body h2:has(a),
.bu-content-body h3:has(a),
.bu-content-body h4:has(a) {
  font-size: 15.5px !important;
  font-weight: 600 !important;
  margin: 8px 0 10px 0 !important;
  line-height: 1.6 !important;
  padding: 10px 14px !important;
  background: #F8FAFC !important;
  border-left: 3px solid #1E6091 !important;
  border-radius: 6px !important;
  transition: all 0.2s ease !important;
  box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
}

.bu-content-body h1:has(a):hover,
.bu-content-body h2:has(a):hover,
.bu-content-body h3:has(a):hover {
  background: #F1F5F9 !important;
  border-left-color: #0A1B54 !important;
  transform: translateX(4px) !important;
}

/* Dynamic Links Styling */
.bu-content-body a {
  color: #1E6091 !important;
  font-size: 15.5px !important;
  font-weight: 600 !important;
  line-height: 1.6 !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
  word-break: break-word !important;
}

.bu-content-body a span {
  color: inherit !important;
  font-size: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
  text-decoration: inherit !important;
}

.bu-content-body a:hover,
.bu-content-body a:hover span {
  color: #0A1B54 !important;
  text-decoration: underline !important;
}

/* Paragraphs & Text */
.bu-content-body p {
  font-size: 15px !important;
  line-height: 1.75 !important;
  color: #374151 !important;
  margin-bottom: 14px !important;
}

/* Clean up empty tags and spacing */
.bu-content-body p:empty,
.bu-content-body h1:empty,
.bu-content-body h2:empty {
  display: none !important;
}

/* Styled Table Content for Dynamic CMS Pages */
.bu-content-body table {
  width: 100% !important;
  border-collapse: collapse !important;
  margin: 24px 0 !important;
  font-size: 14.5px !important;
  border-radius: 8px !important;
  overflow: hidden !important;
  box-shadow: 0 4px 16px rgba(6,29,124,0.06) !important;
}

/* Reset cell children vertical alignment and margins */
.bu-content-body table th,
.bu-content-body table td {
  vertical-align: middle !important;
  word-break: normal !important;
  min-width: 60px !important;
}

.bu-content-body table th p,
.bu-content-body table td p,
.bu-content-body table th div,
.bu-content-body table td div,
.bu-content-body table th span,
.bu-content-body table td span {
  margin: 0 !important;
  padding: 0 !important;
  line-height: inherit !important;
}

/* Primary Header Row & Title Banner */
.bu-content-body table th,
.bu-content-body table tr:first-child td,
.bu-content-body table tr:first-child th {
  background: #0A1B54 !important;
  color: #ffffff !important;
  font-weight: 700 !important;
  padding: 16px 18px !important;
  text-align: center !important;
  border-bottom: 2px solid #061D7C !important;
}

/* Force inner text/spans in first row header to crisp white & gold */
.bu-content-body table th *,
.bu-content-body table tr:first-child td * {
  color: #ffffff !important;
}
.bu-content-body table tr:first-child td p:first-child *,
.bu-content-body table tr:first-child td span:first-child {
  color: #FFC107 !important; /* Gold highlight for main title line */
}

/* All Data Rows (cell padding & uniform alignment) */
.bu-content-body table td {
  padding: 14px 18px !important;
  border-bottom: 1px solid #E5E7EB !important;
  color: #374151 !important;
  line-height: 1.6 !important;
  text-align: left !important;
}

.bu-content-body table tr:not(:first-child) td p,
.bu-content-body table tr:not(:first-child) td span,
.bu-content-body table tr:not(:first-child) td div {
  text-align: left !important;
}

/* Align bullet/icon/number cells in first column of multi-column tables */
.bu-content-body table tr:not(:first-child) td:first-child:not(:last-child) {
  text-align: center !important;
}
.bu-content-body table tr:not(:first-child) td:first-child:not(:last-child) * {
  text-align: center !important;
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

  <div class="bu-inner-layout">
    <?php 
      // If it's the University Overview page (id 20), highlight it in the sidebar
      $active_page = ($id == 20) ? 'overview' : ''; 
      include('inc.about-sidebar.php'); 
    ?>

    <main class="bu-inner-content">

      <div class="bu-content-card" style="overflow: hidden;">
        <span class="bu-content-label">Bhabha University</span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($pageData['heading']);?></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php echo $pageData['data'];?>
          <div style="clear:both;"></div>
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
