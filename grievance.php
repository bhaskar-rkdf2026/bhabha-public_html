<?php include_once("config.php");
$stat=array();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	$data = Array(
			"name" => $_POST['name'],
			"course" => $_POST['course'],
			"year" => $_POST['year'],
			"enrollment" => $_POST['enrollment'],
			"mobile" => $_POST['mobile'],
			"email" => $_POST['email'],
			"grievance" => $_POST['grievance']
			 );
		$id = $db->insert('grievance',$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'Send Successfully';
		redirect(href("grievance.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grievance - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3>Grievance</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Grievance</a></li>
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
                <h3>Grievance </h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des" id="validation">
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post">
                      <div class="row">
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Full Name</span>
                        <input type="text" name="name" value="<?php echo $_POST['name'];?>" >
                      </div>
                        </div>
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Course</span>
                        <select name="course" id="course" required>
                              <option value=""> Select Course</option>
                              <?php
$course = $db->get('course');
if(is_array($course) && count($course)>0)
          {
              foreach($course as $icourse)
              { 
?>
                              <option value="<?php echo $icourse['id']?>"> <?php echo $icourse['course']?></option>
                              <?php 
			  }
		  }?>
                            </select>
                      </div>
                        </div>
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Year</span>
                        <input required type="number" name="year" value="<?php echo $_POST['year'];?>" >
                      </div>
                        </div>
                  </div>
                      <div class="row">
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Enrollment Number</span>
                        <input required type="text" name="enrollment" value="<?php echo $_POST['enrollment'];?>" >
                      </div>
                        </div>
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Mobile No.</span>
                        <input required type="tel" name="mobile" value="<?php echo $_POST['mobile'];?>" >
                      </div>
                        </div>
                    <div class="col-sm-4">
                          <div class="inputs_des"> <span>Email ID</span>
                        <input required type="text" name="email" value="<?php echo $_POST['email'];?>" >
                      </div>
                        </div>
                  </div>
                      <div class="row">
                    <div class="col-sm-12">
                          <div class="inputs_des"> <span>Grievance Details</span>
                        <input required type="text" name="grievance" value="<?php echo $_POST['grievance'];?>" >
                      </div>
                        </div>
                  </div>
                      <div class="row" style="margin-top:20px;">
                    <div class="col-sm-12">
                          <div class="contact_des">
                        <button type="submit" name="submit">Submit</button>
                      </div>
                        </div>
                  </div>
                    </form>
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
