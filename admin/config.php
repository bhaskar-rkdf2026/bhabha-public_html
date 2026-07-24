<?php
date_default_timezone_set('Asia/Kolkata');
@session_start();
define("DS",DIRECTORY_SEPARATOR);
define("PATH_ROOT",dirname(__FILE__));
define("PATH_LIB",PATH_ROOT.DS."library".DS);

$dbName ="bhabhaun_mohitdb";
$user = "bhabhaun_mohit";
$pass = "mohit7827#$";
$host = "localhost";

define("URL_ROOT","https://www.bhabhauniversity.edu.in/");

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
