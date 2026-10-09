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
                        <th style="width:80px; text-align:center;">Type</th>
                        <th style="text-align:left;">Document / Report Title</th>
                        <th style="width:160px; text-align:center;">Download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $defaultDocs = [
                          ['title' => 'Mandatory Public Disclosure — Bhabha University Bhopal', 'url' => (defined('URL_UPLOAD') ? URL_UPLOAD : URL_ROOT . 'upload/') . 'media/12dfaac45ab95d2c718f63563d7c5a28.pdf']
                        ];
                        $docsList = (!empty($portalPage['data']['docs']) && is_array($portalPage['data']['docs'])) ? $portalPage['data']['docs'] : $defaultDocs;
                        foreach ($docsList as $d): 
                          $rawUrl = $d['url'];
                          // Sanitize localhost/127.0.0.1 if stored in database
                          $rawUrl = preg_replace('#https?://(?:localhost|127\.0\.0\.1)(?::\d+)?/bhabha-public_html/#i', (defined('URL_ROOT') ? URL_ROOT : '/'), $rawUrl);
                          $dUrl = preg_match('/^(https?:\/\/|\/|#)/i', $rawUrl) ? $rawUrl : (defined('URL_ROOT') ? URL_ROOT : '/') . ltrim($rawUrl, '/');
                        ?>
                        <tr>
                          <td style="width:80px; text-align:center; vertical-align:middle;">
                            <span style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:6px; background:rgba(220,38,38,0.08); color:#DC2626; font-size:16px;">
                              <i class="fa fa-file-pdf-o"></i>
                            </span>
                          </td>
                          <td style="vertical-align:middle;">
                            <a href="<?php echo $dUrl;?>" target="_blank" style="color:#0A1B54; font-weight:700; font-size:14.5px; text-decoration:none;">
                              <?php echo htmlspecialchars($d['title']); ?>
                            </a>
                          </td>
                          <td style="width:160px; text-align:center; vertical-align:middle;">
                            <a href="<?php echo $dUrl;?>" target="_blank" class="bu-table-dl">
                              <i class="fa fa-download"></i> Download
                            </a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
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
