<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'],'index.php');

$stat = array();
$action = $_GET['action'] ?? '';
define("PAGE", 'research.php');
define("TITLE", 'Research & Innovation Portal');
define("DBTAB", 'research_portal');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Icon normalizer helper
if (!function_exists('normFa')) {
    function normFa($icon) {
        $icon = trim($icon);
        if (empty($icon)) return 'fa fa-circle';
        if (strpos($icon, 'fa ') !== 0 && strpos($icon, 'fas ') !== 0 && strpos($icon, 'far ') !== 0 && strpos($icon, 'fab ') !== 0) {
            return 'fa ' . (strpos($icon, 'fa-') === 0 ? $icon : 'fa-' . $icon);
        }
        return $icon;
    }
}

// Handle Form Submission
if (isset($_POST['submit'])) {
    $secId = intval($_POST['id'] ?? 0);
    $db->where('id', $secId);
    $existing = $db->getOne(DBTAB);

    if (!$existing) {
        $_SESSION['error'] = 'Section not found.';
        redirect(PAGE);
    }

    $secKey = $existing['section_key'];

    // Common fields
    $data = [
        'badge_text' => trim($_POST['badge_text'] ?? ''),
        'badge_icon' => normFa($_POST['badge_icon'] ?? ''),
        'heading'    => trim($_POST['heading'] ?? ''),
        'subheading' => trim($_POST['subheading'] ?? ''),
        'status'     => isset($_POST['status']) ? intval($_POST['status']) : 1
    ];

    // Handle Media File Upload if present
    if (!empty($_FILES['media_file']['name'])) {
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'pdf', 'mp4'];
        $ext = strtolower(pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExts)) {
            $uploadDir = '../upload/media/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = 'research_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['media_file']['tmp_name'], $uploadDir . $fileName)) {
                $data['media_url'] = 'upload/media/' . $fileName;
            }
        }
    } elseif (!empty($_POST['media_url'])) {
        $data['media_url'] = trim($_POST['media_url']);
    }

    $extra = !empty($existing['extra_data']) ? json_decode($existing['extra_data'], true) : [];

    // Section-specific extra_data construction
    if ($secKey == 'hero') {
        // Actions
        $actions = [];
        $actTexts = $_POST['hero_act_text'] ?? [];
        $actUrls  = $_POST['hero_act_url'] ?? [];
        $actIcons = $_POST['hero_act_icon'] ?? [];
        $actStyles= $_POST['hero_act_style'] ?? [];
        for ($i = 0; $i < count($actTexts); $i++) {
            if (!empty($actTexts[$i])) {
                $actions[] = [
                    'text'  => trim($actTexts[$i]),
                    'url'   => trim($actUrls[$i] ?? ''),
                    'icon'  => normFa($actIcons[$i] ?? 'fa fa-link'),
                    'style' => trim($actStyles[$i] ?? 'outline')
                ];
            }
        }

        // Milestones
        $milestones = [];
        $msNums   = $_POST['hero_ms_num'] ?? [];
        $msPrefix = $_POST['hero_ms_prefix'] ?? [];
        $msSuffix = $_POST['hero_ms_suffix'] ?? [];
        $msLabels = $_POST['hero_ms_lbl'] ?? [];
        for ($i = 0; $i < 4; $i++) {
            $tVal = isset($msNums[$i]) ? intval(preg_replace('/[^0-9]/', '', (string)$msNums[$i])) : 0;
            $sfx  = trim($msSuffix[$i] ?? '');
            $pfx  = trim($msPrefix[$i] ?? '');
            $lbl  = trim($msLabels[$i] ?? '');
            $milestones[] = [
                'target' => $tVal,
                'value'  => (string)$tVal,
                'suffix' => $sfx,
                'prefix' => $pfx,
                'commas' => ($tVal >= 1000),
                'label'  => $lbl
            ];
        }

        $extra['actions'] = $actions;
        $extra['milestones'] = $milestones;
        $extra['milestones_title'] = trim($_POST['hero_ms_title'] ?? 'Research Milestones at a Glance');

        // Also sync homepage_sections metrics so home page stays in sync!
        $db->where('section_key', 'research_innovation');
        $homeSec = $db->getOne('homepage_sections');
        if ($homeSec) {
            $homeExtra = !empty($homeSec['extra_data']) ? json_decode($homeSec['extra_data'], true) : [];
            $homeExtra['metrics'] = $milestones;
            $db->where('id', $homeSec['id']);
            $db->update('homepage_sections', [
                'extra_data' => json_encode($homeExtra, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            ]);
        }

    } elseif ($secKey == 'pharmacy_labs') {
        $extra['certified_badge'] = trim($_POST['pharm_cert_badge'] ?? 'Certified Facility');

        // Certifications
        $certs = [];
        $certTitles = $_POST['pharm_cert_title'] ?? [];
        $certSubs   = $_POST['pharm_cert_sub'] ?? [];
        $certIcons  = $_POST['pharm_cert_icon'] ?? [];
        $certThemes = $_POST['pharm_cert_theme'] ?? ['fssai', 'msme', 'gumasta', 'gmp'];
        for ($i = 0; $i < 4; $i++) {
            $certs[] = [
                'title'    => trim($certTitles[$i] ?? ''),
                'subtitle' => trim($certSubs[$i] ?? ''),
                'icon'     => normFa($certIcons[$i] ?? 'fa fa-check-circle'),
                'theme'    => trim($certThemes[$i] ?? 'fssai')
            ];
        }
        $extra['certifications'] = $certs;

        // Stats
        $stats = [];
        $statVals   = $_POST['pharm_stat_val'] ?? [];
        $statLbls   = $_POST['pharm_stat_lbl'] ?? [];
        $statIcons  = $_POST['pharm_stat_icon'] ?? [];
        $statColors = $_POST['pharm_stat_color'] ?? ['#059669', '#2563EB', '#D97706', '#7C3AED'];
        $statBgs    = $_POST['pharm_stat_bg'] ?? ['#ECFDF5', '#EFF6FF', '#FEF3C7', '#F5F3FF'];
        for ($i = 0; $i < 4; $i++) {
            $stats[] = [
                'val'   => trim($statVals[$i] ?? ''),
                'lbl'   => trim($statLbls[$i] ?? ''),
                'icon'  => normFa($statIcons[$i] ?? 'fa fa-cubes'),
                'color' => trim($statColors[$i] ?? '#059669'),
                'bg'    => trim($statBgs[$i] ?? '#ECFDF5')
            ];
        }
        $extra['stats'] = $stats;

    } elseif ($secKey == 'launched_products') {
        $products = [];
        $pNames     = $_POST['prod_name'] ?? [];
        $pSubtitles = $_POST['prod_sub'] ?? [];
        $pDescs     = $_POST['prod_desc'] ?? [];
        $pIcons     = $_POST['prod_icon'] ?? [];
        $pBadgeLs   = $_POST['prod_badge_l'] ?? [];
        $pBadgeRs   = $_POST['prod_badge_r'] ?? [];
        $pLabs      = $_POST['prod_lab'] ?? [];
        $pSpec1Lbl  = $_POST['prod_spec1_lbl'] ?? [];
        $pSpec1Val  = $_POST['prod_spec1_val'] ?? [];
        $pSpec2Lbl  = $_POST['prod_spec2_lbl'] ?? [];
        $pSpec2Val  = $_POST['prod_spec2_val'] ?? [];
        $pSpec3Lbl  = $_POST['prod_spec3_lbl'] ?? [];
        $pSpec3Val  = $_POST['prod_spec3_val'] ?? [];

        for ($i = 0; $i < count($pNames); $i++) {
            if (!empty(trim($pNames[$i]))) {
                $products[] = [
                    'name'        => trim($pNames[$i]),
                    'subtitle'    => trim($pSubtitles[$i] ?? ''),
                    'desc'        => trim($pDescs[$i] ?? ''),
                    'icon'        => normFa($pIcons[$i] ?? 'fa fa-cube'),
                    'image'       => '',
                    'badge_left'  => trim($pBadgeLs[$i] ?? '15 Aug Launch'),
                    'badge_right' => trim($pBadgeRs[$i] ?? 'FSSAI Approved'),
                    'specs'       => [
                        ['label' => trim($pSpec1Lbl[$i] ?? 'Category:'), 'value' => trim($pSpec1Val[$i] ?? '')],
                        ['label' => trim($pSpec2Lbl[$i] ?? 'Flavour:'),  'value' => trim($pSpec2Val[$i] ?? '')],
                        ['label' => trim($pSpec3Lbl[$i] ?? 'Registration:'), 'value' => trim($pSpec3Val[$i] ?? '')]
                    ],
                    'lab'         => trim($pLabs[$i] ?? 'Bhabha Pharmacy Research Labs')
                ];
            }
        }
        $extra['products'] = $products;

    } elseif ($secKey == 'incubation_edc') {
        $boxes = [];
        $bTitles  = $_POST['inc_title'] ?? [];
        $bIcons   = $_POST['inc_icon'] ?? [];
        $bDescs   = $_POST['inc_desc'] ?? [];
        $bBullets1 = $_POST['inc_bullet1'] ?? [];
        $bBullets2 = $_POST['inc_bullet2'] ?? [];
        $bBullets3 = $_POST['inc_bullet3'] ?? [];

        for ($i = 0; $i < 2; $i++) {
            $boxes[] = [
                'title' => trim($bTitles[$i] ?? ''),
                'icon'  => normFa($bIcons[$i] ?? 'fa fa-industry'),
                'desc'  => trim($bDescs[$i] ?? ''),
                'bullets' => array_filter([
                    trim($bBullets1[$i] ?? ''),
                    trim($bBullets2[$i] ?? ''),
                    trim($bBullets3[$i] ?? '')
                ])
            ];
        }
        $extra['boxes'] = $boxes;

    } elseif ($secKey == 'research_domains') {
        $domains = [];
        $dTitles = $_POST['dom_title'] ?? [];
        $dIcons  = $_POST['dom_icon'] ?? [];
        $dUrls   = $_POST['dom_url'] ?? [];

        for ($i = 0; $i < count($dTitles); $i++) {
            if (!empty(trim($dTitles[$i]))) {
                $domains[] = [
                    'title' => trim($dTitles[$i]),
                    'icon'  => normFa($dIcons[$i] ?? 'fa fa-compass'),
                    'url'   => trim($dUrls[$i] ?? '')
                ];
            }
        }
        $extra['domains'] = $domains;

    } elseif ($secKey == 'patents_publications') {
        $extra['tab1_title'] = trim($_POST['tab1_title'] ?? 'Patent Filing Records');
        $extra['tab1_desc']  = trim($_POST['tab1_desc'] ?? 'Official patent applications submitted by university faculty and researchers.');
        $extra['tab1_tag']   = trim($_POST['tab1_tag'] ?? 'Format: IPO Indian Patent Office');
        $extra['tab1_empty'] = trim($_POST['tab1_empty'] ?? 'Official patent filing data will be updated upon departmental submission.');

        $extra['tab2_title'] = trim($_POST['tab2_title'] ?? 'Research Paper List');
        $extra['tab2_desc']  = trim($_POST['tab2_desc'] ?? 'Papers indexed in Scopus, SCIE, UGC Care Group I & II, and PubMed journals.');
        $extra['tab2_tag']   = trim($_POST['tab2_tag'] ?? 'Indexed Repository');
        $extra['tab2_empty'] = trim($_POST['tab2_empty'] ?? 'Official publications list will be updated upon departmental submission.');

        $extra['tab3_title'] = trim($_POST['tab3_title'] ?? 'Books & Chapters Published');
        $extra['tab3_desc']  = trim($_POST['tab3_desc'] ?? 'Authored reference textbooks and chapters published by recognized national and international publishers.');
        $extra['tab3_empty'] = trim($_POST['tab3_empty'] ?? 'Official authored books and chapters records will be updated upon departmental submission.');

    } elseif ($secKey == 'media_publications') {
        $cards = [];
        $cTitles   = $_POST['media_title'] ?? [];
        $cIcons    = $_POST['media_icon'] ?? [];
        $cDescs    = $_POST['media_desc'] ?? [];
        $cBtnTexts = $_POST['media_btn_text'] ?? [];
        $cBtnUrls  = $_POST['media_btn_url'] ?? [];
        $cBtnIcons = $_POST['media_btn_icon'] ?? [];

        for ($i = 0; $i < count($cTitles); $i++) {
            if (!empty(trim($cTitles[$i]))) {
                $cards[] = [
                    'title'    => trim($cTitles[$i]),
                    'icon'     => normFa($cIcons[$i] ?? 'fa fa-book'),
                    'desc'     => trim($cDescs[$i] ?? ''),
                    'btn_text' => trim($cBtnTexts[$i] ?? 'Read More'),
                    'btn_url'  => trim($cBtnUrls[$i] ?? '#'),
                    'btn_icon' => normFa($cBtnIcons[$i] ?? 'fa fa-arrow-right')
                ];
            }
        }
        $extra['cards'] = $cards;
    }

    $data['extra_data'] = json_encode($extra, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $db->where('id', $secId);
    $db->update(DBTAB, $data);

    $_SESSION['success'] = 'Section "' . $existing['section_name'] . '" updated successfully!';
    redirect(PAGE);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title><?php echo TITLE; ?> - Admin Dashboard</title>
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
<style>
.help-tip { font-size: 11px; color: #6c757d; display: block; margin-top: 4px; }
.card-section-box {
  background: #ffffff;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}
.simple-card-group {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 18px 20px;
  margin-bottom: 22px;
}
.simple-card-title {
  font-size: 14px;
  font-weight: 700;
  color: #0A1B54;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 2px solid #E2E8F0;
  padding-bottom: 8px;
}
.simple-item-box {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 14px;
  height: 100%;
}
.badge-active { background-color: #28a745; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; }
.badge-inactive { background-color: #dc3545; color: #fff; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; }
@keyframes cardFadeIn {
  from { opacity: 0; transform: translateY(12px); }
  to { opacity: 1; transform: translateY(0); }
}
.product-card-col {
  animation: cardFadeIn 0.3s ease-out;
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
        
        <!-- Top Header & Breadcrumb -->
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
              <h4 class="page-title"><i class="mdi mdi-flask-outline"></i> <?php echo TITLE; ?> (research.php)</h4>
              <div>
                <a href="../research/" target="_blank" class="btn btn-outline-primary btn-sm">
                  <i class="fa fa-external-link"></i> View Live Page
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification Alerts -->
        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-check-circle"></i> <?php echo $stat['success']; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-exclamation-circle"></i> <?php echo $stat['error']; ?>
          </div>
        <?php endif; ?>

        <!-- =========================================================
             1. EDIT VIEW
             ========================================================= -->
        <?php if ($action == 'edit' && !empty($_GET['id'])): 
          $secId = intval($_GET['id']);
          $db->where('id', $secId);
          $secData = $db->getOne(DBTAB);
          if (!$secData) {
              echo '<div class="alert alert-danger">Section not found.</div>';
          } else {
              $extra = !empty($secData['extra_data']) ? json_decode($secData['extra_data'], true) : [];
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h4 class="mt-0 header-title text-primary">
                    <i class="fa fa-pencil-square-o"></i> Edit Section: <strong><?php echo htmlspecialchars($secData['section_name']); ?></strong>
                  </h4>
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to All Sections
                  </a>
                </div>

                <form method="post" enctype="multipart/form-data" action="<?php echo PAGE; ?>">
                  <input type="hidden" name="id" value="<?php echo $secData['id']; ?>">

                  <!-- Core Section Details -->
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label>Section Badge / Label</label>
                      <input type="text" name="badge_text" class="form-control" value="<?php echo htmlspecialchars($secData['badge_text']); ?>" placeholder="e.g. CENTRE OF EXCELLENCE">
                      <small class="help-tip">Small pill badge shown above main heading</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Badge Icon Class</label>
                      <input type="text" name="badge_icon" class="form-control" value="<?php echo htmlspecialchars($secData['badge_icon']); ?>" placeholder="fa fa-flask">
                      <small class="help-tip">FontAwesome icon (e.g. <code>fa fa-flask</code>, <code>fa fa-rocket</code>)</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Section Status</label>
                      <select name="status" class="form-control">
                        <option value="1" <?php echo ($secData['status'] == 1) ? 'selected' : ''; ?>>Active (Visible on Page)</option>
                        <option value="0" <?php echo ($secData['status'] == 0) ? 'selected' : ''; ?>>Inactive (Hidden from Page)</option>
                      </select>
                      <small class="help-tip">Toggle to show or hide this section on research.php</small>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Main Heading</label>
                    <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($secData['heading']); ?>" placeholder="e.g. Products Developed & <em>Launched</em>">
                    <small class="help-tip">Supports HTML tags like <code>&lt;em&gt;</code> for gold italic styling and <code>&lt;br&gt;</code> for line breaks</small>
                  </div>

                  <div class="form-group">
                    <label>Section Subheading / Description</label>
                    <textarea name="subheading" class="form-control" rows="3"><?php echo htmlspecialchars($secData['subheading']); ?></textarea>
                    <small class="help-tip">Introductory paragraph displayed beneath the main heading</small>
                  </div>

                  <!-- ============================================== -->
                  <!-- 1. HERO BANNER SPECIFIC CONTROLS                -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'hero'): 
                    $actions = !empty($extra['actions']) ? $extra['actions'] : [];
                    $milestones = !empty($extra['milestones']) ? $extra['milestones'] : [];
                  ?>
                  <!-- Hero Quick Actions -->
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-mouse-pointer"></i> Quick Jump Action Buttons (3 Buttons)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 3; $i++): 
                        $act = $actions[$i] ?? ['text' => '', 'url' => '', 'icon' => 'fa fa-link', 'style' => 'outline'];
                      ?>
                      <div class="col-md-4 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Button #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Button Label</small>
                            <input type="text" name="hero_act_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($act['text']); ?>" placeholder="e.g. Launched Products">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Anchor / URL</small>
                            <input type="text" name="hero_act_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($act['url']); ?>" placeholder="#launched-products">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Icon Class</small>
                            <input type="text" name="hero_act_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($act['icon']); ?>" placeholder="fa fa-cube">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Visual Style</small>
                            <select name="hero_act_style[]" class="form-control form-control-sm">
                              <option value="gold" <?php echo ($act['style'] == 'gold') ? 'selected' : ''; ?>>Gold Button</option>
                              <option value="outline" <?php echo ($act['style'] == 'outline') ? 'selected' : ''; ?>>White Outline Button</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>

                  <!-- Hero Milestones Grid -->
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-line-chart"></i> Research Milestones Card (4 Counters)
                    </div>
                    <div class="form-group mb-3">
                      <label>Milestones Card Title</label>
                      <input type="text" name="hero_ms_title" class="form-control" value="<?php echo htmlspecialchars($extra['milestones_title'] ?? 'Research Milestones at a Glance'); ?>">
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $m = $milestones[$i] ?? ['target' => '', 'suffix' => '', 'prefix' => '', 'label' => ''];
                        $mVal = !empty($m['target']) ? $m['target'] : ($m['value'] ?? '');
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Milestone #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Number</small>
                            <input type="text" name="hero_ms_num[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mVal); ?>" placeholder="e.g. 250">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Prefix (e.g. ₹)</small>
                            <input type="text" name="hero_ms_prefix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['prefix'] ?? ''); ?>" placeholder="₹">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Suffix (e.g. + or Cr)</small>
                            <input type="text" name="hero_ms_suffix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['suffix'] ?? ''); ?>" placeholder="+">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Milestone Label</small>
                            <input type="text" name="hero_ms_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['label'] ?? ''); ?>" placeholder="Patents Filed">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                    <small class="text-muted"><i class="fa fa-info-circle"></i> Saving these 4 milestones automatically synchronizes with the Homepage Research section counters.</small>
                  </div>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 2. PHARMACY LABS SPECIFIC CONTROLS              -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'pharmacy_labs'): 
                    $certs = !empty($extra['certifications']) ? $extra['certifications'] : [];
                    $stats = !empty($extra['stats']) ? $extra['stats'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-certificate"></i> Certified Facility Badge &amp; Regulatory Approvals
                    </div>
                    <div class="form-group mb-3">
                      <label>Top Right Badge</label>
                      <input type="text" name="pharm_cert_badge" class="form-control" value="<?php echo htmlspecialchars($extra['certified_badge'] ?? 'Certified Facility'); ?>" placeholder="Certified Facility">
                    </div>
                    <label class="font-weight-bold text-muted mb-2">4 Regulatory Accreditations</label>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $c = $certs[$i] ?? ['title' => '', 'subtitle' => '', 'icon' => 'fa fa-check-circle', 'theme' => 'fssai'];
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Approval #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Title</small>
                            <input type="text" name="pharm_cert_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['title']); ?>" placeholder="e.g. FSSAI Approved">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Subtitle / Authority</small>
                            <input type="text" name="pharm_cert_sub[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['subtitle']); ?>" placeholder="Food Safety Authority">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Icon Class</small>
                            <input type="text" name="pharm_cert_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['icon']); ?>" placeholder="fa fa-check-circle">
                          </div>
                          <input type="hidden" name="pharm_cert_theme[]" value="<?php echo htmlspecialchars($c['theme'] ?? 'fssai'); ?>">
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>

                  <!-- Lab Stats Row -->
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-cubes"></i> 4 Pharmacy Lab Stat Highlights
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $st = $stats[$i] ?? ['val' => '', 'lbl' => '', 'icon' => 'fa fa-flask', 'color' => '#059669', 'bg' => '#ECFDF5'];
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Lab Stat #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Value</small>
                            <input type="text" name="pharm_stat_val[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['val']); ?>" placeholder="e.g. 3+ or 100%">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Label</small>
                            <input type="text" name="pharm_stat_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['lbl']); ?>" placeholder="Commercial Products">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Icon Class</small>
                            <input type="text" name="pharm_stat_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['icon']); ?>" placeholder="fa fa-cubes">
                          </div>
                          <input type="hidden" name="pharm_stat_color[]" value="<?php echo htmlspecialchars($st['color'] ?? '#059669'); ?>">
                          <input type="hidden" name="pharm_stat_bg[]" value="<?php echo htmlspecialchars($st['bg'] ?? '#ECFDF5'); ?>">
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 3. LAUNCHED PRODUCTS SPECIFIC CONTROLS          -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'launched_products'): 
                    $products = !empty($extra['products']) ? $extra['products'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div>
                        <div class="simple-card-title mb-1" style="border-bottom:none; padding-bottom:0;">
                          <i class="fa fa-rocket text-primary"></i> Commercial Products Formulated &amp; Launched
                        </div>
                        <p class="small text-muted mb-0">Manage, add, and remove products commercially developed by Bhabha Pharmacy Research Laboratories.</p>
                      </div>
                      <button type="button" class="btn btn-success btn-sm font-weight-bold shadow-sm" id="btn-add-product">
                        <i class="fa fa-plus-circle"></i> + Add New Product
                      </button>
                    </div>

                    <div id="products-container" class="row">
                      <?php for ($i = 0; $i < count($products); $i++): 
                        $p = $products[$i];
                      ?>
                      <div class="col-md-4 mb-4 product-card-col">
                        <div class="simple-item-box" style="border-top: 3px solid #0A1B54; position:relative;">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-primary prod-badge-number">Product #<?php echo $i + 1; ?></span>
                            <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 remove-product-btn" title="Remove Product">
                              <i class="fa fa-trash"></i> Delete
                            </button>
                          </div>
                          
                          <div class="form-group mb-2">
                            <label class="font-weight-bold">Product Title</label>
                            <input type="text" name="prod_name[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['name']); ?>" placeholder="e.g. Dextro Zing (Jeera)">
                          </div>

                          <div class="form-group mb-2">
                            <label class="font-weight-bold">Category / Subtitle</label>
                            <input type="text" name="prod_sub[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['subtitle']); ?>" placeholder="e.g. Nutraceutical Formulation">
                          </div>

                          <div class="form-group mb-2">
                            <label class="font-weight-bold">Short Description</label>
                            <textarea name="prod_desc[]" class="form-control form-control-sm" rows="3" placeholder="Product description..."><?php echo htmlspecialchars($p['desc']); ?></textarea>
                          </div>

                          <div class="row mb-2">
                            <div class="col-6">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="prod_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['icon']); ?>" placeholder="fa fa-coffee">
                            </div>
                            <div class="col-6">
                              <small class="text-muted">Launch Badge</small>
                              <input type="text" name="prod_badge_l[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['badge_left']); ?>" placeholder="15 Aug Launch">
                            </div>
                          </div>

                          <div class="form-group mb-2">
                            <small class="text-muted">Approval Status Badge</small>
                            <input type="text" name="prod_badge_r[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['badge_right']); ?>" placeholder="FSSAI Approved">
                          </div>

                          <div style="background:#F1F5F9; padding:8px; border-radius:6px; margin-bottom:10px;">
                            <label class="small font-weight-bold text-dark mb-1">Specifications</label>
                            <div class="form-row mb-1">
                              <div class="col-5">
                                <input type="text" name="prod_spec1_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][0]['label'] ?? 'Category:'); ?>" placeholder="Label">
                              </div>
                              <div class="col-7">
                                <input type="text" name="prod_spec1_val[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][0]['value'] ?? ''); ?>" placeholder="Value">
                              </div>
                            </div>
                            <div class="form-row mb-1">
                              <div class="col-5">
                                <input type="text" name="prod_spec2_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][1]['label'] ?? 'Flavour:'); ?>" placeholder="Label">
                              </div>
                              <div class="col-7">
                                <input type="text" name="prod_spec2_val[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][1]['value'] ?? ''); ?>" placeholder="Value">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="col-5">
                                <input type="text" name="prod_spec3_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][2]['label'] ?? 'Registration:'); ?>" placeholder="Label">
                              </div>
                              <div class="col-7">
                                <input type="text" name="prod_spec3_val[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['specs'][2]['value'] ?? ''); ?>" placeholder="Value">
                              </div>
                            </div>
                          </div>

                          <div class="form-group mb-0">
                            <small class="text-muted">Lab Attribution</small>
                            <input type="text" name="prod_lab[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['lab']); ?>" placeholder="Bhabha Pharmacy Research Labs">
                          </div>

                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <!-- Add New Product Button Bottom Bar -->
                    <div class="text-center py-3 mt-2" style="background:#f8fafc; border:2px dashed #cbd5e1; border-radius:8px;">
                      <button type="button" class="btn btn-outline-success font-weight-bold px-4" id="btn-add-product-bottom">
                        <i class="fa fa-plus-circle"></i> + Add Another Product Card
                      </button>
                    </div>
                  </div>

                  <!-- Template for new product clone -->
                  <template id="product-card-template">
                    <div class="col-md-4 mb-4 product-card-col">
                      <div class="simple-item-box" style="border-top: 3px solid #28a745; position:relative; animation:fadeIn 0.3s ease;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <span class="badge badge-success prod-badge-number">Product #NEW</span>
                          <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 remove-product-btn" title="Remove Product">
                            <i class="fa fa-trash"></i> Delete
                          </button>
                        </div>
                        
                        <div class="form-group mb-2">
                          <label class="font-weight-bold">Product Title</label>
                          <input type="text" name="prod_name[]" class="form-control form-control-sm" value="" placeholder="e.g. New Formulation / Tonic">
                        </div>

                        <div class="form-group mb-2">
                          <label class="font-weight-bold">Category / Subtitle</label>
                          <input type="text" name="prod_sub[]" class="form-control form-control-sm" value="" placeholder="e.g. Healthcare Formulation">
                        </div>

                        <div class="form-group mb-2">
                          <label class="font-weight-bold">Short Description</label>
                          <textarea name="prod_desc[]" class="form-control form-control-sm" rows="3" placeholder="Describe the product, formula, or active ingredients..."></textarea>
                        </div>

                        <div class="row mb-2">
                          <div class="col-6">
                            <small class="text-muted">Icon Class</small>
                            <input type="text" name="prod_icon[]" class="form-control form-control-sm" value="fa fa-cube" placeholder="fa fa-cube">
                          </div>
                          <div class="col-6">
                            <small class="text-muted">Launch Badge</small>
                            <input type="text" name="prod_badge_l[]" class="form-control form-control-sm" value="New Launch" placeholder="New Launch">
                          </div>
                        </div>

                        <div class="form-group mb-2">
                          <small class="text-muted">Approval Status Badge</small>
                          <input type="text" name="prod_badge_r[]" class="form-control form-control-sm" value="FSSAI Approved" placeholder="FSSAI Approved">
                        </div>

                        <div style="background:#F1F5F9; padding:8px; border-radius:6px; margin-bottom:10px;">
                          <label class="small font-weight-bold text-dark mb-1">Specifications</label>
                          <div class="form-row mb-1">
                            <div class="col-5">
                              <input type="text" name="prod_spec1_lbl[]" class="form-control form-control-sm" value="Category:" placeholder="Label">
                            </div>
                            <div class="col-7">
                              <input type="text" name="prod_spec1_val[]" class="form-control form-control-sm" value="" placeholder="e.g. Dietary Supplement">
                            </div>
                          </div>
                          <div class="form-row mb-1">
                            <div class="col-5">
                              <input type="text" name="prod_spec2_lbl[]" class="form-control form-control-sm" value="Testing:" placeholder="Label">
                            </div>
                            <div class="col-7">
                              <input type="text" name="prod_spec2_val[]" class="form-control form-control-sm" value="" placeholder="e.g. Lab Certified">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-5">
                              <input type="text" name="prod_spec3_lbl[]" class="form-control form-control-sm" value="Registration:" placeholder="Label">
                            </div>
                            <div class="col-7">
                              <input type="text" name="prod_spec3_val[]" class="form-control form-control-sm" value="FSSAI / MSME Approved" placeholder="Value">
                            </div>
                          </div>
                        </div>

                        <div class="form-group mb-0">
                          <small class="text-muted">Lab Attribution</small>
                          <input type="text" name="prod_lab[]" class="form-control form-control-sm" value="Bhabha Pharmacy Research Labs" placeholder="Bhabha Pharmacy Research Labs">
                        </div>

                      </div>
                    </div>
                  </template>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 4. INCUBATION & EDC SPECIFIC CONTROLS           -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'incubation_edc'): 
                    $boxes = !empty($extra['boxes']) ? $extra['boxes'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-building"></i> Incubation Centre &amp; EDC Feature Cards (2 Cards)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 2; $i++): 
                        $b = $boxes[$i] ?? ['title' => '', 'icon' => 'fa fa-building', 'desc' => '', 'bullets' => ['', '', '']];
                        $blts = $b['bullets'] ?? ['', '', ''];
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box" style="border-top: 3px solid #0A1B54;">
                          <label class="text-primary font-weight-bold">Card #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <label>Card Title</label>
                            <input type="text" name="inc_title[]" class="form-control" value="<?php echo htmlspecialchars($b['title']); ?>" placeholder="e.g. University / Industrial Incubation Centre">
                          </div>
                          <div class="form-group mb-2">
                            <label>Icon Class</label>
                            <input type="text" name="inc_icon[]" class="form-control" value="<?php echo htmlspecialchars($b['icon']); ?>" placeholder="fa fa-industry">
                          </div>
                          <div class="form-group mb-2">
                            <label>Overview Description</label>
                            <textarea name="inc_desc[]" class="form-control" rows="3"><?php echo htmlspecialchars($b['desc']); ?></textarea>
                          </div>
                          <label class="small font-weight-bold text-muted mb-1">Key Highlights (3 Bullet Points)</label>
                          <div class="form-group mb-1">
                            <input type="text" name="inc_bullet1[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($blts[0] ?? ''); ?>" placeholder="Bullet point #1">
                          </div>
                          <div class="form-group mb-1">
                            <input type="text" name="inc_bullet2[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($blts[1] ?? ''); ?>" placeholder="Bullet point #2">
                          </div>
                          <div class="form-group mb-0">
                            <input type="text" name="inc_bullet3[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($blts[2] ?? ''); ?>" placeholder="Bullet point #3">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 5. RESEARCH PILLARS & DOMAINS SPECIFIC CONTROLS -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'research_domains'): 
                    $domains = !empty($extra['domains']) ? $extra['domains'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-sitemap"></i> Academic Framework &amp; Research Pillars (13 Items)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < count($domains); $i++): 
                        $dom = $domains[$i] ?? ['title' => '', 'icon' => 'fa fa-compass', 'url' => ''];
                      ?>
                      <div class="col-md-4 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <div class="d-flex justify-content-between mb-1">
                            <span class="badge badge-light">Item #<?php echo $i + 1; ?></span>
                            <i class="<?php echo htmlspecialchars($dom['icon']); ?> text-primary"></i>
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Title</small>
                            <input type="text" name="dom_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($dom['title']); ?>" placeholder="Domain Title">
                          </div>
                          <div class="row mb-0">
                            <div class="col-6">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="dom_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($dom['icon']); ?>" placeholder="fa fa-compass">
                            </div>
                            <div class="col-6">
                              <small class="text-muted">Link / PDF (Opt.)</small>
                              <input type="text" name="dom_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($dom['url']); ?>" placeholder="URL or #">
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 6. PATENTS & PAPERS SPECIFIC CONTROLS           -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'patents_publications'): ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-database"></i> Scholarly Records &amp; Tables Controls
                    </div>
                    
                    <!-- TAB 1 -->
                    <div class="simple-item-box mb-3">
                      <label class="text-primary font-weight-bold"><i class="fa fa-lightbulb-o"></i> Tab 1: Patent Filing Records</label>
                      <div class="row">
                        <div class="col-md-4">
                          <label class="small text-muted">Tab Button Title</label>
                          <input type="text" name="tab1_title" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab1_title'] ?? 'Patent Filing Records'); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="small text-muted">Badge Tag</label>
                          <input type="text" name="tab1_tag" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab1_tag'] ?? 'Format: IPO Indian Patent Office'); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="small text-muted">Tab Subtitle Description</label>
                          <input type="text" name="tab1_desc" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab1_desc'] ?? 'Official patent applications submitted by university faculty and researchers.'); ?>">
                        </div>
                        <div class="col-12 mt-2">
                          <label class="small text-muted">Notice / Empty-State Message</label>
                          <input type="text" name="tab1_empty" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab1_empty'] ?? 'Official patent filing data will be updated upon departmental submission.'); ?>">
                        </div>
                      </div>
                    </div>

                    <!-- TAB 2 -->
                    <div class="simple-item-box mb-3">
                      <label class="text-primary font-weight-bold"><i class="fa fa-file-text-o"></i> Tab 2: Research Paper List</label>
                      <div class="row">
                        <div class="col-md-4">
                          <label class="small text-muted">Tab Button Title</label>
                          <input type="text" name="tab2_title" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab2_title'] ?? 'Research Paper List'); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="small text-muted">Badge Tag</label>
                          <input type="text" name="tab2_tag" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab2_tag'] ?? 'Indexed Repository'); ?>">
                        </div>
                        <div class="col-md-4">
                          <label class="small text-muted">Tab Subtitle Description</label>
                          <input type="text" name="tab2_desc" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab2_desc'] ?? 'Papers indexed in Scopus, SCIE, UGC Care Group I & II, and PubMed journals.'); ?>">
                        </div>
                        <div class="col-12 mt-2">
                          <label class="small text-muted">Notice / Empty-State Message</label>
                          <input type="text" name="tab2_empty" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab2_empty'] ?? 'Official publications list will be updated upon departmental submission.'); ?>">
                        </div>
                      </div>
                    </div>

                    <!-- TAB 3 -->
                    <div class="simple-item-box">
                      <label class="text-primary font-weight-bold"><i class="fa fa-book"></i> Tab 3: Books &amp; Chapters Published</label>
                      <div class="row">
                        <div class="col-md-6">
                          <label class="small text-muted">Tab Button Title</label>
                          <input type="text" name="tab3_title" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab3_title'] ?? 'Books & Chapters Published'); ?>">
                        </div>
                        <div class="col-md-6">
                          <label class="small text-muted">Tab Subtitle Description</label>
                          <input type="text" name="tab3_desc" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab3_desc'] ?? 'Authored reference textbooks and chapters published by recognized national and international publishers.'); ?>">
                        </div>
                        <div class="col-12 mt-2">
                          <label class="small text-muted">Notice / Empty-State Message</label>
                          <input type="text" name="tab3_empty" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['tab3_empty'] ?? 'Official authored books and chapters records will be updated upon departmental submission.'); ?>">
                        </div>
                      </div>
                    </div>

                  </div>
                  <?php endif; ?>

                  <!-- ============================================== -->
                  <!-- 7. PUBLICATIONS & MEDIA SPECIFIC CONTROLS       -->
                  <!-- ============================================== -->
                  <?php if ($secData['section_key'] == 'media_publications'): 
                    $cards = !empty($extra['cards']) ? $extra['cards'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-newspaper-o"></i> E-Newsletter, Magazine &amp; Blogs (3 Cards)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 3; $i++): 
                        $mc = $cards[$i] ?? ['title' => '', 'icon' => 'fa fa-book', 'desc' => '', 'btn_text' => 'Read More', 'btn_url' => '#', 'btn_icon' => 'fa fa-arrow-right'];
                      ?>
                      <div class="col-md-4 mb-3">
                        <div class="simple-item-box" style="border-top: 3px solid #D99B00;">
                          <label class="text-primary font-weight-bold">Card #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <small class="text-muted">Card Title</small>
                            <input type="text" name="media_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mc['title']); ?>" placeholder="e.g. E-Newsletter">
                          </div>
                          <div class="form-group mb-2">
                            <small class="text-muted">Icon Class</small>
                            <input type="text" name="media_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mc['icon']); ?>" placeholder="fa fa-envelope-open-o">
                          </div>
                          <div class="form-group mb-2">
                            <small class="text-muted">Short Description</small>
                            <textarea name="media_desc[]" class="form-control form-control-sm" rows="3"><?php echo htmlspecialchars($mc['desc']); ?></textarea>
                          </div>
                          <div class="form-group mb-2">
                            <small class="text-muted">Button Text</small>
                            <input type="text" name="media_btn_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mc['btn_text']); ?>" placeholder="View Newsletters">
                          </div>
                          <div class="row mb-0">
                            <div class="col-7">
                              <small class="text-muted">Button Link / URL</small>
                              <input type="text" name="media_btn_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mc['btn_url']); ?>" placeholder="newsletter.php">
                            </div>
                            <div class="col-5">
                              <small class="text-muted">Button Icon</small>
                              <input type="text" name="media_btn_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mc['btn_icon']); ?>" placeholder="fa fa-newspaper-o">
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <div class="mt-4 text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                      <i class="fa fa-save"></i> Save Changes
                    </button>
                    <a href="<?php echo PAGE; ?>" class="btn btn-secondary btn-lg ml-2">
                      Cancel
                    </a>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <!-- =========================================================
             2. LIST VIEW (ALL 7 SECTIONS)
             ========================================================= -->
        <?php else: 
          $db->orderBy('sort_order', 'asc');
          $allSections = $db->get(DBTAB);
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title text-primary"><i class="fa fa-list"></i> Research Portal Sections</h4>
                    <p class="text-muted font-14 mb-0">
                      Manage all 7 sections of the dedicated Research Portal page (<code>research.php</code>). Click <strong>Edit</strong> on any section to customize headings, texts, metrics, and content.
                    </p>
                  </div>
                  <a href="../research/" target="_blank" class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i> Preview research.php
                  </a>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th style="width:50px;">#</th>
                        <th>Section Name</th>
                        <th>Key Badge</th>
                        <th>Main Heading Preview</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:160px;">Last Updated</th>
                        <th style="width:110px; text-align:center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($allSections)): 
                        $sn = 1;
                        foreach ($allSections as $s):
                      ?>
                      <tr>
                        <td><strong><?php echo $sn++; ?></strong></td>
                        <td>
                          <strong class="text-dark font-15"><?php echo htmlspecialchars($s['section_name']); ?></strong>
                          <br><small class="text-muted"><code>#<?php echo htmlspecialchars($s['section_key']); ?></code></small>
                        </td>
                        <td>
                          <?php if (!empty($s['badge_text'])): ?>
                            <span class="badge badge-light border">
                              <i class="<?php echo htmlspecialchars($s['badge_icon']); ?>"></i>
                              <?php echo htmlspecialchars($s['badge_text']); ?>
                            </span>
                          <?php else: ?>
                            <span class="text-muted small">—</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <div style="max-width:320px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <?php echo strip_tags($s['heading']); ?>
                          </div>
                          <small class="text-muted"><?php echo substr(strip_tags($s['subheading']), 0, 70) . '...'; ?></small>
                        </td>
                        <td>
                          <?php if ($s['status'] == 1): ?>
                            <span class="badge badge-active"><i class="fa fa-check"></i> Active</span>
                          <?php else: ?>
                            <span class="badge badge-inactive"><i class="fa fa-times"></i> Inactive</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <small class="text-muted"><?php echo date('d M Y, h:i A', strtotime($s['updated_at'])); ?></small>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo PAGE; ?>?action=edit&id=<?php echo $s['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                      </tr>
                      <?php endforeach; else: ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted">No sections found in database.</td>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var container = document.getElementById('products-container');
  var template = document.getElementById('product-card-template');
  var btnAddTop = document.getElementById('btn-add-product');
  var btnAddBottom = document.getElementById('btn-add-product-bottom');

  function updateProductIndices() {
    if (!container) return;
    var cards = container.querySelectorAll('.product-card-col');
    cards.forEach(function(card, idx) {
      var badge = card.querySelector('.prod-badge-number');
      if (badge) {
        badge.textContent = 'Product #' + (idx + 1);
        badge.className = 'badge badge-primary prod-badge-number';
      }
    });
  }

  function addProduct() {
    if (!container || !template) return;
    var clone = template.content.cloneNode(true);
    container.appendChild(clone);
    updateProductIndices();

    var allCards = container.querySelectorAll('.product-card-col');
    var lastCard = allCards[allCards.length - 1];
    if (lastCard) {
      lastCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
      var firstInput = lastCard.querySelector('input[type="text"], textarea');
      if (firstInput) {
        setTimeout(function() {
          firstInput.focus();
        }, 250);
      }
    }
  }

  if (btnAddTop) {
    btnAddTop.addEventListener('click', function(e) {
      e.preventDefault();
      addProduct();
    });
  }

  if (btnAddBottom) {
    btnAddBottom.addEventListener('click', function(e) {
      e.preventDefault();
      addProduct();
    });
  }

  if (container) {
    container.addEventListener('click', function(e) {
      var btn = e.target.closest('.remove-product-btn');
      if (!btn) return;
      e.preventDefault();

      var card = btn.closest('.product-card-col');
      if (!card) return;

      var totalCards = container.querySelectorAll('.product-card-col').length;
      if (totalCards <= 1) {
        alert('You must have at least one product card.');
        return;
      }

      var nameInput = card.querySelector('input[name="prod_name[]"]');
      var prodName = nameInput && nameInput.value.trim() ? ('"' + nameInput.value.trim() + '"') : 'this product';

      if (confirm('Are you sure you want to delete ' + prodName + '?')) {
        card.style.transition = 'all 0.25s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        setTimeout(function() {
          card.remove();
          updateProductIndices();
        }, 250);
      }
    });
  }
});
</script>
</body>
</html>
