<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Media - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3>News Media</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">News Media</a></li>
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
    <div class="gallery-masonery_page gallery inner-content-holder">
          <div class="container">
        <div class="row">
              <div id="filterable-item-holder-1">
            <?php
$db->orderBy("orders","desc");

$news = $db->get('news');
if(is_array($news) && count($news)>0)
          {
              foreach($news as $inews)
              { 
?>
            <div class="filterable-item all col-md-4 col-sm-4 col-xs-12">
                  <div class="edu_masonery_thumb"> <img src="<?php echo URL_UPLOAD;?>news/thumb/<?php echo $inews['image']?>" alt="<?php echo $inews['title']?>"/>
                <div class="caption"><a href="#"><?php echo $inews['title']?></a></div>
                <a href="<?php echo URL_UPLOAD;?>news/<?php echo $inews['image']?>" rel="prettyPhoto[pp_gal]" class="zoom"><i class="fa fa-search"></i></a> </div>
                </div>
            <?php 
			  }
		  }?>
          </div>
            </div>
      </div>
        </div>
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
