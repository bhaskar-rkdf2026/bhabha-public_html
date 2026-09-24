<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar Plant - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Solar <em>Plant</em>';
      $page_subtitle = 'Clean & Renewable Energy Initiative at Bhabha University';
      $page_icon     = 'fa-sun-o';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'Solar Plant', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'solar';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Green Campus Initiative</span>
            <h2 class="bu-content-h2">100 KW Solar Power Plant</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              
              <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px; margin-bottom:28px;">
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:18px 16px; text-align:center;">
                  <div style="font-size:24px; font-weight:800; color:#0A1B54; font-family:'Playfair Display',serif;">100 KW</div>
                  <div style="font-size:12px; font-weight:700; color:#FFC107; text-transform:uppercase; margin-top:4px;">Installed Capacity</div>
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:18px 16px; text-align:center;">
                  <div style="font-size:24px; font-weight:800; color:#0A1B54; font-family:'Playfair Display',serif;">500 kWh</div>
                  <div style="font-size:12px; font-weight:700; color:#FFC107; text-transform:uppercase; margin-top:4px;">Daily Clean Energy</div>
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:18px 16px; text-align:center;">
                  <div style="font-size:24px; font-weight:800; color:#0A1B54; font-family:'Playfair Display',serif;">136 Tonnes</div>
                  <div style="font-size:12px; font-weight:700; color:#FFC107; text-transform:uppercase; margin-top:4px;">Annual CO2 Offset</div>
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-top:3px solid #0A1B54; border-radius:8px; padding:18px 16px; text-align:center;">
                  <div style="font-size:24px; font-weight:800; color:#0A1B54; font-family:'Playfair Display',serif;">1,980 m²</div>
                  <div style="font-size:12px; font-weight:700; color:#FFC107; text-transform:uppercase; margin-top:4px;">Rooftop Panel Area</div>
                </div>
              </div>

              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:16px;">
                <strong>Bhabha University, Bhopal</strong> has commissioned a state-of-the-art 100 kW solar power plant across its campus rooftops to reduce dependence on conventional non-renewable energy sources and foster sustainable, eco-friendly campus operations.
              </p>
              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:16px;">
                The solar power installation is fabricated with high-efficiency polycrystalline silicon modules and produces an average of 500 kWh (units) of electricity every single day. The system consists of 339 advanced Solar PV panels (295W each), spreading across 1,980 square meters of rooftop area, achieving a carbon footprint reduction of 136 tonnes annually.
              </p>
              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:16px;">
                Part of the electricity needs of the academic and laboratory blocks are directly supplied by this plant. The university also conducts active student research on concentrated photovoltaic systems to enhance energy yield while advancing green technologies in education.
              </p>
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
