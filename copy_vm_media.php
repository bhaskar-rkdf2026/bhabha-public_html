<?php
$src = "C:/Users/USER/Downloads/WhatsApp Image 2026-08-08 at 2.12.53 PM.jpeg";
$dest1 = __DIR__ . "/extra-images/vision-mission-banner.jpg";
$dest2 = __DIR__ . "/new-media/image/vision-mission-banner.jpg";

if (file_exists($src)) {
    copy($src, $dest1);
    copy($src, $dest2);
    echo "COPIED successfully to $dest1 (" . filesize($dest1) . " bytes)\n";
} else {
    echo "ERROR: Source file $src not found\n";
}
