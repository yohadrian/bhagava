<?php
define('PATH', './');
$show_menu = true;
$GLOBALS['title'] = 'Supplier';
$pagename = basename($_SERVER['PHP_SELF']);

require_once PATH.'libs/header.php';
?>
<script>	
$(document).ready(function() {
	    
    $('#table_view7').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "data/data_supplier.php"
    } );
	
    var table = $('#table_view7').DataTable();
	
	$('#table_view7 tbody').on( 'click', 'tr', function() {
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
			document.getElementById("m_supplier_id").value=datatesnew[0];
			document.getElementById("namasupplier").value=datatesnew[1];
			
			$('#formfield').css('display','block');
			$('#tableshow').css('display','none');
    } );
	
	$('#delete').click( function () {
        var datates= table.row('.selected').data() ;
		var datatesnew=datates.toString().split(",");
		var id=datatesnew[0];
		var del={"m_supplier_id": id , "id_act": '3'} 
		$.ajax({
                        url: "supplier_process.php",
                        type: "post",
                        data: del,
                        success: function () {
							window.location = "supplier.php";
						}
                    });
		
	} );
	
	$("#myForm").submit(function(e) {

    var url = "supplier_process.php"; // the script where you handle the form input.
	var formData=new FormData($(this)[0]);
	
    $.ajax({
           type: "POST",
           url: url,
		   contentType: false,
		   processData: false,
           data: formData, // serializes the form's elements.
           success: function () {
							window.location = "supplier.php";
						}
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
} );
</script>

<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="fa fa-plus btn btn-primary btn-lg" id="insert"></button>
			<button type="button" class="fa fa-pencil btn btn-success btn-lg"  id="edit"></button>
			<button type="button" class="btn btn-danger"id="delete"><i class="fa fa-trash"></i></button>
		</div>
        <h1><i class="fa fa-building-o"></i> Supplier</h1>
    </div>
</div>

<!-- Form -->
  <div class="container-fluid" id="formfield" style="display:none">
      <!-- Form content-->
     <h4 id="title_modal" class="modal-title">Masukan Data </h4>
        </br>
        <div class="modal-body">
			<form class="form-horizontal" id="myForm">
			  <input type="hidden" value="" name="id_act" id="id_act">
			  <input type="hidden" value="" name="m_supplier_id" id="m_supplier_id">
				<div class="form-group">
					<label class="control-label col-sm-2" for="namasupplier">Nama Kategori:</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="namasupplier" placeholder="Enter Supplier Name" name="namasupplier"required>
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
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list"></i> Customer List</h3></div>
        <div class="panel-body"style="overflow-x:auto;">
		<table id="table_view7" class="table table-striped table-bordered display" cellspacing="0" width="100%" height="auto" >
            <!--<table id="example"></table>-->
			<thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Nama Supplier</th>
                </tr>
            </thead>
		</table>
        </div>
    </div>
</div>


<?php
require_once PATH.'libs/footer.php';
?>