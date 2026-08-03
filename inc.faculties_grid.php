awards.phponline-admission.php<?php
// Bhabha University – Redesigned Schools & Faculties Section
?>
<section class="bu-faculties-section">
  <div class="bu-faculties-container">
    
    <!-- Header Block -->
    <div class="bu-faculties-header">
      <div class="bu-header-left">
        <span class="bu-faculties-label">SCHOOLS & FACULTIES</span>
        <h2 class="bu-faculties-heading">
          15 schools. One <em>global</em><br>university.
        </h2>
      </div>
      <div class="bu-header-right">
        <a href="<?php echo href("institutes.php"); ?>" class="bu-view-all">VIEW ALL SCHOOLS &nbsp;→</a>
      </div>
    </div>

    <!-- Main Grid (Dynamic Schools from DB) -->
    <div class="bu-faculties-grid">
      <?php
      $department = $db->get('department');
      $other_schools = [];
      if(is_array($department) && count($department) > 0) {
        $count = 1;
        $images = [
          URL_ROOT . 'new-media/image/school-of-engineering.jpg',
          URL_ROOT . 'new-media/image/school-of-medical.jpg'
        ];
        
        $main_schools = array_slice($department, 0, 6);
        $other_schools = array_slice($department, 6);

        foreach($main_schools as $index => $idepartment) {
          $img_src = $images[$index % 2];
          $num_str = str_pad($count, 2, '0', STR_PAD_LEFT);
          $count++;
      ?>
      <div class="bu-faculty-card">
        <div class="bu-card-img-wrapper">
          <span class="bu-card-number"><?php echo $num_str; ?></span>
          <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($idepartment['title']); ?>" class="bu-card-img">
        </div>
        <div class="bu-card-body">
          <h3 class="bu-card-title"><?php echo htmlspecialchars($idepartment['title']); ?></h3>
          <p class="bu-card-desc"><?php echo !empty($idepartment['short_description']) ? htmlspecialchars($idepartment['short_description']) : 'Industry-aligned curriculum, research labs and expert faculty.'; ?></p>
          <a href="<?php echo href("department.php","id=".$idepartment['id']); ?>" class="bu-card-explore">EXPLORE FACULTY &nbsp;›</a>
        </div>
      </div>
      <?php 
        }
      } else {
        echo '<p>No schools found.</p>';
      }
      ?>
    </div>

    <?php if(!empty($other_schools) && count($other_schools) > 0) { ?>
    <!-- Bottom Buttons (Remaining Schools from DB) -->
    <div class="bu-faculties-footer-links">
      <?php
      foreach($other_schools as $idepartment) {
        echo '<a href="'.href("department.php","id=".$idepartment['id']).'" class="bu-footer-tag">'.htmlspecialchars($idepartment['title']).'</a>';
      }
      ?>
    </div>
    <?php } ?>

  </div>
</section>

<!-- ===== SCHOOLS & FACULTIES STYLES ===== -->
<style>
.bu-faculties-section {
  background-color: #FAF9F6 !important; /* warm light cream bg */
  padding: 90px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-faculties-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-faculties-header {
  display: flex !important;
  justify-content: space-between !important;
  align-items: flex-end !important;
  margin-bottom: 50px !important;
  gap: 20px !important;
}
.bu-faculties-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  color: #D99B00 !important;
  text-transform: uppercase !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-faculties-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(32px, 4vw, 48px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.15 !important;
  margin: 0 !important;
}
.bu-faculties-heading em {
  font-style: italic !important;
  color: #061D7C !important;
  font-weight: 700;
  text-decoration: underline !important;
  text-decoration-color: #FFC107 !important;
  text-underline-offset: 4px !important;
}
.bu-view-all {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  border-bottom: 2px solid #FFC107 !important;
  padding-bottom: 6px !important;
  letter-spacing: 1px !important;
  transition: all 0.2s ease !important;
  white-space: nowrap !important;
}
.bu-view-all:hover {
  color: #D99B00 !important;
  border-bottom-color: #061D7C !important;
}

/* Grid Layout */
.bu-faculties-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 40px 30px !important;
  margin-bottom: 60px !important;
}
.bu-faculty-card {
  background: transparent !important;
  display: flex !important;
  flex-direction: column !important;
  position: relative !important;
}
.bu-card-img-wrapper {
  position: relative !important;
  width: 100% !important;
  height: 320px !important;
  border-radius: 4px !important;
  overflow: hidden !important;
  margin-bottom: 20px !important;
}
.bu-card-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.4s ease !important;
}
.bu-faculty-card:hover .bu-card-img {
  transform: scale(1.05) !important;
}
.bu-card-number {
  position: absolute !important;
  top: 15px !important;
  left: 15px !important;
  background-color: #061D7C !important;
  color: #FFFFFF !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  padding: 4px 8px !important;
  border-radius: 2px !important;
  z-index: 2 !important;
}

/* Card Body */
.bu-card-body {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-card-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  margin: 0 0 8px 0 !important;
  line-height: 1.35 !important;
}
.bu-card-desc {
  font-size: 13.5px !important;
  font-style: italic !important;
  color: #6B7280 !important;
  margin: 0 0 16px 0 !important;
  line-height: 1.5 !important;
}
.bu-card-tags {
  display: flex !important;
  gap: 8px !important;
  flex-wrap: wrap !important;
  margin-bottom: 20px !important;
}
.bu-tag {
  background-color: #F3EFE7 !important; /* subtle grey cream */
  color: #4B5563 !important;
  font-size: 9.5px !important;
  font-weight: 700 !important;
  letter-spacing: 0.5px !important;
  padding: 4px 10px !important;
  border-radius: 2px !important;
}
.bu-card-explore {
  font-size: 11px !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  text-decoration: none !important;
  letter-spacing: 1px !important;
  display: inline-flex !important;
  align-items: center !important;
  transition: color 0.2s ease !important;
}
.bu-card-explore:hover {
  color: #D99B00 !important;
}

/* Footer Tag Links Grid */
.bu-faculties-footer-links {
  display: flex !important;
  flex-wrap: wrap !important;
  justify-content: space-between !important;
  gap: 8px !important;
  width: 100% !important;
  border-top: 1px solid #EAEAEA !important;
  padding-top: 40px !important;
}
.bu-footer-tag {
  flex: 1 1 0px !important;
  min-width: 0 !important;
  background-color: #F3EFE7 !important;
  color: #061D7C !important;
  font-size: 10.5px !important;
  font-weight: 700 !important;
  text-align: center !important;
  padding: 14px 4px !important;
  border-radius: 3px !important;
  text-decoration: none !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.25s ease !important;
  line-height: 1.25 !important;
}
.bu-footer-tag:hover {
  background-color: #061D7C !important;
  color: #FFFFFF !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.15) !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 1024px) {
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(5, 1fr) !important;
    gap: 10px !important;
  }
}
@media (max-width: 991px) {
  .bu-faculties-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 30px 20px !important;
  }
  .bu-card-img-wrapper {
    height: 280px !important;
  }
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
  }
  .bu-faculties-section {
    padding: 60px 16px !important;
  }
}
@media (max-width: 575px) {
  .bu-faculties-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 16px !important;
  }
  .bu-faculties-grid {
    grid-template-columns: 1fr !important;
    gap: 30px !important;
  }
  .bu-faculties-footer-links {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 8px !important;
  }
}
</style>
