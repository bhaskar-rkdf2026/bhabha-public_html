<?php
$dirs = ['images', 'extra-images', 'new-media/image'];
foreach ($dirs as $dir) {
    $fullDir = __DIR__ . '/' . $dir;
    if (!is_dir($fullDir)) continue;
    $files = glob("$fullDir/*.*");
    echo "=== $dir (" . count($files) . " files) ===\n";
    foreach ($files as $f) {
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','png','jpeg','webp'])) {
            echo "  " . basename($f) . "\n";
        }
    }
}
