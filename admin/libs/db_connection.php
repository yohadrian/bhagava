<?php
$mysqli=new mysqli($setting['db_server'],$setting['db_user'],$setting['db_pass'],$setting['db_schema'],$setting['db_port']);
if ($mysqli->connect_errno){
    header('location: '.PATH.'error.php?err= Failed to Connect Mysql ('.$mysqli->connect_errno.') '.$mysqli->connect_error );
}
?>