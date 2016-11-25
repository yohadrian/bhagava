<?php
define ('PATH','./');
require_once(PATH. 'config.php');
require_once(PATH. 'libs/db_connection.php');
require_once(PATH. 'libs/login_func.php');

sec_session_start();

if (isset($_SESSION['bhagavagallery_loginstring'])){
    if(login_check($mysqli)) {
        header('location:'.$setting['url_admin'].'home.php');
    }
}

?>

<!doctype html>
<html>
    <head>
        <title><?php echo $setting['app_name']; ?></title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
		<script src="<?php echo PATH; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo PATH; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- font-awesome css -->
        <link href="<?php echo PATH; ?>vendor/font-awesome/css/font-awesome.min.css" rel="sytlesheet">
		<!--custom login css -->
		<link rel="stylesheet" href= "<?php echo PATH; ?>css/login.css" type="text/css"/>	
    </head>
    <body>
        
        <div class="top_logo"><img src='<?php echo PATH; ?>images/logo_jalurdata.png'/></div>
        <div id="login-overlay" class="modal-dialog  fill">
            <div class="modal-body col-sm-12">
                <div class="row ">
                    <div class="col-sm-8 col-sm-offset-2" >
                        <div class="well">
							<?php
								if(isset($_GET['invalid'])) {
									echo '<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong>Wrong!</strong> Username and Password salah.
											</div>';
								}
							?>
                            <h2 style="padding:5px;margin:0px">Login</h2><br>
                            <form id="loginForm" name='login_form' method="POST" class= 'loginform' action="login_auth.php" >
                                <div class="form-group">
                                    <label for="username" class="control-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="Username" autofocus>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password" placeholder="Password">
                                    <span class="help-block"></span>
                                </div>
                                <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                                
                                <button type="submit" class="btn btn-success btn-block">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='clear'></div>
        <div class='footer'>
            <div style='font-family: "PT Sans Regular"; line-height: 1.5em;'>
                <p style="color:white"><?php echo $setting['app_name'];?> </p>
                <a href='http://jalurdata.co.id'><img src= "<?php echo PATH; ?>images/logo_jalurdata.png" style='height: 25px;'/></a>
            </div>
        </div>
    </body>
</html>