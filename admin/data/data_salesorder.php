<?php
define('PATH', '../');
require_once PATH."config.php";
$where="no_order='".$_POST['noorder']."'";
$table = 'v_sales_order';
$primaryKey = 'sales_order_detail_id';
$columns = array(
    array( 'db' => 'sales_order_detail_id', 'dt' => 0 ),
    array( 'db' => 'no_order', 'dt' => 1 ),
	array( 'db' => 'product_name',  'dt' => 2 ),
    array( 'db' => 'qty',   'dt' => 3 ),
	array( 'db' => 'harga_jual',   'dt' => 4 ),
	array( 'db' => 'total',   'dt' => 5 ),
	
);

$sql_details = array(
    'user' => $setting['db_user'],
    'pass' => $setting['db_pass'],
    'db'   => $setting['db_schema'],
    'host' => $setting['db_server']
);
 

require( 'ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null, $where )
);
?>