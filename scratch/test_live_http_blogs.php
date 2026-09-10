<?php
require_once('admin/config.php');
$sessionName = session_name();
$sessionId = session_id();
$_SESSION[LOGIN_ADMIN] = ['userName' => 'admin', 'userId' => 1];
session_write_close();

$urls = [
    'Frontend Blogs' => 'https://localhost/bhabha/bhabha-public_html/blogs.php',
    'Admin Blogs List' => 'https://localhost/bhabha/bhabha-public_html/admin/blogs.php',
    'Admin Blogs Add' => 'https://localhost/bhabha/bhabha-public_html/admin/blogs.php?action=add',
    'Admin Blogs Edit #1' => 'https://localhost/bhabha/bhabha-public_html/admin/blogs.php?action=edit&id=1',
    'Student Pubs Blogs Hub' => 'https://localhost/bhabha/bhabha-public_html/admin/student_publications.php?action=edit&id=22',
    'Admin Dashboard' => 'https://localhost/bhabha/bhabha-public_html/admin/dashboard.php'
];

foreach ($urls as $label => $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_COOKIE, "$sessionName=$sessionId");
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "$label: HTTP $code, Length: " . strlen($res) . "\n";
}
