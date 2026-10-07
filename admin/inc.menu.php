<?php
/**
 * inc.menu.php
 * Bhabha University Admin Sidebar - Frontend 1-to-1 Section Reorganization
 */
$currPage = basename($_SERVER['PHP_SELF']);
$secParam = isset($_GET['section']) ? $_GET['section'] : '';

function isSubActive($pages, $curr, $targetSec = '', $sec = '') {
    if (!empty($targetSec) && $targetSec === $sec && $curr === 'section_hub.php') {
        return 'active';
    }
    if (is_array($pages) && in_array($curr, $pages)) {
        return 'active';
    }
    return '';
}
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
        <?php 
          $aboutPages = ['university_overview.php', 'leadership.php', 'infrastructure.php', 'approvals.php', 'advisory.php', 'awards.php', 'affiliate.php', 'reports_accreditation.php'];
          $isAboutActive = isSubActive($aboutPages, $currPage, 'about', $secParam);
        ?>
        <li class="<?php echo $isAboutActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAboutActive; ?>">
            <i class="mdi mdi-bank"></i> <span>About University</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=about" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ About Section Hub</a></li>
            <li><a href="university_overview.php"><i class="mdi mdi-circle-outline"></i> University Overview</a></li>
            <li><a href="leadership.php"><i class="mdi mdi-circle-outline"></i> Leadership & Admin</a></li>
            <li><a href="infrastructure.php"><i class="mdi mdi-circle-outline"></i> Campus Infrastructure</a></li>
            <li><a href="approvals.php"><i class="mdi mdi-circle-outline"></i> Approvals & Recognitions</a></li>
            <li><a href="advisory.php"><i class="mdi mdi-circle-outline"></i> Cells & Committees</a></li>
            <li><a href="awards.php"><i class="mdi mdi-circle-outline"></i> Awards & Achievements</a></li>
            <li><a href="affiliate.php"><i class="mdi mdi-circle-outline"></i> Affiliations</a></li>
            <li><a href="reports_accreditation.php"><i class="mdi mdi-circle-outline"></i> Reports & Accreditations</a></li>
          </ul>
        </li>

        <!-- =================== 2. SCHOOLS & INSTITUTES =================== -->
        <?php 
          $schoolsPages = ['program.php', 'institute.php', 'department.php', 'sub_department.php', 'course.php', 'branch.php'];
          $isSchoolsActive = isSubActive($schoolsPages, $currPage, 'schools', $secParam);
        ?>
        <li class="<?php echo $isSchoolsActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isSchoolsActive; ?>">
            <i class="mdi mdi-school"></i> <span>Institutes</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=schools" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Institutes Hub</a></li>
            <li><a href="program.php"><i class="mdi mdi-circle-outline"></i> Program Categories</a></li>
            <li><a href="institute.php"><i class="mdi mdi-circle-outline"></i> Faculties & Institutes</a></li>
            <li><a href="department.php"><i class="mdi mdi-circle-outline"></i> Departments</a></li>
            <li><a href="sub_department.php"><i class="mdi mdi-circle-outline"></i> Sub Departments</a></li>
            <li><a href="course.php"><i class="mdi mdi-circle-outline"></i> Courses & Intake</a></li>
            <li><a href="branch.php"><i class="mdi mdi-circle-outline"></i> Branches & Specializations</a></li>
          </ul>
        </li>

        <!-- =================== 3. ACADEMICS & EXAMS =================== -->
        <?php 
          $acadPages = ['academic.php', 'syllabus.php', 'timetable.php'];
          $isAcadActive = isSubActive($acadPages, $currPage, 'academics', $secParam);
        ?>
        <li class="<?php echo $isAcadActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAcadActive; ?>">
            <i class="mdi mdi-book-open-page-variant"></i> <span>Academics & Exams</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=academics" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Academics Hub</a></li>
            <li><a href="academic.php"><i class="mdi mdi-circle-outline"></i> Academic Calendar</a></li>
            <li><a href="syllabus.php"><i class="mdi mdi-circle-outline"></i> Scheme & Syllabus</a></li>
            <li><a href="timetable.php"><i class="mdi mdi-circle-outline"></i> Exam Time Table</a></li>
            <li><a href="pages.php?action=edit&id=16"><i class="mdi mdi-circle-outline"></i> Online Exam Guidelines</a></li>
            <li><a href="pages.php?action=edit&id=9"><i class="mdi mdi-circle-outline"></i> MOUs & Collaborations</a></li>
            <li><a href="pages.php?action=edit&id=8"><i class="mdi mdi-circle-outline"></i> Video Resources</a></li>
          </ul>
        </li>

        <!-- =================== 4. ADMISSIONS & FEES =================== -->
        <?php 
          $admPages = ['fees.php'];
          $isAdmActive = isSubActive($admPages, $currPage, 'admissions', $secParam);
        ?>
        <li class="<?php echo $isAdmActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isAdmActive; ?>">
            <i class="mdi mdi-account-plus"></i> <span>Admissions & Fees</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=admissions" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Admissions Hub</a></li>
            <li><a href="fees.php"><i class="mdi mdi-circle-outline"></i> Fee Structure</a></li>
            <li><a href="pages.php?action=edit&id=1"><i class="mdi mdi-circle-outline"></i> Bank Account Details</a></li>
            <li><a href="pages.php?action=edit&id=24"><i class="mdi mdi-circle-outline"></i> Helpline Numbers</a></li>
            <li><a href="pages.php?action=edit&id=2"><i class="mdi mdi-circle-outline"></i> Online Fee Payment</a></li>
          </ul>
        </li>

        <!-- =================== 5. RESEARCH & INNOVATION =================== -->
        <?php 
          $resPages = ['research.php', 'blogs.php'];
          $isResActive = isSubActive($resPages, $currPage, 'research', $secParam);
        ?>
        <li class="<?php echo $isResActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isResActive; ?>">
            <i class="mdi mdi-flask"></i> <span>Research & Labs</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=research" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Research Hub</a></li>
            <li><a href="research.php"><i class="mdi mdi-circle-outline"></i> Research Portal & Labs</a></li>
            <li><a href="pages.php?action=edit&id=3"><i class="mdi mdi-circle-outline"></i> Research at a Glance</a></li>
            <li><a href="pages.php?action=edit&id=4"><i class="mdi mdi-circle-outline"></i> Funding Agencies</a></li>
            <li><a href="pages.php?action=edit&id=5"><i class="mdi mdi-circle-outline"></i> Publications</a></li>
            <li><a href="pages.php?action=edit&id=15"><i class="mdi mdi-circle-outline"></i> Journals</a></li>
            <li><a href="pages.php?action=edit&id=14"><i class="mdi mdi-circle-outline"></i> PhD Scholars List</a></li>
            <li><a href="pages.php?action=edit&id=10"><i class="mdi mdi-circle-outline"></i> Conferences & Seminars</a></li>
            <li><a href="pages.php?action=edit&id=11"><i class="mdi mdi-circle-outline"></i> Industrial Visits</a></li>
            <li><a href="blogs.php"><i class="mdi mdi-circle-outline"></i> Research & Tech Blogs</a></li>
          </ul>
        </li>

        <!-- =================== 6. PLACEMENTS & CAREERS =================== -->
        <?php 
          $placePages = ['recruiters.php', 'alumni_achievers.php', 'testimonial.php', 'jobs.php'];
          $isPlaceActive = isSubActive($placePages, $currPage, 'placements', $secParam);
        ?>
        <li class="<?php echo $isPlaceActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isPlaceActive; ?>">
            <i class="mdi mdi-briefcase-check"></i> <span>Placements & Careers</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=placements" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Placements Hub</a></li>
            <li><a href="recruiters.php"><i class="mdi mdi-circle-outline"></i> Placement Recruiters</a></li>
            <li><a href="alumni_achievers.php"><i class="mdi mdi-circle-outline"></i> Star Alumni Achievers</a></li>
            <li><a href="testimonial.php"><i class="mdi mdi-circle-outline"></i> Student Testimonials</a></li>
            <li><a href="jobs.php"><i class="mdi mdi-circle-outline"></i> Career & Job Openings</a></li>
          </ul>
        </li>

        <!-- =================== 7. NEWS, MEDIA & EVENTS =================== -->
        <?php 
          $newsPages = ['news.php', 'notice.php', 'announcements.php', 'popup_notices.php', 'events.php', 'media.php', 'gallery.php', 'blogs.php'];
          $isNewsActive = isSubActive($newsPages, $currPage, 'news', $secParam);
        ?>
        <li class="<?php echo $isNewsActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isNewsActive; ?>">
            <i class="mdi mdi-bullhorn"></i> <span>News & Media</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=news" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ News & Media Hub</a></li>
            <li><a href="popup_notices.php" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-bell-ring-outline"></i> ★ Popup & Results</a></li>
            <li><a href="blogs.php"><i class="mdi mdi-circle-outline"></i> Research & Tech Blogs</a></li>
            <li><a href="news.php"><i class="mdi mdi-circle-outline"></i> News Updates</a></li>
            <li><a href="notice.php"><i class="mdi mdi-circle-outline"></i> Official Notices</a></li>
            <li><a href="announcements.php"><i class="mdi mdi-circle-outline"></i> Ticker Announcements</a></li>
            <li><a href="events.php"><i class="mdi mdi-circle-outline"></i> Events & Fests</a></li>
            <li><a href="media.php"><i class="mdi mdi-circle-outline"></i> Media Coverage</a></li>
            <li><a href="gallery.php"><i class="mdi mdi-circle-outline"></i> Photo Gallery</a></li>
          </ul>
        </li>

        <!-- =================== CAMPUS LIFE =================== -->
        <?php 
          $campusLifePages = ['campus_life.php'];
          $isCampusLifeActive = isSubActive($campusLifePages, $currPage, 'campus_life', $secParam);
        ?>
        <li class="<?php echo $isCampusLifeActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isCampusLifeActive; ?>">
            <i class="mdi mdi-compass-outline"></i> <span>Campus Life</span>
          </a>
          <ul class="submenu">
            <li><a href="campus_life.php?page=overview" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-compass"></i> Campus Life Overview</a></li>
            <li><a href="campus_life.php?page=clubs"><i class="mdi mdi-account-group"></i> Clubs &amp; Societies</a></li>
          </ul>
        </li>

        <!-- =================== 8. STUDENT CORNER & GOVERNANCE =================== -->
        <?php 
          $studentPages = ['policies.php', 'student_publications.php'];
          $isStudentActive = isSubActive($studentPages, $currPage, 'student', $secParam);
        ?>
        <li class="<?php echo $isStudentActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isStudentActive; ?>">
            <i class="mdi mdi-account-group"></i> <span>Student Corner</span>
          </a>
          <ul class="submenu">
            <li><a href="section_hub.php?section=student" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-grid-outline"></i> ★ Student Corner Hub</a></li>
            <li><a href="policies.php"><i class="mdi mdi-circle-outline"></i> Legal & Policies</a></li>
            <li><a href="student_publications.php"><i class="mdi mdi-circle-outline"></i> Student Publications</a></li>
            <li><a href="pages.php?action=edit&id=25"><i class="mdi mdi-circle-outline"></i> NAD Depository</a></li>
            <li><a href="pages.php?action=edit&id=22"><i class="mdi mdi-circle-outline"></i> Solar Plant & Green</a></li>
            <li><a href="pages.php?action=edit&id=23"><i class="mdi mdi-circle-outline"></i> Radio Popcorn 90.4 FM</a></li>
          </ul>
        </li>

        <!-- =================== 9. ALL FORMS & ENQUIRIES (Right Above System & Settings) =================== -->
        <li class="bu-menu-category"><span>Lead & Form Submissions</span></li>
        <?php 
          $formsPages = ['all_enquiries.php', 'enquiry.php', 'admission.php', 'inquiry.php', 'grievance.php', 'alumni.php'];
          $isFormsActive = isSubActive($formsPages, $currPage);
        ?>
        <li class="<?php echo $isFormsActive; ?>">
          <a href="javascript:void(0);" class="waves-effect has-arrow <?php echo $isFormsActive; ?>" style="color:#FFC107 !important; font-weight:700;">
            <i class="mdi mdi-clipboard-text" style="color:#FFC107 !important;"></i> <span>All Forms & Enquiries</span>
          </a>
          <ul class="submenu">
            <li><a href="all_enquiries.php" style="color:#FFC107 !important; font-weight:700;"><i class="mdi mdi-view-dashboard"></i> ★ All Enquiries Hub</a></li>
            <li><a href="enquiry.php"><i class="mdi mdi-circle-outline"></i> Course Enquiries</a></li>
            <li><a href="admission.php"><i class="mdi mdi-circle-outline"></i> Online Applications</a></li>
            <li><a href="inquiry.php"><i class="mdi mdi-circle-outline"></i> Contact Inquiries</a></li>
            <li><a href="grievance.php"><i class="mdi mdi-circle-outline"></i> Grievance Redressal</a></li>
            <li><a href="alumni.php"><i class="mdi mdi-circle-outline"></i> Alumni Registrations</a></li>
          </ul>
        </li>

        <!-- =================== 10. SYSTEM & SEO SETTINGS =================== -->
        <li class="bu-menu-category"><span>System & Settings</span></li>
        <li class="<?php echo ($currPage === 'header_settings.php') ? 'active' : ''; ?>">
          <a href="header_settings.php" class="waves-effect <?php echo ($currPage === 'header_settings.php') ? 'active' : ''; ?>">
            <i class="mdi mdi-page-layout-header" style="color: #FFC107 !important;"></i> <span>Header &amp; Navigation</span>
          </a>
        </li>
        <li class="<?php echo ($currPage === 'pages.php') ? 'active' : ''; ?>">
          <a href="pages.php" class="waves-effect <?php echo ($currPage === 'pages.php') ? 'active' : ''; ?>">
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
