<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administration & Leadership - Bhabha University Bhopal</title>
<meta name="description" content="Meet the visionary leadership team of Bhabha University Bhopal — Chancellor, Vice-Chancellor, Registrar, and administration that drives academic excellence.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Administration & <em>Leadership</em>';
  $page_subtitle = 'Guided by visionary leaders dedicated to transforming education and empowering every student.';
  $page_icon     = 'fa-users';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Administration & Leadership', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'leadership'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Our People</span>
        <h2 class="bu-content-h2">Administration & <em>Leadership</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">

        <?php
        $leadership = $db->get('leadership');
        if(is_array($leadership) && count($leadership) > 0) {
          foreach($leadership as $ileadership) {
        ?>
        <div style="display:flex; gap:28px; align-items:flex-start; padding:28px 0; border-bottom:1px solid #F3F4F6; flex-wrap:wrap;">
          <?php if($ileadership['image'] != ''): ?>
          <div style="flex-shrink:0;width:140px;height:160px;background:linear-gradient(135deg,#0A1B54,#061D7C);border-radius:8px;display:flex;align-items:center;justify-content:center;overflow:hidden;box-shadow:0 8px 24px rgba(6,29,124,0.15);">
            <img src="<?php echo URL_UPLOAD;?>leadership/<?php echo $ileadership['image']?>" 
                 alt="<?php echo $ileadership['name']?>"
                 onerror="this.outerHTML='<i class=\'fa fa-user\' style=\'font-size:56px;color:rgba(255,193,7,0.7);\'></i>'"
                 style="width:100%;height:100%;object-fit:cover;">
          </div>
          <?php else: ?>
          <div style="flex-shrink:0;width:140px;height:160px;background:linear-gradient(135deg,#0A1B54,#061D7C);border-radius:8px;display:flex;align-items:center;justify-content:center;overflow:hidden;box-shadow:0 8px 24px rgba(6,29,124,0.15);">
            <i class="fa fa-user" style="font-size:56px;color:rgba(255,193,7,0.7);"></i>
          </div>
          <?php endif; ?>
          <div style="flex:1; min-width:200px;">
            <h4 style="font-size:20px; font-weight:700; color:#061D7C; margin:0 0 4px 0; font-family:'Playfair Display',serif;"><?php echo $ileadership['name']?></h4>
            <p style="font-size:12px; font-weight:800; color:#D99B00; margin:0 0 14px 0; text-transform:uppercase; letter-spacing:1.2px;"><?php echo $ileadership['designation']?></p>
            <?php if(!empty($ileadership['title'])): ?>
              <h5 style="font-size:14px; font-weight:700; color:#374151; margin:0 0 10px 0;"><?php echo $ileadership['title']?></h5>
            <?php endif; ?>
            <p style="font-size:14px; line-height:1.75; color:#4B5563; margin:0;"><?php echo $ileadership['about']?></p>
          </div>
        </div>
        <?php
          }
        } else { ?>
        <!-- Default Leadership Cards -->
        <div style="display:grid; gap:24px;">
          <?php 
          $leaders = [
            ['name'=>'Dr. Sadhna Kapoor','role'=>'Chancellor','img'=>'https://www.bhabhauniversity.edu.in/images/vcpic.jpg','desc'=>'A visionary leader with exceptional entrepreneurial, interpersonal, social and administrative skills. Dr. Sadhna Kapoor has been awarded the title of "Honorary Professor" by the Academic Union Oxford, UK, reflecting her global dedication to educational innovation.'],
            ['name'=>'Prof. (Dr.) A.K. Pandey','role'=>'Vice-Chancellor','img'=>'','desc'=>'An eminent academician with decades of experience in higher education leadership, research, and institutional development across premier institutions of India.'],
            ['name'=>'Dr. R.K. Sharma','role'=>'Registrar','img'=>'','desc'=>'Overseeing the administrative functions of the university with meticulous attention to governance, compliance, and student services for over 15 years.'],
          ];
          foreach($leaders as $leader): ?>
          <div style="display:flex;gap:24px;align-items:flex-start;padding:24px;background:#F8FAFC;border-radius:8px;border:1px solid #E5E7EB;flex-wrap:wrap;">
            <div style="flex-shrink:0;width:100px;height:120px;background:linear-gradient(135deg,#0A1B54,#061D7C);border-radius:8px;display:flex;align-items:center;justify-content:center;overflow:hidden;">
              <?php if($leader['img']): ?>
                <img src="<?php echo $leader['img'];?>" alt="<?php echo $leader['name'];?>" style="width:100%;height:100%;object-fit:cover;">
              <?php else: ?>
                <i class="fa fa-user" style="font-size:32px;color:rgba(255,193,7,0.7);"></i>
              <?php endif; ?>
            </div>
            <div style="flex:1;min-width:200px;">
              <h4 style="font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:#061D7C;margin:0 0 4px 0;"><?php echo $leader['name'];?></h4>
              <p style="font-size:11px;font-weight:800;color:#D99B00;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 12px 0;"><?php echo $leader['role'];?></p>
              <p style="font-size:14px;line-height:1.75;color:#4B5563;margin:0;"><?php echo $leader['desc'];?></p>
            </div>
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
