<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Scholarship Programs - Bhabha University Bhopal</title>
<meta name="description" content="Explore state and national scholarship opportunities at Bhabha University Bhopal — MP Post Matric Scholarship, Mukhyamantri Medhavi Vidyarthi Yojana, OBC, SC, ST and Merit scholarships.">
<?php include('inc.meta.php');?>
<style>
.bu-full-width-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 50px 20px 80px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  box-sizing: border-box;
}

.bu-scholar-card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 22px;
  margin: 20px 0;
}
.bu-scholar-item {
  background: #F8FAFC;
  border: 1px solid #E5E7EB;
  border-radius: 10px;
  padding: 24px;
  border-left: 4px solid #FFC107;
  transition: all 0.25s ease;
}
.bu-scholar-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgba(6,29,124,0.08);
  background: #ffffff;
  border-color: #0A1B54;
  border-left-color: #FFC107;
}
.bu-scholar-item h4 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  font-weight: 700;
  color: #061D7C;
  margin: 0 0 10px 0;
}
.bu-scholar-item p {
  font-size: 13.5px;
  line-height: 1.6;
  color: #4B5563;
  margin: 0;
}

.bu-doc-checklist {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 12px;
  list-style: none;
  padding: 0;
  margin: 16px 0;
}
.bu-doc-checklist li {
  background: #ffffff;
  border: 1px solid #E5E7EB;
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 13.5px;
  color: #374151;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-doc-checklist li i {
  color: #D99B00;
}
</style>
</head>

<body>
<div class="kode_wrapper">
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <?php
  $page_title    = 'Scholarships &amp; <em>Financial Aid</em>';
  $page_subtitle = 'Supporting meritorious and underprivileged students through government and institutional scholarship schemes.';
  $page_icon     = 'fa-graduation-cap';
  $breadcrumbs   = [
    ['label' => 'Home',       'url' => URL_ROOT],
    ['label' => 'Admissions', 'url' => '#'],
    ['label' => 'Scholarship', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-full-width-container">
    <main>

      <div class="bu-content-card">
        <span class="bu-content-label">Financial Assistance</span>
        <h2 class="bu-content-h2">MP State &amp; <em>National Scholarships</em></h2>
        <div class="bu-content-divider"></div>

        <div class="bu-content-body">
          <p>The Madhya Pradesh Scholarship Program provides substantial financial assistance to eligible students pursuing Higher Secondary to Post Graduation programs. Every academic year, thousands of students at Bhabha University benefit from government schemes reserved for SC, ST, OBC, Minorities, and General Economically Weaker Section (EWS) candidates.</p>
        </div>

        <!-- Scholarship Schemes Cards Grid -->
        <div class="bu-scholar-card-grid">
          <div class="bu-scholar-item">
            <h4>1. Mukhyamantri Medhavi Vidyarthi Yojana (MMVY)</h4>
            <p>For students securing 75%+ in MP Board or 85%+ in CBSE/ICSE 12th. Annual family income limit: INR 6 Lakhs. Applicable to Engineering (JEE Mains under 50,000 rank), Medical (NEET), and Law (CLAT) students.</p>
          </div>

          <div class="bu-scholar-item">
            <h4>2. Post Matric Scholarship for OBC Students</h4>
            <p>For OBC category students. 100% scholarship for family income under ₹75,000/yr and 50% scholarship for family income up to ₹1,00,000/yr.</p>
          </div>

          <div class="bu-scholar-item">
            <h4>3. Mukhya Mantri Jan Kalyan Yojana (MMJKY)</h4>
            <p>For children of unorganized workmen registered under the MP Department of Labour, pursuing UG, PG, Polytechnic or Diploma courses.</p>
          </div>

          <div class="bu-scholar-item">
            <h4>4. Post Matric Scholarship for SC Students</h4>
            <p>Financial support for Scheduled Caste (SC) category candidates pursuing post-secondary higher education and professional degrees.</p>
          </div>

          <div class="bu-scholar-item">
            <h4>5. Post Matric Scholarship for ST Students</h4>
            <p>For Scheduled Tribe (ST) students. 100% scholarship for family income under ₹2.50 Lakhs/yr and 50% for income between ₹2.50 Lakhs to ₹6.00 Lakhs/yr.</p>
          </div>

          <div class="bu-scholar-item">
            <h4>6. Other State Scholarships (UP, Bihar, National Portal)</h4>
            <p>Students from states outside MP (e.g. Bihar Post Matric, UP Scholarship, National Scholarship Portal - NSP) can apply through their respective state portals.</p>
          </div>
        </div>

        <h4 style="font-size:16px;font-weight:700;color:#061D7C;margin:30px 0 12px 0;">Mandatory Documents Required for Application:</h4>
        <ul class="bu-doc-checklist">
          <li><i class="fa fa-file-text-o"></i> Caste Certificate (Attested Photocopy)</li>
          <li><i class="fa fa-file-text-o"></i> MP Domicile Certificate</li>
          <li><i class="fa fa-file-text-o"></i> Income Certificate of Parents</li>
          <li><i class="fa fa-id-card-o"></i> Aadhar Card &amp; Samagra ID</li>
          <li><i class="fa fa-graduation-cap"></i> 10th &amp; 12th Marksheet Photocopy</li>
          <li><i class="fa fa-picture-o"></i> Passport Size Photographs</li>
        </ul>
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
