<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'v_sales_return_header';
$primaryKey = 'sales_return_header_id';
$columns = array(
    array( 'db' => 'no_return', 'dt' => 0 ),
	array( 'db' => 'sales_order_header_id',   'dt' => 1 ),
	array( 'db' => 'm_customer_id',   'dt' => 2 ),
	array( 'db' => 'no_customer',   'dt' => 3 ),
	array( 'db' => 'nama',   'dt' => 4 ),
	array( 'db' => 'status',   'dt' => 5 ),
	
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