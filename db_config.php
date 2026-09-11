<?php
/**
 * Bhabha University - Central Database Configuration
 * 
 * Auto-detects Localhost (XAMPP) vs Live Server (cPanel / Production).
 * Dono Frontend aur Admin Panel isi file se database credentials read karenge,
 * jisse live server par sirf is ek file me details daalni hongi aur sab synchronize rahega.
 */

$is_localhost = (
    (isset($_SERVER['HTTP_HOST']) && (
        strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || 
        strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
    )) ||
    (php_sapi_name() === 'cli' && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
);

if ($is_localhost) {
    // =========================================================================
    // 1. LOCALHOST (XAMPP) CREDENTIALS
    // =========================================================================
    $host   = "localhost";
    $dbName = "bhabhaun_mohitdb";
    $user   = "root";
    $pass   = "";
} else {
    // =========================================================================
    // 2. LIVE SERVER (cPanel / Production) CREDENTIALS
    // Jab aap live cPanel par database create karenge, to uski details yahan dalein:
    // =========================================================================
    $host   = "localhost";
    $dbName = "bhabhaun_mohitdb"; // e.g. bhabhfdt_bhabhadb ya aapka live db name
    $user   = "root";            // e.g. bhabhfdt_dbuser
    $pass   = "";                // e.g. Live MySQL password
}
