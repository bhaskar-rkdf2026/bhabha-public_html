<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3>Photo Gallery</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Photo Gallery</a></li>
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
              <ul id="filterable-item-filter-1">
            <li><a data-value="all">All</a></li>
            <?php
$institutes = $db->get('department');
if(is_array($institutes) && count($institutes)>0)
          {
              foreach($institutes as $iinstitutes)
              { 
?>
            <li><a data-value="<?php echo $iinstitutes['id']?>"><?php echo $iinstitutes['title']?></a></li>
            <?php 
			  }
		  }?>
          </ul>
              <div id="filterable-item-holder-1">
            <?php
$gallery = $db->get('gallery');
if(is_array($gallery) && count($gallery)>0)
          {
              foreach($gallery as $igallery)
              { 
?>
            <div class="filterable-item all <?php echo $igallery['department']?> col-md-4 col-sm-4 col-xs-12">
                  <div class="edu_masonery_thumb"> <img src="<?php echo URL_UPLOAD;?>gallery/thumb/<?php echo $igallery['image']?>" alt="<?php echo $igallery['title']?>"/>
                <div class="caption"><a href="#"><?php echo $igallery['title']?></a></div>
                <a href="<?php echo URL_UPLOAD;?>gallery/large/<?php echo $igallery['image']?>" rel="prettyPhoto[pp_gal]" class="zoom"><i class="fa fa-search"></i></a> </div>
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
