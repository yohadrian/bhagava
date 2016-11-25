<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'v_product';
$primaryKey = 'm_product_id';
$columns = array(
    array( 'db' => 'm_product_id', 'dt' => 0 ),
    array( 'db' => 'm_category_id',  'dt' => 1 ),
	array( 'db' => 'category_name',  'dt' => 2 ),
    array( 'db' => 'm_supplier_id',   'dt' => 3 ),
	array( 'db' => 'supplier_name',  'dt' => 4 ),
	array( 'db' => 'item_code',   'dt' => 5),
    array( 'db' => 'product_name',     'dt' => 6 ),
	array( 'db' => 'img',     'dt' => 7 ),
	array( 'db' => 'stock',     'dt' => 8 ),
	array( 'db' => 'harga_beli',     'dt' => 9 ),
	array( 'db' => 'harga_jual',     'dt' => 10 )
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