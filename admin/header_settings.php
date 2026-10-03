<?php
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
define("PAGE", 'header_settings.php');
define("TITLE", 'Header & Navigation Menu Builder');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// 1. Handle Form Submission
if (isset($_POST['save_header_settings'])) {
    $hc_prev = getHeaderConfig();

    // Parse JSON items submitted by WordPress-style builders
    $main_nav_items = [];
    if (!empty($_POST['main_nav_items_json'])) {
        $decoded = json_decode($_POST['main_nav_items_json'], true);
        if (is_array($decoded) && count($decoded) > 0) {
            $main_nav_items = $decoded;
        }
    }
    if (empty($main_nav_items)) {
        $main_nav_items = $hc_prev['main_nav_items'];
    }

    $top_quick_links = [];
    if (!empty($_POST['top_quick_links_json'])) {
        $decoded = json_decode($_POST['top_quick_links_json'], true);
        if (is_array($decoded) && count($decoded) > 0) {
            $top_quick_links = $decoded;
        }
    }
    if (empty($top_quick_links)) {
        $top_quick_links = $hc_prev['top_quick_links'];
    }

    $erp_links = [];
    if (!empty($_POST['erp_links_json'])) {
        $decoded = json_decode($_POST['erp_links_json'], true);
        if (is_array($decoded) && count($decoded) > 0) {
            $erp_links = $decoded;
        }
    }
    if (empty($erp_links)) {
        $erp_links = $hc_prev['erp_links'];
    }

    $config = [
        // Menu Structures
        'main_nav_items'     => $main_nav_items,
        'top_quick_links'    => $top_quick_links,
        'erp_links'          => $erp_links,
        'show_erp_dropdown'  => isset($_POST['show_erp_dropdown']) ? '1' : '0',

        // Top Bar Contacts
        'phone_one'          => trim($_POST['phone_one'] ?? '0755-4246498'),
        'phone_two'          => trim($_POST['phone_two'] ?? '+91 755 4936800'),
        'helpline_email'     => trim($_POST['helpline_email'] ?? 'info@bhabhauniversity.edu.in'),
        'show_top_contacts'  => isset($_POST['show_top_contacts']) ? '1' : '0',

        // Social Media
        'facebook_url'       => trim($_POST['facebook_url'] ?? ''),
        'instagram_url'      => trim($_POST['instagram_url'] ?? ''),
        'twitter_url'        => trim($_POST['twitter_url'] ?? ''),
        'youtube_url'        => trim($_POST['youtube_url'] ?? ''),
        'linkedin_url'       => trim($_POST['linkedin_url'] ?? ''),
        'whatsapp_num'       => trim($_POST['whatsapp_num'] ?? ''),
        'show_social_links'  => isset($_POST['show_social_links']) ? '1' : '0',

        // Apply Buttons
        'apply_btn_text'     => trim($_POST['apply_btn_text'] ?? 'Apply'),
        'apply_btn_url'      => trim($_POST['apply_btn_url'] ?? 'enquiry.php'),
        'apply_btn_show'     => isset($_POST['apply_btn_show']) ? '1' : '0',
        'apply_top_text'     => trim($_POST['apply_top_text'] ?? 'Apply Now'),
        'apply_top_url'      => trim($_POST['apply_top_url'] ?? 'enquiry.php'),
        'apply_top_blink'    => isset($_POST['apply_top_blink']) ? '1' : '0',

        // Brand Identity
        'brand_name_1'       => trim($_POST['brand_name_1'] ?? 'BHABHA'),
        'brand_name_2'       => trim($_POST['brand_name_2'] ?? 'UNIVERSITY'),
        'brand_logo'         => trim($_POST['brand_logo'] ?? 'bhabha-university-logo-hd.png?v=20260926'),

        // Legacy Fallbacks
        'erp_student_url'    => $erp_links[0]['url'] ?? 'https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx',
        'erp_faculty_url'    => $erp_links[1]['url'] ?? 'https://bhabha.accsofterp.com/Accsoft/Login.aspx',
        'erp_oap_url'        => $erp_links[2]['url'] ?? 'https://bhabha.accsofterp.com/OAP/AdminLogin.aspx',
        'erp_resultsoft_url' => $erp_links[3]['url'] ?? 'https://bhabha.accsofterp.com/Resultsoft_BU/Login.aspx',
        'webmail_url'        => 'https://webmail.bhabhauniversity.edu.in/',
        'alumni_url'         => 'alumni.php',
        'nirf_url'           => 'nirf.php',
        'nad_url'            => 'page.php?id=25',
        'iqac_url'           => 'iqac.php',
        'disclosure_url'     => (defined('URL_UPLOAD') ? URL_UPLOAD : '') . 'media/12dfaac45ab95d2c718f63563d7c5a28.pdf',
        'verification_url'   => 'https://bhabha.accsofterp.com/AccSoft/EducationVerificationForm.aspx',
        'blog_url'           => 'blogs.php',
    ];

    $json_value = json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    // Save to settings table
    $chk = $db->where('field', 'header_config_json')->getOne('settings');
    if ($chk) {
        $db->where('field', 'header_config_json')->update('settings', ['value' => $json_value]);
    } else {
        $db->insert('settings', ['field' => 'header_config_json', 'value' => $json_value]);
    }

    // Sync individual fields for backward compatibility
    $syncFields = [
        'phone_one'    => $config['phone_one'],
        'phone_two'    => $config['phone_two'],
        'email'        => $config['helpline_email'],
        'facebook'     => $config['facebook_url'],
        'twitter'      => $config['twitter_url'],
        'erp_login'    => $config['erp_student_url'],
    ];
    foreach ($syncFields as $f => $v) {
        $ex = $db->where('field', $f)->getOne('settings');
        if ($ex) {
            $db->where('field', $f)->update('settings', ['value' => $v]);
        } else {
            $db->insert('settings', ['field' => $f, 'value' => $v]);
        }
    }

    $_SESSION['success'] = 'Header & Navigation Menu saved successfully and updated live!';
    redirect(PAGE);
}

// 2. Load Configuration
$hc = getHeaderConfig();
$currPage = 'header_settings.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Admin Panel</title>
<?php include_once("inc.meta.php"); ?>
<style>
.bu-header-mgr-card {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  background: #ffffff;
  margin-bottom: 30px;
}
.bu-mgr-hero {
  background: linear-gradient(135deg, #0A1B54 0%, #153280 100%);
  color: #ffffff;
  padding: 24px 30px;
  border-radius: 12px 12px 0 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}
.bu-mgr-hero h3 {
  margin: 0;
  font-size: 20px;
  font-weight: 700;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 10px;
}
.bu-mgr-hero p {
  margin: 5px 0 0;
  font-size: 13px;
  color: rgba(255,255,255,0.75);
}
.bu-tabs-nav {
  background: #f1f5f9;
  padding: 12px 20px;
  border-bottom: 2px solid #e2e8f0;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}
.bu-tab-btn {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font-weight: 700;
  font-size: 13px;
  color: #334155;
  padding: 10px 18px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  outline: none;
}
.bu-tab-btn:hover {
  background: #e2e8f0;
  color: #0A1B54;
}
.bu-tab-btn.active {
  background: #0A1B54 !important;
  color: #FFC107 !important;
  border-color: #0A1B54 !important;
  box-shadow: 0 4px 12px rgba(10, 27, 84, 0.28);
}
.bu-tab-pane {
  display: none;
  padding: 24px;
}
.bu-tab-pane.active {
  display: block !important;
}

/* WordPress-style Menu Manager Styles */
.wp-menu-builder {
  display: flex;
  gap: 25px;
  align-items: flex-start;
}
@media (max-width: 991px) {
  .wp-menu-builder {
    flex-direction: column;
  }
}
.wp-menu-sidebar {
  width: 320px;
  flex-shrink: 0;
}
.wp-menu-main {
  flex-grow: 1;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 20px;
  min-height: 400px;
}
.wp-panel-card {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  margin-bottom: 16px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.wp-panel-header {
  background: #f1f5f9;
  padding: 12px 16px;
  font-weight: 700;
  font-size: 13.5px;
  color: #1e293b;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
}
.wp-panel-body {
  padding: 16px;
}
.wp-menu-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: 15px;
  min-height: 50px;
}
.wp-menu-item {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
  user-select: none;
}
.wp-menu-item.dragging {
  opacity: 0.5;
  border: 2px dashed #0A1B54;
  background: #e0f2fe;
}
.wp-menu-item.drag-over {
  border-top: 3px solid #FFC107;
}
.wp-item-bar {
  padding: 12px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: grab;
  background: #ffffff;
  border-radius: 6px;
}
.wp-item-bar:hover {
  background: #f8fafc;
}
.wp-item-title-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
  font-weight: 700;
  font-size: 13.5px;
  color: #0f172a;
}
.wp-drag-handle {
  color: #94a3b8;
  cursor: grab;
  font-size: 16px;
}
.wp-drag-handle:hover {
  color: #0A1B54;
}
.wp-item-type-badge {
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 4px;
  background: #e2e8f0;
  color: #475569;
  font-weight: 600;
}
.wp-item-type-badge.builtin {
  background: #dbeafe;
  color: #1e40af;
}
.wp-item-type-badge.custom {
  background: #fef3c7;
  color: #92400e;
}
.wp-item-controls {
  display: flex;
  align-items: center;
  gap: 6px;
}
.wp-btn-ctrl {
  background: transparent;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  padding: 4px 8px;
  font-size: 11px;
  color: #64748b;
  cursor: pointer;
  transition: all 0.2s;
}
.wp-btn-ctrl:hover {
  background: #0A1B54;
  color: #ffffff;
  border-color: #0A1B54;
}
.wp-btn-expand {
  border: none;
  background: none;
  font-size: 14px;
  color: #64748b;
  cursor: pointer;
  padding: 4px 8px;
  transition: transform 0.2s;
}
.wp-menu-item.expanded .wp-btn-expand {
  transform: rotate(180deg);
}
.wp-item-details {
  display: none;
  padding: 16px;
  background: #f8fafc;
  border-top: 1px solid #e2e8f0;
  border-radius: 0 0 6px 6px;
}
.wp-menu-item.expanded .wp-item-details {
  display: block;
}
.wp-item-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 12px;
  padding-top: 10px;
  border-top: 1px solid #e2e8f0;
}
.wp-btn-delete {
  color: #dc2626;
  background: none;
  border: none;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  padding: 0;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.wp-btn-delete:hover {
  text-decoration: underline;
  color: #991b1b;
}

/* Section Title & Save Bar */
.bu-section-title {
  font-size: 15px;
  font-weight: 700;
  color: #0A1B54;
  margin: 15px 0 12px 0;
  padding-bottom: 6px;
  border-bottom: 2px solid #FFC107;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-form-group {
  margin-bottom: 16px;
}
.bu-form-group label {
  font-weight: 600;
  font-size: 12.5px;
  color: #1e293b;
  margin-bottom: 5px;
  display: block;
}
.bu-form-group .form-control {
  border-radius: 6px;
  border: 1px solid #cbd5e1;
  font-size: 13px;
  padding: 8px 12px;
}
.bu-form-group .form-control:focus {
  border-color: #0A1B54;
  box-shadow: 0 0 0 2px rgba(10, 27, 84, 0.1);
}
.bu-toggle-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 12px 16px;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.bu-toggle-card .info {
  display: flex;
  flex-direction: column;
}
.bu-toggle-card .title {
  font-weight: 700;
  font-size: 13px;
  color: #0f172a;
}
.bu-toggle-card .desc {
  font-size: 11.5px;
  color: #64748b;
  margin-top: 2px;
}
.bu-save-bar {
  position: sticky;
  bottom: 0;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  border-top: 1px solid #e2e8f0;
  padding: 15px 30px;
  margin: 0 -25px -25px -25px;
  border-radius: 0 0 12px 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 100;
}
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row pt-3 pb-2">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><i class="mdi mdi-page-layout-header text-warning"></i> <?php echo TITLE; ?></h4>
            </div>
          </div>
        </div>

        <?php if (!empty($stat)) echo msg($stat); ?>

        <form action="" method="post" id="headerSettingsForm" onsubmit="serializeAllMenus();">
          
          <!-- Hidden JSON fields to transmit reordered & edited menus -->
          <input type="hidden" name="main_nav_items_json" id="main_nav_items_json" value="">
          <input type="hidden" name="top_quick_links_json" id="top_quick_links_json" value="">
          <input type="hidden" name="erp_links_json" id="erp_links_json" value="">

          <div class="bu-header-mgr-card">
            
            <!-- Hero Top -->
            <div class="bu-mgr-hero">
              <div>
                <h3><i class="fa fa-sliders text-warning"></i> Header &amp; Menu Drag &amp; Drop Visual Manager</h3>
                <p>Add, edit, delete, and drag &amp; drop to reorder Main Navigation Tabs, Top Quick Links, and ERP Logins like WordPress.</p>
              </div>
              <div>
                <a href="<?php echo URL_ROOT; ?>" target="_blank" class="btn btn-sm btn-outline-light font-weight-bold">
                  <i class="fa fa-external-link mr-1"></i> View Live Website
                </a>
              </div>
            </div>

            <!-- Interactive Tab Navigation -->
            <div class="bu-tabs-nav" id="headerTabs">
              <button type="button" class="bu-tab-btn active" data-tab="tab-mainnav" onclick="switchHeaderTab('tab-mainnav');">
                <i class="fa fa-compass"></i> 1. Main Navigation Menu
              </button>
              <button type="button" class="bu-tab-btn" data-tab="tab-topbar" onclick="switchHeaderTab('tab-topbar');">
                <i class="fa fa-bars"></i> 2. Top Bar Quick Links
              </button>
              <button type="button" class="bu-tab-btn" data-tab="tab-erp" onclick="switchHeaderTab('tab-erp');">
                <i class="fa fa-user-circle"></i> 3. ERP Logins Dropdown
              </button>
              <button type="button" class="bu-tab-btn" data-tab="tab-brand" onclick="switchHeaderTab('tab-brand');">
                <i class="fa fa-id-card-o"></i> 4. Brand &amp; Apply Buttons
              </button>
              <button type="button" class="bu-tab-btn" data-tab="tab-social" onclick="switchHeaderTab('tab-social');">
                <i class="fa fa-share-alt"></i> 5. Contacts &amp; Social Media
              </button>
            </div>

            <!-- Tab Content -->
            <div class="bu-tabs-wrapper" id="headerTabsContent">
              
              <!-- ========================================================
                   TAB 1: MAIN NAVIGATION MENU (WORDPRESS BUILDER)
                   ======================================================== -->
              <div class="bu-tab-pane active" id="tab-mainnav">
                
                <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center justify-content-between">
                  <div>
                    <i class="fa fa-info-circle mr-1"></i> <strong>WordPress Menu System:</strong> Drag and drop any item below to change its sequence on the header. Click an item to edit label, target route, or delete it.
                  </div>
                  <span class="badge badge-primary">Dynamic Header Sync</span>
                </div>

                <div class="wp-menu-builder">
                  
                  <!-- Left: Add Menu Items -->
                  <div class="wp-menu-sidebar">
                    
                    <!-- Custom Link Card -->
                    <div class="wp-panel-card">
                      <div class="wp-panel-header">
                        <span><i class="fa fa-link text-primary mr-1"></i> Add Custom Link</span>
                      </div>
                      <div class="wp-panel-body">
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Link URL / Route</label>
                          <input type="text" id="add_nav_url" class="form-control form-control-sm" placeholder="https://... or page.php?id=10">
                        </div>
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Navigation Label</label>
                          <input type="text" id="add_nav_label" class="form-control form-control-sm" placeholder="e.g. Convocation 2026">
                        </div>
                        <div class="form-group mb-3">
                          <label class="small font-weight-bold mb-1">Target Window</label>
                          <select id="add_nav_target" class="form-control form-control-sm">
                            <option value="_self">Same Window (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                          </select>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary btn-block font-weight-bold" onclick="addCustomNavItem();">
                          <i class="fa fa-plus-circle mr-1"></i> Add to Menu
                        </button>
                      </div>
                    </div>

                    <!-- Built-in Preset Dropdowns -->
                    <div class="wp-panel-card">
                      <div class="wp-panel-header">
                        <span><i class="fa fa-th-list text-success mr-1"></i> Built-in Mega Dropdowns</span>
                      </div>
                      <div class="wp-panel-body">
                        <p class="small text-muted mb-2">Quickly re-add any standard multi-column mega menu:</p>
                        <select id="add_nav_preset" class="form-control form-control-sm mb-3">
                          <option value="about|About|about.php">About Us (2-Column Mega Menu)</option>
                          <option value="institutes|Institutes|institutes.php">Institutes (DB Dynamic Dropdown)</option>
                          <option value="programmes|Programmes|programmes.php">Programmes (5 Degree Levels)</option>
                          <option value="academics|Academics & Exams|#">Academics & Exams (2-Column)</option>
                          <option value="research|Research|research.php">Research (2-Column Labs & Innovation)</option>
                          <option value="admissions|Admissions|enquiry.php">Admissions (2-Column Portal)</option>
                          <option value="placements|T&P Cell|placements.php">T&P Placement Cell (Recruiters)</option>
                          <option value="news|News & Media|news.php">News & Media (Events & Notices)</option>
                          <option value="contact|Contact|contact.php">Contact Us (Direct Link)</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-success btn-block font-weight-bold" onclick="addPresetNavItem();">
                          <i class="fa fa-plus-circle mr-1"></i> Add Selected Dropdown
                        </button>
                      </div>
                    </div>

                  </div>

                  <!-- Right: Menu Structure List -->
                  <div class="wp-menu-main">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                      <div>
                        <h6 class="font-weight-bold text-dark mb-0"><i class="fa fa-bars mr-1"></i> Main Navigation Structure</h6>
                        <small class="text-muted">Drag items or use the Up/Down buttons to reorder.</small>
                      </div>
                      <span class="badge badge-dark" id="main_nav_count">0 Items</span>
                    </div>

                    <div class="wp-menu-list" id="main_nav_list">
                      <!-- Rendered dynamically by JavaScript -->
                    </div>
                  </div>

                </div>

              </div>

              <!-- ========================================================
                   TAB 2: TOP BAR QUICK LINKS (WORDPRESS BUILDER)
                   ======================================================== -->
              <div class="bu-tab-pane" id="tab-topbar">
                
                <div class="alert alert-info py-2 px-3 mb-3">
                  <i class="fa fa-info-circle mr-1"></i> <strong>Desktop Top Strip Links:</strong> Manage, reorder, add, and remove links displayed along the top bar on desktop and inside the mobile info drawer.
                </div>

                <div class="wp-menu-builder">
                  
                  <!-- Left: Add Top Quick Link -->
                  <div class="wp-menu-sidebar">
                    <div class="wp-panel-card">
                      <div class="wp-panel-header">
                        <span><i class="fa fa-link text-primary mr-1"></i> Add Top Bar Link</span>
                      </div>
                      <div class="wp-panel-body">
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Link URL / Route</label>
                          <input type="text" id="add_top_url" class="form-control form-control-sm" placeholder="alumni.php or https://...">
                        </div>
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Display Text</label>
                          <input type="text" id="add_top_label" class="form-control form-control-sm" placeholder="e.g. Careers / Jobs">
                        </div>
                        <div class="form-group mb-3">
                          <label class="small font-weight-bold mb-1">Target Window</label>
                          <select id="add_top_target" class="form-control form-control-sm">
                            <option value="_self">Same Window (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                          </select>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary btn-block font-weight-bold" onclick="addTopQuickLink();">
                          <i class="fa fa-plus-circle mr-1"></i> Add to Top Bar
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Right: Top Quick Links List -->
                  <div class="wp-menu-main">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                      <div>
                        <h6 class="font-weight-bold text-dark mb-0"><i class="fa fa-list mr-1"></i> Top Utility Bar Quick Links</h6>
                        <small class="text-muted">Drag items or use the Up/Down buttons to reorder.</small>
                      </div>
                      <span class="badge badge-dark" id="top_quick_count">0 Items</span>
                    </div>

                    <div class="wp-menu-list" id="top_quick_list">
                      <!-- Rendered dynamically by JavaScript -->
                    </div>
                  </div>

                </div>

              </div>

              <!-- ========================================================
                   TAB 3: ERP LOGINS DROPDOWN (WORDPRESS BUILDER)
                   ======================================================== -->
              <div class="bu-tab-pane" id="tab-erp">
                
                <div class="bu-toggle-card mb-4">
                  <div class="info">
                    <span class="title">Show ERP Login Dropdown on Top Bar</span>
                    <span class="desc">Enable or disable the golden ERP Login dropdown on the top utility bar</span>
                  </div>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="show_erp_dropdown" name="show_erp_dropdown" value="1" <?php echo ($hc['show_erp_dropdown'] == '1') ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="show_erp_dropdown"></label>
                  </div>
                </div>

                <div class="wp-menu-builder">
                  
                  <!-- Left: Add ERP Login Link -->
                  <div class="wp-menu-sidebar">
                    <div class="wp-panel-card">
                      <div class="wp-panel-header">
                        <span><i class="fa fa-user-circle text-warning mr-1"></i> Add ERP Portal Link</span>
                      </div>
                      <div class="wp-panel-body">
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Login Portal URL</label>
                          <input type="text" id="add_erp_url" class="form-control form-control-sm" placeholder="https://bhabha.accsofterp.com/...">
                        </div>
                        <div class="form-group mb-2">
                          <label class="small font-weight-bold mb-1">Portal Label</label>
                          <input type="text" id="add_erp_label" class="form-control form-control-sm" placeholder="e.g. Admission ERP Login">
                        </div>
                        <div class="form-group mb-3">
                          <label class="small font-weight-bold mb-1">Icon Class</label>
                          <input type="text" id="add_erp_icon" class="form-control form-control-sm" value="fa fa-graduation-cap" placeholder="fa fa-graduation-cap">
                        </div>
                        <button type="button" class="btn btn-sm btn-warning font-weight-bold btn-block" onclick="addErpLink();">
                          <i class="fa fa-plus-circle mr-1"></i> Add to ERP Menu
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Right: ERP Links List -->
                  <div class="wp-menu-main">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                      <div>
                        <h6 class="font-weight-bold text-dark mb-0"><i class="fa fa-graduation-cap mr-1"></i> ERP Logins Menu Structure</h6>
                        <small class="text-muted">Items inside the golden ERP dropdown.</small>
                      </div>
                      <span class="badge badge-warning" id="erp_links_count">0 Items</span>
                    </div>

                    <div class="wp-menu-list" id="erp_links_list">
                      <!-- Rendered dynamically by JavaScript -->
                    </div>
                  </div>

                </div>

              </div>

              <!-- ========================================================
                   TAB 4: BRAND IDENTITY & APPLY BUTTONS
                   ======================================================== -->
              <div class="bu-tab-pane" id="tab-brand">
                <div class="row">
                  
                  <!-- Left: Brand Logo & Title -->
                  <div class="col-lg-6">
                    <div class="bu-section-title"><i class="fa fa-university"></i> Brand Identity</div>
                    
                    <div class="bu-form-group">
                      <label>Main Brand Word 1</label>
                      <input type="text" name="brand_name_1" class="form-control font-weight-bold" value="<?php echo htmlspecialchars($hc['brand_name_1']); ?>" placeholder="BHABHA">
                      <small class="text-muted">Displayed in bold lettering.</small>
                    </div>

                    <div class="bu-form-group">
                      <label>Main Brand Word 2</label>
                      <input type="text" name="brand_name_2" class="form-control" value="<?php echo htmlspecialchars($hc['brand_name_2']); ?>" placeholder="UNIVERSITY">
                    </div>

                    <div class="bu-form-group">
                      <label>Header Emblem / Logo File Name</label>
                      <input type="text" name="brand_logo" class="form-control" value="<?php echo htmlspecialchars($hc['brand_logo']); ?>" placeholder="bhabha-university-logo-hd.png?v=20260926">
                      <small class="text-muted">Relative to <code>img/</code> directory or absolute URL.</small>
                    </div>

                    <div class="p-3 bg-light rounded text-center my-3 border">
                      <img src="<?php echo URL_IMG . $hc['brand_logo']; ?>" alt="Logo Preview" style="max-height: 60px; max-width: 100%;" onerror="this.src='<?php echo URL_IMG; ?>logo.png'">
                      <div class="mt-2 font-weight-bold text-primary"><?php echo htmlspecialchars($hc['brand_name_1'] . ' ' . $hc['brand_name_2']); ?></div>
                    </div>
                  </div>

                  <!-- Right: Apply Buttons Configuration -->
                  <div class="col-lg-6">
                    <div class="bu-section-title"><i class="fa fa-paper-plane"></i> Apply Button Configuration</div>
                    
                    <!-- Desktop Apply Button -->
                    <div class="card p-3 border mb-3">
                      <h6 class="font-weight-bold text-dark"><i class="fa fa-desktop mr-1"></i> Desktop Main Navbar Apply Button</h6>
                      
                      <div class="bu-toggle-card my-2">
                        <div class="info">
                          <span class="title">Show Desktop Apply Button</span>
                          <span class="desc">Display the yellow Apply button on desktop navbar</span>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="apply_btn_show" name="apply_btn_show" value="1" <?php echo ($hc['apply_btn_show'] == '1') ? 'checked' : ''; ?>>
                          <label class="custom-control-label" for="apply_btn_show"></label>
                        </div>
                      </div>

                      <div class="bu-form-group">
                        <label>Desktop Button Label</label>
                        <input type="text" name="apply_btn_text" class="form-control font-weight-bold" value="<?php echo htmlspecialchars($hc['apply_btn_text']); ?>" placeholder="Apply">
                      </div>

                      <div class="bu-form-group">
                        <label>Desktop Button Target URL</label>
                        <input type="text" name="apply_btn_url" class="form-control" value="<?php echo htmlspecialchars($hc['apply_btn_url']); ?>" placeholder="enquiry.php">
                      </div>
                    </div>

                    <!-- Mobile Topbar Apply Badge -->
                    <div class="card p-3 border">
                      <h6 class="font-weight-bold text-dark"><i class="fa fa-mobile mr-1"></i> Mobile Topbar Small Apply Button</h6>
                      
                      <div class="bu-toggle-card my-2">
                        <div class="info">
                          <span class="title">Pulse / Blink Animation</span>
                          <span class="desc">Subtle attention-grabbing pulse on mobile top bar</span>
                        </div>
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="apply_top_blink" name="apply_top_blink" value="1" <?php echo ($hc['apply_top_blink'] == '1') ? 'checked' : ''; ?>>
                          <label class="custom-control-label" for="apply_top_blink"></label>
                        </div>
                      </div>

                      <div class="bu-form-group">
                        <label>Mobile Button Label</label>
                        <input type="text" name="apply_top_text" class="form-control font-weight-bold" value="<?php echo htmlspecialchars($hc['apply_top_text']); ?>" placeholder="Apply Now">
                      </div>

                      <div class="bu-form-group">
                        <label>Mobile Button Target URL</label>
                        <input type="text" name="apply_top_url" class="form-control" value="<?php echo htmlspecialchars($hc['apply_top_url']); ?>" placeholder="enquiry.php">
                      </div>
                    </div>

                  </div>

                </div>
              </div>

              <!-- ========================================================
                   TAB 5: CONTACTS & SOCIAL MEDIA
                   ======================================================== -->
              <div class="bu-tab-pane" id="tab-social">
                <div class="row">
                  
                  <!-- Left: Contact Details -->
                  <div class="col-lg-6">
                    <div class="bu-section-title"><i class="fa fa-phone"></i> Helpline &amp; Contacts</div>
                    
                    <div class="bu-toggle-card">
                      <div class="info">
                        <span class="title">Show Topbar Phone Number</span>
                        <span class="desc">Display phone contact on top utility bar</span>
                      </div>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="show_top_contacts" name="show_top_contacts" value="1" <?php echo ($hc['show_top_contacts'] == '1') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="show_top_contacts"></label>
                      </div>
                    </div>

                    <div class="bu-form-group">
                      <label>Primary Phone Number</label>
                      <input type="text" name="phone_one" class="form-control font-weight-bold" value="<?php echo htmlspecialchars($hc['phone_one']); ?>" placeholder="0755-4246498">
                    </div>

                    <div class="bu-form-group">
                      <label>Secondary / Admission Helpline Phone</label>
                      <input type="text" name="phone_two" class="form-control" value="<?php echo htmlspecialchars($hc['phone_two']); ?>" placeholder="+91 755 4936800">
                    </div>

                    <div class="bu-form-group">
                      <label>Official Helpline Email</label>
                      <input type="email" name="helpline_email" class="form-control" value="<?php echo htmlspecialchars($hc['helpline_email']); ?>" placeholder="info@bhabhauniversity.edu.in">
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-whatsapp text-success mr-1"></i> WhatsApp Helpline Number / Link</label>
                      <input type="text" name="whatsapp_num" class="form-control" value="<?php echo htmlspecialchars($hc['whatsapp_num']); ?>" placeholder="+917554936800">
                    </div>
                  </div>

                  <!-- Right: Social Media Profiles -->
                  <div class="col-lg-6">
                    <div class="bu-section-title"><i class="fa fa-share-alt"></i> Official Social Media Profiles</div>
                    
                    <div class="bu-toggle-card">
                      <div class="info">
                        <span class="title">Show Social Media Icons</span>
                        <span class="desc">Display Facebook, Instagram, Twitter, YouTube, LinkedIn buttons on topbar</span>
                      </div>
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="show_social_links" name="show_social_links" value="1" <?php echo ($hc['show_social_links'] == '1') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="show_social_links"></label>
                      </div>
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-facebook-official text-primary mr-1"></i> Facebook Page URL</label>
                      <input type="text" name="facebook_url" class="form-control" value="<?php echo htmlspecialchars($hc['facebook_url']); ?>" placeholder="https://www.facebook.com/...">
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-instagram text-danger mr-1"></i> Instagram Profile URL</label>
                      <input type="text" name="instagram_url" class="form-control" value="<?php echo htmlspecialchars($hc['instagram_url']); ?>" placeholder="https://www.instagram.com/...">
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-twitter text-info mr-1"></i> Twitter / X Profile URL</label>
                      <input type="text" name="twitter_url" class="form-control" value="<?php echo htmlspecialchars($hc['twitter_url']); ?>" placeholder="https://twitter.com/...">
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-youtube-play text-danger mr-1"></i> YouTube Channel URL</label>
                      <input type="text" name="youtube_url" class="form-control" value="<?php echo htmlspecialchars($hc['youtube_url']); ?>" placeholder="https://www.youtube.com/...">
                    </div>

                    <div class="bu-form-group">
                      <label><i class="fa fa-linkedin-square text-primary mr-1"></i> LinkedIn Company Profile URL</label>
                      <input type="text" name="linkedin_url" class="form-control" value="<?php echo htmlspecialchars($hc['linkedin_url']); ?>" placeholder="https://in.linkedin.com/...">
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- Sticky Save Bar -->
            <div class="bu-save-bar">
              <div>
                <a href="dashboard.php" class="btn btn-outline-secondary font-weight-bold">
                  <i class="fa fa-arrow-left mr-1"></i> Back to Dashboard
                </a>
              </div>
              <div class="d-flex align-items-center gap-2">
                <button type="submit" name="save_header_settings" class="btn btn-success font-weight-bold px-4 shadow-sm" style="background:#059669; border-color:#059669;">
                  <i class="fa fa-check-circle mr-1"></i> Save &amp; Apply Live Changes
                </button>
              </div>
            </div>

          </div>

        </form>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>

<script>
// Initial Data loaded from PHP
var mainNavData = <?php echo json_encode($hc['main_nav_items']); ?> || [];
var topQuickData = <?php echo json_encode($hc['top_quick_links']); ?> || [];
var erpLinksData = <?php echo json_encode($hc['erp_links']); ?> || [];

// 1. Tab Switcher
function switchHeaderTab(tabId) {
  if (!tabId) return;
  document.querySelectorAll('.bu-tab-btn').forEach(function(btn) {
    if (btn.getAttribute('data-tab') === tabId) {
      btn.classList.add('active');
    } else {
      btn.classList.remove('active');
    }
  });
  document.querySelectorAll('.bu-tab-pane').forEach(function(pane) {
    if (pane.id === tabId) {
      pane.style.display = 'block';
      pane.classList.add('active');
    } else {
      pane.style.display = 'none';
      pane.classList.remove('active');
    }
  });
  if (window.history && window.history.replaceState) {
    window.history.replaceState(null, null, '#' + tabId);
  }
}

// 2. Render Main Nav Items
function renderMainNav() {
  var container = document.getElementById('main_nav_list');
  var countBadge = document.getElementById('main_nav_count');
  if (!container) return;
  container.innerHTML = '';
  countBadge.innerText = mainNavData.length + ' Items';

  if (mainNavData.length === 0) {
    container.innerHTML = '<div class="text-muted text-center py-4">No menu items. Add items from the left sidebar.</div>';
    return;
  }

  mainNavData.forEach(function(item, index) {
    var isBuiltin = (item.type && item.type !== 'custom');
    var badgeClass = isBuiltin ? 'builtin' : 'custom';
    var badgeText = isBuiltin ? ('Mega Menu: ' + item.type.toUpperCase()) : 'Custom Link';
    var isChecked = (!item.hasOwnProperty('show') || item.show === '1' || item.show === 1);

    var card = document.createElement('div');
    card.className = 'wp-menu-item';
    card.setAttribute('draggable', 'true');
    card.setAttribute('data-index', index);

    card.innerHTML = `
      <div class="wp-item-bar">
        <div class="wp-item-title-wrap">
          <span class="wp-drag-handle" title="Drag to reorder"><i class="fa fa-bars"></i></span>
          <span class="wp-item-label-preview" id="main_preview_${index}">${escapeHtml(item.label || 'Menu Item')}</span>
          <span class="wp-item-type-badge ${badgeClass}">${badgeText}</span>
        </div>
        <div class="wp-item-controls">
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(mainNavData, ${index}, -1, renderMainNav);" title="Move Up"><i class="fa fa-arrow-up"></i></button>
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(mainNavData, ${index}, 1, renderMainNav);" title="Move Down"><i class="fa fa-arrow-down"></i></button>
          <button type="button" class="wp-btn-expand" onclick="toggleExpand(this);"><i class="fa fa-chevron-down"></i></button>
        </div>
      </div>
      <div class="wp-item-details">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Navigation Label</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.label || '')}" oninput="updateItemLabel(mainNavData, ${index}, this.value, 'main_preview_${index}');">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Target URL / Route</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.url || '')}" oninput="mainNavData[${index}].url = this.value;" ${isBuiltin ? 'readonly style="background:#f1f5f9;"' : ''}>
              ${isBuiltin ? '<small class="text-muted">Built-in routes manage their own mega dropdowns.</small>' : ''}
            </div>
          </div>
        </div>
        <div class="wp-item-actions">
          <div class="d-flex align-items-center gap-3">
            <label class="small font-weight-bold mb-0 mr-2">
              <input type="checkbox" onchange="mainNavData[${index}].show = this.checked ? '1' : '0';" ${isChecked ? 'checked' : ''}> Show in Header
            </label>
            <label class="small mb-0 ml-3">
              <input type="checkbox" onchange="mainNavData[${index}].target = this.checked ? '_blank' : '_self';" ${item.target === '_blank' ? 'checked' : ''}> Open in New Tab
            </label>
          </div>
          <button type="button" class="wp-btn-delete" onclick="deleteItem(mainNavData, ${index}, renderMainNav);"><i class="fa fa-trash"></i> Remove</button>
        </div>
      </div>
    `;

    setupDragEvents(card, mainNavData, renderMainNav);
    container.appendChild(card);
  });
}

// 3. Render Top Quick Links
function renderTopQuick() {
  var container = document.getElementById('top_quick_list');
  var countBadge = document.getElementById('top_quick_count');
  if (!container) return;
  container.innerHTML = '';
  countBadge.innerText = topQuickData.length + ' Items';

  topQuickData.forEach(function(item, index) {
    var isChecked = (!item.hasOwnProperty('show') || item.show === '1' || item.show === 1);
    var card = document.createElement('div');
    card.className = 'wp-menu-item';
    card.setAttribute('draggable', 'true');
    card.setAttribute('data-index', index);

    card.innerHTML = `
      <div class="wp-item-bar">
        <div class="wp-item-title-wrap">
          <span class="wp-drag-handle"><i class="fa fa-bars"></i></span>
          <span class="wp-item-label-preview" id="top_preview_${index}">${escapeHtml(item.label || 'Link')}</span>
          <span class="wp-item-type-badge custom">Top Quick Link</span>
        </div>
        <div class="wp-item-controls">
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(topQuickData, ${index}, -1, renderTopQuick);"><i class="fa fa-arrow-up"></i></button>
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(topQuickData, ${index}, 1, renderTopQuick);"><i class="fa fa-arrow-down"></i></button>
          <button type="button" class="wp-btn-expand" onclick="toggleExpand(this);"><i class="fa fa-chevron-down"></i></button>
        </div>
      </div>
      <div class="wp-item-details">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Display Text</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.label || '')}" oninput="updateItemLabel(topQuickData, ${index}, this.value, 'top_preview_${index}');">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">URL / Route</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.url || '')}" oninput="topQuickData[${index}].url = this.value;">
            </div>
          </div>
        </div>
        <div class="wp-item-actions">
          <div class="d-flex align-items-center">
            <label class="small font-weight-bold mb-0 mr-3">
              <input type="checkbox" onchange="topQuickData[${index}].show = this.checked ? '1' : '0';" ${isChecked ? 'checked' : ''}> Show on Top Bar
            </label>
            <label class="small mb-0 ml-3">
              <input type="checkbox" onchange="topQuickData[${index}].target = this.checked ? '_blank' : '_self';" ${item.target === '_blank' ? 'checked' : ''}> Open New Tab
            </label>
          </div>
          <button type="button" class="wp-btn-delete" onclick="deleteItem(topQuickData, ${index}, renderTopQuick);"><i class="fa fa-trash"></i> Remove</button>
        </div>
      </div>
    `;

    setupDragEvents(card, topQuickData, renderTopQuick);
    container.appendChild(card);
  });
}

// 4. Render ERP Links
function renderErpLinks() {
  var container = document.getElementById('erp_links_list');
  var countBadge = document.getElementById('erp_links_count');
  if (!container) return;
  container.innerHTML = '';
  countBadge.innerText = erpLinksData.length + ' Items';

  erpLinksData.forEach(function(item, index) {
    var isChecked = (!item.hasOwnProperty('show') || item.show === '1' || item.show === 1);
    var card = document.createElement('div');
    card.className = 'wp-menu-item';
    card.setAttribute('draggable', 'true');
    card.setAttribute('data-index', index);

    card.innerHTML = `
      <div class="wp-item-bar">
        <div class="wp-item-title-wrap">
          <span class="wp-drag-handle"><i class="fa fa-bars"></i></span>
          <span class="wp-item-label-preview" id="erp_preview_${index}"><i class="${escapeHtml(item.icon || 'fa fa-link')} text-warning mr-1"></i> ${escapeHtml(item.label || 'Login Portal')}</span>
          <span class="wp-item-type-badge builtin">ERP Portal</span>
        </div>
        <div class="wp-item-controls">
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(erpLinksData, ${index}, -1, renderErpLinks);"><i class="fa fa-arrow-up"></i></button>
          <button type="button" class="wp-btn-ctrl" onclick="moveItem(erpLinksData, ${index}, 1, renderErpLinks);"><i class="fa fa-arrow-down"></i></button>
          <button type="button" class="wp-btn-expand" onclick="toggleExpand(this);"><i class="fa fa-chevron-down"></i></button>
        </div>
      </div>
      <div class="wp-item-details">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Portal Label</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.label || '')}" oninput="erpLinksData[${index}].label = this.value; document.getElementById('erp_preview_${index}').innerHTML = '<i class=\\'${escapeHtml(item.icon || 'fa fa-link')} text-warning mr-1\\'></i> ' + escapeHtml(this.value);">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Portal Login URL</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.url || '')}" oninput="erpLinksData[${index}].url = this.value;">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group mb-2">
              <label class="small font-weight-bold mb-1">Icon</label>
              <input type="text" class="form-control form-control-sm" value="${escapeHtml(item.icon || 'fa fa-link')}" oninput="erpLinksData[${index}].icon = this.value;">
            </div>
          </div>
        </div>
        <div class="wp-item-actions">
          <div>
            <label class="small font-weight-bold mb-0">
              <input type="checkbox" onchange="erpLinksData[${index}].show = this.checked ? '1' : '0';" ${isChecked ? 'checked' : ''}> Show in Dropdown
            </label>
          </div>
          <button type="button" class="wp-btn-delete" onclick="deleteItem(erpLinksData, ${index}, renderErpLinks);"><i class="fa fa-trash"></i> Remove</button>
        </div>
      </div>
    `;

    setupDragEvents(card, erpLinksData, renderErpLinks);
    container.appendChild(card);
  });
}

// 5. Add Functions
function addCustomNavItem() {
  var url = document.getElementById('add_nav_url').value.trim();
  var label = document.getElementById('add_nav_label').value.trim();
  var target = document.getElementById('add_nav_target').value;
  if (!label) {
    alert('Please enter a Navigation Label.');
    return;
  }
  mainNavData.push({
    id: 'c_' + Date.now(),
    type: 'custom',
    label: label,
    url: url || '#',
    target: target || '_self',
    show: '1'
  });
  document.getElementById('add_nav_url').value = '';
  document.getElementById('add_nav_label').value = '';
  renderMainNav();
}

function addPresetNavItem() {
  var val = document.getElementById('add_nav_preset').value.split('|');
  var type = val[0];
  var label = val[1];
  var url = val[2];
  mainNavData.push({
    id: 'p_' + Date.now(),
    type: type,
    label: label,
    url: url,
    target: '_self',
    show: '1'
  });
  renderMainNav();
}

function addTopQuickLink() {
  var url = document.getElementById('add_top_url').value.trim();
  var label = document.getElementById('add_top_label').value.trim();
  var target = document.getElementById('add_top_target').value;
  if (!label) {
    alert('Please enter a display text.');
    return;
  }
  topQuickData.push({
    id: 't_' + Date.now(),
    label: label,
    url: url || '#',
    target: target || '_self',
    show: '1'
  });
  document.getElementById('add_top_url').value = '';
  document.getElementById('add_top_label').value = '';
  renderTopQuick();
}

function addErpLink() {
  var url = document.getElementById('add_erp_url').value.trim();
  var label = document.getElementById('add_erp_label').value.trim();
  var icon = document.getElementById('add_erp_icon').value.trim() || 'fa fa-link';
  if (!label) {
    alert('Please enter a portal label.');
    return;
  }
  erpLinksData.push({
    id: 'e_' + Date.now(),
    label: label,
    url: url || '#',
    icon: icon,
    show: '1'
  });
  document.getElementById('add_erp_url').value = '';
  document.getElementById('add_erp_label').value = '';
  renderErpLinks();
}

// Helper Functions
function toggleExpand(btn) {
  var card = btn.closest('.wp-menu-item');
  card.classList.toggle('expanded');
}

function updateItemLabel(array, index, val, previewId) {
  array[index].label = val;
  var elem = document.getElementById(previewId);
  if (elem) elem.innerText = val || '(Untitled)';
}

function moveItem(array, index, direction, renderFn) {
  var newIndex = index + direction;
  if (newIndex < 0 || newIndex >= array.length) return;
  var temp = array[index];
  array[index] = array[newIndex];
  array[newIndex] = temp;
  renderFn();
}

function deleteItem(array, index, renderFn) {
  if (confirm('Are you sure you want to remove "' + (array[index].label || 'this item') + '" from the menu?')) {
    array.splice(index, 1);
    renderFn();
  }
}

// Drag & Drop Reordering
var dragSrcIndex = null;
function setupDragEvents(card, array, renderFn) {
  card.addEventListener('dragstart', function(e) {
    dragSrcIndex = parseInt(this.getAttribute('data-index'));
    this.classList.add('dragging');
    e.dataTransfer.effectAllowed = 'move';
  });

  card.addEventListener('dragover', function(e) {
    if (e.preventDefault) e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
    this.classList.add('drag-over');
    return false;
  });

  card.addEventListener('dragleave', function() {
    this.classList.remove('drag-over');
  });

  card.addEventListener('dragend', function() {
    this.classList.remove('dragging');
    document.querySelectorAll('.wp-menu-item').forEach(function(el) {
      el.classList.remove('drag-over');
    });
  });

  card.addEventListener('drop', function(e) {
    if (e.stopPropagation) e.stopPropagation();
    var targetIndex = parseInt(this.getAttribute('data-index'));
    if (dragSrcIndex !== null && dragSrcIndex !== targetIndex) {
      var item = array.splice(dragSrcIndex, 1)[0];
      array.splice(targetIndex, 0, item);
      renderFn();
    }
    return false;
  });
}

function escapeHtml(str) {
  if (!str) return '';
  return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

// Serialize on Form Submit
function serializeAllMenus() {
  document.getElementById('main_nav_items_json').value = JSON.stringify(mainNavData);
  document.getElementById('top_quick_links_json').value = JSON.stringify(topQuickData);
  document.getElementById('erp_links_json').value = JSON.stringify(erpLinksData);
}

// Init on DOM ready
document.addEventListener('DOMContentLoaded', function() {
  renderMainNav();
  renderTopQuick();
  renderErpLinks();

  // URL Hash
  var hash = window.location.hash.replace('#', '');
  if (hash && document.getElementById(hash)) {
    switchHeaderTab(hash);
  } else {
    switchHeaderTab('tab-mainnav');
  }
});
</script>
</body>
</html>
