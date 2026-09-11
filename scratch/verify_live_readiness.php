<?php
echo "=== 1. CHECKING PHP SYNTAX IN ROOT AND SUBDIRECTORIES ===\n";

$dirs = [
    __DIR__ . '/../',
    __DIR__ . '/../admin/',
    __DIR__ . '/../library/'
];

$errors = [];
$totalChecked = 0;

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $files = scandir($dir);
    foreach ($files as $f) {
        if (substr($f, -4) === '.php') {
            $path = realpath($dir . '/' . $f);
            $totalChecked++;
            $out = [];
            $code = 0;
            exec("D:\\xampp\\php\\php.exe -l " . escapeshellarg($path), $out, $code);
            if ($code !== 0) {
                $errors[] = "$path: " . implode(" ", $out);
            }
        }
    }
}

echo "Total PHP files linted: $totalChecked\n";
if (empty($errors)) {
    echo "SUCCESS: No PHP syntax errors found in any scanned file!\n";
} else {
    echo "ERRORS FOUND (" . count($errors) . "):\n";
    foreach ($errors as $e) {
        echo "  - $e\n";
    }
}

echo "\n=== 2. CHECKING DATABASE CONNECTION AND KEY TABLES ===\n";
require_once __DIR__ . '/../config.php';

if (!isset($db)) {
    echo "ERROR: \$db is not initialized!\n";
} else {
    echo "Database instance found.\n";
    $tables = [
        'settings', 'course', 'events', 'leadership', 'sliders', 'slider', 
        'news_and_announcement', 'department', 'infrastructure', 'recruiters', 
        'gallery', 'testimonial', 'approvals', 'jobs', 'notice', 'timetable', 
        'syllabus', 'affiliate', 'advisory'
    ];
    
    foreach ($tables as $tbl) {
        try {
            $res = $db->rawQuery("SHOW TABLES LIKE ?", [$tbl]);
            if (!empty($res)) {
                $cnt = $db->rawQueryValue("SELECT COUNT(*) FROM `$tbl`");
                echo "  [OK] Table `$tbl` exists ($cnt rows)\n";
            } else {
                echo "  [INFO] Table `$tbl` not found or has different name\n";
            }
        } catch (Exception $ex) {
            echo "  [FAIL] Querying `$tbl`: " . $ex->getMessage() . "\n";
        }
    }
}

echo "\n=== 3. CHECKING NEW COLUMNS REQUIRED BY RECENT CHANGES ===\n";
$colChecks = [
    'course' => ['duration', 'eligibility', 'seats', 'is_featured'],
    'events' => ['event_date', 'category'],
    'leadership' => ['quote']
];

foreach ($colChecks as $tbl => $cols) {
    $existing = [];
    $fields = $db->rawQuery("SHOW COLUMNS FROM `$tbl`");
    foreach ($fields as $fld) {
        $existing[] = $fld['Field'];
    }
    foreach ($cols as $col) {
        if (in_array($col, $existing)) {
            echo "  [OK] `$tbl`.`$col` exists\n";
        } else {
            echo "  [WARNING MISSING] `$tbl`.`$col` DOES NOT EXIST!\n";
        }
    }
}

echo "\n=== 4. CHECKING SETTINGS KEYS FOR HOMEPAGE SECTIONS ===\n";
$keys = [
    'placement_rate', 'placement_highest_pkg', 'placement_total_recruiters',
    'research_patents', 'research_publications', 'research_grants', 'research_mous',
    'achievements_ticker', 'global_network_partners', 'insta_reels_codes', 'chancellor_quote'
];

foreach ($keys as $k) {
    if (isset($aryForm[$k])) {
        echo "  [OK] Setting `$k` = " . substr($aryForm[$k], 0, 30) . "...\n";
    } else {
        echo "  [WARNING MISSING] Setting `$k` is missing in \$aryForm!\n";
    }
}
