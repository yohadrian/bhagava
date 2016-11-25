<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

$name=mysql_real_escape_string(trim($_POST['nama']));
$username=mysql_real_escape_string(trim($_POST['username']));
$pass=mysql_real_escape_string(trim($_POST['password']));
$id_act=$_POST['id_act'];
$iduser=$_POST['id_user'];
$nama=htmlspecialchars($name);
$username=htmlspecialchars($username);
$pass =hash('sha512', $pass);
if($id_act==="1"){
	$result=
	mysql_query("INSERT INTO m_user  VALUES ('','1','$nama','$username','$pass','1','1','1',now())")
        or die("Insert Error: ".mysql_error());
}
if($id_act==="2"){
	$result=
	mysql_query("UPDATE m_user set id_user='$iduser', id_groupuser='1', nama='$nama', username='$username', password='$pass', salt='1', is_admin='1', active='1' where id_user = '$iduser'")
        or die("Insert Error: ".mysql_error());
}
if($id_act==="3"){
	$result=
	mysql_query("DELETE FROM `m_user` WHERE id_user = '$iduser'")
        or die("Insert Error: ".mysql_error());
}

	echo "<script>window.location = 'users.php';</script>";
?>