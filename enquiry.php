<?php include_once("config.php");
define("UPLOAD",'enquiry/');
$stat=array();
if(isset($_SESSION['success']) && $_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
if(isset($_FILES['tenth']['name']) && $_FILES['tenth']['name'] != '')
{
	$filename = basename($_FILES['tenth']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG, PNG, PDF & DOCX Files are allowed.";
	}
}
if(isset($_FILES['twelfth']['name']) && $_FILES['twelfth']['name'] != '')
{
	$filename = basename($_FILES['twelfth']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG, PNG, PDF & DOCX Files are allowed.";
	}
}
if(isset($_FILES['graduation']['name']) && $_FILES['graduation']['name'] != '')
{
	$filename = basename($_FILES['graduation']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG, PNG, PDF & DOCX Files are allowed.";
	}
}
if(isset($_FILES['pgraduation']['name']) && $_FILES['pgraduation']['name'] != '')
{
	$filename = basename($_FILES['pgraduation']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG, PNG, PDF & DOCX Files are allowed.";
	}
}
if(empty($stat['error'])) {
	$data = Array(
			"name" => $_POST['name'],
			"mobile" => $_POST['mobile'],
			"email" => $_POST['email'],
			"course" => $_POST['course'],
			"branch" => isset($_POST['branch']) ? $_POST['branch'] : '',
			"place" => $_POST['place']
			 );
	if(isset($_FILES['tenth']) && !empty($_FILES['tenth']['name']))
	{
		$file_ext = strtolower(pathinfo($_FILES['tenth']['name'], PATHINFO_EXTENSION));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['tenth']['tmp_name'], UPLOAD.$newfile))
		{
			$data['tenth'] = $newfile;
		}
	}
	
	if(isset($_FILES['twelfth']) && !empty($_FILES['twelfth']['name']))
	{
		$file_ext = strtolower(pathinfo($_FILES['twelfth']['name'], PATHINFO_EXTENSION));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['twelfth']['tmp_name'], UPLOAD.$newfile))
		{
			$data['twelfth'] = $newfile;
		}
	}
	
	if(isset($_FILES['graduation']) && !empty($_FILES['graduation']['name']))
	{
		$file_ext = strtolower(pathinfo($_FILES['graduation']['name'], PATHINFO_EXTENSION));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['graduation']['tmp_name'], UPLOAD.$newfile))
		{
			$data['graduation'] = $newfile;
		}
	}
	
	if(isset($_FILES['pgraduation']) && !empty($_FILES['pgraduation']['name']))
	{
		$file_ext = strtolower(pathinfo($_FILES['pgraduation']['name'], PATHINFO_EXTENSION));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['pgraduation']['tmp_name'], UPLOAD.$newfile))
		{
			$data['pgraduation'] = $newfile;
		}
	}
	$db->where('id', $_POST['course']);
	$course = $db->getOne('course');
	
	$db->where('id', isset($_POST['branch']) ? $_POST['branch'] : 0);
	$branch = $db->getOne('branch');
	
	$id = $db->insert('enquiry', $data);
	$to = "rkindoriya@gmail.com";
	$subject = "Website : Admission Enquiry";
	$ibody = 'Name : '.$_POST['name'].'<br>';
	$ibody .= 'Email : '.$_POST['email'].'<br>';
	$ibody .= 'Mobile : '.$_POST['mobile'].'<br>';
	$ibody .= 'Course : '.(isset($course['course']) ? $course['course'] : '').'<br>';
	$ibody .= 'Branch : '.(isset($branch['branch']) ? $branch['branch'] : '').'<br>';
	$ibody .= 'Place : '.$_POST['place'].'<br>';
	
	mail_template($to,$subject,$ibody,"noreply@bhabhauniversity.edu.in","noreply7827#$");
	mail_template('admission@bhabhauniversity.edu.in',$subject,$ibody,"noreply@bhabhauniversity.edu.in","noreply7827#$");
	
	unset($_POST);
	unset($_SESSION['form']);
	$_SESSION["success"] = 'Your admission enquiry has been submitted successfully! Our counseling team will contact you.';
	redirect(href("enquiry.php").'#validation');
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admission Enquiry & Eligibility - Bhabha University Bhopal</title>
<meta name="description" content="Submit your admission enquiry online for Bhabha University Bhopal courses — Engineering, Pharmacy, Management, Dental, Science, Agriculture and Law.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  margin-bottom: 20px;
}
.bu-form-group {
  margin-bottom: 16px;
}
.bu-form-group label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: #061D7C;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-control {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #D1D5DB;
  border-radius: 6px;
  font-size: 14px;
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

/* Custom Upload Zone Styling */
.bu-upload-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 18px;
  margin-top: 10px;
}
.bu-upload-zone {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #F8FAFC;
  border: 2px dashed #CBD5E1;
  border-radius: 10px;
  padding: 22px 16px;
  text-align: center;
  cursor: pointer;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-upload-zone:hover {
  border-color: #0A1B54;
  background: #F1F5F9;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(10,27,84,0.06);
}
.bu-upload-icon {
  font-size: 26px;
  color: #0A1B54;
  margin-bottom: 8px;
  transition: transform 0.25s ease;
}
.bu-upload-zone:hover .bu-upload-icon {
  transform: translateY(-3px);
  color: #D99B00;
}
.bu-upload-title {
  font-size: 13px;
  font-weight: 700;
  color: #061D7C;
  margin-bottom: 4px;
}
.bu-upload-btn {
  font-size: 11px;
  font-weight: 800;
  background: #0A1B54;
  color: #FFC107;
  padding: 5px 14px;
  border-radius: 4px;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin: 6px 0;
  display: inline-block;
}
.bu-upload-file-name {
  font-size: 11.5px;
  color: #6B7280;
  margin-top: 4px;
  word-break: break-all;
}
.bu-custom-file-input {
  position: absolute;
  inset: 0;
  opacity: 0;
  cursor: pointer;
  width: 100%;
  height: 100%;
  z-index: 2;
}

.bu-btn-submit {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 800;
  font-size: 14px;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 14px 36px;
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

   function updateFileName(input, targetId) {
     var display = document.getElementById(targetId);
     var parentZone = input.closest('.bu-upload-zone');
     if (input.files && input.files.length > 0) {
       display.innerHTML = '<i class="fa fa-check-circle" style="color:#10B981;margin-right:4px;"></i> ' + input.files[0].name;
       display.style.color = '#061D7C';
       display.style.fontWeight = '700';
       if(parentZone) {
         parentZone.style.borderColor = '#10B981';
         parentZone.style.background = 'rgba(16,185,129,0.05)';
       }
     } else {
       display.innerHTML = 'No file selected (PDF, JPG, PNG)';
       display.style.color = '#6B7280';
       display.style.fontWeight = '400';
       if(parentZone) {
         parentZone.style.borderColor = '#CBD5E1';
         parentZone.style.background = '#F8FAFC';
       }
     }
   }
</script>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Admission <em>Enquiry</em>';
  $page_subtitle = 'Fill out the online admission enquiry form to receive personalized counseling and course details.';
  $page_icon     = 'fa-pencil-square-o';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Admissions', 'url' => '#'],
    ['label' => 'Admission Enquiry', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card" id="validation">
        <span class="bu-content-label">Online Application</span>
        <h2 class="bu-content-h2">Admission Enquiry <em>Form</em></h2>
        <div class="bu-content-divider"></div>

        <?php echo msg($stat);?>

        <form action="" method="post" enctype="multipart/form-data" style="margin-top:20px;">
          
          <!-- Personal Info -->
          <div class="bu-form-grid">
            <div class="bu-form-group">
              <label>Full Name *</label>
              <input type="text" name="name" class="bu-form-control" placeholder="Enter student's full name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';?>" required>
            </div>
            <div class="bu-form-group">
              <label>Mobile Number *</label>
              <input type="tel" name="mobile" pattern=".{10}" class="bu-form-control" placeholder="10-digit mobile number" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '';?>" required>
            </div>
            <div class="bu-form-group">
              <label>Email Address</label>
              <input type="email" name="email" class="bu-form-control" placeholder="student@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';?>">
            </div>
          </div>

          <!-- Course Selection -->
          <div class="bu-form-grid">
            <div class="bu-form-group">
              <label>Select Course *</label>
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
              <label>Select Branch / Specialization</label>
              <select name="branch" id="branch" class="bu-form-control">
                <option value="">-- Choose Branch --</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>City / Place</label>
              <input type="text" name="place" class="bu-form-control" placeholder="Current city or native place" value="<?php echo isset($_POST['place']) ? htmlspecialchars($_POST['place']) : '';?>">
            </div>
          </div>

          <!-- Document Uploads -->
          <h4 style="font-size:15px;font-weight:700;color:#061D7C;margin:28px 0 14px 0;">Upload Academic Certificates (Optional):</h4>
          <div class="bu-upload-grid">
            
            <!-- 10th Certificate -->
            <div class="bu-upload-zone">
              <i class="fa fa-cloud-upload bu-upload-icon"></i>
              <span class="bu-upload-title">Upload 10th Certificate</span>
              <span class="bu-upload-btn">Browse File</span>
              <span class="bu-upload-file-name" id="file-name-tenth">No file selected (PDF, JPG, PNG)</span>
              <input type="file" name="tenth" id="file-tenth" class="bu-custom-file-input" onchange="updateFileName(this, 'file-name-tenth')" accept=".jpeg,.jpg,.png,.pdf,.docx">
            </div>

            <!-- 12th Certificate -->
            <div class="bu-upload-zone">
              <i class="fa fa-cloud-upload bu-upload-icon"></i>
              <span class="bu-upload-title">Upload 12th Certificate</span>
              <span class="bu-upload-btn">Browse File</span>
              <span class="bu-upload-file-name" id="file-name-twelfth">No file selected (PDF, JPG, PNG)</span>
              <input type="file" name="twelfth" id="file-twelfth" class="bu-custom-file-input" onchange="updateFileName(this, 'file-name-twelfth')" accept=".jpeg,.jpg,.png,.pdf,.docx">
            </div>

            <!-- UG Certificate -->
            <div class="bu-upload-zone">
              <i class="fa fa-cloud-upload bu-upload-icon"></i>
              <span class="bu-upload-title">Upload UG Certificate</span>
              <span class="bu-upload-btn">Browse File</span>
              <span class="bu-upload-file-name" id="file-name-graduation">No file selected (PDF, JPG, PNG)</span>
              <input type="file" name="graduation" id="file-graduation" class="bu-custom-file-input" onchange="updateFileName(this, 'file-name-graduation')" accept=".jpeg,.jpg,.png,.pdf,.docx">
            </div>

            <!-- PG Certificate -->
            <div class="bu-upload-zone">
              <i class="fa fa-cloud-upload bu-upload-icon"></i>
              <span class="bu-upload-title">Upload PG Certificate</span>
              <span class="bu-upload-btn">Browse File</span>
              <span class="bu-upload-file-name" id="file-name-pgraduation">No file selected (PDF, JPG, PNG)</span>
              <input type="file" name="pgraduation" id="file-pgraduation" class="bu-custom-file-input" onchange="updateFileName(this, 'file-name-pgraduation')" accept=".jpeg,.jpg,.png,.pdf,.docx">
            </div>

          </div>

          <div style="margin-top:32px;">
            <button type="submit" name="submit" class="bu-btn-submit">Submit Admission Enquiry <i class="fa fa-arrow-right" style="margin-left:6px;"></i></button>
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
