<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'v_sales_order_header';
$primaryKey = 'sales_order_header_id';
$columns = array(
    array( 'db' => 'sales_order_header_id', 'dt' => 0 ),
    array( 'db' => 'no_order',  'dt' => 1 ),
    array( 'db' => 'tgl_order',   'dt' => 2 ),
	array( 'db' => 'nama',   'dt' => 3 ),
	array( 'db' => 'customer',   'dt' => 4 ),
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