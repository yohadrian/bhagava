<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

$nama=mysql_real_escape_string(trim($_POST['nama']));
$email=mysql_real_escape_string(trim($_POST['email']));
$tel=mysql_real_escape_string(trim($_POST['tel']));
//$nocustomer=mysql_real_escape_string(trim($_POST['nocustomer']));
$mcustomerid=$_POST['m_customer_id'];
$id_act=$_POST['id_act'];

$nama=htmlspecialchars($nama);
$email=htmlspecialchars($email);
$tel=htmlspecialchars($tel);

if($id_act==="1"){
	//echo $id_act;
	$query="SELECT max(no_customer) as maxKode FROM m_customer";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];
	$noUrut = (int) substr($kodeBarang, 3, 10);
	$noUrut++;
	$char = "cst";
	$newID = $char . sprintf("%07s", $noUrut);
	$result=
	mysql_query("INSERT INTO m_customer  VALUES ('','$newID','$nama','$email','$tel','1',now())")
        or die("Insert Error: ".mysql_error());
}
else if($id_act==="2"){
	$result=
	mysql_query("UPDATE m_customer SET nama='$nama', email='$email', phone='$tel', status='1', tgl_input=now() where m_customer_id='$mcustomerid'")
        or die("Insert Error: ".mysql_error());	
}

else if($id_act==="3"){
	$result=
	mysql_query("DELETE from m_customer where m_customer_id='$mcustomerid'")
        or die("Insert Error: ".mysql_error());	
}	
?>