<?php
include_once("config.php");

if (isset($_SESSION[LOGIN_ADMIN])) {
    unset($_SESSION[LOGIN_ADMIN]);
}
$_SESSION = array();
if (session_status() === PHP_SESSION_ACTIVE) {
    @session_unset();
    @session_destroy();
}
redirect(URL_ADMIN . "index.php");
exit();
?>