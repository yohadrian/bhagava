<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

//$noorder=mysql_real_escape_string(trim($_POST['noorder']));
$tglorder=mysql_real_escape_string(trim($_POST['tglorder']));
$customer=mysql_real_escape_string(trim($_POST['m_customer_id']));
//$kodeitem=mysql_real_escape_string(trim($_POST['kodeitem']));
$salesorderheaderid=$_POST['sales_order_header_id'];
$id_act=$_POST['id_act'];
	
//$noorder=htmlspecialchars($noorder);
//$tglorder=htmlspecialchars($tglorder);
$customer=htmlspecialchars($customer);
//$kodeitem=htmlspecialchars($kodeitem);

$file_count=count($_POST["m_product_id"]);
echo $file_count;
if($id_act==="1")
{	$m_produt=$_POST['m_product_id'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$total=$_POST['total'];
	$query="SELECT max(no_order) as maxKode FROM sales_order_header";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];
	$noUrut = (int) substr($kodeBarang, 3, 10);
	$noUrut++;
	$char = "ord";
	$noorder = $char . sprintf("%07s", $noUrut);
	$result=
	mysql_query("INSERT INTO sales_order_header  VALUES ('','$noorder','$tglorder','$customer',now(),'1')")
        or die("Insert Error: ".mysql_error());
	for($i=0; $i<$file_count; $i++){
	
		$result=
		mysql_query("INSERT INTO sales_order_detail  VALUES ('','$noorder','$m_produt[$i]','$qty[$i]','$price[$i]','$total[$i]',now(),1)")
			or die("Insert Error: ".mysql_error());	
		
	}
}

if($id_act==="2"){
$result1=
	mysql_query("DELETE FROM sales_order_header where no_order='$salesorderheaderid'")
        or die("Insert Error: ".mysql_error());
$result2=
	mysql_query("DELETE FROM sales_order_detail where no_order='$salesorderheaderid'")
        or die("Insert Error: ".mysql_error());
		
	$m_produt=$_POST['m_product_id'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$total=$_POST['total'];
	$result=
	mysql_query("INSERT INTO sales_order_header  VALUES ('','$salesorderheaderid','$tglorder','$customer',now(),'1')")
        or die("Insert Error: ".mysql_error());
	for($i=0; $i<$file_count; $i++){
	
	$result=mysql_query("INSERT INTO sales_order_detail  VALUES ('','$salesorderheaderid','$m_produt[$i]','$qty[$i]','$price[$i]','$total[$i]',now(),1)")
			or die("Insert Error: ".mysql_error());	
		
}
}

if($id_act==="3"){
$no_order=$_POST['no_order'];
$result1=
	mysql_query("DELETE FROM sales_order_header where sales_order_header_id='$salesorderheaderid'")
        or die("Insert Error: ".mysql_error());

//for($counter=0; $counter>=count($salesreturndetailid); $counter++){
$result2=
	mysql_query("DELETE FROM sales_order_detail where no_order='$no_order'")
        or die("Insert Error: ".mysql_error());
}

?>