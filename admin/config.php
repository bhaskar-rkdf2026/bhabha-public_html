<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Kolkata');
@session_start();
define("DS",DIRECTORY_SEPARATOR);
define("PATH_ROOT",dirname(__FILE__));
define("PATH_LIB",PATH_ROOT.DS."library".DS);

$dbName ="bhabhaun_mohitdb";
$user = "root";
$pass = "";
$host = "localhost";

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

define("URL_ADMIN",URL_ROOT.'admin/');
define("URL_CSS",URL_ADMIN.'assets/css/');
define("URL_IMG",URL_ADMIN.'assets/images/');
define("URL_JS",URL_ADMIN.'assets/js/');
define("URL_PLUG",URL_ADMIN.'plugins/');
define("URL_ADMIN_IMG",URL_ADMIN.'img/');

require_once(PATH_LIB."MysqliDb.php");
require_once(PATH_LIB."functions.php");
require_once(PATH_LIB."validations.php");

$db = new MysqliDb($host,$user,$pass,$dbName);
define("LOGIN_ADMIN","");
define("LOGIN_USER","");
