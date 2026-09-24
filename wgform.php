<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whatsapp group joining From  - Bhabha University Bhopal Madhya Pradesh</title>
    <!-- Bootstrap core CSS -->
    <?php include('inc.meta.php');?>
    </head>

    <body>
<!--KF KODE WRAPPER WRAP START-->
<div class="kode_wrapper"> 
      <!-- register Modal --> 
      <!--HEADER START-->
      <!--HEADER START-->
      <?php include('inc.header.php');?>
      <!--HEADER END-->
      <?php
      $page_title    = 'WhatsApp <em>Group Joining</em>';
      $page_subtitle = 'Official Faculty &amp; Student Communication Network Registration';
      $page_icon     = 'fa-whatsapp';
      $breadcrumbs   = [
        ['label' => 'Home', 'url' => URL_ROOT],
        ['label' => 'About Us', 'url' => href('about.php')],
        ['label' => 'WhatsApp Group', 'url' => '#']
      ];
      include('inc.page-banner.php');
      ?>

      <div class="bu-inner-layout">
        <?php 
        $active_page = 'wgform';
        include('inc.about-sidebar.php');
        ?>

        <main class="bu-inner-content">
          <div class="bu-content-card">
            <span class="bu-content-label">Official University Communications</span>
            <h2 class="bu-content-h2">WhatsApp Group Joining Form</h2>
            <div class="bu-content-divider"></div>
            <div class="bu-content-body" style="padding-top:15px;">
              <form action="wgsendmail.php" method="post" name="rfqfrm" id="rfqfrm" enctype="multipart/form-data">
						<!--<form action="mail_handlers.php" method="post" name="form" >
                            <div class="row">
                                <div class="col-xl-8 offset-xl-2">
                                  <div class="events-form-title text-center mb-30">
                                        
                                        
										
										<div align="center">
 
  
  
  
  
  
								        </div>
                                    </div>
                                </div>
                                -->
							
							 <div class="col-sm-4">
                      <div class="inputs_des"> <span>Full Name</span>
                        <input type="text" name="name" id="name" maxlength="50" value="" required >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Father Name</span>
                        <input type="text" name="fname" id="fname" maxlength="50" value="" required >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Designation</span>
                        <input type="text" name="desig" id="desig" maxlength="25" value="" required >
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Department</span>
                        <input type="text" name="depart" id="depart" maxlength="25" value="" required >
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Date of joining</span>
                        <input type="date" value="14-02-2003" name="tdate" required>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Mobile No.</span>
                        <input type="tel" name="phone" id="phone" maxlength="10" value="" required  >
                      </div>
                    </div>
                    
                    <!--
                    <div class="col-sm-4">
                      <div class="inputs_des"> <span>Email ID</span>
                        <input type="email" name="email" id="email" maxlength="35" value="" required >
                      </div>
                    </div> 
                    
						
					<div class="col-sm-3">
                      <div class="inputs_des"> <span>Upload Aadhar</span>
                        <input type="file" name="attachFile" required>
                      </div>
                    </div>	
					-->		
					<div class="col-sm-12" style="margin-top:16px;">		
					  <div style="background:#FFFBEB; border:1px solid #FDE68A; border-left:4px solid #F59E0B; padding:14px 18px; border-radius:6px; font-size:13.5px; color:#92400E; line-height:1.6;">
					    <strong>UNDERTAKING:</strong> I affirm that upon joining this official WhatsApp communication channel, I will only access and share university-related announcements and academic information. If I distribute inappropriate or unauthorized content, I understand that the university reserves the right to take appropriate disciplinary/administrative action.
					  </div>
					</div>
						
                    <div class="col-sm-12" style="margin-top:24px;">
                      <div class="contact_des">
                        <button name="Submit2" type="submit" class="bu-btn" style="padding:12px 30px; font-size:15px; border-radius:8px; border:none; cursor:pointer;">
                          <i class="fa fa-paper-plane" style="margin-right:6px;"></i> Submit Registration
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </main>
          </div>

      <!--FOOTER START-->
      <?php include('inc.footer.php');?>
      <!--FOOTER END--> 
    </div>
<!--KF KODE WRAPPER WRAP END--> 
<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>
</body>
</html>
