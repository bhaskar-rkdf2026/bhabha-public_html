<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quick Links - Bhabha University Bhopal Madhya Pradesh</title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>
</head>

<body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
  <!-- register Modal --> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->
  <?php
  $page_title    = 'Quick <em>Links</em>';
  $page_subtitle = 'Direct Access to Student Portals, Verification, Disclosures &amp; Resources';
  $page_icon     = 'fa-link';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Quick Links', 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
    $active_page = 'links';
    include('inc.about-sidebar.php');
    ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Campus Directory</span>
        <h2 class="bu-content-h2">Essential University Services &amp; Portals</h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body" style="padding-top:15px;">
          <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:24px;">
            Find quick shortcuts to university departments, online registration, fee payment channels, examination results, statutory committee bodies, and institutional disclosures.
          </p>

          <style>
          .bu-directory-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-left: 4px solid #D99B00;
            border-radius: 10px;
            padding: 16px 18px;
            text-decoration: none !important;
            transition: all 0.25s ease;
          }
          .bu-directory-card:hover {
            background: #0A1B54;
            border-color: #0A1B54;
            border-left-color: #FFC107;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(10, 27, 84, 0.18);
          }
          .bu-directory-card:hover strong {
            color: #FFFFFF !important;
          }
          .bu-directory-card:hover span {
            color: #FFC107 !important;
          }
          .bu-directory-card:hover i {
            color: #FFC107 !important;
          }
          </style>

          <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:16px;">
            <a href="<?php echo href('enquiry.php');?>" class="bu-directory-card">
              <i class="fa fa-graduation-cap" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Admission Enquiry</strong>
                <span style="font-size:12.5px; color:#64748B;">Apply for current session</span>
              </div>
            </a>

            <a href="<?php echo href('examination.php');?>" class="bu-directory-card">
              <i class="fa fa-file-text-o" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Examinations &amp; Results</strong>
                <span style="font-size:12.5px; color:#64748B;">Schedules &amp; grade cards</span>
              </div>
            </a>

            <a href="<?php echo href('paytm.php');?>" class="bu-directory-card">
              <i class="fa fa-credit-card" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Online Fee Payment</strong>
                <span style="font-size:12.5px; color:#64748B;">Pay via Paytm &amp; UPI</span>
              </div>
            </a>

            <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-directory-card">
              <i class="fa fa-book" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Question Papers</strong>
                <span style="font-size:12.5px; color:#64748B;">Previous year exams archive</span>
              </div>
            </a>

            <a href="<?php echo href('placements.php');?>" class="bu-directory-card">
              <i class="fa fa-handshake-o" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Training &amp; Placements</strong>
                <span style="font-size:12.5px; color:#64748B;">Corporate recruitment records</span>
              </div>
            </a>

            <a href="<?php echo href('grievance.php');?>" class="bu-directory-card">
              <i class="fa fa-shield" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Grievance Redressal</strong>
                <span style="font-size:12.5px; color:#64748B;">Anti-Ragging &amp; Internal Cell</span>
              </div>
            </a>

            <a href="<?php echo href('nirf.php');?>" class="bu-directory-card">
              <i class="fa fa-bar-chart" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">NIRF Data</strong>
                <span style="font-size:12.5px; color:#64748B;">National institutional ranking</span>
              </div>
            </a>

            <a href="<?php echo href('contact.php');?>" class="bu-directory-card">
              <i class="fa fa-phone" style="font-size:24px; color:#D99B00;"></i>
              <div>
                <strong style="display:block; font-size:15px; color:#0A1B54;">Contact Directory</strong>
                <span style="font-size:12.5px; color:#64748B;">Campus address &amp; helpdesk</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END--> 
</div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript--> 
<?php include('inc.footer.js.php');?>
</body>
</html>
