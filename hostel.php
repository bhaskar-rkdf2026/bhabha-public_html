<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hostel &amp; Residential Life - Bhabha University Bhopal</title>
<meta name="description" content="Discover secure, comfortable, and modern on-campus hostel facilities for boys and girls at Bhabha University Bhopal. Features 24x7 security, hygienic mess, high-speed Wi-Fi, and recreational spaces.">
<meta name="keywords" content="Bhabha University hostel, student accommodation Bhopal, boys hostel, girls hostel, university mess, campus residence Bhopal">
<?php include('inc.meta.php'); ?>
<style>
.bu-hostel-feature-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin: 25px 0 35px;
}
.bu-hostel-feature-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 4px 14px rgba(10,27,84,0.05);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
}
.bu-hostel-feature-card:hover {
  transform: translateY(-4px);
  border-color: #FFC107;
  box-shadow: 0 12px 28px rgba(10,27,84,0.12);
}
.bu-hostel-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  color: #FFC107;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.bu-hostel-feature-card h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
}
.bu-hostel-feature-card p {
  font-size: 13.5px;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}
.bu-hostel-banner-cta {
  background: linear-gradient(135deg, #0A1B54 0%, #061D7C 100%);
  border-radius: 14px;
  padding: 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 25px;
  margin-top: 30px;
  flex-wrap: wrap;
}
.bu-hostel-rules-list {
  list-style: none;
  padding: 0;
  margin: 15px 0 0;
}
.bu-hostel-rules-list li {
  padding: 10px 0 10px 30px;
  position: relative;
  font-size: 14px;
  color: #475569;
  border-bottom: 1px solid #F1F5F9;
}
.bu-hostel-rules-list li:last-child { border-bottom: none; }
.bu-hostel-rules-list li i {
  position: absolute;
  left: 0;
  top: 12px;
  color: #10B981;
}
.bu-table-custom {
  width: 100%;
  border-collapse: collapse;
  margin-top: 18px;
  border-radius: 8px;
  overflow: hidden;
}
.bu-table-custom th {
  background: #0A1B54;
  color: #ffffff;
  padding: 14px 18px;
  font-size: 13.5px;
  text-align: left;
}
.bu-table-custom td {
  padding: 13px 18px;
  border-bottom: 1px solid #E2E8F0;
  font-size: 13.5px;
  color: #334155;
  background: #ffffff;
}
.bu-table-custom tr:nth-child(even) td {
  background: #F8FAFC;
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
  $page_title    = 'Hostel &amp; <em>Residential Life</em>';
  $page_subtitle = 'Comfortable, secure, and modern on-campus living facilities for boys and girls with 24x7 power backup, high-speed Wi-Fi, hygienic dining, and dedicated wardens.';
  $page_icon     = 'fa-home';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Hostel & Residential Life', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'hostel'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">A Home Away From Home</span>
        <h2 class="bu-content-h2">On-Campus <em>Student Residences</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/f26b29937f258d4966b0be4de6bea02d.jpg" alt="Bhabha University Student Hostel Residences" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-home"></i> Bhabha University On-Campus Residential Hostel Blocks &amp; Living Quarters
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            Bhabha University provides comprehensive residential accommodations that foster holistic academic progress, personal camaraderie, and peace of mind. Nestled within our lush <strong>32-acre secured campus</strong> in Bhopal, the university offers separate, spacious hostels for male and female scholars with full residential oversight.
          </p>
          <p>
            The hostel community brings together students from diverse states and cultural backgrounds across India and international regions, creating a truly inclusive, cosmopolitan fraternity. Every resident enjoys an environment engineered for focused study, sound rest, and vibrant peer collaboration.
          </p>
        </div>
      </div>

      <!-- Section 2: Key Amenities Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">World-Class Facilities</span>
        <h2 class="bu-content-h2">Hostel <em>Amenities &amp; Services</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-hostel-feature-grid">
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-bed"></i></div>
            <h4>Furnished Rooms</h4>
            <p>Single, double, and triple sharing rooms equipped with ergonomic study tables, cushioned chairs, wardrobes, and quality mattresses.</p>
          </div>
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-cutlery"></i></div>
            <h4>Hygienic Dining Mess</h4>
            <p>Modern steam-powered kitchen serving 4 nutritious, wholesome meals daily (Breakfast, Lunch, Evening Snacks &amp; Dinner) under FSSAI supervision.</p>
          </div>
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-wifi"></i></div>
            <h4>High-Speed Campus Wi-Fi</h4>
            <p>Dedicated fiber-optic internet connectivity available across all hostel wings for academic research and virtual lectures.</p>
          </div>
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-shield"></i></div>
            <h4>24x7 CCTV &amp; Security</h4>
            <p>Round-the-clock trained security guards, biometric turnstile entry, and 100+ high-definition surveillance cameras ensuring total safety.</p>
          </div>
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-bolt"></i></div>
            <h4>Continuous Power &amp; Water</h4>
            <p>Uninterrupted electricity with silent heavy-duty generator backup and multi-stage commercial RO purified drinking water stations.</p>
          </div>
          <div class="bu-hostel-feature-card">
            <div class="bu-hostel-icon"><i class="fa fa-user-md"></i></div>
            <h4>Medical &amp; Emergency Care</h4>
            <p>On-campus health clinic with resident doctors, routine wellness checkups, first-aid suites, and 24x7 ambulance service on standby.</p>
          </div>
        </div>
      </div>

      <!-- Section 3: Room Categories & Details -->
      <div class="bu-content-card">
        <span class="bu-content-label">Accommodation Options</span>
        <h2 class="bu-content-h2">Room Types &amp; <em>Hostel Wings</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>Hostel accommodations are allotted on a first-come, first-served basis at the time of admission enrollment. We offer multiple occupancy configurations suited to student preferences:</p>

          <table class="bu-table-custom">
            <thead>
              <tr>
                <th>Wing / Category</th>
                <th>Occupancy</th>
                <th>Facilities Included</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Boys' Hostel Block A &amp; B</strong></td>
                <td>Double / Triple Sharing</td>
                <td>Attached balcony, study desk, wardrobe, Wi-Fi, laundry facility</td>
                <td><span style="color:#10B981; font-weight:700;"><i class="fa fa-check-circle"></i> Available</span></td>
              </tr>
              <tr>
                <td><strong>Girls' Hostel Block C &amp; D</strong></td>
                <td>Double / Triple Sharing</td>
                <td>Self-contained security perimeter, dedicated common room, Wi-Fi, RO water</td>
                <td><span style="color:#10B981; font-weight:700;"><i class="fa fa-check-circle"></i> Available</span></td>
              </tr>
              <tr>
                <td><strong>Executive AC Rooms</strong></td>
                <td>Single / Double (Air-Conditioned)</td>
                <td>Air conditioning, geyser, individual study unit, attached modern washroom</td>
                <td><span style="color:#D99B00; font-weight:700;"><i class="fa fa-clock-o"></i> Limited Seats</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Section 4: Rules & Code of Conduct -->
      <div class="bu-content-card">
        <span class="bu-content-label">Discipline &amp; Safety</span>
        <h2 class="bu-content-h2">Hostel Code of <em>Conduct &amp; Timings</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>To preserve harmony, focus, and mutual safety, all residential students are required to adhere to the university hostel regulations:</p>
          
          <ul class="bu-hostel-rules-list">
            <li><i class="fa fa-check"></i> <strong>Gate Timings:</strong> Students must report back to their respective hostels by <strong>8:30 PM</strong> (Boys) and <strong>8:00 PM</strong> (Girls).</li>
            <li><i class="fa fa-check"></i> <strong>Zero Tolerance for Ragging:</strong> Ragging in any form is strictly prohibited by law and university charter. Violators face immediate suspension and legal reporting.</li>
            <li><i class="fa fa-check"></i> <strong>Leave &amp; Night-Out Permissions:</strong> Night-outs or leaves require written warden approval along with authenticated parental consent via SMS/Call.</li>
            <li><i class="fa fa-check"></i> <strong>Visitor Protocol:</strong> Parents and guardians may visit resident scholars in designated guest lounges between 10:00 AM and 6:00 PM with proper identity verification.</li>
            <li><i class="fa fa-check"></i> <strong>Substance-Free Zone:</strong> The entire campus and residential blocks are strictly tobacco-free, alcohol-free, and narcotic-free zones.</li>
          </ul>
        </div>

        <!-- Hostel Admission CTA Banner -->
        <div class="bu-hostel-banner-cta">
          <div>
            <h3 style="font-size:20px; font-weight:800; color:#ffffff !important; margin:0 0 6px;"><i class="fa fa-home text-warning mr-2"></i> Need Hostel Admission Guidance?</h3>
            <p style="font-size:13.5px; color:rgba(255,255,255,0.92) !important; margin:0;">Contact the Chief Warden Office for room availability, allotment rules, and fee details.</p>
          </div>
          <div>
            <a href="<?php echo href('enquiry.php'); ?>" class="bu-btn-primary" style="white-space:nowrap;">Apply for Hostel <i class="fa fa-arrow-right"></i></a>
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
