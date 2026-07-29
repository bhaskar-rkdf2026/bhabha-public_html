<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vision & Mission - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University's Vision and Mission — committed to excellence in education, research, and community development to shape the leaders of tomorrow.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Vision & <em>Mission</em>';
  $page_subtitle = 'The guiding philosophy that shapes every decision, programme, and initiative at Bhabha University.';
  $page_icon     = 'fa-eye';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Vision & Mission', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'mission-vision'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Vision Card -->
      <div class="bu-content-card">
        <span class="bu-content-label">Our Purpose</span>
        <h2 class="bu-content-h2">Our <em>Vision</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            The vision of Bhabha University is to become a <strong>globally recognised centre of learning</strong> 
            that provides high-quality, research-driven education — from diploma to doctoral programmes — 
            nurturing graduates who are not only academically excellent but also socially responsible and 
            globally competitive.
          </p>
          <p>
            The university aspires to contribute meaningfully to society through teaching and research, 
            helping achieve global sustainability. It aims to produce leaders in science, technology, 
            management, healthcare, law, and other disciplines.
          </p>
        </div>
      </div>

      <!-- Mission Card -->
      <div class="bu-content-card">
        <span class="bu-content-label">What Drives Us</span>
        <h2 class="bu-content-h2">Our <em>Mission</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <ul>
            <li>To provide greater access to higher education for all — especially to socially and educationally underprivileged youth — upholding the principle of social equity.</li>
            <li>To make learning exciting through excellent, integrative teaching strategies driven by curiosity and creativity.</li>
            <li>To facilitate and promote entry into research at an early age through a flexible, borderless curriculum and hands-on research projects.</li>
            <li>To encourage and facilitate inter-institutional and international exchange programmes and collaborations in teaching and research.</li>
            <li>To build a culture of integrity, innovation, inclusivity, and academic rigor that prepares students for real-world challenges.</li>
            <li>To foster entrepreneurship, problem-solving, and leadership skills that enable graduates to create value for society.</li>
          </ul>
        </div>
      </div>

      <!-- Core Philosophy -->
      <div class="bu-content-card" style="background:linear-gradient(135deg,#0A1B54,#061D7C); border-color:#0A1B54;">
        <span class="bu-content-label" style="color:#FFC107;">Philosophy</span>
        <h2 class="bu-content-h2" style="color:#fff;">Our <em style="color:#FFC107;">Core Philosophy</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p style="color:rgba(255,255,255,0.75);">
            At Bhabha University, we believe that <strong style="color:#fff;">education is transformation</strong>. 
            Every student who walks through our doors carries with them the potential to change their family, 
            their community, and the world. Our role is to unlock that potential through rigorous academics, 
            mentorship, and an environment that celebrates both excellence and compassion.
          </p>
        </div>
      </div>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
