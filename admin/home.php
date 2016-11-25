<?php
define('PATH', './');
$show_menu = true;
$GLOBALS['title'] = 'Home';
$pagename = basename($_SERVER['PHP_SELF']);
require_once PATH.'libs/header.php';

?>

<div class="page-header">
    <div class="container-fluid"><h1><i class="fa fa-dashboard"></i> Dashboard</h1></div>
</div>
<div class="container-fluid">
    <!-- row pertama adalah dashboard tile-->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="tile">
                <div class="tile-heading">Total Selling / Unit</div>
                <div class="tile-body"><i class="fa fa-shopping-cart"></i><h2 class="pull-right">25</h2></div>
                <div class="tile-footer"><a href="#">View More...</a></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="tile">
                <div class="tile-heading">Total Listing</div>
                <div class="tile-body"><i class="fa fa-home"></i><h2 class="pull-right">100</h2></div>
                <div class="tile-footer"><a href="#">View More...</a></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="tile">
                <div class="tile-heading">Total Agency</div>
                <div class="tile-body"><i class="fa fa-group"></i><h2 class="pull-right">50</h2></div>
                <div class="tile-footer"><a href="#">View More...</a></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="tile">
                <div class="tile-heading">Total Customers</div>
                <div class="tile-body"><i class="fa fa-user"></i><h2 class="pull-right">22</h2></div>
                <div class="tile-footer"><a href="#">View More...</a></div>
            </div>
        </div>
    </div>
</div>


<?php
require_once PATH.'libs/footer.php';
?>