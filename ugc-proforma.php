<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>UGC Proforma - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University UGC Proforma information in the prescribed format as required by the University Grants Commission, India.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'UGC <em>Proforma</em>';
  $page_subtitle = 'University Grants Commission information in prescribed format — ensuring transparency and regulatory compliance.';
  $page_icon     = 'fa-file-text';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'UGC Proforma', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'ugc-proforma'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Regulatory Compliance</span>
        <h2 class="bu-content-h2">UGC <em>Proforma</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            In accordance with the University Grants Commission (UGC) guidelines, Bhabha University 
            maintains complete disclosure of institutional information in the prescribed proforma format. 
            These documents are available for download below.
          </p>
        </div>
        <div style="display:grid;gap:12px;margin-top:24px;">
          <a href="https://www.bhabhauniversity.edu.in/upload/media/8a5cc8e8a663be0f26243b584eab0a19.pdf" 
             target="_blank"
             style="display:flex;align-items:center;gap:16px;padding:20px 24px;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:8px;border-left:3px solid #FFC107;text-decoration:none;transition:all 0.25s;"
             onmouseover="this.style.background='#0A1B54';"
             onmouseout="this.style.background='#F8FAFC';">
            <div style="width:44px;height:44px;background:rgba(217,155,0,0.12);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa fa-file-pdf-o" style="font-size:20px;color:#D99B00;"></i>
            </div>
            <div style="flex:1;">
              <span style="font-size:15px;font-weight:700;color:inherit;display:block;margin-bottom:3px;">Filled UGC Proforma Information in Prescribed Format</span>
              <span style="font-size:11px;font-weight:600;color:inherit;opacity:0.55;text-transform:uppercase;letter-spacing:0.5px;">PDF Document &bull; University Grants Commission</span>
            </div>
            <i class="fa fa-download" style="font-size:16px;color:#D99B00;flex-shrink:0;"></i>
          </a>
        </div>
      </div>

      <!-- Info Note -->
      <div class="bu-content-card" style="background:#FFF8E1;border-color:#FFC107;">
        <div style="display:flex;gap:14px;align-items:flex-start;">
          <i class="fa fa-info-circle" style="font-size:22px;color:#D99B00;flex-shrink:0;margin-top:2px;"></i>
          <div>
            <h4 style="font-size:15px;font-weight:700;color:#061D7C;margin:0 0 8px 0;">About UGC Recognition</h4>
            <p style="font-size:14px;line-height:1.7;color:#4B5563;margin:0;">
              Bhabha University is recognised by the University Grants Commission (UGC) under Section 2(f) and 12(B) 
              of the UGC Act, 1956. This recognition validates the academic and financial standards maintained by the 
              university and makes graduates eligible for UGC fellowships and government positions requiring UGC-recognised degrees.
            </p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
