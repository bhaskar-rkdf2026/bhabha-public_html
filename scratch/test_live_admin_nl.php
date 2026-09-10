<?php
// Session cookie test for admin
require_once('admin/config.php');
$sessionName = session_name();
$sessionId = session_id();
$_SESSION[LOGIN_ADMIN] = ['userName' => 'admin', 'userId' => 1];
session_write_close();

$url = 'https://localhost/bhabha/bhabha-public_html/admin/student_publications.php?action=edit&id=21';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_COOKIE, "$sessionName=$sessionId");
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "Admin Edit Live HTTP Code: " . $code . "\n";
if (strpos($res, 'newsletter-container') !== false) {
    echo "Live check SUCCESS: newsletter-container found in admin edit HTML!\n";
}
if (strpos($res, 'btn-add-nl') !== false) {
    echo "Live check SUCCESS: btn-add-nl found in admin edit HTML!\n";
}
