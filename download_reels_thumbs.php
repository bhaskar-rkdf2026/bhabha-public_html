<?php
$dir = __DIR__ . '/upload/reels_thumbs';
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$reels = [
    'Dbr0ycHAi-x' => 'https://www.instagram.com/reel/Dbr0ycHAi-x/',
    'DanDix7AeZq' => 'https://www.instagram.com/reel/DanDix7AeZq/',
    'Dacmhdnj8hJ' => 'https://www.instagram.com/reel/Dacmhdnj8hJ/',
    'DaSehWXDgwj' => 'https://www.instagram.com/reel/DaSehWXDgwj/',
];

foreach ($reels as $code => $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/p/$code/embed/captioned/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    $html = curl_exec($ch);
    curl_close($ch);

    $imgUrl = '';
    if (preg_match('/<img class="EmbeddedMediaImage"[^>]+src="([^"]+)"/', $html, $matches)) {
        $imgUrl = html_entity_decode($matches[1]);
    } else if (preg_match('/"display_url":"([^"]+)"/', $html, $matches)) {
        $imgUrl = stripslashes($matches[1]);
    }

    if ($imgUrl) {
        $imgData = file_get_contents($imgUrl);
        if ($imgData) {
            file_put_contents("$dir/$code.jpg", $imgData);
            echo "SAVED $code.jpg (" . strlen($imgData) . " bytes)\n";
        } else {
            echo "FAILED to download img from $imgUrl\n";
        }
    } else {
        echo "NO IMG URL found for $code\n";
    }
}
