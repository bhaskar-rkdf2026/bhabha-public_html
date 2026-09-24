<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('refund-policy') : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo portalVal($portalPage, 'page_title', 'Refund and Cancellation Policy - Bhabha University Bhopal'); ?></title>
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
      <style>
      /* Policy Page Premium Theme */
      .bu-policy-hero {
        background: linear-gradient(135deg, #051235 0%, #0A1B54 60%, #061D7C 100%);
        padding: 95px 20px 65px 20px;
        text-align: center;
        color: white;
        margin-bottom: 45px;
        position: relative;
        overflow: hidden;
      }
      .bu-policy-hero::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 193, 7, 0.08);
        pointer-events: none;
      }
      .bu-policy-hero h1 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(32px, 4vw, 44px);
        font-weight: 800;
        margin-top: 10px;
        margin-bottom: 14px;
        color: #ffffff;
        letter-spacing: -0.3px;
      }
      .bu-policy-breadcrumb {
        font-size: 13px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.7);
        letter-spacing: 0.5px;
        text-transform: uppercase;
      }
      .bu-policy-breadcrumb a {
        color: #FFC107;
        text-decoration: none;
        transition: 0.3s ease;
      }
      .bu-policy-breadcrumb a:hover {
        color: #ffffff;
        text-decoration: underline;
      }
      .bu-policy-container {
        max-width: 960px;
        margin: 0 auto;
        padding: 0 20px 90px;
      }
      .bu-policy-content {
        background: #ffffff;
        padding: 50px 60px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(6, 29, 124, 0.06);
        border: 1px solid #E2E8F0;
      }
      .bu-policy-content h2,
      .bu-policy-content h3,
      .bu-policy-content h4 {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 22px;
        font-weight: 800;
        color: #061D7C;
        margin-top: 36px;
        margin-bottom: 16px;
        padding-top: 24px;
        border-top: 1px solid #F1F5F9;
      }
      .bu-policy-content h2:first-of-type,
      .bu-policy-content h3:first-of-type,
      .bu-policy-content h4:first-of-type {
        margin-top: 0;
        padding-top: 0;
        border-top: none;
      }
      .bu-policy-content p {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 20px;
      }
      .bu-policy-content ul,
      .bu-policy-content ol {
        padding-left: 22px;
        margin-bottom: 25px;
      }
      .bu-policy-content li {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 12px;
      }
      .bu-policy-content strong {
        color: #061D7C;
      }
      @media (max-width: 768px) {
        .bu-policy-hero {
          padding: 80px 16px 50px;
        }
        .bu-policy-hero h1 {
          font-size: 28px;
        }
        .bu-policy-content {
          padding: 30px 20px;
        }
      }
      </style>

      <div class="bu-policy-hero">
        <div class="container">
          <h1><?php echo strip_tags(portalVal($portalPage, 'heading', 'Refund and Cancellation Policy')); ?></h1>
          <div class="bu-policy-breadcrumb">
            <a href="<?php echo URL_ROOT;?>">Home</a> &nbsp;&bull;&nbsp; <?php echo strip_tags(portalVal($portalPage, 'heading', 'Refund and Cancellation Policy')); ?>
          </div>
        </div>
      </div>

      <div class="bu-policy-container">
        <div class="bu-policy-content">
          <?php if (!empty($portalPage['data']['body'])): ?>
            <?php echo $portalPage['data']['body']; ?>
          <?php else: ?>
          <p><strong>Bhabha University</strong> supports its students. However, if there is a discrepancy or error in the payment amount or transaction details, please contact our accounts office within 30 days between 9:30 AM and 4:45 PM (IST) on working days to resolve the issue.</p>
          <?php endif; ?>
        </div>
      </div>
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
