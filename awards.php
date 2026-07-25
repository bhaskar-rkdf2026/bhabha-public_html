<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Awards & Achievements - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University has been recognised for excellence with national and international awards. Explore our achievements and accolades.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Awards & <em>Achievements</em>';
  $page_subtitle = 'Recognitions that reflect our commitment to excellence in education, research, and community service.';
  $page_icon     = 'fa-trophy';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Awards & Achievements', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'awards'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Honours &amp; Recognition</span>
        <h2 class="bu-content-h2">Awards &amp; <em>Achievements</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">

        <?php
        $awards = $db->get('awards');
        if(is_array($awards) && count($awards) > 0) {
          foreach($awards as $iawards) {
        ?>
        <div style="display:flex; gap:24px; align-items:flex-start; padding:24px 0; border-bottom:1px solid #F3F4F6; flex-wrap:wrap;">
          <?php if($iawards['image'] != ''): ?>
          <div style="flex-shrink:0;">
            <img src="<?php echo URL_UPLOAD;?>awards/<?php echo $iawards['image']?>" 
                 alt="<?php echo $iawards['title']?>"
                 style="width:200px; height:140px; object-fit:cover; border-radius:6px; box-shadow:0 4px 16px rgba(6,29,124,0.12);">
          </div>
          <?php endif; ?>
          <div style="flex:1; min-width:200px;">
            <h4 style="font-size:18px; font-weight:700; color:#061D7C; margin:0 0 6px 0; font-family:'Plus Jakarta Sans',sans-serif;"><?php echo $iawards['title']?></h4>
            <?php if(!empty($iawards['name'])): ?>
              <p style="font-size:13px; font-weight:700; color:#D99B00; margin:0 0 8px 0; text-transform:uppercase; letter-spacing:0.8px;"><?php echo $iawards['name']?></p>
            <?php endif; ?>
            <?php if(!empty($iawards['designation'])): ?>
              <p style="font-size:12px; color:#6B7280; margin:0 0 10px 0;"><?php echo $iawards['designation']?></p>
            <?php endif; ?>
            <p style="font-size:14px; line-height:1.7; color:#4B5563; margin:0;"><?php echo $iawards['description']?></p>
          </div>
        </div>
        <?php
          }
        } else { ?>
        <!-- Default Awards if no DB data -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:20px; margin-top:10px;">
          <?php 
          $default_awards = [
            ['icon'=>'fa-trophy','title'=>'Best Private University Award','org'=>'MP Education Excellence Awards 2023','desc'=>'Recognised as the Best Private University in Madhya Pradesh for academic innovation and placement excellence.'],
            ['icon'=>'fa-star','title'=>'NAAC Accreditation','org'=>'National Assessment & Accreditation Council','desc'=>'Accredited by NAAC with a grade reflecting quality in teaching, research, and governance.'],
            ['icon'=>'fa-globe','title'=>'Excellence in Research','org'=>'India Research Summit 2022','desc'=>'Honoured for 120+ active research labs, 250+ patents, and 1,200+ international publications.'],
            ['icon'=>'fa-graduation-cap','title'=>'Top Placement University','org'=>'India Education Congress 2023','desc'=>'Awarded for achieving 98% placement rate with top recruiters like Infosys, TCS, and Amazon.'],
            ['icon'=>'fa-users','title'=>'Community Impact Award','org'=>'CSR Leadership Awards 2022','desc'=>'Recognised for social outreach, scholarship initiatives, and rural education upliftment programs.'],
            ['icon'=>'fa-leaf','title'=>'Green Campus Award','org'=>'National Environment Forum 2021','desc'=>'150-acre eco-friendly campus with solar power, waste management, and green infrastructure.'],
          ];
          foreach($default_awards as $aw): ?>
          <div style="background:#F8FAFC; border:1px solid #E5E7EB; border-radius:8px; padding:24px 20px; transition:all 0.25s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(6,29,124,0.1)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='none'">
            <div style="width:44px;height:44px;background:rgba(10,27,84,0.08);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
              <i class="fa <?php echo $aw['icon'];?>" style="font-size:18px; color:#0A1B54;"></i>
            </div>
            <h4 style="font-size:15px;font-weight:700;color:#061D7C;margin:0 0 4px 0;font-family:'Plus Jakarta Sans',sans-serif;"><?php echo $aw['title'];?></h4>
            <p style="font-size:11px;color:#D99B00;font-weight:700;letter-spacing:0.5px;text-transform:uppercase;margin:0 0 10px 0;"><?php echo $aw['org'];?></p>
            <p style="font-size:13px;line-height:1.65;color:#6B7280;margin:0;"><?php echo $aw['desc'];?></p>
          </div>
          <?php endforeach; ?>
        </div>
        <?php } ?>

        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
