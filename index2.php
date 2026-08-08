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
<!-- Social links  -->
 
<style>
.sticky-container{
    padding:0px;
    margin:0px;
    position:fixed;
    right:-130px;
    top:230px;
    width:160px;
    z-index: 1100;
}
.sticky li{
    list-style-type:none;
    background-color:#fff;
    color:#efefef;
    height:43px;
    padding:0px;
    margin:0px 0px 1px 0px;
    -webkit-transition:all 0.25s ease-in-out;
    -moz-transition:all 0.25s ease-in-out;
    -o-transition:all 0.25s ease-in-out;
    transition:all 0.25s ease-in-out;
    cursor:pointer;
}
.sticky li:hover{
    margin-left:-115px;
}
.sticky li img{
    float:left;
    margin:5px 4px;
    margin-right:5px;
}
.sticky li p{
    padding-top:5px;
    margin:0px;
    line-height:16px;
    font-size:11px;
}
.sticky li p a{
    text-decoration:none;
    color:#2C3539;
}
.sticky li p a:hover{
    text-decoration:underline;
}
</style>

<!-- Social links  -->
</head>

<body>


<div class="sticky-container">
    <ul class="sticky">
        <li>
            <img src="socialimg/facebook-circle.png" width="32" height="32">
            <p><a href="https://www.facebook.com/" target="_blank"> </a></p>
        </li>
        <li>
            <img src="socialimg/twitter-circle.png" width="32" height="32">
            <p><a href="https://twitter.com/" target="_blank"> </a></p>
        </li>
        <li>
            <img src="socialimg/gplus-circle.png" width="32" height="32">
            <p><a href="https://plus.google.com/" target="_blank"> </a></p>
        </li>
        <li>
            <img src="socialimg/linkedin-circle.png" width="32" height="32">
            <p><a href="https://www.linkedin.com/" target="_blank"> </a></p>
        </li>
        <li>
            <img src="socialimg/youtube-circle.png" width="32" height="32">
            <p><a href="http://www.youtube.com/" target="_blank"> </a></p>
        </li>
        <li>
            <img src="socialimg/pin-circle.png" width="32" height="32">
            <p><a href="https://www.pinterest.com/" target="_blank"> </a></p>
        </li>
    </ul>
</div>


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
</body>
</html>
