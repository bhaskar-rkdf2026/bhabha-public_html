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
        <div style="background:#fff; border:1px solid #E5E7EB; border-radius:12px; margin-bottom:40px; overflow:hidden; box-shadow:0 8px 24px rgba(6,29,124,0.04);">
          <!-- Header Area: Award Image & Details -->
          <div style="display:flex; flex-wrap:wrap; gap:24px; padding:32px; background:linear-gradient(to right, #F8FAFC, #ffffff); border-bottom:1px solid #E5E7EB; align-items:center;">
            <?php if($iawards['image'] != ''): ?>
            <div style="flex-shrink:0; width:160px; height:120px; background:linear-gradient(135deg,#0A1B54,#061D7C); border-radius:8px; display:flex; align-items:center; justify-content:center; overflow:hidden; box-shadow:0 4px 16px rgba(6,29,124,0.12);">
              <img src="<?php echo URL_UPLOAD;?>awards/<?php echo $iawards['image']?>" 
                   alt="<?php echo $iawards['title']?>"
                   onerror="this.outerHTML='<i class=\'fa fa-trophy\' style=\'font-size:40px;color:rgba(255,193,7,0.8);\'></i>'"
                   style="width:100%; height:100%; object-fit:cover;">
            </div>
            <?php else: ?>
            <div style="flex-shrink:0; width:160px; height:120px; background:linear-gradient(135deg,#0A1B54,#061D7C); border-radius:8px; display:flex; align-items:center; justify-content:center; overflow:hidden; box-shadow:0 4px 16px rgba(6,29,124,0.12);">
              <i class="fa fa-trophy" style="font-size:40px;color:rgba(255,193,7,0.8);"></i>
            </div>
            <?php endif; ?>
            
            <div style="flex:1; min-width:250px;">
              <h3 style="font-size:22px; font-weight:800; color:#061D7C; font-family:'Playfair Display', serif; margin:0 0 10px 0;"><?php echo $iawards['title']?></h3>
              <?php if(!empty($iawards['name'])): ?>
                <p style="font-size:14px; font-weight:800; color:#D99B00; text-transform:uppercase; letter-spacing:1px; margin:0 0 6px 0;">
                  <i class="fa fa-user" style="margin-right:6px; opacity:0.8;"></i> <?php echo $iawards['name']?>
                </p>
              <?php endif; ?>
              <?php if(!empty($iawards['designation'])): ?>
                <p style="font-size:14px; color:#4B5563; margin:0; font-weight:600;">
                  <i class="fa fa-briefcase" style="margin-right:6px; color:#9CA3AF;"></i> <?php echo $iawards['designation']?>
                </p>
              <?php endif; ?>
            </div>
          </div>

          <!-- Description Area (Handles rich HTML from CMS) -->
          <div class="bu-content-body" style="padding:32px;">
            <?php echo $iawards['description']?>
          </div>
        </div>
        <?php
          }
        } else { ?>
        <!-- Default Awards if no DB data -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:24px; margin-top:10px;">
          <?php 
          $default_awards = [
            ['icon'=>'fa-trophy','title'=>'Best Private University Award','org'=>'MP Education Excellence Awards 2023','desc'=>'Recognised as the Best Private University in Madhya Pradesh for academic innovation and placement excellence.'],
            ['icon'=>'fa-star','title'=>'NAAC Accreditation','org'=>'National Assessment & Accreditation Council','desc'=>'Accredited by NAAC with a grade reflecting quality in teaching, research, and governance.'],
            ['icon'=>'fa-globe','title'=>'Excellence in Research','org'=>'India Research Summit 2022','desc'=>'Honoured for 120+ active research labs, 250+ patents, and 1,200+ international publications.'],
            ['icon'=>'fa-graduation-cap','title'=>'Top Placement University','org'=>'India Education Congress 2023','desc'=>'Awarded for achieving 98% placement rate with top recruiters like Infosys, TCS, and Amazon.'],
          ];
          foreach($default_awards as $aw): ?>
          <div style="background:#fff; border:1px solid #E5E7EB; border-radius:12px; padding:32px 24px; text-align:center; box-shadow:0 4px 16px rgba(6,29,124,0.03); transition:all 0.3s;" onmouseover="this.style.boxShadow='0 12px 30px rgba(6,29,124,0.08)'; this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='0 4px 16px rgba(6,29,124,0.03)'; this.style.transform='none'">
            <div style="width:60px;height:60px;background:linear-gradient(135deg,rgba(10,27,84,0.05),rgba(6,29,124,0.1));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px auto;">
              <i class="fa <?php echo $aw['icon'];?>" style="font-size:24px; color:#061D7C;"></i>
            </div>
            <h4 style="font-size:18px;font-weight:800;color:#061D7C;margin:0 0 10px 0;font-family:'Playfair Display',serif;"><?php echo $aw['title'];?></h4>
            <p style="font-size:12px;color:#D99B00;font-weight:800;letter-spacing:1px;text-transform:uppercase;margin:0 0 16px 0;"><?php echo $aw['org'];?></p>
            <p style="font-size:14.5px;line-height:1.7;color:#4B5563;margin:0;"><?php echo $aw['desc'];?></p>
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
