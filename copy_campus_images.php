<?php
$src1 = "C:/Users/USER/Downloads/WhatsApp Image 2026-08-08 at 11.53.06 AM.jpeg";
$src2 = "C:/Users/USER/Downloads/WhatsApp Image 2026-08-08 at 11.53.06 AM (1).jpeg";

$dest1 = __DIR__ . "/new-media/image/bhabha-main-building.jpg";
$dest2 = __DIR__ . "/new-media/image/bhabha-engineering-building.jpg";

if (file_exists($src1)) {
    copy($src1, $dest1);
    echo "COPIED $dest1 (" . filesize($dest1) . " bytes)\n";
} else {
    echo "ERROR: $src1 not found\n";
}

if (file_exists($src2)) {
    copy($src2, $dest2);
    echo "COPIED $dest2 (" . filesize($dest2) . " bytes)\n";
} else {
    echo "ERROR: $src2 not found\n";
}
