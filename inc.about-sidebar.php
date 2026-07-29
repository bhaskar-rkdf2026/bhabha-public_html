<?php
/**
 * inc.about-sidebar.php
 * Shared sidebar navigation for all About Us sub-pages.
 * Set $active_page to the current page filename before including.
 */
$active_page = $active_page ?? '';
?>
<aside class="bu-inner-sidebar">
  <nav class="bu-sidebar-nav">
    <div class="bu-sidebar-nav-header"><i class="fa fa-list" style="margin-right:8px;"></i>About University</div>
    <ul>
      <li>
        <a href="about.php" class="<?php echo ($active_page=='about') ? 'active' : ''; ?>">
          <i class="fa fa-home"></i> About Overview
        </a>
      </li>
      <li>
        <a href="<?php echo href('page.php','id=20');?>" class="<?php echo ($active_page=='overview') ? 'active' : ''; ?>">
          <i class="fa fa-university"></i> University Overview
        </a>
      </li>
      <li>
        <a href="<?php echo href('mission-vision.php');?>" class="<?php echo ($active_page=='mission-vision') ? 'active' : ''; ?>">
          <i class="fa fa-eye"></i> Vision &amp; Mission
        </a>
      </li>
      <li>
        <a href="<?php echo href('infrastructure.php');?>" class="<?php echo ($active_page=='infrastructure') ? 'active' : ''; ?>">
          <i class="fa fa-building"></i> Campus &amp; Infrastructure
        </a>
      </li>
      <li>
        <a href="<?php echo href('values.php'); ?>" class="<?php echo ($active_page=='values') ? 'active' : ''; ?>">
          <i class="fa fa-heart"></i> Core Values
        </a>
      </li>
      <li>
        <a href="<?php echo href('leadership.php');?>" class="<?php echo ($active_page=='leadership') ? 'active' : ''; ?>">
          <i class="fa fa-users"></i> Administration &amp; Leadership
        </a>
      </li>
      <li>
        <a href="<?php echo href('why-us.php'); ?>" class="<?php echo ($active_page=='why-us') ? 'active' : ''; ?>">
          <i class="fa fa-star"></i> Why Choose Bhabha
        </a>
      </li>
      <li>
        <a href="<?php echo href('awards.php');?>" class="<?php echo ($active_page=='awards') ? 'active' : ''; ?>">
          <i class="fa fa-trophy"></i> Awards &amp; Achievements
        </a>
      </li>
      <li>
        <a href="<?php echo href('advisory.php');?>" class="<?php echo ($active_page=='advisory') ? 'active' : ''; ?>">
          <i class="fa fa-sitemap"></i> Cells &amp; Committees
        </a>
      </li>
      <li>
        <a href="<?php echo href('approvals.php');?>" class="<?php echo ($active_page=='approvals') ? 'active' : ''; ?>">
          <i class="fa fa-certificate"></i> Approvals &amp; Recognitions
        </a>
      </li>
      <li>
        <a href="<?php echo URL_UPLOAD; ?>media/ffe90b0c7e9e55b00b1207aee3ce3971.pdf" target="_blank">
          <i class="fa fa-file-pdf-o"></i> Sponsoring Detail
        </a>
      </li>
      <li>
        <a href="auditreport.php" class="<?php echo ($active_page=='auditreport') ? 'active' : ''; ?>">
          <i class="fa fa-bar-chart"></i> Finance &amp; Audit Report
        </a>
      </li>
      <li>
        <a href="<?php echo URL_UPLOAD; ?>media/671d06f0fea73f07576a994c4343281c.pdf" target="_blank">
          <i class="fa fa-download"></i> Annual Report 2024
        </a>
      </li>
      <li>
        <a href="ugc-proforma.php" class="<?php echo ($active_page=='ugc-proforma') ? 'active' : ''; ?>">
          <i class="fa fa-file-text"></i> UGC Proforma
        </a>
      </li>
    </ul>
  </nav>
</aside>
