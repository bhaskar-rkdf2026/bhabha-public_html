<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Central Library &amp; Digital Resources - Bhabha University Bhopal</title>
<meta name="description" content="Explore Bhabha University Central Library featuring 50,000+ volumes, 10,000+ e-journals, DELNET, NDLI digital library access, quiet reading halls, and research study booths.">
<meta name="keywords" content="Bhabha University library, central library Bhopal, digital library DELNET, e-journals, engineering pharmacy law books, university reading hall">
<?php include('inc.meta.php'); ?>
<style>
.bu-lib-hero-img-box {
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 25px;
  box-shadow: 0 6px 20px rgba(10,27,84,0.08);
}
.bu-lib-hero-img-box img {
  width: 100%;
  max-height: 380px;
  object-fit: cover;
  display: block;
}
.bu-lib-stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 16px;
  margin: 25px 0 35px;
}
.bu-lib-stat-card {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 22px 16px;
  text-align: center;
  box-shadow: 0 4px 14px rgba(10,27,84,0.04);
  transition: all 0.25s ease;
}
.bu-lib-stat-card:hover {
  transform: translateY(-3px);
  border-color: #FFC107;
  box-shadow: 0 10px 24px rgba(10,27,84,0.1);
}
.bu-lib-stat-icon {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  background: #FFF8E1;
  color: #D99B00;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin-bottom: 12px;
}
.bu-lib-stat-num {
  font-size: 26px;
  font-weight: 800;
  color: #0A1B54;
  line-height: 1.1;
  margin-bottom: 4px;
}
.bu-lib-stat-label {
  font-size: 12px;
  font-weight: 700;
  color: #64748B;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-lib-services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 20px;
}
.bu-lib-service-item {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 20px;
}
.bu-lib-service-item h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  margin: 0 0 8px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-lib-service-item h4 i {
  color: #D99B00;
}
.bu-lib-service-item p {
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
  $page_title    = 'Central Library &amp; <em>Digital Resources</em>';
  $page_subtitle = 'A premier intellectual sanctuary holding 50,000+ volumes, DELNET subscriptions, IEEE/Springer journals, quiet research carrels, and 24x7 online repository access.';
  $page_icon     = 'fa-book';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Campus Life', 'url' => href('campus-life.php')],
    ['label' => 'Library & Digital Resources', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'library'; include('inc.campus-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Section 1: Overview -->
      <div class="bu-content-card">
        <span class="bu-content-label">Center for Knowledge &amp; Research</span>
        <h2 class="bu-content-h2">The Central <em>Library</em></h2>
        <div class="bu-content-divider"></div>

        <!-- Authentic University Facility Image -->
        <div class="bu-page-featured-media">
          <img src="<?php echo URL_UPLOAD; ?>infrastructure/acacb02dda9b764fac164d4397a2accd.jpg" alt="Bhabha University Central Library" loading="lazy">
          <div class="bu-page-featured-caption">
            <i class="fa fa-book"></i> Bhabha University Central Library &amp; Air-Conditioned Digital Reading Hall
          </div>
        </div>

        <div class="bu-content-body">
          <p>
            The <strong>Central Library of Bhabha University</strong> stands as the academic heartbeat of the institution. Spanning multiple spacious, air-conditioned floors, the library caters to scholars, faculty members, and research aspirants across Engineering, Pharmacy, Management, Medicine, Sciences, Education, and Law.
          </p>
          <p>
            Operating with modern automated Library Management Software (KOHA/RFID), students enjoy computerized book searching, quick barcode borrowing, and seamless access to thousands of peer-reviewed digital journals.
          </p>
        </div>

        <!-- Quick Stats Grid -->
        <div class="bu-lib-stats-grid">
          <div class="bu-lib-stat-card">
            <div class="bu-lib-stat-icon"><i class="fa fa-book"></i></div>
            <div class="bu-lib-stat-num">50,000+</div>
            <div class="bu-lib-stat-label">Printed Books</div>
          </div>
          <div class="bu-lib-stat-card">
            <div class="bu-lib-stat-icon"><i class="fa fa-desktop"></i></div>
            <div class="bu-lib-stat-num">10,000+</div>
            <div class="bu-lib-stat-label">E-Journals &amp; E-Books</div>
          </div>
          <div class="bu-lib-stat-card">
            <div class="bu-lib-stat-icon"><i class="fa fa-users"></i></div>
            <div class="bu-lib-stat-num">500+</div>
            <div class="bu-lib-stat-label">Reading Capacity</div>
          </div>
          <div class="bu-lib-stat-card">
            <div class="bu-lib-stat-icon"><i class="fa fa-database"></i></div>
            <div class="bu-lib-stat-num">DELNET</div>
            <div class="bu-lib-stat-label">NDLI Digital Network</div>
          </div>
        </div>
      </div>

      <!-- Section 2: Digital Library & E-Databases -->
      <div class="bu-content-card">
        <span class="bu-content-label">Online Learning Portals</span>
        <h2 class="bu-content-h2">Digital Resources &amp; <em>Databases</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            Bhabha University has partnered with premier national and global digital consortiums, providing students unrestricted on-campus and remote e-access:
          </p>
          <div class="bu-lib-services-grid">
            <div class="bu-lib-service-item">
              <h4><i class="fa fa-globe"></i> DELNET Institutional Access</h4>
              <p>Inter-library loan and document delivery from 7,000+ top Indian and South Asian libraries covering millions of research articles.</p>
            </div>
            <div class="bu-lib-service-item">
              <h4><i class="fa fa-graduation-cap"></i> NDLI (National Digital Library)</h4>
              <p>Single-window access to learning resources from primary school to post-graduate research supported by the Ministry of Education.</p>
            </div>
            <div class="bu-lib-service-item">
              <h4><i class="fa fa-file-text-o"></i> Peer-Reviewed E-Journals</h4>
              <p>Full-text subscriptions to IEEE, Springer, ScienceDirect, Elsevier, PubMed Central, and Bentham Science repositories.</p>
            </div>
            <div class="bu-lib-service-item">
              <h4><i class="fa fa-archive"></i> Exam Papers &amp; Theses Bank</h4>
              <p>Archived collection of university previous year exam question papers, student dissertations, and doctoral theses in digital format.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Section 3: Reading Halls & Facilities -->
      <div class="bu-content-card">
        <span class="bu-content-label">Study Spaces</span>
        <h2 class="bu-content-h2">Reading Halls &amp; <em>Research Booths</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <ul style="padding-left:20px; line-height:1.8; color:#475569;">
            <li><strong>Quiet Study Zone:</strong> Acoustically optimized reading space accommodating 500+ readers simultaneously.</li>
            <li><strong>Digital Media Lab:</strong> 40+ networked multimedia computers dedicated for online literature review and plagiarism analysis.</li>
            <li><strong>Faculty Research Cabins:</strong> Private, soundproof workstations for professors and doctoral research scholars.</li>
            <li><strong>Reprography &amp; Printing:</strong> Low-cost photocopying, color scanning, and document printing facility available within the library.</li>
            <li><strong>Reference Section:</strong> Encyclopedias, dictionaries, Indian Pharmacopoeia, civil codes, and rare historical archives.</li>
          </ul>

          <div style="background:#FFF9E6; border:1px solid #FFE082; border-radius:10px; padding:18px 24px; margin-top:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
            <div>
              <strong style="color:#0A1B54; font-size:15px;"><i class="fa fa-clock-o text-warning mr-2"></i> Library Timings:</strong>
              <span style="color:#334155; font-size:14px; margin-left:8px;">Monday – Saturday: 9:00 AM to 6:00 PM (Extended till 8:00 PM during exams)</span>
            </div>
            <a href="mailto:library@bhabhauniversity.edu.in" class="bu-btn-secondary" style="font-size:12px; padding:8px 16px;"><i class="fa fa-envelope"></i> Contact Librarian</a>
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
