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
/* ================================================================
   ONLINE ADMISSION PAGE — Navy + Gold Premium Theme
   ================================================================ */

/* ---- Hero Banner ---- */
.bu-adm-hero {
  background: linear-gradient(135deg, #040F4A 0%, #0A1B54 55%, #061D7C 100%);
  padding: 70px 20px 60px;
  position: relative;
  overflow: hidden;
  width: 100%;
  clear: both;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-adm-hero::before {
  content: '';
  position: absolute;
  top: -80px; right: -60px;
  width: 360px; height: 360px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.09) 0%, transparent 70%);
  pointer-events: none;
}
.bu-adm-hero::after {
  content: '';
  position: absolute;
  bottom: -60px; left: 15%;
  width: 260px; height: 260px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(255,193,7,0.06) 0%, transparent 70%);
  pointer-events: none;
}
.bu-adm-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  gap: 28px;
}
.bu-adm-hero-icon {
  flex-shrink: 0;
  width: 76px; height: 76px;
  background: rgba(255,193,7,0.12);
  border: 2px solid rgba(255,193,7,0.35);
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 30px;
  color: #FFC107;
}
.bu-adm-hero-text { flex: 1; }
.bu-adm-breadcrumb {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0 0 12px 0;
  padding: 0;
  flex-wrap: wrap;
  gap: 0;
}
.bu-adm-breadcrumb li {
  font-size: 11px;
  font-weight: 600;
  color: rgba(255,255,255,0.45);
  text-transform: uppercase;
  letter-spacing: 0.8px;
}
.bu-adm-breadcrumb li a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s; }
.bu-adm-breadcrumb li a:hover { color: #FFC107; }
.bu-adm-breadcrumb li + li::before { content: '›'; margin: 0 8px; color: rgba(255,255,255,0.25); }
.bu-adm-breadcrumb li:last-child { color: rgba(255,255,255,0.75); }
.bu-adm-hero-badge {
  display: inline-block;
  background: rgba(255,193,7,0.15);
  border: 1px solid rgba(255,193,7,0.35);
  color: #FFC107;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 10px;
}
.bu-adm-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(24px, 3.5vw, 38px);
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 10px 0;
  line-height: 1.2;
}
.bu-adm-hero-sub {
  font-size: 14.5px;
  color: rgba(255,255,255,0.6);
  line-height: 1.6;
  max-width: 620px;
}

/* ---- Page Wrap ---- */
.bu-adm-page-wrap {
  background: #F8F7F4;
  width: 100%;
  clear: both;
  padding: 50px 20px 80px;
  box-sizing: border-box;
}
.bu-adm-container {
  max-width: 1100px;
  margin: 0 auto;
}

/* ---- Form Card ---- */
.bu-adm-card {
  background: #ffffff;
  border-radius: 14px;
  border: 1px solid #E5E7EB;
  padding: 44px 48px;
  box-shadow: 0 4px 28px rgba(6,29,124,0.06);
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
}
.bu-adm-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 4px; height: 100%;
  background: linear-gradient(180deg, #FFC107 0%, #D99B00 100%);
  border-radius: 14px 0 0 14px;
}
.bu-adm-card-label {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2.5px;
  color: #D99B00;
  text-transform: uppercase;
  margin-bottom: 6px;
  display: block;
}
.bu-adm-card-heading {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(20px, 2.5vw, 28px);
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 6px 0;
  line-height: 1.25;
}
.bu-adm-card-heading em { font-style: italic; color: #D99B00; }
.bu-adm-divider {
  width: 44px; height: 3px;
  background: linear-gradient(90deg, #FFC107, #D99B00);
  border-radius: 2px;
  margin: 12px 0 30px 0;
}

/* Alert / success message */
.bu-adm-alert-success {
  background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
  border: 1px solid #6EE7B7;
  border-left: 4px solid #10B981;
  padding: 18px 22px;
  border-radius: 8px;
  color: #065F46;
  font-weight: 700;
  font-size: 15px;
  margin-bottom: 28px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.bu-adm-alert-error {
  background: #FEF2F2;
  border: 1px solid #FECACA;
  border-left: 4px solid #EF4444;
  padding: 18px 22px;
  border-radius: 8px;
  color: #991B1B;
  font-weight: 700;
  font-size: 14px;
  margin-bottom: 28px;
  display: flex;
  align-items: center;
  gap: 12px;
}

/* ---- Section Heading inside form ---- */
.bu-adm-section {
  font-size: 12px;
  font-weight: 800;
  color: #0A1B54;
  background: linear-gradient(90deg, #F0F4FF 0%, #F8F7F4 100%);
  border-left: 4px solid #FFC107;
  padding: 11px 18px;
  margin: 32px 0 20px 0;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  border-radius: 0 6px 6px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-adm-section i { color: #D99B00; font-size: 13px; }
.bu-adm-section:first-of-type { margin-top: 0; }

/* ---- Form Grid ---- */
.bu-fg-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px 24px; }
.bu-fg-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px 24px; }
.bu-fg-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px 24px; }
.bu-fg-1 { display: grid; grid-template-columns: 1fr; gap: 20px 24px; }

/* ---- Form Group ---- */
.bu-fg { margin-bottom: 0; }
.bu-fg label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #374151;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.6px;
}
.bu-fg label span.req { color: #EF4444; margin-left: 2px; }

/* ---- Form Controls ---- */
.bu-fc {
  width: 100%;
  padding: 10px 13px;
  border: 1.5px solid #D1D5DB;
  border-radius: 7px;
  font-size: 13.5px;
  color: #1F2937;
  background: #F9FAFB;
  font-family: 'Plus Jakarta Sans', sans-serif;
  transition: all 0.22s ease;
  box-sizing: border-box;
  outline: none;
}
.bu-fc:focus {
  border-color: #061D7C;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(6,29,124,0.08);
}
select.bu-fc { cursor: pointer; }
textarea.bu-fc { resize: vertical; min-height: 72px; }

/* ---- Education Tables ---- */
.bu-edu-table-wrap {
  overflow-x: auto;
  border-radius: 8px;
  border: 1px solid #E5E7EB;
  margin-bottom: 4px;
  -webkit-overflow-scrolling: touch;
}
.bu-edu-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 680px;
  font-size: 13px;
}
.bu-edu-table thead th {
  background: #0A1B54;
  color: #FFC107;
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 11px 14px;
  text-align: left;
  white-space: nowrap;
}
.bu-edu-table tbody td {
  padding: 8px 8px;
  border-bottom: 1px solid #F3F4F6;
  background: #FAFBFF;
}
.bu-edu-table tbody td input {
  width: 100%;
  min-width: 90px;
  padding: 7px 10px;
  border: 1.5px solid #D1D5DB;
  border-radius: 5px;
  font-size: 12.5px;
  color: #1F2937;
  background: #fff;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
  transition: border-color 0.2s;
}
.bu-edu-table tbody td input:focus {
  border-color: #061D7C;
  outline: none;
  box-shadow: 0 0 0 2px rgba(6,29,124,0.08);
}

/* ---- Payment Table ---- */
.bu-pay-table-wrap {
  overflow-x: auto;
  border-radius: 8px;
  border: 1px solid #E5E7EB;
  -webkit-overflow-scrolling: touch;
}
.bu-pay-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 760px;
  font-size: 13px;
}
.bu-pay-table thead th {
  background: #F0F4FF;
  color: #061D7C;
  font-size: 10.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  padding: 11px 14px;
  text-align: left;
  border-bottom: 2px solid #D99B00;
  white-space: nowrap;
}
.bu-pay-table tbody td {
  padding: 8px 8px;
  background: #FAFBFF;
}
.bu-pay-table tbody td input {
  width: 100%;
  min-width: 100px;
  padding: 7px 10px;
  border: 1.5px solid #D1D5DB;
  border-radius: 5px;
  font-size: 12.5px;
  color: #1F2937;
  background: #fff;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
  transition: border-color 0.2s;
}
.bu-pay-table tbody td input:focus {
  border-color: #061D7C;
  outline: none;
  box-shadow: 0 0 0 2px rgba(6,29,124,0.08);
}

/* ---- Upload Groups ---- */
.bu-upload-group {
  background: #F8F9FF;
  border: 1.5px dashed #C7D2FE;
  border-radius: 8px;
  padding: 16px 18px;
}
.bu-upload-group label {
  font-size: 11px;
  font-weight: 700;
  color: #374151;
  text-transform: uppercase;
  letter-spacing: 0.6px;
  display: block;
  margin-bottom: 8px;
}
.bu-upload-group input[type="file"] {
  font-size: 12.5px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  color: #374151;
  width: 100%;
}

/* ---- TnC section ---- */
.bu-tnc-box {
  background: #F0F4FF;
  border: 1px solid #C7D2FE;
  border-radius: 8px;
  padding: 24px 26px;
  margin-top: 28px;
}
.bu-tnc-box p {
  font-size: 13.5px;
  color: #374151;
  line-height: 1.7;
  margin-bottom: 8px;
}
.bu-tnc-box p:last-child { margin-bottom: 0; }
.bu-tnc-check {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 16px;
}
.bu-tnc-check input[type="checkbox"] {
  margin-top: 3px;
  width: 16px;
  height: 16px;
  accent-color: #061D7C;
  flex-shrink: 0;
  cursor: pointer;
}
.bu-tnc-check label {
  font-size: 13.5px;
  color: #374151;
  line-height: 1.65;
  cursor: pointer;
  font-weight: 600;
  text-transform: none !important;
  letter-spacing: 0 !important;
}

/* ---- Submit Button ---- */
.bu-adm-submit-wrap {
  text-align: center;
  margin-top: 32px;
}
.bu-adm-submit-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #061D7C 0%, #0A1B54 100%);
  color: #FFC107;
  font-size: 14px;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 16px 48px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-family: 'Plus Jakarta Sans', sans-serif;
  transition: all 0.25s ease;
  box-shadow: 0 6px 20px rgba(6,29,124,0.25);
}
.bu-adm-submit-btn:hover {
  background: linear-gradient(135deg, #D99B00 0%, #FFC107 100%);
  color: #040F4A;
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(6,29,124,0.3);
}
.bu-adm-submit-btn i { font-size: 16px; }

/* ---- Responsive ---- */
@media (max-width: 1024px) {
  .bu-adm-card { padding: 32px 28px; }
  .bu-fg-4 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .bu-adm-hero { padding: 55px 16px 45px; }
  .bu-adm-hero-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
  .bu-adm-page-wrap { padding: 32px 16px 60px; }
  .bu-adm-card { padding: 24px 18px; }
  .bu-fg-3, .bu-fg-4 { grid-template-columns: 1fr 1fr; }
  .bu-fg-2 { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
  .bu-fg-3, .bu-fg-4, .bu-fg-2 { grid-template-columns: 1fr; }
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
  <!-- HEADER -->
  <?php include('inc.header.php');?>

  <!-- ============ HERO BANNER ============ -->
  <div class="bu-adm-hero">
    <div class="bu-adm-hero-inner">
      <div class="bu-adm-hero-icon">
        <i class="fa fa-wpforms"></i>
      </div>
      <div class="bu-adm-hero-text">
        <ul class="bu-adm-breadcrumb">
          <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
          <li><a href="#">Admissions</a></li>
          <li>Online Registration</li>
        </ul>
        <span class="bu-adm-hero-badge">Admissions Open 2025–26</span>
        <h1 class="bu-adm-hero-title">Online Registration <em style="font-style:italic;color:#FFC107;">Form</em></h1>
        <p class="bu-adm-hero-sub">Complete your official admission registration for Bhabha University programs. Fill all sections carefully before submitting.</p>
      </div>
    </div>
  </div>

  <!-- ============ MAIN CONTENT ============ -->
  <div class="bu-adm-page-wrap">
    <div class="bu-adm-container">

      <div class="bu-adm-card" id="validation">
        <span class="bu-adm-card-label">Official Application</span>
        <h2 class="bu-adm-card-heading">Student Admission <em>Form</em></h2>
        <div class="bu-adm-divider"></div>

        <!-- Success / Error Messages -->
        <?php if(!empty($stat['success'])): ?>
        <div class="bu-adm-alert-success">
          <i class="fa fa-check-circle" style="font-size:20px;color:#10B981;flex-shrink:0;"></i>
          <?php echo htmlspecialchars($stat['success']); ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($stat['error'])): ?>
        <div class="bu-adm-alert-error">
          <i class="fa fa-exclamation-circle" style="font-size:20px;flex-shrink:0;"></i>
          <?php echo htmlspecialchars($stat['error']); ?>
        </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data">

          <!-- ===== 1. PERSONAL INFORMATION ===== -->
          <div class="bu-adm-section"><i class="fa fa-user"></i> 1. Personal Information</div>
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Name <span class="req">*</span></label>
              <input type="text" name="name" class="bu-fc" required placeholder="Full Name">
            </div>
            <div class="bu-fg">
              <label>Father's Name <span class="req">*</span></label>
              <input type="text" name="fname" class="bu-fc" required placeholder="Father's Full Name">
            </div>
            <div class="bu-fg">
              <label>Father's Occupation</label>
              <input type="text" name="occupation" class="bu-fc" placeholder="Occupation">
            </div>
          </div>
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Mother Name</label>
              <input type="text" name="mother" class="bu-fc" placeholder="Mother's Full Name">
            </div>
            <div class="bu-fg">
              <label>Gender <span class="req">*</span></label>
              <select name="gender" class="bu-fc" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="bu-fg">
              <label>Mobile Number <span class="req">*</span></label>
              <input type="number" name="mobile" class="bu-fc" required
                placeholder="10-digit mobile number"
                min="6000000000" max="9999999999"
                oninput="if(this.value.length>10)this.value=this.value.slice(0,10)"
                title="Enter valid 10-digit Indian mobile number">
            </div>
          </div>
          <div class="bu-fg-2" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Permanent Address <span class="req">*</span></label>
              <textarea name="permanent_address" rows="2" class="bu-fc" required placeholder="Full permanent address"></textarea>
            </div>
            <div class="bu-fg">
              <label>Present Address <span class="req">*</span></label>
              <textarea name="present_address" rows="2" class="bu-fc" required placeholder="Full present address"></textarea>
            </div>
          </div>
          <div class="bu-fg-4" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Phone Number</label>
              <input type="number" name="phone" class="bu-fc"
                placeholder="Alternate phone number"
                min="1000000000" max="9999999999"
                oninput="if(this.value.length>10)this.value=this.value.slice(0,10)"
                title="Enter valid 10-digit phone number">
            </div>
            <div class="bu-fg">
              <label>Email Address <span class="req">*</span></label>
              <input type="email" name="email" class="bu-fc" required placeholder="email@example.com">
            </div>
            <div class="bu-fg">
              <label>Date Of Birth <span class="req">*</span></label>
              <input type="date" name="dob" class="bu-fc" id="dob" required
                max="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-100 years')); ?>">
            </div>
            <div class="bu-fg">
              <label>Nationality <span class="req">*</span></label>
              <input type="text" name="nationality" class="bu-fc" required placeholder="e.g. Indian">
            </div>
          </div>
          <div class="bu-fg-4" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Religion</label>
              <input type="text" name="religion" class="bu-fc" placeholder="Religion">
            </div>
            <div class="bu-fg">
              <label>State of Domicile <span class="req">*</span></label>
              <input type="text" name="domicile" class="bu-fc" required placeholder="State Name">
            </div>
            <div class="bu-fg">
              <label>Aadhar Card Number</label>
              <input type="number" name="aadhar" class="bu-fc"
                placeholder="12-digit Aadhar number"
                min="100000000000" max="999999999999"
                oninput="if(this.value.length>12)this.value=this.value.slice(0,12)"
                title="Enter valid 12-digit Aadhar number">
            </div>
            <div class="bu-fg">
              <label>Select Category <span class="req">*</span></label>
              <select name="category" class="bu-fc" required>
                <option value="">Select Category</option>
                <option value="GEN">GEN</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
              </select>
            </div>
          </div>
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Domicile Certificate <span class="req">*</span></label>
              <select name="domicile_c" class="bu-fc" required>
                <option value="">Select Domicile</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="bu-fg">
              <label>Income Certificate <span class="req">*</span></label>
              <select name="income_c" class="bu-fc" required>
                <option value="">Select Income</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="bu-fg">
              <label>Category Certificate <span class="req">*</span></label>
              <select name="category_c" class="bu-fc" required>
                <option value="">Select Category</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>

          <!-- ===== 2. COURSE SELECTION ===== -->
          <div class="bu-adm-section"><i class="fa fa-book"></i> 2. Desired Course &amp; Branch</div>
          <div class="bu-fg-2" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Course <span class="req">*</span></label>
              <select name="course" id="course" class="bu-fc" required>
                <option value="">Select Course</option>
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
            <div class="bu-fg">
              <label>Branch</label>
              <select name="branch" id="branch" class="bu-fc">
                <option value="">Select Branch</option>
              </select>
            </div>
          </div>

          <!-- ===== 3. EDUCATION — HIGH SCHOOL ===== -->
          <div class="bu-adm-section"><i class="fa fa-graduation-cap"></i> 3. Education – High School</div>
          <div class="bu-edu-table-wrap" style="margin-bottom:20px;">
            <table class="bu-edu-table">
              <thead>
                <tr>
                  <th>School</th>
                  <th>Board</th>
                  <th>Year of Passing</th>
                  <th>Roll Number</th>
                  <th>Total Marks</th>
                  <th>Marks Obtained</th>
                  <th>%</th>
                  <th>Division</th>
                  <th>CGPA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="high-school"></td>
                  <td><input type="text" name="high-board"></td>
                  <td><input type="text" name="high-yop"></td>
                  <td><input type="text" name="high-roll-number"></td>
                  <td><input type="text" name="high-total-marks"></td>
                  <td><input type="text" name="high-marks-obtn"></td>
                  <td><input type="text" name="high-persent"></td>
                  <td><input type="text" name="high-division"></td>
                  <td><input type="text" name="high-cgpa"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ===== 4. EDUCATION — HIGHER SCHOOL ===== -->
          <div class="bu-adm-section"><i class="fa fa-graduation-cap"></i> 4. Education – Higher School</div>
          <div class="bu-edu-table-wrap" style="margin-bottom:20px;">
            <table class="bu-edu-table">
              <thead>
                <tr>
                  <th>School</th>
                  <th>Board</th>
                  <th>Year of Passing</th>
                  <th>Roll Number</th>
                  <th>Stream (Arts/Science/Commerce/Others)</th>
                  <th>Total Marks</th>
                  <th>Marks Obtained</th>
                  <th>%</th>
                  <th>Division</th>
                  <th>CGPA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="higher_school"></td>
                  <td><input type="text" name="higher-board"></td>
                  <td><input type="text" name="higher-yop"></td>
                  <td><input type="text" name="higher-roll"></td>
                  <td><input type="text" name="higher-stream"></td>
                  <td><input type="text" name="higher-marks"></td>
                  <td><input type="text" name="higher-marks-ob"></td>
                  <td><input type="text" name="higher-persent"></td>
                  <td><input type="text" name="higher-division"></td>
                  <td><input type="text" name="higher-cgpa"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ===== 5. GRADUATION ===== -->
          <div class="bu-adm-section"><i class="fa fa-university"></i> 5. Graduation <small style="font-weight:400;text-transform:none;letter-spacing:0;">(Not for Admission in UG Course)</small></div>
          <div class="bu-edu-table-wrap" style="margin-bottom:20px;">
            <table class="bu-edu-table">
              <thead>
                <tr>
                  <th>College</th>
                  <th>University</th>
                  <th>Year of Passing</th>
                  <th>Roll No</th>
                  <th>Course</th>
                  <th>Branch</th>
                  <th>Total Marks</th>
                  <th>Marks Obtained</th>
                  <th>Percentage</th>
                  <th>Division</th>
                  <th>CGPA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="g-college"></td>
                  <td><input type="text" name="g-university"></td>
                  <td><input type="text" name="g-yop"></td>
                  <td><input type="text" name="g-roll-number"></td>
                  <td><input type="text" name="g-course"></td>
                  <td><input type="text" name="g-branch"></td>
                  <td><input type="text" name="g-marks"></td>
                  <td><input type="text" name="g-marks-ob"></td>
                  <td><input type="text" name="g-percentage"></td>
                  <td><input type="text" name="g-division"></td>
                  <td><input type="text" name="g-cgpa"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ===== 6. POST GRADUATION ===== -->
          <div class="bu-adm-section"><i class="fa fa-university"></i> 6. Post Graduation <small style="font-weight:400;text-transform:none;letter-spacing:0;">(Not for Admission in PG Course)</small></div>
          <div class="bu-edu-table-wrap" style="margin-bottom:20px;">
            <table class="bu-edu-table">
              <thead>
                <tr>
                  <th>College</th>
                  <th>University</th>
                  <th>Year of Passing</th>
                  <th>Roll No</th>
                  <th>Course</th>
                  <th>Branch</th>
                  <th>Total Marks</th>
                  <th>Marks Obtained</th>
                  <th>%</th>
                  <th>Division</th>
                  <th>CGPA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="pg-college"></td>
                  <td><input type="text" name="pg-university"></td>
                  <td><input type="text" name="pg-yop"></td>
                  <td><input type="text" name="pg-roll-number"></td>
                  <td><input type="text" name="pg-course"></td>
                  <td><input type="text" name="pg-branch"></td>
                  <td><input type="text" name="pg-total-marks"></td>
                  <td><input type="text" name="pg-marks-obtn"></td>
                  <td><input type="text" name="pg-peresent"></td>
                  <td><input type="text" name="pg-division"></td>
                  <td><input type="text" name="pg-cgpa"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ===== 7. OTHER QUALIFICATIONS ===== -->
          <div class="bu-adm-section"><i class="fa fa-star"></i> 7. Any Other Relevant Qualification</div>
          <div class="bu-fg-1" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Whether participated in National/State level sports, please give details</label>
              <input type="text" name="sports" class="bu-fc" placeholder="Sports details">
            </div>
            <div class="bu-fg">
              <label>Details of Extra/Co-curricular Activities</label>
              <input type="text" name="activities" class="bu-fc" placeholder="Co-curricular activity details">
            </div>
            <div class="bu-fg">
              <label>Do you know someone studying in this University? If yes please give details</label>
              <input type="text" name="studying" class="bu-fc" placeholder="Details if applicable">
            </div>
          </div>
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>References One</label>
              <input type="text" name="reference_one" class="bu-fc" placeholder="Reference name">
            </div>
            <div class="bu-fg">
              <label>References Two</label>
              <input type="text" name="references_two" class="bu-fc" placeholder="Reference name">
            </div>
            <div class="bu-fg">
              <label>Know About Us</label>
              <select name="know-about" class="bu-fc">
                <option value="">Select Know About Us</option>
                <option value="Advertisement">Advertisement</option>
                <option value="Newspaper">Newspaper</option>
                <option value="TV">TV</option>
                <option value="Social Media">Social Media</option>
                <option value="Publicity Boards">Publicity Boards</option>
                <option value="By Reference">By Reference</option>
              </select>
            </div>
          </div>

          <!-- ===== 8. PAYMENT DETAILS ===== -->
          <div class="bu-adm-section"><i class="fa fa-credit-card"></i> 8. Payment Details</div>
          <div class="bu-pay-table-wrap" style="margin-bottom:20px;">
            <table class="bu-pay-table">
              <thead>
                <tr>
                  <th>Mode of Payment</th>
                  <th>Amount</th>
                  <th>DD/Cheque Number</th>
                  <th>Date</th>
                  <th>Bank/Branch</th>
                  <th>IFSC Code</th>
                  <th>Internet Banking Transaction Details</th>
                  <th>PayTM Transaction Id</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="mode"></td>
                  <td><input type="text" name="amount"></td>
                  <td><input type="text" name="dd-cheque"></td>
                  <td><input type="date" name="date" max="<?php echo date('Y-m-d'); ?>"></td>
                  <td><input type="text" name="bank"></td>
                  <td><input type="text" name="ifsc"></td>
                  <td><input type="text" name="internet-banking"></td>
                  <td><input type="text" name="paytm"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ===== 9. UPLOAD DOCUMENTS ===== -->
          <div class="bu-adm-section"><i class="fa fa-cloud-upload"></i> 9. Upload Documents</div>
          
          <!-- Domicile Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Domicile Certificate Number</label>
              <input type="text" name="domicile_number" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Date of Issue</label>
              <input type="date" name="domicile_issue_date" class="bu-fc"
                max="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-30 years')); ?>">
            </div>
            <div class="bu-upload-group">
              <label>Upload Domicile Certificate</label>
              <input type="file" name="upload_domicile">
            </div>
          </div>

          <!-- Caste Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Caste Certificate Number</label>
              <input type="text" name="caste_number" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Date of Issue</label>
              <input type="date" name="caste_issue_date" class="bu-fc"
                max="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-30 years')); ?>">
            </div>
            <div class="bu-upload-group">
              <label>Upload Caste Certificate</label>
              <input type="file" name="upload_caste">
            </div>
          </div>

          <!-- Income Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Income Certificate Number</label>
              <input type="text" name="income_number" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Date of Issue</label>
              <input type="date" name="income_issue_date" class="bu-fc"
                max="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d', strtotime('-30 years')); ?>">
            </div>
            </div>
            <div class="bu-upload-group">
              <label>Upload Income Certificate</label>
              <input type="file" name="upload_income">
            </div>
          </div>

          <!-- High School Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>High School – Certificate Number</label>
              <input type="text" name="high_school_number" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>High School – Roll Number</label>
              <input type="text" name="high_school_rollnumber" class="bu-fc" placeholder="Roll number">
            </div>
            <div class="bu-upload-group">
              <label>Upload High School Certificate</label>
              <input type="file" name="upload_high_school">
            </div>
          </div>

          <!-- Higher Secondary Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Higher Secondary – Certificate Number</label>
              <input type="text" name="higher_school_number" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Higher Secondary – Roll Number</label>
              <input type="text" name="higher_school_rollnumber" class="bu-fc" placeholder="Roll number">
            </div>
            <div class="bu-upload-group">
              <label>Upload Higher Secondary Certificate</label>
              <input type="file" name="upload_higher_school">
            </div>
          </div>

          <!-- Graduation Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Graduation – Certificate Number</label>
              <input type="text" name="g_cnumber" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Graduation – Roll Number</label>
              <input type="text" name="g_rollnumber" class="bu-fc" placeholder="Roll number">
            </div>
            <div class="bu-upload-group">
              <label>Upload Graduation Certificate</label>
              <input type="file" name="uploadg">
            </div>
          </div>

          <!-- Post Graduation Certificate -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-fg">
              <label>Post Graduation – Certificate Number</label>
              <input type="text" name="pg_cnumber" class="bu-fc" placeholder="Certificate number">
            </div>
            <div class="bu-fg">
              <label>Post Graduation – Roll Number</label>
              <input type="text" name="pg_rollnumber" class="bu-fc" placeholder="Roll number">
            </div>
            <div class="bu-upload-group">
              <label>Upload Post Graduation Certificate</label>
              <input type="file" name="uploadpg">
            </div>
          </div>

          <!-- Aadhar, Photo, Other Documents -->
          <div class="bu-fg-3" style="margin-bottom:20px;">
            <div class="bu-upload-group">
              <label>Aadhar Card</label>
              <input type="file" name="aadhar_card">
            </div>
            <div class="bu-upload-group">
              <label>Passport Size Photo</label>
              <input type="file" name="photo">
            </div>
            <div class="bu-upload-group">
              <label>Other Documents (JPG, PDF &amp; DOCX)</label>
              <input type="file" name="otherdocx">
            </div>
          </div>

          <!-- ===== TERMS & CONDITIONS ===== -->
          <div class="bu-tnc-box">
            <div class="bu-tnc-check">
              <input type="checkbox" name="tnc" id="tnc" required>
              <label for="tnc">The above information given by me in the Admission Form are true to the best of my knowledge. However should it be found that any information therein are untrue/wrong I am/my ward is liable to be disqualified for Admission.</label>
            </div>
            <p>If I/my ward selected for admission, I/my promise to abide by the rules &amp; regulations of the Institute/University and maintain discipline in the Institute and the Hostel.</p>
            <p>Initially the admission is provisional and is subject to confirmation from counseling authority/University.</p>
            <p>It is compulsory for me/my ward to appear for counseling at the Bhabha University or at any place directed by the university on the specified date and time failing which I/my ward's registration will automatically be cancelled without any refund of fee.</p>
            <p>I understand that if I get my admission/registration cancelled, fees deposited by me is nonrefundable.</p>
            <p>Cancellation of registration is not possible without paying the full fees for the entire course.</p>
            <p>I agree to pay fees for the whole course if I leave the course in midstream.</p>
            <p>Any dispute is subject to Bhopal jurisdiction.</p>
            <p>Admission and seat allotment as per Bhabha University norms.</p>
          </div>

          <!-- Submit -->
          <div class="bu-adm-submit-wrap">
            <button type="submit" name="submit" class="bu-adm-submit-btn">
              <i class="fa fa-check-circle"></i>
              Submit Online Admission Registration
            </button>
          </div>

        </form>
      </div><!-- /bu-adm-card -->

    </div><!-- /bu-adm-container -->
  </div><!-- /bu-adm-page-wrap -->

  <!-- FOOTER -->
  <?php include('inc.footer.php');?>
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
