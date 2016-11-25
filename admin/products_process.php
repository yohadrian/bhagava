<?php
mysql_connect("localhost","root","");
mysql_select_db("bhagavagallery");

//$itemcode=mysql_real_escape_string(trim($_POST['itemcode']));
$namaproduk=mysql_real_escape_string(trim($_POST['nama_produk']));
$stock=mysql_real_escape_string(trim($_POST['stock']));
$hargabeli=mysql_real_escape_string(trim($_POST['harga_beli']));
$hargajual=mysql_real_escape_string(trim($_POST['harga_jual']));
$mcategoryid=$_POST['m_category_id'];
$msupplierid=$_POST['m_supplier_id'];
$mproductid=$_POST['m_product_id'];
$id_act=$_POST['id_act'];
//$itemcode=htmlspecialchars($itemcode);
$namaproduk=htmlspecialchars($namaproduk);
$stock=htmlspecialchars($stock);
$hargabeli=htmlspecialchars($hargabeli);
$hargajual=htmlspecialchars($hargajual);

$target_dir = "images/products/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    
	if(!empty($_FILES["fileToUpload"]["tmp_name"]))
	{
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
		
        $uploadOk = 1;
		
    } else {

        $uploadOk = 0;
		
    }
	}
	
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {

    $uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {

    $uploadOk = 0;

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    } else {

    }
}

if($id_act==="1"){
	$query="SELECT max(item_code) as maxKode FROM m_product";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$kodeBarang = $data['maxKode'];
	$noUrut = (int) substr($kodeBarang, 3, 10);
	$noUrut++;
	$char = "itc";
	$itemcode = $char . sprintf("%07s", $noUrut);
	$result=
	mysql_query("INSERT INTO m_product  VALUES ('','$mcategoryid','$msupplierid','$itemcode','$namaproduk','$target_file','$stock','$hargabeli','$hargajual')")
        or die("Insert Error: ".mysql_error());
}

else if($id_act==="2")
{
	if(!empty($_FILES["fileToUpload"]["name"]))
	{
	$result=
	mysql_query("UPDATE m_product SET  m_category_id='$mcategoryid', m_supplier_id='$msupplierid', item_code='tes', product_name='$namaproduk', img='$target_file', stock='$stock', harga_beli='$hargabeli', harga_jual='$hargajual' where m_product_id='$mproductid'")
        or die("Insert Error: ".mysql_error());	
	}
else
	{
	$result=
	mysql_query("UPDATE m_product SET  m_category_id='$mcategoryid', m_supplier_id='$msupplierid', item_code='tes', product_name='$namaproduk',stock='$stock', harga_beli='$hargabeli', harga_jual='$hargajual' where m_product_id='$mproductid'")
        or die("Insert Error: ".mysql_error());	
	}
}

else if($id_act==="3"){
	
	$result=
	mysql_query("DELETE from m_product where m_product_id='$mproductid'")
        or die("Insert Error: ".mysql_error());	


}
	//echo "<script>window.location = 'products.php';</script>";
?>