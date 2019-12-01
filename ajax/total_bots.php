<?php

ob_start();

require_once '../@/config.php';

if (!(isset($_SERVER['HTTP_REFERER']))) {
    die();
}


$SQL = $odb -> query("SELECT COUNT(*) FROM `tokens`");
echo $SQL->fetchColumn(0);
