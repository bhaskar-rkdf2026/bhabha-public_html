<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>100 kWp Solar Power Plant - Clean Energy Initiative | Bhabha University Bhopal</title>
<meta name="description" content="Explore Bhabha University's 100 kWp Grid-Connected Rooftop Solar PV System. Generating clean renewable energy, reducing 713+ tonnes of CO2 emissions, and powering UG/PG research.">
<!-- Bootstrap core CSS -->
<?php include('inc.meta.php');?>
<style>
/* ===== SOLAR PLANT PAGE STYLES ===== */
.bu-solar-hero {
  background: linear-gradient(135deg, rgba(6, 29, 124, 0.05) 0%, rgba(255, 193, 7, 0.08) 100%);
  border: 1px solid rgba(6, 29, 124, 0.12);
  border-radius: 12px;
  padding: 24px 22px;
  margin-bottom: 28px;
  position: relative;
  overflow: hidden;
}
.bu-solar-hero::after {
  content: '\f185';
  font-family: 'FontAwesome';
  position: absolute;
  right: -15px;
  bottom: -25px;
  font-size: 140px;
  color: rgba(255, 193, 7, 0.12);
  pointer-events: none;
  line-height: 1;
}
.bu-solar-lead {
  font-size: 15px;
  line-height: 1.8;
  color: #1E293B;
  margin-bottom: 0;
  font-weight: 500;
}

/* Metric Stat Cards Grid */
.bu-solar-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 35px;
}
.bu-solar-stat-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-top: 3.5px solid #061D7C;
  border-radius: 10px;
  padding: 18px 14px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(6, 29, 124, 0.05);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
}
.bu-solar-stat-card:hover {
  transform: translateY(-4px);
  border-top-color: #FFC107;
  box-shadow: 0 10px 24px rgba(6, 29, 124, 0.12);
}
.bu-solar-stat-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 193, 7, 0.15);
  color: #D99B00;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  margin: 0 auto 10px auto;
}
.bu-solar-stat-val {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 23px;
  font-weight: 800;
  color: #061D7C;
  line-height: 1.15;
  margin-bottom: 4px;
}
.bu-solar-stat-label {
  font-size: 10.5px;
  font-weight: 800;
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

/* Section Subheadings */
.bu-solar-sec-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 16px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-solar-sec-title i {
  color: #D99B00;
}

/* Gallery Grid (Uncut Full Aspect Ratio Photos) */
.bu-solar-gallery-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-bottom: 35px;
}
.bu-solar-gallery-item {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}
.bu-solar-gallery-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 30px rgba(6, 29, 124, 0.15);
  border-color: #FFC107;
}
.bu-solar-img-wrap {
  width: 100%;
  aspect-ratio: 16 / 10.5;
  height: auto;
  overflow: hidden;
  position: relative;
  background: #030A28;
}
.bu-solar-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  transition: transform 0.4s ease;
}
.bu-solar-gallery-item:hover .bu-solar-img {
  transform: scale(1.04);
}
.bu-solar-img-overlay {
  position: absolute;
  inset: 0;
  background: rgba(4, 15, 74, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.25s ease;
  backdrop-filter: blur(2px);
  -webkit-backdrop-filter: blur(2px);
}
.bu-solar-gallery-item:hover .bu-solar-img-overlay {
  opacity: 1;
}
.bu-solar-zoom-badge {
  background: #FFC107;
  color: #061D7C;
  font-size: 11px;
  font-weight: 800;
  padding: 7px 16px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.35);
}
.bu-solar-img-caption {
  padding: 13px 16px;
  background: #FFFFFF;
  border-top: 1px solid #F1F5F9;
  font-size: 13px;
  font-weight: 700;
  color: #0F172A;
  line-height: 1.4;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-solar-img-caption i {
  color: #D99B00;
  font-size: 14px;
}

/* ========================================================
   TECHNICAL SPECIFICATIONS (RESPONSIVE GRID DESIGN)
   ======================================================== */
.bu-solar-specs-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 30px;
}

.bu-solar-spec-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 14px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  box-shadow: 0 2px 8px rgba(6, 29, 124, 0.03);
  transition: all 0.25s ease;
}

.bu-solar-spec-card:hover {
  border-color: #FFC107;
  background: #F8FAFC;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(6, 29, 124, 0.08);
}

.bu-solar-spec-left {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 13.5px;
  font-weight: 700;
  color: #061D7C;
  min-width: 0;
}

.bu-solar-spec-icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  background: rgba(6, 29, 124, 0.07);
  color: #061D7C;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  flex-shrink: 0;
  transition: all 0.2s ease;
}

.bu-solar-spec-card:hover .bu-solar-spec-icon {
  background: #FFC107;
  color: #061D7C;
}

.bu-solar-spec-label {
  white-space: nowrap;
}

.bu-solar-spec-val {
  font-size: 13.5px;
  font-weight: 700;
  color: #1E293B;
  text-align: right;
  flex-shrink: 0;
}

.bu-solar-spec-val .bu-spec-badge {
  background: #ECFDF5;
  color: #065F46;
  border: 1px solid #A7F3D0;
  padding: 3px 8px;
  border-radius: 12px;
  font-size: 11.5px;
  font-weight: 800;
}

/* Highlights Info Box */
.bu-solar-research-box {
  background: #FFFFFF;
  border-left: 4px solid #FFC107;
  border-radius: 0 10px 10px 0;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  padding: 22px 24px;
  margin-top: 25px;
  border-top: 1px solid #F1F5F9;
  border-right: 1px solid #F1F5F9;
  border-bottom: 1px solid #F1F5F9;
}
.bu-solar-research-box h4 {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 17.5px;
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 10px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-solar-research-box p {
  font-size: 14px;
  line-height: 1.7;
  color: #475569;
  margin: 0;
}

/* Lightbox Modal */
.bu-solar-lightbox {
  position: fixed;
  inset: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(3, 10, 38, 0.94);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  z-index: 999999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s ease, visibility 0.25s ease;
  box-sizing: border-box;
}
.bu-solar-lightbox.active {
  opacity: 1;
  visibility: visible;
}
.bu-solar-lightbox-dialog {
  max-width: 850px;
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.bu-solar-lightbox-img {
  max-width: 100%;
  max-height: 80vh;
  border-radius: 10px;
  border: 2px solid rgba(255, 193, 7, 0.5);
  box-shadow: 0 16px 40px rgba(0,0,0,0.7);
  object-fit: contain;
}
.bu-solar-lightbox-caption {
  color: #FFFFFF;
  font-size: 15px;
  font-weight: 600;
  margin-top: 14px;
  text-align: center;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.bu-solar-lightbox-close {
  position: absolute;
  top: -16px;
  right: -16px;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #FFC107;
  color: #061D7C;
  border: none;
  font-size: 22px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.4);
  transition: all 0.2s ease;
}
.bu-solar-lightbox-close:hover {
  background: #E11D48;
  color: #FFFFFF;
  transform: scale(1.1);
}

/* ========================================================
   RESPONSIVE BREAKPOINTS (ALL DEVICES)
   ======================================================== */
@media (max-width: 991px) {
  .bu-solar-metrics-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .bu-solar-gallery-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .bu-solar-specs-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }
  .bu-solar-spec-card {
    padding: 12px 14px;
  }
  .bu-solar-img-wrap {
    aspect-ratio: 16 / 10;
  }
}

@media (max-width: 575px) {
  .bu-solar-hero {
    padding: 18px 16px;
  }
  .bu-solar-metrics-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }
  .bu-solar-spec-card {
    flex-direction: column;
    align-items: flex-start;
    gap: 6px;
  }
  .bu-solar-spec-left {
    font-size: 13px;
  }
  .bu-solar-spec-val {
    text-align: left;
    padding-left: 46px;
    font-size: 13.5px;
    color: #0F172A;
  }
  .bu-solar-lightbox-close {
    top: -12px;
    right: -8px;
  }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!--HEADER START-->
  <?php include('inc.header.php');?>
  <!--HEADER END-->

  <?php
  $page_title    = 'Solar <em>Plant</em>';
  $page_subtitle = '100 kWp Grid-Connected Clean Energy Initiative at Bhabha University';
  $page_icon     = 'fa-sun-o';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'About Us', 'url' => href('about.php')],
    ['label' => 'Solar Plant', 'url' => '#']
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php 
    $active_page = 'solar';
    include('inc.about-sidebar.php');
    ?>

    <main class="bu-inner-content">
      <div class="bu-content-card">
        <span class="bu-content-label">Clean &amp; Green Campus Initiative</span>
        <h2 class="bu-content-h2">100 kWp Grid-Connected Rooftop Solar PV System</h2>
        <div class="bu-content-divider"></div>
        
        <div class="bu-content-body" style="padding-top:15px;">
          
          <!-- Executive Overview Hero Box -->
          <div class="bu-solar-hero">
            <p class="bu-solar-lead">
              <strong>Bhabha University, Bhopal</strong> has established a <strong>100 kWp Grid-Connected Battery-less Rooftop Solar Photovoltaic (PV) System</strong> as part of its core commitment to sustainable development and clean renewable energy. Installed in 2015 with the support of <strong>UJJAS Energy Limited</strong> and synchronized with the electricity grid in <strong>2018</strong>, this green plant powers academic blocks and serves as an active research facility for students.
            </p>
          </div>

          <!-- Environmental & Energy Performance Metrics (Till Date) -->
          <h3 class="bu-solar-sec-title">
            <i class="fa fa-bar-chart"></i> Environmental &amp; Energy Performance (Till Date)
          </h3>

          <div class="bu-solar-metrics-grid">
            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-bolt"></i></div>
              <div class="bu-solar-stat-val">100 kWp</div>
              <div class="bu-solar-stat-label">Total Installed Capacity</div>
            </div>

            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-tachometer"></i></div>
              <div class="bu-solar-stat-val">8,91,982+ kWh</div>
              <div class="bu-solar-stat-label">Total Energy Generated</div>
            </div>

            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-cloud"></i></div>
              <div class="bu-solar-stat-val">713.58 Tonnes</div>
              <div class="bu-solar-stat-label">CO₂ Emissions Avoided</div>
            </div>

            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-tree"></i></div>
              <div class="bu-solar-stat-val">598 Trees</div>
              <div class="bu-solar-stat-label">Equivalent Trees Saved</div>
            </div>

            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-tint"></i></div>
              <div class="bu-solar-stat-val">3,56,793 L</div>
              <div class="bu-solar-stat-label">Diesel Fuel Saved</div>
            </div>

            <div class="bu-solar-stat-card">
              <div class="bu-solar-stat-icon"><i class="fa fa-inr"></i></div>
              <div class="bu-solar-stat-val">₹49.05+ Lakhs</div>
              <div class="bu-solar-stat-label">Electricity Cost Savings</div>
            </div>
          </div>

          <!-- Photo Gallery of Real Site Photos (Uncut Aspect Ratio) -->
          <h3 class="bu-solar-sec-title">
            <i class="fa fa-camera"></i> Campus Solar Installation Gallery
          </h3>

          <div class="bu-solar-gallery-grid">
            
            <!-- Photo 1: Panel Cleaning / Maintenance -->
            <div class="bu-solar-gallery-item" onclick="openSolarLightbox('<?php echo URL_ROOT;?>new-media/solar/solar-rooftop-panels-1.jpg', 'Rooftop Solar PV Array Inspection & Maintenance')">
              <div class="bu-solar-img-wrap">
                <img src="<?php echo URL_ROOT;?>new-media/solar/solar-rooftop-panels-1.jpg" alt="Rooftop Solar PV Array Inspection" class="bu-solar-img" loading="lazy">
                <div class="bu-solar-img-overlay">
                  <span class="bu-solar-zoom-badge"><i class="fa fa-search-plus"></i> View Full Photo</span>
                </div>
              </div>
              <div class="bu-solar-img-caption">
                <i class="fa fa-sun-o"></i> Rooftop Solar PV Array Maintenance &amp; Inspection
              </div>
            </div>

            <!-- Photo 2: High Angle Solar Field -->
            <div class="bu-solar-gallery-item" onclick="openSolarLightbox('<?php echo URL_ROOT;?>new-media/solar/solar-rooftop-panels-2.jpg', '339 High-Efficiency Waaree 295Wp Solar PV Modules')">
              <div class="bu-solar-img-wrap">
                <img src="<?php echo URL_ROOT;?>new-media/solar/solar-rooftop-panels-2.jpg" alt="339 Waaree Solar PV Panels Array" class="bu-solar-img" loading="lazy">
                <div class="bu-solar-img-overlay">
                  <span class="bu-solar-zoom-badge"><i class="fa fa-search-plus"></i> View Full Photo</span>
                </div>
              </div>
              <div class="bu-solar-img-caption">
                <i class="fa fa-th-large"></i> 339 Waaree 295Wp High-Yield Solar Panels Array
              </div>
            </div>

            <!-- Photo 3: Inverter Station -->
            <div class="bu-solar-gallery-item" onclick="openSolarLightbox('<?php echo URL_ROOT;?>new-media/solar/solar-inverter-system.jpg', 'Delta Electronics Grid-Tied Inverter Control Station')">
              <div class="bu-solar-img-wrap">
                <img src="<?php echo URL_ROOT;?>new-media/solar/solar-inverter-system.jpg" alt="Delta Electronics Grid-Tied Inverter Room" class="bu-solar-img" loading="lazy">
                <div class="bu-solar-img-overlay">
                  <span class="bu-solar-zoom-badge"><i class="fa fa-search-plus"></i> View Full Photo</span>
                </div>
              </div>
              <div class="bu-solar-img-caption">
                <i class="fa fa-cogs"></i> Delta Electronics Grid-Tied Inverter Control Unit
              </div>
            </div>

            <!-- Photo 4: Specifications Board -->
            <div class="bu-solar-gallery-item" onclick="openSolarLightbox('<?php echo URL_ROOT;?>new-media/solar/solar-specifications-board.jpg', 'Official Broad Specifications Board - Bhabha University')">
              <div class="bu-solar-img-wrap">
                <img src="<?php echo URL_ROOT;?>new-media/solar/solar-specifications-board.jpg" alt="Broad Specifications On-Site Signboard" class="bu-solar-img" loading="lazy">
                <div class="bu-solar-img-overlay">
                  <span class="bu-solar-zoom-badge"><i class="fa fa-search-plus"></i> View Full Photo</span>
                </div>
              </div>
              <div class="bu-solar-img-caption">
                <i class="fa fa-file-text-o"></i> Official Technical Specifications On-Site Signboard
              </div>
            </div>

          </div>

          <!-- Technical Specifications (Responsive Key-Value Cards Grid) -->
          <h3 class="bu-solar-sec-title">
            <i class="fa fa-wrench"></i> Technical Specifications
          </h3>

          <div class="bu-solar-specs-grid">
            
            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-sun-o"></i></div>
                <span class="bu-solar-spec-label">Plant Type</span>
              </div>
              <div class="bu-solar-spec-val">Grid-Connected Rooftop (Battery-less)</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-bolt"></i></div>
                <span class="bu-solar-spec-label">Installed Capacity</span>
              </div>
              <div class="bu-solar-spec-val">100 kWp</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-calendar-check-o"></i></div>
                <span class="bu-solar-spec-label">Year of Installation</span>
              </div>
              <div class="bu-solar-spec-val">2015</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-exchange"></i></div>
                <span class="bu-solar-spec-label">Grid Synchronization</span>
              </div>
              <div class="bu-solar-spec-val">2018 (MP Power Grid)</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-handshake-o"></i></div>
                <span class="bu-solar-spec-label">Partner / EPC</span>
              </div>
              <div class="bu-solar-spec-val">UJJAS Energy Limited</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-th"></i></div>
                <span class="bu-solar-spec-label">Solar PV Modules</span>
              </div>
              <div class="bu-solar-spec-val">339 Waaree Solar Panels</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-sliders"></i></div>
                <span class="bu-solar-spec-label">Module Rating</span>
              </div>
              <div class="bu-solar-spec-val">295 Wp per module</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-cogs"></i></div>
                <span class="bu-solar-spec-label">Inverters</span>
              </div>
              <div class="bu-solar-spec-val">3 Delta Electronics Grid-Tied</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-area-chart"></i></div>
                <span class="bu-solar-spec-label">Plant / Rooftop Area</span>
              </div>
              <div class="bu-solar-spec-val">670.34 m² (1,980 Sq m Rooftop)</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-tachometer"></i></div>
                <span class="bu-solar-spec-label">Average Daily Yield</span>
              </div>
              <div class="bu-solar-spec-val">500 kWh (Units) / Day</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-line-chart"></i></div>
                <span class="bu-solar-spec-label">Annual Generation</span>
              </div>
              <div class="bu-solar-spec-val">1.50 Lac Units / Year</div>
            </div>

            <div class="bu-solar-spec-card">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-leaf"></i></div>
                <span class="bu-solar-spec-label">Annual CO₂ Offset</span>
              </div>
              <div class="bu-solar-spec-val">136 Tonnes CO₂ / Annum</div>
            </div>

            <div class="bu-solar-spec-card" style="grid-column: 1 / -1;">
              <div class="bu-solar-spec-left">
                <div class="bu-solar-spec-icon"><i class="fa fa-check-square-o"></i></div>
                <span class="bu-solar-spec-label">Net Metering Status</span>
              </div>
              <div class="bu-solar-spec-val">
                <span class="bu-spec-badge"><i class="fa fa-check"></i> Completed &amp; Active (Two-Way Bi-directional Grid Connected)</span>
              </div>
            </div>

          </div>

          <!-- Academic, UG/PG Research & Environmental Significance -->
          <div class="bu-solar-research-box">
            <h4><i class="fa fa-graduation-cap text-warning"></i> UG / PG Research &amp; Educational Purpose</h4>
            <p>
              The rooftop solar power plant is one of the landmark green initiatives undertaken by <strong>Bhabha University</strong> to promote renewable energy, reduce dependence on conventional energy sources, lower carbon emissions, and support environmental sustainability. 
            </p>
            <p style="margin-top:10px;">
              Beyond supplying clean green power to university blocks, this installation serves as a <strong>live practical research and demonstration facility</strong> for undergraduate (B.Tech), postgraduate (M.Tech), and doctoral (Ph.D.) scholars in Electrical Engineering, Renewable Energy, and Sustainable Technologies.
            </p>
          </div>

        </div>
      </div>
    </main>
  </div>

  <!-- Full-Size Lightbox Modal -->
  <div id="buSolarLightbox" class="bu-solar-lightbox" onclick="closeSolarLightbox(event)">
    <div class="bu-solar-lightbox-dialog" onclick="event.stopPropagation()">
      <button type="button" class="bu-solar-lightbox-close" onclick="closeSolarLightbox()" aria-label="Close Lightbox">&times;</button>
      <img id="buSolarLightboxImg" src="" alt="Solar Plant Image" class="bu-solar-lightbox-img">
      <div id="buSolarLightboxCaption" class="bu-solar-lightbox-caption"></div>
    </div>
  </div>

  <!--FOOTER START-->
  <?php include('inc.footer.php');?>
  <!--FOOTER END--> 
</div>

<!-- Lightbox JS -->
<script>
function openSolarLightbox(src, caption) {
  const modal = document.getElementById('buSolarLightbox');
  const img = document.getElementById('buSolarLightboxImg');
  const cap = document.getElementById('buSolarLightboxCaption');
  if (img) {
    img.src = src;
    img.alt = caption || 'Solar Plant Photo';
  }
  if (cap) {
    cap.textContent = caption || '';
  }
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeSolarLightbox(e) {
  if (e && e.target && e.target.closest('.bu-solar-lightbox-dialog') && !e.target.classList.contains('bu-solar-lightbox-close')) {
    return;
  }
  const modal = document.getElementById('buSolarLightbox');
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeSolarLightbox();
  }
});
</script>

<!--Bootstrap core JavaScript-->
<?php include('inc.footer.js.php');?>
</body>
</html>
