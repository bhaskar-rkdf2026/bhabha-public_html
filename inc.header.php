<?php
// Bhabha University - Dynamic Modern Header & Navigation Section
$hc = getHeaderConfig();
?>
<header class="bu-header-wrapper">
  <!-- 1. Top Utility Bar -->
  <div class="bu-topbar">
    <div class="bu-topbar-container">
      <div class="bu-topbar-left">
        <ul class="bu-topbar-links">
          
          <!-- MOBILE ONLY: Info Corner Master Dropdown -->
          <li class="bu-topbar-dropdown bu-show-mobile-only">
            <a href="javascript:void(0);" class="bu-topbar-drop-toggle bu-info-corner-badge">
              <i class="fa fa-th mr-1" style="color: #FFC107;"></i> Info Corner <i class="fa fa-angle-down ml-1"></i>
            </a>
            <div class="bu-topbar-drop-menu bu-info-corner-menu">
              <!-- Mobile Close Header -->
              <div class="bu-info-menu-topbar">
                <span class="bu-info-menu-title"><i class="fa fa-th text-warning mr-1"></i> Quick Portals &amp; Links</span>
                <button type="button" class="bu-info-close-btn" id="buInfoCloseBtn" title="Close Panel">&times;</button>
              </div>

              <div class="bu-info-grid">
                
                <!-- Column 1: Logins & Portals -->
                <div class="bu-info-col">
                  <div class="bu-info-head"><i class="fa fa-graduation-cap"></i> Student &amp; Staff Logins</div>
                  <a href="<?php echo htmlspecialchars($hc['erp_resultsoft_url']); ?>" target="_blank" style="color: #FFC107 !important; font-weight: 700;"><i class="fa fa-file-text-o text-warning"></i> Resultsoft Portal</a>
                  <a href="<?php echo htmlspecialchars($hc['erp_student_url']); ?>" target="_blank"><i class="fa fa-graduation-cap text-warning"></i> Student ERP Login</a>
                  <a href="<?php echo htmlspecialchars($hc['erp_faculty_url']); ?>" target="_blank"><i class="fa fa-briefcase text-info"></i> Faculty Portal Login</a>
                  <a href="<?php echo htmlspecialchars($hc['erp_student_url']); ?>" target="_blank"><i class="fa fa-id-card text-success"></i> ERP System Login</a>
                  <a href="<?php echo htmlspecialchars($hc['erp_oap_url']); ?>" target="_blank"><i class="fa fa-shield text-danger"></i> OAP Admin Login</a>
                  <a href="<?php echo htmlspecialchars($hc['webmail_url']); ?>" target="_blank"><i class="fa fa-envelope text-primary"></i> Official Web Mail</a>
                  <a href="<?php echo htmlspecialchars($hc['verification_url']); ?>" target="_blank"><i class="fa fa-check-circle text-warning"></i> Online Verification</a>
                  <a href="<?php echo htmlspecialchars($hc['nad_url']); ?>"><i class="fa fa-certificate text-danger"></i> NAD (DigiLocker)</a>
                </div>

                <!-- Column 2: University Links & Compliance -->
                <div class="bu-info-col">
                  <div class="bu-info-head"><i class="fa fa-university"></i> Quick University Services</div>
                  <a href="<?php echo htmlspecialchars($hc['disclosure_url']); ?>" target="_blank"><i class="fa fa-file-pdf-o text-danger"></i> Mandatory Public Disclosure</a>
                  <a href="<?php echo htmlspecialchars($hc['nirf_url']); ?>"><i class="fa fa-trophy text-warning"></i> NIRF Rankings &amp; Data</a>
                  <a href="<?php echo htmlspecialchars($hc['iqac_url']); ?>"><i class="fa fa-check-square-o text-success"></i> IQAC Quality Assurance</a>
                  <a href="<?php echo href('grievance.php'); ?>"><i class="fa fa-balance-scale text-primary"></i> Grievance Redressal Cell</a>
                  <a href="<?php echo href('enquiry.php'); ?>"><i class="fa fa-phone-square text-warning"></i> Admission Enquiry</a>
                  <a href="<?php echo href('placements.php'); ?>"><i class="fa fa-briefcase text-info"></i> T &amp; P Placement Cell</a>
                  <a href="<?php echo htmlspecialchars($hc['blog_url']); ?>"><i class="fa fa-newspaper-o text-primary"></i> Latest Blogs &amp; News</a>
                  <a href="<?php echo href('notice.php'); ?>"><i class="fa fa-bullhorn text-danger"></i> Official Notices</a>
                  <a href="<?php echo htmlspecialchars($hc['alumni_url']); ?>"><i class="fa fa-users text-success"></i> Alumni Network Portal</a>
                </div>

              </div>
            </div>
          </li>

          <!-- MOBILE ONLY: Students / ERP Login -->
          <li class="bu-show-mobile-only"><a href="<?php echo htmlspecialchars($hc['erp_student_url']); ?>" target="_blank"><i class="fa fa-user mr-1 text-warning"></i> <span style="color:#FFC107 !important; font-weight:800;">Students / ERP Login</span></a></li>

          <!-- ============================================================
               DESKTOP TOP MENU ITEMS (Dynamic WordPress-style Menu Order)
               ============================================================ -->
          <?php if ($hc['show_erp_dropdown'] == '1' && !empty($hc['erp_links']) && is_array($hc['erp_links'])): ?>
          <!-- ERP Login Dropdown -->
          <li class="bu-erp-dropdown bu-hide-mobile">
            <a href="javascript:void(0);" class="bu-erp-toggle-link">
              <i class="fa fa-user-circle mr-1"></i> ERP Login <i class="fa fa-angle-down ml-1"></i>
            </a>
            <div class="bu-erp-menu">
              <?php foreach ($hc['erp_links'] as $elp): ?>
                <?php if (!isset($elp['show']) || $elp['show'] == '1'): ?>
                  <a href="<?php echo htmlspecialchars($elp['url']); ?>" target="_blank">
                    <i class="<?php echo !empty($elp['icon']) ? htmlspecialchars($elp['icon']) : 'fa fa-link'; ?>"></i> 
                    <?php echo htmlspecialchars($elp['label']); ?>
                  </a>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </li>
          <?php endif; ?>

          <!-- Dynamic Top Quick Links in Drag-and-Drop Configured Order -->
          <?php if (!empty($hc['top_quick_links']) && is_array($hc['top_quick_links'])): ?>
            <?php foreach ($hc['top_quick_links'] as $tlink): ?>
              <?php if (!isset($tlink['show']) || $tlink['show'] == '1'): ?>
                <?php 
                  $tlink_url = $tlink['url'];
                  if (!preg_match('/^(https?:\/\/|\/|#|tel:|mailto:)/i', $tlink_url)) {
                      $tlink_url = URL_ROOT . ltrim($tlink_url, '/');
                  }
                  $is_news = (isset($tlink['type']) && $tlink['type'] === 'news') || 
                             (isset($tlink['id']) && $tlink['id'] === 't9') || 
                             (stripos($tlink['label'], 'news') !== false);
                  $is_alumni = (isset($tlink['type']) && $tlink['type'] === 'alumni') || 
                               (isset($tlink['id']) && $tlink['id'] === 't1') || 
                               (stripos($tlink['label'], 'alumni') !== false);
                ?>
                <?php if ($is_news): ?>
                  <!-- Top Bar News & Media Dropdown -->
                  <li class="bu-hide-mobile bu-topbar-news-drop">
                    <a href="<?php echo htmlspecialchars($tlink_url); ?>" class="bu-topbar-news-link" target="<?php echo !empty($tlink['target']) ? htmlspecialchars($tlink['target']) : '_self'; ?>">
                      <?php echo htmlspecialchars($tlink['label']); ?> <i class="fa fa-angle-down ml-1" style="font-size:10px;"></i>
                    </a>
                    <div class="bu-topbar-news-menu">
                      <a href="<?php echo href("news.php"); ?>"><i class="fa fa-newspaper-o text-warning"></i> Latest News &amp; Events</a>
                      <a href="<?php echo href("newsletter.php"); ?>"><i class="fa fa-envelope text-info"></i> E-Newsletter</a>
                      <a href="<?php echo href("magazine.php"); ?>"><i class="fa fa-book text-success"></i> University Magazine</a>
                      <a href="<?php echo htmlspecialchars(!empty($hc['blog_url']) ? $hc['blog_url'] : 'blogs.php'); ?>"><i class="fa fa-rss text-primary"></i> Research &amp; Tech Blogs</a>
                      <a href="<?php echo href("gallery.php"); ?>"><i class="fa fa-picture-o text-warning"></i> Photo Gallery</a>
                      <a href="<?php echo href("notice.php"); ?>"><i class="fa fa-bullhorn text-danger"></i> Official Notices</a>
                    </div>
                  </li>
                <?php elseif ($is_alumni): ?>
                  <!-- Top Bar Alumni Dropdown -->
                  <li class="bu-hide-mobile bu-topbar-alumni-drop">
                    <a href="<?php echo htmlspecialchars($tlink_url); ?>" class="bu-topbar-alumni-link" target="<?php echo !empty($tlink['target']) ? htmlspecialchars($tlink['target']) : '_self'; ?>">
                      <?php echo htmlspecialchars($tlink['label']); ?> <i class="fa fa-angle-down ml-1" style="font-size:10px;"></i>
                    </a>
                    <div class="bu-topbar-alumni-menu">
                      <a href="<?php echo href("alumni.php#association"); ?>"><i class="fa fa-university"></i> Alumni Association</a>
                      <a href="<?php echo href("alumni.php#registration"); ?>"><i class="fa fa-pencil-square-o"></i> Alumni Registration</a>
                      <a href="<?php echo href("alumni.php#membership"); ?>"><i class="fa fa-users"></i> Alumni Membership</a>
                      <a href="<?php echo href("alumni.php#events"); ?>"><i class="fa fa-calendar"></i> Events &amp; Networking</a>
                      <a href="<?php echo href("alumni.php#achievements"); ?>"><i class="fa fa-trophy"></i> Alumni Achievements</a>
                      <a href="<?php echo href("alumni.php#interaction"); ?>"><i class="fa fa-comments-o"></i> Student Interaction</a>
                    </div>
                  </li>
                <?php else: ?>
                  <li class="bu-hide-mobile">
                    <a href="<?php echo htmlspecialchars($tlink_url); ?>" target="<?php echo !empty($tlink['target']) ? htmlspecialchars($tlink['target']) : '_self'; ?>">
                      <?php echo htmlspecialchars($tlink['label']); ?>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>

      <div class="bu-topbar-right">
        <!-- Phone Number (Desktop) -->
        <?php if ($hc['show_top_contacts'] == '1' && !empty($hc['phone_one'])): ?>
          <a href="tel:<?php echo htmlspecialchars($hc['phone_one']); ?>" class="bu-topbar-phone bu-hide-mobile">
            <i class="fa fa-phone"></i> <?php echo htmlspecialchars($hc['phone_one']); ?>
          </a>
        <?php endif; ?>

        <!-- MOBILE ONLY: Small Top Apply Button -->
        <?php if (!empty($hc['apply_top_url'])): ?>
          <a href="<?php echo htmlspecialchars($hc['apply_top_url']); ?>" class="bu-btn-top-gold bu-show-mobile-only">
            <i class="fa fa-graduation-cap"></i> 
            <?php if ($hc['apply_top_blink'] == '1'): ?>
              <span class="bu-blink"><?php echo htmlspecialchars($hc['apply_top_text']); ?></span>
            <?php else: ?>
              <span><?php echo htmlspecialchars($hc['apply_top_text']); ?></span>
            <?php endif; ?>
          </a>
        <?php endif; ?>

        <!-- DESKTOP: Social Media Icons -->
        <?php if ($hc['show_social_links'] == '1'): ?>
        <div class="bu-topbar-socials bu-hide-mobile">
          <?php if (!empty($hc['facebook_url'])): ?><a href="<?php echo htmlspecialchars($hc['facebook_url']); ?>" target="_blank" rel="noopener noreferrer" class="bu-social-btn bu-fb" title="Facebook"><i class="fa fa-facebook"></i></a><?php endif; ?>
          <?php if (!empty($hc['instagram_url'])): ?><a href="<?php echo htmlspecialchars($hc['instagram_url']); ?>" target="_blank" rel="noopener noreferrer" class="bu-social-btn bu-insta" title="Instagram"><i class="fa fa-instagram"></i></a><?php endif; ?>
          <?php if (!empty($hc['twitter_url'])): ?><a href="<?php echo htmlspecialchars($hc['twitter_url']); ?>" target="_blank" rel="noopener noreferrer" class="bu-social-btn bu-tw" title="Twitter / X"><i class="fa fa-twitter"></i></a><?php endif; ?>
          <?php if (!empty($hc['youtube_url'])): ?><a href="<?php echo htmlspecialchars($hc['youtube_url']); ?>" target="_blank" rel="noopener noreferrer" class="bu-social-btn bu-yt" title="YouTube"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
          <?php if (!empty($hc['linkedin_url'])): ?><a href="<?php echo htmlspecialchars($hc['linkedin_url']); ?>" target="_blank" rel="noopener noreferrer" class="bu-social-btn bu-li" title="LinkedIn"><i class="fa fa-linkedin"></i></a><?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- 2. Main Header & Navigation Bar -->
  <div class="bu-main-header">
    <div class="bu-header-container">
      
      <!-- Brand Logo -->
      <a href="<?php echo URL_ROOT;?>" class="bu-brand">
        <img src="<?php echo URL_IMG . htmlspecialchars($hc['brand_logo']); ?>" alt="Bhabha University Emblem" class="bu-brand-logo" width="65" height="65" fetchpriority="high" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
        <div class="bu-brand-text">
          <span class="bu-brand-name-1"><?php echo htmlspecialchars($hc['brand_name_1']); ?></span>
          <span class="bu-brand-name-2"><?php echo htmlspecialchars($hc['brand_name_2']); ?></span>
        </div>
      </a>

      <!-- Mobile Nav Backdrop -->
      <div id="buNavBackdrop" class="bu-nav-backdrop"></div>

      <!-- Main Navigation Menu -->
      <nav class="bu-navbar" id="buNavbar">
        <div class="bu-mobile-drawer-head">
          <div class="bu-drawer-brand">
            <img src="<?php echo URL_IMG . htmlspecialchars($hc['brand_logo']); ?>" alt="Logo" class="bu-drawer-logo" width="38" height="38" loading="lazy" decoding="async" onerror="this.src='<?php echo URL_IMG;?>logo.png'">
            <div class="bu-brand-text" style="display:flex; flex-direction:column; justify-content:center;">
              <span class="bu-brand-name-1" style="font-size:18px !important; letter-spacing:1.2px !important; line-height:1 !important;"><?php echo htmlspecialchars($hc['brand_name_1']); ?></span>
              <span class="bu-brand-name-2" style="font-size:10.2px !important; letter-spacing:1.6px !important; line-height:1.15 !important;"><?php echo htmlspecialchars($hc['brand_name_2']); ?></span>
            </div>
          </div>
          <button type="button" class="bu-drawer-close" id="buDrawerCloseBtn" aria-label="Close Menu">&times;</button>
        </div>
        
        <ul class="bu-nav-menu">
          <?php if (!empty($hc['main_nav_items']) && is_array($hc['main_nav_items'])): ?>
            <?php foreach ($hc['main_nav_items'] as $item): ?>
              <?php 
                if (isset($item['show']) && $item['show'] == '0') continue;
                $i_type   = !empty($item['type']) ? $item['type'] : 'custom';
                $i_label  = !empty($item['label']) ? $item['label'] : 'Menu';
                $i_url    = !empty($item['url']) ? $item['url'] : '#';
                $i_target = !empty($item['target']) ? $item['target'] : '_self';
              ?>

              <?php if ($i_type === 'home'): ?>
                <!-- 1. Home -->
                <li class="bu-nav-item">
                  <a href="<?php echo href($i_url !== '#' ? $i_url : 'index.php'); ?>" class="bu-nav-link" target="<?php echo htmlspecialchars($i_target); ?>"><?php echo htmlspecialchars($i_label); ?></a>
                </li>

              <?php elseif ($i_type === 'about'): ?>
                <!-- 2. About Dropdown -->
                <li class="bu-nav-item">
                  <a href="<?php echo href('about.php');?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown bu-dropdown-2col">
                    <li><a href="<?php echo href('about.php');?>">About Us</a></li>
                    <li><a href="<?php echo href("university.php");?>">University Overview</a></li>
                    <li><a href="<?php echo href("mission-vision.php");?>">Vision &amp; Mission</a></li>
                    <li><a href="<?php echo href("infrastructure.php")?>">Campus &amp; Infrastructure</a></li>
                    <li><a href="<?php echo href('values.php'); ?>">Core Values</a></li>
                    <li><a href="<?php echo href('leadership.php'); ?>">Administration &amp; Leadership</a></li>
                    <li><a href="<?php echo href('clubs.php'); ?>"><strong>University Clubs &amp; Societies</strong></a></li>
                    <li><a href="<?php echo href('why-us.php'); ?>">Why Choose Bhabha University</a></li>
                    <li><a href="<?php echo href("awards.php")?>">Awards &amp; Achievements</a></li>
                    <li><a href="<?php echo href("advisory.php")?>">Cells &amp; Committees</a></li>
                    <li><a href="<?php echo href('iqac.php'); ?>">IQAC (Internal Quality Assurance)</a></li>
                    <li><a href="<?php echo href("approvals.php")?>">Approvals &amp; Recognitions</a></li>
                    <li><a href="<?php echo htmlspecialchars($hc['disclosure_url']); ?>" target="_blank">Mandatory Public Disclosure</a></li>
                    <li><a href="<?php echo URL_UPLOAD; ?>media/ffe90b0c7e9e55b00b1207aee3ce3971.pdf" target="_blank">Sponsoring Detail</a></li>
                    <li><a href="<?php echo href('auditreport.php'); ?>">Finance Officer &gt; Audit Report</a></li>
                    <li><a href="<?php echo URL_UPLOAD; ?>media/671d06f0fea73f07576a994c4343281c.pdf" target="_blank">Annual Report 2024</a></li>
                    <li><a href="<?php echo href('ugc-proforma.php'); ?>">UGC Proforma</a></li>
                    <li><a href="<?php echo href('gallery.php'); ?>">Photo Gallery</a></li>
                  </ul>
                </li>

              <?php elseif ($i_type === 'institutes'): ?>
                <!-- 3. Schools / Institutes Dynamic Dropdown -->
                <li class="bu-nav-item">
                  <a href="<?php echo href("institutes.php")?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown bu-dropdown-2col">
                    <?php
                    $institutes = $db->get('department');
                    if(is_array($institutes) && count($institutes) > 0) {
                      foreach($institutes as $iinstitutes) {
                        echo '<li><a href="'.href("department.php","id=".$iinstitutes['id']."").'">'.$iinstitutes['title'].'</a></li>';
                      }
                    } else {
                      echo '<li><a href="'.href("institutes.php").'">All Institutes</a></li>';
                    }
                    ?>
                  </ul>
                </li>

              <?php elseif ($i_type === 'programmes'): ?>
                <!-- 4. Academic Programmes Dropdown -->
                <li class="bu-nav-item">
                  <a href="<?php echo href("programmes.php")?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown">
                    <?php
                    $hdr_progs = [];
                    if (isset($db) && is_object($db)) {
                        try {
                            $hdr_progs = $db->rawQuery("SELECT * FROM program ORDER BY id ASC");
                        } catch (\Throwable $e) {}
                    }
                    if (!empty($hdr_progs)) {
                        // Sort by sort_order if present, otherwise by id
                        usort($hdr_progs, function($a, $b) {
                            $sa = isset($a['sort_order']) ? (int)$a['sort_order'] : (int)$a['id'];
                            $sb = isset($b['sort_order']) ? (int)$b['sort_order'] : (int)$b['id'];
                            return $sa <=> $sb;
                        });
                        // Filter out inactive if status column exists
                        $hdr_progs = array_filter($hdr_progs, function($hp) {
                            return !isset($hp['status']) || (int)$hp['status'] === 1;
                        });

                        // Ensure Integrated Programmes is always included
                        $has_integrated = false;
                        foreach ($hdr_progs as $hp) {
                            if (stripos($hp['program'] ?? '', 'integ') !== false || ($hp['slug'] ?? '') === 'integrated') {
                                $has_integrated = true;
                                break;
                            }
                        }
                        if (!$has_integrated) {
                            $hdr_progs[] = [
                                'id'         => 6,
                                'program'    => 'Integrated Programmes',
                                'slug'       => 'integrated',
                                'icon'       => 'fa-cubes',
                                'sort_order' => 6,
                                'status'     => 1
                            ];
                        }

                        $icon_color_map = [
                            'undergraduate' => 'text-warning',
                            'postgraduate'  => 'text-info',
                            'doctoral'      => 'text-danger',
                            'diploma'       => 'text-success',
                            'certificate'   => 'text-warning',
                            'integrated'    => 'text-primary'
                        ];
                        foreach ($hdr_progs as $hp) {
                            $hp_name = trim($hp['program']);
                            $hp_slug = !empty($hp['slug']) ? $hp['slug'] : '';
                            if (empty($hp_slug)) {
                                if (stripos($hp_name, 'integ') !== false) $hp_slug = 'integrated';
                                elseif (stripos($hp_name, 'post') !== false || stripos($hp_name, 'pg') !== false) $hp_slug = 'postgraduate';
                                elseif (stripos($hp_name, 'phd') !== false || stripos($hp_name, 'doc') !== false) $hp_slug = 'doctoral';
                                elseif (stripos($hp_name, 'dip') !== false) $hp_slug = 'diploma';
                                elseif (stripos($hp_name, 'cert') !== false) $hp_slug = 'certificate';
                                elseif (stripos($hp_name, 'grad') !== false || stripos($hp_name, 'ug') !== false) $hp_slug = 'undergraduate';
                                else $hp_slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $hp_name), '-'));
                            }
                            $hp_icon = !empty($hp['icon']) ? $hp['icon'] : ($hp_slug === 'integrated' ? 'fa-cubes' : 'fa-graduation-cap');
                            $hp_color = $icon_color_map[$hp_slug] ?? 'text-primary';
                            if (stripos($hp_name, 'programme') === false && stripos($hp_name, 'program') === false) {
                                $hp_display = $hp_name . ' programmes';
                            } else {
                                $hp_display = $hp_name;
                            }
                            if (!empty($hp['custom_url'])) {
                                $target_url = (strpos($hp['custom_url'], 'http') === 0) ? $hp['custom_url'] : href($hp['custom_url']);
                            } else {
                                $target_url = href("programmes.php", "type=" . urlencode($hp_slug));
                            }
                            ?>
                            <li><a href="<?php echo $target_url; ?>"><i class="fa <?php echo $hp_icon . ' ' . $hp_color; ?> mr-2"></i> <?php echo htmlspecialchars($hp_display); ?></a></li>
                            <?php
                        }
                    } else {
                        ?>
                        <li><a href="<?php echo href("programmes.php","type=undergraduate")?>"><i class="fa fa-graduation-cap text-warning mr-2"></i> Under Graduate programmes</a></li>
                        <li><a href="<?php echo href("programmes.php","type=postgraduate")?>"><i class="fa fa-book text-info mr-2"></i> Post Graduate programmes</a></li>
                        <li><a href="<?php echo href("programmes.php","type=doctoral")?>"><i class="fa fa-university text-danger mr-2"></i> Doctoral Programmes</a></li>
                        <li><a href="<?php echo href("programmes.php","type=integrated")?>"><i class="fa fa-cubes text-primary mr-2"></i> Integrated Programmes</a></li>
                        <li><a href="<?php echo href("programmes.php","type=diploma")?>"><i class="fa fa-certificate text-success mr-2"></i> Diploma Programmes</a></li>
                        <li><a href="<?php echo href("programmes.php","type=certificate")?>"><i class="fa fa-file-text-o text-warning mr-2"></i> Certificate Programmes</a></li>
                        <?php
                    }
                    ?>
                  </ul>
                </li>

              <?php elseif ($i_type === 'academics'): ?>
                <!-- 5. Academics + Examinations Dropdown (2-Column) -->
                <li class="bu-nav-item">
                  <a href="#" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <div class="bu-dropdown bu-acad-dropdown">
                    <!-- Column 1: Academics -->
                    <div class="bu-acad-col">
                      <div class="bu-acad-col-heading"><i class="fa fa-book"></i> Academics</div>
                      <ul>
                        <li><a href="<?php echo href("faculties.php")?>">Faculties &amp; Institutes</a></li>
                        <li><a href="<?php echo href("syllabus.php")?>">Scheme &amp; Syllabus</a></li>
                        <li><a href="<?php echo href("academic.php")?>">Academic Calendar</a></li>
                        <li><a href="<?php echo href("page.php","id=9");?>">MOU &amp; Collaborations</a></li>
                        <li><a href="<?php echo href("page.php","id=8");?>">Online Video Resources</a></li>
                      </ul>
                    </div>
                    <!-- Column 2: Examinations -->
                    <div class="bu-acad-col">
                      <div class="bu-acad-col-heading"><i class="fa fa-pencil-square-o"></i> Examinations</div>
                      <ul>
                        <li><a href="<?php echo htmlspecialchars($hc['erp_resultsoft_url']); ?>" target="_blank" style="color: #FFC107 !important; font-weight:700;"><i class="fa fa-external-link text-warning mr-1"></i> Resultsoft Portal</a></li>
                        <li><a href="<?php echo href("page.php","id=16");?>">Online Examination Process</a></li>
                        <li><a href="<?php echo href("examination.php")?>">Examination Notices</a></li>
                        <li><a href="<?php echo href("time-table.php")?>">Exam Time Table</a></li>
                        <li><a href="<?php echo htmlspecialchars($hc['erp_student_url']); ?>" target="_blank">Examination Results</a></li>
                        <li><a href="<?php echo htmlspecialchars($hc['erp_student_url']); ?>" target="_blank">Student Login</a></li>
                        <li><a href="<?php echo href('BUQuestionPapers_demo.php'); ?>">Previous Question Papers</a></li>
                      </ul>
                    </div>
                  </div>
                </li>

              <?php elseif ($i_type === 'research'): ?>
                <!-- 6. Research Dropdown (2-Column) -->
                <li class="bu-nav-item">
                  <a href="<?php echo href('research.php');?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <div class="bu-dropdown bu-res-dropdown">
                    <!-- Column 1: Academic Research -->
                    <div class="bu-res-col">
                      <div class="bu-res-col-heading"><i class="fa fa-graduation-cap"></i> Academic Research</div>
                      <ul>
                        <li><a target="_blank" href="<?php echo URL_UPLOAD;?>research/overview.pdf">Overview</a></li>
                        <li><a href="<?php echo href("page.php","id=3");?>">Research At Glance</a></li>
                        <li><a target="_blank" href="<?php echo href("page.php","id=14");?>">PhD Student (List)</a></li>
                        <li><a href="<?php echo href("page.php","id=15");?>">Journal</a></li>
                        <li><a href="<?php echo href("page.php","id=4");?>">Funding Agency</a></li>
                        <li><a href="<?php echo href("page.php","id=5");?>">Publication</a></li>
                        <li><a href="<?php echo href("page.php","id=10");?>">Conference /Seminar</a></li>
                        <li><a href="<?php echo href("page.php","id=11");?>">Industrial Visits</a></li>
                      </ul>
                    </div>
                    <!-- Column 2: Innovations & Labs -->
                    <div class="bu-res-col">
                      <div class="bu-res-col-heading"><i class="fa fa-flask"></i> Innovations &amp; Labs</div>
                      <ul>
                        <li><a href="<?php echo href("research.php");?>"><strong>Research &amp; Innovation Portal</strong></a></li>
                        <li><a href="<?php echo href("research.php#pharmacy-labs");?>">Pharmacy Research Labs</a></li>
                        <li><a href="<?php echo href("research.php#launched-products");?>">Commercial Products (15 Aug)</a></li>
                        <li><a href="<?php echo href("research.php#incubation-edc");?>">Incubation Centre &amp; EDC</a></li>
                        <li><a href="<?php echo href("research.php#research-domains");?>">Research Pillars &amp; Domains</a></li>
                        <li><a href="<?php echo href("research.php#patents-publications");?>">Patents &amp; Research Papers</a></li>
                        <li><a href="<?php echo href("research.php#media-publications");?>">E-Newsletter &amp; Blogs</a></li>
                      </ul>
                    </div>
                  </div>
                </li>

              <?php elseif ($i_type === 'admissions'): ?>
                <!-- 7. Admissions Dropdown -->
                <li class="bu-nav-item">
                  <a href="#" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown bu-dropdown-2col">
                    <li><a href="<?php echo href("enquiry.php")?>">Admission Enquiry &amp; Eligibility</a></li>
                    <li><a href="<?php echo href("admission-process.php");?>">Admission Process</a></li>
                    <li><a href="<?php echo href("course.php")?>">Courses, Intake &amp; Eligibility</a></li>
                    <li><a href="<?php echo href("fees.php")?>">Fee Structure</a></li>
                    <li><a href="<?php echo href("page.php","id=1");?>">University Bank Account Details</a></li>
                    <li><a href="<?php echo href("online-admission.php")?>">Online Registration Form</a></li>
                    <li><a href="<?php echo href("scholarship.php");?>">Scholarships</a></li>
                    <li><a href="<?php echo href("page.php","id=24");?>">Admission Helpline Numbers</a></li>
                    <li><a href="<?php echo href("page.php","id=6");?>">Vocational Courses - Media</a></li>
                    <li><a href="<?php echo href("hotel.php");?>">Vocational Courses - Hotel Mgmt</a></li>
                  </ul>
                </li>

              <?php elseif ($i_type === 'campus-life'): ?>
                <!-- Campus Life Dropdown (17 Dimensions of Campus Life) -->
                <li class="bu-nav-item">
                  <a href="<?php echo href("campus-life.php");?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown bu-dropdown-2col" style="min-width: 590px;">
                    <li><a href="<?php echo href("infrastructure.php"); ?>"><i class="fa fa-building-o text-warning mr-2"></i> Campus &amp; Infrastructure</a></li>
                    <li><a href="<?php echo href("academic.php"); ?>"><i class="fa fa-book text-info mr-2"></i> Academics &amp; Learning</a></li>
                    <li><a href="<?php echo href("hostel.php"); ?>"><i class="fa fa-home text-danger mr-2"></i> Hostel &amp; Residential Life</a></li>
                    <li><a href="<?php echo href("cafeteria.php"); ?>"><i class="fa fa-cutlery text-warning mr-2"></i> Cafeteria &amp; Food</a></li>
                    <li><a href="<?php echo href("transportation.php"); ?>"><i class="fa fa-bus text-primary mr-2"></i> Transportation</a></li>
                    <li><a href="<?php echo href("library.php"); ?>"><i class="fa fa-bookmark text-success mr-2"></i> Library &amp; Digital Resources</a></li>
                    <li><a href="<?php echo href("it-labs.php"); ?>"><i class="fa fa-laptop text-info mr-2"></i> IT &amp; Computer Labs</a></li>
                    <li><a href="<?php echo href("health-wellness.php"); ?>"><i class="fa fa-heartbeat text-danger mr-2"></i> Health &amp; Wellness</a></li>
                    <li><a href="<?php echo href("sports.php"); ?>"><i class="fa fa-futbol-o text-success mr-2"></i> Sports &amp; Fitness</a></li>
                    <li><a href="<?php echo href("events.php"); ?>"><i class="fa fa-calendar-check-o text-warning mr-2"></i> Arts, Culture &amp; Events</a></li>
                    <li><a href="<?php echo href("clubs.php"); ?>"><i class="fa fa-users text-primary mr-2"></i> Student Clubs &amp; Organizations</a></li>
                    <li><a href="<?php echo href("community-service.php"); ?>"><i class="fa fa-leaf text-success mr-2"></i> Community Service &amp; Environment</a></li>
                    <li><a href="<?php echo href("entrepreneurship.php"); ?>"><i class="fa fa-rocket text-warning mr-2"></i> Entrepreneurship &amp; Career Dev.</a></li>
                    <li><a href="<?php echo href("student-safety.php"); ?>"><i class="fa fa-shield text-danger mr-2"></i> Student Safety &amp; Support</a></li>
                    <li><a href="<?php echo href("student-media.php"); ?>"><i class="fa fa-bullhorn text-info mr-2"></i> Student Media &amp; Communication</a></li>
                    <li><a href="<?php echo href("alumni.php"); ?>"><i class="fa fa-graduation-cap text-warning mr-2"></i> Alumni</a></li>
                    <li><a href="<?php echo href("gallery.php"); ?>"><i class="fa fa-picture-o text-primary mr-2"></i> Campus Gallery</a></li>
                  </ul>
                </li>

              <?php elseif ($i_type === 'placements'): ?>
                <!-- 8. T&P Cell Dropdown -->
                <li class="bu-nav-item">
                  <a href="<?php echo href("placements.php");?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown">
                    <li><a href="<?php echo href("placements.php");?>">Training &amp; Placement Cell</a></li>
                    <li><a href="<?php echo URL_UPLOAD; ?>media/9018b4daec2ac10a45dfd539260998f5.pdf" target="_blank">Recent Placement List</a></li>
                    <li><a href="<?php echo URL_UPLOAD; ?>media/f27e76c6a5c21432282101555c225b35.jpg" target="_blank">Our Major Recruiters</a></li>
                  </ul>
                </li>

              <?php elseif ($i_type === 'news'): ?>
                <!-- 9. News & Media Dropdown -->
                <li class="bu-nav-item">
                  <a href="<?php echo href("news.php")?>" class="bu-nav-link"><?php echo htmlspecialchars($i_label); ?> <i class="fa fa-angle-down"></i></a>
                  <ul class="bu-dropdown">
                    <li><a href="<?php echo href("news.php")?>"><i class="fa fa-newspaper-o"></i> Latest News &amp; Events</a></li>
                    <li><a href="<?php echo href("newsletter.php")?>"><i class="fa fa-envelope"></i> E-Newsletter</a></li>
                    <li><a href="<?php echo href("magazine.php")?>"><i class="fa fa-book"></i> University Magazine</a></li>
                    <li><a href="<?php echo htmlspecialchars($hc['blog_url']); ?>"><i class="fa fa-rss"></i> Research &amp; Tech Blogs</a></li>
                    <li><a href="<?php echo href("gallery.php")?>"><i class="fa fa-picture-o"></i> Photo Gallery</a></li>
                    <li><a href="<?php echo href("notice.php")?>"><i class="fa fa-bullhorn"></i> Official Notices</a></li>
                  </ul>
                </li>

              <?php elseif ($i_type === 'contact'): ?>
                <!-- 10. Contact Link -->
                <li class="bu-nav-item">
                  <a href="<?php echo href($i_url !== '#' ? $i_url : "contact.php");?>" class="bu-nav-link" target="<?php echo htmlspecialchars($i_target); ?>"><?php echo htmlspecialchars($i_label); ?></a>
                </li>

              <?php else: ?>
                <!-- Custom Dynamic Link Added from WordPress-style Menu Manager -->
                <li class="bu-nav-item">
                  <a href="<?php echo htmlspecialchars($i_url); ?>" target="<?php echo htmlspecialchars($i_target); ?>" class="bu-nav-link">
                    <?php echo htmlspecialchars($i_label); ?>
                  </a>
                </li>
              <?php endif; ?>

            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </nav>

      <!-- Action Buttons (Apply - Desktop Only) -->
      <?php if ($hc['apply_btn_show'] == '1'): ?>
      <div class="bu-header-actions bu-hide-mobile">
        <a href="<?php echo htmlspecialchars($hc['apply_btn_url']); ?>" class="bu-btn-gold"><?php echo htmlspecialchars($hc['apply_btn_text']); ?></a>
      </div>
      <?php endif; ?>

      <!-- Mobile Menu Toggle Button (extreme right corner) -->
      <button class="bu-mobile-toggle" id="buMobileToggle" aria-label="Toggle Navigation">
        <span class="bu-toggle-line bu-line-blue"></span>
        <span class="bu-toggle-line bu-line-orange"></span>
        <span class="bu-toggle-line bu-line-red"></span>
      </button>

    </div>
  </div>

</header>

<!-- Search Overlay Modal -->
<div class="bu-search-overlay" id="buSearchOverlay">
  <button class="bu-search-close" id="buSearchClose">&times;</button>
  <div class="bu-search-box">
    <form action="<?php echo href('news.php'); ?>" method="get">
      <input type="text" name="s" class="bu-search-input" placeholder="Type to search..." autocomplete="off" autofocus>
      <button type="submit" class="bu-search-submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<!-- Header Scripts -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', function () {

    /* ---- Search Overlay ---- */
    var searchOpen    = document.getElementById('buSearchOpen');
    var searchClose   = document.getElementById('buSearchClose');
    var searchOverlay = document.getElementById('buSearchOverlay');

    if (searchOpen && searchOverlay) {
      searchOpen.addEventListener('click', function () {
        searchOverlay.classList.add('active');
        var inp = searchOverlay.querySelector('.bu-search-input');
        if (inp) inp.focus();
      });
    }
    if (searchClose && searchOverlay) {
      searchClose.addEventListener('click', function () {
        searchOverlay.classList.remove('active');
      });
    }
    if (searchOverlay) {
      searchOverlay.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') searchOverlay.classList.remove('active');
      });
    }

    /* ---- Mobile Toggle & Drawer ---- */
    var mobileToggle = document.getElementById('buMobileToggle');
    var drawerClose  = document.getElementById('buDrawerCloseBtn');
    var navbar       = document.getElementById('buNavbar');
    var backdrop     = document.getElementById('buNavBackdrop');

    function openMenu() {
      if (navbar) navbar.classList.add('mobile-open');
      if (backdrop) backdrop.classList.add('active');
      if (mobileToggle) mobileToggle.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
      if (navbar) navbar.classList.remove('mobile-open');
      if (backdrop) backdrop.classList.remove('active');
      if (mobileToggle) mobileToggle.classList.remove('active');
      document.body.style.overflow = '';
    }

    if (mobileToggle) {
      mobileToggle.addEventListener('click', function (e) {
        e.preventDefault();
        navbar && navbar.classList.contains('mobile-open') ? closeMenu() : openMenu();
      });
    }
    if (drawerClose) {
      drawerClose.addEventListener('click', function (e) {
        e.preventDefault();
        closeMenu();
      });
    }
    if (backdrop) {
      backdrop.addEventListener('click', closeMenu);
    }

    /* ---- Mobile Accordion Dropdowns (Event Delegation) ---- */
    if (navbar) {
      navbar.addEventListener('click', function (e) {
        if (window.innerWidth > 991) return;
        var link = e.target.closest('.bu-nav-link');
        if (!link) return;
        var item = link.closest('.bu-nav-item');
        if (!item) return;
        var dropdown = item.querySelector('.bu-dropdown');
        if (dropdown) {
          e.preventDefault();
          e.stopPropagation();
          var isOpen = item.classList.contains('open');
          document.querySelectorAll('.bu-nav-item.open').forEach(function (openItem) {
            if (openItem !== item) openItem.classList.remove('open');
          });
          item.classList.toggle('open', !isOpen);
        }
      });
    }

    /* ---- Topbar Dropdown Toggles (Info Corner & ERP Login) ---- */
    document.addEventListener('click', function(e) {
      // ERP Dropdown Click Toggle
      var erpToggle = e.target.closest('.bu-erp-toggle-link');
      if (erpToggle) {
        e.preventDefault();
        e.stopPropagation();
        var erpParent = erpToggle.closest('.bu-erp-dropdown');
        var isErpActive = erpParent.classList.contains('active');
        document.querySelectorAll('.bu-erp-dropdown.active').forEach(function(d) {
          d.classList.remove('active');
        });
        if (!isErpActive) {
          erpParent.classList.add('active');
        }
        return;
      } else if (!e.target.closest('.bu-erp-menu')) {
        document.querySelectorAll('.bu-erp-dropdown.active').forEach(function(d) {
          d.classList.remove('active');
        });
      }

      // News & Media Topbar Dropdown Toggle (for touch devices / mobile)
      var newsToggle = e.target.closest('.bu-topbar-news-link');
      if (newsToggle && (window.innerWidth <= 991 || e.target.closest('.fa-angle-down'))) {
        e.preventDefault();
        e.stopPropagation();
        var newsParent = newsToggle.closest('.bu-topbar-news-drop');
        var wasNewsActive = newsParent.classList.contains('active');
        document.querySelectorAll('.bu-topbar-news-drop.active').forEach(function(d) {
          d.classList.remove('active');
        });
        if (!wasNewsActive) {
          newsParent.classList.add('active');
        }
        return;
      } else if (!e.target.closest('.bu-topbar-news-menu')) {
        document.querySelectorAll('.bu-topbar-news-drop.active').forEach(function(d) {
          d.classList.remove('active');
        });
      }

      // Alumni Topbar Dropdown Toggle (for touch devices / mobile)
      var alumniToggle = e.target.closest('.bu-topbar-alumni-link');
      if (alumniToggle && (window.innerWidth <= 991 || e.target.closest('.fa-angle-down'))) {
        e.preventDefault();
        e.stopPropagation();
        var alumniParent = alumniToggle.closest('.bu-topbar-alumni-drop');
        var wasAlumniActive = alumniParent.classList.contains('active');
        document.querySelectorAll('.bu-topbar-alumni-drop.active').forEach(function(d) {
          d.classList.remove('active');
        });
        if (!wasAlumniActive) {
          alumniParent.classList.add('active');
        }
        return;
      } else if (!e.target.closest('.bu-topbar-alumni-menu')) {
        document.querySelectorAll('.bu-topbar-alumni-drop.active').forEach(function(d) {
          d.classList.remove('active');
        });
      }

      // Info Corner Mobile Close Button
      var closeBtn = e.target.closest('#buInfoCloseBtn');
      if (closeBtn) {
        e.preventDefault();
        e.stopPropagation();
        document.querySelectorAll('.bu-topbar-dropdown.active').forEach(function(d) {
          d.classList.remove('active');
        });
        return;
      }

      // Info Corner Toggle
      var toggle = e.target.closest('.bu-topbar-drop-toggle');
      if (toggle) {
        e.preventDefault();
        e.stopPropagation();
        var parent = toggle.closest('.bu-topbar-dropdown');
        var wasActive = parent.classList.contains('active');
        document.querySelectorAll('.bu-topbar-dropdown.active').forEach(function(d) {
          d.classList.remove('active');
        });
        if (!wasActive) {
          parent.classList.add('active');
        }
      } else if (!e.target.closest('.bu-topbar-drop-menu')) {
        document.querySelectorAll('.bu-topbar-dropdown.active').forEach(function(d) {
          d.classList.remove('active');
        });
      }
    });

    // Auto close menu on resize up
    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        if (window.innerWidth > 991) closeMenu();
      }, 200);
    });

    /* ---- Sticky Header on Scroll ---- */
    var headerWrap = document.querySelector('.bu-header-wrapper');
    if (headerWrap) {
      var isStickyActive = false;
      var handleStickyHeader = function () {
        var scrollY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        var threshold = window.innerWidth <= 991 ? 10 : 45;
        if (scrollY > threshold) {
          if (!isStickyActive) {
            headerWrap.classList.add('bu-is-sticky');
            isStickyActive = true;
          }
        } else {
          if (isStickyActive) {
            headerWrap.classList.remove('bu-is-sticky');
            isStickyActive = false;
          }
        }
      };
      window.addEventListener('scroll', handleStickyHeader, { passive: true });
      window.addEventListener('load', handleStickyHeader);
      handleStickyHeader();
    }
  });
})();
</script>
