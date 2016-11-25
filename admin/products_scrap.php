<?php
define('PATH', './');
$show_menu = true;
$GLOBALS['title'] = 'Customers';
$pagename = basename($_SERVER['PHP_SELF']);

require_once PATH.'libs/header.php';
?>

<script>	
$(document).ready(function() {
	    
    $('#table_view3').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "data/data_products.php"
    } );
	
	var table = $('#table_view3').DataTable();
	
	$('#table_view3 tbody').on( 'click', 'tr', function() {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');	
        }
		
    } );
	
    $('#insert').click( function () {
		document.getElementById("id_act").value='1';
        document.getElementById("title_modal").innerHTML="Masukan Data";
		document.getElementById("myForm").reset();
		document.getElementById("fileToUpload").style.visibility= "visible";
		document.getElementById("fileToUpload").value= "";
		document.getElementById("gambar").style.visibility= "visible";
    } );
	
	$('#edit').click( function () {
			
			var datates= table.row('.selected').data() ;
			var datatesnew=datates.toString().split(",");
			
			document.getElementById("title_modal").innerHTML="Ubah Data";
			document.getElementById("id_act").value='2';
			document.getElementById("m_product_id").value=datatesnew[0];
			
			document.getElementById("m_category_id").value=datatesnew[1];
			document.getElementById("m_supplier_id").value=datatesnew[2];
			document.getElementById("item_code").value=datatesnew[3];
			document.getElementById("product_name").value=datatesnew[4];
			document.getElementById("stock").value=datatesnew[6];
			document.getElementById("harga_beli").value=datatesnew[7];
			document.getElementById("harga_jual").value=datatesnew[8];
			
			document.getElementById("fileToUpload").style.visibility= "hidden";
			document.getElementById("fileToUpload").value= "";
			document.getElementById("gambar").style.visibility= "hidden";
			$('#editModal').modal('show');
    } );
	
	$('#delete').click( function () {
        var datates= table.row('.selected').data() ;
		var datatesnew=datates.toString().split(",");
		var id=datatesnew[0];
		//alert("'m_customer_id':'"+ id +"','id_act':'3'");
		var del={"m_product_id": id , "id_act": '3'} 
		$.ajax({
                        url: "products_process.php",
                        type: "post",
                        data: del,
                        success: function () {
							window.location = "products.php";
						}
                    });
		
	} );
		

	$(".editForm").submit(function(e) {
    var url = "image_process.php"; // the script where you handle the form input.
	var formData=new FormData($(this)[0]);
	
    $.ajax({
           type: "POST",
           url: url,
		   contentType: false,
		   processData: false,
           data: formData, // serializes the form's elements.
           success: function () {
							location.reload();
						}
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});


	$("#myForm").submit(function(e) {

    var url = "products_process.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           contentType: false,
		   processData: false,
           data: formData, // serializes the form's elements.
           success: function () {
							window.location = 'products.php';
						}
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
} );
</script>
<?php
	$con=mysqli_connect("localhost","root","","bhagavagallery");
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>

<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="fa fa-plus btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="insert"></button>
			<button type="button" class="fa fa-pencil btn btn-success btn-lg"  id="edit"></button>
            <button type="button" class="btn btn-danger"id="delete"><i class="fa fa-trash"></i></button>
        </div>
        <h1><i class="fa fa-cube"></i> Products</h1>
    </div>
</div>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list"></i> Product List</h3></div>
        <div class="panel-body"style="overflow-x:auto;">
		<?php
				if(!empty($_GET['id'])){
				$mproductid=$_GET['id'];
				$sql="SELECT * from m_product where m_product_id=$mproductid";
				$rs=mysqli_query($con,$sql) or die(mysql_error());
				$rowview=mysqli_fetch_array($rs);
				$msupplierid=$rowview['m_supplier_id'];
				$mcategoryid=$rowview['m_category_id'];
				$namaproduct=$rowview['product_name'];
				$stock=$rowview['stock'];
				$hargabeli=$rowview['harga_beli'];
				$hargajual=$rowview['harga_jual'];
				
				//$sqlview	="select img from m_product where m_product_id=$mprocductid";
				//$resview	= mysqli_query($con,$sqlview);
				//$checkview	= mysqli_num_rows($resview);
				//echo'<div class="row">';
				//$result=mysqli_fetch_array($resview);
				
		?>
		<!--
			<div class="col-xs-2" style="padding-top:20px">
				<a class="fancybox-thumbs" data-fancybox-group="thumb"href="<?php //echo $result['url'];?>">
					<img src="<?php //echo $result['url'];?>"height="120px" width="120px">
				</a><br>
			<div class="row">
				<div class="col-xs-offset-3 col-xs-3" style="padding-top:5px">
				<form name="delform" class="delform" action="products_process.php" method="post">
					<input type="hidden" id="id_act" name="id_act" value="2">
					<input type="hidden" name="m_image_id"id="m_image_id" value=" <?php //echo $result['m_image_id'];?>">
					<input type="hidden" name="f_listing"id="f_listing"value="<?php //echo $_GET['num'];?>">
					<input type="hidden" name="m_listing_id"id="m_listing_id"value="<?php //echo $_GET['id'];?>">
					<button type="submit" class="btn btn-danger"id="del">del</button>
				</form>
				</div>
			</div>	
			</div>
			-->
			<?php
			//echo'</div>';?>
			
		<?php
			}
			else{
			echo
		
		'<table id="table_view3" class="table table-striped table-bordered display" cellspacing="0" width="100%" height="auto" >
			<thead>
					<tr>
						<th>Products No</th>
						<th>Kategori Produk No</th>
						<th>Supplier No</th>
						<th>Item Code</th>
						<th>Product Name</th>
						<th>Image</th>
						<th>Stock</th>
						<th>Harga Beli</th>
						<th>Harga Jual</th>
					</tr>
			</thead>
			<tfoot>
			</tfoot>
		</table>';
		}?>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">
  
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 id="title_modal" class="modal-title">Edit Product</h4>
	  </div>
		<div class="modal-body">
		<?php
				if(!empty($_GET['id'])){
				$mproductid=$_GET['id'];
				$sql="SELECT * from m_product where m_product_id=$mproductid";
				$rs=mysqli_query($con,$sql) or die(mysql_error());
				$rowview=mysqli_fetch_array($rs);
				$msupplierid=$rowview['m_supplier_id'];
				$mcategoryid=$rowview['m_category_id'];
				$namaproduct=$rowview['product_name'];
				$stock=$rowview['stock'];
				$hargabeli=$rowview['harga_beli'];
				$hargajual=$rowview['harga_jual'];
				
				//$sqlview	="select img from m_product where m_product_id=$mprocductid";
				//$resview	= mysqli_query($con,$sqlview);
				//$checkview	= mysqli_num_rows($resview);
				
				//$result=mysqli_fetch_array($resview);
				}
		?>
		<div class="modal-body">
		  <form class="form-horizontal" name="editForm" class="editForm" action="products_process.php" method="post" enctype="multipart/form-data">
			<input type="hidden" id="id_act" name="id_act" value="2">
			<input type="hidden" value="" name="id_act" id="id_act">
			<input type="hidden" value="" name="m_product_id" id="m_product_id">
			<div class="row" style="padding-top:30px">
				<div class="col-xs-2">
					Kategori Produk No
				</div>
				<div class="col-xs-10">
					<?php echo $m_category_id;?>
				</div>
			</div>
			<div class="row" style="padding-top:30px">
				<div class="col-xs-2">
					Supplier No
				</div>
				<div class="col-xs-10">
					<?php echo $m_supplier_id;?>
				</div>
			</div>
			<div class="row" style="padding-top:30px">
				<div class="col-xs-2">
					Nama Produk
				</div>
				<div class="col-xs-10">
					<?php echo $namaproduk;?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					Stock
				</div>
				<div class="col-xs-10">
					<?php echo $stock;?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					Harga Beli
				</div>
				<div class="col-xs-10">
					<?php echo $hargabeli;?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					Harga Jual
				</div>
				<div class="col-xs-10">
					<?php echo $hargajual;?>
				</div>
			</div>
			</form>
		  
	  
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div>
	</div>
</div>
<!----------------------------------------------------------Modal End-->


<!-- Modal Add New-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 id="title_modal" class="modal-title">Data Product</h4>
	  </div>
	  <div class="modal-body">
		  <form class="form-horizontal" id="myForm" action="products_process.php" method="post" enctype="multipart/form-data">
			<input type="hidden" value="" name="id_act" id="id_act">
			<input type="hidden" value="" name="m_product_id" id="m_product_id">
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="itemcode">Kategori Produk:</label>
			  <div class="col-sm-10">
					<?php
						$sqlkat	="select m_category_id,category_name from m_category  order by category_name asc ";
						$reskat	= mysqli_query($con,$sqlkat);
						$checkkat	= mysqli_num_rows($reskat);
					?>
						<select class="form-control" id="m_category_id" placeholder="Enter Product " name="m_category_id" required>
								<option value="">Product Category</option>
								<?php
								while($rowkat=mysqli_fetch_array($reskat)){
										?>
									<option value="<?php echo $rowkat['m_category_id']?>"><?php echo $rowkat['category_name']?></option>
									<?php
								}
								?>
							</select>
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="itemcode">Supplier:</label>
			  <div class="col-sm-10">
					<?php
						$sqlsup	="select m_supplier_id,supplier_name from m_supplier order by supplier_name asc ";
						$ressup	= mysqli_query($con,$sqlsup);
						$checksup	= mysqli_num_rows($ressup);
					?>
						<select class="form-control" id="m_supplier_id" placeholder="Enter Supplier " name="m_supplier_id" required>
								<option value="">Supplier Name</option>
								<?php
								while($rowkat=mysqli_fetch_array($ressup)){
									?>
									<option value="<?php echo $rowkat['m_supplier_id']?>"><?php echo $rowkat['supplier_name']?></option>
									<?php
								}
								?>
							</select>
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="itemcode">Item Code:</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" id="itemcode" placeholder="Enter Item Code" name="itemcode" required>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="namaproduk">Nama Product:</label>
			  <div class="col-sm-10">
				<input type="text" class="form-control" id="nama_produk" placeholder="Enter Product Name" name="nama_produk" required>
			  </div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="gambar" id="gambar">Image:</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
				</div>
			  </div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="stock">Stock:</label>
			  <div class="col-sm-10">
				<input type="" class="form-control" id="stock" placeholder="Enter Stock" name="stock" required>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="hargabeli">Harga Beli:</label>
			  <div class="col-sm-10">
				Rp. <input type="" class="form-control" id="harga_beli" placeholder="nominal" name="harga_beli" required>
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="hargajual">Harga Jual:</label>
			  <div class="col-sm-10">
				Rp. <input type="" class="form-control" id="harga_jual" placeholder="nominal" name="harga_jual" required>
			  </div>
			</div>
			<div class="form-group"> 
			  <div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Submit</button>
			  </div>
			</div>
		  </form>
		  
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div>
	
  </div>
</div>
<!----------------------------------------------------------Modal End-->

<?php
require_once PATH.'libs/footer.php';
?>