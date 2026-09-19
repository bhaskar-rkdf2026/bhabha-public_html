<?php
// Bhabha University – Campus & Infrastructure section (Exact Design Match)
?>
<section class="bu-infra-section">
  <div class="bu-infra-container">
    
    <!-- LEFT: Text & List -->
    <div class="bu-infra-text-col">
      <span class="bu-infra-label">CAMPUS & INFRASTRUCTURE</span>
      <h2 class="bu-infra-heading">A campus designed for<br><em>discovery.</em></h2>
      <p class="bu-infra-sub">150 acres of green campus with smart classrooms, research labs, a central library, sports complex, hostels and an incubation centre.</p>
      
      <!-- 2-Column List -->
      <div class="bu-infra-list">
        <ul class="bu-infra-ul">
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#smart-classrooms" class="bu-infra-link">
              <span class="bu-bullet"></span>Smart Classrooms
            </a>
          </li>
          <li>
            <a href="<?php echo href("research.php"); ?>" class="bu-infra-link">
              <span class="bu-bullet"></span>Research Labs
            </a>
          </li>
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#health-centre" class="bu-infra-link">
              <span class="bu-bullet"></span>Medical Centre
            </a>
          </li>
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#hostel" class="bu-infra-link">
              <span class="bu-bullet"></span>Hostels
            </a>
          </li>
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#seminar-hall" class="bu-infra-link">
              <span class="bu-bullet"></span>Auditorium
            </a>
          </li>
        </ul>
        <ul class="bu-infra-ul">
          <li>
            <a href="<?php echo href("hbkportal.php"); ?>" class="bu-infra-link">
              <span class="bu-bullet"></span>Central Library
            </a>
          </li>
          <li>
            <a href="<?php echo href("research.php"); ?>#incubation" class="bu-infra-link">
              <span class="bu-bullet"></span>Innovation Hub
            </a>
          </li>
          <li>
            <a href="<?php echo href("activities.php"); ?>" class="bu-infra-link">
              <span class="bu-bullet"></span>Sports Complex
            </a>
          </li>
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#canteen" class="bu-infra-link">
              <span class="bu-bullet"></span>Cafeteria
            </a>
          </li>
          <li>
            <a href="<?php echo href("infrastructure.php"); ?>#wi-fi-campus" class="bu-infra-link">
              <span class="bu-bullet"></span>Wi-Fi Campus
            </a>
          </li>
        </ul>
      </div>

      <a href="<?php echo href("infrastructure.php"); ?>" class="bu-btn-navy bu-infra-btn">DISCOVER CAMPUS LIFE &nbsp;→</a>
    </div>

    <!-- RIGHT: Photo Collage -->
    <div class="bu-infra-collage-col">
      <div class="bu-collage-wrapper">
        <div class="bu-collage-main">
          <img src="<?php echo URL_ROOT;?>new-media/image/campus-academic-block.png" alt="Bhabha University Academic Block" class="bu-collage-img">
        </div>
        <div class="bu-collage-side">
          <div class="bu-collage-side-top">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-entrance.png" alt="Bhabha University Campus Entrance" class="bu-collage-img">
          </div>
          <div class="bu-collage-side-bottom">
            <img src="<?php echo URL_ROOT;?>new-media/image/campus-students.jpg" alt="Bhabha University Students" class="bu-collage-img">
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ===== INFRASTRUCTURE STYLES ===== -->
<style>
.bu-infra-section {
  background-color: #FAF9F6 !important; /* soft cream bg */
  padding: 85px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
}
.bu-infra-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
  display: flex !important;
  align-items: center !important;
  gap: 50px !important;
}

/* Left Text Column */
.bu-infra-text-col {
  flex: 1 !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-infra-label {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2.5px !important;
  text-transform: uppercase !important;
  color: #D99B00 !important;
  margin-bottom: 12px !important;
  display: block !important;
}
.bu-infra-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(30px, 3.8vw, 44px) !important;
  font-weight: 800 !important;
  color: #061D7C !important;
  line-height: 1.25 !important;
  margin: 0 0 20px 0 !important;
}
.bu-infra-heading em {
  font-style: italic !important;
  color: #061D7C !important;
  font-weight: 700 !important;
  text-decoration: underline !important;
  text-decoration-color: #FFC107 !important;
  text-underline-offset: 4px !important;
}
.bu-infra-sub {
  font-size: 14.5px !important;
  color: #4B5563 !important;
  line-height: 1.7 !important;
  margin: 0 0 28px 0 !important;
  max-width: 480px !important;
}

/* 2-Column list */
.bu-infra-list {
  display: flex !important;
  gap: 40px !important;
  width: 100% !important;
  margin-bottom: 36px !important;
}
.bu-infra-ul {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
}
.bu-infra-ul li {
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
}
.bu-infra-link {
  font-size: 13.5px !important;
  font-weight: 600 !important;
  color: #061D7C !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 10px !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
  cursor: pointer !important;
}
.bu-infra-link:hover {
  color: #D99B00 !important;
  transform: translateX(4px) !important;
  text-decoration: none !important;
}
.bu-infra-link:hover .bu-bullet {
  background-color: #061D7C !important;
  transform: scale(1.35) !important;
}
.bu-bullet {
  width: 6px !important;
  height: 6px !important;
  background-color: #FFC107 !important;
  border-radius: 50% !important;
  display: inline-block !important;
  transition: all 0.2s ease !important;
  flex-shrink: 0 !important;
}
.bu-infra-btn {
  padding: 12px 28px !important;
  border-radius: 3px !important;
}

/* Right Collage Column */
.bu-infra-collage-col {
  flex: 1.2 !important;
  width: 100% !important;
}
.bu-collage-wrapper {
  display: grid !important;
  grid-template-columns: 1.3fr 1fr !important;
  gap: 16px !important;
  width: 100% !important;
}
.bu-collage-main {
  height: 380px !important;
  border-radius: 4px !important;
  overflow: hidden !important;
}
.bu-collage-side {
  display: flex !important;
  flex-direction: column !important;
  gap: 16px !important;
  height: 380px !important;
}
.bu-collage-side-top,
.bu-collage-side-bottom {
  flex: 1 !important;
  border-radius: 4px !important;
  overflow: hidden !important;
}
.bu-collage-img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.4s ease !important;
  display: block !important;
}
.bu-collage-main:hover .bu-collage-img,
.bu-collage-side-top:hover .bu-collage-img,
.bu-collage-side-bottom:hover .bu-collage-img {
  transform: scale(1.05) !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-infra-container {
    flex-direction: column !important;
    gap: 36px !important;
  }
  .bu-infra-text-col {
    width: 100% !important;
    align-items: flex-start !important;
    text-align: left !important;
  }
  .bu-infra-list {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 16px 20px !important;
    width: 100% !important;
  }
  .bu-infra-ul {
    text-align: left !important;
  }
}
@media (max-width: 575px) {
  .bu-infra-section {
    padding: 50px 16px !important;
  }
  .bu-infra-heading {
    font-size: clamp(26px, 7vw, 32px) !important;
    line-height: 1.22 !important;
    margin-bottom: 14px !important;
  }
  .bu-infra-sub {
    font-size: 13.5px !important;
    line-height: 1.6 !important;
    margin-bottom: 22px !important;
  }
  .bu-infra-list {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 10px 12px !important;
    margin-bottom: 28px !important;
  }
  .bu-infra-ul li {
    font-size: 12.5px !important;
    gap: 8px !important;
  }
  .bu-collage-wrapper {
    grid-template-columns: 1fr !important;
    gap: 12px !important;
    height: auto !important;
  }
  .bu-collage-main {
    height: 220px !important;
  }
  .bu-collage-side {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 12px !important;
    height: 130px !important;
  }
  .bu-collage-side-top,
  .bu-collage-side-bottom {
    height: 130px !important;
  }
  .bu-infra-btn {
    width: 100% !important;
    text-align: center !important;
    justify-content: center !important;
  }
}
</style>
