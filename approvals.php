<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Approvals & Recognitions - Bhabha University Bhopal</title>
<meta name="description" content="Bhabha University holds approvals from UGC, AICTE, PCI, BCI, DCI, NCTE, INC and is NAAC accredited. Explore all official recognitions.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Approvals & <em>Recognitions</em>';
  $page_subtitle = 'Bhabha University holds statutory approvals from India\'s premier regulatory bodies — ensuring quality, credibility and global acceptance of our programmes.';
  $page_icon     = 'fa-certificate';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Approvals & Recognitions', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'approvals'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Accreditations Strip -->
      <div class="bu-content-card" style="background:linear-gradient(135deg,#0A1B54,#061D7C); border-color:#0A1B54; margin-bottom:24px;">
        <h2 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:800;color:#fff;margin:0 0 20px 0;">Our Key <span style="color:#FFC107;">Accreditations</span></h2>
        <div style="display:flex;gap:16px;flex-wrap:wrap;">
          <?php
          $badges = [
            ['name'=>'NAAC', 'desc'=>'Accredited'],
            ['name'=>'UGC',  'desc'=>'2(f) & 12(B)'],
            ['name'=>'AICTE','desc'=>'Approved'],
            ['name'=>'PCI',  'desc'=>'Approved'],
            ['name'=>'BCI',  'desc'=>'Approved'],
            ['name'=>'DCI',  'desc'=>'Approved'],
            ['name'=>'NCTE', 'desc'=>'Approved'],
            ['name'=>'INC',  'desc'=>'Approved'],
            ['name'=>'MPNRC','desc'=>'Recognized'],
          ];
          foreach($badges as $b): ?>
          <div style="background:rgba(255,193,7,0.1);border:1px solid rgba(255,193,7,0.25);border-radius:6px;padding:14px 18px;text-align:center;min-width:90px;">
            <span style="font-family:'Playfair Display',serif;font-size:20px;font-weight:800;color:#FFC107;display:block;line-height:1;margin-bottom:5px;"><?php echo $b['name'];?></span>
            <span style="font-size:9px;font-weight:800;letter-spacing:1px;color:rgba(255,255,255,0.55);text-transform:uppercase;"><?php echo $b['desc'];?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Documents List -->
      <style>
      .bu-approval-card {
        display: flex !important;
        align-items: center !important;
        gap: 14px !important;
        padding: 16px 20px !important;
        background: #F8FAFC !important;
        border: 1px solid #E5E7EB !important;
        border-radius: 7px !important;
        border-left: 3.5px solid #FFC107 !important;
        text-decoration: none !important;
        transition: all 0.25s ease !important;
      }
      .bu-approval-card .bu-app-title {
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #1E293B !important;
        display: block !important;
        line-height: 1.4 !important;
        transition: color 0.25s ease !important;
      }
      .bu-approval-card .bu-app-sub {
        font-size: 11px !important;
        color: #64748B !important;
        display: block !important;
        line-height: 1.3 !important;
        margin-top: 2px !important;
        transition: color 0.25s ease !important;
      }
      .bu-approval-card .bu-app-icon {
        font-size: 22px !important;
        color: #D99B00 !important;
        flex-shrink: 0 !important;
        transition: color 0.25s ease !important;
      }
      .bu-approval-card .bu-app-link-icon {
        font-size: 14px !important;
        color: #D99B00 !important;
        flex-shrink: 0 !important;
        transition: color 0.25s ease !important;
      }

      /* Hover State - White Title, Gold Icons & Subtitle on Dark Navy Card */
      .bu-approval-card:hover {
        background: #0A1B54 !important;
        border-color: #0A1B54 !important;
        border-left-color: #FFC107 !important;
        transform: translateX(4px) !important;
        box-shadow: 0 6px 18px rgba(10, 27, 84, 0.25) !important;
      }
      .bu-approval-card:hover .bu-app-title {
        color: #FFFFFF !important;
      }
      .bu-approval-card:hover .bu-app-sub {
        color: #FFC107 !important;
        opacity: 0.9 !important;
      }
      .bu-approval-card:hover .bu-app-icon,
      .bu-approval-card:hover .bu-app-link-icon {
        color: #FFC107 !important;
      }
      </style>

      <div class="bu-content-card">
        <span class="bu-content-label">Official Documents</span>
        <h2 class="bu-content-h2">Approvals & <em>Recognitions</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">

        <?php
        $approvals = $db->get('approvals');
        if(is_array($approvals) && count($approvals) > 0) {
          echo '<div style="display:grid;gap:10px;">';
          foreach($approvals as $iapprovals) { ?>
          <a target="_blank" 
             href="<?php echo URL_UPLOAD;?>approvals/<?php echo $iapprovals['image']?>"
             class="bu-approval-card">
            <i class="fa fa-file-pdf-o bu-app-icon"></i>
            <div style="flex:1;">
              <span class="bu-app-title"><?php echo $iapprovals['title']?></span>
              <span class="bu-app-sub">Click to view PDF document</span>
            </div>
            <i class="fa fa-external-link bu-app-link-icon"></i>
          </a>
          <?php }
          echo '</div>';
        } else {
          // Default approvals list
          $approvals_list = [
            ['title'=>'UGC Recognition Certificate — Section 2(f) & 12(B)','icon'=>'fa-certificate'],
            ['title'=>'NAAC Accreditation Certificate & Grade Sheet','icon'=>'fa-star'],
            ['title'=>'AICTE Approval Letter — Engineering & Technology','icon'=>'fa-cogs'],
            ['title'=>'Pharmacy Council of India (PCI) Approval','icon'=>'fa-medkit'],
            ['title'=>'Bar Council of India (BCI) Approval — Faculty of Law','icon'=>'fa-balance-scale'],
            ['title'=>'Dental Council of India (DCI) Approval — Dental Sciences','icon'=>'fa-plus-square'],
            ['title'=>'NCTE Approval — Faculty of Education','icon'=>'fa-graduation-cap'],
            ['title'=>'Indian Nursing Council (INC) Approval — Nursing','icon'=>'fa-heartbeat'],
            ['title'=>'MPNRC Recognition Certificate','icon'=>'fa-shield'],
            ['title'=>'MP Private University Act — Establishment Order','icon'=>'fa-university'],
            ['title'=>'Annual Report 2023-24','icon'=>'fa-file-text'],
            ['title'=>'NIRF Data Submission — 2024','icon'=>'fa-bar-chart'],
          ];
          echo '<div style="display:grid;gap:10px;">';
          foreach($approvals_list as $ap): ?>
          <div class="bu-approval-card">
            <i class="fa <?php echo $ap['icon'];?> bu-app-icon"></i>
            <span class="bu-app-title"><?php echo $ap['title'];?></span>
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
