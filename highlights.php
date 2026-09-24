<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>University Highlights - Bhabha University Bhopal Madhya Pradesh</title>
<meta name="description" content="Explore key institutional highlights, achievements, and features of Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
</head>

<body>
<div class="kode_wrapper"> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->

  <?php
  $page_title    = 'University <em>Highlights</em>';
  $page_subtitle = 'Distinctive institutional milestones, key features, and infrastructure highlights of Bhabha University.';
  $page_icon     = 'fa-star';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Highlights', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'overview'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">At a Glance</span>
        <h2 class="bu-content-h2">Key Institutional <em>Highlights</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:18px;">
                <h4 style="margin-top:0; color:#061D7C; font-size:16px;"><i class="fa fa-graduation-cap text-warning mr-2"></i> 20+ Years Legacy</h4>
                <p style="margin:0; font-size:13.5px; color:#475569;">Established in 2003, providing high-quality multidisciplinary technical and professional education.</p>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:18px;">
                <h4 style="margin-top:0; color:#061D7C; font-size:16px;"><i class="fa fa-building text-warning mr-2"></i> 32-Acre Green Campus</h4>
                <p style="margin:0; font-size:13.5px; color:#475569;">Lush green, eco-friendly campus equipped with high-tech laboratories, modern digital classrooms, and hostels.</p>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:18px;">
                <h4 style="margin-top:0; color:#061D7C; font-size:16px;"><i class="fa fa-certificate text-warning mr-2"></i> Statutory Recognitions</h4>
                <p style="margin:0; font-size:13.5px; color:#475569;">Recognized by UGC, AICTE, PCI, DCI, MPNRC, and Government of Madhya Pradesh.</p>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:8px; padding:18px;">
                <h4 style="margin-top:0; color:#061D7C; font-size:16px;"><i class="fa fa-briefcase text-warning mr-2"></i> Robust Placements</h4>
                <p style="margin:0; font-size:13.5px; color:#475569;">Active placement cell with 250+ top recruitment partners and regular campus hiring drives.</p>
              </div>
            </div>
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
