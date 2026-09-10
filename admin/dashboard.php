<?php 
include_once("config.php");
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

// Safely fetch live metrics from database
$enquiryCount = 0;
$admissionCount = 0;
$inquiryCount = 0;
$courseCount = 0;
$deptCount = 0;
$instituteCount = 0;
$pageCount = 0;
$homeSecCount = 0;
$homeSecActive = 0;
$researchSecCount = 0;
$researchSecActive = 0;
$newsCount = 0;
$eventsCount = 0;
$galleryCount = 0;
$recruiterCount = 0;

try { $enquiryCount = (int)$db->getValue('enquiry', 'count(*)'); } catch (Exception $e) {}
try { $admissionCount = (int)$db->getValue('admission', 'count(*)'); } catch (Exception $e) {}
try { $inquiryCount = (int)$db->getValue('inquiry', 'count(*)'); } catch (Exception $e) {}
try { $courseCount = (int)$db->getValue('course', 'count(*)'); } catch (Exception $e) {}
try { $deptCount = (int)$db->getValue('department', 'count(*)'); } catch (Exception $e) {}
try { $instituteCount = (int)$db->getValue('institute', 'count(*)'); } catch (Exception $e) {}
try { $pageCount = (int)$db->getValue('page', 'count(*)'); } catch (Exception $e) {}
try { $homeSecCount = (int)$db->getValue('homepage_sections', 'count(*)'); } catch (Exception $e) {}
try { 
    $db->where('status', 1);
    $homeSecActive = (int)$db->getValue('homepage_sections', 'count(*)'); 
} catch (Exception $e) {}
try { $researchSecCount = (int)$db->getValue('research_portal', 'count(*)'); } catch (Exception $e) {}
try { 
    $db->where('status', 1);
    $researchSecActive = (int)$db->getValue('research_portal', 'count(*)'); 
} catch (Exception $e) {}
try { $newsCount = (int)$db->getValue('news', 'count(*)'); } catch (Exception $e) {}
try { $eventsCount = (int)$db->getValue('events', 'count(*)'); } catch (Exception $e) {}
try { $galleryCount = (int)$db->getValue('gallery', 'count(*)'); } catch (Exception $e) {}
try { $recruiterCount = (int)$db->getValue('recruiters', 'count(*)'); } catch (Exception $e) {}

$overviewCount = 0; $reportsCount = 0; $legalCount = 0; $studentPubCount = 0;
try {
    $db->where('category', 'overview');
    $overviewCount = (int)$db->getValue('site_portal_pages', 'count(*)');
} catch (Exception $e) {}
try {
    $db->where('category', 'reports');
    $reportsCount = (int)$db->getValue('site_portal_pages', 'count(*)');
} catch (Exception $e) {}
try {
    $db->where('category', 'legal');
    $legalCount = (int)$db->getValue('site_portal_pages', 'count(*)');
} catch (Exception $e) {}
try {
    $db->where('category', 'student_publications');
    $studentPubCount = (int)$db->getValue('site_portal_pages', 'count(*)');
} catch (Exception $e) {}
$blogCount = 0;
try {
    $blogCount = (int)$db->getValue('site_blogs', 'count(*)');
} catch (Exception $e) {}

// Recent 6 Enquiries
$recentEnquiries = [];
try {
    $db->orderBy('id', 'desc');
    $recentEnquiries = $db->get('enquiry', 6);
} catch (Exception $e) {}

// Recent 4 Admissions
$recentAdmissions = [];
try {
    $db->orderBy('id', 'desc');
    $recentAdmissions = $db->get('admission', 4);
} catch (Exception $e) {}

// Preload course & branch lookup maps for human-readable names
$courseMap = [];
$branchMap = [];
try {
    $coursesList = $db->get('course', null, ['id', 'course']);
    if ($coursesList) {
        foreach ($coursesList as $c) {
            $courseMap[$c['id']] = $c['course'];
        }
    }
} catch (Exception $e) {}
try {
    $branchesList = $db->get('branch', null, ['id', 'branch']);
    if ($branchesList) {
        foreach ($branchesList as $b) {
            $branchMap[$b['id']] = $b['branch'];
        }
    }
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Admin Dashboard - Bhabha University</title>
<?php include_once("inc.meta.php"); ?>

<style>
/* Modern Luxury Dashboard Styles */
.dash-hero-card {
  background: linear-gradient(135deg, #0A1B54 0%, #152B75 55%, #1C358A 100%);
  color: #ffffff;
  border-radius: 12px;
  padding: 30px 32px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(10, 27, 84, 0.18);
  margin-bottom: 28px;
}
.dash-hero-card::after {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 250px;
  height: 250px;
  background: radial-gradient(circle, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0) 70%);
  border-radius: 50%;
  pointer-events: none;
}
.dash-hero-title {
  font-size: 24px;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 6px;
  letter-spacing: -0.3px;
}
.dash-hero-subtitle {
  font-size: 13.5px;
  color: #CBD5E1;
  max-width: 650px;
  line-height: 1.6;
  margin-bottom: 18px;
}
.dash-meta-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.16);
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
  color: #E2E8F0;
  margin-right: 8px;
  margin-bottom: 6px;
}
.dash-meta-badge i {
  color: #FFC107;
}

/* Stat KPI Cards */
.kpi-card {
  background: #ffffff;
  border-radius: 10px;
  padding: 20px 20px;
  margin-bottom: 0;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
  transition: all 0.25s ease;
  position: relative;
  overflow: hidden;
  height: 100%;
  min-height: 170px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 100%;
  box-sizing: border-box;
}
.kpi-card.kpi-card-sm {
  padding: 16px 18px;
  min-height: 125px;
}
.kpi-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
  border-color: #CBD5E1;
}
.kpi-icon-wrap {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  color: #ffffff;
  margin-bottom: 12px;
}
.kpi-icon-blue   { background: linear-gradient(135deg, #2563EB, #1D4ED8); box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25); }
.kpi-icon-green  { background: linear-gradient(135deg, #10B981, #059669); box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25); }
.kpi-icon-amber  { background: linear-gradient(135deg, #F59E0B, #D97706); box-shadow: 0 6px 16px rgba(245, 158, 11, 0.25); }
.kpi-icon-purple { background: linear-gradient(135deg, #8B5CF6, #6D28D9); box-shadow: 0 6px 16px rgba(139, 92, 246, 0.25); }
.kpi-icon-cyan   { background: linear-gradient(135deg, #06B6D4, #0891B2); box-shadow: 0 6px 16px rgba(6, 182, 212, 0.25); }
.kpi-icon-rose   { background: linear-gradient(135deg, #F43F5E, #E11D48); box-shadow: 0 6px 16px rgba(244, 63, 94, 0.25); }

.kpi-page-title {
  font-size: 16px;
  font-weight: 700;
  color: #0A1B54;
  line-height: 1.3;
  margin-bottom: 6px;
  letter-spacing: -0.2px;
}
.kpi-card:hover .kpi-page-title {
  color: #2563EB;
}
.kpi-count-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 12px;
  font-weight: 600;
  padding: 3px 8px;
  border-radius: 5px;
  margin-bottom: 4px;
  line-height: 1.2;
}
.kpi-count-badge i {
  font-size: 11px;
}
.kpi-count-badge.badge-blue   { background: #EFF6FF; color: #1D4ED8; border: 1px solid #DBEAFE; }
.kpi-count-badge.badge-green  { background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; }
.kpi-count-badge.badge-amber  { background: #FFFBEB; color: #B45309; border: 1px solid #FDE68A; }
.kpi-count-badge.badge-cyan   { background: #ECFEFF; color: #0E7490; border: 1px solid #A5F3FC; }
.kpi-count-badge.badge-purple { background: #FAF5FF; color: #6D28D9; border: 1px solid #E9D5FF; }
.kpi-count-badge.badge-rose   { background: #FFF1F2; color: #BE123C; border: 1px solid #FECDD3; }

.kpi-sub {
  font-size: 11.5px;
  color: #94A3B8;
  margin-bottom: 0;
}
.kpi-badge {
  font-size: 10.5px;
  font-weight: 600;
  padding: 2.5px 7px;
  border-radius: 4px;
  float: right;
  margin-top: 2px;
}

/* Quick Hub Tiles */
.hub-tile {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 16px 18px;
  margin-bottom: 0;
  display: flex;
  align-items: center;
  gap: 14px;
  text-decoration: none !important;
  transition: all 0.2s ease;
  width: 100%;
  height: 100%;
  min-height: 92px;
  box-sizing: border-box;
}
.hub-tile:hover {
  border-color: #2563EB;
  background: #F8FAFC;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(37, 99, 235, 0.08);
}
.hub-icon {
  width: 44px;
  height: 44px;
  border-radius: 8px;
  background: #EFF6FF;
  color: #2563EB;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
  transition: all 0.2s ease;
}
.hub-tile:hover .hub-icon {
  background: #2563EB;
  color: #ffffff;
}
.hub-info {
  flex: 1;
  min-width: 0;
}
.hub-title {
  font-size: 14.5px;
  font-weight: 600;
  color: #0F172A;
  margin-bottom: 3px;
  line-height: 1.3;
}
.hub-desc {
  font-size: 12px;
  color: #64748B;
  margin-bottom: 0;
  line-height: 1.35;
}

/* Section Header Bar */
.section-head-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.section-head-title {
  font-size: 16px;
  font-weight: 700;
  color: #0F172A;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}
.section-head-title i {
  color: #0A1B54;
}

/* Table Styling */
.table-dash {
  margin-bottom: 0;
}
.table-dash thead th {
  background: #F8FAFC;
  color: #475569;
  font-size: 11.5px;
  font-weight: 600;
  text-transform: uppercase;
  border-bottom: 1px solid #E2E8F0;
  padding: 11px 14px;
  letter-spacing: 0.5px;
}
.table-dash tbody td {
  padding: 12px 14px;
  vertical-align: middle;
  border-top: 1px solid #F1F5F9;
  font-size: 13px;
  color: #334155;
}
.table-dash tbody tr:hover {
  background: #F8FAFC;
}

/* Status Badges */
.badge-pill-active {
  background: #ECFDF5;
  color: #059669;
  border: 1px solid #A7F3D0;
  padding: 4px 10px;
  border-radius: 12px;
  font-size: 11px;
  font-weight: 600;
}
.badge-course {
  background: #EFF6FF;
  color: #1D4ED8;
  border: 1px solid #BFDBFE;
  padding: 2px 7px;
  border-radius: 4px;
  font-size: 10px;
  font-weight: 600;
  display: inline-block;
  white-space: nowrap;
  line-height: 1.35;
  letter-spacing: 0.2px;
}
</style>
</head>
<body>
<div id="wrapper">
  <!-- Top Bar -->
  <?php include_once("inc.top.php"); ?>  
  <!-- Sidebar -->
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <!-- Welcome Hero Banner -->
        <div class="row pt-3">
          <div class="col-12">
            <div class="dash-hero-card">
              <div class="d-md-flex justify-content-between align-items-center">
                <div>
                  <h2 class="dash-hero-title">
                    <i class="fa fa-tachometer-alt text-warning"></i> Bhabha University Admin Command Center
                  </h2>
                  <p class="dash-hero-subtitle">
                    Centralized management suite for website content, dynamic homepage modules, pharmacy research &amp; commercial products, academic departments, and incoming student applications.
                  </p>
                  <div>
                    <span class="dash-meta-badge">
                      <i class="fa fa-calendar"></i> <?php echo date('l, d F Y'); ?>
                    </span>
                    <span class="dash-meta-badge">
                      <i class="fa fa-database"></i> Database: bhabhaun_mohitdb
                    </span>
                    <span class="dash-meta-badge">
                      <i class="fa fa-shield-alt"></i> System: Online &amp; Encrypted
                    </span>
                  </div>
                </div>
                <div class="mt-3 mt-md-0 text-md-right">
                  <a href="../" target="_blank" class="btn btn-warning btn-sm font-weight-bold px-3 py-2 shadow-sm mb-1">
                    <i class="fa fa-globe"></i> View Website
                  </a>
                  <br>
                  <a href="../research/" target="_blank" class="btn btn-outline-light btn-sm px-3 py-2 mt-1">
                    <i class="fa fa-flask"></i> Preview Research Page
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Row 1: Key Primary KPIs (4 Cards) - Names Highlighted on Top, Counts Underneath -->
        <div class="row">
          <!-- 1. Enquiries -->
          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="enquiry.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card w-100 flex-fill">
                <div>
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="kpi-icon-wrap kpi-icon-blue mb-0">
                      <i class="fa fa-comments"></i>
                    </div>
                    <span class="kpi-badge badge-success"><i class="fa fa-arrow-up"></i> Active</span>
                  </div>
                  <div class="kpi-page-title">Student Enquiries</div>
                  <div>
                    <span class="kpi-count-badge badge-blue">
                      <i class="fa fa-users"></i> <?php echo number_format($enquiryCount); ?> Inquiries
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">Total prospective enquiries logged</p>
              </div>
            </a>
          </div>

          <!-- 2. Admissions -->
          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="admission.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card w-100 flex-fill">
                <div>
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="kpi-icon-wrap kpi-icon-green mb-0">
                      <i class="fa fa-graduation-cap"></i>
                    </div>
                    <span class="kpi-badge badge-primary">Admissions</span>
                  </div>
                  <div class="kpi-page-title">Admission Applications</div>
                  <div>
                    <span class="kpi-count-badge badge-green">
                      <i class="fa fa-id-card"></i> <?php echo number_format($admissionCount); ?> Applications
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">Completed student registrations</p>
              </div>
            </a>
          </div>

          <!-- 3. Homepage Sections -->
          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="homepage_sections.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card w-100 flex-fill">
                <div>
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="kpi-icon-wrap kpi-icon-amber mb-0">
                      <i class="fa fa-home"></i>
                    </div>
                    <span class="kpi-badge badge-info"><?php echo $homeSecActive; ?> / <?php echo $homeSecCount; ?> Live</span>
                  </div>
                  <div class="kpi-page-title">Home Page Sections</div>
                  <div>
                    <span class="kpi-count-badge badge-amber">
                      <i class="fa fa-cubes"></i> <?php echo $homeSecActive; ?> Active Sections
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">Dynamic modules &amp; video showcase</p>
              </div>
            </a>
          </div>

          <!-- 4. Research Portal -->
          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="research.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card w-100 flex-fill">
                <div>
                  <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="kpi-icon-wrap kpi-icon-cyan mb-0">
                      <i class="fa fa-flask"></i>
                    </div>
                    <span class="kpi-badge badge-warning"><?php echo $researchSecActive; ?> / <?php echo $researchSecCount; ?> Live</span>
                  </div>
                  <div class="kpi-page-title">Research Page</div>
                  <div>
                    <span class="kpi-count-badge badge-cyan">
                      <i class="fa fa-flask"></i> <?php echo $researchSecCount; ?> Active Sections
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">Lab stats, products &amp; incubation</p>
              </div>
            </a>
          </div>
        </div>

        <!-- Row 2: Secondary Institutional Stats (4 Cards) -->
        <div class="row">
          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="course.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card kpi-card-sm w-100 flex-fill">
                <div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="kpi-page-title mb-0">Offered Courses</div>
                    <div class="kpi-icon-wrap kpi-icon-purple mb-0" style="width:40px;height:40px;font-size:18px;">
                      <i class="fa fa-book"></i>
                    </div>
                  </div>
                  <div>
                    <span class="kpi-count-badge badge-purple">
                      <?php echo $courseCount; ?> Programs
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">UG, PG &amp; Doctoral degrees</p>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="department.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card kpi-card-sm w-100 flex-fill">
                <div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="kpi-page-title mb-0">Departments</div>
                    <div class="kpi-icon-wrap kpi-icon-green mb-0" style="width:40px;height:40px;font-size:18px;">
                      <i class="fa fa-sitemap"></i>
                    </div>
                  </div>
                  <div>
                    <span class="kpi-count-badge badge-green">
                      <?php echo $deptCount; ?> Depts · <?php echo $instituteCount; ?> Institutes
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">University faculty &amp; colleges</p>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="pages.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card kpi-card-sm w-100 flex-fill">
                <div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="kpi-page-title mb-0">Website Pages</div>
                    <div class="kpi-icon-wrap kpi-icon-blue mb-0" style="width:40px;height:40px;font-size:18px;">
                      <i class="fa fa-file-alt"></i>
                    </div>
                  </div>
                  <div>
                    <span class="kpi-count-badge badge-blue">
                      <?php echo $pageCount; ?> Dynamic Pages
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0">Institutional &amp; content pages</p>
              </div>
            </a>
          </div>

          <div class="col-xl-3 col-md-6 mb-3 d-flex align-items-stretch">
            <a href="media.php" class="w-100 d-flex flex-column" style="text-decoration:none;">
              <div class="kpi-card kpi-card-sm w-100 flex-fill">
                <div>
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="kpi-page-title mb-0">News &amp; Media</div>
                    <div class="kpi-icon-wrap kpi-icon-rose mb-0" style="width:40px;height:40px;font-size:18px;">
                      <i class="fa fa-newspaper"></i>
                    </div>
                  </div>
                  <div>
                    <span class="kpi-count-badge badge-rose">
                      <?php echo ($newsCount + $eventsCount); ?>+ Releases
                    </span>
                  </div>
                </div>
                <p class="kpi-sub mt-2 mb-0"><?php echo $newsCount; ?> News · <?php echo $eventsCount; ?> Events</p>
              </div>
            </a>
          </div>
        </div>

        <!-- Row 3: Quick Action Hubs (Command Center) -->
        <div class="row mt-2">
          <div class="col-12">
            <div class="section-head-bar">
              <h3 class="section-head-title">
                <i class="fa fa-bolt"></i> Quick Management Hubs
              </h3>
              <small class="text-muted">Instant navigation to core university configuration panels</small>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="homepage_sections.php" class="hub-tile">
              <div class="hub-icon">
                <i class="fa fa-home"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Home Page Sections</div>
                <div class="hub-desc">Hero Video, Welcome, Why Bhabha, Reels</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="research.php" class="hub-tile">
              <div class="hub-icon" style="background:#ECFDF5; color:#059669;">
                <i class="fa fa-flask"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Research Page</div>
                <div class="hub-desc">Pharma Labs, Products, Incubation &amp; Papers</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="university_overview.php" class="hub-tile">
              <div class="hub-icon" style="background:#EFF6FF; color:#1D4ED8;">
                <i class="fa fa-university"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">University Overview</div>
                <div class="hub-desc"><?php echo $overviewCount; ?> Pages · About, Vision, Values, Why Us</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="reports_accreditation.php" class="hub-tile">
              <div class="hub-icon" style="background:#ECFDF5; color:#047857;">
                <i class="fa fa-certificate"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Reports &amp; Accreditation</div>
                <div class="hub-desc"><?php echo $reportsCount; ?> Pages · NIRF, IQAC, Audit, UGC</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="policies.php" class="hub-tile">
              <div class="hub-icon" style="background:#EEF2FF; color:#4338CA;">
                <i class="fa fa-balance-scale"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Legal &amp; Policies</div>
                <div class="hub-desc"><?php echo $legalCount; ?> Pages · Privacy, Terms, Refund, AICTE</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="student_publications.php" class="hub-tile">
              <div class="hub-icon" style="background:#FEF3C7; color:#B45309;">
                <i class="fa fa-book"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Student &amp; Publications</div>
                <div class="hub-desc"><?php echo $studentPubCount; ?> Pages · Magazine, Newsletters, Scholarships</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="blogs.php" class="hub-tile">
              <div class="hub-icon" style="background:#FFF1F2; color:#BE123C;">
                <i class="fa fa-rss"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Blogs &amp; Articles</div>
                <div class="hub-desc"><?php echo $blogCount; ?> Posts · Monthly research, academic &amp; tech articles</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="pages.php" class="hub-tile">
              <div class="hub-icon" style="background:#FEF3C7; color:#D97706;">
                <i class="fa fa-file-code"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Website Pages</div>
                <div class="hub-desc">Edit static &amp; dynamic website pages</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="enquiry.php" class="hub-tile">
              <div class="hub-icon" style="background:#F5F3FF; color:#7C3AED;">
                <i class="fa fa-users"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Course Enquiries</div>
                <div class="hub-desc">Review &amp; follow up 25k+ student inquiries</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="admission.php" class="hub-tile">
              <div class="hub-icon" style="background:#ECFDF5; color:#10B981;">
                <i class="fa fa-id-card"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Admissions</div>
                <div class="hub-desc">Application forms, certificates &amp; fees</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="department.php" class="hub-tile">
              <div class="hub-icon" style="background:#EFF6FF; color:#2563EB;">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Departments &amp; Courses</div>
                <div class="hub-desc">Academic structure &amp; course catalogs</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="media.php" class="hub-tile">
              <div class="hub-icon" style="background:#FFF1F2; color:#E11D48;">
                <i class="fa fa-camera"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Media &amp; Gallery</div>
                <div class="hub-desc">News press, photo gallery &amp; downloads</div>
              </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 mb-3 d-flex align-items-stretch">
            <a href="recruiters.php" class="hub-tile">
              <div class="hub-icon" style="background:#FEF9C3; color:#CA8A04;">
                <i class="fa fa-briefcase"></i>
              </div>
              <div class="hub-info">
                <div class="hub-title">Corporate Recruiters</div>
                <div class="hub-desc">Placement partners &amp; recruiters logos</div>
              </div>
            </a>
          </div>
        </div>

        <!-- Row 4: Recent Live Activity & System Health -->
        <div class="row mt-3">
          <!-- Recent Enquiries Table -->
          <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0" style="border-radius:10px; overflow:hidden;">
              <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                  <div>
                    <h4 class="m-0 font-weight-bold" style="font-size:15.5px; color:#0F172A;">
                      <i class="fa fa-clock text-primary"></i> Recent Course Enquiries
                    </h4>
                    <small class="text-muted">Latest student enquiries received through the portal</small>
                  </div>
                  <a href="enquiry.php" class="btn btn-outline-primary btn-sm font-weight-bold">
                    View All (<?php echo number_format($enquiryCount); ?>)
                  </a>
                </div>

                <div class="table-responsive">
                  <table class="table table-dash table-hover">
                    <thead>
                      <tr>
                        <th>Candidate Name</th>
                        <th style="min-width: 175px;">Course / Program</th>
                        <th>Contact</th>
                        <th>Place</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($recentEnquiries)): 
                        foreach ($recentEnquiries as $enq): 
                          $cName = '';
                          if (!empty($enq['course'])) {
                              if (isset($courseMap[$enq['course']])) {
                                  $cName = $courseMap[$enq['course']];
                              } elseif (!is_numeric($enq['course'])) {
                                  $cName = $enq['course'];
                              }
                          }

                          $bName = '';
                          if (!empty($enq['branch'])) {
                              if (isset($branchMap[$enq['branch']])) {
                                  $bName = $branchMap[$enq['branch']];
                              } elseif (!is_numeric($enq['branch']) && $enq['branch'] !== 'Select Branch') {
                                  $bName = $enq['branch'];
                              }
                          }
                      ?>
                      <tr>
                        <td>
                          <strong class="text-dark"><?php echo htmlspecialchars($enq['name'] ?: 'Applicant'); ?></strong>
                        </td>
                        <td>
                          <?php if (!empty($cName)): ?>
                            <span class="badge-course"><?php echo htmlspecialchars($cName); ?></span>
                          <?php else: ?>
                            <span class="text-muted small">—</span>
                          <?php endif; ?>
                          <?php if (!empty($bName)): ?>
                            <small class="text-muted d-block mt-1 font-weight-normal"><?php echo htmlspecialchars($bName); ?></small>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if (!empty($enq['mobile'])): ?>
                            <a href="tel:<?php echo htmlspecialchars($enq['mobile']); ?>" class="text-dark">
                              <i class="fa fa-phone text-muted small"></i> <?php echo htmlspecialchars($enq['mobile']); ?>
                            </a>
                          <?php endif; ?>
                          <?php if (!empty($enq['email'])): ?>
                            <br><small class="text-muted"><?php echo htmlspecialchars($enq['email']); ?></small>
                          <?php endif; ?>
                        </td>
                        <td>
                          <small class="text-muted"><?php echo htmlspecialchars($enq['place'] ?? '—'); ?></small>
                        </td>
                        <td>
                          <small class="text-muted"><?php echo htmlspecialchars($enq['date'] ?? 'Recent'); ?></small>
                        </td>
                      </tr>
                      <?php endforeach; else: ?>
                      <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No recent enquiries found.</td>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>

          <!-- System Status & Quick Summary -->
          <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0" style="border-radius:10px; overflow:hidden;">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4 class="m-0 font-weight-bold" style="font-size:15.5px; color:#0F172A;">
                    <i class="fa fa-server text-info"></i> Portal Environment
                  </h4>
                  <span class="badge-pill-active">Healthy</span>
                </div>

                <div class="p-3 mb-3" style="background:#F8FAFC; border-radius:8px; border:1px solid #E2E8F0;">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Institution:</span>
                    <strong class="small text-dark">Bhabha University</strong>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Admin Role:</span>
                    <strong class="small text-primary">Master Administrator</strong>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Server Timezone:</span>
                    <strong class="small text-dark">Asia/Kolkata (IST)</strong>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">PHP Environment:</span>
                    <strong class="small text-dark"><?php echo phpversion(); ?></strong>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span class="text-muted small">Database Status:</span>
                    <strong class="small text-success"><i class="fa fa-check-circle"></i> Connected</strong>
                  </div>
                </div>

                <h5 class="font-weight-bold mb-2" style="font-size:13.5px; color:#0F172A;">
                  Recent Admission Submissions
                </h5>
                <?php if (!empty($recentAdmissions)): 
                  foreach ($recentAdmissions as $adm):
                    $admCourse = '';
                    if (!empty($adm['course'])) {
                        if (isset($courseMap[$adm['course']])) {
                            $admCourse = $courseMap[$adm['course']];
                        } elseif (!is_numeric($adm['course'])) {
                            $admCourse = $adm['course'];
                        }
                    }
                    if (empty($admCourse)) {
                        $admCourse = 'UG/PG Program';
                    }
                ?>
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                  <div>
                    <strong class="text-dark font-13"><?php echo htmlspecialchars($adm['name'] ?: 'Applicant'); ?></strong>
                    <br><small class="text-muted"><?php echo htmlspecialchars($admCourse); ?></small>
                  </div>
                  <span class="badge badge-light border"><?php echo htmlspecialchars($adm['date'] ?? 'Recent'); ?></span>
                </div>
                <?php endforeach; else: ?>
                <p class="text-muted small">No recent admissions.</p>
                <?php endif; ?>

                <div class="mt-3 text-center">
                  <a href="admission.php" class="btn btn-sm btn-block btn-outline-secondary font-weight-bold">
                    View All Admissions <i class="fa fa-arrow-right"></i>
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>
<?php include_once("inc.footer.js.php"); ?>
</body>
</html>