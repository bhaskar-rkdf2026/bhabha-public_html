<?php
// Bhabha University – Redesigned Premium Footer matching the mockup exactly
?>
<footer class="bu-main-footer"> 
  <div class="bu-footer-container">
    
    <!-- TOP SECTION: 5 Columns -->
    <div class="bu-footer-grid">
      
      <!-- Column 1: Bhabha University Logo & Info -->
      <div class="bu-footer-col bu-footer-info-col">
        <div class="bu-footer-logo-wrap">
          <img src="https://www.bhabhauniversity.edu.in/images/Bhabha university logo.png" alt="Bhabha University Logo" class="bu-footer-logo">
          <div class="bu-footer-title-wrap">
            <h3 class="bu-footer-main-title">Bhabha University</h3>
            <span class="bu-footer-subtitle">BHOPAL &nbsp;·&nbsp; INDIA</span>
          </div>
        </div>
        <p class="bu-footer-desc">
          A globally recognized centre of excellence in teaching, research and innovation. Chartered under the State Private University Act.
        </p>
        
        <!-- Contact details -->
        <div class="bu-footer-contact-details">
          <div class="bu-contact-row">
            <i class="fa fa-map-marker"></i>
            <span>University Estate, Sector 12, Bhopal, MP 462001, India</span>
          </div>
          <div class="bu-contact-row">
            <i class="fa fa-phone"></i>
            <a href="tel:<?php echo !empty($aryForm['phone_one']) ? $aryForm['phone_one'] : '+919165025500'; ?>">
              <?php echo !empty($aryForm['phone_one']) ? $aryForm['phone_one'] : '+91 91650 25500'; ?>
            </a>
          </div>
          <div class="bu-contact-row">
            <i class="fa fa-envelope"></i>
            <a href="mailto:<?php echo !empty($aryForm['email']) ? $aryForm['email'] : 'info@bhabhauniversity.edu.in'; ?>">
              <?php echo !empty($aryForm['email']) ? $aryForm['email'] : 'info@bhabhauniversity.edu.in'; ?>
            </a>
          </div>
        </div>

        <!-- Social Badges (F I L T Y) -->
        <div class="bu-footer-socials">
          <a href="https://www.facebook.com/BhabhaUniversityIndia/" target="_blank" class="bu-social-badge" title="Facebook">F</a>
          <a href="https://www.instagram.com/bhabhauniversitybhopal/" target="_blank" class="bu-social-badge" title="Instagram">I</a>
          <a href="https://in.linkedin.com/company/bhabha-university" target="_blank" class="bu-social-badge" title="LinkedIn">L</a>
          <a href="https://twitter.com/bhabhaUniversty" target="_blank" class="bu-social-badge" title="Twitter">T</a>
          <a href="https://www.youtube.com/channel/UCHyRBhcOyXt2CvTAW6JzP-g" target="_blank" class="bu-social-badge" title="YouTube">Y</a>
        </div>
      </div>

      <!-- Column 2: Academics -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">ACADEMICS</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("course.php"); ?>">Undergraduate</a></li>
          <li><a href="<?php echo href("course.php"); ?>">Postgraduate</a></li>
          <li><a href="<?php echo href("course.php"); ?>">Doctoral Programs</a></li>
          <li><a href="<?php echo href("course.php"); ?>">Diploma & Certificate</a></li>
          <li><a href="<?php echo href("course.php"); ?>">Online Learning</a></li>
        </ul>
      </div>

      <!-- Column 3: University -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">UNIVERSITY</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("page.php","id=1"); ?>">About Us</a></li>
          <li><a href="<?php echo href("page.php","id=2"); ?>">Leadership</a></li>
          <li><a href="<?php echo href("page.php","id=3"); ?>">Vision & Mission</a></li>
          <li><a href="<?php echo href("page.php","id=4"); ?>">Accreditation</a></li>
          <li><a href="<?php echo href("page.php","id=5"); ?>">IQAC</a></li>
          <li><a href="<?php echo href("page.php","id=6"); ?>">NAAC</a></li>
          <li><a href="<?php echo href("page.php","id=7"); ?>">NIRF Rankings</a></li>
        </ul>
      </div>

      <!-- Column 4: Resources -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">RESOURCES</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("page.php","id=21"); ?>">Digital Library</a></li>
          <li><a href="<?php echo href("page.php","id=22"); ?>">Research Centres</a></li>
          <li><a href="<?php echo href("page.php","id=23"); ?>">Scholarships</a></li>
          <li><a href="<?php echo href("page.php","id=24"); ?>">Downloads</a></li>
          <li><a href="<?php echo href("page.php","id=25"); ?>">Mandatory Disclosures</a></li>
          <li><a href="<?php echo href("page.php","id=26"); ?>">Anti-Ragging</a></li>
        </ul>
      </div>

      <!-- Column 5: Community -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">COMMUNITY</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("contact.php"); ?>">Student Services</a></li>
          <li><a href="<?php echo href("contact.php"); ?>">Alumni Network</a></li>
          <li><a href="<?php echo href("contact.php"); ?>">Careers</a></li>
          <li><a href="<?php echo href("contact.php"); ?>">Recruiters</a></li>
          <li><a href="<?php echo href("contact.php"); ?>">Media & News</a></li>
        </ul>
      </div>

    </div>

    <!-- MIDDLE SECTION: Subscription form -->
    <div class="bu-footer-divider"></div>
    <div class="bu-footer-sub-row">
      <div class="bu-sub-text">
        <h3 class="bu-sub-heading">Stay informed</h3>
        <p class="bu-sub-desc">Subscribe for admission updates, research news and university events.</p>
      </div>
      <form class="bu-sub-form" action="" method="post" onsubmit="alert('Thank you for subscribing!'); return false;">
        <input type="email" placeholder="your@email.com" class="bu-sub-input" required>
        <button type="submit" class="bu-sub-btn">SUBSCRIBE</button>
      </form>
    </div>

    <!-- BOTTOM SECTION: Grayscale Leaflet Map -->
    <div class="bu-footer-map-row">
      <div id="buFooterMap" class="bu-footer-map"></div>
    </div>

  </div>
  
  <!-- Include legacy affiliates logos dynamically inside to keep functions working -->
  <?php include('inc.affiliate.php');?>
</footer>

<div class="bu-footer-copyright">
  <div class="bu-footer-container">
    <span>&copy; <?php echo date('Y'); ?> Bhabha University. All Rights reserved. Maintained by Bhabha IT Cell.</span>
  </div>
</div>

<!-- Leaflet Map CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- ===== FOOTER STYLES ===== -->
<style>
.bu-main-footer {
  background-color: #040F4A !important; /* Dark Navy */
  padding: 80px 20px 40px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  box-sizing: border-box !important;
  color: #FFFFFF !important;
}
.bu-footer-container {
  max-width: 1200px !important;
  margin: 0 auto !important;
}

/* 5 Columns Layout */
.bu-footer-grid {
  display: grid !important;
  grid-template-columns: 1.5fr repeat(4, 1fr) !important;
  gap: 40px 30px !important;
  margin-bottom: 50px !important;
}
.bu-footer-col {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}

/* Column 1 info */
.bu-footer-logo-wrap {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  margin-bottom: 20px !important;
}
.bu-footer-logo {
  width: 44px !important;
  height: 44px !important;
  object-fit: contain !important;
}
.bu-footer-title-wrap {
  display: flex !important;
  flex-direction: column !important;
  align-items: flex-start !important;
}
.bu-footer-main-title {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: 19px !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 !important;
}
.bu-footer-subtitle {
  font-size: 8.5px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  color: #FFC107 !important;
}
.bu-footer-desc {
  font-size: 13px !important;
  line-height: 1.65 !important;
  color: rgba(255, 255, 255, 0.7) !important;
  margin: 0 0 24px 0 !important;
  text-align: left !important;
}

/* Contact block inside col 1 */
.bu-footer-contact-details {
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
  margin-bottom: 28px !important;
  width: 100% !important;
}
.bu-contact-row {
  display: flex !important;
  gap: 10px !important;
  align-items: flex-start !important;
  text-align: left !important;
}
.bu-contact-row i {
  color: #FFC107 !important;
  font-size: 14px !important;
  margin-top: 2px !important;
  width: 14px !important;
  text-align: center !important;
}
.bu-contact-row span,
.bu-contact-row a {
  font-size: 13px !important;
  color: rgba(255, 255, 255, 0.7) !important;
  text-decoration: none !important;
  line-height: 1.4 !important;
}
.bu-contact-row a:hover {
  color: #FFC107 !important;
}

/* Social links tags (F I L T Y) */
.bu-footer-socials {
  display: flex !important;
  gap: 8px !important;
}
.bu-social-badge {
  width: 32px !important;
  height: 32px !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  background-color: #040F4A !important;
  color: #FFFFFF !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  text-decoration: none !important;
  border-radius: 3px !important;
  transition: all 0.22s ease !important;
}
.bu-social-badge:hover {
  background-color: #FFC107 !important;
  border-color: #FFC107 !important;
  color: #040F4A !important;
  transform: translateY(-2px) !important;
}

/* Categories Links Columns */
.bu-footer-heading {
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 2px !important;
  color: #FFC107 !important;
  text-transform: uppercase !important;
  margin: 10px 0 24px 0 !important;
}
.bu-footer-links {
  list-style: none !important;
  padding: 0 !important;
  margin: 0 !important;
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
}
.bu-footer-links li a {
  font-size: 13.5px !important;
  color: rgba(255, 255, 255, 0.7) !important;
  text-decoration: none !important;
  transition: color 0.2s ease !important;
}
.bu-footer-links li a:hover {
  color: #FFC107 !important;
}

/* Middle Divider & Form */
.bu-footer-divider {
  height: 1px !important;
  background-color: rgba(255, 255, 255, 0.1) !important;
  width: 100% !important;
  margin-bottom: 40px !important;
}
.bu-footer-sub-row {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  margin-bottom: 40px !important;
  gap: 30px !important;
}
.bu-sub-text {
  text-align: left !important;
}
.bu-sub-heading {
  font-family: 'Playfair Display', Georgia, serif !important;
  font-size: clamp(20px, 3vw, 26px) !important;
  font-weight: 700 !important;
  color: #FFFFFF !important;
  margin: 0 0 6px 0 !important;
}
.bu-sub-desc {
  font-size: 13.5px !important;
  color: rgba(255, 255, 255, 0.6) !important;
  margin: 0 !important;
}

/* Email Form */
.bu-sub-form {
  display: flex !important;
  max-width: 440px !important;
  width: 100% !important;
  gap: 0 !important;
}
.bu-sub-input {
  flex: 1 !important;
  background-color: #061D7C !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  border-right: none !important;
  color: #FFFFFF !important;
  font-size: 13.5px !important;
  padding: 14px 18px !important;
  outline: none !important;
  border-top-left-radius: 3px !important;
  border-bottom-left-radius: 3px !important;
  font-family: inherit !important;
}
.bu-sub-input::placeholder {
  color: rgba(255, 255, 255, 0.4) !important;
}
.bu-sub-btn {
  background-color: #FFC107 !important;
  color: #040F4A !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  padding: 14px 28px !important;
  border: none !important;
  cursor: pointer !important;
  border-top-right-radius: 3px !important;
  border-bottom-right-radius: 3px !important;
  transition: background-color 0.2s ease !important;
}
.bu-sub-btn:hover {
  background-color: #D99B00 !important;
}

/* Grayscale Leaflet Map */
.bu-footer-map-row {
  width: 100% !important;
  margin-bottom: 30px !important;
}
.bu-footer-map {
  width: 100% !important;
  height: 380px !important;
  border-radius: 4px !important;
  overflow: hidden !important;
  filter: grayscale(100%) contrast(1.15) invert(5%) !important; /* Grayscale blueprint style matching mockup */
  border: 1px solid rgba(255, 255, 255, 0.08) !important;
}

/* Copyright Row */
.bu-footer-copyright {
  background-color: #040F4A !important;
  border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
  padding: 24px 20px !important;
  width: 100% !important;
  float: left !important;
  clear: both !important;
  font-family: 'Plus Jakarta Sans', sans-serif !important;
  color: rgba(255, 255, 255, 0.4) !important;
  font-size: 12.5px !important;
  text-align: center !important;
}

/* ---- RESPONSIVE ---- */
@media (max-width: 991px) {
  .bu-footer-grid {
    grid-template-columns: 1fr repeat(2, 1fr) !important;
    gap: 30px !important;
  }
  .bu-footer-info-col {
    grid-column: 1 / -1 !important;
    max-width: 550px !important;
  }
  .bu-footer-sub-row {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 20px !important;
  }
  .bu-sub-form {
    max-width: 100% !important;
  }
  .bu-main-footer {
    padding: 60px 16px 30px 16px !important;
  }
}
@media (max-width: 575px) {
  .bu-footer-grid {
    grid-template-columns: 1fr !important;
    gap: 24px !important;
  }
  .bu-footer-heading {
    margin-bottom: 12px !important;
  }
  .bu-footer-map {
    height: 260px !important;
  }
}
</style>

<!-- ===== MAP LOADER ===== -->
<script>
(function() {
  function initFooterMap() {
    if (typeof L === 'undefined') { setTimeout(initFooterMap, 150); return; }
    var target = document.getElementById('buFooterMap');
    if (!target) return;
    
    // Coordinates for Bhabha University Bhopal
    var lat = 23.2384;
    var lng = 77.4939;
    
    var map = L.map('buFooterMap', {
      zoomControl: true,
      scrollWheelZoom: false
    }).setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markerIcon = L.divIcon({
      className: 'bu-custom-marker',
      html: '<div style="background-color:#FFC107; width:12px; height:12px; border-radius:50%; border:2px solid #040F4A; box-shadow: 0 0 8px rgba(255,193,7,0.8);"></div>',
      iconSize: [12, 12]
    });

    L.marker([lat, lng], {icon: markerIcon}).addTo(map)
      .bindPopup('<b style="color:#040F4A; font-family:\'Plus Jakarta Sans\',sans-serif;">Bhabha University</b><br><span style="font-size:11px;color:#666;">University Estate, Bhopal</span>')
      .openPopup();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFooterMap);
  } else {
    initFooterMap();
  }
})();
</script>
