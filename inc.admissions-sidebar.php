<?php
/**
 * inc.admissions-sidebar.php
 * Shared sidebar navigation for all Admissions sub-pages.
 * Set $active_page to the current page key before including.
 */
$active_page = $active_page ?? '';
?>
<aside class="bu-inner-sidebar">
  <nav class="bu-sidebar-nav">
    <div class="bu-sidebar-nav-header"><i class="fa fa-graduation-cap" style="margin-right:8px;color:#FFC107;"></i>Admissions Hub</div>
    <ul>
      <li>
        <a href="<?php echo href('enquiry.php');?>" class="<?php echo ($active_page=='enquiry') ? 'active' : ''; ?>">
          <i class="fa fa-info-circle"></i> Admission Enquiry
        </a>
      </li>
      <li>
        <a href="<?php echo href('admission-process.php');?>" class="<?php echo ($active_page=='process') ? 'active' : ''; ?>">
          <i class="fa fa-sliders"></i> Admission Process
        </a>
      </li>
      <li>
        <a href="<?php echo href('course.php');?>" class="<?php echo ($active_page=='course') ? 'active' : ''; ?>">
          <i class="fa fa-book"></i> Degree Programs
        </a>
      </li>
      <li>
        <a href="<?php echo href('scholarship.php');?>" class="<?php echo ($active_page=='scholarship') ? 'active' : ''; ?>">
          <i class="fa fa-trophy"></i> Scholarship Schemes
        </a>
      </li>
      <li>
        <a href="<?php echo href('online-admission.php');?>" class="<?php echo ($active_page=='online-admission') ? 'active' : ''; ?>">
          <i class="fa fa-pencil-square-o"></i> Online Registration
        </a>
      </li>
      <li>
        <a href="<?php echo href('page.php','id=1');?>" class="<?php echo ($active_page=='bank-details') ? 'active' : ''; ?>">
          <i class="fa fa-university"></i> Bank &amp; Fee Details
        </a>
      </li>
      <li>
        <a href="<?php echo href('page.php','id=24');?>" class="<?php echo ($active_page=='helpline') ? 'active' : ''; ?>">
          <i class="fa fa-phone"></i> Admission Helpline
        </a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar CTA Card -->
  <div style="background:linear-gradient(145deg, #051235 0%, #0A1B54 100%); border:1px solid rgba(255,193,7,0.3); border-radius:10px; padding:22px 18px; color:#fff; text-align:center; margin-top:20px; box-shadow:0 8px 24px rgba(10,27,84,0.18);">
    <span style="font-size:10px; font-weight:800; letter-spacing:1.5px; color:#FFC107; text-transform:uppercase; display:block; margin-bottom:6px;">Session 2026-27</span>
    <h4 style="font-family:'Playfair Display',serif; font-size:16px; font-weight:700; color:#fff; margin:0 0 8px 0;">Admissions Open</h4>
    <p style="font-size:12px; color:rgba(255,255,255,0.72); line-height:1.5; margin:0 0 16px 0;">Apply online or consult our dedicated admission counselors today.</p>
    <a href="<?php echo href('online-admission.php');?>" style="display:inline-block; width:100%; background:#FFC107; color:#0A1B54; font-size:12px; font-weight:800; padding:10px 14px; border-radius:6px; text-decoration:none; text-transform:uppercase; letter-spacing:0.5px; box-sizing:border-box; transition:all 0.2s;" onmouseover="this.style.background='#E5AC00'" onmouseout="this.style.background='#FFC107'">Apply Online Now <i class="fa fa-arrow-right"></i></a>
  </div>

  <!-- Admission Helpdesk Widget -->
  <div style="background:#fff; border:1px solid #E2E8F0; border-radius:10px; padding:20px 18px; margin-top:20px; box-shadow:0 4px 16px rgba(6,29,124,0.04);">
    <h5 style="font-size:13.5px; font-weight:700; color:#0A1B54; margin:0 0 10px 0; display:flex; align-items:center; gap:6px;">
      <i class="fa fa-headphones" style="color:#D99B00;"></i> Admission Cell
    </h5>
    <div style="font-size:12px; color:#475569; line-height:1.7;">
      <div><i class="fa fa-phone" style="color:#D99B00; margin-right:6px;"></i> <strong>0755-4246498 / 4903330</strong></div>
      <div><i class="fa fa-envelope-o" style="color:#D99B00; margin-right:6px;"></i> info@bhabhauniversity.edu.in</div>
      <div style="margin-top:6px; color:#64748B; font-size:11px;">Mon &ndash; Sat: 9:30 AM &ndash; 5:30 PM</div>
    </div>
  </div>
</aside>
