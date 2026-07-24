<?php
include_once("config.php");

unset($_SESSION[LOGIN_STUDENT]);
@session_destroy();
redirect(URL_ADMIN);
exit();
?>