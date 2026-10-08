<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Safety &amp; Support - Bhabha University Bhopal</title>
<meta name="description" content="Discover the comprehensive student safety, zero-tolerance anti-ragging policy, 24x7 security, Women's Internal Complaints Committee (ICC), and emergency support at Bhabha University Bhopal.">
<meta name="keywords" content="Bhabha University student safety, anti ragging cell Bhopal, women safety ICC, campus security CCTV, student grievance redressal">
<?php include('inc.meta.php'); ?>
<style>
.bu-safe-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-safe-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-safe-card:hover {
  transform: translateY(-4px);
  border-color: #EF4444;
  box-shadow: 0 12px 28px rgba(239,68,68,0.12);
}
.bu-safe-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: #FEF2F2;
  color: #DC2626;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-safe-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-safe-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-emergency-box {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  border-radius: 14px;
  padding: 28px 30px;
  color: #ffffff;
  margin-top: 25px;
}
.bu-emergency-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin-top: 18px;
}
.bu-em-card {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  padding: 14px 16px;
}
.bu-em-card h5 {
  color: #FFC107;
  font-size: 13px;
  font-weight: 800;
  text-transform: uppercase;
  margin: 0 0 4px;
}
.bu-em-card p {
  font-size: 15px;
  font-weight: 700;
  color: #ffffff;
  margin: 0;
}
</style>
</head>
<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- INNER BANNER -->
  <?php
  $page_title    = 'Student Safety &amp; <em>Support</em>';
  $page_subtitle = 'Ensuring a secure, zero-tolerance anti-ragging campus through 24x7 surveillance, Women Internal Complaints Committee (ICC), student counseling, and quick-response security teams.';
  $page_icon     = 'fa-shield';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Student Safety & Support', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'student-safety'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Zero Tolerance Campus</span>
        <h2 class="bu-content-h2">A Fearless &amp; <em>Secure Campus Environment</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/a21a86aaaa2a4e2d73c247cdb15af08e.jpg" alt="Bhabha University CCTV Secured Campus" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-shield"></i> 24&times;7 High-Definition CCTV Surveillance &amp; Regulated Campus Checkpoints
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            Bhabha University maintains an unwavering commitment to the safety, dignity, mental comfort, and well-being of all students, faculty members, and campus visitors.
          </p>
          <p>
            Our sprawling 32-acre campus operates under comprehensive round-the-clock physical security patrols, high-definition electronic surveillance, strictly monitored perimeter checkpoints, and institutional grievance bodies adhering strictly to UGC and Supreme Court mandates.
          </p>
        </div>
      </div>

      <!-- Section 2: Safety Pillars Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Multi-Layered Security</span>
        <h2 class="bu-content-h2">Security Systems &amp; <em>Support Cells</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-safe-grid">
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-ban"></i></div>
            <h4>Anti-Ragging Squad</h4>
            <p>Zero tolerance policy against ragging. Strict adherence to UGC guidelines with surprise squad patrols across hostels, canteens, and sports fields.</p>
          </div>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-female"></i></div>
            <h4>Women's Safety &amp; ICC</h4>
            <p>Active Internal Complaints Committee (ICC) ensuring strict gender sensitization, prevention of sexual harassment (POSH), and swift confidential hearings.</p>
          </div>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-video-camera"></i></div>
            <h4>24x7 HD CCTV Surveillance</h4>
            <p>Over 200+ networked digital security cameras monitoring entry gates, academic corridors, common lounges, and hostel perimeter fences.</p>
          </div>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-id-card"></i></div>
            <h4>Biometric Access &amp; Guards</h4>
            <p>Trained security personnel stationed at all campus gates with biometric turnstiles and mandatory visitor verification logging.</p>
          </div>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-fire-extinguisher"></i></div>
            <h4>Fire &amp; Disaster Safety</h4>
            <p>Commercial fire hydrants, automated smoke alarms, dry powder extinguishers on every floor, and scheduled student evacuation drills.</p>
          </div>
          <div class="bu-safe-card">
            <div class="bu-safe-icon"><i class="fa fa-user-secret"></i></div>
            <h4>Confidential Grievance Portal</h4>
            <p>Digital grievance redressal portal allowing students to submit academic or administrative concerns directly to the university ombudsman.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Anti-Ragging Measures & Rules -->
      <div class="bu-content-card">
        <span class="bu-content-label">Statutory Compliance</span>
        <h2 class="bu-content-h2">Anti-Ragging Regulations &amp; <em>Penalties</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            In compliance with the regulations of the University Grants Commission (UGC) and Apex Court directives, ragging in any physical, verbal, mental, or cyber form is a non-bailable criminal offense.
          </p>
          <ul style="padding-left:20px; line-height:1.8; color:#475569;">
            <li><strong>Mandatory Affidavit:</strong> Every enrolled student and their parent must submit an online anti-ragging affidavit at the start of each academic year.</li>
            <li><strong>Immediate Penalties:</strong> Involvement in ragging warrants immediate rustication, cancellation of scholarship/hostel allotment, and lodging of an FIR with local police.</li>
            <li><strong>Anti-Ragging Helpline (Toll-Free):</strong> 1800-180-5522 (National 24x7 UGC Helpline).</li>
          </ul>
        </div>

        <div class="bu-emergency-box" style="background:linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important; border-radius:12px; padding:26px 28px; margin-top:25px; box-shadow:0 8px 24px rgba(10,27,84,0.15); border:1px solid rgba(255,193,7,0.2);">
          <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-phone text-warning mr-2"></i> Campus Emergency Control Room</h3>
          <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0 0 16px;">Save these 24x7 emergency contacts on your mobile phone:</p>

          <div class="bu-emergency-grid">
            <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
              <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Campus Security Desk</h5>
              <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">0755-4246498</p>
            </div>
            <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
              <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Chief Proctor Office</h5>
              <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">+91-9893000000</p>
            </div>
            <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
              <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Women Safety Cell (ICC)</h5>
              <p style="color:#ffffff !important; font-size:13px; font-weight:600; margin:0;">icc@bhabhauniversity.edu.in</p>
            </div>
            <div class="bu-em-card" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:8px; padding:12px 14px;">
              <h5 style="color:#FFC107 !important; font-size:13px; font-weight:700; margin:0 0 4px;">Local Police Control</h5>
              <p style="color:#ffffff !important; font-size:14px; font-weight:700; margin:0;">112 / 100</p>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->
</div>
<?php include('inc.footer.js.php'); ?>
</body>
</html>
