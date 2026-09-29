<?php
require_once __DIR__ . '/config.php';

header('Content-Type: text/plain; charset=utf-8');

echo "=== BHABHA UNIVERSITY DATABASE URL FIXER ===\n\n";

$targetDomain = "https://www.bhabhauniversity.edu.in/";
$replacements = [
    'http://localhost/bhabha-public_html/' => $targetDomain,
    'https://localhost/bhabha-public_html/' => $targetDomain,
    '//localhost/bhabha-public_html/' => $targetDomain,
    'http://127.0.0.1/bhabha-public_html/' => $targetDomain,
    'https://127.0.0.1/bhabha-public_html/' => $targetDomain,
    '//127.0.0.1/bhabha-public_html/' => $targetDomain,
];

$tables = $db->rawQuery('SHOW TABLES');
$dbKey = 'Tables_in_' . $dbName;
$totalUpdated = 0;

foreach($tables as $t) {
    $tableName = $t[$dbKey] ?? reset($t);
    $cols = $db->rawQuery("SHOW COLUMNS FROM `{$tableName}`");
    foreach($cols as $c) {
        $colName = $c['Field'];
        $type = strtolower($c['Type']);
        if(strpos($type, 'char') !== false || strpos($type, 'text') !== false) {
            foreach($replacements as $search => $replace) {
                try {
                    $cntRes = $db->rawQuery("SELECT COUNT(*) as cnt FROM `{$tableName}` WHERE `{$colName}` LIKE '%" . addslashes($search) . "%'");
                    $cnt = $cntRes[0]['cnt'] ?? 0;
                    if($cnt > 0) {
                        $db->rawQuery("UPDATE `{$tableName}` SET `{$colName}` = REPLACE(`{$colName}`, '{$search}', '{$replace}') WHERE `{$colName}` LIKE '%" . addslashes($search) . "%'");
                        echo "Fixed {$cnt} rows in `{$tableName}`.`{$colName}` [{$search} -> {$replace}]\n";
                        $totalUpdated += $cnt;
                    }
                } catch(Exception $e) {
                    echo "Error on {$tableName}.{$colName}: " . $e->getMessage() . "\n";
                }
            }
        }
    }
}

echo "\nTotal URL fixes applied: {$totalUpdated}\n";
