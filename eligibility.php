<?php include('config.php');
$db->where('id',$_REQUEST['id']);
$aryData = $db->getOne('course');


$db->where('id',$aryData['department']);
$department = $db->getOne('department');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="Unlock Your Future with PGDCA <?php echo $aryData['course']?> at Bhabha University">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aryData['course']?>- Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h1><?php echo $aryData['course']?></h1>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                 <li><a href="<?php echo href("course.php")?>">Courses, Intake and Eligibility</a></li>
                 <li><a href="<?php echo href("program.php","id=".$department['id']."");?>"><?php echo $department['title']?></a></li>
                <li><a href="#"><?php echo $aryData['course']?></a></li>
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
                <h3><?php echo $aryData['course']?></h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des" >
                      <div class="table-responsive">
                      <?php echo $aryData['details']?> </div>
                </div></div>
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
