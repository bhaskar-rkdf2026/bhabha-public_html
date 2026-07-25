<?php include_once("config.php");
$stat=array();
if(isset($_SESSION['success']) && $_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	$data = Array(
			"name" => $_POST['name'],
			"email" => $_POST['email'],
			"mobile" => $_POST['mobile'],
			"subject" => $_POST['subject'],
			"message" => $_POST['message']
			 );
		$id = $db->insert('inquiry',$data);
		unset($_POST);
		unset($_SESSION['form']);
		$_SESSION["success"] = 'Your message has been sent successfully. Our admission team will contact you shortly.';
		redirect(href("contact.php").'#validation');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us - Bhabha University Bhopal</title>
<meta name="description" content="Get in touch with Bhabha University Bhopal — Campus address, admission helpline numbers, email addresses, Google Map location and inquiry form.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-contact-layout {
  display: grid;
  grid-template-columns: 1.4fr 1fr;
  gap: 30px;
  align-items: start;
}
@media (max-width: 991px) {
  .bu-contact-layout {
    grid-template-columns: 1fr;
  }
}

.bu-form-group {
  margin-bottom: 20px;
}
.bu-form-group label {
  display: block;
  font-size: 12.5px;
  font-weight: 700;
  color: #061D7C;
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-form-control {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #D1D5DB;
  border-radius: 6px;
  font-size: 14px;
  color: #1F2937;
  background: #F9FAFB;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-form-control:focus {
  outline: none;
  border-color: #0A1B54;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(10,27,84,0.1);
}

.bu-btn-submit {
  background: #0A1B54;
  color: #FFC107;
  font-weight: 800;
  font-size: 13.5px;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 14px 32px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.25s ease;
  box-shadow: 0 4px 16px rgba(10,27,84,0.2);
}
.bu-btn-submit:hover {
  background: #061D7C;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(10,27,84,0.3);
}

.bu-contact-info-card {
  background: #F8FAFC;
  border: 1px solid #E5E7EB;
  border-radius: 10px;
  padding: 28px;
}
.bu-contact-info-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-top: 20px;
}
.bu-contact-info-item {
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.bu-contact-icon {
  width: 44px; height: 44px;
  background: rgba(10,27,84,0.08);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px;
  color: #0A1B54;
  flex-shrink: 0;
}
.bu-contact-details h5 {
  font-size: 14px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 4px 0;
}
.bu-contact-details p, .bu-contact-details a {
  font-size: 13.5px;
  line-height: 1.55;
  color: #4B5563;
  text-decoration: none;
  margin: 0;
}
.bu-contact-details a:hover {
  color: #D99B00;
}

.bu-map-wrap {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(6,29,124,0.08);
  border: 1px solid #E5E7EB;
  margin-bottom: 30px;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Contact <em>Us</em>';
  $page_subtitle = 'We are here to answer your queries and welcome you to Bhabha University campus.';
  $page_icon     = 'fa-map-marker';
  $breadcrumbs   = [
    ['label' => 'Home',    'url' => URL_ROOT],
    ['label' => 'Contact Us', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <!-- Google Maps Embed -->
      <div class="bu-map-wrap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d871.6195191978886!2d77.47102521946762!3d23.17144184075258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c4145d4a74e11%3A0x1070e69bc11aa403!2sBhabha%20University!5e1!3m2!1sen!2sin!4v1627023920982!5m2!1sen!2sin" 
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>

      <!-- Contact Form & Details Section -->
      <div class="bu-contact-layout">

        <!-- Left: Form -->
        <div class="bu-content-card" id="validation">
          <span class="bu-content-label">Get In Touch</span>
          <h2 class="bu-content-h2">Send Us A <em>Message</em></h2>
          <div class="bu-content-divider"></div>

          <?php echo msg($stat);?>

          <form action="" method="post" enctype="multipart/form-data">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="bu-form-group">
                <label>Your Name *</label>
                <input type="text" name="name" class="bu-form-control" placeholder="Enter your full name" required>
              </div>
              <div class="bu-form-group">
                <label>Email Address *</label>
                <input type="email" name="email" class="bu-form-control" placeholder="name@example.com" required>
              </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 16px;">
              <div class="bu-form-group">
                <label>Mobile Number *</label>
                <input type="tel" name="mobile" class="bu-form-control" placeholder="10-digit phone number" required>
              </div>
              <div class="bu-form-group">
                <label>Subject *</label>
                <input type="text" name="subject" class="bu-form-control" placeholder="Admission inquiry, course details, etc." required>
              </div>
            </div>

            <div class="bu-form-group">
              <label>Message *</label>
              <textarea name="message" rows="4" class="bu-form-control" placeholder="Write your message here..." required></textarea>
            </div>

            <button type="submit" name="submit" class="bu-btn-submit">Submit Message <i class="fa fa-paper-plane" style="margin-left:6px;"></i></button>
          </form>
        </div>

        <!-- Right: Contact Information -->
        <div class="bu-contact-info-card">
          <span class="bu-content-label">Help Desk</span>
          <h3 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:800;color:#061D7C;margin:0 0 6px 0;">Campus Contact</h3>
          <p style="font-size:13px;color:#6B7280;line-height:1.5;">Reach out to our campus office for admissions, academic inquiries, or general governance.</p>
          <div class="bu-content-divider"></div>

          <div class="bu-contact-info-list">
            <div class="bu-contact-info-item">
              <div class="bu-contact-icon"><i class="fa fa-map-marker"></i></div>
              <div class="bu-contact-details">
                <h5>University Campus Address</h5>
                <p><?php echo isset($aryForm['address']) ? $aryForm['address'] : 'NH-12, Hoshangabad Road, Jatkhedi, Bhopal, Madhya Pradesh - 462026';?></p>
              </div>
            </div>

            <div class="bu-contact-info-item">
              <div class="bu-contact-icon"><i class="fa fa-phone"></i></div>
              <div class="bu-contact-details">
                <h5>Academic &amp; Registrar Helpline</h5>
                <p>
                  <a href="tel:<?php echo $aryForm['phone_one'];?>"><?php echo $aryForm['phone_one'];?></a> (Academic)<br>
                  <a href="tel:<?php echo $aryForm['phone_two'];?>"><?php echo $aryForm['phone_two'];?></a> (Registrar)
                </p>
              </div>
            </div>

            <div class="bu-contact-info-item">
              <div class="bu-contact-icon"><i class="fa fa-mobile"></i></div>
              <div class="bu-contact-details">
                <h5>Admission Helpline Numbers</h5>
                <p>
                  <a href="tel:<?php echo $aryForm['mobile_one'];?>"><?php echo $aryForm['mobile_one'];?></a>, 
                  <a href="tel:<?php echo $aryForm['mobile_two'];?>"><?php echo $aryForm['mobile_two'];?></a>
                </p>
              </div>
            </div>

            <div class="bu-contact-info-item">
              <div class="bu-contact-icon"><i class="fa fa-envelope"></i></div>
              <div class="bu-contact-details">
                <h5>Email Support</h5>
                <p><a href="mailto:<?php echo $aryForm['email'];?>"><?php echo $aryForm['email'];?></a></p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
