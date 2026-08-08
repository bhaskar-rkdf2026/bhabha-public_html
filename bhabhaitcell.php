<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bhabha IT Cell - Bhabha University Bhopal</title>
<meta name="description" content="Official IT Cell, Software Development, Web Management, and Technical Infrastructure Division at Bhabha University Bhopal.">
<?php include('inc.meta.php'); ?>
<style>
.bu-itcell-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
}
.bu-itcell-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid rgba(10,27,84,0.12);
  box-shadow: 0 12px 32px rgba(0,0,0,0.06);
  padding: 44px 36px;
  text-align: center;
  max-width: 580px;
  margin: 0 auto;
}
.bu-itcell-avatar {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid var(--bu-gold, #FFC107);
  margin-bottom: 20px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}
.bu-itcell-name {
  font-size: 22px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 6px;
}
.bu-itcell-role {
  font-size: 13px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  margin-bottom: 20px;
}
.bu-itcell-details {
  list-style: none;
  padding: 0;
  margin: 20px 0 0;
  text-align: left;
  display: inline-block;
  width: 100%;
}
.bu-itcell-details li {
  font-size: 14.5px;
  color: #333;
  padding: 10px 14px;
  background: #FAF8F5;
  border-radius: 6px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.bu-itcell-details li i {
  color: #0A1B54;
  font-size: 16px;
  width: 20px;
  text-align: center;
}
</style>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php'); ?>
  
  <?php 
  $page_title = "BHABHA IT CELL";
  $page_breadcrumb = "IT Cell";
  include('inc.page-banner.php'); 
  ?>

  <div class="bu-itcell-container">
    <div class="bu-itcell-card">
      <img src="images/web developer.jpg" alt="Er. Rajeev Indoria" class="bu-itcell-avatar" onerror="this.src='images/favicon.png';">
      <h3 class="bu-itcell-name">Er. Rajeev Indoria</h3>
      <div class="bu-itcell-role">Web Developer & Head - IT Cell</div>
      <p style="color:#666; font-size:14px; margin-bottom:24px;">Department of Information Technology & Software Development, Bhabha University Bhopal</p>

      <ul class="bu-itcell-details">
        <li><i class="fa fa-building"></i> <span><strong>Department:</strong> Bhabha IT Cell</span></li>
        <li><i class="fa fa-university"></i> <span><strong>Institution:</strong> Bhabha University Bhopal</span></li>
        <li><i class="fa fa-phone"></i> <span><strong>Mobile:</strong> +91-9039809598</span></li>
        <li><i class="fa fa-envelope"></i> <span><strong>Email:</strong> rajeev@bhabhauniversity.edu.in</span></li>
      </ul>
    </div>
  </div>

  <?php include('inc.footer.php'); ?>
</div>
<?php include('inc.footer.js.php'); ?>
</body>
</html>
