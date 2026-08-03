<?php
// Bhabha University - Redesigned Modern Header Section
?>
<header class="bu-header-wrapper">
  <!-- 1. Top Utility Bar -->
  <div class="bu-topbar">
    <div class="bu-topbar-container">
      <div class="bu-topbar-left">
        <ul class="bu-topbar-links">
          <li><a href="<?php echo href('hbkportal.php'); ?>">Student Portal</a></li>
          <li><a href="<?php echo href('hbkportal.php'); ?>">Faculty Portal</a></li>
          <li><a href="<?php echo href('hbkportal.php'); ?>"><span class="bu-blink">ERP Login</span></a></li>
          <li><a href="<?php echo href('nirf.php'); ?>">Verification</a></li>
          <li><a href="<?php echo href('page.php','id=25'); ?>">NAD</a></li>
          <li><a href="<?php echo href('hbkportal.php'); ?>">OAP Login</a></li>
          <?php if(!empty($aryForm['webmail_link'])): ?>
            <li><a href="<?php echo $aryForm['webmail_link']?>" target="_blank">Web Mail</a></li>
          <?php endif; ?>
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
        <img src="<?php echo URL_IMG;?>Bhabha university logo.png" alt="Bhabha University Emblem" class="bu-brand-logo" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
        <div class="bu-brand-text">
          <span class="bu-brand-title">Bhabha University</span>
          <span class="bu-brand-subtitle">Bhopal &bull; Since 2004</span>
        </div>
      </a>

      <!-- Mobile Menu Toggle Button -->
      <button class="bu-mobile-toggle" id="buMobileToggle" aria-label="Toggle Navigation">
        <i class="fa fa-bars"></i>
      </button>
      <!-- Mobile Nav Backdrop -->
      <div id="buNavBackdrop" class="bu-nav-backdrop"></div>

      <!-- Main Navigation Menu -->
      <nav class="bu-navbar" id="buNavbar">
        <ul class="bu-nav-menu">
          <li class="bu-nav-item">
            <a href="<?php echo href('index.php'); ?>" class="bu-nav-link">Home</a>
          </li>

          <!-- About Dropdown -->
          <li class="bu-nav-item">
            <a href="<?php echo href('about.php');?>" class="bu-nav-link">About <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href('about.php');?>">About Us</a></li>
              <li><a href="<?php echo href("page.php","id=20");?>">University Overview</a></li>
              <li><a href="<?php echo href("mission-vision.php");?>">Vision &amp; Mission</a></li>
              <li><a href="<?php echo href("infrastructure.php")?>">Campus & Infrastructure</a></li>
              <li><a href="<?php echo href('values.php'); ?>">Core Values</a></li>
              <li><a href="<?php echo href('leadership.php'); ?>">Administration &amp; Leadership</a></li>
              <li><a href="<?php echo href('why-us.php'); ?>">Why Choose Bhabha University</a></li>
              <li><a href="<?php echo href("awards.php")?>">Awards & Achievements</a></li>
              <li><a href="<?php echo href("advisory.php")?>">Cells & Committees</a></li>
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
            <ul class="bu-dropdown">
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

          <!-- Academics Dropdown -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Academics <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href("faculties.php")?>">Faculties & Institutes</a></li>
              <li><a href="<?php echo href("syllabus.php")?>">Scheme & Syllabus</a></li>
              <li><a href="<?php echo href("academic.php")?>">Academic Calendar</a></li>
              <li><a href="<?php echo href("page.php","id=9");?>">MOU & Collaborations</a></li>
              <li><a href="<?php echo href("page.php","id=8");?>">Online Video Resources</a></li>
            </ul>
          </li>

          <!-- Examinations Dropdown -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Examinations <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href("page.php","id=16");?>">Online Examination Process</a></li>
              <li><a href="<?php echo href("examination.php")?>">Examination Notices</a></li>
              <li><a href="<?php echo href("time-table.php")?>">Exam Time Table</a></li>
              <li><a href="<?php echo href('examination.php'); ?>">Examination Results</a></li>
              <li><a href="https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx" target="_blank">Student Login</a></li>
              <li><a href="<?php echo href('BUQuestionPapers_demo.php'); ?>">Previous Question Papers</a></li>
            </ul>
          </li>

          <!-- Research Dropdown -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Research <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a target="_blank" href="<?php echo URL_UPLOAD;?>research/overview.pdf">Research Overview</a></li>
              <li><a href="<?php echo href("page.php","id=3");?>">Research at a Glance</a></li>
              <li><a target="_blank" href="<?php echo href("page.php","id=14");?>">PhD Scholars List</a></li>
              <li><a href="<?php echo href("page.php","id=15");?>">Research Journals</a></li>
              <li><a href="<?php echo href("page.php","id=4");?>">Funding Agencies</a></li>
              <li><a href="<?php echo href("page.php","id=5");?>">Publications</a></li>
              <li><a href="<?php echo href("page.php","id=10");?>">Conferences & Seminars</a></li>
              <li><a href="<?php echo href("page.php","id=11");?>">Industrial Visits</a></li>
            </ul>
          </li>

          <!-- Admissions Dropdown -->
          <li class="bu-nav-item">
            <a href="#" class="bu-nav-link">Admissions <i class="fa fa-angle-down"></i></a>
            <ul class="bu-dropdown">
              <li><a href="<?php echo href("enquiry.php")?>">Admission Enquiry & Eligibility</a></li>
              <li><a href="<?php echo href("page.php","id=12");?>">Admission Process</a></li>
              <li><a href="<?php echo href("course.php")?>">Courses, Intake & Eligibility</a></li>
              <li><a href="<?php echo href("fees.php")?>">Fee Structure</a></li>
              <li><a href="<?php echo href("page.php","id=1");?>">University Bank Account Details</a></li>
              <li><a href="<?php echo href("online-admission.php")?>">Online Registration Form</a></li>
              <li><a href="<?php echo href("page.php","id=13");?>">Scholarships</a></li>
              <li><a href="<?php echo href("page.php","id=24");?>">Admission Helpline Numbers</a></li>
              <li><a href="<?php echo href("page.php","id=6");?>">Vocational Courses - Media</a></li>
              <li><a href="<?php echo href("page.php","id=7");?>">Vocational Courses - Hotel Mgmt</a></li>
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

    </div>
  </div>

  <!-- 3. Dynamic News Ticker -->
  <div class="bu-ticker-wrapper">
    <div class="bu-ticker-label">
      <i class="fa fa-bullhorn"></i> Latest News
    </div>
    <div class="bu-ticker-content">
      <ul class="bu-ticker-list" id="buNewsTicker">
        <?php
        $db->where('is_news', 1);
        $news_and_announcement = $db->get('news_and_announcement');
        if(is_array($news_and_announcement) && count($news_and_announcement) > 0) {
          foreach($news_and_announcement as $inews_and_announcement) { ?>
            <li>
              <a href="<?php echo href("announcements.php","id=".$inews_and_announcement['id']."");?>">
                <?php echo $inews_and_announcement['title']?>
              </a>
            </li>
          <?php }
        } else { ?>
          <li><a href="<?php echo href("news.php");?>">Welcome to Bhabha University - Admissions Open 2026</a></li>
        <?php } ?>
      </ul>
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

    /* ---- Mobile Toggle ---- */
    var mobileToggle = document.getElementById('buMobileToggle');
    var navbar       = document.getElementById('buNavbar');
    var backdrop     = document.getElementById('buNavBackdrop');

    function openMenu() {
      if (navbar) navbar.classList.add('mobile-open');
      if (backdrop) backdrop.classList.add('active');
      if (mobileToggle) mobileToggle.innerHTML = '<i class="fa fa-times"></i>';
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      if (navbar) navbar.classList.remove('mobile-open');
      if (backdrop) backdrop.classList.remove('active');
      if (mobileToggle) mobileToggle.innerHTML = '<i class="fa fa-bars"></i>';
      document.body.style.overflow = '';
    }

    if (mobileToggle) {
      mobileToggle.addEventListener('click', function () {
        navbar && navbar.classList.contains('mobile-open') ? closeMenu() : openMenu();
      });
    }
    if (backdrop) {
      backdrop.addEventListener('click', closeMenu);
    }

    /* ---- Mobile Accordion Dropdowns ---- */
    function setupMobileAccordion() {
      var navItems = document.querySelectorAll('.bu-nav-item');
      navItems.forEach(function (item) {
        var link     = item.querySelector('.bu-nav-link');
        var dropdown = item.querySelector('.bu-dropdown');
        if (!dropdown || !link) return;

        // Remove old listeners by cloning
        var newLink = link.cloneNode(true);
        link.parentNode.replaceChild(newLink, link);

        if (window.innerWidth <= 991) {
          newLink.addEventListener('click', function (e) {
            e.preventDefault();
            var isOpen = item.classList.contains('open');
            // Close all siblings
            navItems.forEach(function (i) { i.classList.remove('open'); });
            if (!isOpen) item.classList.add('open');
          });
        }
      });
    }

    setupMobileAccordion();

    // Re-run on resize
    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (window.innerWidth > 991) closeMenu();
        setupMobileAccordion();
      }, 200);
    });
  });
})();
</script>
