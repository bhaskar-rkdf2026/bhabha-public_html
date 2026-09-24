<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('hotel') : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo portalVal($portalPage, 'page_title', 'Hotel Management - Bhabha University Bhopal Madhya Pradesh'); ?></title>
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
      $page_title    = portalVal($portalPage, 'heading', 'Hotel <em>Management</em>');
      $page_subtitle = 'Culinary Arts, Hospitality Management &amp; Food Production';
      $page_icon     = 'fa-cutlery';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'Departments', 'url' => href('departments.php')],
        ['label' => strip_tags(portalVal($portalPage, 'heading', 'Hotel Management')), 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'hotel';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></span>
            <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'Faculty of Hotel Management &amp; Catering'); ?></h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
                  <?php if (!empty($portalPage['data']['body'])): ?>
                    <div style="font-size:15px;line-height:1.8;color:#475569;margin-bottom:24px;">
                      <?php echo $portalPage['data']['body']; ?>
                    </div>
                  <?php endif; ?>

                  <div class="bu-doc-banner">
                    <div style="display:flex; align-items:center; gap:14px;">
                      <div style="width:44px; height:44px; border-radius:8px; background:rgba(10,27,84,0.08); display:flex; align-items:center; justify-content:center; color:#0A1B54; font-size:20px; flex-shrink:0;">
                        <i class="fa fa-file-word-o" style="color:#0A1B54;"></i>
                      </div>
                      <div>
                        <h4 style="margin:0 0 3px 0; font-size:16px; font-weight:700; color:#0A1B54;">Proposed Online Certificate Courses</h4>
                        <p style="margin:0; font-size:13px; color:#64748B;">Detailed syllabus &amp; course structure brochure</p>
                      </div>
                    </div>
                    <a href="<?php echo URL_UPLOAD;?>files/B3.docx" target="_blank" class="bu-btn">
                      <i class="fa fa-download"></i> Download Course Details
                    </a>
                  </div>

                  <div style="border-radius:12px; overflow:hidden; box-shadow:0 6px 24px rgba(0,0,0,0.08);">
                    <img src="<?php echo URL_IMG;?>hotel-school.jpg" alt="Hotel Management Faculty" style="width:100%; height:auto; display:block;">
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
