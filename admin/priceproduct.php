<?php
		$con=mysqli_connect("localhost","root","","bhagavagallery");
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$m_product_id=$_GET['id'];
		
		$sqlcust	="select harga_jual from m_product where m_product_id=$m_product_id order by product_name asc ";
		$rescust	= mysqli_query($con,$sqlcust);
		$rowview=mysqli_fetch_array($rescust);
		echo $rowview['harga_jual'];
	?>