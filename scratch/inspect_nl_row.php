<?php
require_once('config.php');
$db->where('page_key', 'newsletter');
$row = $db->getOne('site_portal_pages');
echo "ID: " . $row['id'] . "\n";
echo "Page Title: " . $row['page_title'] . "\n";
echo "Content Data:\n";
print_r(json_decode($row['content_data'], true));
