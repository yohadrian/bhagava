<?php
define('PATH', './');
$show_menu = true;
$GLOBALS['title'] = 'Customers';
$pagename = basename($_SERVER['PHP_SELF']);

require_once PATH.'libs/header.php';
?>
<script>	
$(document).ready(function() {
	    
    $('#table_view5').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "data/data_sales_return_header2.php",
		"columnDefs": [
			{
				"targets": [ 4 ],
				"visible": false,
				"searchable": false
			},]

    } );
	<?php 	
	if(!empty($_GET['id']))
		{?>
			document.getElementById("title_modal").innerHTML="Ubah Data <?php echo $_GET['id'];?>";
			document.getElementById("id_act").value='2';
			document.getElementById("sales_return_header_id").value="<?php echo $_GET['id'];?>";
			<?php
				$sqltab	="select * from sales_return_header where no_return='$_GET[id]'";
				$restab	= mysqli_query(mysqli_connect("localhost","root","","bhagavagallery"),$sqltab);
				$rowtab=mysqli_fetch_array($restab)
			?>
			document.getElementById("sales_order_header_id").value="<?php echo $rowtab['sales_order_header_id'];?>";
			document.getElementById("sales_order_header_id").readOnly = true;
			//tidak ada di sales_order_header
			//document.getElementById("no_order").value="<?php echo $rowtab['no_order'];?>";
			//document.getElementById("no_order").readOnly = true;
			document.getElementById("m_customer_id").value=<?php echo $rowtab['customer'];?>;
			document.getElementById("m_customer_id").readOnly = true;
			
			$('#formfield').css('display','block');
			$('#tableshow').css('display','none');
		/*
    $('#table_view').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {	"type":'POST',
					"url":"data/data_salesorder.php",
		"data": {                       
                noorder: '<?php echo $_GET["id"] ?>', 
				}
		}
    } );*/
	<?php } ?>
		
    var table = $('#table_view5').DataTable();
	
	$('#table_view5 tbody').on( 'click', 'tr', function() {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');	
        }
		
    } );
	
	$("#table_view5 tbody").on('dblclick','td',function(){
		var data = table.row( $(this).parents('tr') ).data();
		var data1=data[1];
		$.ajax({		
                        type: "post",
                        data: data1,
						success: function () {
						window.location = "salesreturn.php?id="+data1;
						}
                    });
    });
	
	$('#insert').click( function () {
		$('#formfield').css('display','block');
		$('#tableshow').css('display','none');
		document.getElementById("id_act").value='1';
        document.getElementById("title_modal").innerHTML="Masukan Data";
		document.getElementById("myForm").reset();
    } );
	
	$('#backbutton').click( function () {
		<?php 
			if(!empty($_GET['id']))
			{?>
		window.location = "salesreturn.php";
		<?php }
			else{
		?>
		$('#formfield').css('display','none');
		$('#tableshow').css('display','block');
			<?php } ?>
    } );
	
	$('#edit').click( function () {
			
			var datates= table.row('.selected').data() ;
			var datatesnew=datates.toString().split(",");
			
			$.ajax({		
                        type: "GET",
                        data: datatesnew[1],
						success: function () {
										window.location = "salesreturn.php?id="+datatesnew[1]+"&sales_return_header_id="+datatesnew[0];
						}
                    });
			
    } );
	
	$('#delete').click( function () {
        var datates= table.row('.selected').data() ;
		var datatesnew=datates.toString().split(",");
		var id=datatesnew[0];
		var no_return=datatesnew[1];
		//alert("'m_customer_id':'"+ id +"','id_act':'3'");
		var del={"sales_return_header_id": id , "id_act": '3',"no_return":no_return} 
		$.ajax({
                        url: "salesreturn_process.php",
                        type: "post",
                        data: del,
                        success: function () {
							window.location = "salesreturn.php";
						}
                    });
		
	} );
} );

	function getValue(val,tableID,rowInd)
		{	
		/*	
			var table = document.getElementById(tableID);
			var tr=table.getElementsByTagName('tr')[rowInd.rowIndex];
			var td=tr.getElementsByTagName('td')[2];
			var input=td.getElementsByTagName('input')[0];
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  input.value=
				  this.responseText;
				}
			 };
			xhttp.open("GET", "priceproduct.php?id=" +val, true);
			xhttp.send();
		*/
			var table = document.getElementById(tableID);
			var tr=table.getElementsByTagName('tr')[rowInd.rowIndex];
			var td=tr.getElementsByTagName('td')[2];//qty
			var input=td.getElementsByTagName('input')[0];
			var td1=tr.getElementsByTagName('td')[3];//total
			var input1=td1.getElementsByTagName('input')[0];
			var td2=tr.getElementsByTagName('td')[1];//harga
			var input2=td2.getElementsByTagName('input')[0];

			if(val !== "")
			{
			
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  input.value=
				  this.responseText;
				  input1.value=input2.value*input.value;
				}
			 };
			xhttp.open("GET", "priceproduct.php?id=" +val, true);
			xhttp.send();
			}
			else{
				input.value=0;
				input1.value=0;
			}
		}
		
		function total(qty,tableID,rowInd)
		{
			var table = document.getElementById(tableID);
			var tr=table.getElementsByTagName('tr')[rowInd.rowIndex];
			var td=tr.getElementsByTagName('td')[2];
			var harga=td.getElementsByTagName('input')[0].value;
			var td=tr.getElementsByTagName('td')[3];
			var tot=td.getElementsByTagName('input')[0].value=qty*harga;
			
		}
		function addRow(tableID) {
				var table = document.getElementById(tableID);
				var rowCount = table.rows.length;
				var row = table.insertRow(rowCount);
				var colCount = table.rows[0].cells.length;
				for(var i=0; i <colCount; i++) {
					var newcell = row.insertCell(i);
					newcell.innerHTML = document.getElementById("new_data_detail_insert").cells[i].innerHTML;
					}
			}
			function del(tableID,rowInd)
			{
				var table = document.getElementById(tableID);
				var tr=table.getElementsByTagName('tr')[rowInd.rowIndex];
				var td=tr.getElementsByTagName('td')[2];
				var rowCount = table.rows.length;
				if(rowCount!='2')
					table.deleteRow(rowInd.rowIndex);
				
			}
	
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
			<h1><i class="fa fa-truck"></i> Sales Return</h1>
    </div>
</div>	
<!-- Form -->
  <div class="container-fluid" id="formfield" style="display:none">
      <!-- Form content-->
        	<h4 id="title_modal" class="modal-title">Masukan Data </h4>
	  </br>
	  <div class="modal-body">
		  <form class="form-horizontal" id="myForm" action="salesreturn_process.php" method="post">
			<input type="hidden" value="" name="sales_return_header_id" id="sales_return_header_id">
			<input type="hidden" value="" name="id_act" id="id_act">
			<div class="form-group">
			  <label class="control-label col-sm-2" for="noreturn">Sales Order ID:</label>
			  <div class="col-sm-10">
				<?php
						$sqlsal	="select sales_order_header_id from sales_order_header order by sales_order_header_id asc ";
						$ressal	= mysqli_query($con,$sqlsal);
						$checksal	= mysqli_num_rows($ressal);
					?>
					<select class="form-control" id="sales_order_header_id" placeholder="Enter Product " name="sales_order_header_id" required>
								<option value="">Sales Order ID:</option>
								<?php
								while($rowsal=mysqli_fetch_array($ressal)){
									?>
									<option value="<?php echo $rowsal['sales_order_header_id']?>"><?php echo $rowsal['sales_order_header_id']?></option>
									<?php
								}
								?>
							</select>
				<!--<input type="text" class="form-control" required id="noreturn" placeholder="No Return" name="noreturn">-->
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="noreturn">No Order:</label>
			  <div class="col-sm-10">
				<?php
						$sqlsal	="select sales_order_header_id, no_order from sales_order_header order by sales_order_header_id asc ";
						$ressal	= mysqli_query($con,$sqlsal);
						$checksal	= mysqli_num_rows($ressal);
					?>
					<select class="form-control" id="no_order" placeholder="no order" name="no_order" required>
					<!--<select class="form-control" id="sales_order_header_id" placeholder="Enter Product " name="sales_order_header_id" required>-->
								<option value="">No Order:</option>
								<?php
								while($rowsal=mysqli_fetch_array($ressal)){
									?>
									<option value="<?php echo $rowsal['sales_order_header_id']?>"><?php echo $rowsal['no_order']?></option>
									<?php
								}
								?>
							</select>
				<!--<input type="text" class="form-control" required id="noreturn" placeholder="No Return" name="noreturn">-->
			  </div>
			</div>
			<div class="form-group">
			  <label class="control-label col-sm-2" for="tglreturn">Tgl Return:</label>
			  <div class="col-sm-10"> 
				<input type="date" class="form-control" required id="tglreturn" placeholder="Tgl Return" name="tglreturn">
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="control-label col-sm-2" for="no_customer">Customer</label>
			  <div class="col-sm-10"> 
			  <?php
						$sqlsal	="select m_customer_id,nama from m_customer order by m_customer_id asc ";
						$ressal	= mysqli_query($con,$sqlsal);
						$checksal	= mysqli_num_rows($ressal);
					?>
					<select class="form-control" id="no_customer" placeholder="Enter Nama Customer" name="no_customer" required>
								<option value="">Nama Customer</option>
								<?php
								while($rowsal=mysqli_fetch_array($ressal)){
									?>
									<option value="<?php echo $rowsal['m_customer_id']?>"><?php echo $rowsal['nama']?></option>
									<?php
								}
								?>
							</select>
				<!--<input type="text" class="form-control" required id="customer" placeholder="Customer Name" name="customer">-->
			  </div>
			</div>
				

			<!-- Input Detail-->
			<p> 
		  <button type="button" value="Add Item" onClick="addRow('dataTable')" class="fa fa-plus btn btn-primary btn-lg" ></button> 
		  
		  <p>(All acions apply only to entries with check marked check boxes only.)</p>
		</p>
		
		<table id="dataTable" class="table table-bordered" border="1">
		<thead>
			<tr>
				<th>Item</th>
				<th>Quantity</th>
				<th>Harga</th>
				<th>Total</th>
				<th>Delete</th>
			</tr>
		</thead>
		 <tbody>

		 <?php
		 if(!empty($_GET['id'])){
		  		$sqltab	="select * from v_sales_return_detail where no_return='ret0000003'";
				$restab	= mysqli_query($con,$sqltab);
				while($rowtab=mysqli_fetch_array($restab))
				{
		  ?>
		  <!--Edit data sales return-->
				<tr>
					<td>
							<?php
					
					//nama customer->product
							$sqlcust	="select m_product_id,product_name,harga_jual from m_product order by product_name asc ";
							$rescust	= mysqli_query($con,$sqlcust);
							?>
							<select class="form-control"id="m_product_id[]" placeholder="Enter Product"name="m_product_id[]" required style="width:100%" onchange="getValue(this.value,'dataTable',this.parentElement.parentElement)" >
									<option value="">Pilih Product</option>
									<?php
									while($rowcust=mysqli_fetch_array($rescust)){
										?>
										<option <?php if ($rowtab['product_name']==$rowcust['product_name']) echo " selected "; ?>value="<?php echo $rowcust['m_product_id'];?>"><?php echo $rowcust['product_name']?></option>
										<?php
									}
									?>
								</select>

					</td>
					<td>
						<input type="number" value="<?php echo $rowtab['qty']?>"class="form-control"name="qty[]" id='qty[]'style="width:100%"min="1" onchange="total(this.value,'dataTable',this.parentElement.parentElement)"required>
						
					</td>
					<td>
						
						<input type="text" value="<?php echo $rowtab['harga_jual']?>"class="form-control"  name="price[]" id="price[]" style="width:100%" readonly required>
					</td>
					<td>
						<input type="text" value="<?php echo $rowtab['total']?>"class="form-control" name="total[]" id="total[]" style="width:100%" readonly required>
					</td>
					<td >
						<button type="button" class="btn btn-danger" onclick="del('dataTable',this.parentElement.parentElement)"><i class="fa fa-trash"></i></button>
					</td>
		
				</tr>
				<?php 
				}
			}?>
		  	<!--insert data sales order-->	 
		 <tr id="new_data_detail_insert">
			<p>
			<td >
					<?php
						//nama customer->product
						$sqlcust	="select m_product_id,product_name,stock,harga_jual from m_product order by product_name asc ";
						$rescust	= mysqli_query($con,$sqlcust);
					?>
						<select class="form-control"id="m_product_id[]" placeholder="Enter Product"name="m_product_id[]" required style="width:100%" onchange="getValue(this.value,'dataTable',this.parentElement.parentElement)">
							<option value="">Pilih Product</option>
								<?php
									while($rowcust=mysqli_fetch_array($rescust)){
								?>
							<option value="<?php echo $rowcust['m_product_id']?>"><?php echo $rowcust['product_name']?></option>
								<?php
									}
								?>
						</select>

			<td>
				<input type="number" class="form-control"name="qty[]" value="0" id='qty[]'style="width:100%"min="1" onchange="total(this.value,'dataTable',this.parentElement.parentElement)"required>
			</td>
			<td>
				<input type="number" class="form-control"name="price[]" id='price[]'style="width:100%"min="1" readonly required value="0">
			</td>
			
			<td>
				<input type="text" class="form-control" name="total[]" id="total[]" style="width:100%" readonly required value="0">
			</td>
			<td>
				<button type="button" class="btn btn-danger" onclick="del('dataTable',this.parentElement.parentElement)"><i class="fa fa-trash"></i></button>
			</td>
			</p>
		  </tr>
		 </tbody>
		</table>
			<!-- end-->
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
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list"></i> return List</h3></div>
        <div class="panel-body"style="overflow-x:auto;">
		
		<table id="table_view5" class="table table-striped table-bordered display" cellspacing="0" width="100%" height="auto" >
			<thead>
					<tr>
						<th>No_Return</th>
						<th>Sales Order Header Id</th>
						<th>M Customer Id</th>
						<th>No Customer</th>
						<th>Nama</th>
						<th>Status</th>
					</tr>
			</thead>
			<tfoot>
			</tfoot>
		</table>
        </div>
    </div>
</div>


<?php
require_once PATH.'libs/footer.php';
?>
