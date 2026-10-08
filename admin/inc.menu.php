<?php
/**
 * inc.menu.php
 * Bhabha University Admin Sidebar - Frontend 1-to-1 Section Reorganization
 */
$currPage    = basename($_SERVER['PHP_SELF']);
$secParam    = isset($_GET['section']) ? trim($_GET['section']) : '';
$pageParam   = isset($_GET['page']) ? trim($_GET['page']) : '';
$pageId      = isset($_GET['id']) ? intval($_GET['id']) : 0;
$actionParam = isset($_GET['action']) ? trim($_GET['action']) : '';

if (!function_exists('isMenuLinkActive')) {
    function isMenuLinkActive($link) {
        $curr = basename($_SERVER['PHP_SELF']);
        $currentUri = $curr;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $currentUri .= '?' . $_SERVER['QUERY_STRING'];
        }
        
        // Exact match
        if ($currentUri === $link) {
            return 'active';
        }
        
        $curParts = parse_url($currentUri);
        $lnkParts = parse_url($link);
        
        if (($curParts['path'] ?? '') !== ($lnkParts['path'] ?? '')) {
            return '';
        }
        
        // If target link has no query parameters
        if (empty($lnkParts['query'])) {
            // e.g. campus_life.php without query or page=hub
            if (empty($_SERVER['QUERY_STRING']) || (isset($_GET['page']) && $_GET['page'] === 'hub')) {
                return 'active';
            }
            return '';
        }
        
        parse_str($curParts['query'] ?? '', $curQ);
        parse_str($lnkParts['query'] ?? '', $lnkQ);
        
        // Compare required query parameters
        foreach ($lnkQ as $k => $v) {
            if (!isset($curQ[$k]) || (string)$curQ[$k] !== (string)$v) {
                return '';
            }
        }
        return 'active';
    }
}

if (!function_exists('menuLi')) {
    function menuLi($url, $icon, $label, $extraClass = '', $extraStyle = '') {
        $act = isMenuLinkActive($url);
        $cls = trim($act . ' ' . $extraClass);
        $styleAttr = !empty($extraStyle) ? ' style="' . $extraStyle . '"' : '';
        $clsAttr = !empty($cls) ? ' class="' . $cls . '"' : '';
        $aCls = !empty($act) ? ' class="active"' : '';
        return '<li' . $clsAttr . '><a href="' . $url . '"' . $aCls . $styleAttr . '><i class="' . $icon . '"></i> ' . $label . '</a></li>' . PHP_EOL;
    }
}

// -----------------------------------------------------------------------------
// SECTION ACTIVE DETECTORS (Matches Base Files + Sub-Pages + Specific Pages.php IDs)
// -----------------------------------------------------------------------------
$isAboutActive = ($secParam === 'about') || 
    in_array($currPage, ['university_overview.php', 'leadership.php', 'approvals.php', 'advisory.php', 'awards.php', 'affiliate.php', 'reports_accreditation.php']) || 
    ($currPage === 'infrastructure.php' && $secParam !== 'campus_life');

$isSchoolsActive = ($secParam === 'schools') || 
    in_array($currPage, ['program.php', 'institute.php', 'department.php', 'sub_department.php', 'course.php', 'branch.php']);

$isAcadActive = ($secParam === 'academics') || 
    in_array($currPage, ['academic.php', 'syllabus.php', 'timetable.php']) ||
    ($currPage === 'pages.php' && in_array($pageId, [16, 9, 8]));

$isAdmActive = ($secParam === 'admissions') || 
    ($currPage === 'fees.php') ||
    ($currPage === 'pages.php' && in_array($pageId, [1, 24, 2]));

$isResActive = ($secParam === 'research') || 
    ($currPage === 'research.php') ||
    ($currPage === 'pages.php' && in_array($pageId, [3, 4, 5, 15, 14, 10, 11]));

$isPlaceActive = ($secParam === 'placements') || 
    in_array($currPage, ['recruiters.php', 'alumni_achievers.php', 'testimonial.php', 'jobs.php']);

$isNewsActive = ($secParam === 'news') || 
    in_array($currPage, ['news.php', 'notice.php', 'announcements.php', 'popup_notices.php', 'media.php', 'gallery.php', 'blogs.php']) ||
    ($currPage === 'events.php');

$isCampusLifeActive = ($secParam === 'campus_life') || 
    ($currPage === 'campus_life.php');

$isStudentActive = ($secParam === 'student') || 
    in_array($currPage, ['policies.php', 'student_publications.php']) ||
    ($currPage === 'pages.php' && in_array($pageId, [25, 22, 23]));

$isFormsActive = in_array($currPage, ['all_enquiries.php', 'enquiry.php', 'admission.php', 'inquiry.php', 'grievance.php', 'alumni.php']);

$isStandalonePagesActive = ($currPage === 'pages.php' && !in_array($pageId, [16, 9, 8, 1, 24, 2, 3, 4, 5, 15, 14, 10, 11, 25, 22, 23]));
?>
<div class="left side-menu">
  <div class="slimscroll-menu" id="remove-scroll">
    <div id="sidebar-menu">
      <ul class="metismenu" id="side-menu">

        <!-- =================== DASHBOARD & OVERVIEW =================== -->
        <li class="bu-menu-category"><span>Navigation & Hub</span></li>
        <li class="<?php echo ($currPage === 'dashboard.php') ? 'active' : ''; ?>">
          <a href="dashboard.php" class="waves-effect <?php echo ($currPage === 'dashboard.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-view-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'section_hub.php' && empty($secParam)) ? 'active' : ''; ?>">
          <a href="section_hub.php" class="waves-effect <?php echo ($currPage === 'section_hub.php' && empty($secParam)) ? 'active' : ''; ?>" style="color: #FFC107 !important; font-weight: 700;">
            <i class="mdi mdi-apps" style="color: #FFC107 !important;"></i> <span>Page Hub (Directory)</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'homepage_sections.php') ? 'active' : ''; ?>">
          <a href="homepage_sections.php" class="waves-effect <?php echo ($currPage === 'homepage_sections.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-home"></i> <span>Home Sections</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'popup_notices.php') ? 'active' : ''; ?>">
          <a href="popup_notices.php" class="waves-effect <?php echo ($currPage === 'popup_notices.php') ? 'active' : ''; ?>" style="color: #FFC107 !important; font-weight: 600;">
            <i class="mdi mdi-bell-ring-outline" style="color: #FFC107 !important;"></i> <span>Popup & Results</span>
          </a>
        </li>

        <!-- =================== 1. ABOUT UNIVERSITY =================== -->
        <li class="bu-menu-category"><span>Frontend Sections</span></li>
        <li class="<?php echo $isAboutActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAboutActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isAboutActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-bank"></i> <span>About University</span>
          </a>
          <ul class="submenu <?php echo $isAboutActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isAboutActive ? 'true' : 'false'; ?>">
            <?php 
              echo menuLi('section_hub.php?section=about', 'mdi mdi-view-grid-outline', '★ About Section Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('university_overview.php', 'mdi mdi-circle-outline', 'University Overview');
              echo menuLi('leadership.php', 'mdi mdi-circle-outline', 'Leadership & Admin');
              echo menuLi('infrastructure.php', 'mdi mdi-circle-outline', 'Campus Infrastructure');
              echo menuLi('approvals.php', 'mdi mdi-circle-outline', 'Approvals & Recognitions');
              echo menuLi('advisory.php', 'mdi mdi-circle-outline', 'Cells & Committees');
              echo menuLi('awards.php', 'mdi mdi-circle-outline', 'Awards & Achievements');
              echo menuLi('affiliate.php', 'mdi mdi-circle-outline', 'Affiliations');
              echo menuLi('reports_accreditation.php', 'mdi mdi-circle-outline', 'Reports & Accreditations');
            ?>
          </ul>
        </li>

        <!-- =================== 2. SCHOOLS & INSTITUTES =================== -->
        <li class="<?php echo $isSchoolsActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isSchoolsActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isSchoolsActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-school"></i> <span>Institutes</span>
          </a>
          <ul class="submenu <?php echo $isSchoolsActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isSchoolsActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=schools', 'mdi mdi-view-grid-outline', '★ Institutes Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('program.php', 'mdi mdi-circle-outline', 'Program Categories');
              echo menuLi('institute.php', 'mdi mdi-circle-outline', 'Faculties & Institutes');
              echo menuLi('department.php', 'mdi mdi-circle-outline', 'Departments');
              echo menuLi('sub_department.php', 'mdi mdi-circle-outline', 'Sub Departments');
              echo menuLi('course.php', 'mdi mdi-circle-outline', 'Courses & Intake');
              echo menuLi('branch.php', 'mdi mdi-circle-outline', 'Branches & Specializations');
            ?>
          </ul>
        </li>

        <!-- =================== 3. ACADEMICS & EXAMS =================== -->
        <li class="<?php echo $isAcadActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAcadActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isAcadActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-book-open-page-variant"></i> <span>Academics & Exams</span>
          </a>
          <ul class="submenu <?php echo $isAcadActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isAcadActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=academics', 'mdi mdi-view-grid-outline', '★ Academics Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('academic.php', 'mdi mdi-circle-outline', 'Academic Calendar');
              echo menuLi('syllabus.php', 'mdi mdi-circle-outline', 'Scheme & Syllabus');
              echo menuLi('timetable.php', 'mdi mdi-circle-outline', 'Exam Time Table');
              echo menuLi('pages.php?action=edit&id=16', 'mdi mdi-circle-outline', 'Online Exam Guidelines');
              echo menuLi('pages.php?action=edit&id=9', 'mdi mdi-circle-outline', 'MOUs & Collaborations');
              echo menuLi('pages.php?action=edit&id=8', 'mdi mdi-circle-outline', 'Video Resources');
            ?>
          </ul>
        </li>

        <!-- =================== 4. ADMISSIONS & FEES =================== -->
        <li class="<?php echo $isAdmActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAdmActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isAdmActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-account-plus"></i> <span>Admissions & Fees</span>
          </a>
          <ul class="submenu <?php echo $isAdmActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isAdmActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=admissions', 'mdi mdi-view-grid-outline', '★ Admissions Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('fees.php', 'mdi mdi-circle-outline', 'Fee Structure');
              echo menuLi('pages.php?action=edit&id=1', 'mdi mdi-circle-outline', 'Bank Account Details');
              echo menuLi('pages.php?action=edit&id=24', 'mdi mdi-circle-outline', 'Helpline Numbers');
              echo menuLi('pages.php?action=edit&id=2', 'mdi mdi-circle-outline', 'Online Fee Payment');
            ?>
          </ul>
        </li>

        <!-- =================== 5. RESEARCH & INNOVATION =================== -->
        <li class="<?php echo $isResActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isResActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isResActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-flask"></i> <span>Research & Labs</span>
          </a>
          <ul class="submenu <?php echo $isResActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isResActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=research', 'mdi mdi-view-grid-outline', '★ Research Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('research.php', 'mdi mdi-circle-outline', 'Research Portal & Labs');
              echo menuLi('pages.php?action=edit&id=3', 'mdi mdi-circle-outline', 'Research at a Glance');
              echo menuLi('pages.php?action=edit&id=4', 'mdi mdi-circle-outline', 'Funding Agencies');
              echo menuLi('pages.php?action=edit&id=5', 'mdi mdi-circle-outline', 'Publications');
              echo menuLi('pages.php?action=edit&id=15', 'mdi mdi-circle-outline', 'Journals');
              echo menuLi('pages.php?action=edit&id=14', 'mdi mdi-circle-outline', 'PhD Scholars List');
              echo menuLi('pages.php?action=edit&id=10', 'mdi mdi-circle-outline', 'Conferences & Seminars');
              echo menuLi('pages.php?action=edit&id=11', 'mdi mdi-circle-outline', 'Industrial Visits');
              echo menuLi('blogs.php', 'mdi mdi-circle-outline', 'Research & Tech Blogs');
            ?>
          </ul>
        </li>

        <!-- =================== 6. PLACEMENTS & CAREERS =================== -->
        <li class="<?php echo $isPlaceActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isPlaceActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isPlaceActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-briefcase-check"></i> <span>Placements & Careers</span>
          </a>
          <ul class="submenu <?php echo $isPlaceActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isPlaceActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=placements', 'mdi mdi-view-grid-outline', '★ Placements Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('recruiters.php', 'mdi mdi-circle-outline', 'Placement Recruiters');
              echo menuLi('alumni_achievers.php', 'mdi mdi-circle-outline', 'Star Alumni Achievers');
              echo menuLi('testimonial.php', 'mdi mdi-circle-outline', 'Student Testimonials');
              echo menuLi('jobs.php', 'mdi mdi-circle-outline', 'Career & Job Openings');
            ?>
          </ul>
        </li>

        <!-- =================== 7. NEWS, MEDIA & EVENTS =================== -->
        <li class="<?php echo $isNewsActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isNewsActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isNewsActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-bullhorn"></i> <span>News & Media</span>
          </a>
          <ul class="submenu <?php echo $isNewsActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isNewsActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=news', 'mdi mdi-view-grid-outline', '★ News & Media Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('popup_notices.php', 'mdi mdi-bell-ring-outline', '★ Popup & Results', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('blogs.php', 'mdi mdi-circle-outline', 'Research & Tech Blogs');
              echo menuLi('news.php', 'mdi mdi-circle-outline', 'News Updates');
              echo menuLi('notice.php', 'mdi mdi-circle-outline', 'Official Notices');
              echo menuLi('announcements.php', 'mdi mdi-circle-outline', 'Ticker Announcements');
              echo menuLi('events.php', 'mdi mdi-circle-outline', 'Events & Fests');
              echo menuLi('media.php', 'mdi mdi-circle-outline', 'Media Coverage');
              echo menuLi('gallery.php', 'mdi mdi-circle-outline', 'Photo Gallery');
            ?>
          </ul>
        </li>

        <!-- =================== CAMPUS LIFE =================== -->
        <li class="<?php echo $isCampusLifeActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isCampusLifeActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isCampusLifeActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-compass-outline"></i> <span>Campus Life</span>
          </a>
          <ul class="submenu <?php echo $isCampusLifeActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isCampusLifeActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('campus_life.php', 'mdi mdi-view-grid-outline', '★ Campus Life Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('campus_life.php?page=overview', 'mdi mdi-compass', 'Campus Life Overview');
              echo menuLi('campus_life.php?page=clubs', 'mdi mdi-account-group', 'Clubs &amp; Societies');
              echo menuLi('campus_life.php?page=hostel', 'mdi mdi-home-city-outline', 'Hostel &amp; Residences');
              echo menuLi('campus_life.php?page=cafeteria', 'mdi mdi-silverware-fork-knife', 'Cafeteria &amp; Food');
              echo menuLi('campus_life.php?page=transportation', 'mdi mdi-bus', 'Transport &amp; Routes');
              echo menuLi('campus_life.php?page=library', 'mdi mdi-book-open-page-variant', 'Central Library');
              echo menuLi('campus_life.php?page=it-labs', 'mdi mdi-laptop', 'IT &amp; Computer Labs');
              echo menuLi('campus_life.php?page=health-wellness', 'mdi mdi-heart-pulse', 'Health &amp; Wellness');
              echo menuLi('campus_life.php?page=sports', 'mdi mdi-soccer', 'Sports &amp; Fitness');
              echo menuLi('campus_life.php?page=community-service', 'mdi mdi-hand-heart', 'Community Service &amp; NSS');
              echo menuLi('campus_life.php?page=entrepreneurship', 'mdi mdi-rocket-launch-outline', 'Entrepreneurship Cell');
              echo menuLi('campus_life.php?page=student-safety', 'mdi mdi-shield-check-outline', 'Student Safety &amp; Support');
              echo menuLi('campus_life.php?page=student-media', 'mdi mdi-bullhorn-outline', 'Student Media &amp; FM');
              echo menuLi('infrastructure.php', 'mdi mdi-city', 'Infrastructure Module');
              echo menuLi('events.php', 'mdi mdi-calendar-star', 'Events &amp; Fests Module');
              echo menuLi('gallery.php', 'mdi mdi-image-multiple-outline', 'Campus Gallery');
            ?>
          </ul>
        </li>

        <!-- =================== 8. STUDENT CORNER & GOVERNANCE =================== -->
        <li class="<?php echo $isStudentActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isStudentActive ? 'active' : ''; ?>" aria-expanded="<?php echo $isStudentActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-account-group"></i> <span>Student Corner</span>
          </a>
          <ul class="submenu <?php echo $isStudentActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isStudentActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('section_hub.php?section=student', 'mdi mdi-view-grid-outline', '★ Student Corner Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('policies.php', 'mdi mdi-circle-outline', 'Legal & Policies');
              echo menuLi('student_publications.php', 'mdi mdi-circle-outline', 'Student Publications');
              echo menuLi('pages.php?action=edit&id=25', 'mdi mdi-circle-outline', 'NAD Depository');
              echo menuLi('pages.php?action=edit&id=22', 'mdi mdi-circle-outline', 'Solar Plant & Green');
              echo menuLi('pages.php?action=edit&id=23', 'mdi mdi-circle-outline', 'Radio Popcorn 90.4 FM');
            ?>
          </ul>
        </li>

        <!-- =================== 9. ALL FORMS & ENQUIRIES =================== -->
        <li class="bu-menu-category"><span>Lead & Form Submissions</span></li>
        <li class="<?php echo $isFormsActive ? 'active' : ''; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isFormsActive ? 'active' : ''; ?>" style="color:#FFC107 !important; font-weight:700;" aria-expanded="<?php echo $isFormsActive ? 'true' : 'false'; ?>">
            <i class="mdi mdi-clipboard-text" style="color:#FFC107 !important;"></i> <span>All Forms & Enquiries</span>
          </a>
          <ul class="submenu <?php echo $isFormsActive ? 'collapse in' : 'collapse'; ?>" aria-expanded="<?php echo $isFormsActive ? 'true' : 'false'; ?>">
            <?php
              echo menuLi('all_enquiries.php', 'mdi mdi-view-dashboard', '★ All Enquiries Hub', '', 'color:#FFC107 !important; font-weight:700;');
              echo menuLi('enquiry.php', 'mdi mdi-circle-outline', 'Course Enquiries');
              echo menuLi('admission.php', 'mdi mdi-circle-outline', 'Online Applications');
              echo menuLi('inquiry.php', 'mdi mdi-circle-outline', 'Contact Inquiries');
              echo menuLi('grievance.php', 'mdi mdi-circle-outline', 'Grievance Redressal');
              echo menuLi('alumni.php', 'mdi mdi-circle-outline', 'Alumni Registrations');
            ?>
          </ul>
        </li>

        <!-- =================== 10. SYSTEM & SEO SETTINGS =================== -->
        <li class="bu-menu-category"><span>System & Settings</span></li>
        <li class="<?php echo ($currPage === 'header_settings.php') ? 'active' : ''; ?>">
          <a href="header_settings.php" class="waves-effect <?php echo ($currPage === 'header_settings.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-page-layout-header" style="color: #FFC107 !important;"></i> <span>Header &amp; Navigation</span>
          </a>
        </li>
        <li class="<?php echo $isStandalonePagesActive ? 'active' : ''; ?>">
          <a href="pages.php" class="waves-effect <?php echo $isStandalonePagesActive ? 'active' : ''; ?>">
            <i class="mdi mdi-file-document"></i> <span>All Website Pages</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'seo.php') ? 'active' : ''; ?>">
          <a href="seo.php" class="waves-effect <?php echo ($currPage === 'seo.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-earth" style="color: #FFC107 !important;"></i> <span>SEO & Meta Manager</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'settings.php') ? 'active' : ''; ?>">
          <a href="settings.php" class="waves-effect <?php echo ($currPage === 'settings.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-settings"></i> <span>General Settings</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'links.php') ? 'active' : ''; ?>">
          <a href="links.php" class="waves-effect <?php echo ($currPage === 'links.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-link-variant"></i> <span>Quick Links</span>
          </a>
        </li>
        <li>
          <a href="logout.php" class="waves-effect" style="color: #F87171 !important;">
            <i class="mdi mdi-power" style="color: #F87171 !important;"></i> <span>Logout</span>
          </a>
        </li>

      </ul>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
