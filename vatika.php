<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VATIKA - Bhabha University Bhopal Madhya Pradesh</title>
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
      $page_title    = 'Botanical <em>Vatika</em>';
      $page_subtitle = 'Herbal & Ayurvedic Gardens at Bhabha University Campus';
      $page_icon     = 'fa-leaf';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'Vatika', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'vatika';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Campus Biodiversity &amp; Ayurveda</span>
            <h2 class="bu-content-h2">Traditional &amp; Herbal Vatika Collections</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              <p style="font-size:15px; line-height:1.8; color:#334155; margin-bottom:24px;">
                Bhabha University maintains specialized astrological, medicinal, and ecological botanical gardens across its campus to promote biodiversity, environmental sustainability, and research in Ayurvedic sciences and botany.
              </p>

              <div style="display:flex; flex-direction:column; gap:16px;">
                <?php
                $vatika_list = [
                  [
                    'title' => 'Navgrah Vatika',
                    'desc'  => 'Botanical layout dedicated to the nine celestial planetary flora and traditional medicinal trees.',
                    'pdf'   => URL_UPLOAD . 'media/9ace0ddc31bab9c2cd740ebb0501a138.pdf',
                    'icon'  => 'fa-tree'
                  ],
                  [
                    'title' => 'Nakshatra Vatika',
                    'desc'  => 'Specially curated 27 sacred floral species corresponding to cosmic Nakshatras and planetary astrology.',
                    'pdf'   => URL_UPLOAD . 'media/5152b2ae2930adf0067e9bca01ceca0e.pdf',
                    'icon'  => 'fa-star-o'
                  ],
                  [
                    'title' => 'Panchtatva Vatika',
                    'desc'  => 'Garden embodying the 5 primordial elements (Prithvi, Jal, Agni, Vayu, Akash) for environmental balance.',
                    'pdf'   => URL_UPLOAD . 'media/62971404675378a264e5505ce58dc2aa.pdf',
                    'icon'  => 'fa-globe'
                  ]
                ];

                foreach($vatika_list as $vat):
                ?>
                <div class="bu-doc-banner">
                  <div style="flex:1; min-width:240px;">
                    <h4 style="margin:0 0 6px 0; font-size:16px; font-weight:700; color:#0A1B54; display:flex; align-items:center; gap:8px;">
                      <i class="fa <?php echo $vat['icon']; ?>" style="color:#D99B00; font-size:18px;"></i>
                      <?php echo htmlspecialchars($vat['title']); ?>
                    </h4>
                    <p style="margin:0; font-size:13.5px; color:#64748B; line-height:1.6;">
                      <?php echo htmlspecialchars($vat['desc']); ?>
                    </p>
                  </div>
                  <div>
                    <a href="<?php echo $vat['pdf']; ?>" target="_blank" class="bu-btn">
                      <i class="fa fa-file-pdf-o"></i> View Document
                    </a>
                  </div>
                </div>
                <?php endforeach; ?>
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
