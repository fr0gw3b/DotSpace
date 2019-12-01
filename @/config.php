<?php

if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {exit("NOT ALLOWED");}


define('DB_HOST', 'localhost');

define('DB_NAME', 'dotspace');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', '');

define('ERROR_MESSAGE', 'Oops, we ran into a problem here :(');



try {

$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);

}

catch( PDOException $Exception ) {

    error_log('ERROR: '.$Exception->getMessage().' - '.$_SERVER['REQUEST_URI'].' at '.date('l jS \of F, Y, h:i:s A')."\n", 3, '');

    die(ERROR_MESSAGE);

}



?>

