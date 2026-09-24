<?php include('config.php');
$db->where('id',$_REQUEST['id']);
$aryData = $db->getOne('news_and_announcement');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aryData['title']?> - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = $aryData['title'] ?? 'Official Announcement';
      $page_subtitle = 'University Circular &amp; Public Notice';
      $page_icon     = 'fa-bullhorn';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'Notice Board', 'url' => href('notice.php')],
        ['label' => 'Announcement', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'announcements';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Official Announcement</span>
            <h2 class="bu-content-h2"><?php echo htmlspecialchars($aryData['title'] ?? 'Announcement Details'); ?></h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px; font-size:15px; line-height:1.8; color:#334155;">
                  <?php if (!empty($aryData['date'])): ?>
                    <div style="margin-bottom:15px; font-size:13px; color:#64748B;">
                      <i class="fa fa-calendar" style="color:#0A1B54; margin-right:6px;"></i> Posted on: <?php echo date('F d, Y', strtotime($aryData['date'])); ?>
                    </div>
                  <?php endif; ?>
                  
                  <div>
                    <?php echo $aryData['description'] ?? '<p>No details found for this announcement.</p>'; ?>
                  </div>
                  
                  <div style="margin-top:30px; padding-top:20px; border-top:1px solid #E2E8F0;">
                    <a href="<?php echo href('notice.php');?>" class="bu-table-dl">
                      <i class="fa fa-arrow-left"></i> Back to Notices &amp; Announcements
                    </a>
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
