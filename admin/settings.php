<?php
define('PATH', './');
$show_menu = true;
$GLOBALS['title'] = 'Customers';
$pagename = basename($_SERVER['PHP_SELF']);

require_once PATH.'libs/header.php';
?>
<script>
	$(document).ready(function(){
		$('#table_view').datatable();
	});
</script>

<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="fa fa-plus btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="insert"></button>
			<button type="button" class="fa fa-pencil btn btn-success btn-lg"  id="edit"></button>
            <button type="button" class="btn btn-danger"id="delete"><i class="fa fa-trash"></i></button>
        </div>
        <h1><i class="fa fa-cog"></i> Settings</h1>
    </div>
</div>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list"></i> Customer List</h3></div>
        <div class="panel-body"style="overflow-x:auto;">
		<table id="table_view" class="table table-striped table-bordered display" cellspacing="0" width="100%" height="auto" ></table>
            <!--<table id="table_view"></table>-->
        </div>
    </div>
</div>


<?php
require_once PATH.'libs/footer.php';
?>