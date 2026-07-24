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
			"fname" => $_POST['fname'],
			"nick_name" => $_POST['nick_name'],
			"gender" => $_POST['gender'],
			"college" => $_POST['college'],
			"course" => $_POST['course'],
			"branch" => $_POST['branch'],
			"admission_year" => $_POST['admission_year'],
			"further_study" => $_POST['further_study'],
			"dob" => $_POST['dob'],
			"mobile" => $_POST['mobile'],
			"email" => $_POST['email'],
			"address" => $_POST['address'],
			"occupation" => $_POST['occupation'],
			"company" => $_POST['company'],
			"job_title" => $_POST['job_title'],
			"city" => $_POST['city'],
			"marital" => $_POST['marital'],
			"dom" => $_POST['dom'],
			"linkedin" => $_POST['linkedin'],
			"facebook" => $_POST['facebook']
			 );
		$id = $db->insert('alumni',$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'Send Successfully';
		redirect(href("alumni.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni - Bhabha University Bhopal Madhya Pradesh</title>
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
                  <h3>Alumni</h3>
                </div>
            <div class="kf_inr_breadcrumb">
                  <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Alumni</a></li>
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
                <h3>Alumni Registration </h3>
              </div>
                  <!-- HEADING 1 END-->
                  <div class="abt_univ_des" id="validation">
                        
          <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post">
                <div class="row">
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Name</span>
                          <input type="text" name="name" value="<?php echo $_POST['name'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Father's Name</span>
                          <input type="text" name="fname" value="<?php echo $_POST['fname'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Nick Name (During College)</span>
                          <input type="text" name="nick_name" value="<?php echo $_POST['nick_name'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Gender</span>
                          <select name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                        </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>College </span>
                          <input type="text" name="college" value="<?php echo $_POST['college'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Course </span>
                          <input type="text" name="course" value="<?php echo $_POST['course'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Branch </span>
                          <input type="text" name="branch" value="<?php echo $_POST['branch'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Admission Year </span>
                          <input type="text" name="admission_year" value="<?php echo $_POST['admission_year'];?>" >
                        </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Further Study</span>
                          <input type="text" name="further_study" value="<?php echo $_POST['further_study'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Date of Birth</span>
                          <input type="text" class="datepicker" name="dob" value="<?php echo $_POST['dob'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Mobile No.</span>
                          <input type="text" name="mobile" value="<?php echo $_POST['mobile'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Email ID</span>
                          <input type="text" name="email" value="<?php echo $_POST['email'];?>" >
                        </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                    <div class="inputs_des"> <span>Permanent Address</span>
                          <input type="text" name="address" value="<?php echo $_POST['address'];?>" >
                        </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Occupation</span>
                          <select name="occupation">
                        <option value="">Select Occupation</option>
                        <option value="Private Job">Private Job</option>
                        <option value="Government Job">Government Job</option>
                        <option value="Self Employed">Self Employed</option>
                      </select>
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Company</span>
                          <input type="text" name="company" value="<?php echo $_POST['company'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Job Title</span>
                          <input type="text" name="job_title" value="<?php echo $_POST['job_title'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Current City</span>
                          <input type="text" name="city" value="<?php echo $_POST['city'];?>" >
                        </div>
                  </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Marital Status</span>
                          <select name="marital">
                        <option value="">Select Marital Status</option>
                        <option value="Married">Married</option>
                        <option value="Unmarried">Unmarried</option>
                      </select>
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>If married, Date of Marriage</span>
                          <input type="text" class="datepicker" name="dom" value="<?php echo $_POST['dom'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>LinkedIn profile link</span>
                          <input type="text" name="linkedin" value="<?php echo $_POST['linkedin'];?>" >
                        </div>
                  </div>
                      <div class="col-sm-3">
                    <div class="inputs_des"> <span>Facebook profile link</span>
                          <input type="text" name="facebook" value="<?php echo $_POST['facebook'];?>" >
                        </div>
                  </div>
                  </div>
                  
                  <div class="row">
                  <div class="col-sm-12">
                      <div class="contact_des">
                    <button type="submit" name="submit">Submit</button>
                  </div></div>
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
