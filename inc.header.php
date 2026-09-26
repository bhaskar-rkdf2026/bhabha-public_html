<?php
// Bhabha University - Redesigned Modern Header Section
?>
<header class="bu-header-wrapper">
  <!-- 1. Top Utility Bar -->
  <div class="bu-topbar">
    <div class="bu-topbar-container">
      <div class="bu-topbar-left">
        <ul class="bu-topbar-links">
          <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank">Student Portal</a></li>
          <li><a href="https://bhabha.accsofterp.com/Accsoft/Login.aspx" target="_blank">Faculty Portal</a></li>
          <li><a href="<?php echo href('alumni.php'); ?>">Alumni Portal</a></li>
          <li><a href="<?php echo href('iqac.php'); ?>">IQAC</a></li>
          <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank"><span class="bu-blink">ERP Login</span></a></li>
          <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank">Verification</a></li>
          <li><a href="<?php echo href('page.php','id=25'); ?>">NAD</a></li>
          <li><a href="https://bhabha.accsofterp.com/OAP/AdminLogin.aspx" target="_blank">OAP Login</a></li>
          <li><a href="https://webmail.bhabhauniversity.edu.in/" target="_blank">Web Mail</a></li>
          <li><a href="<?php echo href('nirf.php'); ?>">NIRF</a></li>
          <li><a href="<?php echo href("news.php")?>">News</a></li>
          <li><a href="<?php echo href("placements.php")?>">T & P Cell</a></li>
          <li><a href="<?php echo href("notice.php")?>">Notices</a></li>
        </ul>
      </div>

      <div class="bu-topbar-right">
        <?php if(!empty($aryForm['phone_one'])): ?>
          <a href="tel:<?php echo $aryForm['phone_one']; ?>" class="bu-topbar-phone">
            <i class="fa fa-phone"></i> <?php echo $aryForm['phone_one']; ?>
          </a>
        <?php else: ?>
          <a href="tel:+917554936800" class="bu-topbar-phone">
            <i class="fa fa-phone"></i> +91 755 4936800
          </a>
        <?php endif; ?>
        <a href="<?php echo href('enquiry.php'); ?>" class="bu-btn-top-gold"><span class="bu-blink">Apply Now</span></a>
      </div>
    </div>
  </div>

  <!-- 2. Main Header & Navigation Bar -->
  <div class="bu-main-header">
    <div class="bu-header-container">
      
      <!-- Brand Logo -->
      <a href="<?php echo URL_ROOT;?>" class="bu-brand">
        <img src="<?php echo URL_IMG;?>bhabha-university-logo-hd.png?v=20260926" alt="Bhabha University Emblem" class="bu-brand-logo" width="65" height="65" fetchpriority="high" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
        <div class="bu-brand-text">
          <span class="bu-brand-name-1">Bhabha</span>
          <span class="bu-brand-name-2">University</span>
        </div>
      </a>

      <!-- Mobile Nav Backdrop -->
      <div id="buNavBackdrop" class="bu-nav-backdrop"></div>

      <!-- Main Navigation Menu -->
      <nav class="bu-navbar" id="buNavbar">
        <div class="bu-mobile-drawer-head">
          <div class="bu-drawer-brand">
            <img src="<?php echo URL_IMG;?>bhabha-university-logo-hd.png?v=20260926" alt="Logo" class="bu-drawer-logo" width="38" height="38" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
            <span>Bhabha University</span>
          </div>
          <button type="button" class="bu-drawer-close" id="buDrawerCloseBtn" aria-label="Close Menu">&times;</button>
        </div>
        <ul class="bu-nav-menu">
          <li class="bu-nav-item">
            <a href="<?php echo href('index.php'); ?>" class="bu-nav-link">Home</a>
          </li>

          <!-- About Dropdown -->
          <li class="bu-nav-item">
            <a href="<?php echo href('about.php');?>" class="bu-nav-link">About <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown bu-dropdown-2col">
              <li><a href="<?php echo href('about.php');?>">About Us</a></li>
              <li><a href="<?php echo href("university.php");?>">University Overview</a></li>
              <li><a href="<?php echo href("mission-vision.php");?>">Vision &amp; Mission</a></li>
              <li><a href="<?php echo href("infrastructure.php")?>">Campus & Infrastructure</a></li>
              <li><a href="<?php echo href('values.php'); ?>">Core Values</a></li>
              <li><a href="<?php echo href('leadership.php'); ?>">Administration &amp; Leadership</a></li>
              <li><a href="<?php echo href('why-us.php'); ?>">Why Choose Bhabha University</a></li>
              <li><a href="<?php echo href("awards.php")?>">Awards & Achievements</a></li>
              <li><a href="<?php echo href("advisory.php")?>">Cells & Committees</a></li>
              <li><a href="<?php echo href('iqac.php'); ?>">IQAC (Internal Quality Assurance)</a></li>
              <li><a href="<?php echo href("approvals.php")?>">Approvals & Recognitions</a></li>
              <li><a href="<?php echo URL_UPLOAD; ?>media/ffe90b0c7e9e55b00b1207aee3ce3971.pdf" target="_blank">Sponsoring Detail</a></li>
              <li><a href="<?php echo href('auditreport.php'); ?>">Finance Officer &gt; Audit Report</a></li>
              <li><a href="<?php echo URL_UPLOAD; ?>media/671d06f0fea73f07576a994c4343281c.pdf" target="_blank">Annual Report 2024</a></li>
              <li><a href="<?php echo href('ugc-proforma.php'); ?>">UGC Proforma</a></li>
            </ul>
          </li>

          <!-- Schools / Institutes Dynamic Dropdown -->
          <li class="bu-nav-item">
            <a href="<?php echo href("institutes.php")?>" class="bu-nav-link">Schools <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown bu-dropdown-2col">
              <?php
              $institutes = $db->get('department');
              if(is_array($institutes) && count($institutes) > 0) {
                foreach($institutes as $iinstitutes) {
                  echo '<li><a href="'.href("department.php","id=".$iinstitutes['id']."").'">'.$iinstitutes['title'].'</a></li>';
                }
              } else {
                echo '<li><a href="'.href("institutes.php").'">All Institutes</a></li>';
              }
              ?>
            </ul>
          </li>

          <!-- Academics + Examinations Dropdown (2-Column) -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Academics <i class="fa fa-angle-down"></i></a>
            <div class="bu-dropdown bu-acad-dropdown">

              <!-- Column 1: Academics -->
              <div class="bu-acad-col">
                <div class="bu-acad-col-heading"><i class="fa fa-book"></i> Academics</div>
                <ul>
                  <li><a href="<?php echo href("faculties.php")?>">Faculties &amp; Institutes</a></li>
                  <li><a href="<?php echo href("syllabus.php")?>">Scheme &amp; Syllabus</a></li>
                  <li><a href="<?php echo href("academic.php")?>">Academic Calendar</a></li>
                  <li><a href="<?php echo href("page.php","id=9");?>">MOU &amp; Collaborations</a></li>
                  <li><a href="<?php echo href("page.php","id=8");?>">Online Video Resources</a></li>
                </ul>
              </div>

              <!-- Column 2: Examinations -->
              <div class="bu-acad-col">
                <div class="bu-acad-col-heading"><i class="fa fa-pencil-square-o"></i> Examinations</div>
                <ul>
                  <li><a href="<?php echo href("page.php","id=16");?>">Online Examination Process</a></li>
                  <li><a href="<?php echo href("examination.php")?>">Examination Notices</a></li>
                  <li><a href="<?php echo href("time-table.php")?>">Exam Time Table</a></li>
                  <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank">Examination Results</a></li>
                  <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank">Student Login</a></li>
                  <li><a href="<?php echo href('BUQuestionPapers_demo.php'); ?>">Previous Question Papers</a></li>
                </ul>
              </div>

            </div>
          </li>


          <!-- Research Dropdown (2-Column: Academic Research + New Innovations & Labs) -->
          <li class="bu-nav-item">
            <a href="<?php echo href('research.php');?>" class="bu-nav-link">Research <i class="fa fa-angle-down"></i></a>
            <div class="bu-dropdown bu-res-dropdown">
              
              <!-- Column 1: Original Academic Research Tabs -->
              <div class="bu-res-col">
                <div class="bu-res-col-heading">
                  <i class="fa fa-graduation-cap"></i> Academic Research
                </div>
                <ul>
                  <li><a target="_blank" href="<?php echo URL_UPLOAD;?>research/overview.pdf">Overview</a></li>
                  <li><a href="<?php echo href("page.php","id=3");?>">Research At Glance</a></li>
                  <li><a target="_blank" href="<?php echo href("page.php","id=14");?>">PhD Student (List)</a></li>
                  <li><a href="<?php echo href("page.php","id=15");?>">Journal</a></li>
                  <li><a href="<?php echo href("page.php","id=4");?>">Funding Agency</a></li>
                  <li><a href="<?php echo href("page.php","id=5");?>">Publication</a></li>
                  <li><a href="<?php echo href("page.php","id=10");?>">Conference /Seminar</a></li>
                  <li><a href="<?php echo href("page.php","id=11");?>">Industrial Visits</a></li>
                </ul>
              </div>

              <!-- Column 2: New Commercial Innovations & Labs -->
              <div class="bu-res-col">
                <div class="bu-res-col-heading">
                  <i class="fa fa-flask"></i> Innovations &amp; Labs
                </div>
                <ul>
                  <li><a href="<?php echo href("research.php");?>"><strong>Research &amp; Innovation Portal</strong></a></li>
                  <li><a href="<?php echo href("research.php#pharmacy-labs");?>">Pharmacy Research Labs</a></li>
                  <li><a href="<?php echo href("research.php#launched-products");?>">Commercial Products (15 Aug)</a></li>
                  <li><a href="<?php echo href("research.php#incubation-edc");?>">Incubation Centre &amp; EDC</a></li>
                  <li><a href="<?php echo href("research.php#research-domains");?>">Research Pillars &amp; Domains</a></li>
                  <li><a href="<?php echo href("research.php#patents-publications");?>">Patents &amp; Research Papers</a></li>
                  <li><a href="<?php echo href("research.php#media-publications");?>">E-Newsletter &amp; Blogs</a></li>
                </ul>
              </div>

            </div>
          </li>

          <!-- Admissions Dropdown -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Admissions <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown bu-dropdown-2col">
              <li><a href="<?php echo href("enquiry.php")?>">Admission Enquiry & Eligibility</a></li>
              <li><a href="<?php echo href("admission-process.php");?>">Admission Process</a></li>
              <li><a href="<?php echo href("course.php")?>">Courses, Intake & Eligibility</a></li>
              <li><a href="<?php echo href("fees.php")?>">Fee Structure</a></li>
              <li><a href="<?php echo href("page.php","id=1");?>">University Bank Account Details</a></li>
              <li><a href="<?php echo href("online-admission.php")?>">Online Registration Form</a></li>
              <li><a href="<?php echo href("scholarship.php");?>">Scholarships</a></li>
              <li><a href="<?php echo href("page.php","id=24");?>">Admission Helpline Numbers</a></li>
              <li><a href="<?php echo href("page.php","id=6");?>">Vocational Courses - Media</a></li>
              <li><a href="<?php echo href("hotel.php");?>">Vocational Courses - Hotel Mgmt</a></li>
            </ul>
          </li>

          <!-- Placements Dropdown -->
          <li class="bu-nav-item">
            <a href="<?php echo href("placements.php");?>" class="bu-nav-link">Placements <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href("placements.php");?>">Training & Placement Cell</a></li>
              <li><a href="<?php echo URL_UPLOAD; ?>media/9018b4daec2ac10a45dfd539260998f5.pdf" target="_blank">Recent Placement List</a></li>
              <li><a href="<?php echo URL_UPLOAD; ?>media/f27e76c6a5c21432282101555c225b35.jpg" target="_blank">Our Major Recruiters</a></li>
            </ul>
          </li>

          <!-- News & Media Dropdown -->
          <li class="bu-nav-item">
            <a href="<?php echo href("news.php")?>" class="bu-nav-link">News &amp; Media <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href("news.php")?>"><i class="fa fa-newspaper-o"></i> Latest News &amp; Events</a></li>
              <li><a href="<?php echo href("newsletter.php")?>"><i class="fa fa-envelope"></i> E-Newsletter</a></li>
              <li><a href="<?php echo href("magazine.php")?>"><i class="fa fa-book"></i> University Magazine</a></li>
              <li><a href="<?php echo href("blogs.php")?>"><i class="fa fa-rss"></i> Research &amp; Tech Blogs</a></li>
              <li><a href="<?php echo href("gallery.php")?>"><i class="fa fa-picture-o"></i> Photo Gallery</a></li>
              <li><a href="<?php echo href("notice.php")?>"><i class="fa fa-bullhorn"></i> Official Notices</a></li>
            </ul>
          </li>

          <!-- Contact Link -->
          <li class="bu-nav-item">
            <a href="<?php echo href("contact.php")?>" class="bu-nav-link">Contact</a>
          </li>
        </ul>
      </nav>

      <!-- Action Buttons (Search & Apply) -->
      <div class="bu-header-actions">
        <button class="bu-search-btn" id="buSearchOpen" title="Search website">
          <i class="fa fa-search"></i>
        </button>
        <a href="<?php echo href('enquiry.php'); ?>" class="bu-btn-navy">Apply</a>
      </div>

      <!-- Mobile Menu Toggle Button (extreme right corner) -->
      <button class="bu-mobile-toggle" id="buMobileToggle" aria-label="Toggle Navigation">
        <span class="bu-toggle-line bu-line-blue"></span>
        <span class="bu-toggle-line bu-line-orange"></span>
        <span class="bu-toggle-line bu-line-red"></span>
      </button>

    </div>
  </div>

</header>

<!-- Search Overlay Modal -->
<div class="bu-search-overlay" id="buSearchOverlay">
  <button class="bu-search-close" id="buSearchClose">&times;</button>
  <div class="bu-search-box">
    <form action="<?php echo href('news.php'); ?>" method="get">
      <input type="text" name="s" class="bu-search-input" placeholder="Type to search..." autocomplete="off" autofocus>
      <button type="submit" class="bu-search-submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<!-- Header Scripts -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {

    /* ---- Search Overlay ---- */
    var searchOpen    = document.getElementById('buSearchOpen');
    var searchClose   = document.getElementById('buSearchClose');
    var searchOverlay = document.getElementById('buSearchOverlay');

    if (searchOpen && searchOverlay) {
      searchOpen.addEventListener('click', function () {
        searchOverlay.classList.add('active');
        var inp = searchOverlay.querySelector('.bu-search-input');
        if (inp) inp.focus();
      });
    }
    if (searchClose && searchOverlay) {
      searchClose.addEventListener('click', function () {
        searchOverlay.classList.remove('active');
      });
    }
    if (searchOverlay) {
      searchOverlay.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') searchOverlay.classList.remove('active');
      });
    }

    /* ---- Mobile Toggle & Drawer ---- */
    var mobileToggle = document.getElementById('buMobileToggle');
    var drawerClose  = document.getElementById('buDrawerCloseBtn');
    var navbar       = document.getElementById('buNavbar');
    var backdrop     = document.getElementById('buNavBackdrop');

    function openMenu() {
      if (navbar) navbar.classList.add('mobile-open');
      if (backdrop) backdrop.classList.add('active');
      if (mobileToggle) mobileToggle.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      if (navbar) navbar.classList.remove('mobile-open');
      if (backdrop) backdrop.classList.remove('active');
      if (mobileToggle) mobileToggle.classList.remove('active');
      document.body.style.overflow = '';
    }

    if (mobileToggle) {
      mobileToggle.addEventListener('click', function (e) {
        e.preventDefault();
        navbar && navbar.classList.contains('mobile-open') ? closeMenu() : openMenu();
      });
    }
    if (drawerClose) {
      drawerClose.addEventListener('click', function (e) {
        e.preventDefault();
        closeMenu();
      });
    }
    if (backdrop) {
      backdrop.addEventListener('click', closeMenu);
    }

    /* ---- Mobile Accordion Dropdowns (Event Delegation) ---- */
    if (navbar) {
      navbar.addEventListener('click', function (e) {
        if (window.innerWidth > 991) return;
        var link = e.target.closest('.bu-nav-link');
        if (!link) return;
        var item = link.closest('.bu-nav-item');
        if (!item) return;
        var dropdown = item.querySelector('.bu-dropdown');
        if (dropdown) {
          e.preventDefault();
          e.stopPropagation();
          var isOpen = item.classList.contains('open');
          document.querySelectorAll('.bu-nav-item.open').forEach(function (openItem) {
            if (openItem !== item) openItem.classList.remove('open');
          });
          item.classList.toggle('open', !isOpen);
        }
      });
    }

    // Auto close menu on resize up
    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (window.innerWidth > 991) closeMenu();
      }, 200);
    });

    /* ---- Sticky Header on Scroll ---- */
    var headerWrap = document.querySelector('.bu-header-wrapper');
    if (headerWrap) {
      var isStickyActive = false;
      var handleStickyHeader = function () {
        var scrollY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        var threshold = window.innerWidth <= 991 ? 10 : 45;
        if (scrollY > threshold) {
          if (!isStickyActive) {
            headerWrap.classList.add('bu-is-sticky');
            isStickyActive = true;
          }
        } else {
          if (isStickyActive) {
            headerWrap.classList.remove('bu-is-sticky');
            isStickyActive = false;
          }
        }
      };
      window.addEventListener('scroll', handleStickyHeader, { passive: true });
      window.addEventListener('load', handleStickyHeader);
      handleStickyHeader();
    }
  });
})();
</script>
