<?php
define('PATH', '../');
require_once PATH."config.php";

$table = 'm_category';
$primaryKey = 'm_category_id';
$columns = array(
    array( 'db' => 'm_category_id', 'dt' => 0 ),
    array( 'db' => 'category_name',  'dt' => 1 ),
    array( 'db' => 'parent_category_id',   'dt' => 2 ),
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