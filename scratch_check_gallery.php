<?php
require_once __DIR__ . '/config.php';
echo "=== DESCRIBE gallery ===\n";
print_r($db->rawQuery('DESCRIBE gallery'));

echo "\n=== RECENT GALLERY ITEMS ===\n";
$db->orderBy('id', 'desc');
print_r($db->get('gallery', 5));
