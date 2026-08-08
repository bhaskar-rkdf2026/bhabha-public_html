<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bhabha University Bhopal Madhya Pradesh</title>
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>

<!-- blink -->
<style >
.blinking{animation:blinkingText 1.2s infinite}@keyframes blinkingText{
    0%{     color: #ffc300;    }
    49%{    color: #ffc300; }
    60%{    color: #fff; }
    99%{    color: #fff;  }
    100%{   color: #ffc300;    }
}
</style>



</head>

<body>
<!--KF KODE WRAPPER WRAP START-->
<div class=""> 
  <!-- register Modal --> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->
  
  <?php include('inc.slider.php');?>
  <div class="kf_content_wrap"> 
    <!--COURSE OUTER WRAP START-->
    <?php include('inc.course.php');?>
   <section class="edu2_counter_wrap">
      <div class="container"> 
        <!--EDU2 COUNTER DES START-->
        <div class="edu2_counter_des"> <span><i class="icon-win5"></i></span>
          <h3 class="counter">17</h3>
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

<?php include('inc.welcome.php');?>

    
     <?php include('inc.recruiters.php');?>
    <!--COUNTER SECTION END-->
    
    <!--TRAINING WRAP START-->
   <section class="edu2_tarining_bg">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="kf_edu2_training_des">
          <figure> <img src="extra-images/training-thumb.png" alt=""/> </figure>
        </div>
      </div>
      <div class="col-md-8">
        <div class="edu2_training_wrap">
          <h2>Admission Open 2020-21</h2>
          <h3>                     <?php
          
$department = $db->get('department');
if(is_array($department) && count($department)>0)
          {
              foreach($department as $idepartment)
              { 
?><?php echo $idepartment['title']?> | <?php } } 
?></h3>
          <!--COUNTDOWN START-->
        
          <!--COUNTDOWN END--> 
           <a href="<?php echo href("online-admission.php")?>" class="btn-1">APPLY NOW</a> </div>
      </div>
    </div>
  </div>
</section>

    <!--TRAINING WRAP END--> 
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
  <?php include('inc.footer.php');?>
  
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
