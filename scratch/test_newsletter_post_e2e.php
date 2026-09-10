<?php
require_once('config.php');
require_once('admin/config.php');

echo "--- 3. Testing POST Submission (Add & Edit Newsletter) ---\n";

$_SESSION[LOGIN_ADMIN] = ['userName' => 'admin'];
$_POST['submit'] = 1;
$_POST['id'] = 21;
$_POST['page_title'] = 'E-Newsletter & Quarterly Digest - Bhabha University';
$_POST['badge'] = 'Quarterly Bulletin';
$_POST['heading'] = 'University <em>E-Newsletter</em>';
$_POST['subheading'] = 'Quarterly digest documenting campus news, faculty awards, conference milestones, and student triumphs.';
$_POST['status'] = 1;

// Featured Edition
$_POST['nl_title'] = 'Bhabha Chronicle — Special Innovation 2026 Edition (TEST)';
$_POST['nl_volume'] = 'Vol. 6 | Issue 2';
$_POST['nl_period'] = 'Apr – Jun 2026';
$_POST['nl_badge'] = 'TEST RELEASE';
$_POST['nl_desc'] = 'Updated test summary description for the newsletter digest.';
$_POST['nl_highlights'] = "Highlight 1\nHighlight 2\nHighlight 3";
$_POST['nl_pdf_url'] = 'upload/research/overview.pdf';

// 7 Editions (6 original + 1 new test edition)
$_POST['nl_item_title'] = [
    'New Horizons in Innovation & Academic Milestones',
    'Convocation Special & Industry Collaboration Report',
    'Pharmacy Research & Healthcare Outreach Focus',
    'Engineering Innovations & Smart Campus Upgrades',
    'Academic Year Kickoff & Placement Milestones',
    '20 Years of Educational Excellence — 2004 to 2024',
    'AI in Healthcare & Robotic Surgery Symposium (NEW TEST)'
];

$_POST['nl_item_vol'] = [
    'Vol. 6 | Issue 1',
    'Vol. 5 | Issue 4',
    'Vol. 5 | Issue 3',
    'Vol. 5 | Issue 2',
    'Vol. 5 | Issue 1',
    'Vol. 4 | Special Issue',
    'Vol. 6 | Issue 3'
];

$_POST['nl_item_date'] = [
    'Jan – Mar 2026',
    'Oct – Dec 2025',
    'Jul – Sep 2025',
    'Apr – Jun 2025',
    'Jan – Mar 2025',
    'Annual Roundup 2024',
    'Jul – Sep 2026'
];

$_POST['nl_item_size'] = [
    '16 Pages • PDF',
    '20 Pages • PDF',
    '18 Pages • PDF',
    '16 Pages • PDF',
    '14 Pages • PDF',
    '32 Pages • PDF',
    '24 Pages • PDF'
];

$_POST['nl_item_topics'] = [
    "Conference on IoT\nFest Tarang 2026",
    "5th Convocation\nMOU Signing",
    "Health Camps\nPharmacy Week",
    "Solar campus\nHackathon winners",
    "Orientation batch\n850 placement offers",
    "Two-decade report\nAlumni hall of fame",
    "Robotics in Medicine\nHealthcare AI Ethics\nStudent Paper Awards"
];

$_POST['nl_item_url'] = [
    'upload/research/overview.pdf',
    'upload/research/overview.pdf',
    'upload/research/overview.pdf',
    'upload/research/overview.pdf',
    'upload/research/overview.pdf',
    'upload/research/overview.pdf',
    'upload/media/sample_test_edition.pdf'
];

// Temporarily override redirect
function test_redirect_dummy($url) {
    echo "Redirect called to: $url\n";
}

// Emulate POST processing
$id = intval($_POST['id']);
$db->where('id', $id);
$pageRow = $db->getOne('site_portal_pages');
$pageKey = $pageRow['page_key'];

$contentData = !empty($pageRow['content_data']) ? json_decode($pageRow['content_data'], true) : [];

// Call exact logic from admin/student_publications.php
$nlPdf = trim($_POST['nl_pdf_url'] ?? '');
$rawHighlights = trim($_POST['nl_highlights'] ?? '');
$highlights = [];
if (!empty($rawHighlights)) {
    $lines = explode("\n", str_replace("\r", "", $rawHighlights));
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line)) $highlights[] = $line;
    }
}

$contentData['latest'] = [
    'title'      => trim($_POST['nl_title']),
    'volume'     => trim($_POST['nl_volume']),
    'period'     => trim($_POST['nl_period']),
    'badge'      => trim($_POST['nl_badge']),
    'desc'       => trim($_POST['nl_desc']),
    'highlights' => $highlights,
    'pdf_url'    => $nlPdf
];

$archive = [];
for ($i = 0; $i < count($_POST['nl_item_title']); $i++) {
    $title = trim($_POST['nl_item_title'][$i]);
    if (!empty($title)) {
        $rawT = trim($_POST['nl_item_topics'][$i] ?? '');
        $topicsArr = [];
        if (!empty($rawT)) {
            $lines = explode("\n", str_replace("\r", "", $rawT));
            foreach ($lines as $l) {
                $l = trim($l);
                if (!empty($l)) $topicsArr[] = $l;
            }
        }
        $archive[] = [
            'title'  => $title,
            'vol'    => trim($_POST['nl_item_vol'][$i] ?? ''),
            'date'   => trim($_POST['nl_item_date'][$i] ?? ''),
            'size'   => trim($_POST['nl_item_size'][$i] ?? '16 Pages • PDF'),
            'topics' => $topicsArr,
            'url'    => trim($_POST['nl_item_url'][$i] ?? '')
        ];
    }
}
$contentData['archive'] = $archive;

$db->where('id', $id);
$db->update('site_portal_pages', [
    'content_data' => json_encode($contentData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
    'updated_at'   => date('Y-m-d H:i:s')
]);

echo "Updated row in DB. Now checking frontend newsletter.php render:\n";

// Render frontend
ob_start();
$portalPage = getPortalPage('newsletter');
include('newsletter.php');
$frontendHtml = ob_get_clean();

$hasNewTestTitle = strpos($frontendHtml, 'AI in Healthcare &amp; Robotic Surgery Symposium (NEW TEST)') !== false;
$hasNewFeatTitle = strpos($frontendHtml, 'Bhabha Chronicle — Special Innovation 2026 Edition (TEST)') !== false;
$newCardCount    = substr_count($frontendHtml, 'class="bu-nl-card"');

echo "New 7th Edition Rendered on Frontend: " . ($hasNewTestTitle ? "YES" : "NO") . "\n";
echo "New Featured Title Rendered on Frontend: " . ($hasNewFeatTitle ? "YES" : "NO") . "\n";
echo "Total Cards on Frontend: " . $newCardCount . " (Expected: 7)\n";

if (!$hasNewTestTitle || !$hasNewFeatTitle || $newCardCount !== 7) {
    echo "ERROR: POST simulation failed!\n";
    exit(1);
}

// Clean up and reset back to the pristine 6 editions
require_once('scratch/seed_nl_data.php');
echo "\nReset back to pristine 6 editions complete!\n";
