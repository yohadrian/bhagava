<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'm_user';
$primaryKey = 'id_user';
$columns = array(
    array( 'db' => 'id_user', 'dt' =>	 0 ),
    array( 'db' => 'nama',  'dt' => 1 ),
    array( 'db' => 'username',   'dt' => 2 ),
	array( 'db' => 'password',   'dt' => 3 ),
);

$sql_details = array(
    'user' => $setting['db_user'],
    'pass' => $setting['db_pass'],
    'db'   => $setting['db_schema'],
    'host' => $setting['db_server']
);
 

require( 'ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null, null )
);
?>