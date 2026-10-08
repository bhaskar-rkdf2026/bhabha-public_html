<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'campus_life.php');
define("TITLE", 'Campus Life & Clubs Manager');
define("CATEGORY", 'campus_life');
define("DBTAB", 'site_portal_pages');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Icon normalizer
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

// Upload helper for array inputs
if (!function_exists('handleClCardUpload')) {
    function handleClCardUpload($fileInputKey, $index, $fallbackUrl = '') {
        if (isset($_FILES[$fileInputKey]['name'][$index]) && !empty($_FILES[$fileInputKey]['name'][$index])) {
            if (isset($_FILES[$fileInputKey]['error'][$index]) && $_FILES[$fileInputKey]['error'][$index] === UPLOAD_ERR_OK) {
                $uploadDir = '../upload/media/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES[$fileInputKey]['name'][$index]);
                $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                if (in_array($ext, $allowed)) {
                    $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                    $fileName = $cleanBase . '_' . time() . '_' . $index . '.' . $ext;
                    if (move_uploaded_file($_FILES[$fileInputKey]['tmp_name'][$index], $uploadDir . $fileName)) {
                        return 'upload/media/' . $fileName;
                    }
                }
            }
        }
        return $fallbackUrl;
    }
}

// Upload helper for single file inputs
if (!function_exists('handleClSingleUpload')) {
    function handleClSingleUpload($fileInputKey, $fallbackUrl = '') {
        if (isset($_FILES[$fileInputKey]['name']) && !empty($_FILES[$fileInputKey]['name'])) {
            if (isset($_FILES[$fileInputKey]['error']) && $_FILES[$fileInputKey]['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../upload/media/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }
                $origName = basename($_FILES[$fileInputKey]['name']);
                $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                if (in_array($ext, $allowed)) {
                    $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                    $fileName = $cleanBase . '_' . time() . '.' . $ext;
                    if (move_uploaded_file($_FILES[$fileInputKey]['tmp_name'], $uploadDir . $fileName)) {
                        return 'upload/media/' . $fileName;
                    }
                }
            }
        }
        return $fallbackUrl;
    }
}

// Handle Form Submission
if (isset($_POST['submit'])) {
    $id = intval($_POST['id'] ?? 0);
    $db->where('id', $id);
    $pageRow = $db->getOne(DBTAB);

    if (!$pageRow) {
        $_SESSION['error'] = 'Page not found.';
        redirect(PAGE);
    }

    $pageKey = $pageRow['page_key'];

    // Common fields
    $data = [
        'page_title' => trim($_POST['page_title'] ?? $pageRow['page_title']),
        'badge'      => trim($_POST['badge'] ?? ''),
        'heading'    => trim($_POST['heading'] ?? ''),
        'subheading' => trim($_POST['subheading'] ?? ''),
        'status'     => isset($_POST['status']) ? intval($_POST['status']) : 1,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $contentData = !empty($pageRow['content_data']) ? json_decode($pageRow['content_data'], true) : [];
    if (!is_array($contentData)) {
        $contentData = [];
    }

    // 1. CAMPUS LIFE OVERVIEW PAGE
    if ($pageKey == 'campus-life') {
        $contentData['meta_description'] = trim($_POST['meta_description'] ?? '');
        $contentData['meta_keywords']    = trim($_POST['meta_keywords'] ?? '');
        $contentData['page_icon']        = trim($_POST['page_icon'] ?? 'fa-compass');

        // Quick Stats (5 items)
        $stats = [];
        $stIcons   = $_POST['stat_icon'] ?? [];
        $stClasses = $_POST['stat_class'] ?? [];
        $stNums    = $_POST['stat_num'] ?? [];
        $stSyms    = $_POST['stat_sym'] ?? [];
        $stLabels  = $_POST['stat_label'] ?? [];
        for ($i = 0; $i < count($stLabels); $i++) {
            if (!empty($stLabels[$i]) || !empty($stNums[$i])) {
                $stats[] = [
                    'icon'   => trim($stIcons[$i] ?? 'fa-star'),
                    'class'  => trim($stClasses[$i] ?? 'is-blue'),
                    'number' => trim($stNums[$i] ?? '0'),
                    'symbol' => trim($stSyms[$i] ?? '+'),
                    'label'  => trim($stLabels[$i] ?? '')
                ];
            }
        }
        $contentData['stats'] = $stats;

        // Cultural Events Section
        $evItems = [];
        $evTitles      = $_POST['ev_title'] ?? [];
        $evImages      = $_POST['ev_image'] ?? [];
        $evPillIcons   = $_POST['ev_pill_icon'] ?? [];
        $evPillTexts   = $_POST['ev_pill_text'] ?? [];
        $evTexts       = $_POST['ev_text'] ?? [];
        $evTags        = $_POST['ev_tags'] ?? [];
        $evModalTitles = $_POST['ev_modal_title'] ?? [];
        $evModalDescs  = $_POST['ev_modal_desc'] ?? [];

        for ($i = 0; $i < count($evTitles); $i++) {
            $title = trim($evTitles[$i] ?? '');
            if (!empty($title)) {
                $imgUrl = handleClCardUpload('ev_file', $i, trim($evImages[$i] ?? ''));
                $tagRaw = trim($evTags[$i] ?? '');
                $tagsArr = array_filter(array_map('trim', explode(',', $tagRaw)));
                $evItems[] = [
                    'title'       => $title,
                    'image'       => $imgUrl,
                    'pill_icon'   => trim($evPillIcons[$i] ?? 'fa-star'),
                    'pill_text'   => trim($evPillTexts[$i] ?? ''),
                    'text'        => trim($evTexts[$i] ?? ''),
                    'tags'        => array_values($tagsArr),
                    'modal_title' => trim($evModalTitles[$i] ?? $title),
                    'modal_desc'  => trim($evModalDescs[$i] ?? '')
                ];
            }
        }
        $contentData['events_sec'] = [
            'badge'      => trim($_POST['events_badge'] ?? 'Student Celebrations'),
            'badge_icon' => trim($_POST['events_badge_icon'] ?? 'fa-calendar-o'),
            'title'      => trim($_POST['events_title'] ?? 'Events, Fests & <em>Youth Energy</em>'),
            'desc'       => trim($_POST['events_desc'] ?? ''),
            'items'      => $evItems
        ];

        // Sports Section
        $spItems = [];
        $spTitles      = $_POST['sp_title'] ?? [];
        $spImages      = $_POST['sp_image'] ?? [];
        $spPillIcons   = $_POST['sp_pill_icon'] ?? [];
        $spPillTexts   = $_POST['sp_pill_text'] ?? [];
        $spTexts       = $_POST['sp_text'] ?? [];
        $spTags        = $_POST['sp_tags'] ?? [];
        $spModalTitles = $_POST['sp_modal_title'] ?? [];
        $spModalDescs  = $_POST['sp_modal_desc'] ?? [];

        for ($i = 0; $i < count($spTitles); $i++) {
            $title = trim($spTitles[$i] ?? '');
            if (!empty($title)) {
                $imgUrl = handleClCardUpload('sp_file', $i, trim($spImages[$i] ?? ''));
                $tagRaw = trim($spTags[$i] ?? '');
                $tagsArr = array_filter(array_map('trim', explode(',', $tagRaw)));
                $spItems[] = [
                    'title'       => $title,
                    'image'       => $imgUrl,
                    'pill_icon'   => trim($spPillIcons[$i] ?? 'fa-trophy'),
                    'pill_text'   => trim($spPillTexts[$i] ?? ''),
                    'text'        => trim($spTexts[$i] ?? ''),
                    'tags'        => array_values($tagsArr),
                    'modal_title' => trim($spModalTitles[$i] ?? $title),
                    'modal_desc'  => trim($spModalDescs[$i] ?? '')
                ];
            }
        }
        $contentData['sports_sec'] = [
            'badge'      => trim($_POST['sports_badge'] ?? 'Athletics & Wellness'),
            'badge_icon' => trim($_POST['sports_badge_icon'] ?? 'fa-trophy'),
            'title'      => trim($_POST['sports_title'] ?? 'Sports Grounds, Tournaments & <em>Fitness Suite</em>'),
            'desc'       => trim($_POST['sports_desc'] ?? ''),
            'items'      => $spItems
        ];

        // Clubs Spotlight Box Section
        $contentData['clubs_sec'] = [
            'title' => trim($_POST['clubs_sec_title'] ?? 'Student Clubs & Creative Societies'),
            'desc'  => trim($_POST['clubs_sec_desc'] ?? '')
        ];

        // Infrastructure Section
        $inItems = [];
        $inTitles      = $_POST['in_title'] ?? [];
        $inImages      = $_POST['in_image'] ?? [];
        $inAnchors     = $_POST['in_anchor'] ?? [];
        $inPillIcons   = $_POST['in_pill_icon'] ?? [];
        $inPillTexts   = $_POST['in_pill_text'] ?? [];
        $inTexts       = $_POST['in_text'] ?? [];
        $inTags        = $_POST['in_tags'] ?? [];
        $inModalTitles = $_POST['in_modal_title'] ?? [];
        $inModalDescs  = $_POST['in_modal_desc'] ?? [];

        for ($i = 0; $i < count($inTitles); $i++) {
            $title = trim($inTitles[$i] ?? '');
            if (!empty($title)) {
                $imgUrl = handleClCardUpload('in_file', $i, trim($inImages[$i] ?? ''));
                $tagRaw = trim($inTags[$i] ?? '');
                $tagsArr = array_filter(array_map('trim', explode(',', $tagRaw)));
                $inItems[] = [
                    'anchor_id'   => trim($inAnchors[$i] ?? ''),
                    'title'       => $title,
                    'image'       => $imgUrl,
                    'pill_icon'   => trim($inPillIcons[$i] ?? 'fa-building-o'),
                    'pill_text'   => trim($inPillTexts[$i] ?? ''),
                    'text'        => trim($inTexts[$i] ?? ''),
                    'tags'        => array_values($tagsArr),
                    'modal_title' => trim($inModalTitles[$i] ?? $title),
                    'modal_desc'  => trim($inModalDescs[$i] ?? '')
                ];
            }
        }
        $contentData['infra_sec'] = [
            'badge'      => trim($_POST['infra_badge'] ?? '32-Acre Campus'),
            'badge_icon' => trim($_POST['infra_badge_icon'] ?? 'fa-building-o'),
            'title'      => trim($_POST['infra_title'] ?? 'World-Class <em>Campus Infrastructure</em>'),
            'desc'       => trim($_POST['infra_desc'] ?? ''),
            'items'      => $inItems
        ];

        // Call to action
        $contentData['cta'] = [
            'heading'   => trim($_POST['cta_heading'] ?? 'Ready to Experience Bhabha Campus Life?'),
            'desc'      => trim($_POST['cta_desc'] ?? ''),
            'btn1_text' => trim($_POST['cta_btn1_text'] ?? 'Apply For Admission 2026-27'),
            'btn1_url'  => trim($_POST['cta_btn1_url'] ?? 'enquiry.php'),
            'btn2_text' => trim($_POST['cta_btn2_text'] ?? 'Virtual Campus Tour'),
            'btn2_url'  => trim($_POST['cta_btn2_url'] ?? 'virtual.php')
        ];
    }
    // 2. CLUBS & SOCIETIES PAGE
    elseif ($pageKey == 'clubs') {
        $contentData['meta_description'] = trim($_POST['meta_description'] ?? '');
        $contentData['meta_keywords']    = trim($_POST['meta_keywords'] ?? '');
        $contentData['page_icon']        = trim($_POST['page_icon'] ?? 'fa-users');
        $contentData['badge']            = trim($_POST['badge'] ?? 'Co-Curricular Excellence & Student Life');
        $contentData['intro_p']          = trim($_POST['intro_p'] ?? '');
        $contentData['motto_label']      = trim($_POST['motto_label'] ?? 'OUR MOTTO');

        // 4 Motto items
        $motto = [];
        $mTitles = $_POST['motto_title'] ?? [];
        $mIcons  = $_POST['motto_icon'] ?? [];
        for ($i = 0; $i < count($mTitles); $i++) {
            if (!empty($mTitles[$i])) {
                $motto[] = [
                    'title' => trim($mTitles[$i]),
                    'icon'  => trim($mIcons[$i] ?? 'fa-check')
                ];
            }
        }
        $contentData['motto'] = $motto;

        // Metrics (5 items)
        $metrics = [];
        $metNums   = $_POST['metric_num'] ?? [];
        $metLabels = $_POST['metric_label'] ?? [];
        $metIcons  = $_POST['metric_icon'] ?? [];
        for ($i = 0; $i < count($metNums); $i++) {
            if (!empty($metNums[$i])) {
                $metrics[] = [
                    'num'   => trim($metNums[$i]),
                    'label' => trim($metLabels[$i] ?? ''),
                    'icon'  => trim($metIcons[$i] ?? 'fa-star')
                ];
            }
        }
        $contentData['metrics'] = $metrics;

        $contentData['sec_label']   = trim($_POST['sec_label'] ?? 'Active Student Societies');
        $contentData['sec_heading'] = trim($_POST['sec_heading'] ?? 'Our Flagship Clubs & Specialized Cells');

        // Flagship Clubs (9 items)
        $clubs = [];
        $cbIds         = $_POST['club_id'] ?? [];
        $cbNames       = $_POST['club_name'] ?? [];
        $cbDesigs      = $_POST['club_desig'] ?? [];
        $cbDeskLabels  = $_POST['club_desk_label'] ?? [];
        $cbDeskIcons   = $_POST['club_desk_icon'] ?? [];
        $cbPillTexts   = $_POST['club_pill_text'] ?? [];
        $cbPillIcons   = $_POST['club_pill_icon'] ?? [];
        $cbVisualBgs   = $_POST['club_visual_bg'] ?? [];
        $cbVisualIcons = $_POST['club_visual_icon'] ?? [];
        $cbVisualCats  = $_POST['club_visual_cat'] ?? [];
        $cbVisualNames = $_POST['club_visual_name'] ?? [];
        $cbVisualTags  = $_POST['club_visual_tag'] ?? [];
        $cbQuotes      = $_POST['club_quote'] ?? [];
        $cbBodyP1s     = $_POST['club_body_p1'] ?? [];
        $cbBodyP2s     = $_POST['club_body_p2'] ?? [];
        $cbChips       = $_POST['club_chips'] ?? [];

        for ($i = 0; $i < count($cbNames); $i++) {
            $name = trim($cbNames[$i] ?? '');
            if (!empty($name)) {
                $rawChips = trim($cbChips[$i] ?? '');
                $chipsArr = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $rawChips))));
                $clubs[] = [
                    'id'          => trim($cbIds[$i] ?? ('club-' . ($i + 1))),
                    'name'        => $name,
                    'desig'       => trim($cbDesigs[$i] ?? ''),
                    'desk_label'  => trim($cbDeskLabels[$i] ?? ''),
                    'desk_icon'   => trim($cbDeskIcons[$i] ?? 'fa-star'),
                    'pill_text'   => trim($cbPillTexts[$i] ?? ''),
                    'pill_icon'   => trim($cbPillIcons[$i] ?? 'fa-star'),
                    'visual_bg'   => trim($cbVisualBgs[$i] ?? 'linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%)'),
                    'visual_icon' => trim($cbVisualIcons[$i] ?? 'fa-users'),
                    'visual_cat'  => trim($cbVisualCats[$i] ?? ''),
                    'visual_name' => trim($cbVisualNames[$i] ?? $name),
                    'visual_tag'  => trim($cbVisualTags[$i] ?? ''),
                    'quote'       => trim($cbQuotes[$i] ?? ''),
                    'body_p1'     => trim($cbBodyP1s[$i] ?? ''),
                    'body_p2'     => trim($cbBodyP2s[$i] ?? ''),
                    'chips'       => array_values($chipsArr)
                ];
            }
        }
        $contentData['clubs'] = $clubs;

        // CTA
        $contentData['cta'] = [
            'heading'   => trim($_POST['cta_heading'] ?? 'Join a University Club & Lead with Purpose!'),
            'desc'      => trim($_POST['cta_desc'] ?? ''),
            'btn1_text' => trim($_POST['cta_btn1_text'] ?? 'Join a Club Today'),
            'btn1_url'  => trim($_POST['cta_btn1_url'] ?? 'enquiry.php'),
            'btn2_text' => trim($_POST['cta_btn2_text'] ?? 'Contact Club Coordinators'),
            'btn2_url'  => trim($_POST['cta_btn2_url'] ?? 'contact.php')
        ];
    }
    // 3. FACILITY & SUB-PAGES
    else {
        $contentData['page_icon']     = trim($_POST['page_icon'] ?? 'fa-circle');
        $contentData['image_caption'] = trim($_POST['image_caption'] ?? '');
        $contentData['overview_lead'] = trim($_POST['overview_lead'] ?? '');
        $contentData['overview_p2']   = trim($_POST['overview_p2'] ?? '');
        $contentData['detail_title']  = trim($_POST['detail_title'] ?? '');
        $contentData['detail_rich']   = trim($_POST['detail_rich'] ?? '');

        // Featured image
        $currentFeatured = trim($_POST['featured_image_curr'] ?? ($contentData['featured_image'] ?? ''));
        $contentData['featured_image'] = handleClSingleUpload('featured_image', $currentFeatured);

        // Feature cards
        $featTitles = $_POST['feat_title'] ?? [];
        $featIcons  = $_POST['feat_icon'] ?? [];
        $featDescs  = $_POST['feat_desc'] ?? [];
        $features = [];
        for ($i = 0; $i < count($featTitles); $i++) {
            $fTitle = trim($featTitles[$i] ?? '');
            if (!empty($fTitle)) {
                $features[] = [
                    'icon'  => trim($featIcons[$i] ?? 'fa-check'),
                    'title' => $fTitle,
                    'desc'  => trim($featDescs[$i] ?? '')
                ];
            }
        }
        $contentData['features'] = $features;

        // CTA Banner
        $contentData['cta_title']    = trim($_POST['cta_title'] ?? '');
        $contentData['cta_desc']     = trim($_POST['cta_desc'] ?? '');
        $contentData['cta_btn_text'] = trim($_POST['cta_btn_text'] ?? '');
        $contentData['cta_btn_url']  = trim($_POST['cta_btn_url'] ?? '');
    }

    $data['content_data'] = json_encode($contentData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $db->where('id', $id);
    $db->update(DBTAB, $data);

    $_SESSION['success'] = 'Page "' . $pageRow['page_title'] . '" updated successfully!';
    redirect(PAGE . '?page=' . ($pageKey == 'campus-life' ? 'overview' : $pageKey));
}

// Master Campus Life Pages Registry
$allCampusPages = [
    'campus-life' => [
        'param'      => 'overview',
        'title'      => 'Campus Life Overview',
        'badge'      => 'Main Hub',
        'badge_cls'  => 'badge-primary',
        'icon'       => 'mdi mdi-compass',
        'front_url'  => 'campus-life.php',
        'summary'    => '32-Acre Overview, Quick Stats, Events & Fests, Sports facilities, and Campus highlights.'
    ],
    'clubs' => [
        'param'      => 'clubs',
        'title'      => 'Student Clubs & Societies',
        'badge'      => 'Student Life',
        'badge_cls'  => 'badge-warning',
        'icon'       => 'mdi mdi-account-group',
        'front_url'  => 'clubs.php',
        'summary'    => 'Flagship Student Clubs, Motto, Key Metrics, Club Desks, Activities, and Registration.'
    ],
    'hostel' => [
        'param'      => 'hostel',
        'title'      => 'Hostel & Residential Life',
        'badge'      => 'Residences',
        'badge_cls'  => 'badge-success',
        'icon'       => 'mdi mdi-home-city-outline',
        'front_url'  => 'hostel.php',
        'summary'    => 'Boys & Girls Hostels, Furnished Rooms, FSSAI Mess, Security, Occupancy, and Warden rules.'
    ],
    'cafeteria' => [
        'param'      => 'cafeteria',
        'title'      => 'Cafeteria & Food Court',
        'badge'      => 'Dining',
        'badge_cls'  => 'badge-info',
        'icon'       => 'mdi mdi-silverware-fork-knife',
        'front_url'  => 'cafeteria.php',
        'summary'    => 'Central 500-Seater Canteen, Multi-cuisine dining, RO purified water, and Meal timings.'
    ],
    'transportation' => [
        'param'      => 'transportation',
        'title'      => 'Transport & Bus Routes',
        'badge'      => 'Logistics',
        'badge_cls'  => 'badge-danger',
        'icon'       => 'mdi mdi-bus',
        'front_url'  => 'transportation.php',
        'summary'    => 'GPS-Monitored Bus Fleet, Bhopal City Routes, Punctual Schedules, and Bus Pass process.'
    ],
    'library' => [
        'param'      => 'library',
        'title'      => 'Central Library & E-Resources',
        'badge'      => 'Knowledge',
        'badge_cls'  => 'badge-secondary',
        'icon'       => 'mdi mdi-book-open-page-variant',
        'front_url'  => 'library.php',
        'summary'    => '1,00,000+ Print Volumes, DELNET & E-Journals, Digital Media Reading Labs, and OPAC.'
    ],
    'it-labs' => [
        'param'      => 'it-labs',
        'title'      => 'IT & Computer Labs',
        'badge'      => 'Computing',
        'badge_cls'  => 'badge-primary',
        'icon'       => 'mdi mdi-laptop',
        'front_url'  => 'it-labs.php',
        'summary'    => 'Enterprise Workstations, Gigabit Backbone, AI/ML Sandboxes, and Cloud Server infrastructure.'
    ],
    'health-wellness' => [
        'param'      => 'health-wellness',
        'title'      => 'Health & Wellness',
        'badge'      => 'Healthcare',
        'badge_cls'  => 'badge-info',
        'icon'       => 'mdi mdi-heart-pulse',
        'front_url'  => 'health-wellness.php',
        'summary'    => '100-Bed Hospital, Resident Doctors, Dental & Homoeopathy Clinics, and 24x7 Ambulance.'
    ],
    'sports' => [
        'param'      => 'sports',
        'title'      => 'Sports & Fitness Complex',
        'badge'      => 'Athletics',
        'badge_cls'  => 'badge-warning',
        'icon'       => 'mdi mdi-soccer',
        'front_url'  => 'sports.php',
        'summary'    => 'Cricket Grounds, Football, Basketball, Badminton, Indoor Gymnasium, and Tournaments.'
    ],
    'community-service' => [
        'param'      => 'community-service',
        'title'      => 'Community Service & Environment',
        'badge'      => 'Social Impact',
        'badge_cls'  => 'badge-success',
        'icon'       => 'mdi mdi-hand-heart',
        'front_url'  => 'community-service.php',
        'summary'    => 'National Service Scheme (NSS), Village Adoptions, Tree Plantations, and Blood Donation drives.'
    ],
    'entrepreneurship' => [
        'param'      => 'entrepreneurship',
        'title'      => 'Entrepreneurship & Career Dev.',
        'badge'      => 'Innovation',
        'badge_cls'  => 'badge-info',
        'icon'       => 'mdi mdi-rocket-launch-outline',
        'front_url'  => 'entrepreneurship.php',
        'summary'    => 'Incubation Centre, Startup Mentorship, Seed Funding guidance, and Industry Interface.'
    ],
    'student-safety' => [
        'param'      => 'student-safety',
        'title'      => 'Student Safety & Support',
        'badge'      => 'Security',
        'badge_cls'  => 'badge-dark',
        'icon'       => 'mdi mdi-shield-check-outline',
        'front_url'  => 'student-safety.php',
        'summary'    => 'Anti-Ragging Squads, Women Safety ICC Cell, 200+ CCTV Surveillance, and Emergency Helplines.'
    ],
    'student-media' => [
        'param'      => 'student-media',
        'title'      => 'Student Media & Communication',
        'badge'      => 'Media & FM',
        'badge_cls'  => 'badge-danger',
        'icon'       => 'mdi mdi-bullhorn-outline',
        'front_url'  => 'student-media.php',
        'summary'    => 'Radio Popcorn 90.4 FM, University Newsletter, Podcast Studio, and Student Reporters.'
    ]
];

// Active page selector
$reqPage = isset($_GET['page']) ? trim($_GET['page']) : '';
if (empty($reqPage) || $reqPage === 'hub') {
    $selPageKey = 'hub';
} elseif ($reqPage === 'overview' || $reqPage === 'campus-life') {
    $selPageKey = 'campus-life';
} else {
    $selPageKey = $reqPage;
}

if ($selPageKey !== 'hub') {
    $db->where('page_key', $selPageKey);
    $currPageData = $db->getOne(DBTAB);

    if (!$currPageData) {
        $currPageData = ['id' => 0, 'page_key' => $selPageKey, 'page_title' => '', 'heading' => '', 'subheading' => '', 'badge' => '', 'status' => 1, 'content_data' => '{}'];
    }
    $cData = !empty($currPageData['content_data']) ? json_decode($currPageData['content_data'], true) : [];
    if (!is_array($cData)) $cData = [];
} else {
    $currPageData = ['page_title' => 'Campus Life Hub', 'page_key' => 'hub'];
    $cData = [];
}

// Counts & Hub Data
$clRow = $db->where('page_key', 'campus-life')->getOne(DBTAB);
$cbRow = $db->where('page_key', 'clubs')->getOne(DBTAB);
$clEventsCount = !empty($clRow['content_data']) ? count(json_decode($clRow['content_data'], true)['events_sec']['items'] ?? []) : 0;
$clInfraCount  = !empty($clRow['content_data']) ? count(json_decode($clRow['content_data'], true)['infra_sec']['items'] ?? []) : 0;
$cbClubsCount  = !empty($cbRow['content_data']) ? count(json_decode($cbRow['content_data'], true)['clubs'] ?? []) : 0;

$allDbRowsRaw = $db->where('category', CATEGORY)->get(DBTAB);
$allDbPages = [];
if (!empty($allDbRowsRaw)) {
    foreach ($allDbRowsRaw as $dRow) {
        $allDbPages[$dRow['page_key']] = $dRow;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title><?php echo TITLE; ?> | Bhabha University Admin</title>
<?php include('inc.meta.php'); ?>

<style>
.bu-portal-header {
  background: linear-gradient(135deg, #0A1B54 0%, #162B75 100%);
  border-radius: 12px;
  padding: 24px 28px;
  color: #ffffff;
  margin-bottom: 24px;
  box-shadow: 0 10px 25px rgba(10, 27, 84, 0.15);
}
.bu-portal-header h3 {
  margin: 0 0 6px 0;
  font-weight: 800;
  color: #ffffff;
  font-size: 22px;
}
.bu-portal-header p {
  margin: 0;
  color: #E2E8F0;
  font-size: 13.5px;
}
.bu-tab-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 13.5px;
  text-decoration: none !important;
  transition: all 0.2s ease;
  background: #ffffff;
  color: #0A1B54;
  border: 1px solid #E2E8F0;
  margin-right: 8px;
  margin-bottom: 12px;
}
.bu-tab-btn:hover {
  background: #F1F5F9;
  color: #0A1B54;
}
.bu-tab-btn.active {
  background: #FFC107;
  color: #051235;
  border-color: #D99B00;
  box-shadow: 0 4px 12px rgba(255, 193, 7, 0.35);
}
.sec-card {
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  padding: 22px;
  margin-bottom: 24px;
}
.sec-title {
  font-size: 16px;
  font-weight: 800;
  color: #0A1B54;
  border-bottom: 2px solid #F1F5F9;
  padding-bottom: 10px;
  margin-bottom: 18px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sec-title i {
  color: #D99B00;
  margin-right: 8px;
}
.item-card {
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 16px;
  margin-bottom: 16px;
  position: relative;
  transition: all 0.2s ease;
}
.item-card:hover {
  background: #FFFFFF;
  border-color: #CBD5E1;
  box-shadow: 0 6px 16px rgba(10, 27, 84, 0.06);
}
.item-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
  border-bottom: 1px dashed #CBD5E1;
  padding-bottom: 8px;
}
.item-header strong {
  color: #0A1B54;
  font-size: 14px;
}
.thumb-preview {
  width: 70px;
  height: 50px;
  object-fit: cover;
  border-radius: 6px;
  border: 1px solid #CBD5E1;
  margin-top: 4px;
  display: block;
}
</style>
</head>

<body class="fixed-left">
<div id="wrapper">
  <!-- Top Bar Start -->
  <?php include('inc.top.php'); ?>
  <!-- Top Bar End -->

  <!-- Left Sidebar Start -->
  <?php include('inc.menu.php'); ?>
  <!-- Left Sidebar End -->

  <div class="content-page">
    <div class="content">
      <div class="container-fluid">

        <!-- Page Header -->
        <div class="row pt-3">
          <div class="col-sm-12">
            <div class="page-title-box">
              <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                  <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                  <li class="breadcrumb-item active">Campus Life</li>
                </ol>
              </div>
              <h4 class="page-title">Campus Life &amp; Clubs Manager</h4>
            </div>
          </div>
        </div>

        <!-- Alerts -->
        <?php if (!empty($stat['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="mdi mdi-check-circle mr-1"></i> <?php echo $stat['success']; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($stat['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="mdi mdi-alert-circle mr-1"></i> <?php echo $stat['error']; ?>
          </div>
        <?php endif; ?>

        <?php if ($selPageKey == 'hub'): ?>
          <!-- ==========================================
               CAMPUS LIFE MASTER DIRECTORY HUB
               ========================================== -->
          <div class="bu-portal-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <div>
                <h3><i class="mdi mdi-view-grid-outline mr-2 text-warning"></i> Campus Life Master CMS Directory</h3>
                <p>Manage and customize all <strong>13 Campus Life &amp; Student Living pages</strong> directly from this panel. All content is saved dynamically to the live website.</p>
              </div>
              <div class="mt-2">
                <a href="../campus-life.php" target="_blank" class="btn btn-warning font-weight-bold mr-2"><i class="mdi mdi-open-in-new mr-1"></i> View Live Overview</a>
                <a href="../clubs.php" target="_blank" class="btn btn-outline-light font-weight-bold"><i class="mdi mdi-open-in-new mr-1"></i> View Live Clubs</a>
              </div>
            </div>
          </div>

          <!-- Quick Metrics Banner -->
          <div class="row mb-3">
            <div class="col-md-3">
              <div class="card p-3 text-center border-0 shadow-sm" style="background:linear-gradient(135deg, #0A1B54, #162B75); color:#fff; border-radius:10px;">
                <h4 class="m-0 font-weight-bold text-warning"><?php echo count($allCampusPages); ?></h4>
                <small class="text-light">Dynamic Campus Pages</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card p-3 text-center border-0 shadow-sm" style="background:linear-gradient(135deg, #065F46, #059669); color:#fff; border-radius:10px;">
                <h4 class="m-0 font-weight-bold text-white"><?php echo $clEventsCount; ?></h4>
                <small class="text-light">Overview Events &amp; Fests</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card p-3 text-center border-0 shadow-sm" style="background:linear-gradient(135deg, #1E40AF, #3B82F6); color:#fff; border-radius:10px;">
                <h4 class="m-0 font-weight-bold text-white"><?php echo $clInfraCount; ?></h4>
                <small class="text-light">Infrastructure Highlights</small>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card p-3 text-center border-0 shadow-sm" style="background:linear-gradient(135deg, #92400E, #D97706); color:#fff; border-radius:10px;">
                <h4 class="m-0 font-weight-bold text-white"><?php echo $cbClubsCount; ?></h4>
                <small class="text-light">Flagship Student Clubs</small>
              </div>
            </div>
          </div>

          <!-- 13 Pages Hub Grid -->
          <div class="row">
            <?php foreach ($allCampusPages as $pKey => $pMeta): 
              $dbP = $allDbPages[$pKey] ?? null;
              $pStatus = ($dbP && isset($dbP['status']) && $dbP['status'] == 1) ? 1 : ($dbP ? 0 : 1);
              $pUpdated = ($dbP && !empty($dbP['updated_at'])) ? date('d M Y, h:i A', strtotime($dbP['updated_at'])) : 'Standard Seed';
            ?>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm" style="border-radius:12px; border:1px solid #E2E8F0; transition:transform 0.2s, box-shadow 0.2s;">
                  <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                      <div style="width:48px; height:48px; border-radius:10px; background:#0A1B54; color:#FFC107; display:flex; align-items:center; justify-content:center; font-size:22px;">
                        <i class="<?php echo $pMeta['icon']; ?>"></i>
                      </div>
                      <span class="badge <?php echo $pMeta['badge_cls']; ?> px-2 py-1" style="font-size:11px;"><?php echo $pMeta['badge']; ?></span>
                    </div>
                    <h5 class="card-title font-weight-bold text-dark mb-1" style="font-size:16px;">
                      <?php echo $pMeta['title']; ?>
                    </h5>
                    <small class="text-muted mb-2 font-monospace" style="font-size:11.5px;"><?php echo $pMeta['front_url']; ?></small>
                    <p class="card-text text-secondary mb-3" style="font-size:13px; line-height:1.5; flex-grow:1;">
                      <?php echo $pMeta['summary']; ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between pt-2 border-top mb-3">
                      <small class="text-muted" style="font-size:11px;">
                        <i class="mdi mdi-clock-outline mr-1"></i> <?php echo $pUpdated; ?>
                      </small>
                      <?php if ($pStatus == 1): ?>
                        <span class="badge badge-success px-2 py-1"><i class="mdi mdi-check-circle mr-1"></i> Live</span>
                      <?php else: ?>
                        <span class="badge badge-secondary px-2 py-1">Draft</span>
                      <?php endif; ?>
                    </div>
                    <div class="d-flex">
                      <a href="<?php echo PAGE; ?>?page=<?php echo $pMeta['param']; ?>" class="btn btn-primary btn-sm flex-grow-1 font-weight-bold">
                        <i class="mdi mdi-pencil mr-1"></i> Edit Page
                      </a>
                      <a href="../<?php echo $pMeta['front_url']; ?>" target="_blank" class="btn btn-outline-secondary btn-sm ml-2" title="View on live website">
                        <i class="mdi mdi-open-in-new"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Connected Campus Life Modules -->
          <div class="sec-card mt-3">
            <div class="sec-title">
              <span><i class="mdi mdi-link-variant text-warning mr-2"></i> Dedicated Modules Linked in Campus Life Header</span>
              <span class="badge badge-info">Additional Modules</span>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-6 mb-3">
                <div class="card p-3 border h-100 bg-light">
                  <div class="font-weight-bold text-dark"><i class="mdi mdi-city text-primary mr-1"></i> Infrastructure</div>
                  <small class="text-muted d-block mb-2">32-Acre campus facilities &amp; labs</small>
                  <a href="infrastructure.php" class="btn btn-sm btn-outline-primary mt-auto">Manage Infrastructure</a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <div class="card p-3 border h-100 bg-light">
                  <div class="font-weight-bold text-dark"><i class="mdi mdi-calendar-star text-warning mr-1"></i> Events &amp; Fests</div>
                  <small class="text-muted d-block mb-2">Annual Tarang fests &amp; celebrations</small>
                  <a href="events.php" class="btn btn-sm btn-outline-warning mt-auto">Manage Events</a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <div class="card p-3 border h-100 bg-light">
                  <div class="font-weight-bold text-dark"><i class="mdi mdi-image-multiple text-success mr-1"></i> Campus Gallery</div>
                  <small class="text-muted d-block mb-2">Photo galleries &amp; albums</small>
                  <a href="gallery.php" class="btn btn-sm btn-outline-success mt-auto">Manage Gallery</a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-3">
                <div class="card p-3 border h-100 bg-light">
                  <div class="font-weight-bold text-dark"><i class="mdi mdi-school text-info mr-1"></i> Alumni Portal</div>
                  <small class="text-muted d-block mb-2">Alumni directory &amp; registrations</small>
                  <a href="alumni.php" class="btn btn-sm btn-outline-info mt-auto">Manage Alumni</a>
                </div>
              </div>
            </div>
          </div>

        <?php else: ?>
          <!-- ==========================================
               PAGE EDITOR VIEW (Tabs + Specialized Form)
               ========================================== -->
          <?php 
            $curMeta = $allCampusPages[$selPageKey] ?? [
                'title'     => $currPageData['page_title'] ?? 'Campus Page',
                'front_url' => 'campus-life.php',
                'icon'      => 'mdi mdi-file-document-edit'
            ];
          ?>
          <div class="bu-portal-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <div>
                <a href="<?php echo PAGE; ?>" class="btn btn-sm btn-outline-light mb-2 font-weight-bold">
                  <i class="mdi mdi-arrow-left mr-1"></i> Back to Campus Life Hub
                </a>
                <h3><i class="<?php echo $curMeta['icon']; ?> mr-2 text-warning"></i> Editing: <?php echo htmlspecialchars($curMeta['title']); ?></h3>
                <p>Update banner information, rich text descriptions, amenities, media, and call to action.</p>
              </div>
              <div class="mt-2">
                <a href="../<?php echo $curMeta['front_url']; ?>" target="_blank" class="btn btn-warning font-weight-bold"><i class="mdi mdi-open-in-new mr-1"></i> View Live Page</a>
              </div>
            </div>
          </div>

          <!-- Page Tabs Switcher (Quick Switch) -->
          <div class="mb-3 d-flex flex-wrap" style="gap: 6px;">
            <a href="<?php echo PAGE; ?>" class="bu-tab-btn"><i class="mdi mdi-view-grid"></i> ★ Hub</a>
            <?php foreach ($allCampusPages as $pk => $pm): ?>
              <a href="<?php echo PAGE; ?>?page=<?php echo $pm['param']; ?>" class="bu-tab-btn <?php echo ($selPageKey == $pk) ? 'active' : ''; ?>">
                <i class="<?php echo $pm['icon']; ?>"></i> <?php echo $pm['title']; ?>
              </a>
            <?php endforeach; ?>
          </div>

          <!-- Main Edit Form -->
          <form method="POST" action="<?php echo PAGE; ?>?page=<?php echo htmlspecialchars($reqPage); ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo intval($currPageData['id']); ?>">
            <input type="hidden" name="page_key" value="<?php echo htmlspecialchars($currPageData['page_key']); ?>">

            <!-- ==========================================
                 TAB 1: CAMPUS LIFE OVERVIEW (campus-life.php)
                 ========================================== -->
            <?php if ($selPageKey == 'campus-life'): ?>
            
            <!-- 1. Meta & Banner Card -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-info-circle"></i> Page Meta &amp; Banner Header</span>
                <span class="badge badge-primary">Top Banner</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">HTML Title (Browser Tab)</label>
                  <input type="text" name="page_title" class="form-control" value="<?php echo htmlspecialchars($currPageData['page_title'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Page Banner Title (Use &lt;em&gt; for gold text)</label>
                  <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($currPageData['heading'] ?? ''); ?>" required>
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Page Subtitle (Banner Tagline)</label>
                  <textarea name="subheading" class="form-control" rows="2"><?php echo htmlspecialchars($currPageData['subheading'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Meta Description (SEO)</label>
                  <textarea name="meta_description" class="form-control" rows="2"><?php echo htmlspecialchars($cData['meta_description'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Meta Keywords (SEO)</label>
                  <textarea name="meta_keywords" class="form-control" rows="2"><?php echo htmlspecialchars($cData['meta_keywords'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Banner Icon (FontAwesome)</label>
                  <input type="text" name="page_icon" class="form-control" value="<?php echo htmlspecialchars($cData['page_icon'] ?? 'fa-compass'); ?>">
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Badge Text</label>
                  <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($currPageData['badge'] ?? ''); ?>">
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Page Status</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php echo ($currPageData['status'] == 1) ? 'selected' : ''; ?>>Active (Published)</option>
                    <option value="0" <?php echo ($currPageData['status'] == 0) ? 'selected' : ''; ?>>Inactive (Draft)</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- 2. Quick Stats Counters Bar -->
            <?php 
              $stats = !empty($cData['stats']) ? $cData['stats'] : [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-bar-chart"></i> Quick Stats Showcase Bar (5 Counter Items)</span>
                <span class="badge badge-success">Floating Bar</span>
              </div>
              <div class="row">
                <?php for ($i = 0; $i < 5; $i++): 
                  $st = $stats[$i] ?? ['icon' => 'fa-star', 'class' => 'is-blue', 'number' => '0', 'symbol' => '+', 'label' => ''];
                ?>
                <div class="col-md">
                  <div class="item-card">
                    <div class="item-header">
                      <strong>Stat #<?php echo $i + 1; ?></strong>
                    </div>
                    <div class="form-group mb-2">
                      <small class="text-muted font-weight-bold">Number &amp; Symbol</small>
                      <div class="input-group input-group-sm">
                        <input type="text" name="stat_num[]" class="form-control" value="<?php echo htmlspecialchars($st['number'] ?? ''); ?>" placeholder="32">
                        <input type="text" name="stat_sym[]" class="form-control" style="max-width:50px;" value="<?php echo htmlspecialchars($st['symbol'] ?? '+'); ?>" placeholder="+">
                      </div>
                    </div>
                    <div class="form-group mb-2">
                      <small class="text-muted font-weight-bold">Label</small>
                      <input type="text" name="stat_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['label'] ?? ''); ?>" placeholder="Lush Green Acres">
                    </div>
                    <div class="form-group mb-2">
                      <small class="text-muted font-weight-bold">Icon</small>
                      <input type="text" name="stat_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['icon'] ?? 'fa-star'); ?>">
                    </div>
                    <div class="form-group mb-0">
                      <small class="text-muted font-weight-bold">Color Theme</small>
                      <select name="stat_class[]" class="form-control form-control-sm">
                        <option value="is-green" <?php echo (($st['class'] ?? '') == 'is-green') ? 'selected' : ''; ?>>Green</option>
                        <option value="is-amber" <?php echo (($st['class'] ?? '') == 'is-amber') ? 'selected' : ''; ?>>Amber</option>
                        <option value="is-blue" <?php echo (($st['class'] ?? '') == 'is-blue') ? 'selected' : ''; ?>>Blue</option>
                        <option value="is-indigo" <?php echo (($st['class'] ?? '') == 'is-indigo') ? 'selected' : ''; ?>>Indigo</option>
                        <option value="is-gold" <?php echo (($st['class'] ?? '') == 'is-gold') ? 'selected' : ''; ?>>Gold</option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>

            <!-- 3. Section: Cultural Events & Celebrations (#events) -->
            <?php 
              $evSec = $cData['events_sec'] ?? [];
              $evItems = $evSec['items'] ?? [];
            ?>
            <div class="sec-card" id="events-sec">
              <div class="sec-title">
                <span><i class="fa fa-calendar-check-o"></i> Section: Cultural Events &amp; Celebrations (#events)</span>
                <span class="badge badge-info"><?php echo count($evItems); ?> Cards</span>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Text</label>
                  <input type="text" name="events_badge" class="form-control" value="<?php echo htmlspecialchars($evSec['badge'] ?? 'Student Celebrations'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Icon</label>
                  <input type="text" name="events_badge_icon" class="form-control" value="<?php echo htmlspecialchars($evSec['badge_icon'] ?? 'fa-calendar-o'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Section Heading</label>
                  <input type="text" name="events_title" class="form-control" value="<?php echo htmlspecialchars($evSec['title'] ?? 'Events, Fests & <em>Youth Energy</em>'); ?>">
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Section Description</label>
                  <textarea name="events_desc" class="form-control" rows="2"><?php echo htmlspecialchars($evSec['desc'] ?? ''); ?></textarea>
                </div>
              </div>

              <h6 class="font-weight-bold text-dark mt-3 mb-2">Event Cards</h6>
              <div id="ev-container">
                <?php foreach ($evItems as $idx => $ev): 
                  $tagStr = is_array($ev['tags'] ?? '') ? implode(', ', $ev['tags']) : ($ev['tags'] ?? '');
                  $cardImg = $ev['image'] ?? '';
                  $previewSrc = !empty($cardImg) ? (strpos($cardImg, 'http') === 0 ? $cardImg : '../' . ltrim($cardImg, '/')) : '';
                ?>
                <div class="item-card ev-row">
                  <div class="item-header">
                    <strong>Event Card #<?php echo $idx + 1; ?>: <?php echo htmlspecialchars($ev['title'] ?? ''); ?></strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.ev-row').remove();"><i class="fa fa-trash"></i> Remove</button>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Card Title</small>
                      <input type="text" name="ev_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ev['title'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Category Pill Text</small>
                      <input type="text" name="ev_pill_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ev['pill_text'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Pill Icon</small>
                      <input type="text" name="ev_pill_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ev['pill_icon'] ?? 'fa-music'); ?>">
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Image URL or Path</small>
                      <input type="text" name="ev_image[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cardImg); ?>" placeholder="upload/gallery/large/...">
                      <small class="text-muted">Or upload new file below:</small>
                      <input type="file" name="ev_file[<?php echo $idx; ?>]" class="form-control-file form-control-sm mt-1" accept="image/*">
                      <?php if (!empty($previewSrc)): ?>
                        <img src="<?php echo htmlspecialchars($previewSrc); ?>" class="thumb-preview" alt="Preview">
                      <?php endif; ?>
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Tags (Comma-separated)</small>
                      <input type="text" name="ev_tags[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tagStr); ?>" placeholder="Music & Dance, Theater, Celebrity Evenings">
                    </div>
                    <div class="col-md-12 form-group">
                      <small class="font-weight-bold">Card Description</small>
                      <textarea name="ev_text[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($ev['text'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Title</small>
                      <input type="text" name="ev_modal_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ev['modal_title'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Description</small>
                      <input type="text" name="ev_modal_desc[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ev['modal_desc'] ?? ''); ?>">
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- 4. Section: Sports & Athletics (#sports) -->
            <?php 
              $spSec = $cData['sports_sec'] ?? [];
              $spItems = $spSec['items'] ?? [];
            ?>
            <div class="sec-card" id="sports-sec">
              <div class="sec-title">
                <span><i class="fa fa-trophy"></i> Section: Sports &amp; Athletics (#sports)</span>
                <span class="badge badge-warning"><?php echo count($spItems); ?> Cards</span>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Text</label>
                  <input type="text" name="sports_badge" class="form-control" value="<?php echo htmlspecialchars($spSec['badge'] ?? 'Athletics & Wellness'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Icon</label>
                  <input type="text" name="sports_badge_icon" class="form-control" value="<?php echo htmlspecialchars($spSec['badge_icon'] ?? 'fa-trophy'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Section Heading</label>
                  <input type="text" name="sports_title" class="form-control" value="<?php echo htmlspecialchars($spSec['title'] ?? 'Sports Grounds, Tournaments & <em>Fitness Suite</em>'); ?>">
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Section Description</label>
                  <textarea name="sports_desc" class="form-control" rows="2"><?php echo htmlspecialchars($spSec['desc'] ?? ''); ?></textarea>
                </div>
              </div>

              <h6 class="font-weight-bold text-dark mt-3 mb-2">Sports Cards</h6>
              <div id="sp-container">
                <?php foreach ($spItems as $idx => $sp): 
                  $tagStr = is_array($sp['tags'] ?? '') ? implode(', ', $sp['tags']) : ($sp['tags'] ?? '');
                  $cardImg = $sp['image'] ?? '';
                  $previewSrc = !empty($cardImg) ? (strpos($cardImg, 'http') === 0 ? $cardImg : '../' . ltrim($cardImg, '/')) : '';
                ?>
                <div class="item-card sp-row">
                  <div class="item-header">
                    <strong>Sports Card #<?php echo $idx + 1; ?>: <?php echo htmlspecialchars($sp['title'] ?? ''); ?></strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.sp-row').remove();"><i class="fa fa-trash"></i> Remove</button>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Card Title</small>
                      <input type="text" name="sp_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sp['title'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Pill Text</small>
                      <input type="text" name="sp_pill_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sp['pill_text'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Pill Icon</small>
                      <input type="text" name="sp_pill_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sp['pill_icon'] ?? 'fa-trophy'); ?>">
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Image URL or Path</small>
                      <input type="text" name="sp_image[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cardImg); ?>">
                      <small class="text-muted">Or upload new file:</small>
                      <input type="file" name="sp_file[<?php echo $idx; ?>]" class="form-control-file form-control-sm mt-1" accept="image/*">
                      <?php if (!empty($previewSrc)): ?>
                        <img src="<?php echo htmlspecialchars($previewSrc); ?>" class="thumb-preview" alt="Preview">
                      <?php endif; ?>
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Tags (Comma-separated)</small>
                      <input type="text" name="sp_tags[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tagStr); ?>">
                    </div>
                    <div class="col-md-12 form-group">
                      <small class="font-weight-bold">Card Description</small>
                      <textarea name="sp_text[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($sp['text'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Title</small>
                      <input type="text" name="sp_modal_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sp['modal_title'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Description</small>
                      <input type="text" name="sp_modal_desc[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($sp['modal_desc'] ?? ''); ?>">
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- 5. Section: Clubs Spotlight Preview Box Header -->
            <?php 
              $clSecBox = $cData['clubs_sec'] ?? [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-users"></i> Section: Clubs &amp; Societies Spotlight Box Header</span>
                <span class="badge badge-secondary">Overview Spotlight</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Box Heading</label>
                  <input type="text" name="clubs_sec_title" class="form-control" value="<?php echo htmlspecialchars($clSecBox['title'] ?? 'Student Clubs & Creative Societies'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Box Description</label>
                  <textarea name="clubs_sec_desc" class="form-control" rows="2"><?php echo htmlspecialchars($clSecBox['desc'] ?? ''); ?></textarea>
                </div>
              </div>
              <div class="alert alert-light border m-0">
                <i class="fa fa-info-circle text-info"></i> The individual clubs shown in this grid link directly to the full <strong>Student Clubs &amp; Societies</strong> page. You can customize all 9 clubs under the <a href="<?php echo PAGE; ?>?page=clubs" class="font-weight-bold text-primary">Student Clubs &amp; Societies Tab</a>.
              </div>
            </div>

            <!-- 6. Section: Campus Infrastructure & Hostels (#facilities / #hostels) -->
            <?php 
              $inSec = $cData['infra_sec'] ?? [];
              $inItems = $inSec['items'] ?? [];
            ?>
            <div class="sec-card" id="infra-sec">
              <div class="sec-title">
                <span><i class="fa fa-building-o"></i> Section: Campus Infrastructure &amp; Hostels (#facilities)</span>
                <span class="badge badge-danger"><?php echo count($inItems); ?> Items</span>
              </div>
              <div class="row">
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Text</label>
                  <input type="text" name="infra_badge" class="form-control" value="<?php echo htmlspecialchars($inSec['badge'] ?? '32-Acre Campus'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Badge Icon</label>
                  <input type="text" name="infra_badge_icon" class="form-control" value="<?php echo htmlspecialchars($inSec['badge_icon'] ?? 'fa-building-o'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Section Heading</label>
                  <input type="text" name="infra_title" class="form-control" value="<?php echo htmlspecialchars($inSec['title'] ?? 'World-Class <em>Campus Infrastructure</em>'); ?>">
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Section Description</label>
                  <textarea name="infra_desc" class="form-control" rows="2"><?php echo htmlspecialchars($inSec['desc'] ?? ''); ?></textarea>
                </div>
              </div>

              <h6 class="font-weight-bold text-dark mt-3 mb-2">Infrastructure Cards</h6>
              <div id="in-container">
                <?php foreach ($inItems as $idx => $in): 
                  $tagStr = is_array($in['tags'] ?? '') ? implode(', ', $in['tags']) : ($in['tags'] ?? '');
                  $cardImg = $in['image'] ?? '';
                  $previewSrc = !empty($cardImg) ? (strpos($cardImg, 'http') === 0 ? $cardImg : '../' . ltrim($cardImg, '/')) : '';
                ?>
                <div class="item-card in-row">
                  <div class="item-header">
                    <strong>Facility #<?php echo $idx + 1; ?>: <?php echo htmlspecialchars($in['title'] ?? ''); ?></strong>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.in-row').remove();"><i class="fa fa-trash"></i> Remove</button>
                  </div>
                  <div class="row">
                    <div class="col-md-5 form-group">
                      <small class="font-weight-bold">Facility Title</small>
                      <input type="text" name="in_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($in['title'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Pill Text</small>
                      <input type="text" name="in_pill_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($in['pill_text'] ?? ''); ?>">
                    </div>
                    <div class="col-md-2 form-group">
                      <small class="font-weight-bold">Pill Icon</small>
                      <input type="text" name="in_pill_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($in['pill_icon'] ?? 'fa-building-o'); ?>">
                    </div>
                    <div class="col-md-2 form-group">
                      <small class="font-weight-bold">Anchor ID (e.g. hostels)</small>
                      <input type="text" name="in_anchor[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($in['anchor_id'] ?? ''); ?>" placeholder="hostels">
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Image URL or Path</small>
                      <input type="text" name="in_image[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cardImg); ?>">
                      <small class="text-muted">Or upload new file:</small>
                      <input type="file" name="in_file[<?php echo $idx; ?>]" class="form-control-file form-control-sm mt-1" accept="image/*">
                      <?php if (!empty($previewSrc)): ?>
                        <img src="<?php echo htmlspecialchars($previewSrc); ?>" class="thumb-preview" alt="Preview">
                      <?php endif; ?>
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Tags (Comma-separated)</small>
                      <input type="text" name="in_tags[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tagStr); ?>">
                    </div>
                    <div class="col-md-12 form-group">
                      <small class="font-weight-bold">Card Description</small>
                      <textarea name="in_text[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($in['text'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Title</small>
                      <input type="text" name="in_modal_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($in['modal_title'] ?? ''); ?>">
                    </div>
                    <div class="col-md-6 form-group mb-0">
                      <small class="font-weight-bold">Lightbox Modal Description</small>
                      <textarea name="in_modal_desc[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($in['modal_desc'] ?? ''); ?></textarea>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- 7. Call To Action Strip -->
            <?php 
              $cta = $cData['cta'] ?? [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-bullhorn"></i> Bottom Call-To-Action Banner</span>
                <span class="badge badge-primary">CTA Banner</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Heading</label>
                  <input type="text" name="cta_heading" class="form-control" value="<?php echo htmlspecialchars($cta['heading'] ?? 'Ready to Experience Bhabha Campus Life?'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Description</label>
                  <textarea name="cta_desc" class="form-control" rows="2"><?php echo htmlspecialchars($cta['desc'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 1 Text</label>
                  <input type="text" name="cta_btn1_text" class="form-control" value="<?php echo htmlspecialchars($cta['btn1_text'] ?? 'Apply For Admission 2026-27'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 1 URL</label>
                  <input type="text" name="cta_btn1_url" class="form-control" value="<?php echo htmlspecialchars($cta['btn1_url'] ?? 'enquiry.php'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 2 Text</label>
                  <input type="text" name="cta_btn2_text" class="form-control" value="<?php echo htmlspecialchars($cta['btn2_text'] ?? 'Virtual Campus Tour'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 2 URL</label>
                  <input type="text" name="cta_btn2_url" class="form-control" value="<?php echo htmlspecialchars($cta['btn2_url'] ?? 'virtual.php'); ?>">
                </div>
              </div>
            </div>

          <?php endif; ?>

          <!-- ==========================================
               TAB 2: STUDENT CLUBS & SOCIETIES (clubs.php)
               ========================================== -->
          <?php if ($selPageKey == 'clubs'): ?>

            <!-- 1. Meta & Banner Card -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-info-circle"></i> Page Meta &amp; Banner Header</span>
                <span class="badge badge-primary">Top Banner</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">HTML Title (Browser Tab)</label>
                  <input type="text" name="page_title" class="form-control" value="<?php echo htmlspecialchars($currPageData['page_title'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Page Banner Title (Use &lt;em&gt; for styling)</label>
                  <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($currPageData['heading'] ?? ''); ?>" required>
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Page Subtitle (Tagline)</label>
                  <textarea name="subheading" class="form-control" rows="2"><?php echo htmlspecialchars($currPageData['subheading'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Meta Description (SEO)</label>
                  <textarea name="meta_description" class="form-control" rows="2"><?php echo htmlspecialchars($cData['meta_description'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Meta Keywords (SEO)</label>
                  <textarea name="meta_keywords" class="form-control" rows="2"><?php echo htmlspecialchars($cData['meta_keywords'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Banner Icon (FontAwesome)</label>
                  <input type="text" name="page_icon" class="form-control" value="<?php echo htmlspecialchars($cData['page_icon'] ?? 'fa-users'); ?>">
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Badge Text</label>
                  <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($currPageData['badge'] ?? ''); ?>">
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Page Status</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php echo ($currPageData['status'] == 1) ? 'selected' : ''; ?>>Active (Published)</option>
                    <option value="0" <?php echo ($currPageData['status'] == 0) ? 'selected' : ''; ?>>Inactive (Draft)</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- 2. Intro Card & Motto Strip -->
            <?php 
              $motto = !empty($cData['motto']) ? $cData['motto'] : [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-compass"></i> Page Intro Card &amp; 4-Pillar Motto</span>
                <span class="badge badge-success">Motto Box</span>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Executive Overview Narrative Paragraph</label>
                  <textarea name="intro_p" class="form-control" rows="3"><?php echo htmlspecialchars($cData['intro_p'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-12 form-group mb-2">
                  <label class="font-weight-bold">Motto Strip Label</label>
                  <input type="text" name="motto_label" class="form-control" value="<?php echo htmlspecialchars($cData['motto_label'] ?? 'OUR MOTTO'); ?>">
                </div>
                <?php for ($i = 0; $i < 4; $i++): 
                  $mt = $motto[$i] ?? ['icon' => 'fa-check', 'title' => ''];
                ?>
                <div class="col-md-3">
                  <div class="item-card p-2">
                    <small class="font-weight-bold text-dark">Pillar #<?php echo $i + 1; ?></small>
                    <div class="form-group mb-1">
                      <input type="text" name="motto_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mt['title'] ?? ''); ?>" placeholder="Learn Beyond Classrooms">
                    </div>
                    <div class="form-group mb-0">
                      <input type="text" name="motto_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($mt['icon'] ?? 'fa-check'); ?>" placeholder="fa-book">
                    </div>
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>

            <!-- 3. Institutional Metrics (5 Items) -->
            <?php 
              $metrics = !empty($cData['metrics']) ? $cData['metrics'] : [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-tachometer"></i> Institutional Metrics Row (5 Metrics)</span>
                <span class="badge badge-info">Metrics</span>
              </div>
              <div class="row">
                <?php for ($i = 0; $i < 5; $i++): 
                  $met = $metrics[$i] ?? ['icon' => 'fa-star', 'num' => '', 'label' => ''];
                ?>
                <div class="col-md">
                  <div class="item-card p-2">
                    <small class="font-weight-bold text-dark">Metric #<?php echo $i + 1; ?></small>
                    <div class="form-group mb-1">
                      <input type="text" name="metric_num[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($met['num'] ?? ''); ?>" placeholder="9+ Specialized">
                    </div>
                    <div class="form-group mb-1">
                      <input type="text" name="metric_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($met['label'] ?? ''); ?>" placeholder="Clubs & Cells">
                    </div>
                    <div class="form-group mb-0">
                      <input type="text" name="metric_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($met['icon'] ?? 'fa-star'); ?>" placeholder="fa-cubes">
                    </div>
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>

            <!-- 4. Section 2 Headings & Flagship Clubs Directory -->
            <?php 
              $clubs = !empty($cData['clubs']) ? $cData['clubs'] : [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-users"></i> Flagship Clubs &amp; Specialized Cells Directory</span>
                <span class="badge badge-warning"><?php echo count($clubs); ?> Clubs</span>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Section Tag Label</label>
                  <input type="text" name="sec_label" class="form-control" value="<?php echo htmlspecialchars($cData['sec_label'] ?? 'Active Student Societies'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Section Heading</label>
                  <input type="text" name="sec_heading" class="form-control" value="<?php echo htmlspecialchars($cData['sec_heading'] ?? 'Our Flagship Clubs & Specialized Cells'); ?>">
                </div>
              </div>

              <!-- Accordion / List for 9 Clubs -->
              <div id="clubs-accordion">
                <?php foreach ($clubs as $cIdx => $club): 
                  $chipsStr = is_array($club['chips'] ?? '') ? implode("\n", $club['chips']) : ($club['chips'] ?? '');
                ?>
                <div class="item-card mb-3" style="border-left: 5px solid #0A1B54;">
                  <div class="item-header">
                    <div>
                      <span class="badge badge-dark mr-2">#<?php echo $cIdx + 1; ?></span>
                      <strong style="font-size:15px;"><?php echo htmlspecialchars($club['name'] ?? ''); ?></strong>
                      <span class="text-muted ml-2">(Anchor ID: <code>#<?php echo htmlspecialchars($club['id'] ?? ''); ?></code>)</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.item-card').remove();"><i class="fa fa-trash"></i> Delete Club</button>
                  </div>

                  <div class="row">
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Anchor ID (URL jump link)</small>
                      <input type="text" name="club_id[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['id'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-5 form-group">
                      <small class="font-weight-bold">Club Display Name</small>
                      <input type="text" name="club_name[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['name'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-4 form-group">
                      <small class="font-weight-bold">Domain Subtitle</small>
                      <input type="text" name="club_desig[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['desig'] ?? ''); ?>">
                    </div>

                    <!-- Visual Frame Column Left -->
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Visual Category</small>
                      <input type="text" name="club_visual_cat[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['visual_cat'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Visual Short Name</small>
                      <input type="text" name="club_visual_name[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['visual_name'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Visual Tag / Milestone</small>
                      <input type="text" name="club_visual_tag[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['visual_tag'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <small class="font-weight-bold">Visual Icon</small>
                      <input type="text" name="club_visual_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['visual_icon'] ?? 'fa-star'); ?>">
                    </div>

                    <div class="col-md-4 form-group">
                      <small class="font-weight-bold">Desk Label</small>
                      <input type="text" name="club_desk_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['desk_label'] ?? ''); ?>">
                    </div>
                    <div class="col-md-2 form-group">
                      <small class="font-weight-bold">Desk Icon</small>
                      <input type="text" name="club_desk_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['desk_icon'] ?? 'fa-ticket'); ?>">
                    </div>
                    <div class="col-md-4 form-group">
                      <small class="font-weight-bold">Left Pill Badge Text</small>
                      <input type="text" name="club_pill_text[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['pill_text'] ?? ''); ?>">
                    </div>
                    <div class="col-md-2 form-group">
                      <small class="font-weight-bold">Pill Icon</small>
                      <input type="text" name="club_pill_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['pill_icon'] ?? 'fa-star'); ?>">
                    </div>

                    <div class="col-md-12 form-group">
                      <small class="font-weight-bold">Visual Card Gradient CSS</small>
                      <input type="text" name="club_visual_bg[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($club['visual_bg'] ?? 'linear-gradient(145deg, #040F4A 0%, #061D7C 60%, #0D2CB5 100%)'); ?>">
                    </div>

                    <div class="col-md-12 form-group">
                      <small class="font-weight-bold">Club Highlight Quote (Quote Box)</small>
                      <textarea name="club_quote[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($club['quote'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Body Paragraph 1 (HTML allowed)</small>
                      <textarea name="club_body_p1[]" class="form-control form-control-sm" rows="4"><?php echo htmlspecialchars($club['body_p1'] ?? ''); ?></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                      <small class="font-weight-bold">Body Paragraph 2 (HTML allowed)</small>
                      <textarea name="club_body_p2[]" class="form-control form-control-sm" rows="4"><?php echo htmlspecialchars($club['body_p2'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-md-12 form-group mb-0">
                      <small class="font-weight-bold">Key Focus Chips / Highlights (1 per line)</small>
                      <textarea name="club_chips[]" class="form-control form-control-sm" rows="3"><?php echo htmlspecialchars($chipsStr); ?></textarea>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- 5. Join Club CTA Strip -->
            <?php 
              $cbCta = $cData['cta'] ?? [];
            ?>
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-handshake-o"></i> Join Club CTA Banner Strip</span>
                <span class="badge badge-primary">CTA Banner</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Heading</label>
                  <input type="text" name="cta_heading" class="form-control" value="<?php echo htmlspecialchars($cbCta['heading'] ?? 'Join a University Club & Lead with Purpose!'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Description</label>
                  <textarea name="cta_desc" class="form-control" rows="2"><?php echo htmlspecialchars($cbCta['desc'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 1 Text</label>
                  <input type="text" name="cta_btn1_text" class="form-control" value="<?php echo htmlspecialchars($cbCta['btn1_text'] ?? 'Join a Club Today'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 1 URL</label>
                  <input type="text" name="cta_btn1_url" class="form-control" value="<?php echo htmlspecialchars($cbCta['btn1_url'] ?? 'enquiry.php'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 2 Text</label>
                  <input type="text" name="cta_btn2_text" class="form-control" value="<?php echo htmlspecialchars($cbCta['btn2_text'] ?? 'Contact Club Coordinators'); ?>">
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Button 2 URL</label>
                  <input type="text" name="cta_btn2_url" class="form-control" value="<?php echo htmlspecialchars($cbCta['btn2_url'] ?? 'contact.php'); ?>">
                </div>
              </div>
            </div>

          <?php elseif ($selPageKey != 'campus-life' && $selPageKey != 'clubs'): ?>
            <!-- ==========================================
                 TAB 3: FACILITY & STUDENT LIFE PAGE EDITOR
                 ========================================== -->
            <?php 
              $featList = $cData['features'] ?? [];
              if (!is_array($featList)) $featList = [];
              while (count($featList) < 6) {
                  $featList[] = ['icon' => 'fa-check', 'title' => '', 'desc' => ''];
              }
              $featImgPath = $cData['featured_image'] ?? '';
              $featImgDisplay = '';
              if (!empty($featImgPath)) {
                  if (strpos($featImgPath, 'upload/') === 0) {
                      $featImgDisplay = '../' . $featImgPath;
                  } else {
                      $featImgDisplay = URL_UPLOAD . $featImgPath;
                  }
              }
            ?>

            <!-- 1. Page Header & Meta Settings -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-info-circle"></i> Page Meta &amp; Banner Header</span>
                <span class="badge badge-primary">Banner &amp; Header</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Browser / SEO Title</label>
                  <input type="text" name="page_title" class="form-control" value="<?php echo htmlspecialchars($currPageData['page_title'] ?? ''); ?>" required>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Status</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php echo ($currPageData['status'] == 1) ? 'selected' : ''; ?>>Published (Live)</option>
                    <option value="0" <?php echo ($currPageData['status'] == 0) ? 'selected' : ''; ?>>Draft / Hidden</option>
                  </select>
                </div>
                <div class="col-md-3 form-group">
                  <label class="font-weight-bold">Page Icon (FontAwesome)</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="<?php echo normFa($cData['page_icon'] ?? 'fa-circle'); ?>" id="preview_page_icon"></i></span>
                    </div>
                    <input type="text" name="page_icon" id="input_page_icon" class="form-control" value="<?php echo htmlspecialchars($cData['page_icon'] ?? 'fa-circle'); ?>" placeholder="fa-home, fa-bus..." oninput="updateIconPreview(this.value, 'preview_page_icon')">
                  </div>
                </div>
                <div class="col-md-4 form-group">
                  <label class="font-weight-bold">Top Badge Tagline</label>
                  <input type="text" name="badge" class="form-control" value="<?php echo htmlspecialchars($currPageData['badge'] ?? ''); ?>" placeholder="e.g. A Home Away From Home">
                </div>
                <div class="col-md-8 form-group">
                  <label class="font-weight-bold">Page Banner Title (Use &lt;em&gt; for gold text)</label>
                  <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($currPageData['heading'] ?? ''); ?>" placeholder="e.g. On-Campus <em>Student Residences</em>" required>
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Page Subheading / Intro Description</label>
                  <textarea name="subheading" class="form-control" rows="2" placeholder="Brief summary under the banner title..."><?php echo htmlspecialchars($currPageData['subheading'] ?? ''); ?></textarea>
                </div>
              </div>
            </div>

            <!-- 2. Overview Section & Featured Media -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-picture-o"></i> Featured Image &amp; Overview Section</span>
                <span class="badge badge-primary">Section 1</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Featured Facility Image</label>
                  <input type="file" name="featured_image" class="form-control-file" accept="image/*">
                  <input type="hidden" name="featured_image_curr" value="<?php echo htmlspecialchars($featImgPath); ?>">
                  <small class="text-muted d-block mt-1">Recommended: 1200x600px or 800x450px high-resolution JPG/PNG/WEBP.</small>
                  <?php if (!empty($featImgDisplay)): ?>
                    <div class="mt-2 p-2 bg-light border rounded d-inline-block">
                      <img src="<?php echo $featImgDisplay; ?>" alt="Preview" style="max-height: 120px; border-radius: 6px; display: block;" onerror="this.style.display='none';">
                      <small class="text-muted mt-1 d-block font-italic" style="max-width: 280px; word-break: break-all;"><?php echo htmlspecialchars($featImgPath); ?></small>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">Image Caption</label>
                  <input type="text" name="image_caption" class="form-control" value="<?php echo htmlspecialchars($cData['image_caption'] ?? ''); ?>" placeholder="Caption displayed below the image">
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Overview Lead Paragraph</label>
                  <textarea name="overview_lead" class="form-control" rows="3" placeholder="Primary highlighted introduction paragraph (HTML bold/emphasis supported)"><?php echo htmlspecialchars($cData['overview_lead'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Overview Secondary Paragraph</label>
                  <textarea name="overview_p2" class="form-control" rows="3" placeholder="Secondary supporting paragraph..."><?php echo htmlspecialchars($cData['overview_p2'] ?? ''); ?></textarea>
                </div>
              </div>
            </div>

            <!-- 3. Key Features & Amenities Grid (6 Cards) -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-th-large"></i> Key Features &amp; Amenities Grid (Cards)</span>
                <span class="badge badge-info">Section 2</span>
              </div>
              <p class="text-muted mb-3"><i class="fa fa-info-circle mr-1"></i> These cards display in the interactive grid on the frontend. Leave title blank to omit a card.</p>
              
              <div class="row">
                <?php foreach ($featList as $idx => $feat): ?>
                  <div class="col-md-4 mb-3">
                    <div class="item-card h-100 p-3" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px;">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong class="text-primary font-weight-bold">Card #<?php echo ($idx + 1); ?></strong>
                        <i class="<?php echo normFa($feat['icon'] ?? 'fa-check'); ?>" id="preview_feat_icon_<?php echo $idx; ?>" style="font-size:18px; color:#D99B00;"></i>
                      </div>
                      <div class="form-group mb-2">
                        <small class="font-weight-bold">Icon (FontAwesome)</small>
                        <input type="text" name="feat_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($feat['icon'] ?? 'fa-check'); ?>" placeholder="fa-bed, fa-wifi..." oninput="updateIconPreview(this.value, 'preview_feat_icon_<?php echo $idx; ?>')">
                      </div>
                      <div class="form-group mb-2">
                        <small class="font-weight-bold">Feature Title</small>
                        <input type="text" name="feat_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($feat['title'] ?? ''); ?>" placeholder="Card Heading">
                      </div>
                      <div class="form-group mb-0">
                        <small class="font-weight-bold">Description</small>
                        <textarea name="feat_desc[]" class="form-control form-control-sm" rows="3" placeholder="Brief feature details..."><?php echo htmlspecialchars($feat['desc'] ?? ''); ?></textarea>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- 4. Detailed Information Section (Rich Text / CKEditor) -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-file-text-o"></i> Detailed Section &amp; Custom Content (Rich Editor)</span>
                <span class="badge badge-primary">Section 3</span>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label class="font-weight-bold">Section Heading / Title</label>
                  <input type="text" name="detail_title" class="form-control" value="<?php echo htmlspecialchars($cData['detail_title'] ?? 'Detailed Information'); ?>" placeholder="e.g. Room Types & Hostel Wings, Bus Routes & Timings, etc.">
                </div>
                <div class="col-md-12 form-group mb-0">
                  <label class="font-weight-bold">Rich Content (HTML / Tables / Timings / Regulations)</label>
                  <textarea name="detail_rich" id="detail_rich_editor" class="form-control ckeditor" rows="10"><?php echo htmlspecialchars($cData['detail_rich'] ?? ''); ?></textarea>
                  <small class="text-muted d-block mt-2">
                    <i class="fa fa-info-circle text-info mr-1"></i> You can use this rich editor to enter custom tables, schedules, guidelines, or code of conduct. If this is left blank, the website will display its built-in default table and guidelines for this section.
                  </small>
                </div>
              </div>
            </div>

            <!-- 5. Helpline & Call To Action (CTA) Banner Strip -->
            <div class="sec-card">
              <div class="sec-title">
                <span><i class="fa fa-phone-square"></i> Helpline &amp; Admission Action Banner</span>
                <span class="badge badge-primary">Section 4</span>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Banner Heading</label>
                  <input type="text" name="cta_title" class="form-control" value="<?php echo htmlspecialchars($cData['cta_title'] ?? 'Need Guidance or Support?'); ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label class="font-weight-bold">CTA Banner Description</label>
                  <textarea name="cta_desc" class="form-control" rows="2"><?php echo htmlspecialchars($cData['cta_desc'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-6 form-group mb-0">
                  <label class="font-weight-bold">Button Text</label>
                  <input type="text" name="cta_btn_text" class="form-control" value="<?php echo htmlspecialchars($cData['cta_btn_text'] ?? 'Apply Now'); ?>">
                </div>
                <div class="col-md-6 form-group mb-0">
                  <label class="font-weight-bold">Button Link / URL</label>
                  <input type="text" name="cta_btn_url" class="form-control" value="<?php echo htmlspecialchars($cData['cta_btn_url'] ?? 'enquiry.php'); ?>">
                </div>
              </div>
            </div>

          <?php endif; ?>

          <!-- Save Button Bar -->
          <div class="card p-3 mb-5" style="position:sticky; bottom:20px; z-index:99; background:rgba(255,255,255,0.96); backdrop-filter:blur(8px); border:1px solid #CBD5E1; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <span class="text-muted"><i class="fa fa-info-circle mr-1"></i> Changes will immediately take effect on the live website.</span>
              </div>
              <div>
                <button type="submit" name="submit" class="btn btn-success btn-lg px-4 font-weight-bold">
                  <i class="mdi mdi-content-save mr-1"></i> Save &amp; Publish Changes
                </button>
              </div>
            </div>
          </div>

        </form>

        <?php endif; // End Hub vs Editor check ?>

      </div>
    </div>
    <?php include('inc.footer.php'); ?>
  </div>
</div>

<?php include('inc.footer.js.php'); ?>
<script>
function updateIconPreview(val, targetId) {
  var el = document.getElementById(targetId);
  if (!el) return;
  val = val.trim();
  if (!val) val = 'fa-circle';
  if (val.indexOf('fa ') !== 0 && val.indexOf('fas ') !== 0 && val.indexOf('far ') !== 0 && val.indexOf('fab ') !== 0) {
    val = 'fa ' + (val.indexOf('fa-') === 0 ? val : 'fa-' + val);
  }
  el.className = val;
}
$(document).ready(function() {
  if (typeof CKEDITOR !== 'undefined') {
    $('.ckeditor').each(function() {
      var id = $(this).attr('id');
      if (id && !CKEDITOR.instances[id]) {
        CKEDITOR.replace(id);
      }
    });
  }
});
</script>
</body>
</html>
