<?php

if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {exit("NOT ALLOWED");}

session_start();
ob_start();

require_once 'config.php';
require_once 'functions.php';

$user = new users;

if($user -> UserIsConnected()){

} else {
    header('Location: login.php');
}
