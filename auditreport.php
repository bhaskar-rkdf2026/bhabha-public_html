<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Finance & Audit Report - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University Finance Officer's Audit Reports and Balance Sheets — transparency in financial governance.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Finance & <em>Audit Report</em>';
  $page_subtitle = 'Official financial reports, audit statements and balance sheets — reflecting our commitment to transparency and accountability.';
  $page_icon     = 'fa-bar-chart';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Finance & Audit Report', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'auditreport'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Financial Transparency</span>
        <h2 class="bu-content-h2">Finance & <em>Audit Report</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>Bhabha University maintains complete transparency in its financial operations. Below are the official audit reports and balance sheets as submitted to the Finance Officer and regulatory bodies.</p>
        </div>
        <div style="display:grid;gap:12px;margin-top:24px;">
          <?php
          $docs = [
            ['title'=>'Audit Report 2023-24','url'=>'https://www.bhabhauniversity.edu.in/upload/media/a0bae7c93fe4ef327d1e52224c1b8ee8.pdf','year'=>'2023-24'],
            ['title'=>'Audit Report — Ayushmati Education Society 2023','url'=>'https://www.bhabhauniversity.edu.in/upload/media/6f7c8abe8bbf0031ca3051545b2eac18.pdf','year'=>'2022-23'],
            ['title'=>'Balance Sheet 2023-24','url'=>'https://www.bhabhauniversity.edu.in/upload/media/c0ca03c0cd958e2bd34d2c186ac3d5c4.pdf','year'=>'2023-24'],
            ['title'=>'Balance Sheet 2021-22 — Ayushmati Education Society','url'=>'https://www.bhabhauniversity.edu.in/upload/media/18a8b68a5dcc6fdc4682eb26d790d238.pdf','year'=>'2021-22'],
          ];
          foreach($docs as $doc): ?>
          <a href="<?php echo $doc['url'];?>" target="_blank" 
             style="display:flex;align-items:center;gap:16px;padding:20px 24px;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:8px;border-left:3px solid #FFC107;text-decoration:none;transition:all 0.25s;"
             onmouseover="this.style.background='#0A1B54';"
             onmouseout="this.style.background='#F8FAFC';">
            <div style="width:44px;height:44px;background:rgba(217,155,0,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa fa-file-pdf-o" style="font-size:20px;color:#D99B00;"></i>
            </div>
            <div style="flex:1;">
              <span style="font-size:15px;font-weight:700;color:inherit;display:block;margin-bottom:3px;"><?php echo $doc['title'];?></span>
              <span style="font-size:11px;font-weight:600;color:inherit;opacity:0.55;text-transform:uppercase;letter-spacing:0.5px;">Financial Year <?php echo $doc['year'];?> &bull; PDF Document</span>
            </div>
            <i class="fa fa-download" style="font-size:16px;color:#D99B00;flex-shrink:0;"></i>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
