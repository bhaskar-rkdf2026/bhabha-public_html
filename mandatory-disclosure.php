<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('mandatory-disclosure') : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo portalVal($portalPage, 'page_title', 'Mandatory-disclosure - Bhabha University Bhopal Madhya Pradesh'); ?></title>
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
      $page_title    = portalVal($portalPage, 'heading', 'Mandatory <em>Disclosure</em>');
      $page_subtitle = 'Statutory Documents, Affiliations &amp; Regulatory Disclosures';
      $page_icon     = 'fa-file-text-o';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => strip_tags(portalVal($portalPage, 'heading', 'Mandatory Disclosure')), 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'mandatory-disclosure';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></span>
            <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'Mandatory Regulatory Disclosures'); ?></h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
                  <?php if (!empty($portalPage['data']['body'])): ?>
                    <div style="font-size:15px;line-height:1.8;color:#475569;margin-bottom:24px;">
                      <?php echo $portalPage['data']['body']; ?>
                    </div>
                  <?php endif; ?>

                  <table class="course-list-table table" style="margin-top:10px;">
                    <thead>
                      <tr>
                        <th style="width:50px; text-align:center;">Format</th>
                        <th style="text-align:left;">Document / Report Title</th>
                        <th style="width:150px; text-align:center;">Download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($portalPage['data']['docs']) && is_array($portalPage['data']['docs'])): ?>
                        <?php foreach ($portalPage['data']['docs'] as $d): 
                          $dUrl = strpos($d['url'], 'http') === 0 ? $d['url'] : URL_ROOT . ltrim($d['url'], '/');
                        ?>
                        <tr>
                          <td style="width:50px; vertical-align:middle; text-align:center;"><i class="fa fa-file-pdf-o" style="color:#DC2626; font-size:20px;"></i></td>
                          <td style="vertical-align:middle;"><a href="<?php echo $dUrl;?>" target="_blank" style="color:#0A1B54; font-weight:600; text-decoration:none;"><?php echo htmlspecialchars($d['title']); ?></a></td>
                          <td style="text-align:center; vertical-align:middle;"><a href="<?php echo $dUrl;?>" target="_blank" download class="bu-table-dl"><i class="fa fa-download"></i> Download</a></td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="3" style="text-align:center; color:#64748B; padding:30px;">Regulatory disclosure records are being updated for the current academic session.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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
