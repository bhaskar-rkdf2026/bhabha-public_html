<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam Papers - Bhabha University Bhopal Madhya Pradesh</title>
    <!-- Bootstrap core CSS -->
    <?php include('inc.meta.php');?>
	
	<!-- drop down menu style start -->
	
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
    </head>

<body>
<div class="kode_wrapper"> 
      <!-- register Modal --> 
<!--HEADER START-->
<?php include('inc.header.php');?>
<!--HEADER END-->

<?php
$page_title    = 'Engineering <em>Branches Papers</em>';
$page_subtitle = 'Course Directory &amp; Exam Papers for Engineering Departments';
$page_icon     = 'fa-cogs';
$breadcrumbs   = [
  ['label' => 'Home', 'url' => URL_ROOT],
  ['label' => 'Question Papers', 'url' => href('BUQuestionPapers_demo.php')],
  ['label' => 'Engineering Branches', 'url' => '#']
];
include('inc.page-banner.php');
?>

<div class="container" style="padding:40px 15px 60px 15px;">
  <div class="bu-content-card" style="background:#fff; border-radius:12px; border:1px solid #E2E8F0; padding:35px 30px; box-shadow:0 4px 20px rgba(0,0,0,0.06);">
    <a href="<?php echo href('BUQuestionPapers_demo.php');?>" class="bu-btn" style="margin-bottom:24px;">
      <i class="fa fa-arrow-left"></i> Back to All Question Papers
    </a>
    
    <span class="bu-content-label" style="display:block; font-size:11px; font-weight:800; color:#FFC107; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:6px;">Faculty of Engineering &amp; Technology</span>
    <h2 class="bu-content-h2" style="font-size:24px; font-weight:800; color:#0A1B54; margin:0 0 16px 0;">Engineering Branches Structure</h2>
    <div style="height:3px; width:45px; background:#FFC107; border-radius:2px; margin-bottom:20px;"></div>
    <p style="color:#64748B; font-size:14px; margin-bottom:20px;">Click on the arrow(s) to expand or collapse course and branch papers.</p>

                               <ul id="myUL">
                                        <li><span class="caret">BTech</span>
                              <ul class="nested">
                               <!--<li>Water</li>
                               <li>Coffee</li>-->
                               <li><span class="caret">CSE</span>
      
                             <ul class="nested">
          <li>Black Tea</li>
          <li>White Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha</li>
              <li>Gyokuro</li>
              <li>Matcha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>  
    </ul>
  </li>
  
  
  <li><span class="caret">MTech</span>
    <ul class="nested">
      <li>Water</li>
      <li>Coffee</li>
      <li><span class="caret">Tea</span>
        <ul class="nested">
          <li>Black Tea</li>
          <li>White Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha</li>
              <li>Gyokuro</li>
              <li>Matcha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>  
    </ul>
  </li>
  
  
  <li><span class="caret">Diploma</span>
    <ul class="nested">
      <li>Water</li>
      <li>Coffee</li>
      <li><span class="caret">Tea</span>
        <ul class="nested">
          <li>Black Tea</li>
          <li>White Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha</li>
              <li>Gyokuro</li>
              <li>Matcha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>  
    </ul>
  </li>
  
</ul>

  </div>
</div>

<!--FOOTER START-->
<?php include('inc.footer.php');?>
<!--FOOTER END--> 
</div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>

<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>
</body>
</html>

