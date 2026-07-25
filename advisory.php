<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cells & Committees - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University's statutory Cells and Committees — IQAC, ICC, NSS, Anti-Ragging, Grievance and more. Explore our governance bodies.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Cells & <em>Committees</em>';
  $page_subtitle = 'Our active statutory committees ensure governance, welfare, quality assurance and compliance across all university activities.';
  $page_icon     = 'fa-sitemap';
  $breadcrumbs   = [
    ['label' => 'Home',     'url' => URL_ROOT],
    ['label' => 'About',    'url' => href('about.php')],
    ['label' => 'Cells & Committees', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'advisory'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Governance & Welfare</span>
        <h2 class="bu-content-h2">Cells & <em>Committees</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">

        <?php
        $advisory = $db->get('advisory');
        if(is_array($advisory) && count($advisory) > 0) {
          echo '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;margin-top:10px;">';
          foreach($advisory as $iadvisory) { ?>
          <a target="_blank" 
             href="<?php echo URL_UPLOAD;?>advisory/<?php echo $iadvisory['image']?>" 
             style="display:flex;align-items:center;gap:12px;padding:16px 18px;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:7px;text-decoration:none;transition:all 0.25s;border-left:3px solid #FFC107;"
             onmouseover="this.style.background='#0A1B54';this.style.color='#fff';"
             onmouseout="this.style.background='#F8FAFC';this.style.color='';">
            <i class="fa fa-file-pdf-o" style="color:#D99B00;font-size:18px;flex-shrink:0;"></i>
            <span style="font-size:13.5px;font-weight:600;color:inherit;line-height:1.4;"><?php echo $iadvisory['title']?></span>
          </a>
          <?php }
          echo '</div>';
        } else {
          $committees = [
            ['name'=>'Internal Quality Assurance Cell (IQAC)','icon'=>'fa-shield','desc'=>'Ensures quality enhancement and sustenance in all academic and administrative activities.'],
            ['name'=>'Internal Complaints Committee (ICC)','icon'=>'fa-balance-scale','desc'=>'Addresses complaints related to sexual harassment under the POSH Act, 2013.'],
            ['name'=>'Anti-Ragging Committee','icon'=>'fa-ban','desc'=>'Works to prevent and address ragging incidents on campus as per UGC regulations.'],
            ['name'=>'Grievance Redressal Cell','icon'=>'fa-comments','desc'=>'Provides a platform for students and staff to raise and resolve grievances effectively.'],
            ['name'=>'SC/ST Cell','icon'=>'fa-users','desc'=>'Safeguards the rights and welfare of students belonging to Scheduled Castes and Tribes.'],
            ['name'=>'NSS Unit','icon'=>'fa-hand-o-up','desc'=>'National Service Scheme unit engaging students in community service and social development.'],
            ['name'=>'Research & Innovation Cell','icon'=>'fa-flask','desc'=>'Encourages and coordinates research activities, patents, and innovation among faculty and students.'],
            ['name'=>'Women Empowerment Cell','icon'=>'fa-female','desc'=>'Promotes gender equality, empowers women students and staff, and organises awareness programmes.'],
            ['name'=>'Placement Cell','icon'=>'fa-briefcase','desc'=>'Coordinates campus recruitment, industry visits, and career counselling for students.'],
            ['name'=>'Alumni Cell','icon'=>'fa-graduation-cap','desc'=>'Maintains lifelong engagement with alumni and leverages their expertise for current students.'],
            ['name'=>'Sports Committee','icon'=>'fa-futbol-o','desc'=>'Organises and promotes sports activities, inter-university competitions and physical fitness.'],
            ['name'=>'Cultural Committee','icon'=>'fa-music','desc'=>'Plans and executes cultural events, festivals, and arts activities throughout the academic year.'],
          ];
          echo '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">';
          foreach($committees as $c): ?>
          <div style="background:#F8FAFC;border:1px solid #E5E7EB;border-left:3px solid #FFC107;border-radius:7px;padding:20px 18px;transition:all 0.25s;" onmouseover="this.style.boxShadow='0 8px 24px rgba(6,29,124,0.1)';this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none';this.style.transform='none'">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
              <div style="width:36px;height:36px;background:rgba(10,27,84,0.08);border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="fa <?php echo $c['icon'];?>" style="font-size:15px;color:#0A1B54;"></i>
              </div>
              <h4 style="font-size:14px;font-weight:700;color:#061D7C;margin:0;font-family:'Plus Jakarta Sans',sans-serif;line-height:1.3;"><?php echo $c['name'];?></h4>
            </div>
            <p style="font-size:13px;line-height:1.6;color:#6B7280;margin:0;"><?php echo $c['desc'];?></p>
          </div>
          <?php endforeach;
          echo '</div>';
        } ?>

        </div>
      </div>
    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
