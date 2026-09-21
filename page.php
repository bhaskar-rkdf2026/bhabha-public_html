<?php 
include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;

// If admission process (id=12) is requested, redirect permanently to the static page
if ($id == 12) {
    header("Location: ".href('admission-process.php'), true, 301);
    exit;
}

$db->where('id', $id);
$pageData = $db->getOne('page');

if(!$pageData) {
    header("Location: ".URL_ROOT);
    exit;
}

// Category & Sidebar determination
$is_admission_page = in_array($id, [1, 13, 24]);
$is_about_page     = in_array($id, [18, 19, 20]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars(!empty($pageData['title']) ? $pageData['title'] : $pageData['heading']);?> - Bhabha University Bhopal</title>
<meta name="description" content="<?php echo htmlspecialchars($pageData['heading']);?> at Bhabha University Bhopal. Explore official university details, announcements and guidelines.">
<?php include('inc.meta.php');?>

<style>
/* ============================================================
   BHABHA UNIVERSITY - CMS PAGE STYLING
   ============================================================ */

/* Main Headings inside CMS Body */
.bu-content-body h1,
.bu-content-body h2,
.bu-content-body h3,
.bu-content-body h4 {
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  color: #0A1B54 !important;
  margin: 22px 0 12px 0 !important;
  font-weight: 700 !important;
  line-height: 1.45 !important;
}

.bu-content-body h1 { font-size: 22px !important; }
.bu-content-body h2 { font-size: 20px !important; }
.bu-content-body h3 { font-size: 18px !important; }
.bu-content-body h4 { font-size: 16px !important; }

/* Dynamic Links Styling */
.bu-content-body a {
  color: #1E6091 !important;
  font-size: 15px !important;
  font-weight: 600 !important;
  line-height: 1.6 !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
}

.bu-content-body a:hover {
  color: #0A1B54 !important;
  text-decoration: underline !important;
}

.bu-content-body p {
  font-size: 14.5px !important;
  line-height: 1.8 !important;
  color: #374151 !important;
  margin-bottom: 14px !important;
}

.bu-content-body strong, 
.bu-content-body b {
  color: #0A1B54 !important;
  font-weight: 700 !important;
}

.bu-content-body p:empty,
.bu-content-body h1:empty,
.bu-content-body h2:empty {
  display: none !important;
}

/* Styled Lists inside CMS Content */
.bu-content-body ul, 
.bu-content-body ol {
  margin: 14px 0 20px 24px !important;
  line-height: 1.8 !important;
  color: #374151 !important;
  padding-left: 6px !important;
}

.bu-content-body ul li, 
.bu-content-body ol li {
  margin-bottom: 10px !important;
  font-size: 14px !important;
  line-height: 1.75 !important;
  color: #374151 !important;
}

/* Action CTA Bar */
.bu-page-cta-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 28px;
  padding-top: 22px;
  border-top: 1px solid #E2E8F0;
  width: 100%;
  box-sizing: border-box;
}

.bu-btn-page-gold {
  background: #FFC107;
  color: #0A1B54 !important;
  font-size: 13px;
  font-weight: 800;
  padding: 12px 22px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(255, 193, 7, 0.25);
}

.bu-btn-page-gold:hover {
  background: #E5AC00;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(255, 193, 7, 0.35);
}

.bu-btn-page-navy {
  background: #0A1B54;
  color: #FFFFFF !important;
  font-size: 13px;
  font-weight: 800;
  padding: 12px 22px;
  border-radius: 6px;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.25s ease;
}

.bu-btn-page-navy:hover {
  background: #061D7C;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(10, 27, 84, 0.2);
}

@media (max-width: 767px) {
  .bu-page-cta-bar {
    flex-direction: column !important;
    gap: 10px !important;
  }
  .bu-btn-page-gold,
  .bu-btn-page-navy {
    width: 100% !important;
    justify-content: center !important;
    text-align: center !important;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = htmlspecialchars($pageData['heading']);
  $page_subtitle = 'Official information and guidelines from Bhabha University Bhopal.';
  $page_icon     = 'fa-file-text-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => $pageData['heading'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
      if ($is_admission_page) {
        $active_page = ($id == 24) ? 'helpline' : (($id == 1) ? 'bank-details' : (($id == 13) ? 'scholarship' : ''));
        include('inc.admissions-sidebar.php');
      } else {
        $active_page = ($id == 20) ? 'overview' : (($id == 18) ? 'values' : (($id == 19) ? 'why-us' : '')); 
        include('inc.about-sidebar.php'); 
      }
    ?>

    <main class="bu-inner-content">

      <!-- ============================================================
           STANDARD DYNAMIC CMS PAGE CONTAINER
           ============================================================ -->
      <div class="bu-content-card" style="overflow: hidden;">
        <span class="bu-content-label"><?php echo $is_admission_page ? 'Admissions 2026-27' : 'Bhabha University'; ?></span>
        <h2 class="bu-content-h2"><?php echo htmlspecialchars($pageData['heading']);?></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <?php echo $pageData['data'];?>
          <div style="clear:both;"></div>
        </div>

        <?php if ($is_admission_page): ?>
        <div class="bu-page-cta-bar">
          <a href="<?php echo href('online-admission.php');?>" class="bu-btn-page-gold">
            <i class="fa fa-pencil-square-o"></i> Apply for Admission 2026-27
          </a>
          <a href="<?php echo href('course.php');?>" class="bu-btn-page-navy">
            <i class="fa fa-book"></i> Browse Degree Courses
          </a>
          <a href="<?php echo href('page.php','id=24');?>" class="bu-btn-page-navy" style="background:#059669;">
            <i class="fa fa-phone"></i> Admission Helpline
          </a>
        </div>
        <?php endif; ?>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
