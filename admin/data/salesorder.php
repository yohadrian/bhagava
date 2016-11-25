<?php 
		define('PATH', './');
		require_once PATH.'libs/db_connection.php';
		$return_arr=array();
		$SQL = "SELECT *
				FROM sales_order_header
				INNER JOIN sales_order_detail
				ON sales_order_header.sales_order_header_id=sales_order.sales_order_header_id
				where sales_order_header.sales_order_header_id=sales_order_detail.sales_order_header_id
				"; 
		$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error()); 

		$i=0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			
			$row_array[0] = $row['sales_order_header_id'];
			$row_array[1] = $row['tgl_order'];
			$row_array[2] = $row['customer'];
			$row_array[3] = $row['tgl_input'];
			$row_array[4] = $row['item_code'];
			$row_array[5] = $row['qty'];
			$row_array[6] = $row['harga_jual'];
			$row_array[7] = $row['total'];
			array_push($return_arr,$row_array);

		}
		echo json_encode($return_arr);			
	?>