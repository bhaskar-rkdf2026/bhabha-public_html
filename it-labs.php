<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IT &amp; Computer Labs - Bhabha University Bhopal</title>
<meta name="description" content="Explore state-of-the-art computer labs, Apple iMac lab, AI/ML computing clusters, and high-speed fiber-optic network at Bhabha University Bhopal.">
<meta name="keywords" content="Bhabha University computer labs, IT infrastructure Bhopal, AI ML lab, computing center, Apple Mac lab, engineering simulation labs">
<?php include('inc.meta.php'); ?>
<style>
.bu-it-hero-img-box {
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 25px;
  box-shadow: 0 6px 20px rgba(10,27,84,0.08);
}
.bu-it-hero-img-box img {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  display: block;
}
.bu-it-specs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin: 25px 0 35px;
}
.bu-it-spec-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 22px 18px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(10,27,84,0.04);
  transition: all 0.25s ease;
}
.bu-it-spec-card:hover {
  transform: translateY(-3px);
  border-color: #FFC107;
  box-shadow: 0 10px 24px rgba(10,27,84,0.1);
}
.bu-it-spec-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #FFC107;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 12px;
}
.bu-it-spec-num {
  font-size: 26px;
  font-weight: 800;
  color: #0A1B54;
  line-height: 1.1;
  margin-bottom: 4px;
}
.bu-it-spec-label {
  font-size: 12px;
  font-weight: 700;
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-labs-spectrum-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin-top: 20px;
}
.bu-lab-item-box {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 22px 20px;
  transition: all 0.2s ease;
}
.bu-lab-item-box:hover {
  background: #ffffff;
  border-color: #0A1B54;
  box-shadow: 0 8px 24px rgba(10,27,84,0.08);
}
.bu-lab-item-box h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-lab-item-box h4 i {
  color: #D99B00;
}
.bu-lab-item-box p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.55;
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
  $page_title    = 'IT &amp; <em>Computer Labs</em>';
  $page_subtitle = 'Advanced computing facilities featuring 1,000+ networked high-end systems, dedicated 1 Gbps fiber connectivity, AI/ML compute labs, and specialized engineering software.';
  $page_icon     = 'fa-laptop';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'IT & Computer Labs', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'it-labs'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">High-Performance Computing</span>
        <h2 class="bu-content-h2">Next-Gen <em>Computing Infrastructure</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/b6123df20111594aa04d8b15dd6ce2af.jpg" alt="Bhabha University Central Computer Laboratory" loading="lazy" onerror="this.onerror=null; this.src='<?php echo URL_ROOT; ?>images/skill_lab.jpg';">
          <div class="bu-page-featured-caption">
            <i class="fa fa-laptop"></i> Bhabha University Central High-Performance Computing Laboratory
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            Bhabha University recognizes computational prowess as an indispensable pillar of modern scientific inquiry, engineering innovation, and corporate success. The university hosts over <strong>1,000+ high-end desktop workstations</strong> organized into 15+ specialized, air-conditioned computer laboratories.
          </p>
          <p>
            Every laboratory is interconnected through gigabit structured cabling backed by a high-capacity <strong>1 Gbps dedicated optical fiber leased line</strong> and university-wide secure Wi-Fi access, empowering scholars with uninterrupted research bandwidth.
          </p>
        </div>

        <!-- Specs Grid -->
        <div class="bu-it-specs-grid">
          <div class="bu-it-spec-card">
            <div class="bu-it-spec-icon"><i class="fa fa-desktop"></i></div>
            <div class="bu-it-spec-num">1,000+</div>
            <div class="bu-it-spec-label">Latest PC Nodes</div>
          </div>
          <div class="bu-it-spec-card">
            <div class="bu-it-spec-icon"><i class="fa fa-wifi"></i></div>
            <div class="bu-it-spec-num">1 Gbps</div>
            <div class="bu-it-spec-label">Optical Leased Line</div>
          </div>
          <div class="bu-it-spec-card">
            <div class="bu-it-spec-icon"><i class="fa fa-server"></i></div>
            <div class="bu-it-spec-num">15+</div>
            <div class="bu-it-spec-label">Specialized Labs</div>
          </div>
          <div class="bu-it-spec-card">
            <div class="bu-it-spec-icon"><i class="fa fa-lock"></i></div>
            <div class="bu-it-spec-num">100%</div>
            <div class="bu-it-spec-label">Firewall Protected</div>
          </div>
        </div>
      </div>

      <!-- Section 2: Specialized Computer Labs -->
      <div class="bu-content-card">
        <span class="bu-content-label">Specialized Facilities</span>
        <h2 class="bu-content-h2">Domain-Specific <em>Computer Laboratories</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>Our computing centers are tailored to industry-standard tools and contemporary engineering demands:</p>

          <div class="bu-labs-spectrum-grid">
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-cogs"></i> AI &amp; Machine Learning Lab</h4>
              <p>High-memory compute nodes equipped with NVIDIA GPUs, Python, TensorFlow, PyTorch, and Anaconda for deep learning model training.</p>
            </div>
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-apple"></i> Apple iMac Multimedia Studio</h4>
              <p>Creative design and iOS app development workstations equipped with macOS, Xcode, Final Cut Pro, and Adobe Creative Cloud suite.</p>
            </div>
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-shield"></i> Cyber Security &amp; Network Lab</h4>
              <p>Configured with Cisco routers, virtual switch simulators, Wireshark, Kali Linux, and ethical hacking sandboxes for hands-on defense training.</p>
            </div>
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-code"></i> Full-Stack Software Development</h4>
              <p>Dedicated coding laboratory supporting Java, C/C++, Node.js, React, Android Studio, and database management platforms like Oracle and PostgreSQL.</p>
            </div>
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-cubes"></i> CAD / CAM &amp; Simulation Lab</h4>
              <p>Equipped with licensed AutoCAD, SolidWorks, MATLAB, ANSYS, and Xilinx suites for mechanical, civil, and electrical engineering modeling.</p>
            </div>
            <div class="bu-lab-item-box">
              <h4><i class="fa fa-cloud"></i> Cloud Computing &amp; DevOps Lab</h4>
              <p>Virtualization environments running Docker, Kubernetes, AWS Educate, and Azure cloud computing resources for modern DevOps workflows.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Section 3: Licensed Software & Enterprise Support -->
      <div class="bu-content-card">
        <span class="bu-content-label">Industry Licenses</span>
        <h2 class="bu-content-h2">Licensed Software &amp; <em>IT Support</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <ul style="padding-left:20px; line-height:1.8; color:#475569;">
            <li><strong>Microsoft Campus Agreement:</strong> Legal licensed Windows 11 Enterprise, Microsoft Office 365, and Visual Studio tools available across all terminals.</li>
            <li><strong>Engineering Suite:</strong> MATLAB &amp; Simulink with 50+ toolboxes, ANSYS Multiphysics, AutoCAD, and LabVIEW.</li>
            <li><strong>Pharmacy &amp; Medical Informatics:</strong> ChemDraw, Molecular Docking Software (AutoDock), and statistical tools (SPSS, GraphPad Prism).</li>
            <li><strong>Uninterrupted Power:</strong> 3-Phase centralized industrial online UPS systems ensuring zero data loss during power fluctuations.</li>
          </ul>

          <div style="background:#F8FAFC; border-radius:10px; padding:20px 24px; margin-top:20px; border:1px solid #E2E8F0; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
            <div>
              <strong style="color:#0A1B54; font-size:15px;"><i class="fa fa-wrench text-warning mr-2"></i> University IT Helpdesk:</strong>
              <span style="color:#334155; font-size:14px; margin-left:8px;">itcell@bhabhauniversity.edu.in | Block B, 2nd Floor</span>
            </div>
            <a href="<?php echo href('bhabhaitcell.php'); ?>" class="bu-btn-primary" style="font-size:12px; padding:8px 18px;">View IT Cell Team</a>
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
