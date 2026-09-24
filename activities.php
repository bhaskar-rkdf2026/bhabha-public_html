<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('activities') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Campus Activities - Bhabha University Bhopal Madhya Pradesh'); ?></title>
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
  $page_title    = portalVal($portalPage, 'heading', 'Campus <em>Activities</em>');
  $page_subtitle = 'Co-Curricular Events, Sports Championships &amp; Student Societies';
  $page_icon     = 'fa-futbol-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Student Life', 'url' => href('about.php')],
    ['label' => strip_tags(portalVal($portalPage, 'heading', 'Campus Activities')), 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
    $active_page = 'activities';
    include('inc.about-sidebar.php');
    ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'STUDENT LIFE'); ?></span>
        <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'Campus Activities &amp; Student Life'); ?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body" style="padding-top:15px;">
              <?php if (!empty($portalPage['data']['body'])): ?>
                <div style="font-size:15px;line-height:1.8;color:#475569;">
                  <?php echo $portalPage['data']['body']; ?>
                </div>
              <?php else: ?>
                <p style="font-size:15px;line-height:1.8;color:#334155;margin-bottom:16px;">
                  Campus life at Bhabha University is vibrant and holistic. Students participate in technical hackathons, cultural festivals like <em>Tarang</em>, inter-university sports championships, NSS community camps, and debate societies, fostering well-rounded personality development.
                </p>
                <p style="font-size:15px;line-height:1.8;color:#334155;margin-bottom:24px;">
                  Our expansive campus features cricket arenas, basketball courts, badminton courts, cultural auditoriums, and dedicated student activity centers designed to nurture athletic and artistic talents.
                </p>

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-top:20px;">
                  <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:20px 18px;">
                    <div style="font-size:18px; font-weight:700; color:#0A1B54; margin-bottom:8px;"><i class="fa fa-trophy" style="color:#FFC107; margin-right:8px;"></i> Annual Sports Meet</div>
                    <p style="font-size:13.5px; color:#64748B; line-height:1.6; margin:0;">Track &amp; field, football tournaments, cricket leagues, and indoor championships.</p>
                  </div>
                  <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:20px 18px;">
                    <div style="font-size:18px; font-weight:700; color:#0A1B54; margin-bottom:8px;"><i class="fa fa-music" style="color:#FFC107; margin-right:8px;"></i> Tarang Fest</div>
                    <p style="font-size:13.5px; color:#64748B; line-height:1.6; margin:0;">Inter-collegiate cultural celebration with dance, theater, music, and fashion extravaganzas.</p>
                  </div>
                  <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:20px 18px;">
                    <div style="font-size:18px; font-weight:700; color:#0A1B54; margin-bottom:8px;"><i class="fa fa-heartbeat" style="color:#FFC107; margin-right:8px;"></i> NSS &amp; Social Service</div>
                    <p style="font-size:13.5px; color:#64748B; line-height:1.6; margin:0;">Blood donation drives, village literacy campaigns, health checkup camps, and tree planting.</p>
                  </div>
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
