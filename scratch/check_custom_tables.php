<?php
require_once __DIR__ . '/../config.php';

$tables = ['homepage_sections', 'research_portal', 'site_blogs', 'site_portal_pages'];

foreach ($tables as $t) {
    echo "=== TABLE: $t ===\n";
    $count = $db->rawQueryValue("SELECT COUNT(*) FROM `$t`");
    echo "Rows: $count\n";
    $rows = $db->get($t, 5);
    foreach ($rows as $r) {
        $key = $r['section_key'] ?? $r['slug'] ?? $r['title'] ?? $r['id'];
        echo "  - ID: " . $r['id'] . " | Key/Slug/Title: " . $key . "\n";
    }
    echo "\n";
}
