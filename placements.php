<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Training & Placement Cell - Bhabha University Bhopal</title>
<meta name="description" content="Training and Placement Cell at Bhabha University Bhopal — connecting students with top recruiters, corporate partnerships, campus placement statistics, and career guidance.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

/* Head of T&P Card */
.bu-tnp-head-card {
  display: flex;
  gap: 28px;
  align-items: center;
  background: #F8FAFC;
  border: 1px solid #E5E7EB;
  border-radius: 12px;
  padding: 28px;
  margin-bottom: 30px;
  flex-wrap: wrap;
}
.bu-tnp-head-img {
  width: 130px;
  height: 150px;
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(6,29,124,0.12);
  flex-shrink: 0;
}
.bu-tnp-head-info h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 800;
  color: #061D7C;
  margin: 0 0 4px 0;
}
.bu-tnp-head-role {
  font-size: 11.5px;
  font-weight: 800;
  color: #D99B00;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 12px;
  display: block;
}
.bu-tnp-contact-list {
  display: flex;
  flex-direction: column;
  gap: 6px;
  font-size: 13px;
  color: #4B5563;
}
.bu-tnp-contact-list i {
  color: #0A1B54;
  width: 18px;
}

/* Lists styling */
.bu-feature-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 12px;
  list-style: none;
  padding: 0;
  margin: 16px 0 24px 0;
}
.bu-feature-list li {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 13.5px;
  color: #374151;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 2px 8px rgba(6,29,124,0.03);
}
.bu-feature-list li i {
  color: #D99B00;
  font-size: 14px;
}

/* Placed Students Grid */
.bu-placed-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 22px;
  margin-top: 16px;
}
.bu-placed-card {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(6,29,124,0.06);
  transition: all 0.28s ease;
}
.bu-placed-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 16px 32px rgba(6,29,124,0.12);
  border-color: #FFC107;
}
.bu-placed-img-wrap {
  width: 100%;
  height: 200px;
  background: #0A1B54;
  overflow: hidden;
  position: relative;
}
.bu-placed-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.bu-placed-card:hover .bu-placed-img {
  transform: scale(1.06);
}
.bu-placed-body {
  padding: 18px 16px;
}
.bu-placed-name {
  font-family: 'Playfair Display', serif;
  font-size: 17px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 4px 0;
}
.bu-placed-degree {
  font-size: 12px;
  font-weight: 700;
  color: #6B7280;
  margin-bottom: 8px;
}
.bu-placed-company {
  font-size: 13px;
  font-weight: 700;
  color: #0A1B54;
  display: flex;
  align-items: center;
  gap: 6px;
}
.bu-placed-pkg {
  display: inline-block;
  background: rgba(255,193,7,0.18);
  color: #B47F00;
  font-weight: 800;
  font-size: 11px;
  padding: 4px 10px;
  border-radius: 20px;
  margin-top: 8px;
}

/* Recruiters Grid */
.bu-recruiter-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
  gap: 16px;
  margin-top: 16px;
}
.bu-recruiter-item {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  padding: 16px 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 80px;
  box-shadow: 0 2px 10px rgba(6,29,124,0.04);
  transition: all 0.25s ease;
}
.bu-recruiter-item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(6,29,124,0.1);
  border-color: #FFC107;
}
.bu-recruiter-item img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Training & <em>Placement Cell</em>';
  $page_subtitle = 'Bridging academia and industry to secure career opportunities with premier global corporations.';
  $page_icon     = 'fa-briefcase';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Placements', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <!-- Ticker & Counters Banner Component -->
  <?php include('inc.placements.php'); ?>

  <div class="bu-full-width-container">
    <main>

      <!-- Head of Placement Cell -->
      <div class="bu-content-card">
        <span class="bu-content-label">Cell Leadership</span>
        <h2 class="bu-content-h2">Training &amp; <em>Placement Department</em></h2>
        <div class="bu-content-divider"></div>
        
        <div class="bu-tnp-head-card">
          <img src="https://www.bhabhauniversity.edu.in/upload/media/8cc8f94e9069b6237ce5bff460e08994.jpg" 
               alt="Mr. Jitendra Karosia" class="bu-tnp-head-img"
               onerror="this.src='extra-images/about-img.jpg';">
          <div class="bu-tnp-head-info">
            <h3>Mr. Jitendra Karosia</h3>
            <span class="bu-tnp-head-role">Group Head – Training &amp; Placement Department | 17+ Years Experience</span>
            <div class="bu-tnp-contact-list">
              <div><i class="fa fa-envelope"></i> <strong>Email:</strong> headtnp@bhabhauniversity.edu.in / tpo@bhabhauniversity.edu.in</div>
              <div><i class="fa fa-phone"></i> <strong>Mobile:</strong> +91 7566378153 | +91 7470545827</div>
              <div><i class="fa fa-building"></i> <strong>Office:</strong> Training &amp; Placement Office, Bhabha University Campus, Bhopal</div>
            </div>
          </div>
        </div>

        <div class="bu-content-body">
          <p>The Training and Placement Cell of Bhabha University, Bhopal plays a pivotal role in creating career opportunities for Under Graduate and Post Graduate passing out students. Operating round the year, the cell facilitates seamless interactions between corporate entities and graduating engineers, managers, scientists, and healthcare professionals.</p>
          <p>Our ingenious alumnae have established exemplary standards across the corporate landscape through their valuable contributions, ensuring top recruiters regularly return to our campus for recruitment drives.</p>
        </div>
      </div>

      <!-- Objectives & Career Programs -->
      <div class="bu-content-card">
        <span class="bu-content-label">Skill Enhancement</span>
        <h2 class="bu-content-h2">Objectives &amp; <em>Development Programs</em></h2>
        <div class="bu-content-divider"></div>

        <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin-bottom:12px;">Core Objectives of T&amp;P Cell:</h4>
        <ul class="bu-feature-list">
          <li><i class="fa fa-check-circle"></i> Developing student readiness for Corporate Recruitment Processes</li>
          <li><i class="fa fa-check-circle"></i> Technical knowledge enrichment and Soft Skills workshops</li>
          <li><i class="fa fa-check-circle"></i> Guidance for competitive exams (CAT, GATE, GRE, UPSC, IES)</li>
          <li><i class="fa fa-check-circle"></i> Maximum campus &amp; off-campus placement drives with top tier MNCs</li>
        </ul>

        <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin:24px 0 12px 0;">Career Development Programs Offered:</h4>
        <ul class="bu-feature-list">
          <li><i class="fa fa-star"></i> Personality Development Programs (PDP)</li>
          <li><i class="fa fa-star"></i> Professional Communication &amp; Aptitude Training</li>
          <li><i class="fa fa-star"></i> Mock Interview Sessions &amp; Group Discussions</li>
          <li><i class="fa fa-star"></i> Industry-to-Institute Convergence Expert Sessions</li>
          <li><i class="fa fa-star"></i> Public Sector &amp; Govt Competitive Exam Guidance</li>
          <li><i class="fa fa-star"></i> In-plant Training &amp; Industrial Internships</li>
        </ul>
      </div>

      <!-- Placed Students Grid Card -->
      <div class="bu-content-card">
        <span class="bu-content-label">Student Success Stories</span>
        <h2 class="bu-content-h2">Recent <em>Placed Students</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-placed-grid">
          <?php
          $placed_students = [
            ['name'=>'Rachana Singh','degree'=>'MBA','company'=>'UFaber Edutech Pvt. Ltd.','pkg'=>'CTC 6.0 - 8.0 LPA','img'=>'https://www.bhabhauniversity.edu.in/upload/placed/Rachna%20singh1.jpg'],
            ['name'=>'Anjali Maurya','degree'=>'M.Tech (EE)','company'=>'Pentagon Space Pvt. Ltd.','pkg'=>'CTC 3.0 - 12.0 LPA','img'=>'https://www.bhabhauniversity.edu.in/upload/placed/ANJALI%20MAURYA1.jpg'],
            ['name'=>'Shivam Shukla','degree'=>'M.Tech (EE)','company'=>'Infosys Ltd.','pkg'=>'CTC 3.60 LPA','img'=>'https://www.bhabhauniversity.edu.in/upload/placed/Shivam%20Shukla1.jpg'],
            ['name'=>'Deepak Patel','degree'=>'B.Tech (CSE)','company'=>'TCS (Tata Consultancy Services)','pkg'=>'CTC 4.50 LPA','img'=>''],
          ];
          foreach($placed_students as $student): ?>
          <div class="bu-placed-card">
            <div class="bu-placed-img-wrap">
              <?php if(!empty($student['img'])): ?>
                <img src="<?php echo $student['img'];?>" alt="<?php echo $student['name'];?>" class="bu-placed-img" onerror="this.src='extra-images/home-gallery1.jpg';">
              <?php else: ?>
                <div style="display:flex;align-items:center;justify-content:center;height:100%;"><i class="fa fa-user" style="font-size:50px;color:rgba(255,193,7,0.7);"></i></div>
              <?php endif; ?>
            </div>
            <div class="bu-placed-body">
              <h4 class="bu-placed-name"><?php echo $student['name'];?></h4>
              <div class="bu-placed-degree"><?php echo $student['degree'];?></div>
              <div class="bu-placed-company"><i class="fa fa-building-o"></i> <?php echo $student['company'];?></div>
              <span class="bu-placed-pkg"><?php echo $student['pkg'];?></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Major Recruiters Card (Dynamically fetched from DB) -->
      <?php
      $recruiters = $db->get('recruiters');
      if(is_array($recruiters) && count($recruiters) > 0): ?>
      <div class="bu-content-card">
        <span class="bu-content-label">Corporate Partners</span>
        <h2 class="bu-content-h2">Our Major <em>Recruiters</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-recruiter-grid">
          <?php foreach($recruiters as $irecruiters): ?>
          <div class="bu-recruiter-item">
            <img src="<?php echo URL_UPLOAD;?>recruiters/<?php echo $irecruiters['image'];?>" 
                 alt="<?php echo $irecruiters['name'];?>"
                 title="<?php echo $irecruiters['name'];?>"
                 onerror="this.src='extra-images/partner1.png';">
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

    </main>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<?php include('inc.footer.js.php');?>
</body>
</html>
