<?php 
include('config.php');
$portalPage = function_exists('getPortalPage') ? getPortalPage('public-md') : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo portalVal($portalPage, 'page_title', 'Public Mandatory Disclosure - Bhabha University Bhopal'); ?></title>
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
      $page_title    = portalVal($portalPage, 'heading', 'Public Mandatory <em>Disclosure</em>');
      $page_subtitle = 'Official Student Certificates, Degree Application Forms &amp; Transcripts';
      $page_icon     = 'fa-certificate';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => strip_tags(portalVal($portalPage, 'heading', 'Public Mandatory Disclosure')), 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'public-md';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label"><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></span>
            <h2 class="bu-content-h2"><?php echo portalVal($portalPage, 'heading', 'Public Mandatory Disclosures &amp; Application Forms'); ?></h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
                  <table class="course-list-table table" style="margin-top:10px;">
                    <thead>
                      <tr>
                        <th style="width:80px; text-align:center;">Type</th>
                        <th style="text-align:left;">Document / Form Title</th>
                        <th style="width:160px; text-align:center;">Download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $default_forms = [
                        ['title'=>'Notice University Certificate (Fees)','url'=>'upload/media/43220e47ba4dc41f2feedaa84d2b75b1.pdf'],
                        ['title'=>'Issue of Duplicate Name Correction In MarkSheet New','url'=>'upload/media/4dfae40cb8bf1f1b5d0fb8b63d542672.pdf'],
                        ['title'=>'Application Form for Issue of Provisional / Migration Certificate','url'=>'upload/media/019c18458f2b9b6485deb792fc7c3c2b.pdf'],
                        ['title'=>'Application for Issue of Degree Certificate','url'=>'upload/media/9feec28a9ceec19a4a7cef2f7f07795a.pdf'],
                        ['title'=>'Application Form for Issue of Transcript','url'=>'upload/media/Application Form for Issue of transcript (1).pdf']
                      ];
                      $display_forms = (!empty($portalPage['data']['forms']) && is_array($portalPage['data']['forms'])) ? $portalPage['data']['forms'] : $default_forms;
                      foreach($display_forms as $f): 
                        $fUrl = strpos($f['url'], 'http') === 0 ? $f['url'] : URL_ROOT . ltrim($f['url'], '/');
                      ?>
                      <tr>
                        <td style="width:80px; text-align:center; vertical-align:middle;">
                          <span style="display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:6px; background:rgba(220,38,38,0.08); color:#DC2626; font-size:16px;">
                            <i class="fa fa-file-pdf-o"></i>
                          </span>
                        </td>
                        <td style="vertical-align:middle;">
                          <a href="<?php echo $fUrl;?>" target="_blank" style="color:#0A1B54; font-weight:700; font-size:14.5px; text-decoration:none;">
                            <?php echo htmlspecialchars($f['title']);?>
                          </a>
                        </td>
                        <td style="width:160px; text-align:center; vertical-align:middle;">
                          <a href="<?php echo $fUrl;?>" target="_blank" download class="bu-table-dl">
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
