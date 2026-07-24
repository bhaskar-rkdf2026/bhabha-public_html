<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses, Intake and Eligibility - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3>Courses, Intake and Eligibility</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="<?php echo href("course.php")?>">Courses, Intake and Eligibility</a></li>
              </ul>
                </div>
          </div>
              <!--KF INR BANNER DES Wrap End--> 
            </div>
      </div>
        </div>
  </div>
      <div class="kf_course_outerwrap">

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row"> 
              <!--COURSE CATEGORIES WRAP START-->
              <div class="kf_cur_catg_wrap"> 
                <!--COURSE CATEGORIES WRAP HEADING START-->
                <div class="col-md-12">
                  <div class="kf_edu2_heading1">
                    <h3>Courses, Intake and Eligibility</h3>
                  </div>
                </div>
                <!--COURSE CATEGORIES WRAP HEADING END--> 
                    <?php
					$i=1;
$department = $db->get('department');
if(is_array($department) && count($department)>0)
          {
              foreach($department as $idepartment)
              { 
?>
                <!--COURSE CATEGORIES DES START-->
                <div class="col-md-4">
                <a href="<?php echo href("program.php","id=".$idepartment['id']."");?>">
                  <div class="kf_cur_catg_des color-<?php echo $i?>"> <span><i class="<?php echo $idepartment['icon']?>"></i></span>
                    <div class="kf_cur_catg_capstion">
                      <h5><?php echo $idepartment['title']?></h5>
                    
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
              </div>
              <!--COURSE CATEGORIES WRAP END--> 
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--NEWS LETTERS END--> 
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
