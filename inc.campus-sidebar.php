<?php
/**
 * inc.campus-sidebar.php
 * Shared sidebar navigation for all Campus Life sub-pages.
 * Set $active_page to the current page identifier before including.
 */
$active_page = $active_page ?? '';
?>
<aside class="bu-inner-sidebar">
  <nav class="bu-sidebar-nav">
    <div class="bu-sidebar-nav-header"><i class="fa fa-compass" style="margin-right:8px;"></i>Campus Life</div>
    <ul>
      <li>
        <a href="<?php echo href('campus-life.php'); ?>" class="<?php echo ($active_page=='campus-life') ? 'active' : ''; ?>">
          <i class="fa fa-home"></i> Campus Life Overview
        </a>
      </li>
      <li>
        <a href="<?php echo href('infrastructure.php'); ?>" class="<?php echo ($active_page=='infrastructure') ? 'active' : ''; ?>">
          <i class="fa fa-building-o"></i> Campus &amp; Infrastructure
        </a>
      </li>
      <li>
        <a href="<?php echo href('academic.php'); ?>" class="<?php echo ($active_page=='academic') ? 'active' : ''; ?>">
          <i class="fa fa-book"></i> Academics &amp; Learning
        </a>
      </li>
      <li>
        <a href="<?php echo href('hostel.php'); ?>" class="<?php echo ($active_page=='hostel') ? 'active' : ''; ?>">
          <i class="fa fa-home"></i> Hostel &amp; Residential Life
        </a>
      </li>
      <li>
        <a href="<?php echo href('cafeteria.php'); ?>" class="<?php echo ($active_page=='cafeteria') ? 'active' : ''; ?>">
          <i class="fa fa-cutlery"></i> Cafeteria &amp; Food Court
        </a>
      </li>
      <li>
        <a href="<?php echo href('transportation.php'); ?>" class="<?php echo ($active_page=='transportation') ? 'active' : ''; ?>">
          <i class="fa fa-bus"></i> Transport &amp; Bus Routes
        </a>
      </li>
      <li>
        <a href="<?php echo href('library.php'); ?>" class="<?php echo ($active_page=='library') ? 'active' : ''; ?>">
          <i class="fa fa-bookmark"></i> Central Library &amp; E-Resources
        </a>
      </li>
      <li>
        <a href="<?php echo href('it-labs.php'); ?>" class="<?php echo ($active_page=='it-labs') ? 'active' : ''; ?>">
          <i class="fa fa-laptop"></i> IT &amp; Computer Labs
        </a>
      </li>
      <li>
        <a href="<?php echo href('health-wellness.php'); ?>" class="<?php echo ($active_page=='health-wellness') ? 'active' : ''; ?>">
          <i class="fa fa-heartbeat"></i> Health &amp; Wellness
        </a>
      </li>
      <li>
        <a href="<?php echo href('sports.php'); ?>" class="<?php echo ($active_page=='sports') ? 'active' : ''; ?>">
          <i class="fa fa-futbol-o"></i> Sports &amp; Fitness Complex
        </a>
      </li>
      <li>
        <a href="<?php echo href('events.php'); ?>" class="<?php echo ($active_page=='events') ? 'active' : ''; ?>">
          <i class="fa fa-calendar-check-o"></i> Arts, Culture &amp; Events
        </a>
      </li>
      <li>
        <a href="<?php echo href('clubs.php'); ?>" class="<?php echo ($active_page=='clubs') ? 'active' : ''; ?>">
          <i class="fa fa-users"></i> Student Clubs &amp; Societies
        </a>
      </li>
      <li>
        <a href="<?php echo href('community-service.php'); ?>" class="<?php echo ($active_page=='community-service') ? 'active' : ''; ?>">
          <i class="fa fa-leaf"></i> Community Service &amp; NSS
        </a>
      </li>
      <li>
        <a href="<?php echo href('entrepreneurship.php'); ?>" class="<?php echo ($active_page=='entrepreneurship') ? 'active' : ''; ?>">
          <i class="fa fa-rocket"></i> Entrepreneurship &amp; EDC
        </a>
      </li>
      <li>
        <a href="<?php echo href('student-safety.php'); ?>" class="<?php echo ($active_page=='student-safety') ? 'active' : ''; ?>">
          <i class="fa fa-shield"></i> Student Safety &amp; Support
        </a>
      </li>
      <li>
        <a href="<?php echo href('student-media.php'); ?>" class="<?php echo ($active_page=='student-media') ? 'active' : ''; ?>">
          <i class="fa fa-bullhorn"></i> Student Media &amp; Radio
        </a>
      </li>
      <li>
        <a href="<?php echo href('alumni.php'); ?>" class="<?php echo ($active_page=='alumni') ? 'active' : ''; ?>">
          <i class="fa fa-graduation-cap"></i> Alumni Portal
        </a>
      </li>
      <li>
        <a href="<?php echo href('gallery.php'); ?>" class="<?php echo ($active_page=='gallery') ? 'active' : ''; ?>">
          <i class="fa fa-picture-o"></i> Campus Gallery
        </a>
      </li>
    </ul>
  </nav>

  <!-- Quick Admission Action Widget in Sidebar -->
  <div style="background:linear-gradient(135deg, #0A1B54 0%, #061D7C 100%); color:#ffffff; border-radius:10px; padding:22px 18px; margin-top:20px; box-shadow:0 6px 20px rgba(10,27,84,0.12); text-align:center;">
    <div style="width:44px; height:44px; border-radius:50%; background:rgba(255,193,7,0.18); border:1px solid #FFC107; display:inline-flex; align-items:center; justify-content:center; color:#FFC107; font-size:18px; margin-bottom:12px;">
      <i class="fa fa-phone"></i>
    </div>
    <h4 style="color:#ffffff; font-size:15px; font-weight:800; margin:0 0 6px;">Campus Helpline</h4>
    <p style="font-size:12px; color:rgba(255,255,255,0.75); margin:0 0 14px; line-height:1.45;">Need hostel booking, transport routes, or campus assistance?</p>
    <a href="tel:07554246498" style="display:inline-block; width:100%; box-sizing:border-box; background:#FFC107; color:#0A1B54; font-weight:800; font-size:12.5px; padding:9px 12px; border-radius:6px; text-decoration:none; margin-bottom:8px;">
      <i class="fa fa-phone mr-1"></i> 0755-4246498
    </a>
    <a href="<?php echo href('enquiry.php'); ?>" style="display:inline-block; width:100%; box-sizing:border-box; background:rgba(255,255,255,0.12); color:#ffffff; font-weight:700; font-size:12px; padding:7px 12px; border-radius:6px; text-decoration:none;">
      Online Admission Enquiry
    </a>
  </div>
</aside>
