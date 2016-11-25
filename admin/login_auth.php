<?php
ob_start();
define('PATH', './');
require_once PATH.'config.php';
require_once PATH.'libs/db_connection.php';
require_once PATH.'libs/login_func.php';

sec_session_start();


$username = $_POST['username'];
$password = $_POST['password'];

if(login($username, $password, $mysqli)) {
    header('location:'.$setting['url_admin'].'home.php');
} else {
	header('location:'.$setting['url_admin'].'?invalid');
}
?>

