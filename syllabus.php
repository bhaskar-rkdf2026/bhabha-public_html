<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Scheme & Syllabus - Bhabha University Bhopal Madhya Pradesh</title>
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
<script type="text/javascript">
   $(document).ready(function(){
	   $("#branch").change(function(){					 
			 var branch=$("#branch").val();
			 $.ajax({
				type:"post",
				url:"<?php echo URL_ROOT;?>getYear.php",
				data:"branch="+branch,
				success:function(data){
					  $("#year").html(data);
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
              <h3>Scheme & Syllabus</h3>
            </div>
            <div class="kf_inr_breadcrumb">
              <ul>
                <li><a href="<?php echo URL_ROOT;?>">Home</a></li>
                <li><a href="#">Scheme & Syllabus</a></li>
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
                <h3>Scheme & Syllabus</h3>
              </div>
              <!-- HEADING 1 END-->
              <div class="abt_univ_des" align="center">
                <form action="" method="post">
                  <div class="row">
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
                          <option value="<?php echo $icourse['id']?>" <?php if($icourse['id']==$_POST['course']){?> selected="selected" <?php }?>> <?php echo $icourse['course']?></option>
                          <?php 
			  }
		  }?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Branch / Specialization</span>
                      <select name="branch" id="branch" required>
                          <option value=""> Select Branch</option>
                          <?php
$db->where('course',$_POST['course']);
$branch = $db->get('branch');
if(is_array($branch) && count($branch)>0)
          {
              foreach($branch as $ibranch)
              { 
?>
                          <option value="<?php echo $ibranch['id']?>" <?php if($ibranch['id']==$_POST['branch']){?> selected="selected" <?php }?>> <?php echo $ibranch['branch']?></option>
                          <?php 
			  }
		  }?>
                        </select>
                      
                        
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Sem / Year</span>
                        <select name="year" id="year" required>
                          <option value=""> Select Sem / Year</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px;">
                    <div class="col-sm-12">
                      <div class="contact_des">
                        <button type="submit" name="submit">Show Downloads</button>
                      </div>
                    </div>
                  </div>
                </form>
                <br/>
                <div class="abt_univ_des" align="center">
                <?php
				if(isset($_POST['submit']))
{?>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th><strong>Course</strong></th>
                        <th><strong>Branch - Year/SEM</strong></th>
                        <th><strong>Download</strong></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
	$db->where('course',$_POST['course']);
	$db->where('branch',$_POST['branch']);
	$syllabus = $db->get('syllabus');
if(is_array($syllabus) && count($syllabus)>0)
          {
              foreach($syllabus as $isyllabus)
              { 
                ?>
                      <tr>
                      <td><?php
						$db->where('id',$isyllabus['course']);
						$course = $db->getOne('course');
						echo $course['course'];?></td>
                        <td><?php
						$db->where('id',$isyllabus['branch']);
						$branch = $db->getOne('branch');
						
						echo $branch['branch'];?> - <?php echo $isyllabus['heading']?></td>
                        <td><a target="_blank" href="<?php echo URL_UPLOAD;?>syllabus/<?php echo $isyllabus['image']?>"><strong>Click To Download</strong></a></td>
                      </tr>
                        <?php
			  }
		  }?>
                    </tbody>
                  </table>
                  <?php } ?>
                </div>
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
