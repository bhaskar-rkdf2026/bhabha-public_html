<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus Radio - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Campus <em>Radio</em>';
      $page_subtitle = 'Radio Popcorn 90.4 FM - Voice of the Community';
      $page_icon     = 'fa-microphone';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'Campus Radio', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'radio';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Community Radio Station</span>
            <h2 class="bu-content-h2">Radio Popcorn 90.4 FM</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              
              <div style="background:linear-gradient(135deg, #0A1B54, #061D7C); color:#fff; border-radius:10px; padding:20px 24px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                <div>
                  <div style="color:#FFC107; font-weight:800; font-size:12px; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">First Campus Radio in MP</div>
                  <div style="font-size:22px; font-weight:800; font-family:'Playfair Display',serif;">Radio Popcorn 90.4 MHz</div>
                  <div style="font-size:13px; opacity:0.85; margin-top:4px;">Launched On 14th February 2008 &bull; Broadcasts 10 Hours Daily</div>
                </div>
                <div>
                  <span style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.3); padding:8px 16px; border-radius:30px; font-size:13px; font-weight:700;">
                    <i class="fa fa-wifi" style="color:#FFC107;"></i> On-Air 90.4 FM
                  </span>
                </div>
              </div>

              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:16px;">
                <strong>Radio Popcorn 90.4 FM</strong> is the first campus community radio station established in the state of Madhya Pradesh, launched on 14th February 2008 by Bhabha Institute of Science and Technology, Bhopal. The station broadcasts 10 hours every day, prioritizing educational opportunities, talent showcases, scientific awareness, and community career guidance.
              </p>

              <h3 style="font-size:18px; font-weight:800; color:#0A1B54; margin:24px 0 10px 0;">Mission &amp; Vision</h3>
              <blockquote style="border-left:4px solid #FFC107; background:#F8FAFC; padding:16px 20px; font-style:italic; color:#475569; border-radius:0 8px 8px 0; margin-bottom:20px;">
                "To provide an inclusive, grassroots medium of communication by giving voice to the community. Special focus is directed towards communities living within the transmission radius to empower marginalized sections and ensure every voice is heard."
              </blockquote>

              <h3 style="font-size:18px; font-weight:800; color:#0A1B54; margin:24px 0 10px 0;">Studio &amp; Infrastructure</h3>
              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:16px;">
                The station houses professional acoustic studios engineered with soundproof acoustic panelling, perforated gypsum insulation, and advanced broadcast mixing consoles. It also maintains production suites, an audio archive library, and student workstation facilities.
              </p>

              <h3 style="font-size:18px; font-weight:800; color:#0A1B54; margin:24px 0 12px 0;">Community Outreach &amp; Program Themes</h3>
              <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:12px; margin-bottom:20px;">
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Women Empowerment &amp; Rights
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Drop-out Girl Child Education
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Self-Employment &amp; Rural Skills
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Health, Hygiene &amp; Monsoon Care
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Environmental Protection &amp; Cycling
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:12px 16px; border-radius:6px; font-size:13.5px; color:#334155;">
                  <i class="fa fa-check-circle" style="color:#0A1B54; margin-right:8px;"></i> Local School Talent Competitions
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
