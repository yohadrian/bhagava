<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

$salesorderheaderid=mysql_real_escape_string(trim($_POST['sales_order_header_id']));
$tglreturn=mysql_real_escape_string(trim($_POST['tglreturn']));
$no_customer=mysql_real_escape_string(trim($_POST['no_customer']));
//$noreturn=mysql_real_escape_string(trim($_POST['noreturn']));
//$kodeitem=mysql_real_escape_string(trim($_POST['kodeitem']));
//$qty=mysql_real_escape_string(trim($_POST['qty']));
//$hargajual=mysql_real_escape_string(trim($_POST['hargajual']));
//$total=mysql_real_escape_string(trim($_POST['total']));
$id_act=$_POST['id_act'];
$salesreturnheaderid=$_POST['sales_return_header_id'];
//$salesreturndetailid=$_POST['sales_return_detail_id'];
//$salesorderheaderid=$_POST['sales_order_header_id'];
$m_produt=$_POST['m_product_id'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$total=$_POST['total'];

$file_count=count($_POST["m_product_id"]);
if($id_act==="1")
{	
	$query="SELECT max(no_return) as maxKode FROM sales_return_header";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];
	$noUrut = (int) substr($kodeBarang, 3, 10);
	$noUrut++;
	$char = "ret";
	$noreturn = $char . sprintf("%07s", $noUrut);
	$result=
	mysql_query("INSERT INTO sales_return_header VALUES ('','$noreturn','$salesorderheaderid','$no_customer','$tglreturn',now(),'1')")
        or die("Insert Error: ".mysql_error());

	for($i=0; $i<$file_count; $i++){
	$result=
	mysql_query("INSERT INTO sales_return_detail  VALUES ('','$noreturn','$m_produt[$i]','$qty[$i]','$price[$i]','$total[$i]',now(),1)")
        or die("Insert Error: ".mysql_error());	
	}
}

//edit ---> delete record yang sudah ada baru insert
if($id_act==="2"){
$result1=
	mysql_query("DELETE FROM sales_return_header where no_return='$salesreturnheaderid'")
        or die("Insert Error: ".mysql_error());
$result2=
	mysql_query("DELETE FROM sales_return_detail where no_return='$salesreturnheaderid'")
        or die("Insert Error: ".mysql_error());
		
	$m_produt=$_POST['m_product_id'];
	$qty=$_POST['qty'];
	$price=$_POST['price'];
	$total=$_POST['total'];
	$result=
	mysql_query("INSERT INTO sales_return_header VALUES ('','$noreturn','$salesrorderheaderid','$no_customer','$tglreturn',now(),'1')")
        or die("Insert Error: ".mysql_error());

	for($i=0; $i<$file_count; $i++){
	$result=
	mysql_query("INSERT INTO sales_return_detail  VALUES ('','$noreturn','$m_produt[$i]','$qty[$i]','$price[$i]','$total[$i]',now(),1)")
        or die("Insert Error: ".mysql_error());	
	}
}

if($id_act==="3"){
$no_return=$_POST['no_return'];
//echo "<script>javascript: alert('$salesreturnheaderid')></script>";
$result1=
	mysql_query("DELETE FROM sales_return_header where sales_return_header_id='$salesreturnheaderid'")
        or die("Insert Error: ".mysql_error());


$result2=
	mysql_query("DELETE FROM sales_return_detail where no_return='$no_return'")
        or die("Insert Error: ".mysql_error());
}

?>