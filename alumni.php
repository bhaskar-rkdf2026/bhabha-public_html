<?php 
include_once("config.php");
$stat=array();
if(!empty($_SESSION['success']))
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	// Anti-bot honeypot check
	if(!empty($_POST['bu_website_hp']))
	{
		// Silently ignore bot submission
		redirect(href("alumni.php").'#validation');
		exit;
	}

	$name           = trim($_POST['name'] ?? '');
	$enrollment_no  = trim($_POST['enrollment_no'] ?? '');
	$course         = trim($_POST['course'] ?? '');
	$passing_year   = trim($_POST['passing_year'] ?? '');
	$mobile         = trim($_POST['mobile'] ?? '');
	$email          = trim($_POST['email'] ?? '');

	if(empty($name) || empty($enrollment_no) || empty($course) || empty($passing_year) || empty($mobile) || empty($email))
	{
		$stat['error'] = 'Please fill in all mandatory fields marked with an asterisk (*).';
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$stat['error'] = 'Please enter a valid email address.';
	}
	else
	{
		$data = Array(
			"name"           => $name,
			"enrollment_no"  => $enrollment_no,
			"fname"          => trim($_POST['fname'] ?? ''),
			"mname"          => trim($_POST['mname'] ?? ''),
			"nick_name"      => trim($_POST['nick_name'] ?? ''),
			"gender"         => trim($_POST['gender'] ?? ''),
			"college"        => trim($_POST['college'] ?? ''),
			"course"         => $course,
			"branch"         => trim($_POST['branch'] ?? ''),
			"admission_year" => trim($_POST['admission_year'] ?? ''),
			"passing_year"   => $passing_year,
			"further_study"  => trim($_POST['further_study'] ?? ''),
			"dob"            => trim($_POST['dob'] ?? ''),
			"mobile"         => $mobile,
			"whatsapp"       => trim($_POST['whatsapp'] ?? ''),
			"email"          => $email,
			"address"        => trim($_POST['address'] ?? ''),
			"perm_address"   => trim($_POST['perm_address'] ?? ''),
			"occupation"     => trim($_POST['occupation'] ?? ''),
			"company"        => trim($_POST['company'] ?? ''),
			"job_title"      => trim($_POST['job_title'] ?? ''),
			"city"           => trim($_POST['city'] ?? ''),
			"marital"        => trim($_POST['marital'] ?? ''),
			"dom"            => trim($_POST['dom'] ?? ''),
			"linkedin"       => trim($_POST['linkedin'] ?? ''),
			"facebook"       => trim($_POST['facebook'] ?? ''),
			"twitter"        => trim($_POST['twitter'] ?? '')
		);
		$id = $db->insert('alumni',$data);
		if($id)
		{
			unset($_POST);
			unset($_SESSION['form']);
			$_SESSION["success"] = 'Thank you! Your Alumni Registration has been submitted successfully.';
			redirect(href("alumni.php").'#validation');
		}
		else
		{
			$stat['error'] = 'Failed to submit registration: ' . ($db->getLastError() ?: 'Please try again.');
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alumni Portal &amp; Registration - Bhabha University</title>
<meta name="description" content="Official Bhabha University Alumni Association portal and membership application form. Reconnect, share career achievements, and join our global network.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   BUAA ALUMNI PORTAL & FORM STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-gray-bg: #F8FAFC;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-alumni-wrap {
  background: #FAF9F6;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 45px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
.bu-alumni-container {
  max-width: 1100px;
  margin: 0 auto;
}

/* Association Intro Card - Crisp White & Gold Theme */
.bu-buaa-card {
  background: #ffffff !important;
  border: 1px solid var(--bu-border) !important;
  border-top: 4px solid var(--bu-gold) !important;
  border-radius: 14px !important;
  padding: 28px 32px !important;
  color: var(--bu-text-dark) !important;
  margin-bottom: 30px !important;
  display: flex !important;
  align-items: center !important;
  gap: 24px !important;
  box-shadow: 0 8px 24px rgba(10,27,84,0.06) !important;
  position: relative !important;
  overflow: hidden !important;
}
.bu-buaa-emblem {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: #F8FAFC;
  border: 2px solid #E2E8F0;
  padding: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(10,27,84,0.08);
}
.bu-buaa-emblem img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
.bu-buaa-info h2 {
  font-size: 22px;
  font-weight: 800;
  margin: 0 0 6px;
  color: var(--bu-navy);
  font-family: 'Playfair Display', serif;
}
.bu-buaa-info p {
  margin: 0;
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
}

/* Form Container */
.bu-alumni-form-box {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.bu-form-sec-heading {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 16px;
  font-weight: 800;
  color: var(--bu-navy);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding-bottom: 12px;
  border-bottom: 2px solid #F1F5F9;
  margin: 32px 0 20px;
}
.bu-form-sec-heading:first-of-type {
  margin-top: 0;
}
.bu-form-sec-heading i {
  color: var(--bu-gold-dark);
  font-size: 18px;
}

.bu-grid-2col {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}
.bu-grid-3col {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
@media (max-width: 768px) {
  .bu-grid-2col, .bu-grid-3col { grid-template-columns: 1fr; }
  .bu-buaa-card { flex-direction: column; text-align: center; }
  .bu-alumni-form-box { padding: 25px 20px; }
}

.bu-form-group {
  margin-bottom: 18px;
}
.bu-form-group label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-group label span.req {
  color: #DC2626;
  margin-left: 2px;
}
/* UNIFIED VISIBLE BORDERS ACROSS ALL FORM CONTROLS */
.bu-alumni-wrap input.bu-input,
.bu-alumni-wrap select.bu-input,
.bu-alumni-wrap textarea.bu-input,
input[type="text"].bu-input,
input[type="email"].bu-input,
input[type="tel"].bu-input,
input[type="date"].bu-input,
select.bu-input,
textarea.bu-input,
.bu-input {
  width: 100% !important;
  height: 48px !important;
  padding: 10px 14px !important;
  border: 1.5px solid #94A3B8 !important; /* Crisp, uniform, visible slate border */
  border-radius: 6px !important;
  font-size: 14px !important;
  color: #1E293B !important;
  background-color: #FFFFFF !important;
  transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
  box-sizing: border-box !important;
  float: none !important;
  outline: none !important;
  display: block !important;
}

.bu-alumni-wrap textarea.bu-input,
textarea.bu-input {
  height: 100px !important;
  resize: vertical !important;
}

.bu-alumni-wrap select.bu-input,
select.bu-input {
  cursor: pointer !important;
  background-color: #FFFFFF !important;
}

.bu-alumni-wrap input.bu-input:hover,
.bu-alumni-wrap select.bu-input:hover,
.bu-alumni-wrap textarea.bu-input:hover {
  border-color: #475569 !important;
}

.bu-alumni-wrap input.bu-input:focus,
.bu-alumni-wrap select.bu-input:focus,
.bu-alumni-wrap textarea.bu-input:focus {
  border-color: #0A1B54 !important;
  box-shadow: 0 0 0 3px rgba(10, 27, 84, 0.12) !important;
}

.bu-input::placeholder {
  color: #94A3B8 !important;
  font-size: 13.5px !important;
}

.bu-btn-submit {
  background: var(--bu-navy);
  color: var(--bu-gold);
  font-weight: 800;
  font-size: 15px;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 15px 42px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.25s ease;
  box-shadow: 0 4px 18px rgba(10,27,84,0.25);
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.bu-btn-submit:hover {
  background: var(--bu-navy-light);
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(10,27,84,0.35);
}

.bu-alert-success {
  background: #ECFDF5;
  border: 1px solid #6EE7B7;
  color: #065F46;
  padding: 16px 20px;
  border-radius: 8px;
  font-size: 14.5px;
  font-weight: 600;
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  gap: 10px;
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = 'Alumni <em>Portal &amp; Association</em>';
  $page_subtitle = 'Bhabha University Alumni Association — Connect with fellow graduates, mentor current students, and expand your professional horizons.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Alumni Portal', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-alumni-wrap" id="validation">
    <div class="bu-alumni-container">

      <!-- Status Message -->
      <?php if(!empty($stat['success'])): ?>
        <div class="bu-alert-success">
          <i class="fa fa-check-circle" style="font-size:20px;color:#10B981;"></i>
          <span><?php echo $stat['success']; ?></span>
        </div>
      <?php endif; ?>
      <?php if(!empty($stat['error'])): ?>
        <div class="bu-alert-error" style="background:#FEF2F2;border:1px solid #FCA5A5;color:#991B1B;padding:16px 20px;border-radius:8px;font-size:14.5px;font-weight:600;margin-bottom:25px;display:flex;align-items:center;gap:10px;">
          <i class="fa fa-exclamation-triangle" style="font-size:20px;color:#EF4444;"></i>
          <span><?php echo $stat['error']; ?></span>
        </div>
      <?php endif; ?>

      <!-- Alumni Association Info Header -->
      <div class="bu-buaa-card">
        <div class="bu-buaa-emblem">
          <img src="<?php echo URL_IMG;?>Bhabha university logo.png" alt="Alumni Emblem" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
        </div>
        <div class="bu-buaa-info">
          <h2>BHABHA UNIVERSITY ALUMNI ASSOCIATION</h2>
          <p>
            Welcome to the official Bhabha University Alumni Network. Every student who graduates from Bhabha University becomes a lifelong member of our global alumni family. Please submit your application below to stay connected with campus reunions, mentorship opportunities, and international chapters.
          </p>
        </div>
      </div>

      <!-- Membership Application Form (Based on Official Physical Form) -->
      <div class="bu-alumni-form-box">
        <div style="text-align:center;margin-bottom:25px;">
          <h3 style="font-size:22px;font-weight:800;color:var(--bu-navy);margin:0 0 6px;font-family:'Playfair Display',serif;">
            ALUMNI MEMBERSHIP APPLICATION FORM
          </h3>
          <p style="font-size:13.5px;color:var(--bu-text-muted);margin:0;">
            Please complete the details below to update your university alumni directory records.
          </p>
        </div>

        <form action="" method="post">
          <div style="display:none !important; visibility:hidden; opacity:0; position:absolute; left:-9999px;">
            <input type="text" name="bu_website_hp" tabindex="-1" autocomplete="off">
          </div>

          <!-- 1. PERSONAL INFORMATION -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-user"></i> Personal Information
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Full Name <span class="req">*</span></label>
              <input type="text" name="name" class="bu-input" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Enrollment No. <span class="req">*</span></label>
              <input type="text" name="enrollment_no" class="bu-input" placeholder="e.g. BU2020CS101" required value="<?php echo htmlspecialchars($_POST['enrollment_no'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Nick Name (During College)</label>
              <input type="text" name="nick_name" class="bu-input" value="<?php echo htmlspecialchars($_POST['nick_name'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Father's Name</label>
              <input type="text" name="fname" class="bu-input" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Mother's Name</label>
              <input type="text" name="mname" class="bu-input" value="<?php echo htmlspecialchars($_POST['mname'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Gender <span class="req">*</span></label>
              <select name="gender" class="bu-input no-selectric" required>
                <option value="">Select Gender</option>
                <option value="Male" <?php echo (($_POST['gender'] ?? '')=='Male')?'selected':''; ?>>Male</option>
                <option value="Female" <?php echo (($_POST['gender'] ?? '')=='Female')?'selected':''; ?>>Female</option>
                <option value="Other" <?php echo (($_POST['gender'] ?? '')=='Other')?'selected':''; ?>>Other</option>
              </select>
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Date of Birth</label>
              <input type="date" name="dob" class="bu-input" value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Marital Status</label>
              <select name="marital" class="bu-input no-selectric">
                <option value="">Select Status</option>
                <option value="Unmarried" <?php echo (($_POST['marital'] ?? '')=='Unmarried')?'selected':''; ?>>Unmarried</option>
                <option value="Married" <?php echo (($_POST['marital'] ?? '')=='Married')?'selected':''; ?>>Married</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>If Married, Date of Marriage</label>
              <input type="date" name="dom" class="bu-input" value="<?php echo htmlspecialchars($_POST['dom'] ?? ''); ?>">
            </div>
          </div>

          <!-- 2. ACADEMIC DETAILS -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-graduation-cap"></i> Academic Records at Bhabha University
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>College / Institute</label>
              <input type="text" name="college" class="bu-input" placeholder="e.g. Faculty of Pharmacy" value="<?php echo htmlspecialchars($_POST['college'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Course <span class="req">*</span></label>
              <input type="text" name="course" class="bu-input" placeholder="e.g. B.Tech / B.Pharm / MBA" required value="<?php echo htmlspecialchars($_POST['course'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Branch / Specialization</label>
              <input type="text" name="branch" class="bu-input" placeholder="e.g. Computer Science / Pharmaceutics" value="<?php echo htmlspecialchars($_POST['branch'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Admission Year</label>
              <input type="text" name="admission_year" class="bu-input" placeholder="e.g. 2019" value="<?php echo htmlspecialchars($_POST['admission_year'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Year of Graduation / Passing <span class="req">*</span></label>
              <input type="text" name="passing_year" class="bu-input" placeholder="e.g. 2023" required value="<?php echo htmlspecialchars($_POST['passing_year'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Further Studies (If any)</label>
              <input type="text" name="further_study" class="bu-input" placeholder="e.g. M.Tech / PhD / MS Abroad" value="<?php echo htmlspecialchars($_POST['further_study'] ?? ''); ?>">
            </div>
          </div>

          <!-- 3. CONTACT & CONNECTIVITY -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-phone"></i> Contact &amp; Communication Details
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Mobile Number <span class="req">*</span></label>
              <input type="tel" name="mobile" class="bu-input" required value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>WhatsApp Number <span class="req">*</span></label>
              <input type="tel" name="whatsapp" class="bu-input" required value="<?php echo htmlspecialchars($_POST['whatsapp'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Email Address <span class="req">*</span></label>
              <input type="email" name="email" class="bu-input" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-2col">
            <div class="bu-form-group">
              <label>Present / Contact Address</label>
              <input type="text" name="address" class="bu-input" placeholder="House/Flat, Street, Area" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Permanent Address</label>
              <input type="text" name="perm_address" class="bu-input" placeholder="Permanent Residence Address" value="<?php echo htmlspecialchars($_POST['perm_address'] ?? ''); ?>">
            </div>
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Current City / Location</label>
              <input type="text" name="city" class="bu-input" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>LinkedIn Profile URL</label>
              <input type="url" name="linkedin" class="bu-input" placeholder="https://linkedin.com/in/username" value="<?php echo htmlspecialchars($_POST['linkedin'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Twitter / X Profile Link</label>
              <input type="text" name="twitter" class="bu-input" placeholder="@handle or profile link" value="<?php echo htmlspecialchars($_POST['twitter'] ?? ''); ?>">
            </div>
          </div>

          <!-- 4. CAREER & PROFESSIONAL PROFILE -->
          <div class="bu-form-sec-heading">
            <i class="fa fa-briefcase"></i> Current Career &amp; Professional Details
          </div>

          <div class="bu-grid-3col">
            <div class="bu-form-group">
              <label>Current Occupation</label>
              <select name="occupation" class="bu-input no-selectric">
                <option value="">Select Occupation</option>
                <option value="Private Sector" <?php echo (($_POST['occupation'] ?? '')=='Private Sector')?'selected':''; ?>>Private Sector / Corporate</option>
                <option value="Government / PSU" <?php echo (($_POST['occupation'] ?? '')=='Government / PSU')?'selected':''; ?>>Government / PSU</option>
                <option value="Self Employed / Freelancer" <?php echo (($_POST['occupation'] ?? '')=='Self Employed / Freelancer')?'selected':''; ?>>Self Employed / Freelancer</option>
                <option value="Entrepreneur / Business" <?php echo (($_POST['occupation'] ?? '')=='Entrepreneur / Business')?'selected':''; ?>>Entrepreneur / Business Owner</option>
                <option value="Higher Studies / Research" <?php echo (($_POST['occupation'] ?? '')=='Higher Studies / Research')?'selected':''; ?>>Higher Studies / Research</option>
              </select>
            </div>
            <div class="bu-form-group">
              <label>Name of Organization &amp; Address</label>
              <input type="text" name="company" class="bu-input" placeholder="e.g. Infosys, TCS, Sun Pharma" value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>">
            </div>
            <div class="bu-form-group">
              <label>Job Title / Designation</label>
              <input type="text" name="job_title" class="bu-input" placeholder="e.g. Senior Software Engineer" value="<?php echo htmlspecialchars($_POST['job_title'] ?? ''); ?>">
            </div>
          </div>

          <!-- SUBMIT BUTTON -->
          <div style="margin-top:35px;text-align:center;">
            <button type="submit" name="submit" class="bu-btn-submit">
              Submit Alumni Membership Application <i class="fa fa-paper-plane"></i>
            </button>
          </div>

        </form>
      </div>

    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
</body>
</html>
