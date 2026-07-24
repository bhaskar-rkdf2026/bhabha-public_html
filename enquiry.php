<?php include_once("config.php");
define("UPLOAD",'enquiry/');
$stat=array();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
if($_FILES['tenth']['name'] != '')
{
	$filename = basename($_FILES['tenth']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
	}
}
if($_FILES['twelfth']['name'] != '')
{
	$filename = basename($_FILES['twelfth']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
	}
}
if($_FILES['graduation']['name'] != '')
{
	$filename = basename($_FILES['graduation']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
	}
}
if($_FILES['pgraduation']['name'] != '')
{
	$filename = basename($_FILES['pgraduation']['name']);
	$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
	{
	$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
	}
}
	$data = Array(
			"name" => $_POST['name'],
			"mobile" => $_POST['mobile'],
			"email" => $_POST['email'],
			"course" => $_POST['course'],
			"branch" => $_POST['branch'],
			"place" => $_POST['place']
			 );
if(isset($_FILES['tenth']) && count($_FILES['tenth']['name']) > 0 && $_FILES['tenth']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['tenth']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['tenth']['tmp_name'],UPLOAD.$newfile));
		{
			$data['tenth'] = $newfile;
		}
	}
	
	if(isset($_FILES['twelfth']) && count($_FILES['twelfth']['name']) > 0 && $_FILES['twelfth']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['twelfth']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['twelfth']['tmp_name'],UPLOAD.$newfile));
		{
			$data['twelfth'] = $newfile;
		}
	}
	
	if(isset($_FILES['graduation']) && count($_FILES['graduation']['name']) > 0 && $_FILES['graduation']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['graduation']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['graduation']['tmp_name'],UPLOAD.$newfile));
		{
			$data['graduation'] = $newfile;
		}
	}
	
	if(isset($_FILES['pgraduation']) && count($_FILES['pgraduation']['name']) > 0 && $_FILES['pgraduation']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['pgraduation']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['pgraduation']['tmp_name'],UPLOAD.$newfile));
		{
			$data['pgraduation'] = $newfile;
		}
	}
	$db->where('id',$_POST['course']);
	$course = $db->getOne('course');
	
	$db->where('id',$aryData['branch']);
	$branch = $db->getOne('branch');
	
	
	
		$id = $db->insert('enquiry',$data);
		$to = "rkindoriya@gmail.com"; //testing//
		$subject = "Website : Admission Enquiry";
		$ibody = 'Name : '.$_POST['name'].'<br>';
		$ibody .= 'Email : '.$_POST['email'].'<br>';
		$ibody .= 'Mobile : '.$_POST['mobile'].'<br>';
		$ibody .= 'Course : '.$course['course'].'<br>';
		$ibody .= 'Branch : '.$branch['branch'].'<br>';
		$ibody .= 'Place : '.$_POST['place'].'<br>';
		
		mail_template($to,$subject,$ibody,"noreply@bhabhauniversity.edu.in","noreply7827#$");
		mail_template('admission@bhabhauniversity.edu.in',$subject,$ibody,"noreply@bhabhauniversity.edu.in","noreply7827#$");
		
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'Send Successfully';
		redirect(href("enquiry.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admission Enquiry - Bhabha University Bhopal Madhya Pradesh</title>
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
              <h3>Admission Enquiry</h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Admission Enquiry</a></li>
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
                <h3>Admission Enquiry Form </h3>
              </div>
              <!-- HEADING 1 END-->
              <div class="abt_univ_des" id="validation">
                <div style="margin-left:10px; margin-right:10px;"> <?php echo msg($stat);?></div>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Full Name</span>
                        <input type="text" required name="name" value="<?php echo $_POST['name'];?>" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Mobile No.</span>
                        <input type="tel" pattern=".{10}" required name="mobile" value="<?php echo $_POST['mobile'];?>" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Email ID</span>
                        <input type="email" name="email" value="<?php echo $_POST['email'];?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Course</span>
                        <select name="course" required id="course" required>
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
                      <div class="inputs_des"> <span>Branch</span>
                        <select name="branch" id="branch">
                          <option value=""> Select Branch</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Place</span>
                        <input type="text" name="place" value="<?php echo $_POST['place'];?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Upload 10Th –
                        Certificate</span>
                        <input type="file" name="tenth" >
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Upload 12th –
                        Certificate</span>
                        <input type="file" name="twelfth" >
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Upload UG –
                        Certificate</span>
                        <input type="file" name="graduation" >
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="inputs_des"> <span>Upload PG –
                        Certificate</span>
                        <input type="file" name="pgraduation" >
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
