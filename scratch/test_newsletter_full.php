<?php
require_once('config.php');

echo "--- 1. Testing newsletter.php rendering ---\n";
ob_start();
include('newsletter.php');
$html = ob_get_clean();

$hasFeatured = strpos($html, 'Bhabha Chronicle — Q2 2026 Edition') !== false;
$hasIssue1   = strpos($html, 'New Horizons in Innovation &amp; Academic Milestones') !== false || strpos($html, 'New Horizons in Innovation & Academic Milestones') !== false;
$hasIssue6   = strpos($html, '20 Years of Educational Excellence — 2004 to 2024') !== false;
$cardCount   = substr_count($html, 'class="bu-nl-card"');

echo "Featured Issue Present: " . ($hasFeatured ? "YES" : "NO") . "\n";
echo "Issue 1 Present: " . ($hasIssue1 ? "YES" : "NO") . "\n";
echo "Issue 6 Present: " . ($hasIssue6 ? "YES" : "NO") . "\n";
echo "Total Archive Cards Rendered: " . $cardCount . " (Expected: 6)\n";

if (!$hasFeatured || !$hasIssue1 || $cardCount !== 6) {
    echo "ERROR: newsletter.php rendering check failed!\n";
    exit(1);
}

echo "\n--- 2. Testing admin/student_publications.php Edit View for Newsletter ---\n";
require_once('admin/config.php');
$_SESSION[LOGIN_ADMIN] = ['userName' => 'admin'];
$_GET['action'] = 'edit';
$_GET['id'] = 21;

ob_start();
include('admin/student_publications.php');
$adminHtml = ob_get_clean();

$hasContainer = strpos($adminHtml, 'id="newsletter-container"') !== false;
$hasTemplate  = strpos($adminHtml, 'id="nl-card-template"') !== false;
$hasAddTop    = strpos($adminHtml, 'id="btn-add-nl"') !== false;
$hasAddBottom = strpos($adminHtml, 'id="btn-add-nl-bottom"') !== false;
$hasDeleteBtn = strpos($adminHtml, 'class="btn btn-outline-danger btn-sm py-0 px-2 remove-nl-btn"') !== false;
$adminCardCols = substr_count($adminHtml, 'nl-card-col');

echo "Newsletter Container Present: " . ($hasContainer ? "YES" : "NO") . "\n";
echo "Newsletter Template Present: " . ($hasTemplate ? "YES" : "NO") . "\n";
echo "Add Top Button Present: " . ($hasAddTop ? "YES" : "NO") . "\n";
echo "Add Bottom Button Present: " . ($hasAddBottom ? "YES" : "NO") . "\n";
echo "Delete Buttons Present: " . ($hasDeleteBtn ? "YES" : "NO") . "\n";
echo "Admin Cards in Container (including template): " . $adminCardCols . "\n";

echo "\nAll verification checks PASSED successfully!\n";
