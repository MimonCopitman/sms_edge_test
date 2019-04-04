<?php
include_once 'App/DB.php';
include_once 'App/Log.php';
include_once 'App/Country.php';
include_once 'App/User.php';
$logClass = New Log();
$countryClass = New Country();
$userClass = New User();

if (isset($_GET['from']) && $_GET['from'] && isset($_GET['to']) && $_GET['to']) {
    $cnt_id = isset($_GET['cnt_id']) && is_numeric($_GET['cnt_id']) ? $_GET['cnt_id'] : null;
    $usr_id = isset($_GET['usr_id']) && is_numeric($_GET['usr_id']) ? $_GET['usr_id'] : null;
    $logs = $logClass->getLogsByDate($_GET['from'], $_GET['to'], $cnt_id, $usr_id);
}