<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dr Homi Bhabha Online Knowledge Portal - Bhabha University Bhopal</title>
<meta name="description" content="Access Dr Homi Bhabha Online Knowledge Portal, Moodle LMS, digital courseware, MOOC e-learning materials, and video lectures at Bhabha University Bhopal.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Featured LMS Portal Card */
.bu-portal-hero-card {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 60%, #1E3A8A 100%);
  border-radius: 16px;
  padding: 40px 36px;
  color: #ffffff;
  margin: 24px 0 40px;
  box-shadow: 0 16px 36px rgba(10,27,84,0.18);
  position: relative;
  overflow: hidden;
}
.bu-portal-hero-card::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 220px;
  height: 220px;
  background: rgba(255, 193, 7, 0.1);
  border-radius: 50%;
  pointer-events: none;
}

.bu-portal-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 32px;
  align-items: center;
}
@media (max-width: 991px) {
  .bu-portal-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}

.bu-portal-title {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: #FFC107;
  margin: 0 0 12px 0;
  line-height: 1.35;
}
.bu-portal-subtitle {
  font-size: 15px;
  color: rgba(255,255,255,0.9);
  line-height: 1.75;
  margin-bottom: 24px;
}

/* Credentials Sub-Card */
.bu-cred-box {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  padding: 24px;
}
.bu-cred-title {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #FFC107;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.bu-cred-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 14px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 6px;
  margin-bottom: 10px;
  font-size: 14px;
}
.bu-cred-row:last-child {
  margin-bottom: 0;
}
.bu-cred-label {
  color: rgba(255,255,255,0.8);
  font-weight: 500;
}
.bu-cred-value {
  font-family: monospace;
  font-size: 16px;
  font-weight: 700;
  color: #FFC107;
  letter-spacing: 1px;
}

/* Action Button */
.bu-btn-portal-launch {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #FFC107;
  color: #0A1B54;
  font-size: 14.5px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  padding: 14px 28px;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.25s ease;
  box-shadow: 0 4px 16px rgba(255,193,7,0.3);
}
.bu-btn-portal-launch:hover {
  background: #ffffff;
  color: #0A1B54;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(255,255,255,0.4);
  text-decoration: none;
}

/* Features Grid */
.bu-features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin: 32px 0;
}
.bu-feature-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 24px;
  transition: all 0.25s ease;
}
.bu-feature-item:hover {
  background: #ffffff;
  border-color: #0A1B54;
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(10,27,84,0.08);
}
.bu-feature-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  background: rgba(10,27,84,0.08);
  color: #0A1B54;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-feature-item h4 {
  font-size: 16.5px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 8px 0;
}
.bu-feature-item p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}

/* Notice Guide */
.bu-guide-card {
  background: #F1F5F9;
  border-left: 4px solid #0A1B54;
  border-radius: 8px;
  padding: 24px;
  margin-top: 30px;
}
.bu-guide-card h4 {
  color: #0A1B54;
  font-size: 16px;
  font-weight: 700;
  margin: 0 0 10px 0;
}
.bu-guide-card p {
  font-size: 14px;
  color: #475569;
  line-height: 1.7;
  margin: 0;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Online <em>Knowledge Portal</em>';
  $page_subtitle = 'Dr Homi Bhabha Online E-Learning &amp; MOOC LMS Portal for students and faculty.';
  $page_icon     = 'fa-laptop';
  $breadcrumbs   = [
    ['label' => 'Home',      'url' => URL_ROOT],
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Online Knowledge Portal', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Digital E-Learning Portal</span>
        <h2 class="bu-content-h2">Dr Homi Bhabha <em>Online Knowledge Portal</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Featured LMS Hero Box -->
        <div class="bu-portal-hero-card">
          <div class="bu-portal-grid">
            <div>
              <h3 class="bu-portal-title">Interactive Learning Management System (LMS)</h3>
              <p class="bu-portal-subtitle">Access course modules, video lectures, online quizzes, study notes, and assignments anytime, anywhere through Bhabha University's cloud-based e-learning portal.</p>
              <a href="https://bhabhamooc.moodlecloud.com/" target="_blank" class="bu-btn-portal-launch">
                <i class="fa fa-sign-in"></i> Launch Knowledge Portal <i class="fa fa-external-link" style="margin-left:4px;"></i>
              </a>
            </div>

            <div class="bu-cred-box">
              <div class="bu-cred-title">
                <i class="fa fa-key"></i> Default Portal Credentials
              </div>
              <div class="bu-cred-row">
                <span class="bu-cred-label">Login ID:</span>
                <span class="bu-cred-value">bhabha</span>
              </div>
              <div class="bu-cred-row">
                <span class="bu-cred-label">Password:</span>
                <span class="bu-cred-value">bhabha</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Features & Resources Grid -->
        <h3 style="font-size:20px;font-weight:700;color:#0A1B54;margin-top:40px;">Portal Services &amp; Digital Resources</h3>
        <div class="bu-features-grid">
          <div class="bu-feature-item">
            <div class="bu-feature-icon">
              <i class="fa fa-book"></i>
            </div>
            <h4>E-Books &amp; Lecture Notes</h4>
            <p>Download syllabus-mapped unit notes, reference e-books, and faculty presentation slides.</p>
          </div>

          <div class="bu-feature-item">
            <div class="bu-feature-icon">
              <i class="fa fa-play-circle"></i>
            </div>
            <h4>Recorded Video Tutorials</h4>
            <p>Watch recorded classroom lectures, virtual lab tutorials, and subject revision webinars.</p>
          </div>

          <div class="bu-feature-item">
            <div class="bu-feature-icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <h4>Online Quizzes &amp; Tests</h4>
            <p>Participate in mid-semester online quizzes, self-assessment tests, and instant grading.</p>
          </div>

          <div class="bu-feature-item">
            <div class="bu-feature-icon">
              <i class="fa fa-comments"></i>
            </div>
            <h4>Discussion Forums</h4>
            <p>Engage with department faculty members and peers for doubt resolution and collaborative learning.</p>
          </div>
        </div>

        <!-- First Time User Guide Card -->
        <div class="bu-guide-card">
          <h4><i class="fa fa-info-circle" style="color:#0A1B54;margin-right:6px;"></i> Instructions for Students &amp; Faculty</h4>
          <p>Click on the <strong>Launch Knowledge Portal</strong> button above to open the Bhabha MOOC Moodle Cloud platform. Enter the provided default credentials or use your student enrollment ID assigned by your department head. If you face any login issues, please contact your department IT coordinator or university IT desk.</p>
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
