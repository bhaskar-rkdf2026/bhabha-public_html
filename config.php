<?php
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
define("URL_CSS",URL_ROOT.'css/');
define("URL_SVG",URL_ROOT.'svg/');
define("URL_IMG",URL_ROOT.'images/');
define("URL_JS",URL_ROOT.'js/');
if (isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) && !file_exists(PATH_ROOT.DS.'upload'.DS.'media')) {
    define("URL_UPLOAD", "https://www.bhabhauniversity.edu.in/upload/");
} else {
    define("URL_UPLOAD", URL_ROOT.'upload/');
}
define("URL_ADMIN_IMG",URL_ROOT.'img/');

require_once(PATH_LIB."MysqliDb.php");
require_once(PATH_LIB."functions.php");
require_once(PATH_LIB."validations.php");
require_once(PATH_LIB."class.mailer.php");

$db = new MysqliDb($host,$user,$pass,$dbName);
$aryFormTemp=$db->get("settings");
if(!is_null($aryFormTemp) && is_array($aryFormTemp) && count($aryFormTemp)>0)
{
	foreach($aryFormTemp as $iFormTemp)
	{
		$aryForm[$iFormTemp['field']]=$iFormTemp['value'];
	}
}
?>