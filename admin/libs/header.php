<?php
ob_start();

require_once PATH.'config.php';
require_once PATH.'libs/db_connection.php';
require_once PATH.'libs/login_func.php';

sec_session_start();
if(!login_check($mysqli)){
    header('location:'.$setting['url_admin']);
}

//ambil username dari session tampung ke variable user.
$username = $_SESSION['bhagavagallery_username'];
?>

<!DOCTYPE HTML>
<html>
    <head>
    <title><?php echo $setting['app_name']; ?></title>
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" />
	
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet" />
	
	<link rel="icon" href="<?php echo PATH; ?>images/favicon.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo PATH; ?>vendor/bootstrap/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo PATH; ?>vendor/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo PATH; ?>css/style.css" type="text/css" />
    <script type="text/javascript" src="<?php echo PATH;?>vendor/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH;?>vendor/bootstrap/js/bootstrap.min.js"></script>
	
	<!--library data table js-->
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script>
        $(function() {
            $("#button-menu").click(function() {
                var lebar_menu = $("#column-left").css("width");
                if (lebar_menu == "235px") {
					localStorage.setItem('menu_aktif', 'tutup');
                    $("#column-left").removeClass("active");
                } else {
					localStorage.setItem('menu_aktif', 'buka');
                    $("#column-left").addClass("active");    
                }
            });
        });
		
    </script>
    </head>
    <body>
        <div id="container">
            <!--bagian header-->
            <header id="header" class="navbar navbar-static-top">
                <!--menu dan logo-->
                <div class="navbar-header">
                    <a type="button" id="button-menu" class="pull-left"><i class="fa fa-bars fa-lg"></i></a>
                    <a href="#" class="navbar-brand"><img src="<?php echo PATH;?>images/logo_jalurdata.png" style="height: 25px;"></a>
                </div>
                
                <!--button pojok kanan-->
                <ul class="nav pull-right">
                    <li><a href="logout.php"><span class="hidden-xs hidden-sm hidden-md" onclick='logoutck();'>Logout </span><i class="fa fa-sign-out fa-2x"></i></a></li>
                </ul>
            </header>
            
            <!--bagian menu utama disisi samping-->
            <nav id="column-left" class="active">
                <!--profile logo dan nama user-->
                <div id="profile">
                    <div><i class="fa fa-user fa-2x"></i></div>
                    <div><h4><?php echo $username;?></h4><small>Administrator</small></div>
                </div>
                
                <!--menu utama-->
                <ul id="menu">
                    <li id="menu-dashboard"><a href="<?php echo PATH;?>home.php"><i class="fa fa-dashboard fw"></i><span>Dashboard</span></a></li>
                    <li id="menu-customer"><a href="<?php echo PATH; ?>customers.php"><i class="fa fa-users fw"></i><span>Customers</span></a></li>
					<li id="menu-supplier"><a href="<?php echo PATH; ?>supplier.php"><i class="fa fa-building-o fw"></i><span>Supplier</span></a></li>
					<li id="menu-category"><a href="<?php echo PATH; ?>categories.php"><i class="fa fa-clone fw"></i><span>Product Categories</span></a></li>
                    <li id="menu-product"><a href="<?php echo PATH; ?>products.php"><i class="fa fa-cube fw"></i><span>Products</span></a></li>
                    <li id="menu-salesorder"><a href="<?php echo PATH; ?>salesorder.php"><i class="fa fa-truck fw"></i><span>Sales Order</span></a></li>
                    <li id="menu-salesreturn"><a href="<?php echo PATH; ?>salesreturn.php"><i class="fa fa-mail-reply fw"></i><span>Sales Returns</span></a></li>
                    <li id="menu-users"><a href="<?php echo PATH; ?>users.php"><i class="fa fa-user fw"></i><span>Users</span></a></li>
                    <li id="menu-setting"><a href="<?php echo PATH; ?>settings.php"><i class="fa fa-cog fw"></i><span>Settings</span></a></li>
                    <li id="menu-reports"><a href="<?php echo PATH; ?>reports.php"><i class="fa fa-bar-chart fw"></i><span>Reports</span></a></li>
                </ul>
            </nav>
            <div id="content">

