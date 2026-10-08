<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Health &amp; Wellness - Bhabha University Bhopal</title>
<meta name="description" content="Comprehensive student healthcare at Bhabha University Bhopal. Features on-campus medical center, 24x7 doctor on call, ambulance service, homeopathy clinic, and Unload Pittara mental wellness support.">
<meta name="keywords" content="Bhabha University healthcare, campus medical center Bhopal, student health wellness, ambulance service, Unload Pittara counselling">
<?php include('inc.meta.php'); ?>
<style>
.bu-health-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-health-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-health-card:hover {
  transform: translateY(-4px);
  border-color: #EF4444;
  box-shadow: 0 12px 28px rgba(239,68,68,0.12);
}
.bu-health-icon {
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
.bu-health-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-health-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-wellness-banner {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  border-radius: 14px;
  padding: 30px;
  color: #ffffff;
  margin-top: 25px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  flex-wrap: wrap;
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
  $page_title    = 'Health &amp; <em>Wellness Care</em>';
  $page_subtitle = 'Prioritizing student well-being through an on-campus primary healthcare center, 24x7 doctor on call, ambulance facility, mental wellness counseling, and regular health checkup camps.';
  $page_icon     = 'fa-heartbeat';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Health & Wellness', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'health-wellness'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Caring For Every Scholar</span>
        <h2 class="bu-content-h2">Campus Medical &amp; <em>Wellness Center</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/e24d4326ba8712763cc0e1484f66dc4d.jpg" alt="Bhabha University Health Care Centre" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-heartbeat"></i> Bhabha University Campus Health Care &amp; Emergency Medical Centre
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            At Bhabha University, student health, physical vitality, and mental peace of mind form the foundation of academic achievement. The university maintains a well-appointed <strong>On-Campus Health Center</strong> staffed with qualified resident medical officers, experienced nursing staff, and emergency medical technicians.
          </p>
          <p>
            Whether it is immediate first-aid, routine seasonal care, medication dispensing, or mental wellness mentoring, students receive caring, confidential, and prompt attention round the clock.
          </p>
        </div>
      </div>

      <!-- Section 2: Healthcare Highlights Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Medical Amenities</span>
        <h2 class="bu-content-h2">Key Healthcare <em>Services</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-health-grid">
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-user-md"></i></div>
            <h4>24x7 Medical Officer On-Call</h4>
            <p>Qualified physicians and nursing personnel stationed on-campus for general consultations, diagnosis, and emergency first response.</p>
          </div>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-ambulance"></i></div>
            <h4>Dedicated Ambulance Unit</h4>
            <p>Fully equipped 24-hour campus ambulance on standby with oxygen support and stretcher facilities for rapid hospital transfer.</p>
          </div>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-medkit"></i></div>
            <h4>Free Dispensary &amp; Pharmacy</h4>
            <p>Essential medicines, first-aid supplies, antiseptic dressings, and over-the-counter wellness tablets provided free of cost to students.</p>
          </div>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-hospital-o"></i></div>
            <h4>Tie-Up With Multi-Specialty Hospitals</h4>
            <p>Institutional tie-ups with leading multi-specialty tertiary hospitals in Bhopal for prioritized inpatient care and diagnostics.</p>
          </div>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-leaf"></i></div>
            <h4>AYUSH &amp; Homeopathic OPD</h4>
            <p>Holistic healthcare support leveraging the university's esteemed Faculty of Homeopathy and Ayurvedic medicinal resources.</p>
          </div>
          <div class="bu-health-card">
            <div class="bu-health-icon"><i class="fa fa-heart"></i></div>
            <h4>Mental Wellness: Unload Pittara</h4>
            <p>Dedicated youth psychological counselling cell providing confidential stress relief, career guidance, and anti-anxiety support.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Preventive Wellness & Annual Camps -->
      <div class="bu-content-card">
        <span class="bu-content-label">Preventive Care</span>
        <h2 class="bu-content-h2">Annual Health Drives &amp; <em>Wellness Camps</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>The university regularly conducts proactive health and screening programs for the campus community:</p>
          <ul style="padding-left:20px; line-height:1.8; color:#475569;">
            <li><strong>Annual Student Health Checkups:</strong> Mandatory medical examinations for all incoming first-year scholars covering vision, blood grouping, BMI, and vital checks.</li>
            <li><strong>Dental Care &amp; Oral Hygiene Camps:</strong> Organized in collaboration with dental surgeons offering free consultations and preventative advice.</li>
            <li><strong>Blood Donation Drives:</strong> Regular voluntary donation camps organized in partnership with Bhopal Red Cross Society and local blood banks.</li>
            <li><strong>Yoga &amp; Meditation Sessions:</strong> Daily early-morning wellness sessions at the central sports ground cultivating mental calm and stamina.</li>
          </ul>
        </div>

        <div class="bu-dark-cta" style="background: linear-gradient(135deg, #051235 0%, #0A1B54 60%, #162B75 100%) !important;">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-phone text-danger mr-2"></i> 24x7 Medical Emergency Line</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">In case of illness or medical emergency, reach the Health Center immediately.</p>
          </div>
          <div>
            <a href="tel:07554246498" class="bu-btn-primary" style="white-space:nowrap; background:#EF4444 !important; color:#ffffff !important;"><i class="fa fa-ambulance"></i> Emergency: 0755-4246498</a>
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
