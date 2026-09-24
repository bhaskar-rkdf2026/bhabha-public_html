<?php
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'seo.php');
define("TITLE", 'Dynamic SEO & Meta Manager');
define("DBTAB", 'seo_metadata');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// 1. Handle Global Robots Indexing Toggle
if (isset($_POST['update_global_index'])) {
    $new_global_mode = trim($_POST['global_index_mode'] ?? 'noindex, nofollow');
    
    // Check if key exists in settings
    $chk = $db->where('field', 'seo_global_index')->getOne('settings');
    if ($chk) {
        $db->where('field', 'seo_global_index')->update('settings', ['value' => $new_global_mode]);
    } else {
        $db->insert('settings', ['field' => 'seo_global_index', 'value' => $new_global_mode]);
    }
    
    $_SESSION['success'] = ($new_global_mode === 'index, follow') 
        ? '🚀 Global Search Engine Indexing is now LIVE (index, follow)!' 
        : '🛡️ Global Development Protection active (noindex, nofollow)!';
    redirect(PAGE);
}

// 2. Handle Individual Page SEO Update
if (isset($_POST['submit_seo'])) {
    $id               = intval($_POST['id'] ?? 0);
    $meta_title       = trim($_POST['meta_title'] ?? '');
    $meta_description = trim($_POST['meta_description'] ?? '');
    $meta_keywords    = trim($_POST['meta_keywords'] ?? '');
    $canonical_url    = trim($_POST['canonical_url'] ?? '');
    $og_title         = trim($_POST['og_title'] ?? '');
    $og_description   = trim($_POST['og_description'] ?? '');
    $og_image         = trim($_POST['og_image'] ?? '');
    $robots_tag       = trim($_POST['robots_tag'] ?? 'inherit');
    $custom_schema    = trim($_POST['custom_schema'] ?? '');

    if ($id > 0) {
        $updateArr = [
            'meta_title'       => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords'    => $meta_keywords,
            'canonical_url'    => $canonical_url,
            'og_title'         => $og_title ?: $meta_title,
            'og_description'   => $og_description ?: $meta_description,
            'og_image'         => $og_image,
            'robots_tag'       => $robots_tag,
            'custom_schema'    => $custom_schema,
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $db->where('id', $id);
        $updated = $db->update(DBTAB, $updateArr);
        if ($updated) {
            $_SESSION['success'] = 'SEO tags updated successfully for ' . htmlspecialchars($_POST['page_name'] ?? 'page') . '!';
        } else {
            $_SESSION['error'] = 'Failed to update SEO record: ' . $db->getLastError();
        }
    }
    redirect(PAGE . (!empty($_GET['tab']) ? '?tab=' . urlencode($_GET['tab']) : ''));
}

// Fetch Current Global Index Setting
$global_setting_res = $db->where('field', 'seo_global_index')->getOne('settings');
$current_global_index = $global_setting_res['value'] ?? 'noindex, nofollow';

// Fetch All SEO Records
$all_pages = $db->orderBy('page_category', 'ASC')->orderBy('page_name', 'ASC')->get(DBTAB);

// Counters
$total_pages_count = count($all_pages);
$portal_count = 0;
$core_count = 0;
$cms_count = 0;
$exam_count = 0;
$static_count = 0;

$pages_map = [];
foreach ($all_pages as $p) {
    $pages_map[$p['id']] = $p;
    if ($p['page_category'] === 'Portal') $portal_count++;
    elseif ($p['page_category'] === 'Core') $core_count++;
    elseif ($p['page_category'] === 'CMS') $cms_count++;
    elseif ($p['page_category'] === 'Exam') $exam_count++;
    elseif ($p['page_category'] === 'Static') $static_count++;
}

// Active Tab Filter
$current_tab = $_GET['tab'] ?? 'all';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Dynamic SEO &amp; Meta Manager - Bhabha Admin</title>
    <?php require_once('inc.meta.php'); ?>
    <link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    <style>
        :root {
            --bu-navy: #0A1B54;
            --bu-navy-dark: #051235;
            --bu-gold: #FFC107;
            --bu-gold-dark: #D99B00;
            --bu-card-bg: #FFFFFF;
        }

        .seo-header-banner {
            background: linear-gradient(135deg, var(--bu-navy) 0%, #152C70 60%, var(--bu-navy-dark) 100%);
            border-radius: 12px;
            padding: 22px 28px;
            color: #ffffff;
            margin-bottom: 22px;
            box-shadow: 0 8px 24px rgba(10, 27, 84, 0.18);
            position: relative;
            overflow: hidden;
        }
        .seo-header-banner::after {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(255,193,7,0.2) 0%, rgba(255,193,7,0) 70%);
            border-radius: 50%;
        }

        .kpi-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            border: 1px solid #E8EEF5;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(10,27,84,0.1);
        }
        .kpi-icon {
            width: 46px; height: 46px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        /* Nav Pills */
        .seo-nav-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 12px;
        }
        .seo-nav-btn {
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            color: #4A5568;
            text-decoration: none;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .seo-nav-btn:hover {
            background: #EDF2F7;
            color: var(--bu-navy);
            text-decoration: none;
        }
        .seo-nav-btn.active {
            background: var(--bu-navy);
            color: #fff;
            border-color: var(--bu-navy);
            box-shadow: 0 4px 12px rgba(10,27,84,0.25);
        }
        .seo-nav-btn .badge-pill {
            font-size: 11px;
            padding: 2px 7px;
        }

        /* Google SERP Preview Card */
        .google-preview-box {
            background: #FFFFFF;
            border: 1px solid #DFE1E5;
            border-radius: 10px;
            padding: 16px 20px;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .google-preview-url {
            color: #202124;
            font-size: 12px;
            line-height: 1.3;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }
        .google-preview-url img {
            width: 16px; height: 16px; border-radius: 50%;
        }
        .google-preview-title {
            color: #1a0dab;
            font-size: 18px;
            line-height: 1.3;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 4px;
            text-decoration: none;
            display: block;
        }
        .google-preview-title:hover {
            text-decoration: underline;
        }
        .google-preview-desc {
            color: #4d5156;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Char Counter */
        .char-meter {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            margin-top: 4px;
            font-weight: 600;
        }
        .char-meter.good { color: #28a745; }
        .char-meter.warn { color: #ffc107; }
        .char-meter.bad  { color: #dc3545; }

        /* Master Switch Card */
        .master-switch-card {
            background: #fff;
            border-radius: 12px;
            border: 2px solid <?= ($current_global_index === 'noindex, nofollow') ? '#FFC107' : '#28a745'; ?>;
            padding: 18px 24px;
            margin-bottom: 22px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .badge-purple { background-color: #6f42c1; }
        .badge-soft-success { background-color: rgba(40, 167, 69, 0.15); }
        .badge-soft-warning { background-color: rgba(255, 193, 7, 0.2); }
    </style>
</head>
<body class="fixed-left">
    <div id="wrapper">
        <?php require_once('inc.menu.php'); ?>
        <div class="content-page">
            <div class="content">
                <?php require_once('inc.top.php'); ?>

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        <!-- Top Header Banner -->
                        <div class="seo-header-banner">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div>
                                    <h4 class="m-0 font-weight-bold text-white d-flex align-items-center">
                                        <i class="mdi mdi-chart-areaspline text-warning mr-2" style="font-size: 28px;"></i>
                                        Dynamic SEO &amp; Meta Manager
                                    </h4>
                                    <p class="m-0 mt-1 text-white-50" style="font-size: 13px;">
                                        Manage Search Engine Titles, Descriptions, OpenGraph Social Previews, and Robots Indexing for all 96 pages.
                                    </p>
                                </div>
                                <div class="mt-2 mt-md-0">
                                    <span class="badge badge-warning text-dark font-weight-bold px-3 py-2" style="font-size: 13px; border-radius: 8px;">
                                        <i class="mdi mdi-shield mr-1"></i> Development Mode Active
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts -->
                        <?php if (!empty($stat['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; font-weight: 600;">
                                <i class="mdi mdi-check-circle mr-1"></i> <?php echo $stat['success']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($stat['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; font-weight: 600;">
                                <i class="mdi mdi-alert-circle mr-1"></i> <?php echo $stat['error']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Global Master Switch Card -->
                        <div class="master-switch-card">
                            <div class="d-flex align-items-center">
                                <div class="kpi-icon mr-3" style="background: <?= ($current_global_index === 'noindex, nofollow') ? 'rgba(255,193,7,0.15)' : 'rgba(40,167,69,0.15)'; ?>; color: <?= ($current_global_index === 'noindex, nofollow') ? '#D99B00' : '#28a745'; ?>;">
                                    <i class="mdi <?= ($current_global_index === 'noindex, nofollow') ? 'mdi-security' : 'mdi-earth'; ?>"></i>
                                </div>
                                <div>
                                    <h5 class="m-0 font-weight-bold" style="color: var(--bu-navy);">
                                        Global Search Engine Crawling Status: 
                                        <span class="badge <?= ($current_global_index === 'noindex, nofollow') ? 'badge-warning text-dark' : 'badge-success'; ?> px-2 py-1 ml-1">
                                            <?= htmlspecialchars($current_global_index); ?>
                                        </span>
                                    </h5>
                                    <p class="m-0 text-muted mt-1" style="font-size: 13px;">
                                        <?php if ($current_global_index === 'noindex, nofollow'): ?>
                                            🔒 <strong>Protected:</strong> Google and search bots are currently blocked from indexing any page on the website.
                                        <?php else: ?>
                                            🌐 <strong>Live:</strong> Search bots are allowed to crawl and index all website pages.
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <form method="POST" action="<?= PAGE; ?>" onsubmit="return confirm('Are you sure you want to toggle the global search engine indexing mode?');">
                                    <input type="hidden" name="update_global_index" value="1">
                                    <?php if ($current_global_index === 'noindex, nofollow'): ?>
                                        <input type="hidden" name="global_index_mode" value="index, follow">
                                        <button type="submit" class="btn btn-success font-weight-bold px-3 py-2 shadow-sm" style="border-radius: 8px;">
                                            <i class="mdi mdi-rocket mr-1"></i> Switch to Live Mode (index, follow)
                                        </button>
                                    <?php else: ?>
                                        <input type="hidden" name="global_index_mode" value="noindex, nofollow">
                                        <button type="submit" class="btn btn-warning text-dark font-weight-bold px-3 py-2 shadow-sm" style="border-radius: 8px;">
                                            <i class="mdi mdi-shield mr-1"></i> Switch to Dev Mode (noindex, nofollow)
                                        </button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>

                        <!-- KPI Summary Row -->
                        <div class="row mb-4">
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(10,27,84,0.1); color: var(--bu-navy);">
                                        <i class="mdi mdi-file-document-box"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Total Pages</span>
                                        <h4 class="m-0 font-weight-bold" style="color: var(--bu-navy);"><?= $total_pages_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(40,167,69,0.1); color: #28a745;">
                                        <i class="mdi mdi-view-dashboard"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Portal Pages</span>
                                        <h4 class="m-0 font-weight-bold text-success"><?= $portal_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(23,162,184,0.1); color: #17a2b8;">
                                        <i class="mdi mdi-database"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Core Modules</span>
                                        <h4 class="m-0 font-weight-bold text-info"><?= $core_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(255,193,7,0.15); color: #D99B00;">
                                        <i class="mdi mdi-file-tree"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">CMS Pages</span>
                                        <h4 class="m-0 font-weight-bold text-warning"><?= $cms_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(111,66,193,0.1); color: #6f42c1;">
                                        <i class="mdi mdi-school"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Exam Papers</span>
                                        <h4 class="m-0 font-weight-bold" style="color: #6f42c1;"><?= $exam_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-4 col-6 mb-3">
                                <div class="kpi-card">
                                    <div class="kpi-icon" style="background: rgba(108,117,125,0.1); color: #6c757d;">
                                        <i class="mdi mdi-layers"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted" style="font-size: 12px; font-weight: 600;">Static Pages</span>
                                        <h4 class="m-0 font-weight-bold text-secondary"><?= $static_count; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Tabs -->
                        <div class="seo-nav-pills">
                            <a href="<?= PAGE; ?>?tab=all" class="seo-nav-btn <?= ($current_tab === 'all') ? 'active' : ''; ?>">
                                <i class="mdi mdi-format-list-bulleted"></i> All Pages <span class="badge badge-pill <?= ($current_tab === 'all') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $total_pages_count; ?></span>
                            </a>
                            <a href="<?= PAGE; ?>?tab=Portal" class="seo-nav-btn <?= ($current_tab === 'Portal') ? 'active' : ''; ?>">
                                <i class="mdi mdi-view-dashboard"></i> Portal Pages <span class="badge badge-pill <?= ($current_tab === 'Portal') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $portal_count; ?></span>
                            </a>
                            <a href="<?= PAGE; ?>?tab=Core" class="seo-nav-btn <?= ($current_tab === 'Core') ? 'active' : ''; ?>">
                                <i class="mdi mdi-database"></i> Core &amp; Database <span class="badge badge-pill <?= ($current_tab === 'Core') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $core_count; ?></span>
                            </a>
                            <a href="<?= PAGE; ?>?tab=CMS" class="seo-nav-btn <?= ($current_tab === 'CMS') ? 'active' : ''; ?>">
                                <i class="mdi mdi-file-tree"></i> CMS Generic <span class="badge badge-pill <?= ($current_tab === 'CMS') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $cms_count; ?></span>
                            </a>
                            <a href="<?= PAGE; ?>?tab=Exam" class="seo-nav-btn <?= ($current_tab === 'Exam') ? 'active' : ''; ?>">
                                <i class="mdi mdi-school"></i> Question Papers <span class="badge badge-pill <?= ($current_tab === 'Exam') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $exam_count; ?></span>
                            </a>
                            <a href="<?= PAGE; ?>?tab=Static" class="seo-nav-btn <?= ($current_tab === 'Static') ? 'active' : ''; ?>">
                                <i class="mdi mdi-layers"></i> Static Showcase <span class="badge badge-pill <?= ($current_tab === 'Static') ? 'badge-light text-dark' : 'badge-secondary'; ?>"><?= $static_count; ?></span>
                            </a>
                        </div>

                        <!-- Main Table Card -->
                        <div class="card shadow-sm border-0" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table id="seoDataTable" class="table table-hover table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="background: #F8FAFC; color: var(--bu-navy); font-size: 13px;">
                                                <th style="width: 40px;">#</th>
                                                <th>Page Details</th>
                                                <th>Category</th>
                                                <th>Meta Title</th>
                                                <th>Meta Description</th>
                                                <th>Robots Tag</th>
                                                <th class="text-center" style="width: 100px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i = 0;
                                            foreach ($all_pages as $row): 
                                                if ($current_tab !== 'all' && $row['page_category'] !== $current_tab) {
                                                    continue;
                                                }
                                                $i++;
                                                $catBadge = 'badge-secondary';
                                                if ($row['page_category'] === 'Portal') $catBadge = 'badge-success';
                                                elseif ($row['page_category'] === 'Core') $catBadge = 'badge-info';
                                                elseif ($row['page_category'] === 'CMS') $catBadge = 'badge-warning text-dark';
                                                elseif ($row['page_category'] === 'Exam') $catBadge = 'badge-purple text-white';
                                                elseif ($row['page_category'] === 'Static') $catBadge = 'badge-dark';
                                                
                                                $titleLen = mb_strlen($row['meta_title'] ?? '');
                                                $descLen  = mb_strlen($row['meta_description'] ?? '');
                                            ?>
                                            <tr>
                                                <td class="font-weight-bold text-muted"><?= $i; ?></td>
                                                <td>
                                                    <div class="font-weight-bold" style="color: var(--bu-navy); font-size: 14px;">
                                                        <?= htmlspecialchars($row['page_name']); ?>
                                                    </div>
                                                    <div class="text-muted" style="font-size: 12px;">
                                                        <code><?= htmlspecialchars($row['page_route']); ?></code>
                                                        <a href="../<?= htmlspecialchars($row['page_route']); ?>" target="_blank" class="ml-1 text-primary" title="Preview Frontend Page">
                                                            <i class="mdi mdi-open-in-new"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge <?= $catBadge; ?> px-2 py-1 font-weight-bold" style="font-size: 11px;">
                                                        <?= htmlspecialchars($row['page_category']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-truncate" style="max-width: 260px; font-weight: 600; font-size: 13px;" title="<?= htmlspecialchars($row['meta_title']); ?>">
                                                        <?= htmlspecialchars($row['meta_title'] ?: '—'); ?>
                                                    </div>
                                                    <span class="badge <?= ($titleLen >= 40 && $titleLen <= 65) ? 'badge-soft-success text-success' : 'badge-soft-warning text-dark'; ?>" style="font-size: 10px;">
                                                        <?= $titleLen; ?> chars
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="text-truncate" style="max-width: 320px; font-size: 12px; color: #555;" title="<?= htmlspecialchars($row['meta_description']); ?>">
                                                        <?= htmlspecialchars($row['meta_description'] ?: '—'); ?>
                                                    </div>
                                                    <span class="badge <?= ($descLen >= 120 && $descLen <= 165) ? 'badge-soft-success text-success' : 'badge-soft-warning text-dark'; ?>" style="font-size: 10px;">
                                                        <?= $descLen; ?> chars
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($row['robots_tag'] === 'inherit'): ?>
                                                        <span class="badge badge-light border text-muted" title="Inherits from Global Setting (<?= htmlspecialchars($current_global_index); ?>)">
                                                            <i class="mdi mdi-sync mr-1"></i> Inherit Global
                                                        </span>
                                                    <?php elseif ($row['robots_tag'] === 'index, follow'): ?>
                                                        <span class="badge badge-success">
                                                            <i class="mdi mdi-check mr-1"></i> index, follow
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-warning text-dark">
                                                            <i class="mdi mdi-cancel mr-1"></i> noindex, nofollow
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-primary font-weight-bold px-3 py-1 shadow-sm edit-seo-btn" 
                                                            style="border-radius: 6px; background: var(--bu-navy); border-color: var(--bu-navy);"
                                                            data-id="<?= $row['id']; ?>">
                                                        <i class="mdi mdi-square-edit-outline mr-1"></i> Edit SEO
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php require_once('inc.footer.php'); ?>
        </div>
    </div>

    <!-- SEO Edit Modal with Live Google SERP Preview -->
    <div class="modal fade" id="editSeoModal" tabindex="-1" role="dialog" aria-labelledby="editSeoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 14px; border: none; overflow: hidden; box-shadow: 0 15px 50px rgba(0,0,0,0.25);">
                <form method="POST" action="<?= PAGE; ?>?tab=<?= urlencode($current_tab); ?>">
                    <input type="hidden" name="submit_seo" value="1">
                    <input type="hidden" name="id" id="seo_id" value="0">
                    <input type="hidden" name="page_name" id="seo_page_name_hidden" value="">

                    <div class="modal-header" style="background: linear-gradient(135deg, var(--bu-navy) 0%, #152C70 100%); color: #fff; padding: 18px 24px;">
                        <h5 class="modal-title font-weight-bold d-flex align-items-center" id="editSeoModalLabel">
                            <i class="mdi mdi-chart-areaspline text-warning mr-2" style="font-size: 22px;"></i>
                            Edit SEO Metadata: <span id="modal_page_name" class="text-warning ml-1"></span>
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body p-4" style="background: #F8FAFC; max-height: 80vh; overflow-y: auto;">
                        
                        <!-- Page Info Strip -->
                        <div class="d-flex align-items-center justify-content-between p-3 mb-3 bg-white rounded border">
                            <div>
                                <span class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase;">Page Route URL</span>
                                <div class="font-weight-bold text-primary" style="font-size: 13px;">
                                    https://www.bhabhauniversity.edu.in/<span id="modal_page_route"></span>
                                </div>
                            </div>
                            <div>
                                <span class="badge badge-info px-2 py-1" id="modal_page_cat"></span>
                            </div>
                        </div>

                        <!-- Live Google SERP Snippet Preview -->
                        <label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">
                            <i class="mdi mdi-eye text-primary mr-1"></i> Google Search Result Live Preview
                        </label>
                        <div class="google-preview-box">
                            <div class="google-preview-url">
                                <img src="../images/favicon.png" alt="favicon" onerror="this.src='https://www.google.com/favicon.ico'">
                                <span>https://www.bhabhauniversity.edu.in &rsaquo; <span id="serp_slug">index.php</span></span>
                            </div>
                            <a href="javascript:void(0)" class="google-preview-title" id="serp_title">
                                Page Title Preview - Bhabha University Bhopal
                            </a>
                            <div class="google-preview-desc" id="serp_desc">
                                Page meta description preview will appear here in real-time as you type below.
                            </div>
                        </div>

                        <!-- Meta Title Input -->
                        <div class="form-group mb-3 bg-white p-3 rounded border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0" style="font-size: 13px;">
                                    Meta Title <span class="text-danger">*</span>
                                </label>
                                <span id="title_counter" class="char-meter good">0 / 60 chars (Recommended: 50-60)</span>
                            </div>
                            <input type="text" class="form-control" name="meta_title" id="input_meta_title" required maxlength="120" placeholder="e.g. Vision & Mission | Bhabha University Bhopal">
                            <small class="text-muted">Appears in browser tab and as the main clickable headline in Google search results.</small>
                        </div>

                        <!-- Meta Description Input -->
                        <div class="form-group mb-3 bg-white p-3 rounded border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="font-weight-bold text-dark m-0" style="font-size: 13px;">
                                    Meta Description <span class="text-danger">*</span>
                                </label>
                                <span id="desc_counter" class="char-meter good">0 / 160 chars (Recommended: 140-160)</span>
                            </div>
                            <textarea class="form-control" name="meta_description" id="input_meta_description" rows="3" maxlength="250" placeholder="Brief and compelling summary of the page content..."></textarea>
                            <small class="text-muted">Shown beneath the title in search engine snippets to encourage user clicks.</small>
                        </div>

                        <!-- Focus Keywords -->
                        <div class="form-group mb-3 bg-white p-3 rounded border">
                            <label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">
                                Focus Keywords
                            </label>
                            <input type="text" class="form-control" name="meta_keywords" id="input_meta_keywords" placeholder="Comma separated keywords e.g. Bhabha University, Admissions, Best Engineering College Bhopal">
                            <small class="text-muted">Target keywords for reference and search engines.</small>
                        </div>

                        <!-- Canonical & Robots Controls -->
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <div class="bg-white p-3 rounded border h-100">
                                    <label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">
                                        Canonical URL
                                    </label>
                                    <input type="url" class="form-control" name="canonical_url" id="input_canonical_url" placeholder="https://www.bhabhauniversity.edu.in/page-url">
                                    <small class="text-muted">Self-referencing canonical URL prevents duplicate content issues.</small>
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="bg-white p-3 rounded border h-100">
                                    <label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">
                                        Robots Indexing Tag
                                    </label>
                                    <select class="form-control" name="robots_tag" id="input_robots_tag">
                                        <option value="inherit">Inherit Global Setting (<?= htmlspecialchars($current_global_index); ?>)</option>
                                        <option value="index, follow">index, follow (Force Crawling)</option>
                                        <option value="noindex, nofollow">noindex, nofollow (Block Bots)</option>
                                        <option value="noindex, follow">noindex, follow</option>
                                    </select>
                                    <small class="text-muted">Override global setting for this specific page if needed.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media (OpenGraph) Dropdown Accordion -->
                        <div class="accordion mb-3" id="socialAccordion">
                            <div class="card border rounded">
                                <div class="card-header bg-white p-2" id="headingSocial">
                                    <button class="btn btn-link btn-block text-left text-dark font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseSocial" aria-expanded="false" aria-controls="collapseSocial" style="text-decoration: none;">
                                        <span><i class="mdi mdi-share-variant mr-1 text-primary"></i> Social Share (OpenGraph / WhatsApp / Twitter) Settings</span>
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                </div>
                                <div id="collapseSocial" class="collapse" aria-labelledby="headingSocial" data-parent="#socialAccordion">
                                    <div class="card-body bg-light">
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold text-dark" style="font-size: 12px;">OG Title</label>
                                            <input type="text" class="form-control form-control-sm" name="og_title" id="input_og_title" placeholder="Defaults to Meta Title if blank">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="font-weight-bold text-dark" style="font-size: 12px;">OG Description</label>
                                            <textarea class="form-control form-control-sm" name="og_description" id="input_og_description" rows="2" placeholder="Defaults to Meta Description if blank"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold text-dark" style="font-size: 12px;">OG Image URL</label>
                                            <input type="text" class="form-control form-control-sm" name="og_image" id="input_og_image" placeholder="<?php echo URL_IMG;?>logo-og.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JSON-LD Structured Data Schema -->
                        <div class="bg-white p-3 rounded border">
                            <label class="font-weight-bold text-dark mb-1" style="font-size: 13px;">
                                <i class="mdi mdi-code-json text-warning mr-1"></i> Custom Schema (JSON-LD Structured Data)
                            </label>
                            <textarea class="form-control font-monospace" name="custom_schema" id="input_custom_schema" rows="3" style="font-family: monospace; font-size: 12px;" placeholder='{ "@context": "https://schema.org", "@type": "WebPage", ... }'></textarea>
                            <small class="text-muted">Optional: Paste valid JSON-LD schema snippet. Do not include &lt;script&gt; tags.</small>
                        </div>

                    </div>
                    <div class="modal-footer bg-white border-top">
                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4" style="background: var(--bu-navy); border-color: var(--bu-navy);">
                            <i class="mdi mdi-content-save mr-1"></i> Save SEO Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once("inc.footer.js.php"); ?>
    <script src="<?php echo URL_PLUG;?>datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo URL_PLUG;?>datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.js"></script>

    <script>
    // Global SEO Pages Lookup Map
    var seoPagesMap = <?php echo json_encode($pages_map, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;

    $(document).ready(function() {
        // Initialize DataTable
        $('#seoDataTable').DataTable({
            "pageLength": 25,
            "order": [[0, "asc"]],
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search by page name, route, or meta title..."
            }
        });

        // Real-time SERP Update & Char Counter Functions
        function updateTitlePreview() {
            var val = $('#input_meta_title').val().trim();
            var len = val.length;
            $('#serp_title').text(val || 'Page Title Preview - Bhabha University Bhopal');
            
            var meter = $('#title_counter');
            meter.text(len + ' / 60 chars (Recommended: 50-60)');
            if (len >= 50 && len <= 60) {
                meter.attr('class', 'char-meter good');
            } else if (len > 60) {
                meter.attr('class', 'char-meter bad');
            } else {
                meter.attr('class', 'char-meter warn');
            }
        }

        function updateDescPreview() {
            var val = $('#input_meta_description').val().trim();
            var len = val.length;
            $('#serp_desc').text(val || 'Page meta description preview will appear here in real-time as you type below.');
            
            var meter = $('#desc_counter');
            meter.text(len + ' / 160 chars (Recommended: 140-160)');
            if (len >= 140 && len <= 160) {
                meter.attr('class', 'char-meter good');
            } else if (len > 160) {
                meter.attr('class', 'char-meter bad');
            } else {
                meter.attr('class', 'char-meter warn');
            }
        }

        $('#input_meta_title').on('input', updateTitlePreview);
        $('#input_meta_description').on('input', updateDescPreview);

        // Populate Modal on Edit Click (Delegated for DataTable Pagination Support)
        $(document).on('click', '.edit-seo-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var data = seoPagesMap[id];

            if (!data) {
                console.error("SEO Record not found for ID:", id);
                return;
            }

            $('#seo_id').val(data.id);
            $('#seo_page_name_hidden').val(data.page_name);
            $('#modal_page_name').text(data.page_name);
            $('#modal_page_route').text(data.page_route);
            $('#serp_slug').text(data.page_route);
            $('#modal_page_cat').text(data.page_category);

            $('#input_meta_title').val(data.meta_title || '');
            $('#input_meta_description').val(data.meta_description || '');
            $('#input_meta_keywords').val(data.meta_keywords || '');
            $('#input_canonical_url').val(data.canonical_url || '');
            $('#input_robots_tag').val(data.robots_tag || 'inherit');
            $('#input_og_title').val(data.og_title || '');
            $('#input_og_description').val(data.og_description || '');
            $('#input_og_image').val(data.og_image || '');
            $('#input_custom_schema').val(data.custom_schema || '');

            updateTitlePreview();
            updateDescPreview();

            $('#editSeoModal').modal('show');
        });
    });
    </script>
</body>
</html>
