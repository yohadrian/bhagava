<?php
define('PATH', './');
require_once PATH.'config.php';
require_once PATH.'libs/login_func.php';

sec_session_start();

$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name()
          ,'', time() - 42000
          ,$params['path']
          ,$params['domain']
          ,$params['secure']
          ,$params['httponly']);
session_destroy();
header('location:'.$setting['url_admin']);
?>