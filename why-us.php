<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Why Choose Bhabha University - Bhabha University Bhopal</title>
<meta name="description" content="Discover why Bhabha University is the right choice — NAAC accreditation, 98% placements, global MoUs, research excellence and a 150-acre green campus.">
<?php include('inc.meta.php');?>
</head>
<body>
<div class="kode_wrapper">
  <?php include('inc.header.php');?>

  <?php
  $page_title    = 'Why Choose <em>Bhabha University</em>';
  $page_subtitle = 'From accreditation to career outcomes — every dimension of the Bhabha experience is designed for your success.';
  $page_icon     = 'fa-star';
  $breadcrumbs   = [
    ['label' => 'Home',  'url' => URL_ROOT],
    ['label' => 'About', 'url' => href('about.php')],
    ['label' => 'Why Choose Bhabha', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-inner-layout">
    <?php $active_page = 'why-us'; include('inc.about-sidebar.php'); ?>

    <main class="bu-inner-content">

      <!-- Intro Card -->
      <div class="bu-content-card">
        <span class="bu-content-label">Our Advantage</span>
        <h2 class="bu-content-h2">Why Choose <em>Bhabha University</em></h2>
        <div class="bu-content-divider"></div>
        <div class="bu-content-body">
          <p>
            <strong>Bhabha University</strong> is a research-intensive university with an outstanding reputation 
            for its learning environments across a broad range of disciplines. Our commitment to our students 
            is evident in our graduates, who are recognised for their capability, quality and success globally.
          </p>
          <p>
            The University is equipped with excellent physical and academic infrastructure, the latest curriculum, 
            and improved teaching methodology. The best talent has been recruited as faculty, and industry 
            interaction and practical exposure make the learning process dynamic and industry-ready.
          </p>
          <p>
            Bhabha University is situated in Bhopal, the beautiful "City of Lakes", the capital of Madhya Pradesh. 
            The ambience and serenity of a world-class infrastructure housed in a clean and green campus creates 
            an ideal environment for holistic growth.
          </p>
        </div>
      </div>

      <!-- Why Grid -->
      <div class="bu-content-card">
        <span class="bu-content-label">Key Differentiators</span>
        <h2 class="bu-content-h2">What sets us <em>apart.</em></h2>
        <div class="bu-content-divider"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:10px;">
          <?php
          $reasons = [
            ['icon'=>'fa-certificate','title'=>'NAAC & UGC Recognised','desc'=>'Accredited by NAAC; UGC recognised under 2(f) & 12(B) — ensuring the credibility and value of every degree awarded.'],
            ['icon'=>'fa-flask','title'=>'Research Excellence','desc'=>'120+ research labs, 250+ patents and 1,200+ publications make Bhabha a hub for academic and applied research.'],
            ['icon'=>'fa-globe','title'=>'Global Collaborations','desc'=>'MoUs with 60+ international universities across 4 continents for student exchanges, joint research, and faculty development.'],
            ['icon'=>'fa-mortar-board','title'=>'Outstanding Placements','desc'=>'98% placement rate with 500+ recruiters visiting campus. Highest package of ₹52 LPA across all schools.'],
            ['icon'=>'fa-building','title'=>'Smart Campus','desc'=>'150-acre Wi-Fi-enabled green campus with smart classrooms, air-conditioned labs, hostels and sports infrastructure.'],
            ['icon'=>'fa-rocket','title'=>'Innovation Ecosystem','desc'=>'Active incubation centre, student startup support, hackathons and industry mentoring programmes.'],
            ['icon'=>'fa-users','title'=>'Expert Faculty','desc'=>'500+ highly qualified faculty members from premier institutions with rich industry and research experience.'],
            ['icon'=>'fa-money','title'=>'Affordable Education','desc'=>'Quality education at competitive fee structures with scholarships, fee waivers, and easy EMI facilities available.'],
            ['icon'=>'fa-shield','title'=>'Safe & Secure Campus','desc'=>'24x7 security with CCTV surveillance, safe hostel accommodation, and dedicated campus police presence.'],
            ['icon'=>'fa-heart','title'=>'Student Welfare','desc'=>'Medical centre, mental health counselling, sports programmes and cultural events for holistic student development.'],
          ];
          foreach($reasons as $r): ?>
          <div style="display:flex;gap:14px;align-items:flex-start;padding:20px;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:8px;transition:all 0.25s;" onmouseover="this.style.background='#fff';this.style.boxShadow='0 8px 24px rgba(6,29,124,0.1)';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#F8FAFC';this.style.boxShadow='none';this.style.transform='none';">
            <div style="width:42px;height:42px;background:rgba(10,27,84,0.08);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="fa <?php echo $r['icon'];?>" style="font-size:17px;color:#0A1B54;"></i>
            </div>
            <div>
              <h4 style="font-size:14px;font-weight:700;color:#061D7C;margin:0 0 6px 0;font-family:'Plus Jakarta Sans',sans-serif;"><?php echo $r['title'];?></h4>
              <p style="font-size:13px;line-height:1.6;color:#6B7280;margin:0;"><?php echo $r['desc'];?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- CTA Card -->
      <div class="bu-content-card" style="background:linear-gradient(135deg,#0A1B54,#061D7C);border-color:#0A1B54;text-align:center;padding:40px 36px;">
        <h3 style="font-family:'Playfair Display',serif;font-size:26px;font-weight:800;color:#fff;margin:0 0 12px 0;">Ready to be part of the <span style="color:#FFC107;">Bhabha family?</span></h3>
        <p style="font-size:15px;color:rgba(255,255,255,0.72);margin:0 0 28px 0;line-height:1.7;">Applications are open for UG, PG, and Doctoral programmes. Secure your seat today.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
          <a href="<?php echo href('enquiry.php');?>" style="background:#FFC107;color:#0A1B54;font-size:13px;font-weight:800;padding:13px 32px;border-radius:4px;text-decoration:none;text-transform:uppercase;letter-spacing:1px;transition:all 0.25s;" onmouseover="this.style.background='#D99B00';" onmouseout="this.style.background='#FFC107';">Apply Now</a>
          <a href="<?php echo href('contact.php');?>" style="background:transparent;color:#fff;font-size:13px;font-weight:800;padding:13px 32px;border-radius:4px;text-decoration:none;text-transform:uppercase;letter-spacing:1px;border:2px solid rgba(255,255,255,0.35);transition:all 0.25s;" onmouseover="this.style.borderColor='#FFC107';this.style.color='#FFC107';" onmouseout="this.style.borderColor='rgba(255,255,255,0.35)';this.style.color='#fff';">Contact Admissions</a>
        </div>
      </div>

    </main>
  </div>

  <?php include('inc.footer.php');?>
</div>
<?php include('inc.footer.js.php');?>
</body>
</html>
