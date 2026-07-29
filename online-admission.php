<?php include('config.php');
define("UPLOAD",'admission/');
$stat=array();
if(isset($_SESSION['success']) && $_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	include('file.validation.php');
	
	$high_school = 'School : '.(isset($_POST['high-school'])?$_POST['high-school']:'').','.' Board : '.(isset($_POST['high-board'])?$_POST['high-board']:'').','.' Year of Passing : '.(isset($_POST['high-yop'])?$_POST['high-yop']:'').','.' Roll No. : '.(isset($_POST['high-roll-number'])?$_POST['high-roll-number']:'').','.' Total Marks : '.(isset($_POST['high-total-marks'])?$_POST['high-total-marks']:'').','.' Marks Obtained : '.(isset($_POST['high-marks-obtn'])?$_POST['high-marks-obtn']:'').','.' Percentage : '.(isset($_POST['high-persent'])?$_POST['high-persent']:'').','.' Division : '.(isset($_POST['high-division'])?$_POST['high-division']:'').','.' CGPA : '.(isset($_POST['high-cgpa'])?$_POST['high-cgpa']:'');
	
	$higher_school = 'School : '.(isset($_POST['higher_school'])?$_POST['higher_school']:'').','.' Board : '.(isset($_POST['higher-board'])?$_POST['higher-board']:'').','.' Year of Passing : '.(isset($_POST['higher-yop'])?$_POST['higher-yop']:'').','.' Roll No. : '.(isset($_POST['higher-roll'])?$_POST['higher-roll']:'').','.' Stream : '.(isset($_POST['higher-stream'])?$_POST['higher-stream']:'').','.' Total Marks : '.(isset($_POST['higher-marks'])?$_POST['higher-marks']:'').','.' Marks Obtained : '.(isset($_POST['higher-marks-ob'])?$_POST['higher-marks-ob']:'').','.' Percentage : '.(isset($_POST['higher-persent'])?$_POST['higher-persent']:'').','.' Division : '.(isset($_POST['higher-division'])?$_POST['higher-division']:'').','.' CGPA : '.(isset($_POST['higher-cgpa'])?$_POST['higher-cgpa']:'');
	
	$graduation = 'College : '.(isset($_POST['g-college'])?$_POST['g-college']:'').','.' University : '.(isset($_POST['g-university'])?$_POST['g-university']:'').','.' Year of Passing : '.(isset($_POST['g-yop'])?$_POST['g-yop']:'').','.' Roll No : '.(isset($_POST['g-roll-number'])?$_POST['g-roll-number']:'').','.' Course : '.(isset($_POST['g-course'])?$_POST['g-course']:'').','.' Branch : '.(isset($_POST['g-branch'])?$_POST['g-branch']:'').','.' Total Marks : '.(isset($_POST['g-marks'])?$_POST['g-marks']:'').','.' Marks Obtained : '.(isset($_POST['g-marks-ob'])?$_POST['g-marks-ob']:'').','.' Percentage : '.(isset($_POST['g-percentage'])?$_POST['g-percentage']:'').','.' Division : '.(isset($_POST['g-division'])?$_POST['g-division']:'').','.' CGPA : '.(isset($_POST['g-cgpa'])?$_POST['g-cgpa']:'');
					
	$pgraduation = 'College : '.(isset($_POST['pg-college'])?$_POST['pg-college']:'').','.'University : '.(isset($_POST['pg-university'])?$_POST['pg-university']:'').','.'Year of Passing : '.(isset($_POST['pg-yop'])?$_POST['pg-yop']:'').','.'Roll No : '.(isset($_POST['pg-roll-number'])?$_POST['pg-roll-number']:'').','.'Course : '.(isset($_POST['pg-course'])?$_POST['pg-course']:'').','.'Branch : '.(isset($_POST['pg-branch'])?$_POST['pg-branch']:'').','.'Total Marks : '.(isset($_POST['pg-total-marks'])?$_POST['pg-total-marks']:'').','.'Marks Obtained : '.(isset($_POST['pg-marks-obtn'])?$_POST['pg-marks-obtn']:'').','.'Percentage : '.(isset($_POST['pg-peresent'])?$_POST['pg-peresent']:'').','.'Division : '.(isset($_POST['pg-division'])?$_POST['pg-division']:'').','.'CGPA : '.(isset($_POST['pg-cgpa'])?$_POST['pg-cgpa']:'');
			
	$payment = 'Mode : '.(isset($_POST['mode'])?$_POST['mode']:'').','.' Amount : '.(isset($_POST['amount'])?$_POST['amount']:'').','.' DD Cheque : '.(isset($_POST['dd-cheque'])?$_POST['dd-cheque']:'').','.' Date : '.(isset($_POST['date'])?$_POST['date']:'').','.' Bank : '.(isset($_POST['bank'])?$_POST['bank']:'').','.' IFSC : '.(isset($_POST['ifsc'])?$_POST['ifsc']:'').','.' Internet Banking : '.(isset($_POST['internet-banking'])?$_POST['internet-banking']:'').','.' Paytm : '.(isset($_POST['paytm'])?$_POST['paytm']:'');

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
			"domicile_c" => isset($_POST['domicile_c'])?$_POST['domicile_c']:'',
			"income_c" => isset($_POST['income_c'])?$_POST['income_c']:'',
			"category_c" => isset($_POST['category_c'])?$_POST['category_c']:'',
			"course" => $_POST['course'],
			"branch" => isset($_POST['branch'])?$_POST['branch']:'',
			"high_school" => $high_school,
			"higher_secondary" => $higher_school,
			"graduation" => $graduation,
			"pgraduation" => $pgraduation,
			"sports" => isset($_POST['sports'])?$_POST['sports']:'',
			"activities" => isset($_POST['activities'])?$_POST['activities']:'',
			"studying" => isset($_POST['studying'])?$_POST['studying']:'',
			"reference_one" => isset($_POST['reference_one'])?$_POST['reference_one']:'',
			"references_two" => isset($_POST['references_two'])?$_POST['references_two']:'',
			"know-about" => isset($_POST['know-about'])?$_POST['know-about']:'',
			"payment" => $payment,
			"domicile_number" => isset($_POST['domicile_number'])?$_POST['domicile_number']:'',
			"domicile_issue_date" => isset($_POST['domicile_issue_date'])?$_POST['domicile_issue_date']:'',
			"caste_number" => isset($_POST['caste_number'])?$_POST['caste_number']:'',
			"caste_issue_date" => isset($_POST['caste_issue_date'])?$_POST['caste_issue_date']:'',
			"income_number" => isset($_POST['income_number'])?$_POST['income_number']:'',
			"income_issue_date" => isset($_POST['income_issue_date'])?$_POST['income_issue_date']:''
			 );

	if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
		$file_ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['photo']['tmp_name'], UPLOAD.$newfile)) {
			$data['photo'] = $newfile;
		}
	}

	$id = $db->insert('admission', $data);
	$_SESSION["success"] = 'Registration Successful! Your Application ID is BU-ADM-'.$id;
	redirect(href("online-admission.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Registration Form - Bhabha University Bhopal</title>
<meta name="description" content="Online Admission & Registration Form for Bhabha University Bhopal — Apply for UG, PG, Diploma and Ph.D. degrees online.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-section-title {
  font-size: 15px;
  font-weight: 800;
  color: #0A1B54;
  background: #F8FAFC;
  border-left: 4px solid #FFC107;
  padding: 12px 18px;
  margin: 28px 0 18px 0;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

.bu-form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 18px;
}
.bu-form-group {
  margin-bottom: 14px;
}
.bu-form-group label {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: #061D7C;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-control {
  width: 100%;
  padding: 11px 14px;
  border: 1px solid #D1D5DB;
  border-radius: 6px;
  font-size: 13.5px;
  color: #1F2937;
  background: #F9FAFB;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-form-control:focus {
  outline: none;
  border-color: #0A1B54;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(10,27,84,0.1);
}

.bu-btn-submit {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 800;
  font-size: 14px;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 16px 40px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.25s ease;
  box-shadow: 0 4px 16px rgba(10,27,84,0.2);
}
.bu-btn-submit:hover {
  background: #061D7C;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(10,27,84,0.3);
}
</style>
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
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Online Registration <em>Form</em>';
  $page_subtitle = 'Complete your official admission registration for Bhabha University programs online.';
  $page_icon     = 'fa-wpforms';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Admissions', 'url' => '#'],
    ['label' => 'Online Registration', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card" id="validation">
        <span class="bu-content-label">Official Application</span>
        <h2 class="bu-content-h2">Student Admission <em>Form</em></h2>
        <div class="bu-content-divider"></div>

        <?php echo msg($stat);?>

        <form action="" method="post" enctype="multipart/form-data">

          <!-- 1. Personal Information -->
          <div class="bu-section-title">1. Personal Information</div>
          <div class="bu-form-grid">
            <div class="bu-form-group">
              <label>Applicant Name *</label>
              <input type="text" name="name" class="bu-form-control" required placeholder="Full Name">
            </div>
            <div class="bu-form-group">
              <label>Father's Name *</label>
              <input type="text" name="fname" class="bu-form-control" required placeholder="Father's Full Name">
            </div>
            <div class="bu-form-group">
              <label>Mother's Name *</label>
              <input type="text" name="mother" class="bu-form-control" required placeholder="Mother's Full Name">
            </div>
            <div class="bu-form-group">
              <label>Parent Occupation</label>
              <input type="text" name="occupation" class="bu-form-control" placeholder="Occupation">
            </div>
          </div>

          <div class="bu-form-grid">
            <div class="bu-form-group">
              <label>Gender *</label>
              <select name="gender" class="bu-form-control" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>Date of Birth *</label>
              <input type="date" name="dob" class="bu-form-control" required>
            </div>
            <div class="bu-form-group">
              <label>Mobile Number *</label>
              <input type="tel" name="mobile" pattern=".{10}" class="bu-form-control" required placeholder="10-digit phone">
            </div>
            <div class="bu-form-group">
              <label>Email Address *</label>
              <input type="email" name="email" class="bu-form-control" required placeholder="email@example.com">
            </div>
          </div>

          <div class="bu-form-grid">
            <div class="bu-form-group">
              <label>Aadhar Card Number</label>
              <input type="text" name="aadhar" class="bu-form-control" placeholder="12-digit Aadhar Number">
            </div>
            <div class="bu-form-group">
              <label>Category</label>
              <select name="category" class="bu-form-control">
                <option value="General">General</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="EWS">EWS</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>Nationality</label>
              <input type="text" name="nationality" value="Indian" class="bu-form-control">
            </div>
            <div class="bu-form-group">
              <label>Domicile State</label>
              <input type="text" name="domicile" value="Madhya Pradesh" class="bu-form-control">
            </div>
          </div>

          <!-- Addresses -->
          <div class="bu-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="bu-form-group">
              <label>Permanent Address *</label>
              <textarea name="permanent_address" rows="2" class="bu-form-control" required placeholder="Full permanent address"></textarea>
            </div>
            <div class="bu-form-group">
              <label>Present Address *</label>
              <textarea name="present_address" rows="2" class="bu-form-control" required placeholder="Full present address"></textarea>
            </div>
          </div>

          <!-- 2. Course Selection -->
          <div class="bu-section-title">2. Desired Course &amp; Branch</div>
          <div class="bu-form-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="bu-form-group">
              <label>Course Applied For *</label>
              <select name="course" id="course" class="bu-form-control" required>
                <option value="">-- Choose Desired Course --</option>
                <?php
                $courses = $db->get('course');
                if(is_array($courses) && count($courses) > 0) {
                  foreach($courses as $icourse) {
                    echo '<option value="'.$icourse['id'].'">'.$icourse['course'].'</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="bu-form-group">
              <label>Branch / Specialization</label>
              <select name="branch" id="branch" class="bu-form-control">
                <option value="">-- Choose Branch --</option>
              </select>
            </div>
          </div>

          <!-- 3. Photo Upload -->
          <div class="bu-section-title">3. Student Photograph</div>
          <div class="bu-form-group">
            <label>Upload Student Photograph (JPG/PNG)</label>
            <input type="file" name="photo" class="bu-form-control" accept="image/*">
          </div>

          <!-- Submit -->
          <div style="margin-top:32px;text-align:center;">
            <button type="submit" name="submit" class="bu-btn-submit">Submit Online Admission Registration <i class="fa fa-check-circle" style="margin-left:6px;"></i></button>
          </div>

        </form>
      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
