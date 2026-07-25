<?php include('config.php');
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 1;
$db->where('id', $id);
$aryData = $db->getOne('department');
if(!$aryData) {
    header("Location: ".URL_ROOT);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars($aryData['title']);?> - Bhabha University Bhopal</title>
<meta name="description" content="Learn about <?php echo htmlspecialchars($aryData['title']);?> at Bhabha University Bhopal — courses, institutes, research, and campus facilities.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}
.bu-school-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
  margin-top: 10px;
}
.bu-school-card {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 22px 20px;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 4px 16px rgba(6,29,124,0.05);
  transition: all 0.28s ease;
  border-left: 4px solid #0A1B54;
}
.bu-school-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 32px rgba(6,29,124,0.12);
  border-left-color: #FFC107;
  text-decoration: none;
}
.bu-school-card-icon {
  width: 48px; height: 48px;
  background: rgba(10,27,84,0.08);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  color: #0A1B54;
  flex-shrink: 0;
  transition: all 0.28s ease;
}
.bu-school-card:hover .bu-school-card-icon {
  background: #0A1B54;
  color: #FFC107;
}
.bu-school-card-info h4 {
  font-size: 15px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 6px 0;
  font-family: 'Plus Jakarta Sans', sans-serif;
  line-height: 1.35;
}
.bu-school-card-link {
  font-size: 11px;
  font-weight: 800;
  color: #D99B00;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.bu-gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 18px;
  margin-top: 10px;
}
.bu-gallery-item {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  height: 180px;
  box-shadow: 0 4px 16px rgba(6,29,124,0.08);
}
.bu-gallery-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.bu-gallery-item:hover .bu-gallery-img {
  transform: scale(1.08);
}
.bu-gallery-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(10,27,84,0.88) 0%, transparent 60%);
  display: flex;
  align-items: flex-end;
  padding: 14px;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.bu-gallery-item:hover .bu-gallery-overlay {
  opacity: 1;
}
.bu-gallery-overlay span {
  color: #fff;
  font-size: 13px;
  font-weight: 700;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = $aryData['title'];
  $page_subtitle = 'Empowering future professionals through industry-relevant curriculum, state-of-the-art infrastructure, and expert faculty.';
  $page_icon     = !empty($aryData['icon']) ? $aryData['icon'] : 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home',    'url' => URL_ROOT],
    ['label' => 'Schools', 'url' => href('faculties.php')],
    ['label' => $aryData['title'], 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <!-- About School Section -->
      <div class="bu-content-card">
        <span class="bu-content-label">School Overview</span>
        <h2 class="bu-content-h2"><?php echo $aryData['title'];?></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <?php echo $aryData['about'];?>
        </div>
      </div>

      <!-- Associated Institutes Grid -->
      <?php
      $db->where('department', $id);
      $insti = $db->get('institute');
      if(is_array($insti) && count($insti) > 0): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Academic Divisions</span>
        <h2 class="bu-content-h2">Institutes &amp; <em>Departments</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-school-grid">
          <?php foreach($insti as $iinsti): ?>
          <a href="<?php echo href("institute.php", "id=".$iinsti['id']);?>" class="bu-school-card">
            <div class="bu-school-card-icon">
              <i class="fa <?php echo !empty($aryData['icon']) ? $aryData['icon'] : 'fa-university';?>"></i>
            </div>
            <div class="bu-school-card-info">
              <h4><?php echo $iinsti['institute_name'];?></h4>
              <span class="bu-school-card-link">Explore Institute <i class="fa fa-arrow-right"></i></span>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- Photo Gallery -->
      <?php
      $db->where('department', $id);
      $gallery = $db->get('gallery');
      if(is_array($gallery) && count($gallery) > 0): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Media Showcase</span>
        <h2 class="bu-content-h2">Photo <em>Gallery</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-gallery-grid">
          <?php foreach($gallery as $igallery): ?>
          <div class="bu-gallery-item">
            <img src="<?php echo URL_UPLOAD;?>gallery/thumb/<?php echo $igallery['image'];?>" 
                 alt="<?php echo $igallery['title'];?>" 
                 class="bu-gallery-img"
                 onerror="this.src='extra-images/home-gallery1.jpg';">
            <div class="bu-gallery-overlay">
              <span><?php echo $igallery['title'];?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
