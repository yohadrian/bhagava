<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

$nama=mysql_real_escape_string(trim($_POST['nama_kategori']));
$parentcategory=$_POST['parent_category'];
$mcategoryid=$_POST['m_category_id'];
$id_act=$_POST['id_act'];
$nama=htmlspecialchars($nama);

if($id_act==="1"){
	$result=
	mysql_query("INSERT INTO m_category  VALUES ('','$nama','$parentcategory','1')")
        or die("Insert Error: ".mysql_error());
}

else if($id_act==="2"){
	$result=
	mysql_query("UPDATE m_category SET m_category_id='$mcategoryid', category_name='$nama', parent_category_id='$parentcategory', status='1' where m_category_id='$mcategoryid'")
        or die("Insert Error: ".mysql_error());	

}

else if($id_act==="3"){
	
	$result=
	mysql_query("DELETE FROM m_category where m_category_id='$mcategoryid'")
        or die("Insert Error: ".mysql_error());	

}
	echo "<script>window.location = 'supplier.php';</script>";
?>