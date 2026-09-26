<?php
// Strict file extension and size validation
$allowed_exts = ['jpeg', 'jpg', 'png', 'webp', 'pdf', 'doc', 'docx'];
$upload_fields = [
    'upload_domicile',
    'upload_caste',
    'upload_income',
    'upload_high_school',
    'upload_higher_school',
    'uploadg',
    'uploadpg',
    'aadhar_card',
    'photo',
    'otherdocx'
];

foreach ($upload_fields as $field) {
    if (isset($_FILES[$field]) && !empty($_FILES[$field]['name'])) {
        $filename = basename($_FILES[$field]['name']);
        $parts = explode('.', strtolower($filename));
        $ext = end($parts);

        // Check for double extension containing dangerous words
        $has_dangerous_ext = false;
        if (count($parts) > 2) {
            foreach ($parts as $p) {
                if (in_array($p, ['php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar', 'inc', 'cgi', 'pl', 'sh', 'exe', 'bat'])) {
                    $has_dangerous_ext = true;
                    break;
                }
            }
        }

        if (empty($ext) || !in_array($ext, $allowed_exts, true) || $has_dangerous_ext) {
            $stat["error"] = "Only JPG, PNG, WEBP, PDF & DOCX files are allowed.";
            break;
        }

        // Limit file size to 10MB per file
        if (!empty($_FILES[$field]['size']) && $_FILES[$field]['size'] > (10 * 1024 * 1024)) {
            $stat["error"] = "Uploaded file is too large. Maximum allowed size is 10MB.";
            break;
        }
    }
}