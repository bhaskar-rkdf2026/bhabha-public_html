<?php include('config.php');
$db->where('id',$_REQUEST['id']);
$aryData = $db->getOne('department');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aryData['title']?> - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3><?php echo $aryData['title']?></h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#"><?php echo $aryData['title']?></a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <!--NEWS LETTERS END--> 
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row"> 
              <!--COURSE CATEGORIES WRAP START-->
              <div class="kf_cur_catg_wrap"> 
                <!--COURSE CATEGORIES WRAP HEADING START-->
                <div class="col-md-12">
                  <div class="kf_edu2_heading1">
                    <h3><?php echo $aryData['title']?></h3>
                  </div>
                </div>
                
                <div style="margin-left:20px;">
          <?php echo $aryData['about']?>
          
         </div>
         
                <!--COURSE CATEGORIES WRAP HEADING END--> 
                    <?php
					$i=1;
					$db->where('department',$_REQUEST['id']);
$insti = $db->get('institute');
if(is_array($insti) && count($insti)>0)
          {
              foreach($insti as $iinsti)
              { 
?>
                <!--COURSE CATEGORIES DES START-->
                <div class="col-md-6">
                <a href="<?php echo href("institute.php","id=".$iinsti['id']."");?>">
                  <div class="kf_cur_catg_des color-<?php echo $i?>"> <span><i class="<?php echo $aryData['icon']?>"></i></span>
                    <div class="kf_cur_catg_capstion">
                      <h5><?php echo $iinsti['institute_name']?></h5>
                    
                    </div>
                  </div></a>
                </div>
                <!--COURSE CATEGORIES DES END--> 
               <?php 
			   $i++;
			   if($i==7)
			   {
				   $i=1;
			   }
			  }
		  }?>
          <br>
          
              </div>
              <h3><strong><span style="color:#cc6600">Photo Gallery</span><span style="color:#cc6600"> </span></strong></h3><br>
              <div id="filterable-item-holder-1">
            <?php
			$db->where('department',$_REQUEST['id']);
$gallery = $db->get('gallery');
if(is_array($gallery) && count($gallery)>0)
          {
              foreach($gallery as $igallery)
              { 
?>
            <div class="filterable-item all col-md-4 col-sm-4 col-xs-12">
                  <div class="edu_masonery_thumb"> <img src="<?php echo URL_UPLOAD;?>gallery/thumb/<?php echo $igallery['image']?>" alt="<?php echo $igallery['title']?>"/>
                <div class="caption"><a href="#"><?php echo $igallery['title']?></a></div>
                <a href="<?php echo URL_UPLOAD;?>gallery/large/<?php echo $igallery['image']?>" rel="prettyPhoto[pp_gal]" class="zoom"><i class="fa fa-search"></i></a> </div>
                </div>
            <?php 
			  }
		  }?>
          </div>
              <!--COURSE CATEGORIES WRAP END--> 
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
