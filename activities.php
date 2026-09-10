<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('activities') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Campus Activities - Bhabha University Bhopal Madhya Pradesh'); ?></title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>
</head>

<body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->
  <div class="kf_inr_banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="kf_inr_ban_des">
            <div class="inr_banner_heading">
              <h3><?php echo strip_tags(portalVal($portalPage, 'heading', 'Campus Activities')); ?></h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo strip_tags(portalVal($portalPage, 'heading', 'Activities')); ?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="kf_content_wrap">
    <section style="padding:60px 0;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="abt_univ_wrap">
              <div class="kf_edu2_heading1">
                <h5><?php echo portalVal($portalPage, 'badge', 'STUDENT LIFE'); ?></h5>
                <h3><?php echo portalVal($portalPage, 'heading', 'Campus Activities &amp; Student Life'); ?></h3>
              </div>
              <div class="abt_univ_des" style="font-size:15px;line-height:1.8;color:#475569;">
                <?php if (!empty($portalPage['data']['body'])): ?>
                  <?php echo $portalPage['data']['body']; ?>
                <?php else: ?>
                  <p>Campus life at Bhabha University is vibrant and holistic. Students participate in technical hackathons, cultural festivals like Tarang, inter-university sports championships, NSS community camps, and debate societies, fostering well-rounded personality development.</p>
                  <p>Our expansive campus features cricket arenas, basketball courts, badminton courts, cultural auditoriums, and dedicated student activity centers.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END--> 
</div>
<!--Bootstrap core JavaScript--> 
<?php include('inc.footer.js.php');?>
</body>
</html>
