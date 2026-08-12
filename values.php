<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Core Values - Bhabha University Bhopal</title>
<meta name="description" content="The core values of Bhabha University — Integrity, Innovation, Care, Excellence, Collaboration and Social Responsibility that guide everything we do.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Core <em>Values</em>';
  $page_subtitle = 'The principles that define who we are, how we work, and guide how we act with each other and every stakeholder.';
  $page_icon     = 'fa-heart';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Core Values', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'values'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Intro -->
      <div class="bu-content-card">
        <span class="bu-content-label">Our Foundation</span>
        <h2 class="bu-content-h2">Core <em>Values</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            In fulfilling our mission, the faculty, staff, and students of Bhabha University are committed 
            to the following values — both as an institution and in our actions as individuals. 
            <strong>Core Values are at the heart of our education.</strong> They define who we are, 
            how we work, and guide how we act with each other and with other stakeholders. They are our DNA.
          </p>
        </div>
      </div>

      <!-- Primary Values Cards -->
      <div class="bu-content-card">
        <span class="bu-content-label">What We Stand For</span>
        <h2 class="bu-content-h2">Our <em>Guiding Principles</em></h2>
        <div class="bu-content-divider"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:10px;">
          <?php
          $core_values = [
            ['icon'=>'fa-shield','color'=>'#0A1B54','title'=>'Integrity','desc'=>'We build relationships through trust, honesty and respect. Integrity is non-negotiable in everything we do — academic or otherwise.'],
            ['icon'=>'fa-fire','color'=>'#D99B00','title'=>'Passion & Pride','desc'=>'We love what we do and strive for excellence in every endeavour. We take pride in our institution and in the achievements of our students and alumni.'],
            ['icon'=>'fa-heart','color'=>'#E53E3E','title'=>'Care','desc'=>'We put our students and their goals at the heart of everything we do. Every decision is guided by our commitment to student success and wellbeing.'],
            ['icon'=>'fa-lightbulb-o','color'=>'#38A169','title'=>'Creativity & Innovation','desc'=>'We are not afraid to be different and we celebrate innovation. We encourage creative thinking, entrepreneurship and problem-solving at every level.'],
            ['icon'=>'fa-users','color'=>'#6B46C1','title'=>'Collaboration','desc'=>'We believe in the power of working together — faculty, students, industry and community — to achieve outcomes greater than what any one can accomplish alone.'],
            ['icon'=>'fa-globe','color'=>'#2B6CB0','title'=>'Social Responsibility','desc'=>'We recognise our duty to society and the environment. We empower students to be responsible global citizens who contribute positively to their communities.'],
            ['icon'=>'fa-graduation-cap','color'=>'#C05621','title'=>'Discovery & Learning','desc'=>'We foster a culture of curiosity, continuous learning and intellectual exploration. Research and scholarship are embedded in every aspect of university life.'],
            ['icon'=>'fa-balance-scale','color'=>'#285E61','title'=>'Diversity & Inclusiveness','desc'=>'We celebrate diversity in all its forms and are committed to providing an inclusive environment where every student and faculty member feels valued and respected.'],
          ];
          foreach($core_values as $v): ?>
          <div style="display:flex;gap:16px;align-items:flex-start;padding:22px;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:8px;transition:all 0.25s;" onmouseover="this.style.boxShadow='0 8px 24px rgba(6,29,124,0.1)';this.style.transform='translateY(-2px)';" onmouseout="this.style.boxShadow='none';this.style.transform='none';">
            <div style="width:44px;height:44px;background:<?php echo $v['color'];?>1a;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa <?php echo $v['icon'];?>" style="font-size:18px;color:<?php echo $v['color'];?>;"></i>
            </div>
            <div>
              <h4 style="font-size:15px;font-weight:700;color:#061D7C;margin:0 0 6px 0;font-family:'Plus Jakarta Sans',sans-serif;"><?php echo $v['title'];?></h4>
              <p style="font-size:13px;line-height:1.65;color:#6B7280;margin:0;"><?php echo $v['desc'];?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Values Pillars -->
      <div class="bu-content-card" style="background:linear-gradient(135deg,#0A1B54,#061D7C);border-color:#0A1B54;">
        <span class="bu-content-label" style="color:#FFC107;">Five Pillars</span>
        <h2 class="bu-content-h2" style="color:#fff;">Our Value <em style="color:#FFC107;">Pillars</em></h2>
        <div style="width:50px;height:3px;background:#FFC107;border-radius:2px;margin:16px 0 24px 0;"></div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;">
          <?php
          $pillars = [
            ['title'=>'People','sub'=>'Success & Diversity','icon'=>'fa-user'],
            ['title'=>'Learning','sub'=>'Discovery, Innovation & Scholarship','icon'=>'fa-book'],
            ['title'=>'Partnerships','sub'=>'Regional, Entrepreneurial & Global','icon'=>'fa-briefcase'],
            ['title'=>'Relationships','sub'=>'Collegial, Professional & Ethical','icon'=>'fa-heart'],
            ['title'=>'Sustainability','sub'=>'Social Justice, Economic & Environmental','icon'=>'fa-leaf'],
          ];
          foreach($pillars as $p): ?>
          <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:22px 18px;text-align:center;">
            <i class="fa <?php echo $p['icon'];?>" style="font-size:26px;color:#FFC107;margin-bottom:12px;display:block;"></i>
            <h4 style="font-size:15px;font-weight:700;color:#fff;margin:0 0 6px 0;font-family:'Plus Jakarta Sans',sans-serif;"><?php echo $p['title'];?></h4>
            <p style="font-size:12px;line-height:1.5;color:rgba(255,255,255,0.6);margin:0;"><?php echo $p['sub'];?></p>
          </div>
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
