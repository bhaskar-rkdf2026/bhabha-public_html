<?php
// Bhabha University – Redesigned Modern Programmes We Offer section
?>
<section class="bu-programmes-section">
  <div class="bu-programmes-container">
    
    <!-- Heading Header -->
    <div class="bu-programmes-header">
      <span class="bu-programmes-label">ACADEMIC DEPARTMENTS</span>
      <h2 class="bu-programmes-heading">Programmes We Offer</h2>
      <p class="bu-programmes-sub">Discover our diverse schools and colleges offering industry-aligned undergraduate, postgraduate, and doctoral degrees.</p>
    </div>

    <!-- Programmes Cards Grid -->
    <div class="bu-programmes-grid">
      <?php
      $department = $db->get('department');
      if(is_array($department) && count($department) > 0) {
        foreach($department as $idepartment) {
          // Fallback icon if empty or legacy
          $icon = !empty($idepartment['icon']) ? $idepartment['icon'] : 'fa fa-graduation-cap';
          // Ensure "fa" is present
          if (strpos($icon, 'fa') === false) {
            $icon = 'fa ' . $icon;
          }
      ?>
      <a href="<?php echo href("department.php","id=".$idepartment['id']."");?>" class="bu-programme-card">
        <div class="bu-card-accent-line"></div>
        <div class="bu-card-icon-wrapper">
          <i class="<?php echo htmlspecialchars($icon); ?>"></i>
        </div>
        <div class="bu-card-content">
          <h3 class="bu-card-title"><?php echo htmlspecialchars($idepartment['title']); ?></h3>
          <span class="bu-card-link">Explore School <i class="fa fa-chevron-right"></i></span>
        </div>
      </a>
      <?php 
        }
      } else {
        echo '<p class="bu-no-data">No departments found.</p>';
      }
      ?>
    </div>

  </div>
</section>

<!-- ===== PROGRAMMES SECTION STYLES ===== -->
<style>
.bu-programmes-section {
  background-color: #FAF9F6 !important; /* Soft warm off-white bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-programmes-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}
.bu-programmes-header {
  text-align: center !important;
  max-width: 650px !important;
  margin: 0 auto 55px auto !important;
}
.bu-programmes-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-programmes-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.2 !important;
  margin: 0 0 16px 0 !important;
}
.bu-programmes-sub {
  font-size: 14.5px !important;
  color: #6B7280 !important;
  line-height: 1.65 !important;
  margin: 0 !important;
}

/* Cards Grid */
.bu-programmes-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 30px 24px !important;
}
.bu-programme-card {
  background-color: #FFFFFF !important;
  border: 1px solid #EAEAEA !important;
  border-radius: 8px !important;
  padding: 32px 28px !important;
  text-decoration: none !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
  position: relative !important;
  overflow: hidden !important;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02) !important;
}
.bu-card-accent-line {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 4px !important;
  background-color: #061D7C !important;
  transform: scaleX(0) !important;
  transform-origin: left !important;
  transition: transform 0.3s ease !important;
}
.bu-programme-card:hover .bu-card-accent-line {
  transform: scaleX(1) !important;
  background-color: #FFC107 !important; /* turn gold on hover */
}
.bu-programme-card:hover {
  transform: translateY(-6px) !important;
  box-shadow: 0 16px 36px rgba(6, 29, 124, 0.08) !important;
  border-color: transparent !important;
}

/* Card Icon */
.bu-card-icon-wrapper {
  width: 52px !important;
  height: 52px !important;
  background-color: rgba(6, 29, 124, 0.05) !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-bottom: 24px !important;
  transition: all 0.3s ease !important;
}
.bu-card-icon-wrapper i {
  font-size: 20px !important;
  color: #061D7C !important;
  transition: all 0.3s ease !important;
}
.bu-programme-card:hover .bu-card-icon-wrapper {
  background-color: #FFC107 !important;
}
.bu-programme-card:hover .bu-card-icon-wrapper i {
  color: #061D7C !important;
  transform: scale(1.1) !important;
}

/* Card Content */
.bu-card-content {
  width: 100% !important;
}
.bu-card-title {
  font-size: 17px !important;
  font-weight: 700 !important;
  color: #061D7C !important;
  margin: 0 0 16px 0 !important;
  line-height: 1.4 !important;
  transition: color 0.2s ease !important;
}
.bu-programme-card:hover .bu-card-title {
  color: #061D7C !important;
}
.bu-card-link {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  color: #D99B00 !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 6px !important;
  transition: gap 0.2s ease !important;
}
.bu-card-link i {
  font-size: 9px !important;
  transition: transform 0.2s ease !important;
}
.bu-programme-card:hover .bu-card-link {
  color: #061D7C !important;
}
.bu-programme-card:hover .bu-card-link i {
  transform: translateX(4px) !important;
}

.bu-no-data {
  text-align: center !important;
  color: #6B7280 !important;
  grid-column: 1 / -1 !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-programmes-grid {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 20px !important;
  }
  .bu-programmes-section {
    padding: 60px 16px !important;
  }
}
@media (max-width: 575px) {
  .bu-programmes-grid {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
  }
  .bu-programme-card {
    padding: 24px 20px !important;
  }
}
</style>