<?php

ob_start();

require_once '../@/config.php';

if (!(isset($_SERVER['HTTP_REFERER']))) {
    die();
}


$SQL = $odb -> query("SELECT COUNT(*) FROM `logs_attack` WHERE `stopped` = 1");
echo $SQL->fetchColumn(0);
