<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('career') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Careers &amp; Opportunities - Bhabha University Bhopal'); ?></title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>
</head>

<body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->
  <?php
  $page_title    = portalVal($portalPage, 'heading', 'Careers &amp; <em>Opportunities</em>');
  $page_subtitle = 'Join Our Distinguished Academic &amp; Research Community';
  $page_icon     = 'fa-briefcase';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'About Us', 'url' => href('about.php')],
    ['label' => strip_tags(portalVal($portalPage, 'heading', 'Careers')), 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
    $active_page = 'career';
    include('inc.about-sidebar.php');
    ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'WORK WITH US'); ?></span>
        <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'Careers at Bhabha University'); ?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body" style="padding-top:15px;">
              <?php if (!empty($portalPage['data']['body'])): ?>
                <div style="font-size:15px;line-height:1.8;color:#475569;">
                  <?php echo $portalPage['data']['body']; ?>
                </div>
              <?php else: ?>
                <p style="font-size:15px;line-height:1.8;color:#334155;margin-bottom:18px;">
                  Bhabha University offers competitive compensation, comprehensive research funding, state-of-the-art laboratory infrastructure, sabbatical study allowances, and medical coverage for distinguished academic faculty and administrative professionals.
                </p>
                <p style="font-size:15px;line-height:1.8;color:#334155;margin-bottom:24px;">
                  We are actively seeking visionary educators, research scholars, and academic leaders across disciplines in Engineering, Pharmacy, Management, Medicine, Nursing, Law, and Applied Sciences.
                </p>

                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-left:4px solid #0A1B54; border-radius:8px; padding:20px 24px; margin-bottom:24px;">
                  <h4 style="margin:0 0 8px 0; font-size:17px; font-weight:700; color:#0A1B54;">How To Apply</h4>
                  <p style="margin:0 0 14px 0; font-size:14px; color:#64748B; line-height:1.6;">
                    Interested candidates may forward an updated curriculum vitae, copy of recent publications, and credentials directly to the Registrar / HR recruitment desk:
                  </p>
                  <div style="display:flex; align-items:center; gap:12px; font-size:15px; font-weight:700; color:#061D7C;">
                    <i class="fa fa-envelope" style="color:#FFC107;"></i> info@bhabhauniversity.edu.in
                  </div>
                </div>

                <div>
                  <a href="<?php echo href('jobs.php');?>" class="bu-table-dl" style="padding:12px 24px; font-size:14.5px;">
                    <i class="fa fa-list-alt"></i> View Current Job Vacancies &amp; Openings
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </main>
      </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END--> 
</div>
<!--Bootstrap core JavaScript--> 
<?php include('inc.footer.js.php');?>
</body>
</html>
