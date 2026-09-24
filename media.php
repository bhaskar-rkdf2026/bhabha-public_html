<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Media &amp; <em>Press</em>';
      $page_subtitle = 'Print, Digital &amp; Television Coverage of Bhabha University';
      $page_icon     = 'fa-newspaper-o';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'Media Coverage', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'media';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Press &amp; Media Releases</span>
            <h2 class="bu-content-h2">University News In The Media</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:24px;">
                Read about Bhabha University’s academic breakthroughs, faculty achievements, campus events, and university milestones featured across national and regional press publications.
              </p>

              <div style="display:flex; flex-direction:column; gap:28px;">
                <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.06); padding:16px;">
                  <img src="<?php echo URL_IMG;?>media-two.jpg" alt="Bhabha University Media Coverage" style="width:100%; height:auto; display:block; border-radius:8px;">
                </div>

                <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.06); padding:16px;">
                  <img src="<?php echo URL_IMG;?>media-one.jpg" alt="Bhabha University Press Release" style="width:100%; height:auto; display:block; border-radius:8px;">
                </div>

                <div style="background:#fff; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.06); padding:16px;">
                  <img src="<?php echo URL_IMG;?>school-media.jpg" alt="School &amp; Faculty In Media" style="width:100%; height:auto; display:block; border-radius:8px;">
                </div>
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
