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
      <div class="kf_inr_banner">
    <div class="container">
          <div class="row">
        <div class="col-md-12"> 
              <!--KF INR BANNER DES Wrap Start-->
              <div class="kf_inr_ban_des">
            <div class="inr_banner_heading">
                  <h3><?php echo strip_tags(portalVal($portalPage, 'heading', 'Hotel Management')); ?></h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo strip_tags(portalVal($portalPage, 'heading', 'Hotel Management')); ?></a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <!--NEWS LETTERS END-->
      <div class="kf_content_wrap"> 
    
    <!--ABOUT UNIVERSITY START-->
    <section>
          <div class="container">
        <div class="row">
              <div class="col-md-12">
            <div class="abt_univ_wrap"> 
                  <!-- HEADING 1 START-->
                  <div class="kf_edu2_heading1">
                <h5><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></h5>
                <h3><?php echo portalVal($portalPage, 'heading', 'Hotel Management'); ?></h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des"> 
                    <?php if (!empty($portalPage['data']['body'])): ?>
                      <div style="font-size:15px;line-height:1.8;color:#475569;margin-bottom:24px;">
                        <?php echo $portalPage['data']['body']; ?>
                      </div>
                    <?php endif; ?>
                    <div align="center">
                      <a href="<?php echo URL_UPLOAD;?>files/B3.docx"><strong>PROPOSED ONLINE CERTIFICATE COURSES DETAILS SESSION -- 2020-2021</strong></a>
                      <br><br>
                      <img src="<?php echo URL_IMG;?>hotel-school.jpg" style="max-width:100%;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,0.08);"><br>
                    </div>
                  </div>
                </div>
          </div>
            </div>
      </div>
        </section>
    <!--ABOUT UNIVERSITY END--> 
    
  </div>
      <!--FOOTER START-->
      <?php include('inc.footer.php');?>
      
      <!--FOOTER END--> 
      <!--COPYRIGHTS START--> 
      
      <!--COPYRIGHTS START--> 
    </div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>
</body>
</html>
