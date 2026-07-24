<?php include('config.php');
$db->where('id',$_REQUEST['id']);
$aryData = $db->getOne('institute');

$db->where('id',$aryData['department']);
$department = $db->getOne('department');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aryData['institute_name']?>- Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3><?php echo $aryData['institute_name']?></h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                 <li><a href="<?php echo href("department.php","id=".$department['id']."");?>"><?php echo $department['title']?></a></li>
                <li><a href="#"><?php echo $aryData['institute_name']?></a></li>
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
                <h5>BHABHA UNIVERSITY</h5>
                <h3><?php echo $aryData['institute_name']?></h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des">
                <h3>About Institute</h3>
                <?php echo $aryData['about_institute']?><br>
                <h3>Principal Message</h3>
                <?php echo $aryData['principal_message']?><br>
                <h3>Courses</h3>
                <?php echo $aryData['courses']?><br>
                <h3>Branches</h3>
                <?php echo $aryData['branches']?><br>
                <h3>Departments</h3>
                <ul style="margin-left:40px">
                
            <?php
			$db->where('institute',$_REQUEST['id']);
$sub_department = $db->get('sub_department');
if(is_array($sub_department) && count($sub_department)>0)
          {
              foreach($sub_department as $isub_department)
              { 
?>
                  <li><a href="<?php echo href("departments.php","id=".$isub_department['id']."");?>"><strong style="color:#cc6600"><?php echo $isub_department['title']?></strong></a></li>
                  <?php 
			  }
		  }?>
                    </ul>
                <?php echo $aryData['departments']?><br>
                <h3>Activities</h3>
                <?php echo $aryData['activities']?><br>
                <h3>Placement</h3>
                <?php echo $aryData['placement']?> </div>
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
