<?php include('config.php');
$db->where('id',$_REQUEST['id']);
$aryData = $db->getOne('events');
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
                <img src="<?php echo URL_UPLOAD;?>events/<?php echo $aryData['image']?>" width="100%" alt="<?php echo $aryData['title']?>">
                <h4>Event Description</h4>
                <?php echo $aryData['description']?>
                <h4>Event Details</h4>
                 <?php echo $aryData['details']?>
                <!--COURSE CATEGORIES WRAP HEADING END--> 
                
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
