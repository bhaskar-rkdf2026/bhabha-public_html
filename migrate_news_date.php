<?php
require_once __DIR__ . '/config.php';

echo "=== MIGRATING NEWS TABLE FOR DATE-WISE FEATURE ===\n\n";

// 1. Add news_date column if not exists
$cols = $db->rawQuery("SHOW COLUMNS FROM `news` LIKE 'news_date'");
if (empty($cols)) {
    try {
        $db->rawQuery("ALTER TABLE `news` ADD COLUMN `news_date` DATE NULL DEFAULT NULL AFTER `title`");
        echo "Added column `news_date` to `news` table.\n";
    } catch (Exception $e) {
        echo "Notice: " . $e->getMessage() . "\n";
    }
} else {
    echo "Column `news_date` already exists.\n";
}

// 2. Populate dates for existing rows
$allNews = $db->rawQuery("SELECT id, title, image, news_date FROM `news` ORDER BY id DESC");
$updatedCount = 0;

$monthsMap = [
    'january' => '01', 'jan' => '01',
    'february' => '02', 'feb' => '02',
    'march' => '03', 'mar' => '03',
    'april' => '04', 'apr' => '04',
    'may' => '05',
    'june' => '06', 'jun' => '06',
    'july' => '07', 'jul' => '07',
    'august' => '08', 'aug' => '08',
    'september' => '09', 'sep' => '09', 'sept' => '09',
    'october' => '10', 'oct' => '10',
    'november' => '11', 'nov' => '11',
    'december' => '12', 'dec' => '12'
];

foreach ($allNews as $item) {
    $id = $item['id'];
    $title = $item['title'] ?? '';
    $assignedDate = $item['news_date'];

    if (empty($assignedDate) || $assignedDate == '0000-00-00') {
        $foundDate = null;

        // Try exact patterns like "08-06-2026" or "30-04-2026" or "30/04/2026"
        if (preg_match('/(\d{1,2})[-\/](\d{1,2})[-\/](20\d{2})/', $title, $m)) {
            $day = str_pad($m[1], 2, '0', STR_PAD_LEFT);
            $month = str_pad($m[2], 2, '0', STR_PAD_LEFT);
            $year = $m[3];
            $foundDate = "{$year}-{$month}-{$day}";
        }
        // Try pattern like "30 April 2026" or "15th August 2026" or "August 2026"
        elseif (preg_match('/(?:(\d{1,2})(?:st|nd|rd|th)?\s+)?(January|February|March|April|May|June|July|August|September|October|November|December|Jan|Feb|Mar|Apr|Jun|Jul|Aug|Sep|Sept|Oct|Nov|Dec)\s+(20\d{2})/i', $title, $m)) {
            $day = !empty($m[1]) ? str_pad($m[1], 2, '0', STR_PAD_LEFT) : '15';
            $monthName = strtolower($m[2]);
            $month = $monthsMap[$monthName] ?? '01';
            $year = $m[3];
            $foundDate = "{$year}-{$month}-{$day}";
        }
        // Try just finding a year like 2026, 2025, 2024, 2023, 2022, 2021
        elseif (preg_match('/(202[0-9])/', $title, $m)) {
            $year = $m[1];
            // Distribute month roughly by ID
            $monthNum = str_pad((($id % 12) + 1), 2, '0', STR_PAD_LEFT);
            $dayNum = str_pad((($id % 25) + 1), 2, '0', STR_PAD_LEFT);
            $foundDate = "{$year}-{$monthNum}-{$dayNum}";
        } else {
            // Fallback estimation based on ID range
            // IDs around 170-190 -> 2026
            // IDs around 130-169 -> 2025
            // IDs around 80-129  -> 2024
            // IDs around 30-79   -> 2023
            // IDs < 30           -> 2022
            if ($id >= 170) {
                $year = '2026';
            } elseif ($id >= 130) {
                $year = '2025';
            } elseif ($id >= 80) {
                $year = '2024';
            } elseif ($id >= 30) {
                $year = '2023';
            } else {
                $year = '2022';
            }
            $monthNum = str_pad((($id % 12) + 1), 2, '0', STR_PAD_LEFT);
            $dayNum = str_pad((($id % 25) + 1), 2, '0', STR_PAD_LEFT);
            $foundDate = "{$year}-{$monthNum}-{$dayNum}";
        }

        if ($foundDate) {
            $db->rawQuery("UPDATE `news` SET `news_date` = ? WHERE `id` = ?", [$foundDate, $id]);
            $updatedCount++;
        }
    }
}

echo "Assigned dates to {$updatedCount} news records successfully.\n";

// Show summary of year distribution
$summary = $db->rawQuery("SELECT YEAR(news_date) as yr, COUNT(*) as cnt FROM `news` GROUP BY YEAR(news_date) ORDER BY yr DESC");
echo "\nYear-wise News Distribution:\n";
foreach ($summary as $row) {
    echo "Year " . ($row['yr'] ?? 'Unknown') . ": " . $row['cnt'] . " records\n";
}
