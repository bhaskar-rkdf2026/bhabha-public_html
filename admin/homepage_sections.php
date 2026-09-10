<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');
$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'homepage_sections.php');
define("TITLE", 'Home Page Sections');
define("DBTAB", 'homepage_sections');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Quick status toggle via GET
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db->where('id', $id);
    $curr = $db->getOne(DBTAB);
    if ($curr) {
        $newStatus = ($curr['status'] == 1) ? 0 : 1;
        $db->where('id', $id);
        $db->update(DBTAB, ['status' => $newStatus]);
        $_SESSION["success"] = 'Status updated successfully';
    }
    redirect(PAGE);
}

// Handle Edit Submission
if (isset($_POST['submit'])) {
    $subAction = $_POST['action'] ?? ($_GET['action'] ?? '');
    $id = intval($_POST['id'] ?? ($_GET['id'] ?? 0));
    if ($subAction == "edit" && count($stat) == 0 && $id > 0) {
        $db->where('id', $id);
        $currSec = $db->getOne(DBTAB);
        $secKey = $currSec ? $currSec['section_key'] : '';
        
        $mediaUrl = trim($_POST['media_url'] ?? '');
        
        // Handle file upload if provided
        if (isset($_FILES['media_file']) && !empty($_FILES['media_file']['name'])) {
            $uploadDir = '../upload/media/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $origName = basename($_FILES['media_file']['name']);
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowedExts = ['mp4', 'webm', 'ogg', 'jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowedExts)) {
                $newFile = md5(microtime() . $origName) . '.' . $ext;
                if (move_uploaded_file($_FILES['media_file']['tmp_name'], $uploadDir . $newFile)) {
                    $mediaUrl = 'upload/media/' . $newFile;
                }
            } else {
                $stat['error'] = 'Invalid file format. Allowed: MP4, WEBM, JPG, PNG, GIF, WEBP';
            }
        }
        
        // Section-specific extra_data assembly from simple fields
        $extraArray = [];
        if ($secKey == 'hero_video') {
            $stats = [];
            if (isset($_POST['hero_stat_num']) && is_array($_POST['hero_stat_num'])) {
                foreach ($_POST['hero_stat_num'] as $k => $num) {
                    $numTrim = trim($num);
                    if ($numTrim !== '') {
                        $rawDigits = intval(preg_replace('/[^0-9]/', '', $numTrim));
                        $stats[] = [
                            'number' => $numTrim,
                            'suffix' => trim($_POST['hero_stat_suffix'][$k] ?? ''),
                            'commas' => ($rawDigits >= 1000),
                            'label'  => trim($_POST['hero_stat_lbl'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = [
                'poster' => trim($_POST['hero_poster'] ?? 'new-media/image/campus-aerial.png'),
                'stats'  => $stats
            ];
        } elseif ($secKey == 'chancellor_welcome') {
            $recogs = [];
            if (isset($_POST['recog_title']) && is_array($_POST['recog_title'])) {
                foreach ($_POST['recog_title'] as $k => $rtitle) {
                    $rtitleTrim = trim($rtitle);
                    if (!empty($rtitleTrim)) {
                        $recogs[] = [
                            'title' => $rtitleTrim,
                            'label' => trim($_POST['recog_label'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = ['recognitions' => $recogs];
        } elseif ($secKey == 'why_bhabha') {
            $feats = [];
            if (isset($_POST['why_title']) && is_array($_POST['why_title'])) {
                foreach ($_POST['why_title'] as $k => $wtitle) {
                    $wtitleTrim = trim($wtitle);
                    if (!empty($wtitleTrim)) {
                        $rawIcon = trim($_POST['why_icon'][$k] ?? 'fa fa-certificate');
                        if (!empty($rawIcon) && strpos($rawIcon, 'fa ') !== 0 && strpos($rawIcon, 'fas ') !== 0 && strpos($rawIcon, 'far ') !== 0 && strpos($rawIcon, 'fab ') !== 0) {
                            $rawIcon = 'fa ' . (strpos($rawIcon, 'fa-') === 0 ? $rawIcon : 'fa-' . $rawIcon);
                        }
                        $feats[] = [
                            'icon'  => $rawIcon,
                            'title' => $wtitleTrim,
                            'desc'  => trim($_POST['why_desc'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = ['features' => $feats];
        } elseif ($secKey == 'virtual_tour') {
            $tabs = [];
            if (isset($_POST['vt_tab_label']) && is_array($_POST['vt_tab_label'])) {
                foreach ($_POST['vt_tab_label'] as $k => $tlabel) {
                    $tlabelTrim = trim($tlabel);
                    if (!empty($tlabelTrim)) {
                        $tabs[] = [
                            'label'     => $tlabelTrim,
                            'icon'      => trim($_POST['vt_tab_icon'][$k] ?? 'fa fa-video-camera'),
                            'video_url' => trim($_POST['vt_tab_url'][$k] ?? '')
                        ];
                    }
                }
            }
            $cards = [];
            if (isset($_POST['vt_card_title']) && is_array($_POST['vt_card_title'])) {
                foreach ($_POST['vt_card_title'] as $k => $ctitle) {
                    $ctitleTrim = trim($ctitle);
                    if (!empty($ctitleTrim)) {
                        $cards[] = [
                            'icon'  => trim($_POST['vt_card_icon'][$k] ?? 'fa fa-check'),
                            'title' => $ctitleTrim,
                            'desc'  => trim($_POST['vt_card_desc'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = [
                'video_tabs' => $tabs,
                'info_cards' => $cards,
                'cta_text'   => trim($_POST['vt_cta_text'] ?? 'Explore Full Virtual Tour'),
                'cta_url'    => trim($_POST['vt_cta_url'] ?? 'about.php#virtualTour')
            ];
        } elseif ($secKey == 'research_innovation') {
            $metrics = [];
            if (isset($_POST['res_target']) && is_array($_POST['res_target'])) {
                foreach ($_POST['res_target'] as $k => $rtarg) {
                    $targetVal = intval(preg_replace('/[^0-9]/', '', $rtarg));
                    $metrics[] = [
                        'target' => $targetVal,
                        'value'  => (string)$targetVal,
                        'suffix' => trim($_POST['res_suffix'][$k] ?? ''),
                        'prefix' => trim($_POST['res_prefix'][$k] ?? ''),
                        'commas' => ($targetVal >= 1000),
                        'label'  => trim($_POST['res_label'][$k] ?? '')
                    ];
                }
            }
            $rawHlIcon = trim($_POST['res_highlight_icon'] ?? 'fa fa-flask');
            if (!empty($rawHlIcon) && strpos($rawHlIcon, 'fa ') !== 0 && strpos($rawHlIcon, 'fas ') !== 0 && strpos($rawHlIcon, 'far ') !== 0 && strpos($rawHlIcon, 'fab ') !== 0) {
                $rawHlIcon = 'fa ' . (strpos($rawHlIcon, 'fa-') === 0 ? $rawHlIcon : 'fa-' . $rawHlIcon);
            }
            $extraArray = [
                'metrics'        => $metrics,
                'highlight_icon' => $rawHlIcon,
                'highlight_text' => trim($_POST['res_highlight'] ?? ''),
                'button_text'    => trim($_POST['res_btn_text'] ?? 'EXPLORE RESEARCH →'),
                'button_url'     => trim($_POST['res_btn_url'] ?? 'research.php')
            ];
        } elseif ($secKey == 'global_network') {
            $tagsRaw = trim($_POST['glob_tags'] ?? '');
            $tags = array_filter(array_map('trim', explode(',', $tagsRaw)));
            $extraArray = [
                'tags'        => array_values($tags),
                'button_text' => trim($_POST['glob_btn_text'] ?? 'APPLY NOW →'),
                'button_url'  => trim($_POST['glob_btn_url'] ?? 'enquiry.php')
            ];
        } elseif ($secKey == 'insta_reels') {
            $reels = [];
            if (isset($_POST['reel_url']) && is_array($_POST['reel_url'])) {
                foreach ($_POST['reel_url'] as $k => $rurl) {
                    $rurl = trim($rurl);
                    if (!empty($rurl)) {
                        $code = $rurl;
                        if (preg_match('/(?:reel|p)\/([A-Za-z0-9_-]+)/', $rurl, $m)) {
                            $code = $m[1];
                        }
                        $reels[] = [
                            'id'        => 'reel-' . ($k + 1),
                            'title'     => trim($_POST['reel_title'][$k] ?? ('Reel ' . ($k + 1))),
                            'code'      => $code,
                            'embed_url' => 'https://www.instagram.com/p/' . $code . '/embed/',
                            'insta_url' => 'https://www.instagram.com/reel/' . $code . '/'
                        ];
                    }
                }
            }
            $extraArray = [
                'reels'              => $reels,
                'footer_button_text' => trim($_POST['reels_btn_text'] ?? 'View Instagram Page →'),
                'footer_button_url'  => trim($_POST['reels_btn_url'] ?? 'https://www.instagram.com/bhabhauniversitybhopal/')
            ];
        }
        
        $extraJson = !empty($extraArray) ? json_encode($extraArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : ($currSec['extra_data'] ?? '');
        
        if (count($stat) == 0) {
            $data = [
                "title"       => trim($_POST['title'] ?? ''),
                "heading"     => trim($_POST['heading'] ?? ''),
                "subheading"  => trim($_POST['subheading'] ?? ''),
                "content"     => trim($_POST['content'] ?? ''),
                "media_url"   => $mediaUrl,
                "quote"       => trim($_POST['quote'] ?? ''),
                "author"      => trim($_POST['author'] ?? ''),
                "extra_data"  => $extraJson,
                "status"      => isset($_POST['status']) ? 1 : 0
            ];
            
            $db->where('id', $id);
            $db->update(DBTAB, $data);
            
            unset($_POST);
            unset($_SESSION['form']);
            $_SESSION["success"] = 'Section Updated Successfully';
            redirect(PAGE);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title><?php echo TITLE; ?> - Admin Panel</title>
<?php include_once("inc.meta.php"); ?>
<!-- DataTables -->
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<style>
.section-badge-key {
    background: #0A1B54;
    color: #FFC107;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
    letter-spacing: 0.5px;
    display: inline-block;
}
.status-badge-active {
    background: #28a745;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}
.status-badge-inactive {
    background: #dc3545;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}
.help-tip {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
    display: block;
}
.simple-card-group {
    background: #f8f9fc;
    border: 1px solid #e3e6f0;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    margin-bottom: 25px;
}
.simple-card-title {
    font-size: 15px;
    font-weight: 700;
    color: #0A1B54;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    border-bottom: 2px solid #eaecf4;
    padding-bottom: 8px;
}
.simple-item-box {
    background: #ffffff;
    border: 1px solid #d1d3e2;
    border-radius: 6px;
    padding: 14px;
    margin-bottom: 15px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
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
        
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><i class="mdi mdi-home"></i> <?php echo TITLE; ?></h4>
            </div>
          </div>
        </div>
        
        <?php if ($action == "edit"): 
            $secId = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
            $db->where('id', $secId);
            $aryData = $db->getOne(DBTAB);
            if (!$aryData) {
                redirect(PAGE);
            }
            $extra = !empty($aryData['extra_data']) ? json_decode($aryData['extra_data'], true) : [];
        ?>
        <!-- EDIT SECTION FORM -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title"><i class="fa fa-edit text-primary"></i> Edit Section: <?php echo htmlspecialchars($aryData['section_name']); ?></h4>
                    <span class="section-badge-key"><?php echo htmlspecialchars($aryData['section_key']); ?></span>
                  </div>
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
                </div>
                
                <div style="margin-bottom:15px;"> <?php echo msg($stat); ?></div>
                
                <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $aryData['id']; ?>">
                  <input type="hidden" name="action" value="edit">
                  
                  <div class="row">
                    <!-- Title / Badge -->
                    <div class="form-group col-md-6">
                      <label>Top Badge / Label</label>
                      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($aryData['title']); ?>" />
                      <small class="help-tip">Small uppercase badge shown above heading (e.g., "AERIAL · BHOPAL CAMPUS", "WHY BHABHA")</small>
                    </div>
                    
                    <!-- Heading -->
                    <div class="form-group col-md-6">
                      <label>Main Section Heading</label>
                      <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($aryData['heading']); ?>" />
                      <small class="help-tip">Supports HTML tags like &lt;em&gt;italic gold&lt;/em&gt; and &lt;br&gt;</small>
                    </div>
                  </div>
                  
                  <!-- Subheading / Description -->
                  <div class="form-group">
                    <label>Subheading / Intro Paragraph</label>
                    <textarea name="subheading" class="form-control" rows="3"><?php echo htmlspecialchars($aryData['subheading']); ?></textarea>
                    <small class="help-tip">Brief subtitle or introductory text displayed below the heading</small>
                  </div>
                  
                  <!-- Chancellor Specific Fields -->
                  <?php if ($aryData['section_key'] == 'chancellor_welcome'): ?>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Quote Text</label>
                      <input type="text" name="quote" class="form-control" value="<?php echo htmlspecialchars($aryData['quote']); ?>" />
                      <small class="help-tip">Chancellor highlight quote on video/photo card</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Quote Author</label>
                      <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($aryData['author']); ?>" />
                      <small class="help-tip">E.g., "DR. SADHNA KAPOOR · CHANCELLOR"</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Chancellor Message (Full Content)</label>
                    <textarea name="content" class="form-control ckeditor" rows="5"><?php echo $aryData['content']; ?></textarea>
                  </div>
                  <?php endif; ?>
                  
                  <!-- Media / Video URL -->
                  <?php if (in_array($aryData['section_key'], ['hero_video', 'chancellor_welcome', 'virtual_tour'])): ?>
                  <div class="row">
                    <div class="form-group col-md-8">
                      <label>Media / Video URL</label>
                      <input type="text" name="media_url" class="form-control" value="<?php echo htmlspecialchars($aryData['media_url']); ?>" />
                      <small class="help-tip">Relative path (e.g. <code>new-media/image/hero/bhabha_2.mp4</code>) or full external link</small>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Or Upload New Video / Image</label>
                      <input type="file" name="media_file" class="form-control-file" />
                      <small class="help-tip">Uploads directly to <code>upload/media/</code></small>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- ============================================== -->
                  <!-- SECTION-SPECIFIC SIMPLE FIELDS (NO RAW JSON)   -->
                  <!-- ============================================== -->
                  
                  <!-- 1. HERO VIDEO & STATS BAR FIELDS -->
                  <?php if ($aryData['section_key'] == 'hero_video'): 
                    $stats = !empty($extra['stats']) ? $extra['stats'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-bar-chart"></i> Hero Stats Bar Counters (8 Items)
                    </div>
                    <div class="form-group">
                      <label>Video Poster Image URL</label>
                      <input type="text" name="hero_poster" class="form-control" value="<?php echo htmlspecialchars($extra['poster'] ?? 'new-media/image/campus-aerial.png'); ?>" />
                      <small class="help-tip">Image displayed while background video is loading</small>
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 8; $i++): 
                        $st = $stats[$i] ?? ['number' => '', 'suffix' => '', 'label' => ''];
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Stat #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Number</small>
                            <input type="text" name="hero_stat_num[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['number']); ?>" placeholder="e.g. 15000">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Suffix (Optional)</small>
                            <input type="text" name="hero_stat_suffix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['suffix']); ?>" placeholder="e.g. + or k+">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Label</small>
                            <input type="text" name="hero_stat_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['label']); ?>" placeholder="e.g. STUDENTS">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 2. CHANCELLOR WELCOME RECOGNITIONS -->
                  <?php if ($aryData['section_key'] == 'chancellor_welcome'): 
                    $recogs = !empty($extra['recognitions']) ? $extra['recognitions'] : [
                        ['title' => 'UGC', 'label' => 'RECOGNISED'],
                        ['title' => 'NAAC', 'label' => 'A+ GRADE'],
                        ['title' => 'AICTE', 'label' => 'APPROVED']
                    ];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-certificate"></i> Key Recognitions &amp; Accreditations (3 Badges)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 3; $i++): 
                        $rc = $recogs[$i] ?? ['title' => '', 'label' => ''];
                      ?>
                      <div class="col-md-4 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Recognition Badge #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <small class="text-muted">Main Badge (e.g. UGC, NAAC, AICTE)</small>
                            <input type="text" name="recog_title[]" class="form-control" value="<?php echo htmlspecialchars($rc['title']); ?>">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Subtitle / Status (e.g. RECOGNISED, A+ GRADE)</small>
                            <input type="text" name="recog_label[]" class="form-control" value="<?php echo htmlspecialchars($rc['label']); ?>">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 3. WHY BHABHA UNIVERSITY (6 FEATURES) -->
                  <?php if ($aryData['section_key'] == 'why_bhabha'): 
                    $features = !empty($extra['features']) ? $extra['features'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-th-large"></i> Why Bhabha Key Features (6 Items)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 6; $i++): 
                        $f = $features[$i] ?? ['icon' => 'fa fa-certificate', 'title' => '', 'desc' => ''];
                      ?>
                      <div class="col-md-4 mb-3">
                        <div class="simple-item-box h-100">
                          <label class="text-primary font-weight-bold">Feature #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <small class="text-muted">Feature Title</small>
                            <input type="text" name="why_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['title']); ?>" placeholder="Title">
                          </div>
                          <div class="form-group mb-2">
                            <small class="text-muted">FontAwesome Icon Class</small>
                            <input type="text" name="why_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['icon']); ?>" placeholder="fa fa-certificate">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Description</small>
                            <textarea name="why_desc[]" class="form-control form-control-sm" rows="2" placeholder="Description"><?php echo htmlspecialchars($f['desc']); ?></textarea>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 4. VIRTUAL TOUR SHOWCASE -->
                  <?php if ($aryData['section_key'] == 'virtual_tour'): 
                    $vtabs = !empty($extra['video_tabs']) ? $extra['video_tabs'] : [];
                    $cards = !empty($extra['info_cards']) ? $extra['info_cards'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-video-camera"></i> Virtual Tour Video Tabs (4 Video Buttons)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $vt = $vtabs[$i] ?? ['label' => '', 'icon' => 'fa fa-video-camera', 'video_url' => ''];
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Video Tab #<?php echo $i + 1; ?></label>
                          <div class="row">
                            <div class="col-7">
                              <small class="text-muted">Tab Label</small>
                              <input type="text" name="vt_tab_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($vt['label']); ?>" placeholder="e.g. Aerial Drone">
                            </div>
                            <div class="col-5">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="vt_tab_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($vt['icon']); ?>" placeholder="fa fa-plane">
                            </div>
                            <div class="col-12 mt-2">
                              <small class="text-muted">Video MP4 URL or Path</small>
                              <input type="text" name="vt_tab_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($vt['video_url']); ?>" placeholder="new-media/image/hero/bhabha_1.mp4">
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <div class="simple-card-title mt-4">
                      <i class="fa fa-info-circle"></i> Campus Highlights (4 Side Cards)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $c = $cards[$i] ?? ['title' => '', 'desc' => '', 'icon' => 'fa fa-check'];
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Highlight Card #<?php echo $i + 1; ?></label>
                          <div class="row">
                            <div class="col-8">
                              <small class="text-muted">Card Title</small>
                              <input type="text" name="vt_card_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['title']); ?>" placeholder="e.g. 150-Acre Green Campus">
                            </div>
                            <div class="col-4">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="vt_card_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['icon']); ?>" placeholder="fa fa-tree">
                            </div>
                            <div class="col-12 mt-2">
                              <small class="text-muted">Short Description</small>
                              <textarea name="vt_card_desc[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($c['desc']); ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <div class="simple-card-title mt-4">
                      <i class="fa fa-external-link"></i> Virtual Tour CTA Button
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Button Text</label>
                        <input type="text" name="vt_cta_text" class="form-control" value="<?php echo htmlspecialchars($extra['cta_text'] ?? 'Explore Full Virtual Tour'); ?>">
                      </div>
                      <div class="col-md-6">
                        <label>Button Link / URL</label>
                        <input type="text" name="vt_cta_url" class="form-control" value="<?php echo htmlspecialchars($extra['cta_url'] ?? 'about.php#virtualTour'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 5. RESEARCH & INNOVATION -->
                  <?php if ($aryData['section_key'] == 'research_innovation'): 
                    $metrics = !empty($extra['metrics']) ? $extra['metrics'] : [];
                    $resImg = !empty($aryData['media_url']) ? (strpos($aryData['media_url'], 'http') === 0 ? $aryData['media_url'] : '../' . ltrim($aryData['media_url'], '/')) : '../new-media/image/research-students.png';
                  ?>
                  <div class="simple-card-group">
                    <!-- Research Side Image Preview & Upload -->
                    <div class="simple-card-title">
                      <i class="fa fa-image"></i> Research Section Side Image
                    </div>
                    <div class="row align-items-center mb-3">
                      <div class="col-md-3 text-center">
                        <div style="background:#f1f5f9; padding:8px; border-radius:8px; border:1px solid #e2e8f0;">
                          <img src="<?php echo $resImg; ?>" alt="Research Preview" style="max-width:100%; max-height:120px; border-radius:6px; object-fit:cover;" onerror="this.src='../images/fav-icon.png';">
                          <div class="small text-muted mt-1 font-weight-bold">Current Image Preview</div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group mb-2">
                          <label>Image File Path / External URL</label>
                          <input type="text" name="media_url" class="form-control" value="<?php echo htmlspecialchars($aryData['media_url']); ?>" placeholder="e.g. new-media/image/research-students.png">
                          <small class="help-tip">Path to image file (e.g. <code>new-media/image/research-students.png</code>)</small>
                        </div>
                        <div class="form-group mb-0">
                          <label>Or Upload New Image</label>
                          <input type="file" name="media_file" class="form-control-file">
                          <small class="help-tip">Allowed: JPG, PNG, WEBP. Uploads directly to <code>upload/media/</code></small>
                        </div>
                      </div>
                    </div>

                    <!-- Research Metrics (4 Counters) -->
                    <div class="simple-card-title mt-4">
                      <i class="fa fa-line-chart"></i> Research Metrics (4 Counters)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $m = $metrics[$i] ?? ['target' => '', 'suffix' => '', 'prefix' => '', 'label' => ''];
                        $mVal = !empty($m['target']) ? $m['target'] : ($m['value'] ?? '');
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Metric #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Number</small>
                            <input type="text" name="res_target[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mVal); ?>" placeholder="e.g. 250">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Prefix (e.g. ₹)</small>
                            <input type="text" name="res_prefix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['prefix'] ?? ''); ?>" placeholder="e.g. ₹">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Suffix (e.g. + or Cr)</small>
                            <input type="text" name="res_suffix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['suffix'] ?? ''); ?>" placeholder="e.g. + or Cr">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Metric Label</small>
                            <input type="text" name="res_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['label'] ?? ''); ?>" placeholder="e.g. PATENTS FILED">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <!-- Highlight Grant Card -->
                    <div class="simple-card-title mt-3">
                      <i class="fa fa-bullhorn"></i> Featured Grant Highlight &amp; Explore Button
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Highlight Card Icon</label>
                          <input type="text" name="res_highlight_icon" class="form-control" value="<?php echo htmlspecialchars($extra['highlight_icon'] ?? 'fa fa-flask'); ?>" placeholder="fa fa-flask">
                          <small class="help-tip">FontAwesome icon class (e.g. <code>fa fa-flask</code>, <code>fa fa-trophy</code>)</small>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label>Featured Grant Highlight Card Text</label>
                          <input type="text" name="res_highlight" class="form-control" value="<?php echo htmlspecialchars($extra['highlight_text'] ?? 'Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.'); ?>" placeholder="e.g. Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Explore Button Text</label>
                        <input type="text" name="res_btn_text" class="form-control" value="<?php echo htmlspecialchars($extra['button_text'] ?? 'EXPLORE RESEARCH →'); ?>">
                      </div>
                      <div class="col-md-6">
                        <label>Explore Button Link / URL</label>
                        <input type="text" name="res_btn_url" class="form-control" value="<?php echo htmlspecialchars($extra['button_url'] ?? 'research.php'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 6. GLOBAL NETWORK & MOUS -->
                  <?php if ($aryData['section_key'] == 'global_network'): 
                    $tagsList = !empty($extra['tags']) && is_array($extra['tags']) ? implode(', ', $extra['tags']) : '';
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-globe"></i> Global Partner Universities &amp; Apply Button
                    </div>
                    <div class="form-group">
                      <label>Partner Universities (Comma Separated)</label>
                      <textarea name="glob_tags" class="form-control" rows="3" placeholder="e.g. University of Toronto, TU Munich, NUS Singapore, Monash, Curtin, UPenn, Sheffield"><?php echo htmlspecialchars($tagsList); ?></textarea>
                      <small class="help-tip">Type university names separated by commas. Each name will automatically become a sleek partner badge on the website.</small>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Button Text</label>
                        <input type="text" name="glob_btn_text" class="form-control" value="<?php echo htmlspecialchars($extra['button_text'] ?? 'APPLY NOW →'); ?>">
                      </div>
                      <div class="col-md-6">
                        <label>Button Link / URL</label>
                        <input type="text" name="glob_btn_url" class="form-control" value="<?php echo htmlspecialchars($extra['button_url'] ?? 'enquiry.php'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 7. CAMPUS INSTAGRAM REELS -->
                  <?php if ($aryData['section_key'] == 'insta_reels'): 
                    $reels = !empty($extra['reels']) ? $extra['reels'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-instagram"></i> Instagram Reel Cards (4 Reels)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $r = $reels[$i] ?? ['title' => '', 'insta_url' => ''];
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Instagram Reel #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <small class="text-muted">Reel Title / Activity Name</small>
                            <input type="text" name="reel_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($r['title']); ?>" placeholder="Title">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Instagram Reel URL or Post Link</small>
                            <input type="text" name="reel_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($r['insta_url']); ?>" placeholder="e.g. https://www.instagram.com/reel/Dbr0ycHAi-x/">
                            <small class="help-tip">Paste regular Instagram reel link; embed will be generated automatically.</small>
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <div class="simple-card-title mt-3">
                      <i class="fa fa-external-link"></i> Instagram Page Link &amp; Follow Button
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label>Follow Button Text</label>
                        <input type="text" name="reels_btn_text" class="form-control" value="<?php echo htmlspecialchars($extra['footer_button_text'] ?? 'View Instagram Page →'); ?>">
                      </div>
                      <div class="col-md-6">
                        <label>Official Instagram Profile URL</label>
                        <input type="text" name="reels_btn_url" class="form-control" value="<?php echo htmlspecialchars($extra['footer_button_url'] ?? 'https://www.instagram.com/bhabhauniversitybhopal/'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- Status Checkbox -->
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="statusCheck" name="status" value="1" <?php echo ($aryData['status'] == 1) ? 'checked' : ''; ?>>
                      <label class="custom-control-label" for="statusCheck"><strong>Section Active (Visible on Home Page)</strong></label>
                    </div>
                    <small class="help-tip">Uncheck to temporarily hide this section from the Home Page without deleting it.</small>
                  </div>
                  
                  <hr>
                  <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> Save Changes</button>
                  <a href="<?php echo PAGE; ?>" class="btn btn-warning waves-effect waves-light">Cancel</a>
                </form>
                
              </div>
            </div>
          </div>
        </div>
        
        <?php else: ?>
        <!-- LIST VIEW -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title"><i class="fa fa-list text-primary"></i> Homepage Sections List</h4>
                    <p class="text-muted mb-0">Manage and update all major interactive and branding sections of the Bhabha University Home Page.</p>
                  </div>
                </div>
                
                <div style="margin-bottom:15px;"> <?php echo msg($stat); ?></div>
                
                <div class="table-responsive">
                  <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th style="width:60px;">#</th>
                        <th>Section Name</th>
                        <th>Section Key</th>
                        <th>Heading / Title</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:140px;">Last Updated</th>
                        <th style="width:100px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $db->orderBy('sort_order', 'ASC');
                      $sections = $db->get(DBTAB);
                      if (is_array($sections) && count($sections) > 0) {
                          $i = 1;
                          foreach ($sections as $sec) {
                              $statusHtml = ($sec['status'] == 1) 
                                  ? '<a href="'.PAGE.'?id='.$sec['id'].'&action=toggle_status" title="Click to Deactivate"><span class="status-badge-active">Active</span></a>'
                                  : '<a href="'.PAGE.'?id='.$sec['id'].'&action=toggle_status" title="Click to Activate"><span class="status-badge-inactive">Inactive</span></a>';
                              $cleanHeading = strip_tags($sec['heading']);
                              if (strlen($cleanHeading) > 60) {
                                  $cleanHeading = substr($cleanHeading, 0, 57) . '...';
                              }
                              $secIcons = [
                                  'hero_video' => 'fa fa-video-camera',
                                  'chancellor_welcome' => 'fa fa-user-circle',
                                  'why_bhabha' => 'fa fa-graduation-cap',
                                  'virtual_tour' => 'fa fa-street-view',
                                  'research_portal' => 'fa fa-flask',
                                  'global_network' => 'fa fa-globe',
                                  'insta_reels' => 'fa fa-instagram'
                              ];
                              $iconClass = $secIcons[$sec['section_key']] ?? 'fa fa-cube';
                      ?>
                      <tr>
                        <td><strong><?php echo $i++; ?></strong></td>
                        <td>
                          <i class="<?php echo $iconClass; ?> text-primary mr-1"></i> <strong><?php echo htmlspecialchars($sec['section_name']); ?></strong>
                        </td>
                        <td>
                          <span class="section-badge-key"><?php echo htmlspecialchars($sec['section_key']); ?></span>
                        </td>
                        <td>
                          <?php echo htmlspecialchars($cleanHeading ?: $sec['title']); ?>
                        </td>
                        <td>
                          <?php echo $statusHtml; ?>
                        </td>
                        <td>
                          <small class="text-muted"><?php echo date('d M Y, h:i A', strtotime($sec['updated_at'])); ?></small>
                        </td>
                        <td>
                          <a href="<?php echo PAGE; ?>?id=<?php echo $sec['id']; ?>&action=edit" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                      </tr>
                      <?php 
                          }
                      } else {
                      ?>
                      <tr>
                        <td colspan="7" class="text-center">No sections found.</td>
                      </tr>
                      <?php } ?>
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
</body>
</html>
