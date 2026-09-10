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
      <div class="kf_inr_banner">
    <div class="container">
          <div class="row">
        <div class="col-md-12"> 
              <!--KF INR BANNER DES Wrap Start-->
              <div class="kf_inr_ban_des">
            <div class="inr_banner_heading">
                  <h3><?php echo strip_tags(portalVal($portalPage, 'heading', 'Public Mandatory Disclosure')); ?></h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo strip_tags(portalVal($portalPage, 'heading', 'Public Mandatory Disclosure')); ?></a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <!--NEWS LETTERS END-->
      <div class="kf_content_wrap"> 
    
    <!--ABOUT UNIVERSITY START-->
    <section>
          <div class="container">
        <div class="row">
              <div class="col-md-12">
            <div class="abt_univ_wrap"> 
                  <!-- HEADING 1 START-->
                  <div class="kf_edu2_heading1">
                <h5><?php echo portalVal($portalPage, 'badge', 'BHABHA UNIVERSITY'); ?></h5>
                <h3><?php echo portalVal($portalPage, 'heading', 'Public Mandatory Disclosure'); ?></h3>
              </div>
                  <!-- HEADING 1 END-->
                   <div class="abt_univ_des" > <table class="course-list-table table">
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
			<td><img src="<?php echo URL_UPLOAD;?>media/6922d10c4a182131bad863d95a4b7010.gif" /></td>
			<td><a href="<?php echo $fUrl;?>" target="_blank"><span style="color:#cc6600"><?php echo htmlspecialchars($f['title']);?></span></a></td>
		</tr>
    <?php endforeach; ?>
	</tbody>
</table>
 </div>
                      
                  </ul>
                    </div>
              </div>
                </div>
          </div>
            </div>
      </div>
        </section>
    <!--ABOUT UNIVERSITY END--> 
    
  </div>
      <!--FOOTER START-->
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
