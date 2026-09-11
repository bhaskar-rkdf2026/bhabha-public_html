<?php
require_once __DIR__ . '/../config.php';
$tables = $db->rawQuery("SHOW TABLES");
echo "Total tables in $dbName: " . count($tables) . "\n";
foreach ($tables as $t) {
    $tbl = array_values($t)[0];
    echo " - " . $tbl . "\n";
}
