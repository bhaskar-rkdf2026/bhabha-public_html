<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Institutes & Schools - Bhabha University Bhopal</title>
<meta name="description" content="Discover multidisciplinary institutes and schools at Bhabha University Bhopal — Engineering, Pharmacy, Dental, Nursing, Management, Law, Agriculture, Science, and Education.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}
.bu-fac-list-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
}
.bu-fac-card {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 28px 24px;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  gap: 14px;
  box-shadow: 0 4px 18px rgba(6,29,124,0.05);
  transition: all 0.28s ease;
  position: relative;
  overflow: hidden;
}
.bu-fac-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 4px; height: 100%;
  background: #FFC107;
  transform: scaleY(0);
  transition: transform 0.28s ease;
}
.bu-fac-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 18px 36px rgba(6,29,124,0.12);
  text-decoration: none;
}
.bu-fac-card:hover::before {
  transform: scaleY(1);
}
.bu-fac-icon {
  width: 52px; height: 52px;
  background: rgba(10,27,84,0.07);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 22px;
  color: #0A1B54;
  transition: all 0.28s ease;
}
.bu-fac-card:hover .bu-fac-icon {
  background: #0A1B54;
  color: #FFC107;
}
.bu-fac-card h4 {
  font-size: 17px;
  font-weight: 700;
  color: #061D7C;
  margin: 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.35;
}
.bu-fac-card p {
  font-size: 13px;
  line-height: 1.6;
  color: #6B7280;
  margin: 0;
}
.bu-fac-btn {
  font-size: 11.5px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: auto;
}
.bu-fac-btn i {
  transition: transform 0.2s ease;
}
.bu-fac-card:hover .bu-fac-btn i {
  transform: translateX(4px);
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Schools & <em>Institutes</em>';
  $page_subtitle = 'Explore our multidisciplinary schools offering undergraduate, postgraduate, and doctoral degree programmes.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home',    'url' => URL_ROOT],
    ['label' => 'Schools & Institutes', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>
      <div class="bu-content-card">
        <span class="bu-content-label">Academic Divisions</span>
        <h2 class="bu-content-h2">All Schools &amp; <em>Institutes</em></h2>
        <div class="bu-content-divider"></div>
        
        <div class="bu-fac-list-grid">
          <?php
          $department = $db->get('department');
          if(is_array($department) && count($department) > 0) {
            foreach($department as $idepartment) {
              $icon = !empty($idepartment['icon']) ? $idepartment['icon'] : 'fa-university';
          ?>
          <a href="<?php echo href("department.php","id=".$idepartment['id']);?>" class="bu-fac-card">
            <div class="bu-fac-icon">
              <i class="<?php echo $icon;?>"></i>
            </div>
            <h4><?php echo $idepartment['title'];?></h4>
            <p>Providing industry-aligned education, experiential learning, and modern research infrastructure.</p>
            <span class="bu-fac-btn">Explore School <i class="fa fa-arrow-right"></i></span>
          </a>
          <?php 
            }
          } 
          ?>
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
