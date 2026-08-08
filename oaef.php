<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="keywords"
        content="Online admission enquiry form bhabha university,Bhabha university Online admission enquiry form, India's Best University in Madhya Pradesh, Best University in india, Best university in Bhopal, BHABHA, BHABHA UNIVERSITY, Admissions Open 2021-22 in Various UG/PG Programmes in Engineering, bhabha bhopal, madhya pradesh,india,technical,Bhabha University is one of the best private university in Bhopal, university in mp, best university in mp, university in bhopal, MP Government, mppurc, AICTE, PCI, BCI, UGC, NCTE, PARAMEDICAL,MPNRC ,top university, Bhabha University Admission, Courses, B.Tech.,M.Tech, B.Pharm, M.Pharm, Polytechnic, Management, Agriculture, Bhabha University Bhopal Madhya Pradesh, Science, Commerce, Law, Library & Information science, Online Fee, Online Admission, MP education, various vocational certificate and diploma courses, Admission open 2021, Bhabha University Admission Test, UG/PG Admissions Open 2021-22 @ Bhabha University, Bhabha University Logo, Bhabha University Result 2021, Bhabha University Admission Open, Bhabha University ERP Login, Bhabha University Login, Bhabha University Student Login, Bhabha University online fees payment">
    
    <meta name="description"
        content="Online admission enquiry form bhabha university,Bhabha university Online admission enquiry form, BHABHA University the best university in Bhopal and Central India, Bhabha university, Best University, Best University in india, Best university in Bhopal, Bhabha, BHABHA UNIVERSITY, bhabha bhopal, madhya pradesh,india, Technical University, Non technical, university in mp, best university in mp, university in bhopal, AICTE, PCI, BCI, UGC, NCTE, PARAMEDICAL, MPNRC, MPPURC,top university, Top University in Bhopal, Bhabha University Admission, Courses, Agriculture, B.Tech.,M.Tech, B.Pharm, M.Pharm, Polytechnic, Management, Nursing, Science, Commerce, Law, Online Fee, Online Admission, MP education, Bhabha University Bhopal Madhya Pradesh, Bhabha University Logo, Bhabha University Result 2021, Bhabha University Admission Open, Bhabha University ERP Login, Bhabha University Login, Bhabha University Student Login, Bhabha University online fees payment, Bhabha university result">
    <meta name="keywords"
        content="Bhabha, Welcome to Bhabha university, Bhabha University, university in mp,Top university, bhopal university, Engineering, Pharmacy, Admissions Open, college in mp, Best Engineering college, Engineering college in bhopal, M.P., India, Engineering College , Pharmacy College, Management College , Best engineering College in Bhopal, M.P., India, machanical, civil, electrical, electronics, machanical, computers, science, IT, information, technology, pahrmacy, Nursing, management, paper presentation, BhabhaUniversity, BHABHA UNIVERSITY, top university in mp, Best university, bhopal, madhya pradesh, private technical university in bhopal, autonomous university in mp, managment university, Science & Technology, contact Bhabha university, bhopal, mp, india, MP Govt, mppurc, AICTE,PCI, UGC, Nursing, PARAMEDICAL, LAW, MPNC, Bhabha University Logo, Bhabha University Result 2021, Bhabha University Admission Open, Bhabha University ERP Login, Bhabha University Login, Bhabha University Student Login, Bhabha University online fees payment" />



<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online admission enquiry form - Bhabha University Bhopal</title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>

<!-- blink -->
<style >
.blinking{animation:blinkingText 1.2s infinite}@keyframes blinkingText{
    0%{     color: #ffc300;    } /*#ffc300;*/
    49%{    color: #72f542; }    /*#ffc300;*/
    60%{    color: #fff; }
    99%{    color: #f70707  }      /* #fff;*/
    100%{   color: #ffc300;    }
}
</style>




<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LLCX3DL60K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LLCX3DL60K');
</script>


<!--Google Search console code -->
<meta name="google-site-verification" content="QCDmWuWAGYoxiMTf-Lg564W2DoEuzUbZKVCjQuYULyY" />



</head>

<body>
<!--KF KODE WRAPPER WRAP START-->
<div class=""> 
  <!-- register Modal --> 
  <!--HEADER START-->
   <!--ABOUT UNIVERSITY START-->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="abt_univ_wrap"> 
              <!-- HEADING 1 START-->
              <div class="kf_edu2_heading1">
                <h5>BHABHA UNIVERSITY</h5>
                <h3>Online Admission Enquiry Form </h3>
              </div>
              <!-- HEADING 1 END-->
              <div class="abt_univ_des" id="validation">
                <div style="margin-left:10px; margin-right:10px;"> <?php if(!empty($stat)) echo msg($stat);?></div>
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
                      <div class="inputs_des"> <span>Upload Marksheet (any one 10th/12th/Graduation/Post Graduation –
                        Certificate)</span>
                        <input type="file" name="tenth" >
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
  <!--HEADER END-->
  
  <?php include('inc.slider.php');?>
  <div class="kf_content_wrap"> 
    <!--COURSE OUTER WRAP START-->
    <?php include('inc.course.php');?>
   <section class="edu2_counter_wrap">
      <div class="container"> 
        <!--EDU2 COUNTER DES START-->
        <div class="edu2_counter_des"> <span><i class="icon-win5"></i></span>
          <h3 class="counter">19</h3>
          <h5>YEARS OF EXPERIENCE</h5>
        </div>
        <!--EDU2 COUNTER DES END--> 
        <!--EDU2 COUNTER DES START-->
        <div class="edu2_counter_des"> <span><i class="icon-group2"></i></span>
          <h3 class="counter">37,625</h3>
          <h5>NO OF STUDENTS</h5>
        </div>
        <!--EDU2 COUNTER DES END--> 
        <!--EDU2 COUNTER DES START-->
        <div class="edu2_counter_des"> <span><i class="icon-book236"></i></span>
          <h3 class="counter">22</h3>
          <h5>NO OF INSTITUTES</h5>
        </div>
        <!--EDU2 COUNTER DES END--> 
        <!--EDU2 COUNTER DES START-->
        <div class="edu2_counter_des"> <span><i class=" icon-user255"></i></span>
          <h3 class="counter">892</h3>
          <h5>CERTIFIED TEACHERS</h5>
        </div>
        <!--EDU2 COUNTER DES END--> 
      </div>
    </section>


    <!--COURSE OUTER WRAP END--> 
    <section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="kf_edu2_heading1">
          <h3>Chancellor's Message</h3>
        </div>
      </div>
      <!-- HEADING 2 START-->
      <div class="col-md-3" align="center"> <img style=" -webkit-box-shadow: 0px 0px 8px 2px #000000;
       -moz-box-shadow: 0px 0px 8px 2px #000000;
            box-shadow: 0px 0px 8px 2px #000000;" src="https://www.bhabhauniversity.edu.in/images/vcpic.jpg"> </div><br>
      <div class="col-md-9">
        <p style="text-align: justify;"><strong>“Dr. Sadhna Kapoor is the Chancellor of BHABHA University. A visionary and a selfless leader with exceptional entrepreneurial, interpersonal, social and administrative skills; Dr. Sadhna Kapoor is passionate about technology and innovation, community development, social service, and interdisciplinary teaching and research. She has been awarded by “Honorary Professor” of the academic union oxford, UK.” </strong></p>
        <h3>Dr. Sadhna Kapoor, Chancellor </h3>
        <h4>Bhabha University,Bhopal</h4>
      </div>
      <!-- HEADING 2 END--> 
      <!-- TESTEMONIAL SLIDER WRAP START--> 
      
      <!-- TESTEMONIAL SLIDER WRAP END--> 
    </div>
  </div>
</section>


    
     <?php include('inc.recruiters.php');?>
    <!--COUNTER SECTION END-->
    
   
 <?php include('inc.gallery.php');?>

    <!--OUR TESTEMONIAL WRAP START-->
   
<?php include('inc.testemonial.php');?>

    <!--OUR TESTEMONIAL WRAP END--> 
  </div>
  
  <!--EDU2 FOOTER WRAP START--> 
  <!--ACHIEVEMENTS TICKER START-->
  <?php include('inc.achievements_ticker.php');?>
  <!--ACHIEVEMENTS TICKER END--> 
  <!--FOOTER START-->
  <p>Affilation/Approvals</p>
 <?php include('inc.affiliate.php');?>
  
  <!--FOOTER END--> 
  <!--COPYRIGHTS START--> 
  
  <!--COPYRIGHTS START--> 
</div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript--> 
<?php include('inc.footer.js.php');?>





<!-- massanger  -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/602cb0fd9c4f165d47c40ae4/1eun97p1p';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->




</body>
</html>
