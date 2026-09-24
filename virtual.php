<?php include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Tour - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Virtual <em>Tour</em>';
      $page_subtitle = 'Experience Bhabha University Campus from Anywhere';
      $page_icon     = 'fa-video-camera';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'Virtual Tour', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>
      
      <div class="bu-inner-layout">
        <?php 
        $active_page = 'virtual';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Campus Walkthrough</span>
            <h2 class="bu-content-h2">Explore Bhabha University</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              <p style="font-size:15px;color:#475569;margin-bottom:20px;">
                Take a comprehensive virtual walkthrough of our lush green campus, modern research laboratories, academic blocks, auditoriums, and world-class student facilities.
              </p>
              <div style="border-radius:12px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,0.12); background:#000;">
                <video width="100%" controls style="display:block; max-height:560px; outline:none;">
                  <source src="<?php echo URL_UPLOAD?>video/bhabha_video.mp4" type="video/mp4">
                  Your browser does not support HTML video.
                </video>
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
