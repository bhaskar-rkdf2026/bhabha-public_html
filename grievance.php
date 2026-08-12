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
      <?php
      $page_title    = 'Grievance <em>Redressal</em>';
      $page_subtitle = 'We are committed to providing a safe, transparent, and fair environment for our students and staff.';
      $page_icon     = 'fa-balance-scale';
      $breadcrumbs   = [
        ['label' => 'Home',     'url' => URL_ROOT],
        ['label' => 'Grievance','url' => '#'],
      ];
      include('inc.page-banner.php');
      ?>
<style>
.bu-full-width-container { max-width: 1000px; margin: 0 auto; padding: 50px 20px 80px; font-family: 'Plus Jakarta Sans', sans-serif; }
.bu-form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; }
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
    <h2 style="font-size:26px; font-weight:800; color:#061D7C; margin-bottom:30px; font-family:'Playfair Display', serif;">Submit your Grievance</h2>
    <form action="" method="post">
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Full Name</label>
          <input type="text" name="name" class="bu-form-control" value="<?php echo $_POST['name'];?>" required>
        </div>
        <div class="bu-form-group">
          <label>Course</label>
          <select name="course" id="course" class="bu-form-control no-selectric" required>
            <option value=""> Select Course</option>
            <?php
            $course = $db->get('course');
            if(is_array($course) && count($course)>0) {
              foreach($course as $icourse) { 
            ?>
            <option value="<?php echo $icourse['id']?>"> <?php echo $icourse['course']?></option>
            <?php 
              }
            }
            ?>
          </select>
        </div>
        <div class="bu-form-group">
          <label>Year</label>
          <input type="number" name="year" class="bu-form-control" value="<?php echo $_POST['year'];?>" required>
        </div>
      </div>
      
      <div class="bu-form-grid">
        <div class="bu-form-group">
          <label>Enrollment Number</label>
          <input type="text" name="enrollment" class="bu-form-control" value="<?php echo $_POST['enrollment'];?>" required>
        </div>
        <div class="bu-form-group">
          <label>Mobile No.</label>
          <input type="tel" name="mobile" class="bu-form-control" value="<?php echo $_POST['mobile'];?>" required>
        </div>
        <div class="bu-form-group">
          <label>Email ID</label>
          <input type="email" name="email" class="bu-form-control" value="<?php echo $_POST['email'];?>" required>
        </div>
      </div>
      
      <div class="bu-form-group" style="margin-bottom:30px;">
        <label>Grievance Details</label>
        <textarea name="grievance" class="bu-form-control" rows="5" required><?php echo $_POST['grievance'];?></textarea>
      </div>
      
      <button type="submit" name="submit" class="bu-btn-submit">Submit Grievance <i class="fa fa-paper-plane" style="margin-left:6px;"></i></button>
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
