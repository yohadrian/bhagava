<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'v_sales_return';
$primaryKey = 'sales_return_header_id';
$columns = array(
    array( 'db' => 'sales_return_header_id', 'dt' => 0 ),
    array( 'db' => 'sales_order_header_id',  'dt' => 1 ),
    array( 'db' => 'no_return',   'dt' => 2 ),
	array( 'db' => 'tgl_return',   'dt' => 3 ),
	array( 'db' => 'customer',   'dt' => 4 ),
	array( 'db' => 'tgl_input',   'dt' => 5 ),
	array( 'db' => 'item_code',   'dt' => 6 ),
	array( 'db' => 'qty',   'dt' => 7 ),
	array( 'db' => 'harga_jual',   'dt' => 8 ),
	array( 'db' => 'total',   'dt' => 9 ),
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