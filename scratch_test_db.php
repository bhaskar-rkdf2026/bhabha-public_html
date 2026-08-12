<?php
require_once('config.php');
$events = $db->get('events', 5);
print_r($events);
