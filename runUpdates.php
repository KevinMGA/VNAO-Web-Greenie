<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/updateFunctions.php');

$Cron = new Auto();


$Cron->RemoveWOFD();
$Cron->sameDay();
$Cron->newDay();
$Cron->avgGrade();
//$Cron->avgScore();
//$Cron->showGrade();
$Cron->updateTime();

?>