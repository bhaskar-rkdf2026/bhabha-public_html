<?php
/**
 * inc.menu.php
 * Bhabha University Admin Sidebar - Modern Categorized Layout
 */
$currPage = basename($_SERVER['PHP_SELF']);
function isMenuActive($page, $curr) {
    return ($page === $curr) ? 'active' : '';
}
?>
<div class="left side-menu">
  <div class="slimscroll-menu" id="remove-scroll">
    <div id="sidebar-menu">
      <ul class="metismenu" id="side-menu">

        <!-- =================== CORE PLATFORM =================== -->
        <li class="bu-menu-category"><span>Core Platform</span></li>
        <li class="<?php echo isMenuActive('dashboard.php', $currPage); ?>">
          <a href="dashboard.php" class="waves-effect <?php echo isMenuActive('dashboard.php', $currPage); ?>">
            <i class="mdi mdi-view-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('homepage_sections.php', $currPage); ?>">
          <a href="homepage_sections.php" class="waves-effect <?php echo isMenuActive('homepage_sections.php', $currPage); ?>">
            <i class="mdi mdi-home"></i> <span>Home Sections</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('pages.php', $currPage); ?>">
          <a href="pages.php" class="waves-effect <?php echo isMenuActive('pages.php', $currPage); ?>">
            <i class="mdi mdi-file-document-box"></i> <span>Website Pages</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('research.php', $currPage); ?>">
          <a href="research.php" class="waves-effect <?php echo isMenuActive('research.php', $currPage); ?>">
            <i class="mdi mdi-flask"></i> <span>Research Portal</span>
          </a>
        </li>

        <!-- =================== DYNAMIC PILLARS =================== -->
        <li class="bu-menu-category"><span>Dynamic Pillars</span></li>
        <li class="<?php echo isMenuActive('university_overview.php', $currPage); ?>">
          <a href="university_overview.php" class="waves-effect <?php echo isMenuActive('university_overview.php', $currPage); ?>">
            <i class="mdi mdi-bank"></i> <span>University Overview</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('reports_accreditation.php', $currPage); ?>">
          <a href="reports_accreditation.php" class="waves-effect <?php echo isMenuActive('reports_accreditation.php', $currPage); ?>">
            <i class="mdi mdi-certificate"></i> <span>Reports &amp; Accreditations</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('policies.php', $currPage); ?>">
          <a href="policies.php" class="waves-effect <?php echo isMenuActive('policies.php', $currPage); ?>">
            <i class="mdi mdi-scale-balance"></i> <span>Legal &amp; Policies</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('student_publications.php', $currPage); ?>">
          <a href="student_publications.php" class="waves-effect <?php echo isMenuActive('student_publications.php', $currPage); ?>">
            <i class="mdi mdi-book-open-page-variant"></i> <span>Student &amp; Publications</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('blogs.php', $currPage); ?>">
          <a href="blogs.php" class="waves-effect <?php echo isMenuActive('blogs.php', $currPage); ?>">
            <i class="mdi mdi-newspaper"></i> <span>Blogs &amp; Articles</span>
          </a>
        </li>

        <!-- =================== ADMISSIONS & LEADS =================== -->
        <li class="bu-menu-category"><span>Admissions &amp; Leads</span></li>
        <li class="<?php echo isMenuActive('admission.php', $currPage); ?>">
          <a href="admission.php" class="waves-effect <?php echo isMenuActive('admission.php', $currPage); ?>">
            <i class="mdi mdi-account-plus"></i> <span>Online Applications</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('enquiry.php', $currPage); ?>">
          <a href="enquiry.php" class="waves-effect <?php echo isMenuActive('enquiry.php', $currPage); ?>">
            <i class="mdi mdi-help-circle-outline"></i> <span>Course Enquiries</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('inquiry.php', $currPage); ?>">
          <a href="inquiry.php" class="waves-effect <?php echo isMenuActive('inquiry.php', $currPage); ?>">
            <i class="mdi mdi-message-text-outline"></i> <span>Contact Inquiries</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('alumni.php', $currPage); ?>">
          <a href="alumni.php" class="waves-effect <?php echo isMenuActive('alumni.php', $currPage); ?>">
            <i class="mdi mdi-account-multiple-outline"></i> <span>Alumni Registrations</span>
          </a>
        </li>

        <!-- =================== ACADEMICS & FACULTIES =================== -->
        <li class="bu-menu-category"><span>Academics &amp; Faculties</span></li>
        <li class="<?php echo isMenuActive('academic.php', $currPage); ?>">
          <a href="academic.php" class="waves-effect <?php echo isMenuActive('academic.php', $currPage); ?>">
            <i class="mdi mdi-calendar-clock"></i> <span>Academic Calendar</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('institute.php', $currPage); ?>">
          <a href="institute.php" class="waves-effect <?php echo isMenuActive('institute.php', $currPage); ?>">
            <i class="mdi mdi-city"></i> <span>Institutes</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('department.php', $currPage); ?>">
          <a href="department.php" class="waves-effect <?php echo isMenuActive('department.php', $currPage); ?>">
            <i class="mdi mdi-school"></i> <span>Departments</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('sub_department.php', $currPage); ?>">
          <a href="sub_department.php" class="waves-effect <?php echo isMenuActive('sub_department.php', $currPage); ?>">
            <i class="mdi mdi-domain"></i> <span>Sub Departments</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('course.php', $currPage); ?>">
          <a href="course.php" class="waves-effect <?php echo isMenuActive('course.php', $currPage); ?>">
            <i class="mdi mdi-book-multiple"></i> <span>Courses &amp; Intake</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('branch.php', $currPage); ?>">
          <a href="branch.php" class="waves-effect <?php echo isMenuActive('branch.php', $currPage); ?>">
            <i class="mdi mdi-source-branch"></i> <span>Branches</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('fees.php', $currPage); ?>">
          <a href="fees.php" class="waves-effect <?php echo isMenuActive('fees.php', $currPage); ?>">
            <i class="mdi mdi-currency-inr"></i> <span>Fee Structure</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('syllabus.php', $currPage); ?>">
          <a href="syllabus.php" class="waves-effect <?php echo isMenuActive('syllabus.php', $currPage); ?>">
            <i class="mdi mdi-file-tree"></i> <span>Scheme &amp; Syllabus</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('timetable.php', $currPage); ?>">
          <a href="timetable.php" class="waves-effect <?php echo isMenuActive('timetable.php', $currPage); ?>">
            <i class="mdi mdi-calendar-text"></i> <span>Exam Time Table</span>
          </a>
        </li>

        <!-- =================== CAMPUS & GOVERNANCE =================== -->
        <li class="bu-menu-category"><span>Campus &amp; Governance</span></li>
        <li class="<?php echo isMenuActive('infrastructure.php', $currPage); ?>">
          <a href="infrastructure.php" class="waves-effect <?php echo isMenuActive('infrastructure.php', $currPage); ?>">
            <i class="mdi mdi-image-area"></i> <span>Infrastructure</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('leadership.php', $currPage); ?>">
          <a href="leadership.php" class="waves-effect <?php echo isMenuActive('leadership.php', $currPage); ?>">
            <i class="mdi mdi-account-star"></i> <span>Leadership</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('approvals.php', $currPage); ?>">
          <a href="approvals.php" class="waves-effect <?php echo isMenuActive('approvals.php', $currPage); ?>">
            <i class="mdi mdi-check-circle-outline"></i> <span>Approvals &amp; UGC</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('advisory.php', $currPage); ?>">
          <a href="advisory.php" class="waves-effect <?php echo isMenuActive('advisory.php', $currPage); ?>">
            <i class="mdi mdi-account-check"></i> <span>Cells &amp; Committees</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('awards.php', $currPage); ?>">
          <a href="awards.php" class="waves-effect <?php echo isMenuActive('awards.php', $currPage); ?>">
            <i class="mdi mdi-trophy-outline"></i> <span>Awards &amp; Achievements</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('affiliate.php', $currPage); ?>">
          <a href="affiliate.php" class="waves-effect <?php echo isMenuActive('affiliate.php', $currPage); ?>">
            <i class="mdi mdi-shield"></i> <span>Affiliations</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('grievance.php', $currPage); ?>">
          <a href="grievance.php" class="waves-effect <?php echo isMenuActive('grievance.php', $currPage); ?>">
            <i class="mdi mdi-comment-alert-outline"></i> <span>Grievance Cell</span>
          </a>
        </li>

        <!-- =================== MEDIA & ENGAGEMENT =================== -->
        <li class="bu-menu-category"><span>Media &amp; Engagement</span></li>
        <li class="<?php echo isMenuActive('announcements.php', $currPage); ?>">
          <a href="announcements.php" class="waves-effect <?php echo isMenuActive('announcements.php', $currPage); ?>">
            <i class="mdi mdi-bell-ring-outline"></i> <span>Announcements</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('news.php', $currPage); ?>">
          <a href="news.php" class="waves-effect <?php echo isMenuActive('news.php', $currPage); ?>">
            <i class="mdi mdi-bullhorn"></i> <span>News Updates</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('events.php', $currPage); ?>">
          <a href="events.php" class="waves-effect <?php echo isMenuActive('events.php', $currPage); ?>">
            <i class="mdi mdi-calendar-check"></i> <span>Events &amp; Fests</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('notice.php', $currPage); ?>">
          <a href="notice.php" class="waves-effect <?php echo isMenuActive('notice.php', $currPage); ?>">
            <i class="mdi mdi-clipboard-text"></i> <span>Notices &amp; Circulars</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('media.php', $currPage); ?>">
          <a href="media.php" class="waves-effect <?php echo isMenuActive('media.php', $currPage); ?>">
            <i class="mdi mdi-camera"></i> <span>Media Coverage</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('gallery.php', $currPage); ?>">
          <a href="gallery.php" class="waves-effect <?php echo isMenuActive('gallery.php', $currPage); ?>">
            <i class="mdi mdi-image-multiple"></i> <span>Photo Gallery</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('testimonial.php', $currPage); ?>">
          <a href="testimonial.php" class="waves-effect <?php echo isMenuActive('testimonial.php', $currPage); ?>">
            <i class="mdi mdi-comment-text-outline"></i> <span>Testimonials</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('recruiters.php', $currPage); ?>">
          <a href="recruiters.php" class="waves-effect <?php echo isMenuActive('recruiters.php', $currPage); ?>">
            <i class="mdi mdi-briefcase-check"></i> <span>Placement Recruiters</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('jobs.php', $currPage); ?>">
          <a href="jobs.php" class="waves-effect <?php echo isMenuActive('jobs.php', $currPage); ?>">
            <i class="mdi mdi-briefcase"></i> <span>Job Openings</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('links.php', $currPage); ?>">
          <a href="links.php" class="waves-effect <?php echo isMenuActive('links.php', $currPage); ?>">
            <i class="mdi mdi-link-variant"></i> <span>Quick Links</span>
          </a>
        </li>

        <!-- =================== SYSTEM =================== -->
        <li class="bu-menu-category"><span>System &amp; Settings</span></li>
        <li class="<?php echo isMenuActive('seo.php', $currPage); ?>">
          <a href="seo.php" class="waves-effect <?php echo isMenuActive('seo.php', $currPage); ?>">
            <i class="mdi mdi-chart-areaspline" style="color: #FFC107 !important;"></i> <span>SEO &amp; Meta Manager</span>
          </a>
        </li>
        <li class="<?php echo isMenuActive('settings.php', $currPage); ?>">
          <a href="settings.php" class="waves-effect <?php echo isMenuActive('settings.php', $currPage); ?>">
            <i class="mdi mdi-settings"></i> <span>General Settings</span>
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
