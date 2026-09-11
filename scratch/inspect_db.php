<?php
require_once __DIR__ . '/../config.php';

echo "Database connected: " . $dbName . "\n";

$dbs = $db->rawQuery("SHOW DATABASES");
echo "Available databases:\n";
foreach ($dbs as $d) {
    echo " - " . $d['Database'] . "\n";
}

echo "\nChecking columns in 'course':\n";
$cols = $db->rawQuery("SHOW COLUMNS FROM course");
foreach ($cols as $c) {
    echo " - " . $c['Field'] . " (" . $c['Type'] . ")\n";
}

echo "\nChecking columns in 'events':\n";
$cols = $db->rawQuery("SHOW COLUMNS FROM events");
foreach ($cols as $c) {
    echo " - " . $c['Field'] . " (" . $c['Type'] . ")\n";
}

echo "\nChecking columns in 'leadership':\n";
$cols = $db->rawQuery("SHOW COLUMNS FROM leadership");
foreach ($cols as $c) {
    echo " - " . $c['Field'] . " (" . $c['Type'] . ")\n";
}

echo "\nChecking settings rows:\n";
$rows = $db->rawQuery("SELECT field, value FROM settings");
echo "Total settings count: " . count($rows) . "\n";
foreach ($rows as $r) {
    echo " - " . $r['field'] . " = " . substr($r['value'] ?? '', 0, 40) . "\n";
}
