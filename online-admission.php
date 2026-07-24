<?php include('config.php');
define("UPLOAD",'admission/');
$stat=array();
if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	include('file.validation.php');
	
	$high_school = 'School : '.$_POST['high-school'].','.' Board : '.$_POST['high-board'].','.' Year of Pssing : '.$_POST['high-yop'].','.' Roll No. : '.$_POST['high-roll-number'].','.' Total Marks : '.$_POST['high-total-marks'].','.' Marks Obtained : '.$_POST['high-marks-obtn'].','.' Percentage  : '.$_POST['high-persent'].','.' Division : '.$_POST['high-division'].','.' CGPA : '.$_POST['high-cgpa'];
	
	$higher_school = 'School : '.$_POST['higher_school'].','.' Board : '.$_POST['higher-board'].','.' Year of Pssing : '.$_POST['higher-yop'].','.' Roll No. : '.$_POST['higher-roll'].','.' Stream. : '.$_POST['higher-stream'].','.' Total Marks : '.$_POST['higher-marks'].','.' Marks Obtained : '.$_POST['higher-marks-ob'].','.' Percentage  : '.$_POST['higher-persent'].','.' Division : '.$_POST['higher-division'].','.' CGPA : '.$_POST['higher-cgpa'];
	
	$graduation = 'College : '.$_POST['g-college'].','.' University : '.$_POST['g-university'].','.' Year of Pssing : '.$_POST['g-yop'].','.' Roll No : '.$_POST['g-roll-number'].','.' Course : '.$_POST['g-course'].','.' Branch : '.$_POST['g-branch'].','.' Total Marks : '.$_POST['g-marks'].','.' Marks Obtained : '.$_POST['g-marks-ob'].','.' Percentage : '.$_POST['g-percentage'].','.' Division : '.$_POST['g-division'].','.' CGPA : '.$_POST['g-cgpa'];
					
	
	$pgraduation = 'College : '.$_POST['pg-college'].','.'University : '.$_POST['pg-university'].','.'Year of Pssing : '.$_POST['pg-yop'].','.'Roll No : '.$_POST['pg-roll-number'].','.'Course : '.$_POST['pg-course'].','.'Branch : '.$_POST['pg-branch'].','.'Total Marks : '.$_POST['pg-total-marks'].','.'Marks Obtained : '.$_POST['pg-marks-obtn'].','.'Percentage : '.$_POST['pg-peresent'].','.'Division : '.$_POST['pg-division'].','.'CGPA : '.$_POST['pg-cgpa'];
			
	$payment = 'Mode : '.$_POST['mode'].','.' Amount : '.$_POST['amount'].','.' DD Cheque : '.$_POST['dd-cheque'].','.' Date : '.$_POST['date'].','.' Bank : '.$_POST['bank'].','.' IFSC : '.$_POST['ifsc'].','.' Internet Banking : '.$_POST['internet-banking'].','.' Paytm : '.$_POST['paytm'];
	$data = Array(
			"name" => $_POST['name'],
			"fname" => $_POST['fname'],
			"mother" => $_POST['mother'],
			"occupation" => $_POST['occupation'],
			"gender" => $_POST['gender'],
			"mobile" => $_POST['mobile'],
			"permanent_address" => $_POST['permanent_address'],
			"present_address" => $_POST['present_address'],
			"phone" => $_POST['phone'],
			"email" => $_POST['email'],
			"dob" => $_POST['dob'],
			"nationality" => $_POST['nationality'],
			"religion" => $_POST['religion'],
			"domicile" => $_POST['domicile'],
			"aadhar" => $_POST['aadhar'],
			"category" => $_POST['category'],
			"domicile_c" => $_POST['domicile_c'],
			"income_c" => $_POST['income_c'],
			"category_c" => $_POST['category_c'],
			"course" => $_POST['course'],
			"branch" => $_POST['branch'],
			"high_school" => $high_school,
			"higher_secondary" => $higher_school,
			"graduation" => $graduation,
			"pgraduation" => $pgraduation,
			"sports" => $_POST['sports'],
			"activities" => $_POST['activities'],
			"studying" => $_POST['studying'],
			"reference_one" => $_POST['reference_one'],
			"references_two" => $_POST['references_two'],
			"know-about" => $_POST['know-about'],
			"payment" => $payment,
			"domicile_number" => $_POST['domicile_number'],
			"domicile_issue_date" => $_POST['domicile_issue_date'],
			"caste_number" => $_POST['caste_number'],
			"caste_issue_date" => $_POST['caste_issue_date'],
			"income_number" => $_POST['income_number'],
			"income_issue_date" => $_POST['income_issue_date'],
			"high_school_number" => $_POST['high_school_number'],
			"high_school_rollnumber" => $_POST['high_school_rollnumber'],
			"higher_school_number" => $_POST['higher_school_number'],
			"higher_school_rollnumber" => $_POST['higher_school_rollnumber'],
			"g_cnumber" => $_POST['g_cnumber'],
			"g_rollnumber" => $_POST['g_rollnumber'],
			"pg_cnumber" => $_POST['pg_cnumber'],
			"pg_rollnumber" => $_POST['pg_rollnumber']
			 );
			include('file.upload.php');
	
			$id = $db->insert('admission',$data);
			unset($_POST);
			unset($_SESSION['form']);
			$_SESSION["success"] = 'Form Submited Successfully';
			redirect(href('online-admission.php'));	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Admission Form - Bhabha University Bhopal Madhya Pradesh</title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>
<script type="text/javascript">
   $(document).ready(function(){
	   $("#course").change(function(){					 
			 var course=$("#course").val();
			 
			 $.ajax({
				type:"post",
				url:"<?php echo URL_ROOT;?>getBranch.php",
				data:"course="+course,
				success:function(data){
					  $("#branch").html(data);
				}
			 });
	   });
   });
</script>
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
              <h3>Online Admission Form</h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Online Admission Form</a></li>
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
                <h3>Online Admission Form</h3>
              </div>
              <!-- HEADING 1 END-->
              <div class="abt_univ_des" style="margin-bottom:20px !important;">
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Name</span>
                        <input type="text" value="<?php $_POST['name'] ?>" name="name" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Father's Name</span>
                        <input type="text" value="<?php $_POST['fname'] ?>" name="fname" required>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Father's Occupation </span>
                        <input type="text" value="<?php $_POST['occupation'] ?>" name="occupation" required>
                      </div>
                    </div>
                    
                    
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                      <div class="inputs_des"> <span>Mother Name</span>
                        <input type="text" value="<?php $_POST['mother'] ?>" name="mother" required>
                      </div>
                    </div>
                  <div class="col-sm-4">
                      <div class="inputs_des"> <span>Gender</span>
                        <select name="gender" required>
                          <option value=""> Select Gender</option>
                          <option value="Male"> Male</option>
                          <option value="Female"> Female</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Mobile Number</span>
                        <input type="tel" value="<?php $_POST['mobile'] ?>" name="mobile">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="inputs_des"> <span>Permanent Address</span>
                        <input type="text" value="<?php $_POST['permanent_address'] ?>" name="permanent_address" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="inputs_des"> <span>Present Address</span>
                        <input type="text" value="<?php $_POST['present_address'] ?>" name="present_address" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Phone Number</span>
                        <input type="tel" value="<?php $_POST['phone'] ?>" name="phone">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Email Address</span>
                        <input type="email" value="<?php $_POST['email'] ?>" name="email">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Date Of Birth</span>
                        <input type="text" class="datepicker" value="<?php $_POST['dob'] ?>" name="dob"  required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Nationality</span>
                        <input type="text" value="<?php $_POST['nationality'] ?>" name="nationality" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Religion</span>
                        <input type="text" value="<?php $_POST['religion'] ?>" name="religion">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>State of Domicile</span>
                        <input type="text" value="<?php $_POST['domicile'] ?>" name="domicile" placeholder="State Name" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Aadhar Card Number</span>
                        <input type="number" value="<?php $_POST['aadhar'] ?>" maxlength="12" name="aadhar" >
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Select Category</span>
                        <select name="category" required>
                          <option value=""> Select Category</option>
                          <option value="GEN"> GEN</option>
                          <option value="OBC"> OBC</option>
                          <option value="SC"> SC</option>
                          <option value="ST"> ST</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Domicile Certificate</span>
                        <select name="domicile_c" required>
                          <option value=""> Select Domicile</option>
                          <option value="Yes"> Yes</option>
                          <option value="No"> No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Income Certificate</span>
                        <select name="income_c" required>
                          <option value=""> Select Income</option>
                          <option value="Yes"> Yes</option>
                          <option value="No"> No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Category Certificate</span>
                        <select name="category_c" required>
                          <option value=""> Select Category</option>
                          <option value="Yes"> Yes</option>
                          <option value="No"> No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6">
                      <div class="inputs_des"> <span>Branch</span>
                        <select name="branch" id="branch">
                          <option value=""> Select Branch</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <p><strong>EDUCATION – HIGH SCHOOL</strong></p>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <?php
$hschool = $db->get('high_school');
if(is_array($hschool) && count($hschool)>0)
          {
              foreach($hschool as $ihschool)
              { 
?>
                            <td><?php echo $ihschool['title']?></td>
                            <?php 
			  }
		  }?>
                          </tr>
                          <tr>
                            <?php
$hschool = $db->get('high_school');
if(is_array($hschool) && count($hschool)>0)
          {
              foreach($hschool as $ihschool)
              { 
?>
                            <td><input type="text" name="<?php echo $ihschool['name'];?>"></td>
                            <?php 
			  }
		  }?>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <p><strong>EDUCATION – HIGHER SCHOOL</strong></p>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <?php
$hsecondary = $db->get('higher_secondary');
if(is_array($hsecondary) && count($hsecondary)>0)
          {
              foreach($hsecondary as $ihsecondary)
              { 
			  ?>
                            <td><?php echo $ihsecondary['title']?></td>
                            <?php 
			  }
		  }?>
                          </tr>
                          <tr>
                            <?php
$hsecondary = $db->get('higher_secondary');
if(is_array($hsecondary) && count($hsecondary)>0)
          {
              foreach($hsecondary as $ihsecondary)
              { 
?>
                            <td><input type="text" name="<?php echo $ihsecondary['name'];?>"></td>
                            <?php 
			  }
		  }?>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <p><strong>GRADUATION (NOT FOR ADMISSION IN UG COURSE)</strong></p>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <?php
$graduation = $db->get('graduation');
if(is_array($graduation) && count($graduation)>0)
          {
              foreach($graduation as $igraduation)
              { 
			  ?>
                            <td><?php echo $igraduation['title']?></td>
                            <?php 
			  }
		  }?>
                          </tr>
                          <tr>
                            <?php
$graduation = $db->get('graduation');
if(is_array($graduation) && count($graduation)>0)
          {
              foreach($graduation as $igraduation)
              { 
?>
                            <td><input type="text" name="<?php echo $igraduation['name'];?>" ></td>
                            <?php 
			  }
		  }?>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <p><strong>POST GRADUATION (NOT FOR ADMISSION IN PG COURSE)</strong></p>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <?php
$pgraduation = $db->get('pgraduation');
if(is_array($pgraduation) && count($pgraduation)>0)
          {
              foreach($pgraduation as $ipgraduation)
              { 
			  ?>
                            <td><?php echo $ipgraduation['title']?></td>
                            <?php 
			  }
		  }?>
                          </tr>
                          <tr>
                            <?php
$pgraduation = $db->get('pgraduation');
if(is_array($pgraduation) && count($pgraduation)>0)
          {
              foreach($pgraduation as $ipgraduation)
              { 
?>
                            <td><input type="text" name="<?php echo $ipgraduation['name'];?>" ></td>
                            <?php 
			  }
		  }?>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <p><strong>ANY OTHER RELEVANT QUALIFICATION, PLEASE GIVE DETAILS</strong></p>
                  <div class="row">
                    <div class="col-sm-12" style="margin-top:10px !important;">
                      <div class="inputs_des"> <span>Whether participated in National/State level sports, please give details</span>
                        <input type="text" value="<?php $_POST['sports'] ?>" name="sports">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-top:10px !important;">
                      <div class="inputs_des"> <span>Details of Extra/Co curricular Activities</span>
                        <input type="text" value="<?php $_POST['activities'] ?>" name="activities">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-top:10px !important;">
                      <div class="inputs_des"> <span>Do you know someone studying in this University? If yes  please give details</span>
                        <input type="text" value="<?php $_POST['studying'] ?>" name="studying">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>REFERENCES ONE</span>
                        <input type="text" value="<?php $_POST['reference_one'] ?>" name="reference_one" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>REFERENCES TWO</span>
                        <input type="text" value="<?php $_POST['references_two'] ?>" name="references_two" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Know About Us</span>
                        <select name="know-about">
                          <option value=""> Select Know About Us</option>
                          <option value="Advertisement"> Advertisement</option>
                          <option value="Newspaper"> Newspaper</option>
                          <option value="TV"> TV</option>
                          <option value="Social Media"> Social Media</option>
                          <option value="Publicity Boards"> Publicity Boards</option>
                          <option value="By Reference"> By Reference</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table class=".table-bordered">
                          <tr>
                            <?php
$headingpayment = $db->get('payment');
if(is_array($headingpayment) && count($headingpayment)>0)
          {
              foreach($headingpayment as $iheadingpayment)
              { 
?>
                            <td><?php echo $iheadingpayment['title']?></td>
                            <?php 
			  }
		  }?>
                          </tr>
                          <tr>
                            <?php
$payment = $db->get('payment');
if(is_array($payment) && count($payment)>0)
          {
              foreach($payment as $ipayment)
              { 
?>
                            <td><input type="text" name="<?php echo $ipayment['name'] ?>"></td>
                            <?php 
			  }
		  }?>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <p><strong>Upload Documents</strong></p>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Domicile Certificate Number, </span>
                        <input type="text" name="domicile_number" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Date of Issue</span>
                        <input type="text" name="domicile_issue_date" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Domicile Certificate</span>
                        <input type="file" name="upload_domicile" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Caste-
                        Certificate Number, </span>
                        <input type="text" name="caste_number" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Date of Issue</span>
                        <input type="text" name="caste_issue_date" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Caste-
                        Certificate</span>
                        <input type="file" name="upload_caste" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Income Certificate Number, </span>
                        <input type="text" name="income_number" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Date of Issue</span>
                        <input type="text" name="income_issue_date" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Income Certificate</span>
                        <input type="file" name="upload_income" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>High School –
                        Certificate Number, </span>
                        <input type="text" name="high_school_number" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>High School –
                        Roll Number</span>
                        <input type="text" name="high_school_rollnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload High School –
                        Certificate</span>
                        <input type="file" name="upload_high_school" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Higher 
                        Secondary
                        –
                        Certificate Number, </span>
                        <input type="text" name="higher_school_number" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Higher 
                        Secondary
                        –
                        Roll Number</span>
                        <input type="text" name="higher_school_rollnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Higher 
                        Secondary
                        –
                        Certificate</span>
                        <input type="file" name="upload_higher_school" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Graduation –
                        Certificate Number, </span>
                        <input type="text" name="g_cnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Graduation –
                        Roll Number</span>
                        <input type="text" name="g_rollnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Graduation –
                        Certificate</span>
                        <input type="file" name="uploadg" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Post Graduation –
                        Certificate Number, </span>
                        <input type="text" name="pg_cnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Post Graduation –
                        Roll Number</span>
                        <input type="text" name="pg_rollnumber" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Upload Post Graduation –
                        Certificate</span>
                        <input type="file" name="uploadpg" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Aadhar Card</span>
                        <input type="file" name="aadhar_card" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Passport Size Photo</span>
                        <input type="file" name="photo" >
                      </div>
                    </div>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                      <div class="inputs_des"> <span>Other Documents (JPG,PDF & DOCX)</span>
                        <input type="file" name="otherdocx" >
                      </div>
                    </div>
                  </div>
                  <div class="row" style="padding:20px;">
                    <p style="padding-top:20px;">
                      <input type="checkbox" name="tnc" required>
                      &nbsp;The above information given by me in the Admission Form are true to the best of my knowledge. However should it be found that any information therein are untrue/wrong i am/my ward is liable to be disqualified for Admission.</p>
                    <p>If i/my ward selected for admission. I/my promise to abide by the rules & regulations of the Institute/University and maintain discipline in the Institute and the Hostel.</p>
                    <p>Initially the admission is provisional and is subject to confirmation from counseling authority/University. </p>
                    <p>It is compulsory for me/my ward to appear for counseling at the Bhabha University or at any place directed by the university on the specified date and time failing which i/my ward’s registration will automatically be cancelled without any refund of fee.</p>
                    <p>I understand that if i get my admission/registration cancelled fees deposited by me is nonrefundable.</p>
                    <p>Cancellation of registration is not possible without paying the full fees for the entire course.</p>
                    <p>I agree to pay fees for the whole course if i leave course in midstream. </p>
                    <p>Any dispute is subject to Bhopal jurisdiction.</p>
                    <p>Admission and seat allotment as per Bhabha University norms.</p>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="margin-top:20px !important;">
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
