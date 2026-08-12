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
      <?php
      $page_title    = 'Alumni <em>Registration</em>';
      $page_subtitle = 'Stay connected with the Bhabha University family and join our growing network of successful alumni.';
      $page_icon     = 'fa-graduation-cap';
      $breadcrumbs   = [
        ['label' => 'Home',     'url' => URL_ROOT],
        ['label' => 'Alumni',   'url' => '#'],
      ];
      include('inc.page-banner.php');
      ?>
<style>
.bu-full-width-container { max-width: 1200px; margin: 0 auto; padding: 50px 20px 80px; font-family: 'Plus Jakarta Sans', sans-serif; }
.bu-form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 20px; }
.bu-form-group { margin-bottom: 16px; }
.bu-form-group label { display: block; font-size: 12.5px; font-weight: 700; color: #061D7C; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
.bu-form-control { width: 100%; padding: 12px 16px; border: 1px solid #D1D5DB !important; border-radius: 6px; font-size: 14px; color: #1F2937; background: #F9FAFB; transition: all 0.25s ease; box-sizing: border-box; }
.bu-form-control:focus { outline: none; border-color: #0A1B54; background: #ffffff; box-shadow: 0 0 0 3px rgba(10,27,84,0.1); }
.bu-btn-submit { background: #0A1B54; color: #FFC107; font-weight: 800; font-size: 14px; letter-spacing: 1.2px; text-transform: uppercase; padding: 14px 36px; border: none; border-radius: 6px; cursor: pointer; transition: all 0.25s ease; box-shadow: 0 4px 16px rgba(10,27,84,0.2); }
.bu-btn-submit:hover { background: #061D7C; color: #ffffff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(10,27,84,0.3); }
</style>

<div class="bu-full-width-container" id="validation">
  <div style="margin-bottom:20px;"> <?php echo msg($stat);?></div>
  
  <div style="background:#fff; border:1px solid #E5E7EB; border-radius:12px; padding:40px; box-shadow:0 8px 24px rgba(6,29,124,0.04);">
    <h2 style="font-size:26px; font-weight:800; color:#061D7C; margin-bottom:30px; font-family:'Playfair Display', serif;">Alumni Registration</h2>
    <form action="" method="post">
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Name</label>
          <input type="text" name="name" class="bu-form-control" value="<?php echo $_POST['name'];?>">
        </div>
        <div class="bu-form-group">
          <label>Father's Name</label>
          <input type="text" name="fname" class="bu-form-control" value="<?php echo $_POST['fname'];?>">
        </div>
        <div class="bu-form-group">
          <label>Nick Name (During College)</label>
          <input type="text" name="nick_name" class="bu-form-control" value="<?php echo $_POST['nick_name'];?>">
        </div>
        <div class="bu-form-group">
          <label>Gender</label>
          <select name="gender" class="bu-form-control no-selectric">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>College</label>
          <input type="text" name="college" class="bu-form-control" value="<?php echo $_POST['college'];?>">
        </div>
        <div class="bu-form-group">
          <label>Course</label>
          <input type="text" name="course" class="bu-form-control" value="<?php echo $_POST['course'];?>">
        </div>
        <div class="bu-form-group">
          <label>Branch</label>
          <input type="text" name="branch" class="bu-form-control" value="<?php echo $_POST['branch'];?>">
        </div>
        <div class="bu-form-group">
          <label>Admission Year</label>
          <input type="text" name="admission_year" class="bu-form-control" value="<?php echo $_POST['admission_year'];?>">
        </div>
      </div>
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Further Study</label>
          <input type="text" name="further_study" class="bu-form-control" value="<?php echo $_POST['further_study'];?>">
        </div>
        <div class="bu-form-group">
          <label>Date of Birth</label>
          <input type="text" name="dob" class="bu-form-control datepicker" value="<?php echo $_POST['dob'];?>">
        </div>
        <div class="bu-form-group">
          <label>Mobile No.</label>
          <input type="tel" name="mobile" class="bu-form-control" value="<?php echo $_POST['mobile'];?>">
        </div>
        <div class="bu-form-group">
          <label>Email ID</label>
          <input type="email" name="email" class="bu-form-control" value="<?php echo $_POST['email'];?>">
        </div>
      </div>
      
      <div class="bu-form-group" style="margin-bottom:20px;">
        <label>Permanent Address</label>
        <input type="text" name="address" class="bu-form-control" value="<?php echo $_POST['address'];?>">
      </div>
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Occupation</label>
          <select name="occupation" class="bu-form-control no-selectric">
            <option value="">Select Occupation</option>
            <option value="Private Job">Private Job</option>
            <option value="Government Job">Government Job</option>
            <option value="Self Employed">Self Employed</option>
          </select>
        </div>
        <div class="bu-form-group">
          <label>Company</label>
          <input type="text" name="company" class="bu-form-control" value="<?php echo $_POST['company'];?>">
        </div>
        <div class="bu-form-group">
          <label>Job Title</label>
          <input type="text" name="job_title" class="bu-form-control" value="<?php echo $_POST['job_title'];?>">
        </div>
        <div class="bu-form-group">
          <label>Current City</label>
          <input type="text" name="city" class="bu-form-control" value="<?php echo $_POST['city'];?>">
        </div>
      </div>
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Marital Status</label>
          <select name="marital" class="bu-form-control no-selectric">
            <option value="">Select Marital Status</option>
            <option value="Married">Married</option>
            <option value="Unmarried">Unmarried</option>
          </select>
        </div>
        <div class="bu-form-group">
          <label>If married, Date of Marriage</label>
          <input type="text" name="dom" class="bu-form-control datepicker" value="<?php echo $_POST['dom'];?>">
        </div>
        <div class="bu-form-group">
          <label>LinkedIn profile link</label>
          <input type="text" name="linkedin" class="bu-form-control" value="<?php echo $_POST['linkedin'];?>">
        </div>
        <div class="bu-form-group">
          <label>Facebook profile link</label>
          <input type="text" name="facebook" class="bu-form-control" value="<?php echo $_POST['facebook'];?>">
        </div>
      </div>
      
      <div style="margin-top:20px;">
        <button type="submit" name="submit" class="bu-btn-submit">Submit Registration <i class="fa fa-paper-plane" style="margin-left:6px;"></i></button>
      </div>
    </form>
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
