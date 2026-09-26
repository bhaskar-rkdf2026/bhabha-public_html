<?php
// Strict, secure file upload processor
if (!function_exists('bu_secure_upload_file')) {
    function bu_secure_upload_file($file_key, $upload_dir) {
        if (!isset($_FILES[$file_key]) || empty($_FILES[$file_key]['name']) || !is_uploaded_file($_FILES[$file_key]['tmp_name'])) {
            return null;
        }

        $orig_name = basename($_FILES[$file_key]['name']);
        
        // Strict whitelist of safe extensions
        $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx'];
        
        // Extract real extension safely
        $parts = explode('.', strtolower($orig_name));
        $ext = end($parts);
        
        // Block double extension attacks (e.g., shell.php.jpg)
        if (count($parts) > 2) {
            foreach ($parts as $p) {
                if (in_array($p, ['php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar', 'inc', 'cgi', 'pl', 'sh', 'exe', 'bat'])) {
                    return null;
                }
            }
        }

        if (!in_array($ext, $allowed_exts, true)) {
            return null;
        }

        // Generate secure random filename
        $new_filename = md5(uniqid(microtime(), true)) . '.' . $ext;
        $target_path = rtrim($upload_dir, '/\\') . DIRECTORY_SEPARATOR . $new_filename;

        if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $target_path)) {
            return $new_filename;
        }

        return null;
    }
}

$upload_keys = [
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

foreach ($upload_keys as $ukey) {
    if (isset($_FILES[$ukey]) && !empty($_FILES[$ukey]['name'])) {
        $uploaded = bu_secure_upload_file($ukey, defined('UPLOAD') ? UPLOAD : (PATH_ROOT . DS . 'upload' . DS));
        if ($uploaded) {
            $data[$ukey] = $uploaded;
        }
    }
}
