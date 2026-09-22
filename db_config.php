
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
    // cPanel MySQL Databases me create kiya gaya Database Name, User aur Password:
    // =========================================================================
    $host   = getenv('DB_HOST') ?: "localhost";
    $dbName = getenv('DB_NAME') ?: "bhabhaun_mohitdb"; // Apne Live DB ka naam yahan dalein
    $user   = getenv('DB_USER') ?: "root";             // Apne Live DB User ka naam yahan dalein
    $pass   = getenv('DB_PASS') ?: "";                 // Apne Live DB User ka password yahan dalein
}
