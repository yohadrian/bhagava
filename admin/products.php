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
        "ajax": "data/data_products.php",
		"columnDefs": [
					{
						"targets": [ 0 ],
						"visible": false,
						"searchable": false
					},
					{
						"targets": [ 1 ],
						"visible": false,
						"searchable": false
					},
					{
						"targets": [ 3 ],
						"visible": false,
						"searchable": false
					},
					{
					// The `data` parameter refers to the data for the cell (defined by the
					// `data` option, which defaults to the column being worked with, in
					// this case `data: 0`.
					
					"targets": [7], // column index 
					"sortable":false,
					"searchable": false,
					"width":"70px",
					"render": function ( data, type, row ) {
						return '<img src="'+data+'" width="70px" height="70px" />';
					},
					},
					]
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
		$('#formfield').css('display','block');
		$('#tableshow').css('display','none');
		document.getElementById("id_act").value='1';
        document.getElementById("title_modal").innerHTML="Masukan Data";
		document.getElementById("myForm").reset();
    } );
	
	$('#backbutton').click( function () {
		$('#formfield').css('display','none');
		$('#tableshow').css('display','block');
    } );
	
	$('#edit').click( function () {
			
			var datates= table.row('.selected').data() ;
			var datatesnew=datates.toString().split(",");
			document.getElementById("title_modal").innerHTML="Ubah Data";
			document.getElementById("id_act").value='2';
			document.getElementById("m_product_id").value=datatesnew[0];
			
			document.getElementById("m_category_id").value=datatesnew[1];
			document.getElementById("m_supplier_id").value=datatesnew[3];
				
			document.getElementById("nama_produk").value=datatesnew[6];
			document.getElementById("stock").value=datatesnew[8];
			document.getElementById("harga_beli").value=datatesnew[9];
			document.getElementById("harga_jual").value=datatesnew[10];
			$('#formfield').css('display','block');
			$('#tableshow').css('display','none');
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


	$("#myForm").submit(function(e) {

    var url = "products_process.php"; // the script where you handle the form input.
	var formData=new FormData($(this)[0]);
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
            <button type="button" class="fa fa-plus btn btn-primary btn-lg" id="insert"></button>
			<button type="button" class="fa fa-pencil btn btn-success btn-lg"  id="edit"></button>
            <button type="button" class="btn btn-danger"id="delete"><i class="fa fa-trash"></i></button>
		</div>
		<h1><i class="fa fa-cube"></i> Products</h1>
    </div>
</div>

<!-- Form -->
  <div class="container-fluid" id="formfield" style="display:none">
      <!-- Form content-->
	<h4 id="title_modal" class="modal-title">Data Product</h4>
	  </br>
	  <div class="modal-body">
		  <form class="form-horizontal" id="myForm" enctype="multipart/form-data">
			<input type="hidden" value="" name="id_act" id="id_act">
			<input type="hidden" value="" name="m_product_id" id="m_product_id">
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="itemcode">Kategori Produk:</label>
			  <div class="col-sm-7">
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
			  <div class="col-sm-7">
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
			  <label class="control-label col-sm-2" for="nama_produk">Nama Product:</label>
			  <div class="col-sm-7">
				<input type="text" class="form-control" id="nama_produk" placeholder="Enter Product Name" name="nama_produk" required>
			  </div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="gambar" id="gambar">Image:</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">*kosongkan jika tidak diubah
				</div>
			  </div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="stock">Stock:</label>
			  <div class="col-sm-7">
				<input type="number"  class="form-control" id="stock" placeholder="Enter Stock" name="stock" required min="1">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="hargabeli">Harga Beli:</label>
			  <div class="col-sm-7">
				Rp. <input type="number" class="form-control" required id="harga_beli" placeholder="nominal" name="harga_beli" min="1">
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="hargajual">Harga Jual:</label>
			  <div class="col-sm-7">
				Rp. <input type="number" class="form-control" required id="harga_jual" placeholder="nominal" name="harga_jual" min="1">
			  </div>
			</div>
				<div class="form-group"> 
				  <div class="col-sm-offset-2 col-sm-7">
					<button type="submit" class="btn btn-default">Submit</button>
				  </div>
				</div>
			</form>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="backbutton">Close</button>
        </div>
      
  </div>
	
        
</div>

	
<div class="container-fluid" id="tableshow">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list"></i> Product List</h3></div>
        <div class="panel-body"style="overflow-x:auto;">
		<table id="table_view3" class="table table-striped table-bordered display" cellspacing="0" width="100%" height="auto" >
			<thead>
					<tr>
						<th>Products No</th>
						<th>Kategori Produk No</th>
						<th>Kategori Produk</th>						
						<th>Supplier No</th>
						<th>Supplier Name</th>
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
		</table>;
	
        </div>
    </div>
</div>


<?php
require_once PATH.'libs/footer.php';
?>

