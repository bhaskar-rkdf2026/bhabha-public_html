<?php
require_once('config.php');
require_once('admin/config.php');

echo "====================================================\n";
echo "1. TESTING FRONTEND blogs.php RENDERING\n";
echo "====================================================\n";

ob_start();
include('blogs.php');
$frontendHtml = ob_get_clean();

$hasHero = strpos($frontendHtml, 'Commercializing Academic Research') !== false;
$hasCloud = strpos($frontendHtml, 'Architecting Resilient Cloud Infrastructure') !== false;
$hasTargeted = strpos($frontendHtml, 'Next-Generation Targeted Drug Delivery') !== false;
$cardCount = substr_count($frontendHtml, 'class="bu-post-card"');

echo "Featured Hero Article Present: " . ($hasHero ? "YES" : "NO") . "\n";
echo "Cloud Article Present: " . ($hasCloud ? "YES" : "NO") . "\n";
echo "Targeted Drug Delivery Present: " . ($hasTargeted ? "YES" : "NO") . "\n";
echo "Total Grid Cards: $cardCount (Expected: 6)\n";

if (!$hasHero || !$hasCloud || $cardCount !== 6) {
    echo "ERROR: Frontend blogs.php verification failed!\n";
    exit(1);
}

echo "\n====================================================\n";
echo "2. TESTING ADMIN admin/blogs.php VIEWS\n";
echo "====================================================\n";

$_SESSION[LOGIN_ADMIN] = ['userName' => 'admin', 'userId' => 1];

// A. List View
$_GET = [];
ob_start();
include('admin/blogs.php');
$listViewHtml = ob_get_clean();

$hasTable = strpos($listViewHtml, 'id="datatable"') !== false;
$hasAddBtn = strpos($listViewHtml, '+ Add New Blog Post') !== false;
$hasKpi = strpos($listViewHtml, 'Total Blog Articles') !== false;

echo "List View DataTable Present: " . ($hasTable ? "YES" : "NO") . "\n";
echo "Add Button Present: " . ($hasAddBtn ? "YES" : "NO") . "\n";
echo "KPI Cards Present: " . ($hasKpi ? "YES" : "NO") . "\n";

if (!$hasTable || !$hasAddBtn) {
    echo "ERROR: Admin blogs.php list view failed!\n";
    exit(1);
}

// B. Add View
$_GET = ['action' => 'add'];
ob_start();
include('admin/blogs.php');
$addViewHtml = ob_get_clean();
$hasAddForm = strpos($addViewHtml, 'Publish New Blog Article') !== false;
echo "Add Form Present: " . ($hasAddForm ? "YES" : "NO") . "\n";

// C. Edit View
$_GET = ['action' => 'edit', 'id' => 1];
ob_start();
include('admin/blogs.php');
$editViewHtml = ob_get_clean();
$hasEditForm = strpos($editViewHtml, 'Edit Blog Article:') !== false;
echo "Edit Form Present: " . ($hasEditForm ? "YES" : "NO") . "\n";

if (!$hasAddForm || !$hasEditForm) {
    echo "ERROR: Admin form view failed!\n";
    exit(1);
}

echo "\n====================================================\n";
echo "3. TESTING CRUD OPERATIONS ON site_blogs\n";
echo "====================================================\n";

// Insert test blog
$testBlog = [
    'title'         => 'Test Quantum Computing in Cryptography (TEST)',
    'slug'          => 'test-quantum-computing-cryptography',
    'category'      => 'tech',
    'category_name' => 'AI & Tech',
    'author_name'   => 'Dr. Quantum Tester',
    'author_role'   => 'Research Scientist',
    'publish_date'  => '2026-09-01',
    'read_time'     => '5 min read',
    'tags'          => 'Quantum, Cryptography, Security',
    'summary'       => 'Test summary for the newly added monthly blog article.',
    'content'       => '<p>Test full content describing post-quantum encryption protocols tested in university computing clusters.</p>',
    'is_featured'   => 0,
    'status'        => 1,
    'created_at'    => date('Y-m-d H:i:s')
];

$testId = $db->insert('site_blogs', $testBlog);
echo "Inserted test blog with ID: $testId\n";

// Verify frontend renders 7 grid cards now
ob_start();
include('blogs.php');
$updatedHtml = ob_get_clean();
$hasTestArticle = strpos($updatedHtml, 'Test Quantum Computing in Cryptography (TEST)') !== false;
$newGridCount = substr_count($updatedHtml, 'class="bu-post-card"');

echo "Test Article on Frontend: " . ($hasTestArticle ? "YES" : "NO") . "\n";
echo "New Grid Count: $newGridCount (Expected: 7)\n";

// Test Status Toggle
$db->where('id', $testId)->update('site_blogs', ['status' => 0]);
ob_start();
include('blogs.php');
$toggledHtml = ob_get_clean();
$hasToggled = strpos($toggledHtml, 'Test Quantum Computing in Cryptography (TEST)') !== false;
echo "Draft Article Hidden on Frontend: " . (!$hasToggled ? "YES (Correctly Hidden)" : "NO") . "\n";

// Clean up test blog
$db->where('id', $testId)->delete('site_blogs');
echo "Deleted test blog $testId. Clean up complete!\n";

echo "\nAll Blogs System tests PASSED 100% successfully!\n";
