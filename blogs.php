<?php 
include_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Research, Academic &amp; Tech Blogs - Bhabha University</title>
<meta name="description" content="Explore insights, faculty thought leadership, research breakthroughs, and career guides on emerging technology, pharmaceuticals, management, and student life.">
<?php include('inc.meta.php');?>

<style>
/* =========================================================
   BLOGS & ARTICLES PAGE STYLES
   ========================================================= */
:root {
  --bu-navy: #0A1B54;
  --bu-navy-light: #061D7C;
  --bu-gold: #FFC107;
  --bu-gold-dark: #D99B00;
  --bu-gold-light: #FFF8E1;
  --bu-border: #E2E8F0;
  --bu-text-dark: #1E293B;
  --bu-text-muted: #64748B;
}

.bu-blog-wrap {
  background: #F8FAFC;
  font-family: 'Plus Jakarta Sans', sans-serif;
  padding: 50px 20px 80px;
  clear: both !important;
  display: block !important;
  width: 100% !important;
  box-sizing: border-box !important;
}
.bu-blog-container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Category Filter Bar & Search */
.bu-blog-toolbar {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 12px;
  padding: 14px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 15px;
  margin-bottom: 40px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
  flex-wrap: wrap;
}
.bu-blog-cats {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.bu-cat-btn {
  background: #F1F5F9;
  color: var(--bu-text-dark);
  border: none;
  font-size: 13px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.bu-cat-btn:hover, .bu-cat-btn.active {
  background: var(--bu-navy);
  color: var(--bu-gold);
}

.bu-blog-search {
  position: relative;
  min-width: 250px;
}
.bu-blog-search input {
  width: 100%;
  height: 40px;
  border: 1.5px solid #CBD5E1;
  border-radius: 6px;
  padding: 0 35px 0 14px;
  font-size: 13.5px;
  outline: none;
}
.bu-blog-search input:focus {
  border-color: var(--bu-navy);
}
.bu-blog-search i {
  position: absolute;
  right: 12px;
  top: 13px;
  color: var(--bu-text-muted);
}

/* Featured Blog Hero Card */
.bu-featured-blog {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-left: 5px solid var(--bu-gold);
  border-radius: 16px;
  padding: 35px 40px;
  margin-bottom: 45px;
  box-shadow: 0 10px 30px rgba(10,27,84,0.05);
}
.bu-feat-meta {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 12px;
  flex-wrap: wrap;
}
.bu-badge-cat {
  background: #EFF6FF;
  color: #1D4ED8;
  font-size: 11.5px;
  font-weight: 800;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 4px;
  letter-spacing: 0.5px;
}
.bu-blog-date, .bu-blog-readtime {
  font-size: 12.5px;
  color: var(--bu-text-muted);
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 5px;
}
.bu-featured-blog h2 {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0 0 12px;
  line-height: 1.35;
}
.bu-featured-blog p {
  font-size: 14.5px;
  color: var(--bu-text-muted);
  line-height: 1.7;
  margin-bottom: 20px;
}
.bu-feat-author-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid #F1F5F9;
  padding-top: 16px;
  flex-wrap: wrap;
  gap: 15px;
}
.bu-author-info {
  display: flex;
  align-items: center;
  gap: 12px;
}
.bu-author-avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: var(--bu-navy);
  color: var(--bu-gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 16px;
}
.bu-author-name {
  font-size: 14px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 0;
}
.bu-author-role {
  font-size: 12px;
  color: var(--bu-text-muted);
  margin: 0;
}

/* Blog Posts Grid */
.bu-blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 30px;
  margin-bottom: 55px;
}
.bu-post-card {
  background: #ffffff;
  border: 1px solid var(--bu-border);
  border-radius: 14px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.25s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}
.bu-post-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(10,27,84,0.08);
  border-color: #CBD5E1;
}
.bu-post-top {
  margin-bottom: 15px;
}
.bu-post-title {
  font-family: 'Playfair Display', serif;
  font-size: 19px;
  font-weight: 800;
  color: var(--bu-navy);
  margin: 10px 0 10px;
  line-height: 1.4;
}
.bu-post-excerpt {
  font-size: 13.5px;
  color: var(--bu-text-muted);
  line-height: 1.6;
  margin-bottom: 18px;
}
.bu-post-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 15px;
}
.bu-post-tags span {
  font-size: 11px;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  color: #64748B;
  padding: 2px 8px;
  border-radius: 4px;
  font-weight: 600;
}
.bu-post-footer {
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-post-author-small {
  font-size: 12.5px;
  font-weight: 700;
  color: var(--bu-navy);
}
.bu-post-btn-read {
  color: var(--bu-navy);
  font-size: 13px;
  font-weight: 800;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}
.bu-post-btn-read:hover {
  color: var(--bu-gold-dark);
}

/* Modal for Reading Article */
.bu-modal-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(10,27,84,0.7);
  z-index: 999999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
.bu-modal-overlay.active {
  display: flex;
}
.bu-modal-box {
  background: #ffffff;
  max-width: 800px;
  width: 100%;
  max-height: 85vh;
  border-radius: 16px;
  padding: 35px 40px;
  overflow-y: auto;
  position: relative;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
}
.bu-modal-close {
  position: absolute;
  top: 20px; right: 20px;
  font-size: 24px;
  background: #F1F5F9;
  border: none;
  border-radius: 50%;
  width: 36px; height: 36px;
  cursor: pointer;
  color: #64748B;
}

@media (max-width: 768px) {
  .bu-blog-toolbar { flex-direction: column; align-items: stretch; }
  .bu-featured-blog { padding: 25px 20px; }
  .bu-modal-box { padding: 25px 20px; }
}
</style>
</head>

<body>
<div class="kode_wrapper"> 
  <!-- HEADER START -->
  <?php include('inc.header.php');?>
  <!-- HEADER END -->

  <!-- INNER HERO BANNER -->
  <?php
  $page_title    = 'Research, Academic <em>&amp; Tech Blogs</em>';
  $page_subtitle = 'Insights, faculty thought leadership, research breakthroughs, and career guides on emerging technology, pharmaceuticals, management, and campus life.';
  $page_icon     = 'fa-rss';
  $breadcrumbs   = [
    ['label' => 'Home', 'url' => URL_ROOT],
    ['label' => 'Publications', 'url' => href('research.php#media-publications')],
    ['label' => 'Blogs & Insights', 'url' => '#'],
  ];
  include('inc.page-banner.php');
  ?>

  <div class="bu-blog-wrap">
    <div class="bu-blog-container">

      <!-- 1. CATEGORY FILTER & SEARCH TOOLBAR -->
      <div class="bu-blog-toolbar">
        <div class="bu-blog-cats">
          <button class="bu-cat-btn active" onclick="filterBlogCategory('all', this)">All Insights</button>
          <button class="bu-cat-btn" onclick="filterBlogCategory('tech', this)">AI &amp; Tech</button>
          <button class="bu-cat-btn" onclick="filterBlogCategory('pharmacy', this)">Pharmacy &amp; Health</button>
          <button class="bu-cat-btn" onclick="filterBlogCategory('research', this)">Patents &amp; Research</button>
          <button class="bu-cat-btn" onclick="filterBlogCategory('career', this)">Career &amp; Placements</button>
        </div>

        <div class="bu-blog-search">
          <input type="text" id="blogSearchInp" placeholder="Search articles..." onkeyup="searchBlogArticles(this.value)">
          <i class="fa fa-search"></i>
        </div>
      </div>

      <!-- 2. FEATURED HERO ARTICLE -->
      <div class="bu-featured-blog" data-cat="research pharmacy">
        <div class="bu-feat-meta">
          <span class="bu-badge-cat" style="background:#FEF3C7;color:#92400E;">FEATURED INSIGHT</span>
          <span class="bu-badge-cat">Pharmacy &amp; Innovation</span>
          <span class="bu-blog-date"><i class="fa fa-calendar-o"></i> 15 August 2026</span>
          <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 5 min read</span>
        </div>

        <h2>Commercializing Academic Research: How Bhabha University Developed 14 Proprietary Herbal &amp; Pharmacy Formulations</h2>
        <p>
          Translating laboratory discoveries into commercially viable healthcare products is the hallmark of modern university research. At Bhabha University, our dedicated team of pharmaceutical researchers, faculty innovators, and student scholars engineered 14 breakthrough formulations—from advanced antimicrobial ointments to herbal immunomodulators. Here is a look at the methodology, regulatory clearances, and the patent roadmap that made it possible.
        </p>

        <div class="bu-feat-author-bar">
          <div class="bu-author-info">
            <div class="bu-author-avatar">SV</div>
            <div>
              <div class="bu-author-name">Dr. S. K. Verma</div>
              <div class="bu-author-role">Dean, Research &amp; Pharmaceutical Sciences &bull; Bhabha University</div>
            </div>
          </div>
          <a href="<?php echo href('research.php#launched-products'); ?>" class="bu-post-btn-read" style="font-size:14px;color:var(--bu-navy);">
            View 14 Formulations <i class="fa fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <!-- 3. ARTICLES GRID -->
      <div class="bu-blog-grid" id="blogGrid">

        <!-- Article 1 -->
        <div class="bu-post-card" data-cat="tech">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">AI &amp; Tech</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 4 min read</span>
            </div>
            <h3 class="bu-post-title">Architecting Resilient Cloud Infrastructure with Edge AI</h3>
            <p class="bu-post-excerpt">
              How distributed edge computing and lightweight machine learning models are transforming real-time data processing in IoT sensors and smart manufacturing.
            </p>
            <div class="bu-post-tags">
              <span>#CloudComputing</span>
              <span>#EdgeAI</span>
              <span>#IoT</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> Prof. Amit Sen</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Architecting Resilient Cloud Infrastructure with Edge AI', 'Prof. Amit Sen (Dept. of Computer Science & Engineering)', 'Edge computing brings computation and data storage closer to the sources of data. This improves response times and saves bandwidth. When integrated with lightweight Edge AI models, devices can perform real-time inferences without continuous cloud connectivity, critical in autonomous vehicles, smart farming, and hospital telemedicine equipment.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

        <!-- Article 2 -->
        <div class="bu-post-card" data-cat="pharmacy">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">Pharmacy &amp; Health</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 6 min read</span>
            </div>
            <h3 class="bu-post-title">Next-Generation Targeted Drug Delivery via Lipid Nanoparticles</h3>
            <p class="bu-post-excerpt">
              A comprehensive exploration of lipid nanoparticle systems in oncology and mRNA therapeutics, minimizing systemic side effects and improving bioavailability.
            </p>
            <div class="bu-post-tags">
              <span>#Nanomedicine</span>
              <span>#DrugDelivery</span>
              <span>#PharmaResearch</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> Dr. Manisha Joshi</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Next-Generation Targeted Drug Delivery via Lipid Nanoparticles', 'Dr. Manisha Joshi (Faculty of Pharmacy)', 'Targeted drug delivery represents one of the most promising frontiers in modern pharmacotherapy. By encapsulating therapeutic agents in engineered lipid nanoparticles (LNPs), drugs can bypass biological barriers and release active ingredients specifically at diseased tissue sites.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

        <!-- Article 3 -->
        <div class="bu-post-card" data-cat="career">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">Career &amp; Placements</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 5 min read</span>
            </div>
            <h3 class="bu-post-title">Mastering Technical &amp; HR Interviews in Top Tier Companies</h3>
            <p class="bu-post-excerpt">
              Essential strategies for engineering and management students preparing for campus placement rounds with IT majors, banking giants, and MNCs.
            </p>
            <div class="bu-post-tags">
              <span>#PlacementTips</span>
              <span>#CareerGrowth</span>
              <span>#InterviewSkills</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> T&amp;P Cell Advisory</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Mastering Technical & HR Interviews in Top Tier Companies', 'Training & Placement Directorate', 'Cracking campus placements requires a balance of core domain competence, problem-solving dexterity, and soft skills communication. Focus on Data Structures, fundamental business case studies, active listening, and showcasing live project contributions during technical rounds.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

        <!-- Article 4 -->
        <div class="bu-post-card" data-cat="research">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">Patents &amp; Research</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 7 min read</span>
            </div>
            <h3 class="bu-post-title">Navigating the Patent Filing Process for Student Innovators</h3>
            <p class="bu-post-excerpt">
              Step-by-step guidance on prior-art search, patent drafting, provisional applications, and institutional support provided by Bhabha University IPR Cell.
            </p>
            <div class="bu-post-tags">
              <span>#Patents</span>
              <span>#IPR</span>
              <span>#Innovation</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> IPR Cell Coordinator</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Navigating the Patent Filing Process for Student Innovators', 'IPR & Incubation Cell', 'Protecting intellectual property early in the development lifecycle gives inventors a significant competitive edge. Bhabha University provides comprehensive legal and financial assistance for eligible student and faculty inventions via our IPR Facilitation Cell.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

        <!-- Article 5 -->
        <div class="bu-post-card" data-cat="tech">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">AI &amp; Tech</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 4 min read</span>
            </div>
            <h3 class="bu-post-title">Sustainable Energy Harvesting for Smart Cities &amp; Campus IoT</h3>
            <p class="bu-post-excerpt">
              Examining low-power micro-generators, piezoelectric pavements, and solar rooftop integration tested on the Bhabha University green campus.
            </p>
            <div class="bu-post-tags">
              <span>#CleanTech</span>
              <span>#GreenEnergy</span>
              <span>#SmartCampus</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> Dept. of Electrical Engg</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Sustainable Energy Harvesting for Smart Cities & Campus IoT', 'Faculty of Engineering & Technology', 'Transitioning towards carbon-neutral smart campuses requires innovative energy harvesting techniques. By deploying localized solar trackers and micro-wind installations, institutions can sustainably power smart streetlights and sensor networks.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

        <!-- Article 6 -->
        <div class="bu-post-card" data-cat="career">
          <div class="bu-post-top">
            <div class="bu-feat-meta">
              <span class="bu-badge-cat">Career &amp; Placements</span>
              <span class="bu-blog-readtime"><i class="fa fa-clock-o"></i> 3 min read</span>
            </div>
            <h3 class="bu-post-title">Effective Habits for Academic Excellence &amp; Mental Well-being</h3>
            <p class="bu-post-excerpt">
              Practical psychological tools, active recall learning methods, and stress resilience practices for university scholars during exam seasons.
            </p>
            <div class="bu-post-tags">
              <span>#StudentLife</span>
              <span>#StudyTips</span>
              <span>#MentalHealth</span>
            </div>
          </div>
          <div class="bu-post-footer">
            <span class="bu-post-author-small"><i class="fa fa-user-circle-o"></i> Student Counseling Cell</span>
            <a href="javascript:void(0)" onclick="openBlogModal('Effective Habits for Academic Excellence & Mental Well-being', 'Student Welfare & Counseling Cell', 'Academic success is directly linked with cognitive balance and physical health. Implementing spaced repetition, scheduled digital detox intervals, and participating in extracurricular sports significantly enhances memory retention and reduces anxiety.')" class="bu-post-btn-read">
              Read Article <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- ARTICLE MODAL -->
  <div class="bu-modal-overlay" id="articleModal">
    <div class="bu-modal-box">
      <button class="bu-modal-close" onclick="closeBlogModal()">&times;</button>
      <div id="modalContent">
        <h2 id="modalTitle" style="font-family:'Playfair Display',serif;color:var(--bu-navy);margin-bottom:10px;"></h2>
        <div id="modalAuthor" style="font-size:13px;color:var(--bu-gold-dark);font-weight:700;margin-bottom:20px;"></div>
        <div id="modalBody" style="font-size:14.5px;color:var(--bu-text-dark);line-height:1.75;"></div>
      </div>
    </div>
  </div>

  <!-- FOOTER START -->
  <?php include('inc.footer.php');?>
  <!-- FOOTER END -->
</div>

<!-- Scripts -->
<?php include('inc.footer.js.php');?>
<script>
function filterBlogCategory(cat, btn) {
  document.querySelectorAll('.bu-cat-btn').forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');

  var cards = document.querySelectorAll('.bu-post-card');
  cards.forEach(function(card) {
    if(cat === 'all') {
      card.style.display = 'flex';
    } else {
      var cardCats = card.getAttribute('data-cat') || '';
      if(cardCats.indexOf(cat) !== -1) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    }
  });
}

function searchBlogArticles(query) {
  var q = query.toLowerCase();
  var cards = document.querySelectorAll('.bu-post-card');
  cards.forEach(function(card) {
    var text = card.innerText.toLowerCase();
    if(text.indexOf(q) !== -1) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function openBlogModal(title, author, text) {
  document.getElementById('modalTitle').innerText = title;
  document.getElementById('modalAuthor').innerText = author;
  document.getElementById('modalBody').innerHTML = '<p>' + text + '</p><p style="margin-top:20px;color:#64748B;font-size:13.5px;">For full research whitepapers, extended datasets, or to contribute an article to the Bhabha University Research & Tech Blog, please write to <a href="mailto:research@bhabhauniversity.edu.in" style="color:var(--bu-navy);font-weight:bold;">research@bhabhauniversity.edu.in</a>.</p>';
  document.getElementById('articleModal').classList.add('active');
}

function closeBlogModal() {
  document.getElementById('articleModal').classList.remove('active');
}

document.getElementById('articleModal').addEventListener('click', function(e) {
  if(e.target === this) closeBlogModal();
});
</script>
</body>
</html>
