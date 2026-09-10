<?php
require_once('config.php');
$tables = $db->rawQuery("SHOW TABLES");
echo "Tables matching 'blog':\n";
$found = false;
foreach ($tables as $t) {
    $name = current($t);
    if (stripos($name, 'blog') !== false) {
        echo " - " . $name . "\n";
        $found = true;
    }
}
if (!$found) echo "No blog tables found in DB.\n";
