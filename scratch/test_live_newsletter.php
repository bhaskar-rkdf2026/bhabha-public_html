<?php
$ch = curl_init('https://localhost/bhabha/bhabha-public_html/newsletter.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "HTTP Code: " . $code . ", Body Length: " . strlen($res) . "\n";
if (strpos($res, 'Bhabha Chronicle — Q2 2026 Edition') !== false) {
    echo "Live check SUCCESS: Featured newsletter found in response!\n";
} else {
    echo "Live check: string not found\n";
}
