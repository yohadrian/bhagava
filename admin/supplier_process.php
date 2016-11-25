<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

$nama=mysql_real_escape_string(trim($_POST['namasupplier']));
$msupplierid=$_POST['m_supplier_id'];
$id_act=$_POST['id_act'];
$nama=htmlspecialchars($nama);

if($id_act==="1"){
	$result=
	mysql_query("INSERT INTO m_supplier  VALUES ('','$nama')")
        or die("Insert Error: ".mysql_error());
}

else if($id_act==="2"){
	$result=
	mysql_query("UPDATE m_supplier SET supplier_name='$nama' where m_supplier_id='$msupplierid'")
        or die("Insert Error: ".mysql_error());	

}

else if($id_act==="3"){
	
	$result=
	mysql_query("DELETE FROM m_supplier where m_supplier_id='$msupplierid'")
        or die("Insert Error: ".mysql_error());	

}
	echo "<script>window.location = 'supplier.php';</script>";
?>