<?php
// Bhabha University – Redesigned Premium Footer with Ultra-Fast Map & High Performance
?>
<footer class="bu-main-footer"> 
  <div class="bu-footer-container">
    
    <!-- TOP SECTION: 5 Columns -->
    <div class="bu-footer-grid">
      
      <!-- Column 1: Bhabha University Logo & Info -->
      <div class="bu-footer-col bu-footer-info-col">
        <div class="bu-footer-logo-wrap">
          <img src="<?php echo URL_IMG;?>Bhabha university logo.png" alt="Bhabha University Logo" class="bu-footer-logo" onerror="this.src='https://www.bhabhauniversity.edu.in/images/Bhabha university logo.png'">
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

        <!-- Social Badges -->
        <div class="bu-footer-socials">
          <a href="https://www.facebook.com/BhabhaUniversityIndia/" target="_blank" class="bu-social-badge" title="Facebook"><i class="fa fa-facebook"></i></a>
          <a href="https://www.instagram.com/bhabhauniversitybhopal/" target="_blank" class="bu-social-badge" title="Instagram"><i class="fa fa-instagram"></i></a>
          <a href="https://in.linkedin.com/company/bhabha-university" target="_blank" class="bu-social-badge" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
          <a href="https://twitter.com/bhabhaUniversty" target="_blank" class="bu-social-badge" title="Twitter"><i class="fa fa-twitter"></i></a>
          <a href="https://www.youtube.com/channel/UCHyRBhcOyXt2CvTAW6JzP-g" target="_blank" class="bu-social-badge" title="YouTube"><i class="fa fa-youtube-play"></i></a>
        </div>
      </div>

      <!-- Column 2: Academics -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">ACADEMICS</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("course.php"); ?>">Undergraduate</a></li>
          <li><a href="<?php echo href("course.php"); ?>">Postgraduate</a></li>
          <li><a href="<?php echo href("faculties.php"); ?>">Faculties &amp; Institutes</a></li>
          <li><a href="<?php echo href("syllabus.php"); ?>">Scheme &amp; Syllabus</a></li>
          <li><a href="<?php echo href("academic.php"); ?>">Academic Calendar</a></li>
        </ul>
      </div>

      <!-- Column 3: University -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">UNIVERSITY</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("about.php"); ?>">About Us</a></li>
          <li><a href="<?php echo href("leadership.php"); ?>">Leadership</a></li>
          <li><a href="<?php echo href("mission-vision.php"); ?>">Vision &amp; Mission</a></li>
          <li><a href="<?php echo href("infrastructure.php"); ?>">Campus Infrastructure</a></li>
          <li><a href="<?php echo href("approvals.php"); ?>">Approvals &amp; Recognitions</a></li>
          <li><a href="<?php echo href("nirf.php"); ?>">NIRF Rankings</a></li>
          <li><a href="<?php echo href("auditreport.php"); ?>">Audit Report</a></li>
        </ul>
      </div>

      <!-- Column 4: Resources -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">RESOURCES</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("research.php"); ?>">Research &amp; Innovation</a></li>
          <li><a href="<?php echo href("scholarship.php"); ?>">Scholarships &amp; Aid</a></li>
          <li><a href="<?php echo href("downlod1.php"); ?>">Form Downloads</a></li>
          <li><a href="<?php echo href("BUQuestionPapers.php"); ?>">Previous Question Papers</a></li>
          <li><a href="<?php echo href("mandatory-disclosure.php"); ?>">Mandatory Disclosures</a></li>
          <li><a href="<?php echo href("public-md.php"); ?>">Public Disclosure</a></li>
          <li><a href="<?php echo href("ugc-proforma.php"); ?>">UGC Proforma</a></li>
        </ul>
      </div>

      <!-- Column 5: Community -->
      <div class="bu-footer-col">
        <h4 class="bu-footer-heading">COMMUNITY &amp; SUPPORT</h4>
        <ul class="bu-footer-links">
          <li><a href="<?php echo href("contact.php"); ?>">Student Services</a></li>
          <li><a href="<?php echo href("alumni.php"); ?>">Alumni Network</a></li>
          <li><a href="<?php echo href("jobs.php"); ?>">Careers &amp; Jobs</a></li>
          <li><a href="<?php echo href("placements.php"); ?>">Training &amp; Placements</a></li>
          <li><a href="<?php echo href("grievance.php"); ?>">Grievance Redressal</a></li>
          <li><a href="<?php echo href("news.php"); ?>">Media &amp; News</a></li>
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

    <!-- BOTTOM SECTION: High Speed Interactive Google Map -->
    <div class="bu-footer-map-row">
      <iframe src="https://maps.google.com/maps?q=Bhabha%20University%2C%20NH-12%2C%20Jatkhedi%2C%20Bhopal&t=&z=15&ie=UTF8&iwloc=&output=embed" 
              width="100%" 
              height="350" 
              style="border:0; border-radius:10px; box-shadow: 0 4px 20px rgba(0,0,0,0.25);" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade" 
              title="Bhabha University Location Map">
      </iframe>
    </div>

  </div>
</footer>

<div class="bu-footer-copyright">
  <div class="bu-footer-container">
    <span>&copy; <?php echo date('Y'); ?> Bhabha University. All Rights reserved. Maintained by Bhabha IT Cell.</span>
  </div>
</div>

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

/* Footer Map Row */
.bu-footer-map-row {
  width: 100% !important;
  margin-bottom: 60px !important;
  padding-bottom: 20px !important;
  display: block !important;
  clear: both !important;
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
}
</style>
