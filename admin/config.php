<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Kolkata');

define("DS", DIRECTORY_SEPARATOR);
define("PATH_ROOT", dirname(__FILE__));
define("PATH_LIB", PATH_ROOT . DS . "library" . DS);

// Initialize Active Web Application Firewall (SQLi, XSS, RFI/LFI protection)
if (file_exists(dirname(PATH_ROOT) . DS . "library" . DS . "waf.php")) {
    require_once(dirname(PATH_ROOT) . DS . "library" . DS . "waf.php");
}

@session_start();
if (!headers_sent()) {
    @header("Permissions-Policy: unload=*");
    @header("X-Frame-Options: SAMEORIGIN");
    @header("X-Content-Type-Options: nosniff");
    @header("X-XSS-Protection: 1; mode=block");
    @header("Referrer-Policy: strict-origin-when-cross-origin");
}

require_once(dirname(PATH_ROOT) . DS . "db_config.php");

if (!defined("URL_ROOT")) {
    if (isset($_SERVER['HTTP_HOST'])) {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? "https://" : "http://";
        $host_name = $_SERVER['HTTP_HOST'];
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
        if (strpos($script, '/admin') !== false) {
            $base_path = preg_replace('/\/admin\/.*$/', '/', $script);
        } else {
            $base_path = preg_replace('/\/[^\/]+\.php.*$/', '/', $script);
        }
        if (substr($base_path, -1) !== '/') {
            $base_path .= '/';
        }
        define("URL_ROOT", $protocol . $host_name . $base_path);
    } else {
        define("URL_ROOT", "https://www.bhabhauniversity.edu.in/");
    }
}

define("URL_ADMIN", URL_ROOT . 'admin/');
define("URL_UPLOAD", URL_ROOT . 'upload/');
define("URL_CSS", URL_ADMIN . 'assets/css/');
define("URL_IMG", URL_ADMIN . 'assets/images/');
define("URL_JS", URL_ADMIN . 'assets/js/');
define("URL_PLUG", URL_ADMIN . 'plugins/');
define("URL_ADMIN_IMG", URL_ADMIN . 'img/');

require_once(PATH_LIB . "MysqliDb.php");
require_once(PATH_LIB . "functions.php");
require_once(PATH_LIB . "validations.php");

try {
    $db = new MysqliDb($host, $user, $pass, $dbName, null, 'utf8mb4');
} catch (\Throwable $e) {
    error_log("Admin DB Connection Error: " . $e->getMessage());
}
if (!function_exists('bu_modsec_decode')) {
    function bu_modsec_decode($item) {
        if (is_array($item)) {
            return array_map('bu_modsec_decode', $item);
        }
        if (is_string($item) && strpos($item, 'B64:') === 0) {
            $decoded = base64_decode(substr($item, 4));
            if ($decoded !== false) {
                return $decoded;
            }
        }
        return $item;
    }
}
if (!empty($_POST)) {
    $_POST = bu_modsec_decode($_POST);
}

define("LOGIN_ADMIN", "");
define("LOGIN_USER", "");
?>
