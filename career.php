<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('career') : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo portalVal($portalPage, 'page_title', 'Careers &amp; Opportunities - Bhabha University Bhopal'); ?></title>
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
              <h3><?php echo strip_tags(portalVal($portalPage, 'heading', 'Careers &amp; Opportunities')); ?></h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo strip_tags(portalVal($portalPage, 'heading', 'Careers')); ?></a></li>
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
                <h5><?php echo portalVal($portalPage, 'badge', 'WORK WITH US'); ?></h5>
                <h3><?php echo portalVal($portalPage, 'heading', 'Careers at Bhabha University'); ?></h3>
              </div>
              <div class="abt_univ_des" style="font-size:15px;line-height:1.8;color:#475569;">
                <?php if (!empty($portalPage['data']['body'])): ?>
                  <?php echo $portalPage['data']['body']; ?>
                <?php else: ?>
                  <p>Bhabha University offers competitive compensation, research incentives, sabbatical leaves, and health coverage for teaching and non-teaching personnel. We are committed to attracting distinguished faculty and dynamic administrators who are passionate about student success and groundbreaking research.</p>
                  <p>Interested candidates may forward their updated curriculum vitae to <strong>info@bhabhauniversity.edu.in</strong> or apply directly through our HR portal.</p>
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
