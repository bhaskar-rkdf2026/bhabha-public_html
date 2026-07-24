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

define("URL_ROOT","https://www.bhabhauniversity.edu.in/");
define("URL_CSS",URL_ROOT.'css/');
define("URL_SVG",URL_ROOT.'svg/');
define("URL_IMG",URL_ROOT.'images/');
define("URL_JS",URL_ROOT.'js/');
define("URL_UPLOAD",URL_ROOT.'upload/');
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