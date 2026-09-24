<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('university') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'About University - Bhabha University Bhopal Madhya Pradesh'); ?></title>
<meta name="description" content="Discover Bhabha University Bhopal, established in 2003 under Ayushmati Education and Social Society. Learn about our legacy, 32-acre campus, world-class labs, and multidisciplinary programs.">
<?php include('inc.meta.php');?>
</head>

<body>
<div class="kode_wrapper"> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->

  <?php
  $page_title    = portalVal($portalPage, 'heading', 'About <em>University</em>');
  $page_subtitle = 'Established in 2003, committed to transformative education, interdisciplinary research, and global leadership.';
  $page_icon     = 'fa-university';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'About University', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'overview'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'Bhabha University, Bhopal'); ?></span>
        <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'About <em>University</em>'); ?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php if (!empty($portalPage['data']['body'])): ?>
            <?php echo $portalPage['data']['body']; ?>
          <?php else: ?>
            <p><strong>Bhabha University</strong> opened its doors with the establishment of Bhabha Group of Institutions in 2003, promoted by Ayushmati Education and Social Society. In 2018, Bhabha Group of Institutions was established as <strong>Bhabha University</strong> by the Act of Madhya Pradesh Legislature and notified in the Official Gazette of the State Government of Madhya Pradesh.</p>
            <p>For more than two decades, Bhabha University has been challenging and developing great minds. Interdisciplinary research training is the cornerstone of student success, empowering learners across faculties of Engineering &amp; Technology, Pharmacy, Dental Sciences, Hotel Management, Computer Applications, Management, Nursing, Education, and Basic Sciences.</p>
            <h4>World-Class Ambience &amp; Infrastructure</h4>
            <p>The ambience and serenity of our 32-acre clean and green campus provides an ideal academic retreat. Equipped with state-of-the-art physical and digital infrastructure, 1 Gbps internet connectivity, smart auditoriums, modern laboratories, dedicated hostels, and sports facilities, Bhabha University prepares scholars to lead technological and societal transformation.</p>
            <h4>Global Outlook &amp; Innovation</h4>
            <p>As an urban research university, our commitment to free and open inquiry draws inspired scholars to our campus. Through undergraduate, postgraduate, and doctoral programmes, students develop critical thinking and practical competence to solve pressing real-world challenges.</p>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
