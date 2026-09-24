<?php include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment -  Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Online Fee <em>Payment</em>';
      $page_subtitle = 'Secure Digital Fee Payment Portal via Paytm &amp; UPI';
      $page_icon     = 'fa-credit-card';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'Admissions', 'url' => href('admission-process.php')],
        ['label' => 'Online Fee Payment', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'paytm';
        include('inc.admissions-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Online Services</span>
            <h2 class="bu-content-h2">Pay Tuition &amp; Examination Fees Online</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
                  <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:24px;">
                    Students and parents can make quick, secure online tuition fee, bus fee, hostel fee, and examination fee payments through the authorized Bhabha University digital gateway.
                  </p>

                  <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:24px; text-align:center; max-width:540px; margin:0 auto 30px auto; box-shadow:0 4px 16px rgba(0,0,0,0.04);">
                    <div style="font-size:18px; font-weight:800; color:#0A1B54; margin-bottom:12px;">Official Paytm Smart URL Portal</div>
                    <div style="margin-bottom:20px;">
                      <a href="https://m.p-y.tm/bhabhauniversity_nrweb" target="_blank" class="bu-btn" style="font-size:15px; padding:12px 28px; border-radius:8px;">
                        <i class="fa fa-external-link"></i> Pay Via Paytm Smart Portal
                      </a>
                    </div>
                    <div style="font-size:13px; color:#64748B; margin-bottom:20px;">
                      Direct Link: <a href="https://m.p-y.tm/bhabhauniversity_nrweb" target="_blank" style="color:#0A1B54; font-weight:600;">m.p-y.tm/bhabhauniversity_nrweb</a>
                    </div>
                    <div style="border-radius:10px; overflow:hidden; border:1px solid #E2E8F0; display:inline-block; max-width:100%;">
                      <img src="<?php echo URL_IMG;?>paytm.jpeg" alt="Bhabha University Paytm Payment QR" style="max-width:100%; height:auto; display:block;">
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
